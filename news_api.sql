-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2022 at 10:49 AM
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
(1, 'Super Admin', 'super@admin.com', 'superAdmin', NULL, '01900000000', 'localhost:7074/uploads/734ad38bd4.jpg', 'e10adc3949ba59abbe56e057f20f883e', '2022-02-15 06:51:52', '2022-03-09 06:26:48'),
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
(9, 'google', 'on', 'google', NULL, NULL, 'google id', NULL, '2', NULL, 'asdfasdf', NULL, '4', '3', NULL, NULL, '2022-03-09 09:28:51', '2022-03-09 09:28:51'),
(10, 'facebook', 'off', 'facebook', NULL, NULL, 'facebook id', NULL, '3', NULL, 'asdfasdfasdf', NULL, '4', '4', NULL, NULL, '2022-03-09 09:27:00', '2022-03-09 09:27:00'),
(11, 'custom', 'off', NULL, 'sdfgsdgfsd', '127.0.0.1:9000/uploads/5af31cf533.png', NULL, 'sgfdfgsd', '3', '127.0.0.1:9000/uploads/7256fbf653.jpg', NULL, 'ghjdfhjdfh', '3', '2', '127.0.0.1:9000/uploads/62b3496f8e.jpg', NULL, '2022-03-09 09:28:37', '2022-03-09 09:28:37'),
(12, 'startup', 'off', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sdfadsfa', '2022-03-09 08:49:03', '0000-00-00 00:00:00');

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
(8, 'Sports2', '127.0.0.1:9000/uploads/2c63db7b20.png', 'Active', '2022-02-16 06:32:03', '2022-03-09 07:38:17'),
(9, 'Life Style', '', 'Active', '2022-03-09 06:54:42', '2022-03-09 07:50:09');

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
  `image` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `type`, `category_type`, `category_id`, `title`, `description`, `link`, `image`, `status`, `created_at`, `updated_at`) VALUES
(4, 'image', NULL, '[\"8\",\"9\"]', 'changed title', '<p>description changed</p>', NULL, '127.0.0.1:9000/uploads/c28bdf75f7.png', 'Active', '2022-02-16 06:34:53', '2022-03-09 07:54:07'),
(6, 'image', 'feature', '[\"8\"]', 'dfgsdf', '<p>dfasdfasdf</p>', '', '', 'Active', '2022-03-09 09:41:15', '0000-00-00 00:00:00'),
(7, 'image', 'select', '[\"8\"]', 'mn bn,', '<p>xgfbhnxdfghnf</p>', '', '', 'Active', '2022-03-09 09:41:46', '0000-00-00 00:00:00'),
(8, 'image', 'feature', '[\"8\"]', '5tyerty', '<p>rtgaewrwte</p>', NULL, '', 'Active', '2022-03-09 09:42:56', '2022-03-09 09:48:49');

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
(3, 'super@admin.com', '753210', '06:21:59', '07:21:59');

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
(1, 'News App', '1.01', 'news@app.com', 'https://play.store', 'Project X Ltd.', 'fb link', 'insta link', 'twit link', 'you link', '/uploads/37472806d0.jpg', '<p>dsfasdfasdf</p>', 'copyrithts', '<p>dsfasdfasdfasf</p>', '<p>asfadsfdasfasdf</p>', '');

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
(1, 'smtp.mailtrap.io', '2525', '417210714e4051', '0d98881139c7ec', 'tsl', '2022-02-15 09:55:32', '2022-03-09 08:34:06');

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
(3, 'Rupom', 'rupom@gmail.com', '01950012841', 'e10adc3949ba59abbe56e057f20f883e', 'localhost:7074/uploads/884ef946f5.jpg', '2022-02-16 07:00:13', '0000-00-00 00:00:00'),
(4, 'AL Abir', 'abir@hello.com', '01950012841', 'e10adc3949ba59abbe56e057f20f883e', '127.0.0.1:9000/uploads/104f9f4d4f.jpg', '2022-03-09 08:29:30', '2022-03-09 08:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `url`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Video Title Edited', 'Video URL', '<p>asdfasfasdfadsfsdf</p>', '127.0.0.1:9000/uploads/03790333a7.jpg', 'Inactive', '2022-03-09 08:00:30', '2022-03-09 08:07:16');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `manage_notification`
--
ALTER TABLE `manage_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news_comment`
--
ALTER TABLE `news_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `video_comment`
--
ALTER TABLE `video_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
