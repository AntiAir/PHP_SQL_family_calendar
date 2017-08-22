-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-08-22 15:24:11
-- 伺服器版本: 10.1.21-MariaDB
-- PHP 版本： 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `forum`
--

-- --------------------------------------------------------

--
-- 資料表結構 `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `reply_to_post_id` int(11) NOT NULL,
  `post_author` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `post_topic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `post_content` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `post_type` tinyint(1) NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `post`
--

INSERT INTO `post` (`post_id`, `reply_to_post_id`, `post_author`, `post_topic`, `post_content`, `post_type`, `post_time`) VALUES
(6, 0, '1', '1', '1', 1, '2017-08-11 21:16:41'),
(7, 0, '2', '2', '2', 1, '2017-08-11 21:16:54'),
(8, 7, '3', '3', '3', 0, '2017-08-11 21:17:16'),
(9, 0, '3', '3', '3', 1, '2017-08-11 22:11:42'),
(10, 0, '5', '5', '5', 1, '2017-08-11 22:11:51'),
(11, 9, '6', '6', '6', 0, '2017-08-11 22:12:00'),
(12, 0, '7', '7', '7', 1, '2017-08-11 22:12:09'),
(13, 0, '9', '9', '9', 1, '2017-08-11 22:12:14'),
(14, 0, '10', '10', '10', 1, '2017-08-11 22:12:28'),
(15, 0, 'qwer', 'qwer', 'qwer', 1, '2017-08-13 10:20:05'),
(16, 15, 'er', 'r', '搞啥?', 0, '2017-08-13 10:20:29'),
(17, 15, '44', '44', '回文很難找!回文很難找!回文很難找!回文很難找!回文很難找!回文很難找!回文很難找!回文很難找!回文很難找!', 0, '2017-08-13 10:21:04');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
