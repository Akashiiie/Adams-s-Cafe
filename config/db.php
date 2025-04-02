-- Create the database
CREATE DATABASE IF NOT EXISTS coffe_theater2;

-- Use the database
USE coffe_theater2;

-- Create the posts table with auto-incrementing integer post_id
CREATE TABLE IF NOT EXISTS user_id (
    coffe_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password  VARCHAR(255)  NOT NULL
);

-- Insert sample data
INSERT INTO user_id (email, password ) VALUES
('gerald@gmail.com', '1234.'),
('jean@gmail.com', '12345.'),
('clark@gmail.com', '123456.');