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

ALTER TABLE indo_user_records ADD COLUMN deposit_status VARCHAR(3) DEFAULT '-';


DELIMITER $$

CREATE TRIGGER after_indo_dep_user_records_insert
AFTER INSERT ON indo_dep_user_records
FOR EACH ROW
BEGIN
    -- Check if the username in indo_user_records matches the newly inserted username
    UPDATE indo_user_records
    SET deposit_status = 'YES'
    WHERE username = NEW.username;
END$$

DELIMITER ;



CREATE TABLE my_user_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255),
    fullname VARCHAR(255),
    email VARCHAR(255),
    mobile VARCHAR(20),
    bank VARCHAR(255),
    bankno VARCHAR(255),
    ewalletnum VARCHAR(255),
    url VARCHAR(255),
    created_time DATETIME
);

