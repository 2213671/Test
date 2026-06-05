drop trigger if exists trg_before_insert_order;

create trigger trg_before_insert_order
    before insert
    on orders
    for each row
begin
    if new.code is null then
        set new.code = concat('ORD', date_format(now(), '%Y%m%d%H%i%s'), lpad(floor(rand() * 10000), 4, '0'));
    end if;
end;

drop trigger if exists trg_after_insert_order;

create trigger trg_after_insert_order
    after insert
    on orders
    for each row
begin

    update restaurant_tables rt
    set status         = 'INUSE',
        order_id       = new.id,
        customer_count = new.customer_count
    where rt.id = new.table_id;

end;

drop trigger if exists trg_after_insert_order_item;

create trigger trg_after_insert_order_item
    after insert
    on order_items
    for each row
begin
    call sp_update_order_total(new.order_id);
end;

drop trigger if exists trg_after_update_order_item;

create trigger trg_after_update_order_item
    after update
    on order_items
    for each row
begin
    call sp_update_order_total(new.order_id);
end;

drop trigger if exists trg_after_insert_order_sub_item;

create trigger trg_after_insert_order_sub_item
    after insert
    on order_sub_items
    for each row
begin

    declare order_id char(36);

    select oi.order_id
    into order_id
    from order_items oi
    where id = new.order_item_id
    limit 1;

    call sp_update_order_total(order_id);
end;

drop trigger if exists trg_after_update_order_sub_item;

create trigger trg_after_update_order_sub_item
    after update
    on order_sub_items
    for each row
begin
    declare order_id char(36);

    select oi.order_id
    into order_id
    from order_items oi
    where id = new.order_item_id
    limit 1;

    call sp_update_order_total(order_id);
end;

drop trigger if exists trg_update_idx_before_table;

create trigger trg_update_idx_before_table
    before insert
    on restaurant_tables
    for each row
begin
    if new.idx is null or new.idx <= 0 then
        set new.idx = (select coalesce(max(idx), 0) + 1
                       from restaurant_tables
                       where restaurant_id = new.restaurant_id);
    end if;
end;
