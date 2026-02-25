-- Database structuur voor MySQL
SET FOREIGN_KEY_CHECKS = 0;

-- 1. Tabel: images
CREATE TABLE IF NOT EXISTS `images` (
    `image_id` INT AUTO_INCREMENT PRIMARY KEY,
    `filename` VARCHAR(255) NOT NULL,
    `description` TEXT
) ENGINE=InnoDB;

-- 2. Tabel: categories
CREATE TABLE IF NOT EXISTS `categories` (
    `category_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `description` TEXT
) ENGINE=InnoDB;

-- 3. Tabel: order_status
CREATE TABLE IF NOT EXISTS `order_status` (
    `order_status_id` INT AUTO_INCREMENT PRIMARY KEY,
    `description` VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

-- 4. Tabel: products
CREATE TABLE IF NOT EXISTS `products` (
    `product_id` INT AUTO_INCREMENT PRIMARY KEY,
    `category_id` INT,
    `image_id` INT,
    `name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `price` DECIMAL(10, 2) NOT NULL,
    `kcal` INT,
    `available` TINYINT(1) DEFAULT 1,
    FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`) ON DELETE SET NULL,
    FOREIGN KEY (`image_id`) REFERENCES `images`(`image_id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- 5. Tabel: orders
CREATE TABLE IF NOT EXISTS `orders` (
    `order_id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_status_id` INT,
    `pickup_number` INT,
    `price_total` DECIMAL(10, 2) NOT NULL,
    `datetime` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`order_status_id`) REFERENCES `order_status`(`order_status_id`)
) ENGINE=InnoDB;

-- 6. Tabel: order_product (Koppel-tabel voor de bestelde producten)
CREATE TABLE IF NOT EXISTS `order_product` (
    `order_id` INT,
    `product_id` INT,
    `price` DECIMAL(10, 2) NOT NULL, -- Prijs op moment van bestelling
    PRIMARY KEY (`order_id`, `product_id`),
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`product_id`)
) ENGINE=InnoDB;

-- 7. Data invoegen: Order status descriptions
INSERT INTO `order_status` (`description`) VALUES
('Started'),
('Placed and paid'),
('Preparing'),
('Ready for pickup'),
('Picked up');

SET FOREIGN_KEY_CHECKS = 1;