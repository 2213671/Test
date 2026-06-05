drop procedure if exists sp_create_order;

create procedure sp_create_order(
    in p_creator_id char(36),
    in p_table_id char(36),
    in p_shift_id char(36),
    in p_customer_count int,
    in p_items json
)
begin
    declare v_order_id char(36);
    declare v_order_item_id char(36);
    declare v_table_name varchar(500);
    declare v_table_order_id char(36);
    declare v_item_id char(36);
    declare v_sub_item_id char(36);

    declare i_order_item int default 0;
    declare n_order_item int;

    declare i_order_sub_item int default 0;
    declare n_order_sub_item int;

    declare v_product_name varchar(500);
    declare v_product_price numeric(20, 4);

    declare v_sub_item_name varchar(500);
    declare v_sub_item_price numeric(20, 4);
    declare v_sub_item_type varchar(20);

    declare v_new_sub_item_id char(36);

    declare v_order_item_history_id char(36);

    declare v_request_id char(36);

    declare exit handler for sqlexception
        begin
            rollback;
            resignal;
        end;

    start transaction;

    if not exists (select 1 from restaurant_tables where id = p_table_id) then
        signal sqlstate '45000' set message_text = 'TABLE_NOT_FOUND';
    end if;

    select name, order_id
    into v_table_name, v_table_order_id
    from restaurant_tables
    where id = p_table_id;

    if v_table_order_id is not null then
        signal sqlstate '45000' set message_text = 'TABLE_HAS_ORDER';
    end if;

    if v_table_name is null then
        signal sqlstate '45000' set message_text = 'TABLE_NAME_NULL';
    end if;


    set v_order_id = uuid();
    set v_request_id = uuid();

    insert into orders(id, creator_id, table_id, shift_id, customer_count, order_status, table_name)
    values (v_order_id, p_creator_id, p_table_id, p_shift_id, p_customer_count, 'IN_PROGRESS', v_table_name);

    set n_order_item = json_length(p_items);

    if n_order_item is null then
        signal sqlstate '45000' set message_text = 'ITEM_LIST_INVALID_JSON';
    end if;

    while i_order_item < n_order_item
        do

            set v_item_id = json_unquote(json_extract(p_items, concat('$[', i_order_item, '].itemId')));

            if v_item_id is null then
                signal sqlstate '45000' set message_text = 'ITEM_ID_NULL';
            end if;

            if not exists (select 1 from products where id = v_item_id) then
                signal sqlstate '45000' set message_text = 'PRODUCT_NOT_FOUND';
            end if;

            select name, price
            into v_product_name, v_product_price
            from products
            where id = v_item_id;

            set v_order_item_id = uuid();

            insert into order_items(id, name, price, quantity, item_type, item_id, order_id)
            values (v_order_item_id,
                    v_product_name,
                    v_product_price,
                    json_extract(p_items, concat('$[', i_order_item, '].quantity')),
                    'PRODUCT',
                    v_item_id,
                    v_order_id);

            call sp_add_order_item_history(v_request_id, v_order_item_id,
                                           'ADD_NEW',
                                           cast(json_extract(p_items, concat('$[', i_order_item, '].quantity')) as unsigned),
                                           v_order_item_history_id);

            set n_order_sub_item = json_length(
                    json_extract(p_items, concat('$[', i_order_item, '].subItems'))
                                   );
            set i_order_sub_item = 0;

            while i_order_sub_item < n_order_sub_item
                do

                    set v_sub_item_id = json_unquote(
                            json_extract(p_items,
                                         concat('$[', i_order_item, '].subItems[', i_order_sub_item, '].itemId'))
                                        );

                    set v_sub_item_type = json_unquote(
                            json_extract(p_items,
                                         concat('$[', i_order_item, '].subItems[', i_order_sub_item, '].itemType'))
                                          );

                    if v_sub_item_type = 'TOPPING' then
                        select name, price
                        into v_sub_item_name, v_sub_item_price
                        from toppings
                        where id = v_sub_item_id;
                    elseif v_sub_item_type = 'OPTION' then
                        select name, price
                        into v_sub_item_name, v_sub_item_price
                        from options
                        where id = v_sub_item_id;
                    else
                        signal sqlstate '45000' set message_text = 'INVALID_SUB_ITEM_TYPE';
                    end if;

                    set v_new_sub_item_id = uuid();

                    insert into order_sub_items(id, name, price, quantity, item_type, item_id, order_item_id)
                    values (v_new_sub_item_id,
                            v_sub_item_name,
                            v_sub_item_price,
                            json_extract(
                                    p_items,
                                    concat('$[', i_order_item, '].subItems[', i_order_sub_item, '].quantity')
                            ),
                            v_sub_item_type,
                            v_sub_item_id,
                            v_order_item_id);

                    call sp_add_order_sub_item_history(v_order_item_history_id, v_new_sub_item_id,
                                                       cast(json_extract(
                                                               p_items,
                                                               concat('$[', i_order_item, '].subItems[',
                                                                      i_order_sub_item, '].quantity')) as unsigned)
                         );

                    set i_order_sub_item = i_order_sub_item + 1;

                end while;

            set i_order_item = i_order_item + 1;

        end while;
    commit;

    select v_order_id as order_id;
end;

drop procedure if exists sp_update_order_total;

create procedure sp_update_order_total(in p_order_id char(36))
begin


    declare v_total_items bigint default 0;
    declare v_total_price numeric(20, 4) default 0;
    declare v_total_sub_items bigint default 0;
    declare v_total_sub_price numeric(20, 4) default 0;

    if p_order_id is null then
        signal sqlstate '45000' set message_text = 'ORDER_ID_NULL';
    end if;

    select ifnull(sum(quantity), 0), ifnull(sum((quantity * price)), 0)
    into v_total_items, v_total_price
    from order_items
    where order_id = p_order_id;

    select ifnull(sum(osi.quantity), 0), ifnull(sum((osi.quantity * osi.price)), 0)
    into v_total_sub_items, v_total_sub_price
    from order_sub_items osi
             join order_items oi on osi.order_item_id = oi.id
    where oi.order_id = p_order_id;

    update restaurant_tables rt
        join orders o
        on o.id = rt.order_id
    set rt.total_item  = v_total_items + v_total_sub_items,
        rt.total_price = v_total_price + v_total_sub_price
    where rt.order_id = p_order_id;

    update orders o
    set o.total_item   = v_total_items + v_total_sub_items,
        o.total_price  = v_total_price + v_total_sub_price,
        o.final_amount = v_total_price + v_total_sub_price
    where o.id = p_order_id;
end;

drop procedure if exists sp_add_order;

create procedure sp_add_order(
    in p_order_id char(36),
    in p_items json
)
begin
    declare i_order_item int default 0;
    declare n_order_item int;

    declare i_order_sub_item int default 0;
    declare n_order_sub_item int;

    declare v_product_name varchar(500);
    declare v_product_price numeric(20, 4);

    declare v_sub_item_name varchar(500);
    declare v_sub_item_price numeric(20, 4);
    declare v_sub_item_type varchar(20);

    declare v_item_id char(36);
    declare v_sub_item_id char(36);

    declare v_count_match_item int default 0;
    declare v_order_item_id char(36);

    declare v_new_sub_item_id char(36);

    declare v_request_id char(36);

    declare v_order_item_history_id char(36);

    set n_order_item = json_length(p_items);
    set v_request_id = uuid();

    if n_order_item is null then
        signal sqlstate '45000' set message_text = 'ITEMS_INVALID_JSON';
    end if;

    while i_order_item < n_order_item
        do
            set v_count_match_item = 0;
            set v_order_item_id = null;

            set n_order_sub_item = json_length(json_extract(p_items, concat('$[', i_order_item, '].subItems')));
            select oi.id
            into v_order_item_id
            from order_items oi
                     left join order_sub_items osi on oi.id = osi.order_item_id
            where oi.item_id = json_unquote(json_extract(p_items, concat('$[', i_order_item, '].itemId')))
              and oi.order_id = p_order_id
              and (n_order_sub_item = 0 or osi.item_id in (select jt.itemid
                                                           from json_table(
                                                                        json_extract(p_items, concat('$[', i_order_item, ']')),
                                                                        '$.subItems[*]'
                                                                        columns (itemid char(36) path '$.itemId')
                                                                ) as jt))
              and (select count(*)
                   from order_sub_items osi2
                   where osi2.order_item_id = oi.id) = n_order_sub_item
            limit 1;

            if v_order_item_id is not null then
                update order_items oi
                set oi.quantity = oi.quantity +
                                  cast(json_extract(p_items, concat('$[', i_order_item, '].quantity')) as unsigned)
                where oi.id = v_order_item_id;


                set i_order_sub_item = 0;

                call sp_add_order_item_history(v_request_id, v_order_item_id,
                                               'ADD',
                                               cast(json_extract(p_items, concat('$[', i_order_item, '].quantity')) as unsigned),
                                               v_order_item_history_id);


                while i_order_sub_item < n_order_sub_item
                    do
                        update order_sub_items osi
                        set osi.quantity = osi.quantity + cast(json_extract(
                                p_items,
                                concat('$[', i_order_item, '].subItems[', i_order_sub_item, '].quantity')) as unsigned)
                        where osi.item_id = json_unquote(json_extract(
                                p_items,
                                concat('$[', i_order_item, '].subItems[', i_order_sub_item, '].itemId')))
                          and osi.order_item_id = v_order_item_id;

                        select osi.id
                        into v_new_sub_item_id
                        from order_sub_items osi
                        where osi.item_id = json_extract(
                                p_items,
                                concat('$[', i_order_item, '].subItems[', i_order_sub_item, '].itemId'))
                          and osi.order_item_id = v_order_item_id;

                        call sp_add_order_sub_item_history(v_order_item_history_id, v_new_sub_item_id,
                                                           cast(json_extract(
                                                                   p_items,
                                                                   concat('$[', i_order_item, '].subItems[',
                                                                          i_order_sub_item, '].quantity')) as unsigned)
                             );

                        set i_order_sub_item = i_order_sub_item + 1;
                    end while;

            else
                set v_item_id = json_unquote(json_extract(p_items, concat('$[', i_order_item, '].itemId')));

                if
                    v_item_id is null then
                    signal sqlstate '45000' set message_text = 'ITEM_ID_NULL';
                end if;

                if
                    not exists (select 1 from products where id = v_item_id) then
                    signal sqlstate '45000' set message_text = 'PRODUCT_NOT_FOUND';
                end if;

                select name, price
                into v_product_name, v_product_price
                from products
                where id = v_item_id;

                set
                    v_order_item_id = uuid();

                insert into order_items(id, name, price, quantity, item_type, item_id, order_id)
                values (v_order_item_id,
                        v_product_name,
                        v_product_price,
                        json_extract(p_items, concat('$[', i_order_item, '].quantity')),
                        'PRODUCT',
                        v_item_id,
                        p_order_id);

                call sp_add_order_item_history(v_request_id, v_order_item_id,
                                               'ADD',
                                               cast(json_extract(p_items, concat('$[', i_order_item, '].quantity')) as unsigned),
                                               v_order_item_history_id);

                set
                    n_order_sub_item = json_length(
                            json_extract(p_items, concat('$[', i_order_item, '].subItems'))
                                       );
                set
                    i_order_sub_item = 0;
                while
                    i_order_sub_item < n_order_sub_item
                    do

                        set v_sub_item_id = json_unquote(
                                json_extract(p_items,
                                             concat('$[', i_order_item, '].subItems[', i_order_sub_item, '].itemId'))
                                            );

                        set
                            v_sub_item_type = json_unquote(
                                    json_extract(p_items,
                                                 concat('$[', i_order_item, '].subItems[', i_order_sub_item,
                                                        '].itemType'))
                                              );

                        if
                            v_sub_item_type = 'TOPPING' then
                            select name, price
                            into v_sub_item_name, v_sub_item_price
                            from toppings
                            where id = v_sub_item_id;
                        elseif
                            v_sub_item_type = 'OPTION' then
                            select name, price
                            into v_sub_item_name, v_sub_item_price
                            from options
                            where id = v_sub_item_id;
                        else
                            signal sqlstate '45000' set message_text = 'INVALID_SUB_ITEM_TYPE';
                        end if;

                        set v_new_sub_item_id = uuid();

                        insert into order_sub_items(id, name, price, quantity, item_type, item_id, order_item_id)
                        values (v_new_sub_item_id,
                                v_sub_item_name,
                                v_sub_item_price,
                                json_extract(
                                        p_items,
                                        concat('$[', i_order_item, '].subItems[', i_order_sub_item, '].quantity')
                                ),
                                v_sub_item_type,
                                v_sub_item_id,
                                v_order_item_id);

                        call sp_add_order_sub_item_history(v_order_item_history_id, v_new_sub_item_id,
                                                           cast(json_extract(
                                                                   p_items,
                                                                   concat('$[', i_order_item, '].subItems[',
                                                                          i_order_sub_item, '].quantity')) as unsigned)
                             );
                        set
                            i_order_sub_item = i_order_sub_item + 1;

                    end while;
            end if;

            set
                i_order_item = i_order_item + 1;
        end while;
    commit;
end;

drop procedure if exists sp_get_order_items_with_discount;

create procedure sp_get_order_items_with_discount(
    in p_order_id char(36),
    in p_promotion_id char(36)
)
begin
    declare v_order_status varchar(20);

    select order_status
    into v_order_status
    from orders
    where id = p_order_id;

    if v_order_status = 'IN_PROGRESS'
    then
        select oi.id,
               p.id      as item_id,
               oi.price,
               oi.quantity,
               p.name,
               'PRODUCT' as item_type,
               p.image_url,
               p.menu_id,
               case
                   when pr.apply_type = 'ORDER_ITEM'
                       and p_promotion_id = (select ppr.id
                                             from promotions ppr
                                             where ppr.start_date <= now()
                                               and now() <= ppr.end_date
                                               and ppr.start_hour <= time(now())
                                               and time(now()) <= ppr.end_hour
                                               and p.menu_id in
                                                   (select pmn.menu_id
                                                    from promotion_menus pmn
                                                    where pmn.promotion_id = ppr.id)
                                             limit 1)
                       then fn_calculator_promotion(oi.price, pr.value, pr.type)
                   else 0
                   end   as discount_value,
               case
                   when pr.apply_type = 'ORDER_ITEM'
                       and pr.id = (select ppr.id
                                    from promotions ppr
                                    where ppr.start_date <= now()
                                      and now() <= ppr.end_date
                                      and ppr.start_hour <= time(now())
                                      and time(now()) <= ppr.end_hour
                                      and p.menu_id in (select pmn.menu_id
                                                        from promotion_menus pmn
                                                        where pmn.promotion_id = ppr.id)
                                    limit 1)
                       then oi.price - fn_calculator_promotion(oi.price, pr.value, pr.type)
                   else oi.price
                   end   as discounted_price
        from order_items oi
                 join products p on p.id = oi.item_id
                 left join promotions pr on pr.id = p_promotion_id
        where oi.order_id = p_order_id;
    else
        select oi.id,
               p.id      as item_id,
               oi.price,
               oi.quantity,
               p.name,
               'PRODUCT' as item_type,
               p.image_url,
               p.menu_id,
               case
                   when pro.apply_order_type = 'ORDER_ITEM'
                       then fn_calculator_promotion(oi.price, pro.promotion_value, pro.promotion_type)
                   else 0
                   end   as discount_value,
               case
                   when pro.apply_order_type = 'ORDER_ITEM'
                       then oi.price - fn_calculator_promotion(oi.price, pro.promotion_value, pro.promotion_type)
                   else oi.price
                   end   as discounted_price
        from order_items oi
                 join products p on p.id = oi.item_id
                 join orders o on o.id = oi.order_id
                 left join promotion_orders pro on pro.id = o.promotion_order_id
        where oi.order_id = p_order_id;
    end if;
end;

drop procedure if exists sp_add_order_item_history;

create procedure sp_add_order_item_history(
    in p_request_id char(36),
    in p_order_item_id char(36),
    in history_type varchar(20),
    in p_quantity int,
    out order_item_history_id char(36)
)
begin
    declare v_order_item_history_id char(36);

    set v_order_item_history_id = uuid();

    insert into order_item_histories (id, name, price, quantity, item_type,
                                      order_history_status, item_id, order_item_id,
                                      order_id, request_id)
    select v_order_item_history_id,
           name,
           price,
           p_quantity,
           item_type,
           history_type,
           item_id,
           p_order_item_id,
           order_id,
           p_request_id
    from order_items
    where id = p_order_item_id;

    set order_item_history_id = v_order_item_history_id;
end;

drop procedure if exists sp_add_order_sub_item_history;

create procedure sp_add_order_sub_item_history(
    in p_order_item_history_id char(36),
    in p_order_sub_item_id char(36),
    in p_quantity int
)
begin
    insert into order_sub_item_histories (id, name, price, quantity, item_type,
                                          item_id, order_item_history_id)
    select uuid(),
           name,
           price,
           p_quantity,
           item_type,
           item_id,
           p_order_item_history_id
    from order_sub_items
    where id = p_order_sub_item_id;
end;

drop procedure if exists sp_insert_restaurant;

create procedure sp_insert_restaurant(
    in p_name varchar(500),
    in p_address varchar(500),
    in p_description varchar(500),
    in p_phone char(10),
    in p_email varchar(100),
    in p_image_url varchar(200)
)
begin
    declare v_count int default 0;
    declare v_id char(36);
    if p_name is null or trim(p_name) = '' then
        signal sqlstate '45000' set message_text = 'ten nha hang khong duoc de trong';
    end if;

    select count(*) into v_count from restaurants where name = p_name;
    if v_count > 0 then
        signal sqlstate '45000' set message_text = 'ten nha hang da ton tai';
    end if;

    if p_phone is not null and p_phone not regexp '^[0-9+\\- ]*$' then
        signal sqlstate '45000' set message_text = 'so dien thoai khong hop le';
    end if;

    if p_email is not null and p_email not like '%@%' then
        signal sqlstate '45000' set message_text = 'email khong hop le';
    end if;

    set v_id = uuid();
    insert into restaurants(id,
                            name,
                            address,
                            description,
                            phone,
                            email,
                            image_url,
                            created_at,
                            updated_at)
    values (v_id,
            p_name,
            p_description,
            p_address,
            p_phone,
            p_email,
            p_image_url,
            now(),
            now());

    select v_id as restaurant_id;
end;