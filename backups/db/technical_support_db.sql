-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2013 at 08:27 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `technical_support_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE IF NOT EXISTS `admin_details` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`admin_id`, `admin_name`, `admin_password`, `admin_status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `advice_feedback_details`
--

CREATE TABLE IF NOT EXISTS `advice_feedback_details` (
  `advice_feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `advice_id` int(11) DEFAULT NULL,
  `token_value` varchar(255) DEFAULT NULL,
  `star_value` int(11) DEFAULT NULL,
  `feedback_comment` longtext,
  `expert_read` enum('yes','no') DEFAULT 'no',
  `feedback_datetime` varchar(255) NOT NULL,
  PRIMARY KEY (`advice_feedback_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `advice_feedback_details`
--

INSERT INTO `advice_feedback_details` (`advice_feedback_id`, `advice_id`, `token_value`, `star_value`, `feedback_comment`, `expert_read`, `feedback_datetime`) VALUES
(1, 1, '77888', 4, 'This is sample', 'yes', '1360332366'),
(2, 2, '85571', 3, 'This is sample', 'no', '1360332347'),
(3, 3, '69180', 5, 'This is sample Comment', 'yes', '1360332438');

-- --------------------------------------------------------

--
-- Table structure for table `advice_payment_details`
--

CREATE TABLE IF NOT EXISTS `advice_payment_details` (
  `advice_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `advice_request_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `corelation_id` varchar(255) NOT NULL,
  `payment_by` enum('credit card','express') NOT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `paid_datetime` varchar(255) DEFAULT NULL,
  `paid_by` varchar(255) DEFAULT NULL,
  `paid_status` enum('incomplete','complete') DEFAULT 'complete',
  PRIMARY KEY (`advice_payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `advice_payment_details`
--

INSERT INTO `advice_payment_details` (`advice_payment_id`, `advice_request_id`, `transaction_id`, `corelation_id`, `payment_by`, `paid_amount`, `paid_datetime`, `paid_by`, `paid_status`) VALUES
(1, 1, '5TH26985NW449264V', '5d4936d74e0aa', 'credit card', '4.99', '1360331953', NULL, 'complete'),
(2, 2, '53L07814F5256631M', 'e418128df8e7', 'express', '4.99', '1360332140', NULL, 'complete'),
(3, 3, '9JK94993J5881523K', 'b5fedb2f5adf9', 'express', '4.99', '1360332245', NULL, 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `advice_request_details`
--

CREATE TABLE IF NOT EXISTS `advice_request_details` (
  `advice_request_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(255) DEFAULT NULL,
  `user_email_address` varchar(255) DEFAULT NULL,
  `user_address` text,
  `user_phone_number` bigint(11) DEFAULT NULL,
  `expert_id` int(11) DEFAULT NULL,
  `user_comments` text NOT NULL,
  `advice_request_status` enum('open','called','paid_for') DEFAULT 'open',
  `advice_request_payment_status` enum('incomplete','complete') DEFAULT 'incomplete',
  `advice_request_datetime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`advice_request_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `advice_request_details`
--

INSERT INTO `advice_request_details` (`advice_request_id`, `user_fullname`, `user_email_address`, `user_address`, `user_phone_number`, `expert_id`, `user_comments`, `advice_request_status`, `advice_request_payment_status`, `advice_request_datetime`) VALUES
(1, 'nikita parmar', 'write2champ@gmail.com', NULL, 9971947719, 2, 'This is the sample comment', 'called', 'complete', '1360331884'),
(2, 'Alankrita', 'write2champ@gmail.com', NULL, 9971947719, 2, 'This is the sample comments', 'called', 'complete', '1360332085'),
(3, 'Gaurav Sinha', 'write2champ@gmail.com', NULL, 9971947719, 1, 'Tis isfsdafs', 'called', 'complete', '1360332200');

-- --------------------------------------------------------

--
-- Table structure for table `amount_due_details`
--

CREATE TABLE IF NOT EXISTS `amount_due_details` (
  `amount_due_id` int(11) NOT NULL AUTO_INCREMENT,
  `expert_id` int(11) DEFAULT NULL,
  `amount_due_value` varchar(255) DEFAULT NULL,
  `last_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`amount_due_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `amount_due_details`
--

INSERT INTO `amount_due_details` (`amount_due_id`, `expert_id`, `amount_due_value`, `last_date`) VALUES
(1, 1, '0', '2013-02-08 09:12:01'),
(2, 2, '0', '2013-02-08 09:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `app_setting_details`
--

CREATE TABLE IF NOT EXISTS `app_setting_details` (
  `app_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_setting_name` varchar(255) DEFAULT NULL,
  `app_setting_value` longtext,
  PRIMARY KEY (`app_setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `app_setting_details`
--

INSERT INTO `app_setting_details` (`app_setting_id`, `app_setting_name`, `app_setting_value`) VALUES
(1, 'customer_transaction_amount', '4.99'),
(2, 'amount_to_expert', '3.52'),
(3, 'signup_page_content', '<p style="text-align: center;"><img src="http://s9.postimage.org/hjlp5kg3j/signup_banner.jpg" alt="" /><strong>This is the sample content for the Signup Page</strong></p>');

-- --------------------------------------------------------

--
-- Table structure for table `email_template_details`
--

CREATE TABLE IF NOT EXISTS `email_template_details` (
  `email_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_template_name` varchar(255) DEFAULT NULL,
  `email_template_content` longtext,
  `email_template_subject` text NOT NULL,
  `email_template_description` text,
  `email_template_datetime` varchar(255) DEFAULT NULL,
  `email_template_status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`email_template_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `email_template_details`
--

INSERT INTO `email_template_details` (`email_template_id`, `email_template_name`, `email_template_content`, `email_template_subject`, `email_template_description`, `email_template_datetime`, `email_template_status`) VALUES
(1, 'registration', '<div style="border: 8px #FF9900 solid; width: 600px; height: auto; border-radius: 10px; padding: 10px;">\r\n<div style="border-bottom: 1px #CCCCCC inset; padding: 10px;" align="left"><img src="http://techsupport.saaninfotech.com/application/views/theme/saan_template/images/logo.png" alt="" width="275" height="76" /></div>\r\n<div style="margin-top: 10px;">\r\n<div style="font-weight: bold;">Dear {EXPERT_NAME},</div>\r\n<br /> Thank you for registering with us! <br /> <br /> We welcome you to our community. We hope you would enjoy using our functionalities. <br /><br /> Please verify your email address to start using the features. <br /><br /> <a href="{VERIFY_LINK}">Click Here To Verify</a> <br /><br /> ----- OR ----- <br /><br /> Copy and Paste the following Link <br /><br />\r\n<div style="background-color: #cccccc; width: auto; height: auto; padding: 10px;">{VERIFY_LINK}</div>\r\n<br /><br /> Thank &amp; Regards <br /><br />\r\n<div style="font-weight: bold;">Team Infopedia</div>\r\n</div>\r\n</div>', 'Thank You for Registering with Us!', 'This is the email template for the registration functionality.', NULL, 'active'),
(3, 'payment_notification', '<div style="border: 8px #FF9900 solid; width: 600px; height: auto; border-radius: 10px; padding: 10px;">\r\n<div style="border-bottom: 1px #CCCCCC inset; padding: 10px;" align="left"><img src="http://techsupport.saaninfotech.com/application/views/theme/saan_template/images/logo.png" alt="" /></div>\r\n<div style="margin-top: 10px;">\r\n<div style="font-weight: bold;">Dear {CUSTOMER_NAME},</div>\r\n<p><br /> The payment to get an Advice from your selected Expert was processed successfully.</p>\r\n<p>The details of the payment are as follows:</p>\r\n<table width="100%" border="0" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr>\r\n<td><strong>Expert Name:</strong></td>\r\n<td>{EXPERT_NAME}</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Transaction Id:</strong></td>\r\n<td>{TRANSACTION_ID}</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Paid Amount:</strong></td>\r\n<td>${PAID_AMOUNT}</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Payment Date:</strong></td>\r\n<td>{PAYMENT_DATE}</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>You will recieve a call from the Expert soon.<br /> <br /> Thank &amp; Regards</p>\r\n<div style="font-weight: bold;">Team Infopedia</div>\r\n</div>\r\n</div>', 'Payment Processed Successfully', 'This is the template to send the payment notification email after the transaction is completed successfully by the customer.', NULL, 'active'),
(2, 'reset_password', '<div style="border: 8px #FF9900 solid; width: 600px; height: auto; border-radius: 10px; padding: 10px;">\r\n<div style="border-bottom: 1px #CCCCCC inset; padding: 10px;" align="left"><img src="http://techsupport.saaninfotech.com/application/views/theme/saan_template/images/logo.png" alt="" /></div>\r\n<div style="margin-top: 10px;">\r\n<div style="font-weight: bold;">Dear {EXPERT_NAME},</div>\r\n<p><br /> Your request for Password Reset is processed successfully.</p>\r\n<p>Your New Password is: <strong>{NEW_PASSWORD}</strong><br /> <br /> Thank &amp; Regards</p>\r\n<div style="font-weight: bold;">Team Infopedia</div>\r\n</div>\r\n</div>', 'Reset Password Request - successfully Processed!', 'This is the template for the reset password functionality.', NULL, 'active'),
(5, 'feedback_mail', '<div style="border: 8px #FF9900 solid; width: 600px; height: auto; border-radius: 10px; padding: 10px;">\r\n  <div style="border-bottom: 1px #CCCCCC inset; padding: 10px;" align="left"><img src="http://techsupport.saaninfotech.com/application/views/theme/saan_template/images/logo.png" alt="" /></div>\r\n  <div style="margin-top: 10px;">\r\n    <div style="font-weight: bold;">Dear {CUSTOMER_NAME},</div>\r\n    <p><br />\r\n      The Expert from whom you had an advice seeks a feedback from you. Please click on the link below to provide feedback.</p>\r\n    <p>Link for the Feedback: <strong>{FEEDBACK_LINK}</strong><br />\r\n      <br />\r\n      Thank &amp; Regards</p>\r\n    <div style="font-weight: bold;">Team Infopedia</div>\r\n  </div>\r\n</div>\r\n', 'Provide feedback to your Expert', 'This mail is for the feedback request to the customer.', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `expert_category_details`
--

CREATE TABLE IF NOT EXISTS `expert_category_details` (
  `expert_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `expert_category_name` varchar(255) DEFAULT NULL,
  `expert_category_description` text,
  `expert_category_status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`expert_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `expert_category_details`
--

INSERT INTO `expert_category_details` (`expert_category_id`, `expert_category_name`, `expert_category_description`, `expert_category_status`) VALUES
(1, 'Gardening', 'This is Gardening', 'active'),
(2, 'Doctor', 'This is doctor category', 'active'),
(3, 'Computer Science', 'this is computer science category', 'active'),
(5, 'Mechanical', 'this is mechanical category', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `expert_details`
--

CREATE TABLE IF NOT EXISTS `expert_details` (
  `expert_id` int(11) NOT NULL AUTO_INCREMENT,
  `expert_category_id` int(11) DEFAULT NULL,
  `expert_email` varchar(255) DEFAULT NULL,
  `expert_password` varchar(255) DEFAULT NULL,
  `expert_name` varchar(255) DEFAULT NULL,
  `expert_address` text,
  `expert_phone_number` bigint(11) DEFAULT NULL,
  `expert_paypal` varchar(255) DEFAULT NULL,
  `expert_email_active_code` varchar(255) DEFAULT NULL,
  `expert_email_active_date` varchar(255) DEFAULT NULL,
  `expert_phone_active_code` varchar(255) DEFAULT NULL,
  `expert_phone_active_date` varchar(255) DEFAULT NULL,
  `expert_photo` text,
  `expert_credential_description` text,
  `expert_total_advice` int(11) NOT NULL,
  `expert_total_points` bigint(20) NOT NULL DEFAULT '0',
  `expert_status` enum('active','inactive') DEFAULT 'active',
  `expert_login_status` enum('online','offline') NOT NULL DEFAULT 'offline',
  PRIMARY KEY (`expert_id`),
  FULLTEXT KEY `expert_credential_description` (`expert_credential_description`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `expert_details`
--

INSERT INTO `expert_details` (`expert_id`, `expert_category_id`, `expert_email`, `expert_password`, `expert_name`, `expert_address`, `expert_phone_number`, `expert_paypal`, `expert_email_active_code`, `expert_email_active_date`, `expert_phone_active_code`, `expert_phone_active_date`, `expert_photo`, `expert_credential_description`, `expert_total_advice`, `expert_total_points`, `expert_status`, `expert_login_status`) VALUES
(1, 1, 'sinha.ksaurabh@gmail.com', '133057facf49cbe6520b15a4d96ee395', 'kumar saurabh sinha', 'This is the address', 9971047719, 'write._1359196367_biz@gmail.com', '97752547', '1360331152', '87684016', NULL, '1.jpg', 'this is the sample credentials', 1, 10, 'active', 'offline'),
(2, 3, 'sinhaksaurabh@gmail.com', '133057facf49cbe6520b15a4d96ee395', 'saurabh sinha', 'This is sample address', 9971047719, 'write._1359195720_biz@gmail.com', '10068264', '1360331167', '34684570', NULL, '2.jpg', 'this is sample credential', 2, 11, 'active', 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `expert_login_details`
--

CREATE TABLE IF NOT EXISTS `expert_login_details` (
  `expert_login_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `expert_id` int(11) NOT NULL,
  `browser_name` text NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `login_datetime` varchar(255) NOT NULL,
  `login_duration` int(11) NOT NULL,
  `login_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`expert_login_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `expert_login_details`
--

INSERT INTO `expert_login_details` (`expert_login_id`, `session_id`, `expert_id`, `browser_name`, `ip_address`, `login_datetime`, `login_duration`, `login_status`) VALUES
(1, 'bc9b27fa6975cc7d2c89070f43464ccb', 2, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0', '125.63.108.138', '1360331974', 0, 'inactive'),
(2, 'bc9b27fa6975cc7d2c89070f43464ccb', 2, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0', '125.63.108.138', '1360332160', 0, 'inactive'),
(3, '556af7b20a1428e54c30d3bb3e3e1979', 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17', '125.63.108.138', '1360332273', 0, 'inactive'),
(4, 'bc9b27fa6975cc7d2c89070f43464ccb', 2, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0', '125.63.108.138', '1360332562', 0, 'inactive'),
(5, 'bc9b27fa6975cc7d2c89070f43464ccb', 1, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:18.0) Gecko/20100101 Firefox/18.0', '125.63.108.138', '1360333302', 0, 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `expert_payment_details`
--

CREATE TABLE IF NOT EXISTS `expert_payment_details` (
  `expert_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `expert_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `corelation_id` varchar(255) DEFAULT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `paid_datetime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`expert_payment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `expert_payment_details`
--

INSERT INTO `expert_payment_details` (`expert_payment_id`, `expert_id`, `transaction_id`, `corelation_id`, `paid_amount`, `paid_datetime`) VALUES
(1, 1, NULL, NULL, '3.52', '1360332721'),
(2, 2, NULL, NULL, '7.04', '1360333005');

-- --------------------------------------------------------

--
-- Table structure for table `page_details`
--

CREATE TABLE IF NOT EXISTS `page_details` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `page_keyword` text,
  `page_description` text,
  `page_content` longtext,
  `page_status` enum('active','inactive') DEFAULT 'active',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `page_details`
--

