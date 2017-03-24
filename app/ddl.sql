create table User (
    uid int AUTO_INCREMENT,
    name varchar(255),
    username varchar(255),
    email varchar(255),
    passhash varchar(255),
    isadmin tinyint(1),
    primary key (uid)
);

create table Post (
    pid int AUTO_INCREMENT,
    title varchar(255),
    content text,
    uid int,
    primary key (pid),
    foreign key(uid)
        references User(uid)
        ON DELETE NO ACTION
        ON UPDATE CASCADE
);

create table Comment (
    cid int auto_increment,
    content text,
    uid int,
    pid int,
    primary key (cid),
    foreign key(uid)
        references User(uid)
        ON DELETE NO ACTION
        ON UPDATE CASCADE,
    foreign key(pid)
        references Post(pid)
        ON DELETE NO ACTION
        ON UPDATE CASCADE
);
