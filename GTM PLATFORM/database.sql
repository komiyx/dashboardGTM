CREATE TABLE users(
    Id int PRIMARY KEY AUTO_INCREMENT,
    Username varchar(200),
    Email varchar(200),
    Password varchar(200)
);

INSERT INTO users (username, email, password) VALUES
('kosm', 'komiyesheng@gmail.com', 'yesheng01');

CREATE TABLE gtmrecord (
    id INT PRIMARY KEY AUTO_INCREMENT,
    country VARCHAR(100),
    brandname VARCHAR(200),
    url VARCHAR(200),
    register VARCHAR(200),
    deposit VARCHAR(200),
  installdate VARCHAR(10)
);
