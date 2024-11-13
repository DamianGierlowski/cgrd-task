create table users
(
    id         int auto_increment
        primary key,
    login      varchar(255)                          not null,
    password   varchar(255)                                   not null,
    created_at timestamp default current_timestamp() null
);
