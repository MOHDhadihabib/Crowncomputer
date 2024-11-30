CREATE TABLE `admin` (
  `ADMINid` int(11) PRIMARY KEY AUTO_INCREMENT,
  `ADMIN_NAME` varchar(100) NOT NULL,
  `ADMIN_EMAILID` varchar(100) NOT NULL,
  `ADMIN_PASSWORD` varchar(100) NOT NULL
);

CREATE TABLE `users` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE ,
  `phone` varchar(11) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL UNIQUE  
);

CREATE TABLE `orders` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `delivery_charges` int(11) NOT NULL,
  `order_date_time` datetime NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE `categories` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `picture` text NOT NULL
);

CREATE TABLE `products` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `picture` text NOT NULL,
  `category_id` int(255) NOT NULL,
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
);

CREATE TABLE `order_details` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
);

