-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2019 at 12:20 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopping_cart_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE IF NOT EXISTS `basket` (
  `basket_id` int(10) NOT NULL AUTO_INCREMENT,
  `id_items` int(10) NOT NULL,
  `basket_quantity` int(10) NOT NULL,
  `id_cookie` varchar(255) NOT NULL,
  PRIMARY KEY (`basket_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=254 ;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`basket_id`, `id_items`, `basket_quantity`, `id_cookie`) VALUES
(247, 6, 1, '453161263f3d3e23209df8fc78b95928'),
(248, 6, 1, '01f6c4d9e56561366ff26d671b8f8928'),
(249, 7, 1, '01f6c4d9e56561366ff26d671b8f8928'),
(250, 3, 1, '988bb95176cccaae1870b88f09c2cc59'),
(251, 3, 1, '581b0ba2bbdf8439f1f6e7a9ac2003c8'),
(252, 6, 4, '581b0ba2bbdf8439f1f6e7a9ac2003c8'),
(253, 8, 1, '581b0ba2bbdf8439f1f6e7a9ac2003c8');

-- --------------------------------------------------------

--
-- Table structure for table `cookie`
--

CREATE TABLE IF NOT EXISTS `cookie` (
  `cookie_id` varchar(255) NOT NULL,
  `cookie_value` varchar(2024) NOT NULL,
  `id_user` int(10) DEFAULT NULL,
  `logged_In` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`cookie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cookie`
--

INSERT INTO `cookie` (`cookie_id`, `cookie_value`, `id_user`, `logged_In`) VALUES
('01f6c4d9e56561366ff26d671b8f8928', '{"item_Cookie_id":"01f6c4d9e56561366ff26d671b8f8928","0":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":2,"item_quantity":"1"},"1":{"item_id":"7","item_name":"Goole Pixel 3","item_price":"750.00","item_stock":-9,"item_quantity":"1"}}', 0, 0),
('1fedce4410a5a56ebe7728821101c38d', '{"item_Cookie_id":"1fedce4410a5a56ebe7728821101c38d","0":{"item_id":"2","item_name":"Apple IPhone XMax","item_price":"1050.00","item_stock":224,"item_quantity":"5"}}', 6, 0),
('2dd897ef6e04afb486ae51eb1861b3c0', '{"item_Cookie_id":"2dd897ef6e04afb486ae51eb1861b3c0","0":{"item_id":"2","item_name":"IPhone X","item_price":"1050.00","item_stock":237,"item_quantity":"1"}}', 7, 0),
('356a158be4d4c47a2bfdafd7d445699e', '{"item_Cookie_id":"356a158be4d4c47a2bfdafd7d445699e","1":{"item_id":"1","item_name":"Samsung Galaxy S9","item_price":"850.00","item_stock":30,"item_quantity":"4"}}', 8, 0),
('3ba0801b239e6920e74c00bf1c0f8399', '{"item_Cookie_id":"3ba0801b239e6920e74c00bf1c0f8399","0":{"item_id":"8","item_name":"LG G7","item_price":"500.00","item_stock":3,"item_quantity":"1"},"1":{"item_id":"7","item_name":"Goole Pixel 3","item_price":"750.00","item_stock":6,"item_quantity":"1"},"2":{"item_id":"2","item_name":"Apple IPhone XMax","item_price":"1050.00","item_stock":9,"item_quantity":"10"},"3":{"item_id":"4","item_name":"Iphone Xs","item_price":"1200.00","item_stock":8,"item_quantity":"1"}}', 0, 0),
('3dbf41bf9422b35df86547d2d253b685', '{"item_Cookie_id":"3dbf41bf9422b35df86547d2d253b685","0":{"item_id":"1","item_name":"Samsung Galaxy S9","item_price":"850.00","item_stock":24,"item_quantity":"6"}}', 5, 1),
('453161263f3d3e23209df8fc78b95928', '{"item_Cookie_id":"453161263f3d3e23209df8fc78b95928","0":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":3,"item_quantity":"1"}}', 0, 0),
('55edc9d67570587346e0e465ae34e003', '{"item_Cookie_id":"55edc9d67570587346e0e465ae34e003","0":{"item_id":"3","item_name":"Samsung Note 9","item_price":"900.00","item_stock":12,"item_quantity":"1"},"1":{"item_id":"8","item_name":"LG G7","item_price":"500.00","item_stock":5,"item_quantity":"1"}}', 0, 0),
('581b0ba2bbdf8439f1f6e7a9ac2003c8', '{"item_Cookie_id":"581b0ba2bbdf8439f1f6e7a9ac2003c8","0":{"item_id":"3","item_name":"Samsung Note 9","item_price":"900.00","item_stock":10,"item_quantity":"1"},"1":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":-2,"item_quantity":"4"},"2":{"item_id":"8","item_name":"LG G7","item_price":"500.00","item_stock":-6,"item_quantity":"1"}}', 0, 0),
('666b87caa648ef322fb7144443a46e2d', '{"item_Cookie_id":"666b87caa648ef322fb7144443a46e2d","0":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":5,"item_quantity":"1"},"1":{"item_id":"7","item_name":"Goole Pixel 3","item_price":"750.00","item_stock":-6,"item_quantity":"2"},"2":{"item_id":"8","item_name":"LG G7","item_price":"500.00","item_stock":-1,"item_quantity":"3"}}', 0, 0),
('7af912beadafe5e65c095733cb244c9b', '{"item_Cookie_id":"7af912beadafe5e65c095733cb244c9b","0":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":11,"item_quantity":"1"},"1":{"item_id":"7","item_name":"Goole Pixel 3","item_price":"750.00","item_stock":8,"item_quantity":"1"}}', 11, 0),
('7d7227b253fd8d7722e4de9bfe60b59c', '{"item_Cookie_id":"7d7227b253fd8d7722e4de9bfe60b59c","0":{"item_id":"5","item_name":"OnePlus 6T","item_price":"600.00","item_stock":19,"item_quantity":"1"},"1":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":13,"item_quantity":2}}', 8, 0),
('8199c1d12ffaca686bd8c6faf042c3cb', '{"item_Cookie_id":"8199c1d12ffaca686bd8c6faf042c3cb","0":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":3,"item_quantity":"1"},"1":{"item_id":"7","item_name":"Goole Pixel 3","item_price":"750.00","item_stock":-9,"item_quantity":"1"},"2":{"item_id":"4","item_name":"Iphone Xs","item_price":"1200.00","item_stock":8,"item_quantity":"1"},"3":{"item_id":"3","item_name":"Samsung Note 9","item_price":"900.00","item_stock":7,"item_quantity":"5"},"4":{"item_id":"1","item_name":"Samsung Galaxy S9","item_price":"850.00","item_stock":6,"item_quantity":"9"}}', 0, 0),
('988bb95176cccaae1870b88f09c2cc59', '{"item_Cookie_id":"988bb95176cccaae1870b88f09c2cc59","0":{"item_id":"3","item_name":"Samsung Note 9","item_price":"900.00","item_stock":11,"item_quantity":"1"}}', 0, 0),
('9bdb6042a9cc2d2b08496acc24bc4c90', '{"item_Cookie_id":"9bdb6042a9cc2d2b08496acc24bc4c90","0":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":8,"item_quantity":4},"1":{"item_id":"7","item_name":"Goole Pixel 3","item_price":"750.00","item_stock":0,"item_quantity":4}}', 0, 0),
('a39bebe3b59a925f19e514f42412dccf', '{"item_Cookie_id":"a39bebe3b59a925f19e514f42412dccf","0":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":10,"item_quantity":"1"},"1":{"item_id":"7","item_name":"Goole Pixel 3","item_price":"750.00","item_stock":2,"item_quantity":5},"2":{"item_id":"5","item_name":"OnePlus 6T","item_price":"600.00","item_stock":17,"item_quantity":"1"},"3":{"item_id":"8","item_name":"LG G7","item_price":"500.00","item_stock":3,"item_quantity":"1"}}', 0, 0),
('bd0ee681b2741ae4b4aaa498fca7df86', '{"item_Cookie_id":"bd0ee681b2741ae4b4aaa498fca7df86","0":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":6,"item_quantity":2},"1":{"item_id":"7","item_name":"Goole Pixel 3","item_price":"750.00","item_stock":-4,"item_quantity":"4"},"2":{"item_id":"8","item_name":"LG G7","item_price":"500.00","item_stock":2,"item_quantity":"1"}}', 0, 0),
('bd636e54ad49ef59180186820c778d56', '{"item_Cookie_id":"bd636e54ad49ef59180186820c778d56","0":{"item_id":"7","item_name":"Goole Pixel 3","item_price":"750.00","item_stock":7,"item_quantity":"1"},"1":{"item_id":"8","item_name":"LG G7","item_price":"500.00","item_stock":4,"item_quantity":"1"}}', 0, 0),
('bf136c8f1e469585c51a9c27077f0487', '{"item_Cookie_id":"bf136c8f1e469585c51a9c27077f0487","0":{"item_id":"2","item_name":"Apple IPhone XMax","item_price":"1050.00","item_stock":226,"item_quantity":"1"}}', 10, 0),
('e9070718de719736579122b6f364b3d5', '{"item_Cookie_id":"e9070718de719736579122b6f364b3d5","0":{"item_id":"6","item_name":"Huawei P20","item_price":"750.00","item_stock":4,"item_quantity":"1"},"1":{"item_id":"7","item_name":"Goole Pixel 3","item_price":"750.00","item_stock":-8,"item_quantity":"2"},"2":{"item_id":"8","item_name":"LG G7","item_price":"500.00","item_stock":-5,"item_quantity":4},"3":{"item_id":"1","item_name":"Samsung Galaxy S9","item_price":"850.00","item_stock":15,"item_quantity":"8"}}', 0, 0),
('f564229f3abe3bd97ef1facab3ce2ad5', '{"item_Cookie_id":"f564229f3abe3bd97ef1facab3ce2ad5","0":{"item_id":"3","item_name":"Samsung Note 9","item_price":"900.00","item_stock":13,"item_quantity":"1"},"1":{"item_id":"8","item_name":"LG G7","item_price":"500.00","item_stock":6,"item_quantity":"1"}}', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(10) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `item_price` double(10,2) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_stock` int(10) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_price`, `item_description`, `item_stock`, `item_image`) VALUES
(1, 'Samsung Galaxy S9', 850.00, 'Samsung is shining star and Galaxy S9 will be the next premium device which is on its way. S8 is still in action and scoring huge amount of profit for the company but things have to move on and Samsung Galaxy S9 will be the next flagship device that we ar', 15, 'S9.png'),
(2, 'Apple IPhone XMax', 1050.00, 'Apple brought twist in the iPhone X design and now for the lovers of this brand is going to watch a totally new design in their next product which is going to reveal very soon. Apple iPhone X is the speculated to be a gift of their 10th anniversary and it', 19, 'IphoneX.jpg'),
(3, 'Samsung Note 9', 900.00, '', 10, 'Samsung_note9.jpg'),
(4, 'Iphone Xs', 1200.00, '', 9, 'iphoneXs.jpg'),
(5, 'OnePlus 6T', 600.00, '', 17, 'one_plus_6t.jpg'),
(6, 'Huawei P20', 750.00, '', 12, 'huawei-p20.jpg'),
(7, 'Goole Pixel 3', 750.00, '', 19, 'google_pixel3.jpg'),
(8, 'LG G7', 500.00, '', 16, 'Lg_g7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orders_id` int(10) NOT NULL AUTO_INCREMENT,
  `orders_quantity` int(10) NOT NULL,
  `orders_price` double NOT NULL,
  `id_items` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `order_total_price` double NOT NULL,
  PRIMARY KEY (`orders_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `orders_quantity`, `orders_price`, `id_items`, `id_user`, `order_date`, `order_total_price`) VALUES
(3, 1, 1050, 2, 7, '0000-00-00', 1050),
(4, 4, 850, 1, 8, '0000-00-00', 3400),
(5, 3, 1050, 2, 8, '0000-00-00', 3150),
(6, 5, 1050, 2, 6, '0000-00-00', 5250),
(7, 6, 850, 1, 5, '0000-00-00', 5100),
(8, 1, 1050, 2, 10, '0000-00-00', 1050),
(9, 1, 750, 7, 11, '0000-00-00', 750),
(10, 1, 750, 6, 11, '0000-00-00', 750);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_address`, `user_email`, `user_password`, `user_username`) VALUES
(5, 'Muhammad Umar Shahid', 'steenbekerweg 2417', 'm.umar.shahid92@gmail.com', '$2y$10$BnYiLk5bzSulsAjY8k8iYODIaYEZzelrHGCTnNb/CXgfER9nBNMKW', 'omi'),
(6, 'aqib butt', 'steenbekerWeg 26b room # 33 , EOH, kiel germany', 'aqib@gmail.com', '$2y$10$XtFuC65SyWeeFfOC2GispeYTTSGbL.YtUROy9Tm76Onqj8hUtaEfm', 'aqib'),
(7, 'usman', 'steenbeker weg 10 , 24016 kie germany', 'usman@gmail.com', '$2y$10$KJtJhVKUSlCiy3GrEP2lp.7M44H7wtRSrdvOToHsDWz1hZFYCj3Ky', 'usman12'),
(8, 'niaz hussain', 'bremerskamp building 10, 24105 kiel germnay', 'niaz@gmail.com', '$2y$10$YhwG1kDX18Iv9KDgNc/v0OddUfhZJQf0DwmUjKoj4yZv62TlaeiJi', 'niaz12'),
(10, 'ayush jain', 'Somewhere in Berlin germany', 'ayush@gmail.com', '$2y$10$3MvPZgw.VRtnzNe8ie63ieEY9RHgdDvMgbNwZtx.duKHq3ymgJMB6', 'ayush'),
(11, 'haseeb iqbal', 'strasse , Munich Germany', 'haseeb@gmail.com', '$2y$10$/owD/zH09gyzXeKWs3nOCuXfM9gCtfU7ZBqXcawHf2/ERcVTs/.Z2', 'haseeb');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
