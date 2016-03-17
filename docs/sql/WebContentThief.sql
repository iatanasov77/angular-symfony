-- phpMyAdmin SQL Dump
-- version 4.4.15.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 17, 2016 at 10:18 AM
-- Server version: 10.0.22-MariaDB
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `VsWebContentThief`
--

-- --------------------------------------------------------

--
-- Table structure for table `ContactPhones`
--

CREATE TABLE IF NOT EXISTS `ContactPhones` (
  `id` int(11) NOT NULL,
  `phoneNumber` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `contactsId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Contacts`
--

CREATE TABLE IF NOT EXISTS `Contacts` (
  `id` int(11) NOT NULL,
  `firstName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ext_translations`
--

CREATE TABLE IF NOT EXISTS `ext_translations` (
  `id` int(11) NOT NULL,
  `locale` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Languages`
--

CREATE TABLE IF NOT EXISTS `Languages` (
  `id` int(11) NOT NULL,
  `alias` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Pages`
--

CREATE TABLE IF NOT EXISTS `Pages` (
  `id` int(11) NOT NULL,
  `alias` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sg_translation_entry`
--

CREATE TABLE IF NOT EXISTS `sg_translation_entry` (
  `id` int(11) NOT NULL,
  `domain` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `format` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sg_translation_locale`
--

CREATE TABLE IF NOT EXISTS `sg_translation_locale` (
  `id` int(11) NOT NULL,
  `language` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sg_translation_value`
--

CREATE TABLE IF NOT EXISTS `sg_translation_value` (
  `id` int(11) NOT NULL,
  `entry_id` int(11) DEFAULT NULL,
  `locale_id` int(11) DEFAULT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `WCT_ProjectFieldAds`
--

CREATE TABLE IF NOT EXISTS `WCT_ProjectFieldAds` (
  `id` int(11) unsigned NOT NULL,
  `projectId` int(4) unsigned NOT NULL,
  `fieldTitle` varchar(256) COLLATE utf8_bin NOT NULL,
  `xquery` varchar(256) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `WCT_ProjectFieldAdsPicture`
--

CREATE TABLE IF NOT EXISTS `WCT_ProjectFieldAdsPicture` (
  `id` int(11) unsigned NOT NULL,
  `projectId` int(4) unsigned NOT NULL,
  `xquery` varchar(128) COLLATE utf8_bin NOT NULL,
  `regex` varchar(128) COLLATE utf8_bin NOT NULL,
  `replace` varchar(45) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `WCT_ProjectFields`
--

CREATE TABLE IF NOT EXISTS `WCT_ProjectFields` (
  `id` int(11) unsigned NOT NULL,
  `projectId` int(4) unsigned NOT NULL,
  `fieldTitle` varchar(256) COLLATE utf8_bin NOT NULL,
  `xquery` varchar(256) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `WCT_Projects`
--

CREATE TABLE IF NOT EXISTS `WCT_Projects` (
  `id` int(4) unsigned NOT NULL,
  `url` varchar(128) COLLATE utf8_bin NOT NULL,
  `categoryId` int(4) DEFAULT NULL,
  `userId` int(4) DEFAULT NULL,
  `projectTitle` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `nopic` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `pictureCropTop` tinyint(3) unsigned DEFAULT NULL,
  `pictureCropRight` tinyint(3) unsigned DEFAULT NULL,
  `pictureCropBottom` tinyint(3) unsigned DEFAULT NULL,
  `pictureCropLeft` tinyint(3) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ContactPhones`
--
ALTER TABLE `ContactPhones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F0E89CA54372BE6C` (`contactsId`);

--
-- Indexes for table `Contacts`
--
ALTER TABLE `Contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ext_translations`
--
ALTER TABLE `ext_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  ADD KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`);

--
-- Indexes for table `Languages`
--
ALTER TABLE `Languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Pages`
--
ALTER TABLE `Pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sg_translation_entry`
--
ALTER TABLE `sg_translation_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sg_translation_locale`
--
ALTER TABLE `sg_translation_locale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sg_translation_value`
--
ALTER TABLE `sg_translation_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9F35D5FEBA364942` (`entry_id`),
  ADD KEY `IDX_9F35D5FEE559DFD1` (`locale_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D5428AED92FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_D5428AEDA0D96FBF` (`email_canonical`);

--
-- Indexes for table `WCT_ProjectFieldAds`
--
ALTER TABLE `WCT_ProjectFieldAds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `WCT_ProjectFieldAdsPicture`
--
ALTER TABLE `WCT_ProjectFieldAdsPicture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `WCT_ProjectFields`
--
ALTER TABLE `WCT_ProjectFields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `WCT_Projects`
--
ALTER TABLE `WCT_Projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url_UNIQUE` (`url`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ContactPhones`
--
ALTER TABLE `ContactPhones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Contacts`
--
ALTER TABLE `Contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ext_translations`
--
ALTER TABLE `ext_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Languages`
--
ALTER TABLE `Languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Pages`
--
ALTER TABLE `Pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sg_translation_entry`
--
ALTER TABLE `sg_translation_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sg_translation_locale`
--
ALTER TABLE `sg_translation_locale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sg_translation_value`
--
ALTER TABLE `sg_translation_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ContactPhones`
--
ALTER TABLE `ContactPhones`
  ADD CONSTRAINT `FK_F0E89CA54372BE6C` FOREIGN KEY (`contactsId`) REFERENCES `Contacts` (`id`);

--
-- Constraints for table `sg_translation_value`
--
ALTER TABLE `sg_translation_value`
  ADD CONSTRAINT `FK_9F35D5FEBA364942` FOREIGN KEY (`entry_id`) REFERENCES `sg_translation_entry` (`id`),
  ADD CONSTRAINT `FK_9F35D5FEE559DFD1` FOREIGN KEY (`locale_id`) REFERENCES `sg_translation_locale` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

