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

create table if not exists posts
(
    id      integer primary key not null ,
    user_id integer references users (id),
    image_path     text not null,
    description text
);

insert into info (version) values (3);

insert into users (username, password)
values ('alex', 'password'),
       ('bob', '1234');

insert into posts (user_id, image_path, description)
values ((select id from users where username = 'alex'), 'bridge.jpg', 'Look ath this!'),
       ((select id from users where username = 'alex'), 'dog.jpg', null);
       --((select id from users where username = 'bob'), 'https://picsum.photos/id/1040/400/400');
