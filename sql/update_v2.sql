
-- Update v2: Add Users, Site Settings, and Banners tables

-- Users table for registered customers
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Site Settings table for dynamic configuration
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) NOT NULL,
  `setting_value` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Banners table for homepage slider
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_url` varchar(255) NOT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default settings if not exists
INSERT IGNORE INTO `site_settings` (`setting_key`, `setting_value`) VALUES
('site_title', 'Toko Produk Digital'),
('site_description', 'Pusat produk digital terpercaya dan otomatis.'),
('contact_wa', '628123456789'),
('footer_text', 'Copyright © 2024 Toko Digital. All rights reserved.');

-- Update v3: Allow multiple items per invoice
ALTER TABLE `orders` DROP INDEX `invoice_id`;
ALTER TABLE `orders` ADD INDEX `invoice_id` (`invoice_id`);
