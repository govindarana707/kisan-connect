-- product insert database query
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,  -- Auto-increment primary key for product
    product_title VARCHAR(255) NOT NULL,         -- Title of the product
    description TEXT NOT NULL,                   -- Description of the product
    product_keyword VARCHAR(255) NOT NULL,       -- Keywords related to the product
    product_category VARCHAR(100) NOT NULL,      -- Category of the product (e.g., Fruits, Vegetables)
    product_brands VARCHAR(100) NOT NULL,        -- Brand of the product
    product_price DECIMAL(10, 2) NOT NULL,       -- Price of the product (with 2 decimal places)
    product_image1 VARCHAR(255) NOT NULL,        -- Path to the first image
    product_image2 VARCHAR(255),                 -- Path to the second image (optional)
    product_image3 VARCHAR(255),                 -- Path to the third image (optional)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp of when the product was added
);
