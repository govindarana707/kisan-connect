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

