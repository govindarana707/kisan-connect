create TABLE products(
product_id int(5) primary key AUTO_INCREMENT,
    product_title varchar(20),
    product_description varchar(255),
    product_keyword varchar(20),
    category_id int(5),
    brand_id int(3),
    product_image1 varchar(255),
    product_image2 varchar(255),
    product_image3 varchar(255),
    price varchar(100)
    );

    -- Alter the product table
    -- add time and status 
    ALTER TABLE products
ADD date TIMESTAMP NOT NULL AFTER price,
ADD status varchar(100) NOT NULL AFTER date;
-- category  table
CREATE TABLE category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_title VARCHAR(255) NOT NULL
);

-- brand table 
CREATE TABLE brand (
    brand_id INT AUTO_INCREMENT PRIMARY KEY,
    brand_title VARCHAR(255) NOT NULL
);

-- cart details table\
create table cart_details(
product_id int(3) primary key AUTO_INCREMENT,
ip_address varchar(255),
quantity int(100)
);
-- users table 
CREATE TABLE `users` (
  `user_id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20),
  `address` TEXT
);

-- order  table
CREATE TABLE `orders` (
  `order_id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `total_amount` DECIMAL(10, 2) NOT NULL,
  `order_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `status` VARCHAR(20) DEFAULT 'Pending',
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
);

-- order items table
CREATE TABLE `order_items` (
  `order_item_id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`)
);

ALTER TABLE `orders` ADD COLUMN `shipping_address` TEXT NOT NULL;
ALTER TABLE `orders` ADD COLUMN `payment_method` VARCHAR(50) NOT NULL;

ALTER TABLE `orders`
ADD COLUMN `payment_status` VARCHAR(50) NOT NULL DEFAULT 'Pending';

