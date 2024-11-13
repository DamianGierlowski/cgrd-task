create table users
(
    id         int auto_increment
        primary key,
    login      varchar(255)                          not null,
    password   varchar(255)                                   not null,
    created_at timestamp default current_timestamp() null
);

insert into users (login, password) values ('admin', '$2y$10$h0vz16F8iL62tR.bow4U2uYjB9W4iZXNhDzNk7GfhrgvkcqcPmxUm')
