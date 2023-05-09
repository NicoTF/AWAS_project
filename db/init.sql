create table if not exists info
(
    version integer primary key not null
);

create table if not exists users
(
    id       integer primary key not null ,
    username text not null,
    password text not null
);

create table if not exists photos
(
    id      integer primary key not null ,
    user_id integer references users (id),
    url     text not null
);

insert into info (version) values (2);

insert into users (username, password)
values ('alex', 'password'),
       ('bob', '1234');

insert into photos (user_id, url)
values ((select id from users where username = 'alex'), 'https://picsum.photos/id/523/200/200'),
       ((select id from users where username = 'alex'), 'https://picsum.photos/id/237/200/300'),
       ((select id from users where username = 'bob'), 'https://picsum.photos/id/1040/400/400');
