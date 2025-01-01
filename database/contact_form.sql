-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 24-12-25 03:57
-- 서버 버전: 10.4.27-MariaDB
-- PHP 버전: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `stipvelation`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `submit_date` datetime NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `contact_form`
--

INSERT INTO `contact_form` (`id`, `name`, `email`, `mobile`, `submit_date`, `ip_address`, `status`, `created_at`, `updated_at`) VALUES
(1, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-15 09:58:03', '::1', 'pending', '2024-12-15 08:58:03', '2024-12-15 08:58:03'),
(2, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-15 10:15:00', '::1', 'pending', '2024-12-15 09:15:00', '2024-12-15 09:15:00'),
(3, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-15 10:15:00', '::1', 'pending', '2024-12-15 09:15:00', '2024-12-15 09:15:00'),
(4, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-15 10:37:03', '::1', 'pending', '2024-12-15 09:37:03', '2024-12-15 09:37:03'),
(5, 'dlehdgus', 'ymhpro@naver.com', '01095938514', '2024-12-15 10:44:53', '::1', 'pending', '2024-12-15 09:44:53', '2024-12-15 09:44:53'),
(6, 'dlehdgus', 'ymhpro@naver.com', '01095938514', '2024-12-15 10:44:53', '::1', 'pending', '2024-12-15 09:44:53', '2024-12-15 09:44:53'),
(7, 'dlehdgus', 'ymhpro@naver.com', '01095938514', '2024-12-15 10:52:04', '::1', 'pending', '2024-12-15 09:52:04', '2024-12-15 09:52:04'),
(8, 'dlehdgus', 'ymhpro@naver.com', '01095938514', '2024-12-15 10:52:04', '::1', 'pending', '2024-12-15 09:52:04', '2024-12-15 09:52:04'),
(9, 'dlehdgus', 'ymhpro@naver.com', '010', '2024-12-15 10:54:54', '::1', 'pending', '2024-12-15 09:54:54', '2024-12-15 09:54:54'),
(10, 'dlehdgus', 'ymhpro@naver.com', '010', '2024-12-15 10:54:54', '::1', 'pending', '2024-12-15 09:54:54', '2024-12-15 09:54:54'),
(11, 'dlehdgus', 'ymhpro@naver.com', '01095938514', '2024-12-16 03:57:25', '::1', 'pending', '2024-12-16 02:57:25', '2024-12-16 02:57:25'),
(12, 'dlehdgus', 'ymhpro@naver.com', '01095938514', '2024-12-16 03:57:25', '::1', 'pending', '2024-12-16 02:57:25', '2024-12-16 02:57:25'),
(13, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-16 05:12:03', '::1', 'pending', '2024-12-16 04:12:03', '2024-12-16 04:12:03'),
(14, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-16 05:12:03', '::1', 'pending', '2024-12-16 04:12:03', '2024-12-16 04:12:03'),
(15, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-16 05:15:52', '::1', 'pending', '2024-12-16 04:15:52', '2024-12-16 04:15:52'),
(16, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-16 05:15:52', '::1', 'pending', '2024-12-16 04:15:52', '2024-12-16 04:15:52'),
(17, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-16 05:16:41', '::1', 'pending', '2024-12-16 04:16:41', '2024-12-16 04:16:41'),
(18, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-16 05:16:41', '::1', 'pending', '2024-12-16 04:16:41', '2024-12-16 04:16:41'),
(19, '이동현', 'ymhpro@naver.com', '01095938514', '2024-12-16 10:13:51', '::1', 'pending', '2024-12-16 09:13:51', '2024-12-16 09:13:51'),
(20, 'lee dong hyeon', 'ymhpro@naver.com', '01095938514', '2024-12-16 11:13:13', '::1', 'pending', '2024-12-16 10:13:13', '2024-12-16 10:13:13'),
(21, 'lee dong hyeon', 'ymhpro@naver.com', '01095938514', '2024-12-16 11:13:13', '::1', 'pending', '2024-12-16 10:13:13', '2024-12-16 10:13:13'),
(22, 'lee dong hyeon', 'ymhpro@naver.com', '01095938514', '2024-12-16 11:32:51', '::1', 'pending', '2024-12-16 10:32:51', '2024-12-16 10:32:51'),
(23, 'lee dong hyeon', 'ymhpro@naver.com', '01095938514', '2024-12-16 11:32:51', '::1', 'pending', '2024-12-16 10:32:51', '2024-12-16 10:32:51'),
(24, 'lee dong hyeon', 'ymhpro@naver.com', '01095938514', '2024-12-16 11:48:45', '::1', 'pending', '2024-12-16 10:48:45', '2024-12-16 10:48:45'),
(25, 'lee d.h', 'ymhpro@naver.com', '01095938514', '2024-12-17 05:46:52', '::1', 'pending', '2024-12-17 04:46:52', '2024-12-17 04:46:52'),
(26, 'lee dong hyeon', 'ymhpro@naver.com', '01095938514', '2024-12-17 05:57:21', '::1', 'pending', '2024-12-17 04:57:21', '2024-12-17 04:57:21'),
(27, 'lee dddd.h', 'ymhpro@naver.com', '01095938514', '2024-12-17 06:07:07', '::1', 'pending', '2024-12-17 05:07:07', '2024-12-17 05:07:07'),
(28, 'lee d.h', 'ymhpro@naver.com', '01095938514', '2024-12-17 06:10:04', '::1', 'pending', '2024-12-17 05:10:04', '2024-12-17 05:10:04'),
(29, 'lee d.h', 'ymhproenator@gmail.com', '01095938514', '2024-12-17 06:32:53', '::1', 'pending', '2024-12-17 05:32:53', '2024-12-17 05:32:53'),
(30, 'lee d.h', 'ymhpro@naver.com', '01095938514', '2024-12-18 07:51:13', '::1', 'pending', '2024-12-18 06:51:13', '2024-12-18 06:51:13');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_status` (`status`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
