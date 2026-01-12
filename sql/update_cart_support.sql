ALTER TABLE `orders` DROP INDEX `invoice_id`;
ALTER TABLE `orders` ADD COLUMN `quantity` INT(11) DEFAULT 1 AFTER `product_id`;
