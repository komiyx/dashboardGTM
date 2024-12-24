CREATE TABLE users(
    Id int PRIMARY KEY AUTO_INCREMENT,
    Username varchar(200),
    Email varchar(200),
    Password varchar(200)
);

INSERT INTO users (username, email, password) VALUES
('kosm', 'komiyesheng@gmail.com', 'yesheng01');

CREATE TABLE gtmrecord (
    id int PRIMARY KEY AUTO_INCREMENT,
    brandname varchar(200),
    url varchar(200),
    installdate date,
    register int,
    deposit int,
    firstdatain date,
    recentdatain date,
    registerdatacollected date,
    depositdatacollected date,
    remark varchar(200)
);

