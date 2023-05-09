create table if not exists version
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

insert into version (version) values (1);

insert into users (username, password)
values ('alex', 'password'),
       ('bob', '1234');

insert into photos (user_id, url)
values ((select id from users where username = 'alex'), 'http://www.google.com'),
       ((select id from users where username = 'alex'), 'http://www.yahoo.com'),
       ((select id from users where username = 'bob'), 'http://www.bing.com');
