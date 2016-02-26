-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 26, 2016 at 04:35 PM
-- Server version: 5.5.41-log
-- PHP Version: 5.6.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wine`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
`ad_ID` int(11) NOT NULL,
  `ad_name` varchar(200) NOT NULL,
  `ad_description` varchar(255) NOT NULL,
  `ad_image` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ad_ID`, `ad_name`, `ad_description`, `ad_image`, `status`, `created_date`) VALUES
(10, 'A new AD', 'What you can think', 'product9.jpg', 'Active', '2015-12-14 01:27:52'),
(12, 'my new laptop', 'A cool description', 'product.jpg', 'Active', '2015-12-28 10:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
`brandID` int(11) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `brand_image` varchar(255) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandID`, `brand_name`, `brand_image`, `status`) VALUES
(2, 'Beringer', 'Beringer.jpg', 'Active'),
(4, 'Robert Mondavi', 'RobertMondavi.jpg', 'Active'),
(5, 'Sutter Home', 'SutterHome.jpg', 'Active'),
(6, 'Yellow Tail', 'YellowTail.jpg', 'Active'),
(7, 'Concha y Toro', 'ConchayToro.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
`cartID` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `session_id` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `created_date`, `session_id`) VALUES
(59, '2016-01-19 00:00:00', 'fc068v6ubdfdbacq30a34ra8u7'),
(60, '2016-01-22 00:00:00', 'j8hvp9g3qc7pte5p0tra2h6ph1'),
(61, '2016-01-22 00:00:00', 'ot0bbcgkfq7rm6gn5v1g6pbu71'),
(62, '2016-01-22 00:00:00', '7slkflk0qp305p21ofiprort20'),
(63, '2016-01-23 00:00:00', '2mhskjfeatbmbrlkt0s2gg6ek0'),
(64, '2016-01-23 00:00:00', '3aml2k250gloi0s0kmcc477bn6'),
(65, '2016-02-26 00:00:00', '4tfpf5cmeuaq1u6klp6emcpap0');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE IF NOT EXISTS `cart_item` (
`itemID` int(11) NOT NULL,
  `cartID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` float NOT NULL,
  `discount` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=171 ;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`itemID`, `cartID`, `product_ID`, `price`, `quantity`, `discount`) VALUES
(143, 59, 21, 111, 2, 0),
(144, 59, 22, 234, 2, 0),
(145, 59, 23, 234, 2, 0),
(158, 60, 21, 111, 2, 0),
(159, 60, 22, 234, 2, 0),
(160, 60, 23, 234, 2, 0),
(161, 60, 24, 111, 1, 0),
(162, 60, 26, 222, 1, 0),
(163, 63, 21, 111, 1, 0),
(164, 63, 22, 234, 2, 0),
(165, 63, 23, 234, 1, 0),
(166, 63, 24, 111, 1, 0),
(167, 63, 29, 300, 1, 0),
(170, 65, 45, 111, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`categoryID` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `status` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `category_name`, `status`, `created_date`) VALUES
(10, 'Red Wine', 'Active', '2016-02-26 12:51:16'),
(26, 'White Wine', 'Active', '2016-02-26 12:51:29'),
(28, 'Premium Wine', 'Active', '2016-02-26 12:51:42'),
(29, 'Monitor', 'Active', '2015-12-01 07:33:55'),
(32, 'Appliances', 'Active', '2015-12-01 07:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
`chatID` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chatID`, `sender`, `reciever`, `created_date`) VALUES
(8, 16, 20, '2016-01-22 06:03:46'),
(9, 16, 19, '2016-01-22 06:08:14'),
(10, 16, 18, '2016-01-22 06:08:28'),
(11, 16, 17, '2016-01-22 06:08:31'),
(12, 21, 17, '2016-01-23 03:00:46'),
(13, 17, 18, '2016-01-23 03:02:31'),
(14, 17, 19, '2016-01-23 03:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`commentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `userID`, `productID`, `comment`, `created_date`) VALUES
(3, 17, 42, 'A very Good product', '2016-01-10 08:46:16'),
(4, 17, 42, 'i have use it ', '2016-01-10 08:46:39'),
(5, 17, 42, 'its too good', '2016-01-10 08:46:48'),
(6, 17, 42, 'good very good good very good good very good good very good good very good good very good good very good\n', '2016-01-10 08:48:57'),
(7, 17, 21, ' I like this product very much', '2016-01-10 14:42:35'),
(18, 16, 21, ' This product is awesome', '2016-01-10 14:46:31'),
(19, 17, 22, 'I like this product very much', '2016-01-11 09:36:22'),
(20, 20, 21, 'i think its useful\n', '2016-01-13 16:42:23'),
(37, 17, 31, 'good', '2016-01-13 17:21:15');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`messageID` int(11) NOT NULL,
  `chatID` int(11) NOT NULL,
  `message` text NOT NULL,
  `userID` int(11) NOT NULL,
  `sent_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=146 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `chatID`, `message`, `userID`, `sent_date`) VALUES
(130, 0, 'hi', 16, '2016-01-22 06:05:17'),
(131, 8, 'hi', 16, '2016-01-22 06:07:21'),
(132, 8, 'hi', 16, '2016-01-22 06:07:42'),
(133, 8, 'hello', 16, '2016-01-22 06:07:45'),
(134, 0, 'hello', 16, '2016-01-22 06:08:17'),
(135, 8, 'hello', 16, '2016-01-22 06:09:34'),
(136, 8, 'hello', 16, '2016-01-22 06:09:42'),
(137, 9, 'hello', 16, '2016-01-22 06:09:53'),
(138, 11, 'hello', 16, '2016-01-22 06:10:44'),
(139, 11, 'hello', 16, '2016-01-22 06:12:36'),
(140, 11, 'hi', 16, '2016-01-22 06:12:39'),
(141, 12, 'Hi', 17, '2016-01-23 03:01:21'),
(142, 12, 'Hi', 17, '2016-01-23 03:01:24'),
(143, 12, 'Hi', 17, '2016-01-23 03:01:49'),
(144, 12, 'Hello', 21, '2016-01-23 03:01:59'),
(145, 12, 'Good', 21, '2016-01-23 03:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`orderID` int(11) NOT NULL,
  `cartID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `ordered_date` datetime NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `cartID`, `userID`, `ordered_date`, `status`) VALUES
(1, 63, 21, '2016-01-23 11:06:02', 'Cleared');

-- --------------------------------------------------------

--
-- Table structure for table `pimages`
--

CREATE TABLE IF NOT EXISTS `pimages` (
`image_id` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `img1` varchar(200) NOT NULL,
  `img2` varchar(200) NOT NULL,
  `img3` varchar(200) NOT NULL,
  `img4` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_subtitle` varchar(255) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_title`, `post_subtitle`, `post_image`, `created_date`) VALUES
(33, 16, 'Saad1', 'Fox jumps over the lazy dog', 'photos.png', '2015-12-11 08:38:33'),
(34, 16, 'An example post', 'Fox jumps over the lazy dog', 'cover.jpg', '2015-12-11 09:10:33'),
(36, 18, 'My first post', 'A littile subtitle', 'cover1.jpg', '2015-12-17 11:30:01'),
(42, 23, 'Saad', 'saasa', 'A8RXKCBCA3R1ADACAN2J1G1CAKBHYF8CA6FV0SUCABE2GP3CAFPNCO5CANENCQSCAW6J9IJCAMY7MQ6CAV17BS4CA1WEEC4CAXL8536CA886JNXCAQ900K1CAGM6CFCCAHFFXJOCADTZZQYCAC2MI3OCA43R3MO.jpg', '2015-12-30 11:34:56'),
(43, 17, 'Saad First', 'Post to check', 'logo.gif', '2016-01-01 08:25:37'),
(44, 17, 'sasasa', 'sasass', '2.jpg', '2016-01-07 02:50:01'),
(47, 19, 'Abdullah First POST', 'Subtitle', '2.jpg', '2016-01-08 09:27:32'),
(48, 16, 'Hi a new Post', 'just kidding', '2.jpg', '2016-01-08 09:34:12'),
(50, 22, 'mat003', 'mat003', '2.jpg', '2016-01-22 01:48:38'),
(54, 0, '', '', '', '2016-01-23 11:47:33'),
(55, 0, '', '', '', '2016-01-23 11:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`product_ID` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_info` text NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_discount` varchar(50) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_status` text NOT NULL,
  `created_date` datetime NOT NULL,
  `view_count` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_ID`, `product_name`, `product_info`, `product_price`, `product_image`, `product_discount`, `product_category`, `product_brand`, `product_status`, `created_date`, `view_count`) VALUES
(21, 'Dell Laptop', 'Optiplex 755', '111', 'product1.jpg', '7%', 'Laptop', 'Dell', 'Active', '2015-12-02 05:42:43', 80),
(45, 'Wine', 'Red Wine', '111', 'red-wine.jpg', '', 'Red Wine', '', 'Active', '2016-02-26 12:54:57', 0),
(46, 'Wine', 'White Wine', '234', 'feature_wine.jpg', '', 'White Wine', 'Beringer', 'Active', '2016-02-26 12:59:47', 0),
(47, 'Wine', 'Rose', '234', 'c03391zf.jpg', '', 'Premium Wine', 'Yellow Tail', 'Active', '2016-02-26 01:00:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`userID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `about` text NOT NULL,
  `register_date` datetime NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `first_name`, `last_name`, `username`, `email`, `password`, `date_of_birth`, `profile_image`, `gender`, `education`, `country`, `city`, `zip_code`, `about`, `register_date`, `status`) VALUES
(17, 'aaa', 'test', 'aydan', 'aydan.aleydin@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1993-03-25', 'user.png', 'male', 'BSCS', 'UK', 'London', '2355', 'Test is test', '1999-10-07 00:00:00', 'online'),
(18, 'test', 'aa', 'user', 'saadsaad@saad.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2015-03-25', 'admin.png', 'Male', 'BSCS', 'UK', 'London', '5843', 'Just another test', '0000-00-00 00:00:00', 'online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
 ADD PRIMARY KEY (`ad_ID`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
 ADD PRIMARY KEY (`brandID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`cartID`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
 ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
 ADD PRIMARY KEY (`chatID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `pimages`
--
ALTER TABLE `pimages`
 ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
MODIFY `ad_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
MODIFY `brandID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=171;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
MODIFY `chatID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pimages`
--
ALTER TABLE `pimages`
MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
