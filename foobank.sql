-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `foobank` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `foobank`;

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `balance` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `account_num` int(15) NOT NULL,
  PRIMARY KEY (`account_num`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `tan_numbers`;
CREATE TABLE `tan_numbers` (
  `user_id` int(10) unsigned NOT NULL,
  `seq_number` int(10) unsigned NOT NULL,
  `tan` int(15) unsigned NOT NULL,
  `expiry_date` datetime NOT NULL,
  `expired` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`tan`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tan_numbers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `user_id` int(10) unsigned NOT NULL,
  `source_account` int(15) NOT NULL,
  `destination_account` int(15) NOT NULL,
  `amount` float unsigned NOT NULL,
  `creation_date` datetime NOT NULL,
  `is_approved` tinyint(4) DEFAULT NULL,
  `approval_date` datetime DEFAULT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`transaction_id`),
  KEY `user_id` (`user_id`),
  KEY `source_account` (`source_account`),
  KEY `destination_account` (`destination_account`),
  KEY `approved_by` (`approved_by`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`source_account`) REFERENCES `accounts` (`account_num`),
  CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`destination_account`) REFERENCES `accounts` (`account_num`),
  CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`approved_by`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `fullname` varchar(30) NOT NULL,
  `activation_date` datetime DEFAULT NULL,
  `registration_date` datetime NOT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `role` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2014-10-18 09:12:10
