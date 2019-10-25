-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2019 at 04:17 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pithaahut`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `address` varchar(256) NOT NULL,
  `city` varchar(64) NOT NULL,
  `state_province` char(32) NOT NULL,
  `postal_code` char(10) NOT NULL,
  `country` char(20) NOT NULL,
  `phone` char(16) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Customers';

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `user_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(256) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `address` varchar(256) NOT NULL,
  `city` varchar(64) NOT NULL,
  `state_province` char(32) NOT NULL,
  `postal_code` char(10) NOT NULL,
  `country` char(20) NOT NULL,
  `phone` char(16) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(16) NOT NULL,
  `role` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Customers';

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`user_id`, `name`, `address`, `city`, `state_province`, `postal_code`, `country`, `phone`, `balance`, `email`, `password`, `role`) VALUES
(00000001, 'khamari vai', 'dfdf', 'gvedfe', 'dfveefr', '1050', 'gre', '14547812', '548.54', 'dsfjkf@gk.com', '12345', 'user'),
(00000002, 'khamari vai', 'dfdf', 'gvedfe', 'dfveefr', '1050', 'Ind', '14547812', '548.54', 'dsfj784kf@gk.com', '12345', 'user'),
(00000003, 'zobayer', 'fdfdf', 'kfjdkj', 'dfdfdf', '5451', 'Ban', '45545445', '654.54', 'fgsf@gk.com', '123456', 'user'),
(00000004, 'zobayer', 'dff', 'fdf', 'dfd', '541', 'Bangladesh', '45545445', '8745.50', 'dfd@gm.co', '123456', 'user'),
(00000005, 'Sujit Mandal', 'address', 'city', 'city', 'postcode', 'country', '45656', '45.45', 'df58k@gmail.com', '123456', 'user'),
(00000006, 'Tonmoy Talukdar', 'Bagerhaat', 'Khulnaa', 'Khulnaa', '852', 'Bangladesh', '01854554', '10.00', 'tonmoy@gmail.com', '123456', 'user'),
(00000007, 'Zobayer Mahmud', '107/57 Rasulbagh', 'Narayanganj', 'Narayanganj', '1430', 'Bangladesh', '01676297698', '4.90', 'zobayer94@gmail.com', '123456', 'admin'),
(00000008, 'Sadia Parvin', 'Mugdha', 'Dhaka', 'Dhaka', '1056', 'Bangladesh', '0254545545', '52.60', 'sadia@gmail.com', '123456', 'user'),
(00000010, 'Sujit Mandal', 'Pirojpur', 'Barishal', 'Barishal', '1420', 'Bangladesh', '01676297698', '500.60', 'sujit@gmail.com', '123456', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `paymentreceive`
--

CREATE TABLE `paymentreceive` (
  `transaction_id` varchar(30) NOT NULL,
  `method` varchar(15) NOT NULL,
  `amount` double NOT NULL,
  `dateTime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `sku` char(16) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(4096) DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `special` int(1) NOT NULL DEFAULT '0' COMMENT '1 = on special; 0 = normal',
  `link` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Products';

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `sku`, `title`, `description`, `price`, `special`, `link`) VALUES
(00000001, 'MB000', 'Mohan Bhog', 'A favorite with lovers of traditional Bengali sweets, Mohan Bhog is a semolina-based sweet dish. Found in various shapes and sizes, this rich and delicious sugary sweet is a fabulous treat for various occasions!\r\n\r\n', '0.10', 0, '00000001'),
(00000002, ' LL2000', 'Lobongo Latika', 'A sweet for any and every occasion, Lobongo Latika is a crowd favourite. Maida, khoya, nutmeg powder, coconut (grated), ghee, nuts, raisins, cardamom, cloves and sugar blend beautifully to bring forth this heavenly traditional sweetmeat. The striking feature is how the pastry is well folded and sealed with a clove. \r\n', '0.20', 0, '00000002'),
(00000003, ' R3000', 'Roshogulla', 'These spongy-soft round mishtis, soaked in sugar syrup, have become an icon of Bengali cuisine. One does not simply say no to rasgullas!', '0.30', 0, '00000003'),
(00000004, ' BD4000', 'Bhapa Doi', 'Bhapa Doi is made by blending yogurt and condensed milk. It becomes more tasteful with the garnishing of almonds and pistachios. It is best enjoyed chilled straight out of the refrigerator.\r\n\r\n', '0.40', 1, '00000004'),
(00000005, ' MCC5000', 'Malai Chom Chom', 'A lovely golden brown hue and a rich dense texture make Malai Chom Chom an unforgettable rendezvous. Made with chenna with slight hint of kesar, it is best served chilled. No celebration is complete without this!\r\n', '0.50', 0, '00000005'),
(00000006, ' NGP6000', 'Nolen Gurer Payesh', 'Nolen Gurer Payesh is a winter delicacy for the Bengalis. It is made with milk, rice and special \'gur\' which is available during winters only. This dish is mastered with the richness of jaggery and loads of stirring while you cook! \r\n', '0.60', 0, '00000006'),
(00000007, ' P7000', 'Pantuwa', 'Pantuwa is a one-of-a-kind traditional sweet that Bongs swear by. These deep brown sweet balls look hard from outside but are very soft from inside. They are deep fried which gives them such a heartwarming rich color! \r\n', '0.70', 1, '00000007'),
(00000008, ' PS8000', 'Pati Shapta', 'Pati Shapta is prepared with a filling of coconut and jaggery, along with a thin crepe made of maida, sooji and rice flour. You can serve it hot or cold. These will melt in your mouth and fill your soul with a happy feeling. \r\n', '0.80', 0, '00000008'),
(00000009, ' RB9000', 'Raj Bhog', 'The lip-smacking Raj Bhog is stuffed with dry fruits and made just like spongy Rasgullas. These yellow spongy soft balls flavoured and coloured with kesar will take you on a trip to heaven!\r\n\r\n', '0.90', 0, '00000009'),
(00000010, ' CJ10000', 'Chanar Jeelapi', 'Made of paneer, khoya and maida, Chanar Jeelapi is another sumptuous dessert which is a must try. Sink your teeth into these juicy delights and you\'ll understand what love feels like! ', '1.00', 0, '00000010'),
(00000011, ' KJ11000', 'Kalo Jaam', 'Kalo Jaam or Kala Jamun is Gulab Jamun\'s younger sibling. Made of paneer and khoya, Bengalis have grown up eating it and it can be easily made at home.', '1.10', 1, '00000011'),
(00000012, ' D12000', 'Darbesh', 'Bengali style Boondi Ladoos are called Darbesh. They are prepared in a lot of Bengali households and enjoyed by all.', '1.20', 0, '00000012'),
(00000013, ' P13000', 'Payesh', 'A popular dessert recipe for festive occasions, Payesh is Bengal\'s equivalent for Kheer. Garnished with with nuts and pistachios, Payesh is an all season favorite for all Bongs! \r\n', '1.30', 1, '00000013'),
(00000014, ' SB14000', ' Shor Bhaja', 'Shor Bhaja or Sar Bhaja is a deep-fried sweet dish purely made of milk cream. Its preparation is a tedious process but the final result id absolutely worth the effort. Foodgasm guaranteed! \r\n\r\n', '1.40', 1, '00000014'),
(00000015, ' LK15000', 'Lady Kenny', ' Lady Kenny popularly known as Langcha is different from Pantuwa and is stuffed with raisin and coated in castor sugar. These chenna balls are named after Lady Charolette Canning, wife of Lord Charles John Canning. She tasted this sweet in Bengal and it remained her favourite for the rest of her life.\r\n\r\n', '1.50', 0, '00000015'),
(00000016, ' KK16000', 'Kheer Kadam', 'An exotic Bengali sweet, made of mini rasgullas, grated khoya and powdered sugar. It is also known as Raskadam and has two layers of dessert heaven. \r\n\r\n', '1.60', 1, '00000016'),
(00000017, ' N17000', 'Nikuti', 'Chenna, flour, ghee and cardamom are kneaded together and deep-fried as oblong balls. After keeping them immersed in sugar syrup for few hours, dip them in condensed milk and savour after chilling. Happiness. \r\n', '1.70', 1, '00000017'),
(00000018, ' SB18000', 'Sita Bhog', 'Sita Bhog is yet another Bangla sweet, which has mass appeal all over India. This milk based dish resembles rice Vermicelli served with small Gulab Jamuns! \r\n', '1.80', 1, '00000018'),
(00000019, ' KC19000', 'Khirer Chop', 'Kheer stuffed chop, lightly tossed in sugar syrup is a wonderful way to make any occassion special. Flour, sooji, nutmeg, milk, sugar and bread combine into a mishti that is truly out of this world. It might take a while to prepare, but love\'s labour will not be lost with this mouth-watering sweet.\r\n', '1.90', 1, '00000019'),
(00000020, ' MD20000', 'Mishti Doi', 'Finally, this list could not have been complete without a mention of the very quintessential Bengali Mishti Doi. This light and sweet blend of milk, yogurt and coarse brown sugar, left to ferment overnight, marks all celebrations and auspicious occasions. The delicate sweetness of this elegant dessert will make your taste buds go \'Hallelujah!\'', '2.00', 0, '00000020'),
(00000024, 't12', 'title12', 'bla bla', '1.50', 1, NULL),
(00000025, 'T13', 'title13', 'bla bla', '1.85', 0, NULL),
(00000026, 't14', 'test14', 'bla bal', '5.80', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(8) UNSIGNED ZEROFILL NOT NULL,
  `transaction` char(8) NOT NULL,
  `product_id` int(8) UNSIGNED ZEROFILL NOT NULL COMMENT 'Foreign Key',
  `user_id` int(8) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'can be NULL: we allow guest users to make a purchase',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quantity` int(6) NOT NULL,
  `sale_price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User Purchases';

-- --------------------------------------------------------

--
-- Table structure for table `rechargebyuser`
--

CREATE TABLE `rechargebyuser` (
  `user_id` varchar(30) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `method` varchar(15) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL,
  `transaction_id` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_login` (`email`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `password_lookup` (`password`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_login` (`email`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `password_lookup` (`password`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `transaction` (`transaction`);

--
-- Indexes for table `rechargebyuser`
--
ALTER TABLE `rechargebyuser`
  ADD UNIQUE KEY `transaction_id` (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `user_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(8) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
