create table if not exists roles
(
    id         char(36) not null default (uuid()),
    role_name  varchar(20)
        check ( role_name in ('ADMIN', 'STAFF', 'ADMIN_RESTAURANT')) unique,
    created_at datetime not null default (now()),
    updated_at datetime not null default (now()),
    primary key (id)
);

create table if not exists users
(
    id            char(36)     not null default (uuid()),
    username      varchar(50)  not null unique,
    password      varchar(100) not null,
    email         varchar(100),
    image_url     varchar(200),
    address       varchar(100),
    phone         varchar(100),
    role_id       char(36)     not null,
    restaurant_id char(36),
    created_at    datetime     not null default (now()),
    updated_at    datetime     not null default (now()),
    primary key (id),
    foreign key (role_id) references roles (id)
);

create table if not exists restaurants
(
    id          char(36)     not null default (uuid()),
    name        varchar(500) not null,
    description varchar(500),
    address     varchar(500),
    email       varchar(100),
    image_url   varchar(500),
    status      varchar(20) check ( status in ('ACTIVE', 'INACTIVE')),
    created_at  datetime     not null default (now()),
    updated_at  datetime     not null default (now()),
    primary key (id)
);

alter table restaurants
    add column phone char(10);

SET @exists = (SELECT COUNT(*)
               FROM information_schema.TABLE_CONSTRAINTS
               WHERE TABLE_SCHEMA = DATABASE()
                 AND TABLE_NAME = 'users'
                 AND CONSTRAINT_NAME = 'fk_user_restaurant'
                 AND CONSTRAINT_TYPE = 'FOREIGN KEY');

SET @sql = IF(@exists = 0,
              'alter table users
                add constraint fk_user_restaurant
                    foreign key (restaurant_id) references restaurants (id)',
              'SELECT "Primary key already exists"'
           );

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

create table if not exists restaurant_tables
(
    id             char(36)     not null default (uuid()),
    name           varchar(500) not null,
    idx            integer,
    customer_count integer,
    total_price    numeric(20, 4),
    total_item     bigint,
    status         varchar(20) check ( status in ('INUSE', 'BLANK', 'DISABLED')),
    order_id       char(36),
    restaurant_id  char(36)     not null,
    created_at     datetime     not null default (now()),
    updated_at     datetime     not null default (now()),
    primary key (id),
    foreign key (restaurant_id) references restaurants (id)
);

create table if not exists menus
(
    id            char(36)     not null default (uuid()),
    name          varchar(500) not null,
    description   varchar(500),
    status        varchar(20)  not null check ( status in ('ACTIVE', 'INACTIVE') ),
    restaurant_id char(36)     not null,
    created_at    datetime     not null default (now()),
    updated_at    datetime     not null default (now()),
    primary key (id),
    foreign key (restaurant_id) references restaurants (id)
);

create table if not exists options
(
    id            char(36)       not null default (uuid()),
    name          varchar(500)   not null,
    required      boolean        not null default false,
    status        varchar(20)    not null check ( status in ('ACTIVE', 'INACTIVE') ),
    price         numeric(20, 4) not null default 0,
    restaurant_id char(36)       not null,
    created_at    datetime       not null default (now()),
    updated_at    datetime       not null default (now()),
    primary key (id),
    foreign key (restaurant_id) references restaurants (id)
);

create table if not exists toppings
(
    id            char(36)       not null default (uuid()),
    name          varchar(500)   not null,
    max_quantity  integer,
    status        varchar(20)    not null check ( status in ('ACTIVE', 'INACTIVE') ),
    price         numeric(20, 4) not null default 0,
    restaurant_id char(36)       not null,
    created_at    datetime       not null default (now()),
    updated_at    datetime       not null default (now()),
    primary key (id),
    foreign key (restaurant_id) references restaurants (id)
);

create table if not exists products
(
    id            char(36)       not null default (uuid()),
    name          varchar(500)   not null,
    description   varchar(500),
    tag           varchar(500),
    image_url     varchar(500),
    status        varchar(20)    not null check ( status in ('ACTIVE', 'INACTIVE') ),
    price         numeric(20, 4) not null default 0,
    restaurant_id char(36)       not null,
    menu_id       char(36),
    created_at    datetime       not null default (now()),
    updated_at    datetime       not null default (now()),
    primary key (id),
    foreign key (restaurant_id) references restaurants (id),
    foreign key (menu_id) references menus (id)
);

create table if not exists product_options
(
    product_id char(36) not null,
    option_id  char(36) not null,
    primary key (product_id, option_id),
    foreign key (product_id) references products (id),
    foreign key (option_id) references options (id)
);

create table if not exists product_toppings
(
    product_id char(36) not null,
    topping_id char(36) not null,
    primary key (product_id, topping_id),
    foreign key (product_id) references products (id),
    foreign key (topping_id) references toppings (id)
);

create table if not exists promotions
(
    id            char(36)       not null default (uuid()),
    name          varchar(500)   not null,
    status        varchar(20)    not null check ( status in ('ACTIVE', 'INACTIVE') ),
    value         decimal(20, 4) not null,
    type          varchar(20) check ( type in ('PERCENT', 'VALUE')),
    start_date    datetime,
    end_date      datetime,
    start_hour    time,
    end_hour      time,
    restaurant_id char(36)       not null,
    created_at    datetime       not null default (now()),
    updated_at    datetime       not null default (now()),
    primary key (id),
    foreign key (restaurant_id) references restaurants (id)
);

alter table promotions
    add column apply_type varchar(20) not null check ( apply_type in ('ORDER_ITEM', 'ORDER'));

create table if not exists promotion_menus
(
    promotion_id char(36) not null,
    menu_id      char(36) not null,
    primary key (promotion_id, menu_id),
    foreign key (promotion_id) references promotions (id),
    foreign key (menu_id) references menus (id)
);

alter table promotion_menus
    drop foreign key promotion_menus_ibfk_1;


alter table promotion_menus
    drop foreign key promotion_menus_ibfk_2;

alter table promotion_menus
    add constraint fk_promotion
        foreign key (promotion_id) references promotions (id) on delete cascade on update cascade;


alter table promotion_menus
    add constraint fk_meunu
        foreign key (menu_id) references menus (id) on delete cascade on update cascade;


create table if not exists payment_methods
(
    id            char(36)     not null default (uuid()),
    name          varchar(500) not null,
    code          varchar(50)  not null,
    status        varchar(20)  not null check ( status in ('ACTIVE', 'INACTIVE') ),
    restaurant_id char(36)     not null,
    created_at    datetime     not null default (now()),
    updated_at    datetime     not null default (now()),
    primary key (id),
    foreign key (restaurant_id) references restaurants (id)
);

create table if not exists shifts
(
    id             char(36) not null default (uuid()),
    total_item     bigint,
    total_customer bigint,
    opener_id      char(36) not null,
    closer_id      char(36),
    restaurant_id  char(36) not null,
    open_at        datetime,
    close_at       datetime,
    created_at     datetime not null default (now()),
    updated_at     datetime not null default (now()),
    primary key (id),
    foreign key (restaurant_id) references restaurants (id),
    foreign key (opener_id) references users (id),
    foreign key (closer_id) references users (id) on delete set null
);

create table if not exists orders
(
    id                              char(36) not null default (uuid()),
    code                            varchar(50) unique,
    table_id                        char(36) not null,
    customer_count                  integer,
    total_price                     numeric(20, 4),
    total_item                      bigint,
    amount_discount                 numeric(20, 4),
    final_amount                    numeric(20, 4),
    amount_received_from_customer   numeric(20, 4),
    amount_change_given_to_customer numeric(20, 4),
    order_status                    varchar(30) check ( order_status in ('IN_PROGRESS', 'COMPLETED', 'CANCELLED', 'DELETED')),
    creator_id                      char(36) not null,
    shift_id                        char(36) not null,
    promotion_order_id              char(36),
    created_at                      datetime not null default (now()),
    updated_at                      datetime not null default (now()),
    primary key (id),
    foreign key (creator_id) references users (id),
    foreign key (shift_id) references shifts (id)
);

alter table orders
    add column payment_method varchar(2000);

alter table orders
    add column table_name varchar(500);

create table if not exists promotion_orders
(
    id                      char(36)       not null default (uuid()),
    promotion_name          varchar(500)   not null,
    apply_at                datetime       not null,
    apply_order_type        varchar(20) check ( apply_order_type in ('ORDER', 'ORDER_ITEM')),
    promotion_value         numeric(20, 4) not null,
    promotion_type          varchar(20) check ( promotion_type in ('PERCENT', 'VALUE')),
    amount_before_promotion numeric(20, 4) not null,
    amount_after_promotion  numeric(20, 4) not null,
    order_id                char(36)       not null,
    promotion_id            char(36),
    created_at              datetime       not null default (now()),
    updated_at              datetime       not null default (now()),
    primary key (id),
    foreign key (order_id) references orders (id)
);


SET @exists = (SELECT COUNT(*)
               FROM information_schema.TABLE_CONSTRAINTS
               WHERE TABLE_SCHEMA = DATABASE()
                 AND TABLE_NAME = 'orders'
                 AND CONSTRAINT_NAME = 'fk_order_promotion_order'
                 AND CONSTRAINT_TYPE = 'FOREIGN KEY');

SET @sql = IF(@exists = 0,
              'alter table orders
                add constraint fk_order_promotion_order
                    foreign key (promotion_order_id) references promotion_orders(id)',
              'SELECT "fk_order_promotion_order already exists"'
           );

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

create table if not exists order_items
(
    id                 char(36)       not null default (uuid()),
    name               varchar(500)   not null,
    price              numeric(20, 4) not null,
    quantity           bigint,
    item_type          varchar(20) check ( item_type in ('PRODUCT', 'TOPPING', 'OPTION')),
    promotion_order_id char(36),
    item_id            char(36),
    order_id           char(36)       not null,
    created_at         datetime       not null default (now()),
    updated_at         datetime       not null default (now()),
    primary key (id),
    foreign key (order_id) references orders (id),
    foreign key (promotion_order_id) references promotion_orders (id)
);

create table if not exists order_sub_items
(
    id            char(36)       not null default (uuid()),
    name          varchar(500)   not null,
    price         numeric(20, 4) not null,
    quantity      bigint,
    item_type     varchar(20) check ( item_type in ('PRODUCT', 'TOPPING', 'OPTION')),
    item_id       char(36),
    order_item_id char(36)       not null,
    created_at    datetime       not null default (now()),
    updated_at    datetime       not null default (now()),
    primary key (id),
    foreign key (order_item_id) references order_items (id) on delete cascade
);

create table if not exists order_item_histories
(
    id                   char(36)       not null default (uuid()),
    name                 varchar(500)   not null,
    price                numeric(20, 4) not null,
    quantity             bigint,
    item_type            varchar(20) check ( item_type in ('PRODUCT', 'TOPPING', 'OPTION')),
    order_history_status varchar(20) check ( order_history_status in ('ADD_NEW', 'ADD', 'UPDATE', 'REMOVE')),
    item_id              char(36),
    order_item_id        char(36),
    order_id             char(36)       not null,
    created_at           datetime       not null default (now()),
    updated_at           datetime       not null default (now()),
    primary key (id),
    foreign key (order_id) references orders (id)
);

create table if not exists order_sub_item_histories
(
    id                    char(36)       not null default (uuid()),
    name                  varchar(500)   not null,
    price                 numeric(20, 4) not null,
    quantity              bigint,
    item_id               char(36),
    item_type             varchar(20) check ( item_type in ('PRODUCT', 'TOPPING', 'OPTION')),
    order_item_history_id char(36)       not null,
    created_at            datetime       not null default (now()),
    updated_at            datetime       not null default (now()),
    primary key (id),
    foreign key (order_item_history_id) references order_item_histories (id)
);

alter table order_item_histories
    add column request_id char(36);
