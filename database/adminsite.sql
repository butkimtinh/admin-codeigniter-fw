-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2015 at 02:47 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adminsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `menucategory`
--

CREATE TABLE IF NOT EXISTS `menucategory` (
`id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(250) NOT NULL,
  `module` varchar(200) NOT NULL,
  `ordered` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menucategory`
--

INSERT INTO `menucategory` (`id`, `icon`, `title`, `description`, `link`, `module`, `ordered`, `published`) VALUES
(8, 'icon-list-ol', 'Systems', '', '', 'user', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menuitem`
--

CREATE TABLE IF NOT EXISTS `menuitem` (
`id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `descriptions` text NOT NULL,
  `link` varchar(250) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `ordered` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menuitem`
--

INSERT INTO `menuitem` (`id`, `parent_id`, `title`, `descriptions`, `link`, `icon`, `ordered`, `published`) VALUES
(2, 55, 'Menu Items', '', 'menuitem', '0', 2, 1),
(6, 55, 'User', '', 'user', '0', 3, 1),
(54, 55, 'User Group', '', 'user_group', '0', 4, 1),
(55, 0, 'Systems', '', '', 'icon-cog', 0, 1),
(56, 0, 'Directory', '', '', 'icon-book', 3, 1),
(57, 0, 'Competition', '', '', 'icon-ticket', 5, 1),
(58, 0, 'Banners', '', '', 'icon-banner', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `createdate` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `usergroup_id` int(11) DEFAULT NULL,
  `updatetime` datetime DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `username`, `password`, `address`, `phone`, `facebook`, `gender`, `birthday`, `createdate`, `description`, `usergroup_id`, `updatetime`, `published`) VALUES
(1, 'Hoàng Quốc Vũ', 'quocvu88@gmail.com', 'quocvu88', 'ef5e76be6ca373f8c72cbfbe626cf82a', NULL, '0906787335', 'quocvu88', 'Male', '0000-00-00', '2014-11-01', '', 1, '2015-03-02 09:44:31', 1),
(2, 'admin', 'admin@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `canview` text NOT NULL,
  `canedit` text NOT NULL,
  `note` text NOT NULL,
  `ordered` int(11) NOT NULL,
  `published` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usergroup`
--

INSERT INTO `usergroup` (`id`, `title`, `canview`, `canedit`, `note`, `ordered`, `published`) VALUES
(1, 'Administrator', 'dashboard,donhang,menucategory,menuitem,nhomsanpham,sanpham,tablestatus,user,usergroup', 'dashboard,donhang,menucategory,menuitem,nhomsanpham,sanpham,tablestatus,upload,user,usergroup', 'Admin Group: Manage all website', 1, 1),
(2, 'Quản trị', 'dashboard,donhang,sanpham', 'donhang,sanpham,user', 'Quản trị sản phẩm, hóa đơn', 2, 1),
(5, 'Khách hàng', '0', '0', '', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menucategory`
--
ALTER TABLE `menucategory`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `menuitem`
--
ALTER TABLE `menuitem`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usergroup`
--
ALTER TABLE `usergroup`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menucategory`
--
ALTER TABLE `menucategory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `menuitem`
--
ALTER TABLE `menuitem`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usergroup`
--
ALTER TABLE `usergroup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
