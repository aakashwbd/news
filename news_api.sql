-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2022 at 02:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `access` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `role`, `access`, `phone`, `image`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super@admin.com', 'superAdmin', NULL, '01900000000', '127.0.0.1:9000/uploads/a10a9544b4.jpg', 'e10adc3949ba59abbe56e057f20f883e', '2022-02-15 06:51:52', '2022-03-25 10:40:23'),
(3, 'Demo User', 'demoadmin@news.com', 'superAdmin', NULL, '123456', NULL, '61561eeb5b841f02e7d5a1608f5ad0b5', '2022-02-15 11:28:54', '0000-00-00 00:00:00'),
(5, 'Rupom', 'rupom@gmail.com', 'admin', '[\"category\",\"news\"]', '01950012841', '127.0.0.1:9000/uploads/a10a9544b4.jpg', 'e10adc3949ba59abbe56e057f20f883e', '2022-03-09 08:22:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int(11) NOT NULL,
  `ad_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `banner_id` varchar(255) DEFAULT NULL,
  `banner_link` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `interstitial_id` varchar(255) DEFAULT NULL,
  `interstitial_link` varchar(255) DEFAULT NULL,
  `interstitial_click` varchar(255) DEFAULT NULL,
  `interstitial_image` varchar(255) DEFAULT NULL,
  `native_id` varchar(255) DEFAULT NULL,
  `native_link` varchar(255) DEFAULT NULL,
  `native_per_news` varchar(255) DEFAULT NULL,
  `native_per_video` varchar(255) DEFAULT NULL,
  `native_image` varchar(255) DEFAULT NULL,
  `startup_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `ad_type`, `status`, `banner_id`, `banner_link`, `banner_image`, `interstitial_id`, `interstitial_link`, `interstitial_click`, `interstitial_image`, `native_id`, `native_link`, `native_per_news`, `native_per_video`, `native_image`, `startup_id`, `created_at`, `updated_at`) VALUES
(1, 'google', 'off', 'google', NULL, NULL, 'google id', NULL, '2', NULL, 'fvbgdfsg', NULL, '0', '0', NULL, NULL, '2022-03-25 11:35:58', '2022-03-25 11:35:58'),
(2, 'facebook', 'off', 'facebook', NULL, NULL, NULL, NULL, '3', NULL, 'sdfgsdfg', NULL, '0', '0', NULL, NULL, '2022-03-25 11:35:58', '2022-03-25 11:35:58'),
(3, 'custom', 'off', NULL, NULL, 'http://192.168.1.228:9000/uploads/3cc8b60618.jpg', NULL, NULL, '0', 'http://192.168.1.228:9000/uploads/219a57e821.jpg', NULL, NULL, '0', '0', 'http://192.168.1.228:9000/uploads/4ed51fcc3f.jpg', NULL, '2022-03-25 11:41:45', '2022-03-25 11:41:45'),
(4, 'startup', 'off', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-25 11:17:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_at`, `update_at`) VALUES
(1, 'Entertainment', 'http://192.168.1.228:9000/uploads/4b6aed0524.jpg', 'Active', '2022-03-25 10:40:56', '2022-03-25 10:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `manage_notification`
--

CREATE TABLE `manage_notification` (
  `id` int(11) NOT NULL,
  `app_id` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_notification`
--

INSERT INTO `manage_notification` (`id`, `app_id`, `api_key`) VALUES
(1, '77965c32-af74-4864-a00f-3a31aaa86dce', 'ODYxZGFlMDEtZTRhZi00M2VjLWFlYWItNjk2MmQ5NjlhMTBm');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `category_type` varchar(255) DEFAULT NULL,
  `category_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`category_id`)),
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `video_type` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `type`, `category_type`, `category_id`, `title`, `description`, `link`, `video_type`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'image', 'feature', '[\"1\"]', 'Ahmed Jesper is Shoking', '<p>hello jesper</p>', NULL, 'youtube', 'http://192.168.1.228:9000/uploads/c3fc00f158.jpg', 'Active', '2022-03-25', '2022-03-25 12:43:27'),
(2, 'video', 'feature', '[\"1\"]', 'Ahmed Jesper is shoking by his Scandle Video', '<p>dfsgasdfasdf</p>', 'hgghgfh', 'dailymotion', 'http://192.168.1.228:9000/uploads/ebc5539dc1.jpg', 'Active', '2022-03-25', '2022-03-25 10:51:16');

-- --------------------------------------------------------

--
-- Table structure for table `news_comment`
--

CREATE TABLE `news_comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `comment_text` longtext NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news_favourite`
--

CREATE TABLE `news_favourite` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news_report`
--

CREATE TABLE `news_report` (
  `id` int(11) NOT NULL,
  `news_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `report_text` longtext NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news_view`
--

CREATE TABLE `news_view` (
  `id` int(11) NOT NULL,
  `news_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_view`
--

INSERT INTO `news_view` (`id`, `news_id`) VALUES
(1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `description` longtext NOT NULL,
  `link` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`, `link`, `image`, `item_id`, `created_at`) VALUES
(1, 'gfasdf', 'sdafasdf', NULL, '://192.168.1.228:9000/uploads/b386edd84f.png', 1, '2022-03-25 11:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` time NOT NULL,
  `expired_at` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `email`, `code`, `created_at`, `expired_at`) VALUES
(3, 'sohag@gmail.com', '170206', '04:55:33', '05:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `package_title` varchar(255) NOT NULL,
  `package_cost` varchar(255) NOT NULL,
  `package_duration` varchar(255) NOT NULL,
  `duration_type` varchar(255) NOT NULL,
  `package_description` varchar(255) NOT NULL,
  `package_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `system_name` varchar(255) NOT NULL,
  `app_version` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `update_app` varchar(255) NOT NULL,
  `developed_by` varchar(255) NOT NULL,
  `facebook_link` varchar(255) NOT NULL,
  `instagram_link` varchar(255) NOT NULL,
  `twitter_link` varchar(255) NOT NULL,
  `youtube_link` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `copyrights` longtext NOT NULL,
  `privacy_policy` longtext NOT NULL,
  `cookies_policy` longtext NOT NULL,
  `terms_policy` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_name`, `app_version`, `email`, `update_app`, `developed_by`, `facebook_link`, `instagram_link`, `twitter_link`, `youtube_link`, `logo`, `description`, `copyrights`, `privacy_policy`, `cookies_policy`, `terms_policy`) VALUES
(1, 'News App', '1.01', 'news@app.com', 'https://play.store', 'Project X Ltd.', 'fb link', 'insta link', 'twit link', 'you link', 'http://192.168.1.228:9000/uploads/3268b9267f.jpg', '<p>des</p>', 'copyrithts', '<p>pri</p>', '<p>cook</p>', '<p>ter</p>');

-- --------------------------------------------------------

--
-- Table structure for table `smtp`
--

CREATE TABLE `smtp` (
  `id` int(11) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `encryption` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `smtp`
--

INSERT INTO `smtp` (`id`, `host`, `port`, `username`, `password`, `encryption`, `created_at`, `updated_at`) VALUES
(1, 'smtp.mailtrap.io', '2525', '417210714e4051', '0d98881139c7ec', 'tsl', '2022-03-25 10:55:18', '2022-03-25 10:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `image`, `created_at`, `updated_at`) VALUES
(1, 'sohag', 'sohag@gmail.com', '0134123413432', 'fcea920f7412b5da7be0cf42b8c93759', '://192.168.1.228:9000/uploads/all/5ff613c3c4.jpg', '2022-03-25 10:52:19', '2022-03-25 10:57:03');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video_type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video_type`, `title`, `url`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'youtube', 'dfadsf', 'adfsasdf', '<p>asdfasdf</p>', 'http://192.168.1.228:9000/uploads/490dc87b0e.jpg', 'Active', '2022-03-25', '2022-03-25 12:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `video_comment`
--

CREATE TABLE `video_comment` (
  `id` int(11) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `comment_text` longtext NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `video_favourite`
--

CREATE TABLE `video_favourite` (
  `id` int(11) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `video_report`
--

CREATE TABLE `video_report` (
  `id` int(11) NOT NULL,
  `video_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `report_text` longtext NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `video_view`
--

CREATE TABLE `video_view` (
  `id` int(11) NOT NULL,
  `video_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_notification`
--
ALTER TABLE `manage_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_comment`
--
ALTER TABLE `news_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_favourite`
--
ALTER TABLE `news_favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_report`
--
ALTER TABLE `news_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_view`
--
ALTER TABLE `news_view`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp`
--
ALTER TABLE `smtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_comment`
--
ALTER TABLE `video_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_favourite`
--
ALTER TABLE `video_favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_report`
--
ALTER TABLE `video_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_view`
--
ALTER TABLE `video_view`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manage_notification`
--
ALTER TABLE `manage_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news_comment`
--
ALTER TABLE `news_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_favourite`
--
ALTER TABLE `news_favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_report`
--
ALTER TABLE `news_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_view`
--
ALTER TABLE `news_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtp`
--
ALTER TABLE `smtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `video_comment`
--
ALTER TABLE `video_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_favourite`
--
ALTER TABLE `video_favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_report`
--
ALTER TABLE `video_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_view`
--
ALTER TABLE `video_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
