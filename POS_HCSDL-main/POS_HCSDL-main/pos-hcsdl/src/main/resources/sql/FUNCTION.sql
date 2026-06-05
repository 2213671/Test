drop function if exists fn_promotion_in_order;

create function fn_promotion_in_order(
    p_order_id char(36),
    p_promotion_id char(36)
)
    returns numeric(20, 4)
    deterministic
    reads sql data
begin
    declare v_discount numeric default 0;
    declare v_promotion_type varchar(20);
    declare v_promotion_apply_type varchar(20);
    declare v_promotion_value numeric(20, 4);

    select type, apply_type, value
    into v_promotion_type, v_promotion_apply_type, v_promotion_value
    from promotions
    where id = p_promotion_id;

    if v_promotion_apply_type = 'ORDER_ITEM' then
        select ifnull(sum(fn_calculator_promotion(oi.price, v_promotion_value, v_promotion_type) * oi.quantity), 0)
        into v_discount
        from order_items oi
                 join products p on p.id = oi.item_id
        where oi.order_id = p_order_id
          and p.menu_id in (select menu_id
                            from promotion_menus
                            where promotion_id = p_promotion_id);
        return v_discount;
    end if;

    select ifnull(fn_calculator_promotion(o.total_price, v_promotion_value, v_promotion_type), -1)
    into v_discount
    from orders o
    where o.id = p_order_id;

    return v_discount;
end;

drop function if exists fn_calculator_promotion;

create function fn_calculator_promotion(price numeric(20, 4), value numeric(20, 4), type varchar(20))
    returns numeric(20, 4)
    deterministic
    reads sql data
begin
    if type = 'PERCENT' then
        return price * value / 100;
    end if;

    return value;
end;

drop function if exists fn_check_promotion_in_order;

create function fn_check_promotion_in_order(
    p_order_id char(36),
    p_promotion_id char(36)
)
    returns boolean
    deterministic
    reads sql data
begin
    declare v_promotion_apply_type varchar(20);
    declare v_counter int default 0;
    select apply_type
    into v_promotion_apply_type
    from promotions
    where id = p_promotion_id;

    if v_promotion_apply_type = 'ORDER_ITEM' then
        select count(*)
        into v_counter
        from order_items oi
                 join products p on p.id = oi.item_id
        where oi.order_id = p_order_id
          and p.menu_id in (select menu_id
                            from promotion_menus
                            where promotion_id = p_promotion_id);
        return v_counter > 0;
    end if;

    return true;
end;