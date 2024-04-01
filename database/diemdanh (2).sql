-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 01, 2024 lúc 05:57 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `diemdanh`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attendance`
--

CREATE TABLE `attendance` (
  `id_attendace` int(11) NOT NULL,
  `ma_monhoc` varchar(20) NOT NULL,
  `ma_teacher` varchar(20) NOT NULL,
  `masv` varchar(20) DEFAULT NULL,
  `solancomat` int(11) DEFAULT NULL,
  `solanvang` int(11) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attendance`
--

INSERT INTO `attendance` (`id_attendace`, `ma_monhoc`, `ma_teacher`, `masv`, `solancomat`, `solanvang`, `note`) VALUES
(1, 'MH05', 'GV01', 'MS01', 3, 6, 'Cấm thi'),
(2, 'MH02', 'GV02', 'MS02', 3, 4, '-4 điểm chuyên cần'),
(3, 'MH03', 'GV03', 'MS03', 3, 2, '-2 điểm chuyên cần'),
(4, 'MH04', 'GV04', 'MS04', 3, 4, '-4 điểm chuyên cần'),
(5, 'MH05', 'GV05', 'MS05', 0, 3, '-3 điểm chuyên cần'),
(6, 'MH01', 'GV01', 'MS03', 2, 1, '-1 điểm chuyên cần'),
(7, 'MH03', 'GV01', 'MS01', 2, 5, 'Cấm thi');

--
-- Bẫy `attendance`
--
DELIMITER $$
CREATE TRIGGER `insert_note_trigger` BEFORE INSERT ON `attendance` FOR EACH ROW BEGIN
    DECLARE solanvang_count INT;
    SET solanvang_count = NEW.solanvang;
    
    IF NEW.solanvang >= 5 THEN
        SET NEW.note = 'Cấm thi';
    ELSE
        SET NEW.note = CONCAT('-', solanvang_count, ' điểm chuyên cần');
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `prevent_insert_trigger` BEFORE UPDATE ON `attendance` FOR EACH ROW BEGIN
    DECLARE total_count INT;
    SET total_count = NEW.solancomat + NEW.solanvang;

    IF total_count >= (SELECT tongsobuoi FROM subject WHERE ma_monhoc = NEW.ma_monhoc) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tổng số buổi đã đủ, không thể cập nhật nữa.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `prevent_update_trigger` BEFORE INSERT ON `attendance` FOR EACH ROW BEGIN
    DECLARE total_count INT;
    SET total_count = NEW.solancomat + NEW.solanvang;

    IF total_count >= (SELECT tongsobuoi FROM subject WHERE ma_monhoc = NEW.ma_monhoc) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tổng số buổi đã đủ, không thể cập nhật nữa.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_note_trigger` BEFORE UPDATE ON `attendance` FOR EACH ROW BEGIN
    DECLARE solanvang_count INT;
    SET solanvang_count = NEW.solanvang;
    
    IF NEW.solanvang >= 5 THEN
        SET NEW.note = 'Cấm thi';
    ELSE
        SET NEW.note = CONCAT('-', solanvang_count, ' điểm chuyên cần');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class`
--

CREATE TABLE `class` (
  `ma_lop` varchar(20) NOT NULL,
  `ten_lop` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `class`
--

INSERT INTO `class` (`ma_lop`, `ten_lop`) VALUES
('LH01', 'T2008A'),
('LH02', 'T2005A'),
('LH03', 'T2006A'),
('LH04', 'T2007A'),
('LH05', 'T2009A');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room`
--

CREATE TABLE `room` (
  `ma_phong` varchar(20) NOT NULL,
  `tang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `room`
--

INSERT INTO `room` (`ma_phong`, `tang`) VALUES
('A01', 1),
('A02', 2),
('A03', 3),
('A04', 4),
('A05', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `ma_teacher` varchar(20) DEFAULT NULL,
  `ma_monhoc` varchar(20) DEFAULT NULL,
  `ma_phong` varchar(20) NOT NULL,
  `indate` date DEFAULT NULL,
  `outdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `schedule`
--

INSERT INTO `schedule` (`id`, `ma_teacher`, `ma_monhoc`, `ma_phong`, `indate`, `outdate`) VALUES
(1, 'GV01', 'MH05', 'A03', '2018-07-01', '2018-07-30'),
(2, 'GV02', 'MH02', 'A02', '2018-07-01', '2018-07-30'),
(3, 'GV03', 'MH03', 'A03', '2018-07-01', '2018-07-30'),
(4, 'GV04', 'MH04', 'A04', '2018-07-01', '2018-07-30'),
(5, 'GV05', 'MH05', 'A05', '2018-07-01', '2018-07-30'),
(6, 'GV01', 'MH03', 'A01', '2024-03-22', '2024-03-28'),
(7, 'GV01', 'MH01', 'A02', '2024-03-28', '2024-03-29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('r3F73u7ge2VmsMYf5J2ZsYQB3TO7WH2GjPnGwK4o', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoieThsRlRmempSZWdDQkxTV3MxSG0yQkx3OUhwd2U1Vml5Y1RJcHJ4QiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo0OiJuYW1lIjtzOjIyOiJUcsawxqFuZyBIb8OgbmcgUXXhu5FjIjtzOjEwOiJtYV90ZWFjaGVyIjtzOjQ6IkdWMDEiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vbG9jYWxob3N0L2RpZW1kYW5oL21hbmFnZS1zY2hlZHVsZSI7fXM6NzoibWVzc2FnZSI7Tjt9', 1711986288);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `masv` varchar(20) NOT NULL,
  `ma_lop` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`masv`, `ma_lop`, `name`, `gender`, `birthday`, `email`) VALUES
('MS01', 'LH01', 'Tran Van D', 'Nam', '1998-05-10', 'a@gmail.com'),
('MS02', 'LH02', 'Tran Van A', 'Nam', '1991-06-11', 'b@gmail.com'),
('MS03', 'LH03', 'Tran Van B', 'Nu', '2000-12-01', 'c@gmail.com'),
('MS04', 'LH04', 'Tran Van C', 'Nu', '1998-01-19', 'd@gmail.com'),
('MS05', 'LH05', 'Tran Van E', 'Nam', '1998-12-01', 'e@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subject`
--

CREATE TABLE `subject` (
  `ma_monhoc` varchar(20) NOT NULL,
  `ten_monhoc` varchar(50) DEFAULT NULL,
  `tongsobuoi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `subject`
--

INSERT INTO `subject` (`ma_monhoc`, `ten_monhoc`, `tongsobuoi`) VALUES
('MH01', 'Lap Trinh C', 10),
('MH02', 'HTML/CSS/JS', 11),
('MH03', 'SQL Sever', 12),
('MH04', 'Boostrap', 13),
('MH05', 'Jquery', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher`
--

CREATE TABLE `teacher` (
  `ma_teacher` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `teacher_mail` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `teacher`
--

INSERT INTO `teacher` (`ma_teacher`, `name`, `gender`, `birthday`, `teacher_mail`, `password`) VALUES
('GV01', 'Trương Hoàng Quốc', 'nam', '2024-03-07', 'quoc@gmail.com', 'cd0863bff03af8fd4bf9764ca0513a92'),
('GV02', 'Nguyễn Thành Tài', 'Nu', '1989-05-20', 'tai@gmail.com', 'a412ba79e6bcd018c48faf00f057c0bb'),
('GV03', 'Võ Hoàng Phi', 'Nu', '1990-12-30', 'phi@gmail.com', 'cb7a24bb7528f934b841b34c3a73e0c7'),
('GV04', 'Trần Bá Phúc', 'Nu', '1989-03-10', 'phuc@gmail.com', '886d057a091559e2f5dff95d1d01360b'),
('GV05', 'Lê Trường Thanh', 'Nam', '1989-11-11', 'thanh@gmail.com', '8478e2bdb758f8467225ae87ed3750c2'),
('GV06', 'Tran Van Diep', 'Nam', '1989-06-30', 'diep@gmail.com', '5c30eb7012e78c5deee517b6cb080a1a');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id_attendace`),
  ADD KEY `masv` (`masv`),
  ADD KEY `ma_monhoc` (`ma_monhoc`),
  ADD KEY `ma_teacher` (`ma_teacher`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`ma_lop`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ma_phong`);

--
-- Chỉ mục cho bảng `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ma_teacher` (`ma_teacher`,`ma_monhoc`),
  ADD KEY `ma_monhoc` (`ma_monhoc`),
  ADD KEY `ma_phong` (`ma_phong`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`masv`),
  ADD KEY `ma_lop` (`ma_lop`);

--
-- Chỉ mục cho bảng `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`ma_monhoc`);

--
-- Chỉ mục cho bảng `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`ma_teacher`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id_attendace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`masv`) REFERENCES `student` (`masv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`ma_monhoc`) REFERENCES `subject` (`ma_monhoc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_4` FOREIGN KEY (`ma_teacher`) REFERENCES `teacher` (`ma_teacher`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`ma_monhoc`) REFERENCES `subject` (`ma_monhoc`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`ma_teacher`) REFERENCES `teacher` (`ma_teacher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`ma_phong`) REFERENCES `room` (`ma_phong`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`ma_lop`) REFERENCES `class` (`ma_lop`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
