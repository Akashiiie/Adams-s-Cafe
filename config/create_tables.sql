CREATE TABLE users(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE,
    password TEXT,
    name VARCHAR(255),
    INDEX ixEmail(email)
);
CREATE TABLE coffee(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    price DECIMAL(10,2),
    image_url TEXT
);
CREATE TABLE orders(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    order_time TIMESTAMP DEFAULT (NOW()),
    coffee_id INT UNSIGNED,
    user_id INT UNSIGNED,
    FOREIGN KEY (coffee_id)
        REFERENCES coffee(id)
        ON UPDATE CASCADE
        ON DELETE NO ACTION,
    FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON UPDATE CASCADE
        ON DELETE SET NULL,
    INDEX ixUser(user_id)
);
