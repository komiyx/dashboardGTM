CREATE TABLE users(
    Id int PRIMARY KEY AUTO_INCREMENT,
    Username varchar(200),
    Email varchar(200),
    Password varchar(200)
);

INSERT INTO users (username, email, password) VALUES
('kosm', 'komiyesheng@gmail.com', 'yesheng01');

CREATE TABLE app(
    appid int PRIMARY KEY AUTO_INCREMENT,
    userid int NOT NULL,
    appname varchar(200),
    remark varchar(200),
    appicon varchar(200),
    numdownload int,
    numcomment int,
    agerestrict varchar(200),
    appintro varchar(200),
    imgdetails varchar(200),
    tag VARCHAR(255) NOT NULL,
    scores VARCHAR(200),    
    commentname VARCHAR(200),
    commentrate VARCHAR(200),
    commenttext VARCHAR(200),
    autocomments VARCHAR(200),
    FOREIGN KEY (userid) REFERENCES users(Id)
);

