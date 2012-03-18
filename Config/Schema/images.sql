create table images (
    id int unsigned not null auto_increment primary key,
    name varchar(50) not null,
    type varchar(25) not null,
    image blob not null,
    size int unsigned not null,
    created datetime not null,
    modified datetime not null
);
