-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Des 2024 pada 06.41
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cekapar`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id` int(231) NOT NULL,
  `code_apar` varchar(231) NOT NULL,
  `tanggal` varchar(231) NOT NULL,
  `keterangan` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `code_apar`, `tanggal`, `keterangan`) VALUES
(35, '', 'Senin, 12-08-2024 21:49:13', 'Reygha Telah Melakukan Penambahan Lokasi '),
(36, '', 'Senin, 12-08-2024 21:49:15', 'Reygha Telah Melakukan Pengeditan Lokasi '),
(38, '', 'Senin, 12-08-2024 21:51:11', 'Reygha Telah Melakukan Penambahan Lokasi '),
(39, '', 'Senin, 12-08-2024 21:51:35', 'Reygha Telah Melakukan Penghapusan Lokasi '),
(40, '', 'Senin, 12-08-2024 21:59:25', 'Reygha Telah Melakukan Penambahan Lokasi '),
(41, '', 'Senin, 12-08-2024 22:00:00', 'Reygha Telah Melakukan Pengeditan Departemen '),
(42, '', 'Senin, 12-08-2024 22:00:07', 'Reygha Telah Melakukan Penghapusan Departemen '),
(43, '', 'Senin, 12-08-2024 22:23:22', 'Reygha Telah Melakukan Penambahan Lokasi '),
(44, '', 'Senin, 12-08-2024 22:24:16', 'Reygha Telah Melakukan Pengeditan Jenis Apar '),
(45, '', 'Senin, 12-08-2024 22:25:34', 'Reygha Telah Melakukan Penghapusan Jenis Apar '),
(46, 'AP097', 'Selasa, 13-08-2024 09:56:50', 'Reygha Telah Melakukan Penambahan Apar '),
(47, 'AP098', 'Rabu, 14-08-2024 08:20:10', 'Reygha Telah Melakukan Penambahan Apar '),
(48, 'AP099', 'Rabu, 14-08-2024 08:24:55', 'Reygha Telah Melakukan Penambahan Apar '),
(49, 'AP100', 'Rabu, 14-08-2024 08:25:13', 'Reygha Telah Melakukan Penambahan Apar '),
(50, 'AP100', 'Rabu, 14-08-2024 08:25:25', 'Reygha Telah Melakukan Penghapusan Apar  '),
(51, 'AP099', 'Rabu, 14-08-2024 08:25:08', 'Reygha Telah Melakukan Penghapusan Apar  '),
(52, '', 'Rabu, 14-08-2024 13:21:02', 'Reygha Telah Melakukan Pengeditan Apar  '),
(53, '', 'Rabu, 14-08-2024 13:21:17', 'Reygha Telah Melakukan Pengeditan Apar  '),
(54, 'AP097', 'Rabu, 14-08-2024 13:40:46', 'Reygha Telah Melakukan Pengeditan Apar  '),
(55, 'AP097', 'Rabu, 14-08-2024 13:40:55', 'Reygha Telah Melakukan Pengeditan Apar  '),
(56, 'AP097', 'Senin, 19-08-2024 08:45:26', 'Reygha Telah Melakukan Pengeditan Apar  '),
(57, 'AP097', 'Senin, 19-08-2024 08:45:39', 'Reygha Telah Melakukan Pengeditan Apar  '),
(58, 'AP097', 'Senin, 19-08-2024 08:45:45', 'Reygha Telah Melakukan Pengeditan Apar  '),
(59, '', 'Senin, 19-08-2024 09:54:50', 'Reygha Telah Melakukan Pengeditan Lokasi '),
(60, '', 'Senin, 19-08-2024 09:55:06', 'Reygha Telah Melakukan Pengeditan Lokasi '),
(61, '', 'Senin, 19-08-2024 09:55:11', 'Reygha Telah Melakukan Penambahan Lokasi '),
(62, 'AP098', 'Senin, 19-08-2024 11:04:29', 'Reygha Telah Melakukan Pengeditan Apar  '),
(63, 'AP098', 'Senin, 19-08-2024 11:04:40', 'Reygha Telah Melakukan Pengeditan Apar  '),
(64, 'AP098', 'Senin, 19-08-2024 12:33:53', 'Reygha Telah Melakukan Pengeditan Apar  '),
(65, 'AP099', 'Senin, 19-08-2024 13:42:07', 'Reygha Telah Melakukan Penambahan Apar '),
(66, 'AP099', 'Selasa, 20-08-2024 08:19:03', 'Reygha Telah Melakukan Penghapusan Apar  '),
(67, 'AP098', 'Selasa, 20-08-2024 08:19:11', 'Reygha Telah Melakukan Pengeditan Apar  '),
(68, 'AP040', 'Selasa, 20-08-2024 08:22:17', 'Reygha Telah Melakukan Pengeditan Apar  '),
(69, 'AP040', 'Selasa, 20-08-2024 08:23:05', 'Reygha Telah Melakukan Pengeditan Apar  '),
(70, 'AP099', 'Senin, 09-09-2024 12:09:52', 'Reygha Telah Melakukan Penambahan Apar '),
(71, 'AP100', 'Senin, 09-09-2024 12:35:04', 'Reygha Telah Melakukan Penambahan Apar '),
(72, 'AP100', 'Senin, 09-09-2024 12:35:35', 'Reygha Telah Melakukan Penghapusan Apar  '),
(73, 'AP006', 'Jumat, 27-09-2024 08:20:43', 'Reygha Telah Melakukan Scan Pada Apar '),
(74, 'AP013', 'Jumat, 27-09-2024 08:21:57', 'Reygha Telah Melakukan Scan Pada Apar '),
(75, 'AP016', 'Jumat, 27-09-2024 08:23:49', 'Reygha Telah Melakukan Scan Pada Apar '),
(76, 'AP018', 'Jumat, 27-09-2024 08:24:52', 'Reygha Telah Melakukan Scan Pada Apar '),
(77, 'AP019', 'Jumat, 27-09-2024 08:25:35', 'Reygha Telah Melakukan Scan Pada Apar '),
(78, 'AP022', 'Jumat, 27-09-2024 08:26:50', 'Reygha Telah Melakukan Pengeditan Apar  '),
(79, 'AP025', 'Jumat, 27-09-2024 08:27:50', 'Reygha Telah Melakukan Pengeditan Apar  '),
(80, 'AP033', 'Jumat, 27-09-2024 08:28:34', 'Reygha Telah Melakukan Pengeditan Apar  '),
(81, 'AP041', 'Jumat, 27-09-2024 08:29:19', 'Reygha Telah Melakukan Pengeditan Apar  '),
(82, 'AP048', 'Jumat, 27-09-2024 08:29:50', 'Reygha Telah Melakukan Pengeditan Apar  '),
(83, 'AP050', 'Jumat, 27-09-2024 08:31:07', 'Reygha Telah Melakukan Pengeditan Apar  '),
(84, 'AP053', 'Jumat, 27-09-2024 08:31:47', 'Reygha Telah Melakukan Pengeditan Apar  '),
(85, 'AP061', 'Jumat, 27-09-2024 08:32:19', 'Reygha Telah Melakukan Pengeditan Apar  '),
(86, 'AP081', 'Jumat, 27-09-2024 08:33:19', 'Reygha Telah Melakukan Pengeditan Apar  '),
(87, 'AP082', 'Jumat, 27-09-2024 08:33:52', 'Reygha Telah Melakukan Pengeditan Apar  '),
(88, 'AP090', 'Jumat, 27-09-2024 08:34:20', 'Reygha Telah Melakukan Pengeditan Apar  '),
(89, 'AP097', 'Jumat, 27-09-2024 08:35:23', 'Reygha Telah Melakukan Pengeditan Apar  '),
(90, 'AP098', 'Jumat, 27-09-2024 08:36:07', 'Reygha Telah Melakukan Pengeditan Apar  '),
(91, 'AP007', 'Kamis, 03-10-2024 09:49:41', 'Reygha Telah Melakukan Scan Pada Apar '),
(92, 'AP007', 'Kamis, 03-10-2024 09:50:16', 'Reygha Telah Melakukan Scan Pada Apar '),
(93, '', 'Kamis, 03-10-2024 10:17:27', 'Reygha Telah Melakukan Pengeditan Admin/User '),
(94, 'AP007', 'Kamis, 03-10-2024 10:21:41', 'AripL Telah Melakukan Scan Pada Apar '),
(95, 'AP008', 'Kamis, 03-10-2024 10:30:49', 'AripL Telah Melakukan Scan Pada Apar '),
(96, 'AP009', 'Kamis, 03-10-2024 10:37:08', 'AripL Telah Melakukan Scan Pada Apar '),
(97, 'AP010', 'Kamis, 03-10-2024 10:38:30', 'AripL Telah Melakukan Scan Pada Apar '),
(98, 'AP068', 'Kamis, 03-10-2024 10:50:04', 'AripL Telah Melakukan Scan Pada Apar '),
(99, 'AP075', 'Kamis, 03-10-2024 11:08:38', 'AripL Telah Melakukan Scan Pada Apar '),
(100, 'AP013', 'Senin, 07-10-2024 13:41:41', 'AripL Telah Melakukan Scan Pada Apar '),
(101, 'AP014', 'Senin, 07-10-2024 13:45:40', 'AripL Telah Melakukan Scan Pada Apar '),
(102, 'AP021', 'Senin, 07-10-2024 13:53:49', 'AripL Telah Melakukan Scan Pada Apar '),
(103, 'AP022', 'Senin, 07-10-2024 13:57:13', 'AripL Telah Melakukan Scan Pada Apar '),
(104, 'AP024', 'Senin, 07-10-2024 13:58:42', 'AripL Telah Melakukan Scan Pada Apar '),
(105, 'AP023', 'Senin, 07-10-2024 14:04:37', 'AripL Telah Melakukan Scan Pada Apar '),
(106, 'AP030', 'Senin, 07-10-2024 14:05:02', 'AripL Telah Melakukan Scan Pada Apar '),
(107, 'AP031', 'Senin, 07-10-2024 14:08:28', 'AripL Telah Melakukan Scan Pada Apar '),
(108, 'AP040', 'Senin, 07-10-2024 14:22:33', 'AripL Telah Melakukan Scan Pada Apar '),
(109, 'AP039', 'Senin, 07-10-2024 14:22:56', 'AripL Telah Melakukan Scan Pada Apar '),
(110, 'AP041', 'Senin, 07-10-2024 14:23:08', 'AripL Telah Melakukan Scan Pada Apar '),
(111, 'AP042', 'Senin, 07-10-2024 14:26:55', 'AripL Telah Melakukan Scan Pada Apar '),
(112, 'AP038', 'Senin, 07-10-2024 14:27:11', 'AripL Telah Melakukan Scan Pada Apar '),
(113, 'AP038', 'Senin, 07-10-2024 14:34:19', 'AripL Telah Melakukan Scan Pada Apar '),
(114, 'AP096', 'Senin, 07-10-2024 14:36:00', 'AripL Telah Melakukan Scan Pada Apar '),
(115, 'AP095', 'Senin, 07-10-2024 14:41:31', 'AripL Telah Melakukan Scan Pada Apar '),
(116, 'AP082', 'Senin, 07-10-2024 14:45:06', 'AripL Telah Melakukan Scan Pada Apar '),
(117, 'AP098', 'Senin, 07-10-2024 14:51:44', 'AripL Telah Melakukan Scan Pada Apar '),
(118, 'AP061', 'Senin, 07-10-2024 14:59:25', 'AripL Telah Melakukan Scan Pada Apar '),
(119, 'AP058', 'Senin, 07-10-2024 15:05:50', 'AripL Telah Melakukan Scan Pada Apar '),
(120, 'AP065', 'Senin, 07-10-2024 15:08:01', 'AripL Telah Melakukan Scan Pada Apar '),
(121, 'AP071', 'Senin, 07-10-2024 15:12:29', 'AripL Telah Melakukan Scan Pada Apar '),
(122, 'AP099', 'Rabu, 09-10-2024 09:30:42', 'Reygha Telah Melakukan Penghapusan Apar  '),
(123, 'AP099', 'Rabu, 09-10-2024 09:30:49', 'Reygha Telah Melakukan Penambahan Apar '),
(124, 'AP099', 'Rabu, 09-10-2024 14:45:15', 'Reygha Telah Melakukan Penghapusan Apar  '),
(126, 'AP008', 'Selasa, 29-10-2024 08:34:55', 'Reygha Telah Melakukan Scan Pada Apar '),
(130, 'HDR008', 'Kamis, 31-10-2024 08:38:07', 'Reygha Telah Melakukan Scan Pada Hydrant '),
(131, 'HDR008', 'Kamis, 31-10-2024 08:40:55', 'Reygha Telah Melakukan Scan Pada Hydrant '),
(132, 'HDR008', 'Kamis, 31-10-2024 08:41:31', 'Reygha Telah Melakukan Scan Pada Hydrant '),
(133, 'AP008', 'Kamis, 31-10-2024 09:58:59', 'Reygha Telah Melakukan Scan Pada Apar '),
(134, 'AP008', 'Kamis, 31-10-2024 09:59:44', 'Reygha Telah Melakukan Scan Pada Apar '),
(135, '', '', ''),
(136, '', '<br />\r\n<b>Warning</b>:  Undefined variable $dayName in <b>C:xampphtdocsCek_AparHydrantadminhydrant.php</b> on line <b>713</b><br />\r\n, 04-11-2024 08:57:58', '<br />\r\n<b>Warning</b>:  Undefined variable $user_details in <b>C:xampphtdocsCek_AparHydrantadminhydrant.php</b> on line <b>712</b><br />\r\n<br />\r\n<b>Warning</b>:  Trying to access array offset on value of type null in <b>C:xamppht'),
(137, '', 'Senin, 04-11-2024 15:22:23', 'Reygha Telah Melakukan Penambahan Lokasi '),
(138, '', 'Senin, 04-11-2024 15:22:29', 'Reygha Telah Melakukan Penambahan Lokasi '),
(139, '', '<br />\r\n<b>Warning</b>:  Undefined variable $dayName in <b>C:xampphtdocsCek_AparHydrantadminhydrant.php</b> on line <b>713</b><br />\r\n, 04-11-2024 09:22:35', '<br />\r\n<b>Warning</b>:  Undefined variable $user_details in <b>C:xampphtdocsCek_AparHydrantadminhydrant.php</b> on line <b>712</b><br />\r\n<br />\r\n<b>Warning</b>:  Trying to access array offset on value of type null in <b>C:xamppht'),
(140, '', 'Selasa, 05-11-2024 07:57:35', 'Reygha Telah Melakukan Penambahan Hydrant '),
(141, '', '<br />\r\n<b>Warning</b>:  Undefined variable $dayName in <b>C:xampphtdocsCek_AparHydrantadminhydrant.php</b> on line <b>713</b><br />\r\n, 05-11-2024 02:07:17', '<br />\r\n<b>Warning</b>:  Undefined variable $user_details in <b>C:xampphtdocsCek_AparHydrantadminhydrant.php</b> on line <b>712</b><br />\r\n<br />\r\n<b>Warning</b>:  Trying to access array offset on value of type null in <b>C:xamppht'),
(142, '', 'Selasa, 05-11-2024 08:09:39', 'Reygha Telah Melakukan Penambahan Hydrant '),
(143, '', 'Selasa, 05-11-2024 08:09:47', 'Reygha Telah Melakukan Penghapusan Lokasi '),
(144, '', 'Selasa, 05-11-2024 08:13:24', 'Reygha Telah Melakukan Penambahan Hydrant '),
(145, 'HDR012', 'Selasa, 05-11-2024 08:13:52', 'Reygha Telah Melakukan Penghapusan Hydrant '),
(146, 'HDR011', 'Selasa, 05-11-2024 08:17:10', 'Reygha Telah Melakukan Penghapusan Hydrant '),
(147, '', 'Selasa, 05-11-2024 08:22:19', 'Reygha Telah Melakukan Penambahan Hydrant '),
(148, 'HDR010', 'Selasa, 05-11-2024 08:22:25', 'Reygha Telah Melakukan Pengeditan Apar  '),
(149, 'HDR009', 'Selasa, 05-11-2024 08:23:07', 'Reygha Telah Melakukan Pengeditan Hydrant  '),
(150, 'HDR009', 'Selasa, 05-11-2024 09:27:55', 'Reygha Telah Melakukan Pengeditan Hydrant  '),
(151, 'HDR010', 'Selasa, 05-11-2024 09:31:57', 'Reygha Telah Melakukan Pengeditan Hydrant  '),
(152, 'HDR009', 'Selasa, 05-11-2024 09:32:31', 'Reygha Telah Melakukan Pengeditan Hydrant  '),
(153, '', 'Selasa, 05-11-2024 10:19:12', 'Reygha Telah Melakukan Penambahan Hydrant '),
(154, '', 'Selasa, 05-11-2024 10:19:59', 'Reygha Telah Melakukan Penambahan Hydrant '),
(155, '', 'Selasa, 05-11-2024 10:21:40', 'Reygha Telah Melakukan Penambahan Hydrant '),
(156, '', 'Selasa, 05-11-2024 10:21:54', 'Reygha Telah Melakukan Penambahan Hydrant '),
(157, 'HDR036', 'Kamis, 07-11-2024 09:33:59', 'Reygha Telah Melakukan Pengeditan Hydrant  '),
(158, 'HDR020', 'Kamis, 07-11-2024 13:21:02', 'Reygha Telah Melakukan Pengeditan Hydrant  '),
(159, 'HDR027', 'Kamis, 07-11-2024 13:57:03', 'Reygha Telah Melakukan Pengeditan Hydrant  '),
(160, 'HDR036', 'Kamis, 07-11-2024 15:15:29', 'Reygha Telah Melakukan Scan Pada Hydrant '),
(161, 'HDR036', 'Kamis, 07-11-2024 15:17:30', 'Reygha Telah Melakukan Pengeditan Hydrant  '),
(162, 'HDR026', 'Jumat, 08-11-2024 08:32:00', 'AripL Telah Melakukan Scan Pada Hydrant '),
(163, 'HDR027', 'Jumat, 08-11-2024 08:32:30', 'AripL Telah Melakukan Scan Pada Hydrant '),
(164, 'HDR012', 'Jumat, 08-11-2024 08:36:29', 'AripL Telah Melakukan Scan Pada Hydrant '),
(165, 'HDR013', 'Jumat, 08-11-2024 08:41:36', 'AripL Telah Melakukan Scan Pada Hydrant '),
(166, 'HDR028', 'Jumat, 08-11-2024 08:44:37', 'AripL Telah Melakukan Scan Pada Hydrant '),
(167, 'HDR014', 'Jumat, 08-11-2024 08:47:42', 'AripL Telah Melakukan Scan Pada Hydrant '),
(168, 'HDR015', 'Jumat, 08-11-2024 08:53:31', 'AripL Telah Melakukan Scan Pada Hydrant '),
(169, 'AP008', 'Selasa, 12-11-2024 08:27:28', 'Reygha Telah Melakukan Scan Pada Apar '),
(170, 'HDR018', 'Selasa, 12-11-2024 09:22:54', 'Reygha Telah Melakukan Scan Pada Hydrant '),
(171, 'HDR018', 'Selasa, 12-11-2024 13:06:52', 'Reygha Telah Melakukan Scan Pada Hydrant '),
(172, 'AP009', 'Jumat, 15-11-2024 07:57:49', 'Reygha Telah Melakukan Scan Pada Apar '),
(173, 'AP007', 'Jumat, 15-11-2024 08:49:20', 'AripL Telah Melakukan Scan Pada Apar '),
(174, 'AP009', 'Jumat, 15-11-2024 08:51:00', 'AripL Telah Melakukan Scan Pada Apar '),
(175, 'AP009', 'Jumat, 15-11-2024 08:53:10', 'AripL Telah Melakukan Scan Pada Apar '),
(176, 'AP008', 'Jumat, 15-11-2024 08:53:41', 'AripL Telah Melakukan Scan Pada Apar '),
(177, 'AP010', 'Jumat, 15-11-2024 08:54:26', 'AripL Telah Melakukan Scan Pada Apar '),
(178, 'AP006', 'Jumat, 15-11-2024 08:55:40', 'AripL Telah Melakukan Scan Pada Apar '),
(179, 'AP005', 'Jumat, 15-11-2024 08:57:09', 'AripL Telah Melakukan Scan Pada Apar '),
(180, 'AP004', 'Jumat, 15-11-2024 09:00:26', 'AripL Telah Melakukan Scan Pada Apar '),
(181, 'AP002', 'Jumat, 15-11-2024 09:00:33', 'AripL Telah Melakukan Scan Pada Apar '),
(182, 'AP001', 'Jumat, 15-11-2024 09:02:26', 'AripL Telah Melakukan Scan Pada Apar '),
(183, 'AP003', 'Jumat, 15-11-2024 09:03:58', 'AripL Telah Melakukan Scan Pada Apar '),
(184, 'AP011', 'Jumat, 15-11-2024 09:05:56', 'AripL Telah Melakukan Scan Pada Apar '),
(185, 'AP012', 'Jumat, 15-11-2024 09:08:20', 'AripL Telah Melakukan Scan Pada Apar '),
(186, 'AP013', 'Jumat, 15-11-2024 09:08:54', 'AripL Telah Melakukan Scan Pada Apar '),
(187, 'AP014', 'Jumat, 15-11-2024 09:09:57', 'AripL Telah Melakukan Scan Pada Apar '),
(188, 'AP021', 'Jumat, 15-11-2024 09:11:33', 'AripL Telah Melakukan Scan Pada Apar '),
(189, 'AP022', 'Jumat, 15-11-2024 09:12:38', 'AripL Telah Melakukan Scan Pada Apar '),
(190, 'AP024', 'Jumat, 15-11-2024 09:12:51', 'AripL Telah Melakukan Scan Pada Apar '),
(191, 'AP023', 'Jumat, 15-11-2024 09:13:56', 'AripL Telah Melakukan Scan Pada Apar '),
(192, 'AP020', 'Jumat, 15-11-2024 09:14:11', 'AripL Telah Melakukan Scan Pada Apar '),
(193, 'AP028', 'Jumat, 15-11-2024 09:16:02', 'AripL Telah Melakukan Scan Pada Apar '),
(194, 'AP027', 'Jumat, 15-11-2024 09:17:02', 'AripL Telah Melakukan Scan Pada Apar '),
(195, 'AP029', 'Jumat, 15-11-2024 09:17:28', 'AripL Telah Melakukan Scan Pada Apar '),
(196, 'AP031', 'Jumat, 15-11-2024 09:20:56', 'AripL Telah Melakukan Scan Pada Apar '),
(197, 'AP030', 'Jumat, 15-11-2024 09:25:05', 'AripL Telah Melakukan Scan Pada Apar '),
(198, 'AP032', 'Jumat, 15-11-2024 09:25:38', 'AripL Telah Melakukan Scan Pada Apar '),
(199, 'AP033', 'Jumat, 15-11-2024 09:27:20', 'AripL Telah Melakukan Scan Pada Apar '),
(200, 'AP033', 'Jumat, 15-11-2024 09:28:34', 'AripL Telah Melakukan Scan Pada Apar '),
(201, 'AP034', 'Jumat, 15-11-2024 09:28:42', 'AripL Telah Melakukan Scan Pada Apar '),
(202, 'AP037', 'Jumat, 15-11-2024 09:32:23', 'AripL Telah Melakukan Scan Pada Apar '),
(203, 'AP036', 'Jumat, 15-11-2024 09:33:14', 'AripL Telah Melakukan Scan Pada Apar '),
(204, 'AP038', 'Jumat, 15-11-2024 09:37:44', 'AripL Telah Melakukan Scan Pada Apar '),
(205, 'HDR022', 'Jumat, 15-11-2024 09:39:39', 'AripL Telah Melakukan Scan Pada Hydrant '),
(206, 'AP043', 'Jumat, 15-11-2024 09:43:26', 'AripL Telah Melakukan Scan Pada Apar '),
(207, 'AP044', 'Jumat, 15-11-2024 09:48:52', 'AripL Telah Melakukan Scan Pada Apar '),
(208, 'AP045', 'Jumat, 15-11-2024 09:49:07', 'AripL Telah Melakukan Scan Pada Apar '),
(209, 'AP039', 'Jumat, 15-11-2024 09:53:31', 'AripL Telah Melakukan Scan Pada Apar '),
(210, 'AP040', 'Jumat, 15-11-2024 09:57:03', 'AripL Telah Melakukan Scan Pada Apar '),
(211, 'AP039', 'Jumat, 15-11-2024 09:57:14', 'AripL Telah Melakukan Scan Pada Apar '),
(212, 'AP042', 'Jumat, 15-11-2024 09:57:22', 'AripL Telah Melakukan Scan Pada Apar '),
(213, 'AP041', 'Jumat, 15-11-2024 09:58:02', 'AripL Telah Melakukan Scan Pada Apar '),
(214, 'AP091', 'Jumat, 15-11-2024 10:01:25', 'AripL Telah Melakukan Scan Pada Apar '),
(215, 'HDR021', 'Jumat, 15-11-2024 10:02:13', 'AripL Telah Melakukan Scan Pada Hydrant '),
(216, 'HDR005', 'Jumat, 15-11-2024 10:04:36', 'AripL Telah Melakukan Scan Pada Hydrant '),
(217, 'AP092', 'Jumat, 15-11-2024 10:07:41', 'AripL Telah Melakukan Scan Pada Apar '),
(218, 'AP093', 'Jumat, 15-11-2024 10:07:52', 'AripL Telah Melakukan Scan Pada Apar '),
(219, 'AP092', 'Jumat, 15-11-2024 10:10:57', 'AripL Telah Melakukan Scan Pada Apar '),
(220, 'AP094', 'Jumat, 15-11-2024 10:12:10', 'AripL Telah Melakukan Scan Pada Apar '),
(221, 'HDR032', 'Jumat, 15-11-2024 10:12:22', 'AripL Telah Melakukan Scan Pada Hydrant '),
(222, 'HDR020', 'Jumat, 15-11-2024 10:15:52', 'AripL Telah Melakukan Scan Pada Hydrant '),
(223, 'AP096', 'Jumat, 15-11-2024 10:16:48', 'AripL Telah Melakukan Scan Pada Apar '),
(224, 'AP095', 'Jumat, 15-11-2024 10:19:17', 'AripL Telah Melakukan Scan Pada Apar '),
(225, 'AP051', 'Jumat, 15-11-2024 10:21:20', 'AripL Telah Melakukan Scan Pada Apar '),
(226, 'AP026', 'Jumat, 15-11-2024 10:23:45', 'AripL Telah Melakukan Scan Pada Apar '),
(227, 'AP025', 'Jumat, 15-11-2024 10:27:59', 'AripL Telah Melakukan Scan Pada Apar '),
(228, 'HDR006', 'Jumat, 15-11-2024 10:29:44', 'AripL Telah Melakukan Scan Pada Hydrant '),
(229, 'HDR006', 'Jumat, 15-11-2024 10:29:57', 'AripL Telah Melakukan Scan Pada Hydrant '),
(230, 'AP019', 'Jumat, 15-11-2024 10:30:10', 'AripL Telah Melakukan Scan Pada Apar '),
(231, 'AP018', 'Jumat, 15-11-2024 10:30:46', 'AripL Telah Melakukan Scan Pada Apar '),
(232, 'HDR008', 'Jumat, 15-11-2024 10:31:57', 'AripL Telah Melakukan Scan Pada Hydrant '),
(233, 'AP016', 'Jumat, 15-11-2024 10:32:31', 'AripL Telah Melakukan Scan Pada Apar '),
(234, 'AP017', 'Jumat, 15-11-2024 10:33:21', 'AripL Telah Melakukan Scan Pada Apar '),
(235, 'AP015', 'Jumat, 15-11-2024 10:33:46', 'AripL Telah Melakukan Scan Pada Apar '),
(236, 'HDR029', 'Jumat, 15-11-2024 14:14:56', 'Reygha Telah Melakukan Penghapusan Hydrant '),
(237, 'HDR031', 'Jumat, 15-11-2024 14:51:12', 'Reygha Telah Melakukan Penghapusan Hydrant '),
(238, 'AP035', 'Sabtu, 16-11-2024 08:18:31', 'AripL Telah Melakukan Scan Pada Apar '),
(239, 'HDR007', 'Sabtu, 16-11-2024 08:24:39', 'AripL Telah Melakukan Scan Pada Hydrant '),
(240, 'HDR004', 'Sabtu, 16-11-2024 08:25:55', 'AripL Telah Melakukan Scan Pada Hydrant '),
(241, 'HDR003', 'Sabtu, 16-11-2024 08:27:05', 'AripL Telah Melakukan Scan Pada Hydrant '),
(242, 'HDR010', 'Sabtu, 16-11-2024 08:29:58', 'AripL Telah Melakukan Scan Pada Hydrant '),
(243, 'AP053', 'Sabtu, 16-11-2024 08:31:20', 'AripL Telah Melakukan Scan Pada Apar '),
(244, 'AP052', 'Sabtu, 16-11-2024 08:31:47', 'AripL Telah Melakukan Scan Pada Apar '),
(245, 'AP056', 'Sabtu, 16-11-2024 08:33:57', 'AripL Telah Melakukan Scan Pada Apar '),
(246, 'AP060', 'Sabtu, 16-11-2024 08:34:46', 'AripL Telah Melakukan Scan Pada Apar '),
(247, 'AP059', 'Sabtu, 16-11-2024 08:35:29', 'AripL Telah Melakukan Scan Pada Apar '),
(248, 'HDR011', 'Sabtu, 16-11-2024 08:36:24', 'AripL Telah Melakukan Scan Pada Hydrant '),
(249, 'AP061', 'Sabtu, 16-11-2024 08:36:50', 'AripL Telah Melakukan Scan Pada Apar '),
(250, 'AP057', 'Sabtu, 16-11-2024 08:37:45', 'AripL Telah Melakukan Scan Pada Apar '),
(251, 'AP057', 'Sabtu, 16-11-2024 08:41:58', 'AripL Telah Melakukan Scan Pada Apar '),
(252, 'AP058', 'Sabtu, 16-11-2024 08:42:10', 'AripL Telah Melakukan Scan Pada Apar '),
(253, 'AP064', 'Sabtu, 16-11-2024 08:43:44', 'AripL Telah Melakukan Scan Pada Apar '),
(254, 'AP063', 'Sabtu, 16-11-2024 08:45:07', 'AripL Telah Melakukan Scan Pada Apar '),
(255, 'AP055', 'Sabtu, 16-11-2024 08:46:31', 'AripL Telah Melakukan Scan Pada Apar '),
(256, 'AP054', 'Sabtu, 16-11-2024 08:47:39', 'AripL Telah Melakukan Scan Pada Apar '),
(257, 'AP071', 'Sabtu, 16-11-2024 08:49:58', 'AripL Telah Melakukan Scan Pada Apar '),
(258, 'AP068', 'Sabtu, 16-11-2024 08:51:06', 'AripL Telah Melakukan Scan Pada Apar '),
(259, 'AP065', 'Sabtu, 16-11-2024 08:51:36', 'AripL Telah Melakukan Scan Pada Apar '),
(260, 'AP072', 'Sabtu, 16-11-2024 08:54:17', 'AripL Telah Melakukan Scan Pada Apar '),
(261, 'AP073', 'Sabtu, 16-11-2024 08:58:37', 'AripL Telah Melakukan Scan Pada Apar '),
(262, 'AP074', 'Sabtu, 16-11-2024 08:59:38', 'AripL Telah Melakukan Scan Pada Apar '),
(263, 'AP067', 'Sabtu, 16-11-2024 09:04:29', 'AripL Telah Melakukan Scan Pada Apar '),
(264, 'AP075', 'Sabtu, 16-11-2024 09:07:38', 'AripL Telah Melakukan Scan Pada Apar '),
(265, 'AP076', 'Sabtu, 16-11-2024 09:10:09', 'AripL Telah Melakukan Scan Pada Apar '),
(266, 'AP077', 'Sabtu, 16-11-2024 09:12:37', 'AripL Telah Melakukan Scan Pada Apar '),
(267, 'AP078', 'Sabtu, 16-11-2024 09:15:43', 'AripL Telah Melakukan Scan Pada Apar '),
(268, 'AP079', 'Sabtu, 16-11-2024 09:21:45', 'AripL Telah Melakukan Scan Pada Apar '),
(269, 'AP079', 'Sabtu, 16-11-2024 09:26:10', 'AripL Telah Melakukan Scan Pada Apar '),
(270, 'AP098', 'Sabtu, 16-11-2024 09:26:39', 'AripL Telah Melakukan Scan Pada Apar '),
(271, 'HDR017', 'Sabtu, 16-11-2024 09:31:42', 'AripL Telah Melakukan Scan Pada Hydrant '),
(272, 'AP082', 'Sabtu, 16-11-2024 09:36:32', 'AripL Telah Melakukan Scan Pada Apar '),
(273, 'AP090', 'Sabtu, 16-11-2024 09:38:45', 'AripL Telah Melakukan Scan Pada Apar '),
(274, 'AP090', 'Sabtu, 16-11-2024 09:48:57', 'AripL Telah Melakukan Scan Pada Apar '),
(275, 'HDR019', 'Sabtu, 16-11-2024 09:50:30', 'AripL Telah Melakukan Scan Pada Hydrant '),
(276, 'AP088', 'Sabtu, 16-11-2024 09:50:48', 'AripL Telah Melakukan Scan Pada Apar '),
(277, 'AP087', 'Sabtu, 16-11-2024 09:53:21', 'AripL Telah Melakukan Scan Pada Apar '),
(278, 'AP087', 'Sabtu, 16-11-2024 09:55:56', 'AripL Telah Melakukan Scan Pada Apar '),
(279, 'AP086', 'Sabtu, 16-11-2024 09:56:04', 'AripL Telah Melakukan Scan Pada Apar '),
(280, 'AP089', 'Sabtu, 16-11-2024 10:02:14', 'AripL Telah Melakukan Scan Pada Apar '),
(281, 'AP081', 'Sabtu, 16-11-2024 10:04:59', 'AripL Telah Melakukan Scan Pada Apar '),
(282, 'AP084', 'Sabtu, 16-11-2024 10:09:01', 'AripL Telah Melakukan Scan Pada Apar '),
(283, 'AP083', 'Sabtu, 16-11-2024 10:12:43', 'AripL Telah Melakukan Scan Pada Apar '),
(284, 'AP085', 'Sabtu, 16-11-2024 10:13:07', 'AripL Telah Melakukan Scan Pada Apar '),
(285, 'AP047', 'Sabtu, 16-11-2024 10:14:50', 'AripL Telah Melakukan Scan Pada Apar '),
(286, 'AP046', 'Sabtu, 16-11-2024 10:16:21', 'AripL Telah Melakukan Scan Pada Apar '),
(287, 'AP001', 'Senin, 18-11-2024 09:00:57', 'Reygha Telah Melakukan Pengeditan Apar  '),
(288, 'AP001', 'Senin, 18-11-2024 09:01:06', 'Reygha Telah Melakukan Pengeditan Apar  '),
(289, 'AP008', 'Senin, 18-11-2024 09:10:48', 'Reygha Telah Melakukan Scan Pada Apar '),
(290, 'AP008', 'Senin, 18-11-2024 09:11:39', 'Reygha Telah Melakukan Scan Pada Apar '),
(291, '', 'Senin, 18-11-2024 09:19:43', 'Reygha Telah Melakukan Penambahan Admin/User '),
(292, 'AP048', 'Senin, 18-11-2024 09:57:09', 'AripL Telah Melakukan Scan Pada Apar '),
(293, 'AP049', 'Senin, 18-11-2024 09:57:32', 'AripL Telah Melakukan Scan Pada Apar '),
(294, 'AP050', 'Senin, 18-11-2024 09:57:58', 'AripL Telah Melakukan Scan Pada Apar '),
(295, 'AP062', 'Senin, 18-11-2024 09:58:23', 'AripL Telah Melakukan Scan Pada Apar '),
(296, 'AP066', 'Senin, 18-11-2024 09:58:47', 'AripL Telah Melakukan Scan Pada Apar '),
(297, 'AP069', 'Senin, 18-11-2024 09:59:08', 'AripL Telah Melakukan Scan Pada Apar '),
(298, 'AP070', 'Senin, 18-11-2024 09:59:27', 'AripL Telah Melakukan Scan Pada Apar '),
(299, 'AP080', 'Senin, 18-11-2024 09:59:39', 'AripL Telah Melakukan Scan Pada Apar '),
(300, 'AP097', 'Senin, 18-11-2024 10:00:36', 'AripL Telah Melakukan Scan Pada Apar '),
(301, 'HDR001', 'Senin, 18-11-2024 10:01:05', 'AripL Telah Melakukan Scan Pada Hydrant '),
(302, 'HDR002', 'Senin, 18-11-2024 10:02:27', 'AripL Telah Melakukan Scan Pada Hydrant '),
(303, 'HDR009', 'Senin, 18-11-2024 10:02:43', 'AripL Telah Melakukan Scan Pada Hydrant '),
(304, 'HDR016', 'Senin, 18-11-2024 10:02:55', 'AripL Telah Melakukan Scan Pada Hydrant '),
(305, 'HDR023', 'Senin, 18-11-2024 10:03:12', 'AripL Telah Melakukan Scan Pada Hydrant '),
(306, 'HDR024', 'Senin, 18-11-2024 10:03:34', 'AripL Telah Melakukan Scan Pada Hydrant '),
(307, 'HDR025', 'Senin, 18-11-2024 10:03:49', 'AripL Telah Melakukan Scan Pada Hydrant '),
(308, 'HDR029', 'Senin, 18-11-2024 10:04:00', 'AripL Telah Melakukan Scan Pada Hydrant '),
(309, 'HDR031', 'Senin, 18-11-2024 10:04:12', 'AripL Telah Melakukan Scan Pada Hydrant '),
(310, 'HDR032', 'Senin, 18-11-2024 10:04:24', 'AripL Telah Melakukan Scan Pada Hydrant '),
(311, 'HDR033', 'Senin, 18-11-2024 10:04:41', 'AripL Telah Melakukan Scan Pada Hydrant '),
(312, 'HDR035', 'Senin, 18-11-2024 10:04:50', 'AripL Telah Melakukan Scan Pada Hydrant '),
(313, 'AP099', 'Senin, 18-11-2024 10:10:14', 'AripL Telah Melakukan Penambahan Apar '),
(314, '', 'Senin, 18-11-2024 13:23:30', 'Reygha Telah Melakukan Penambahan Jenis Apar '),
(315, 'AP100', 'Senin, 18-11-2024 13:38:46', 'Reygha Telah Melakukan Penambahan Apar '),
(316, '', 'Selasa, 19-11-2024 07:42:48', 'Reygha Telah Melakukan Penghapusan Jenis Apar '),
(317, 'AP001', 'Rabu, 20-11-2024 07:25:50', 'Reygha Telah Melakukan Scan Pada Apar '),
(318, 'AP099', 'Rabu, 20-11-2024 07:26:59', 'Reygha Telah Melakukan Scan Pada Apar '),
(319, 'AP100', 'Rabu, 20-11-2024 08:39:26', 'Reygha Telah Melakukan Penambahan Apar '),
(320, 'AP100', 'Rabu, 20-11-2024 08:39:37', 'Reygha Telah Melakukan Penghapusan Apar  '),
(321, 'AP100', 'Rabu, 20-11-2024 08:41:23', 'Reygha Telah Melakukan Penambahan Apar '),
(322, 'AP100', 'Rabu, 20-11-2024 08:45:03', 'Reygha Telah Melakukan Penghapusan Apar  '),
(323, 'AP100', 'Rabu, 20-11-2024 08:55:57', 'Reygha Telah Melakukan Penambahan Apar '),
(324, 'AP100', 'Rabu, 20-11-2024 08:56:06', 'Reygha Telah Melakukan Penghapusan Apar  '),
(325, 'HDR001', 'Kamis, 28-11-2024 08:32:05', 'Reygha Telah Melakukan Pengeditan Hydrant  '),
(326, 'HDR017', 'Kamis, 28-11-2024 08:32:20', 'Reygha Telah Melakukan Pengeditan Hydrant  '),
(327, 'AP001', 'Jumat, 20-12-2024 08:50:08', 'Reygha Telah Melakukan Scan Pada Apar '),
(328, 'AP001', 'Jumat, 20-12-2024 09:06:41', 'Reygha Telah Melakukan Scan Pada Apar ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_apar`
--

CREATE TABLE `data_apar` (
  `id` int(111) NOT NULL,
  `code_apar` varchar(231) NOT NULL,
  `lokasi` varchar(231) NOT NULL,
  `departemen` varchar(231) NOT NULL,
  `jenis_apar` varchar(213) NOT NULL,
  `vendor` varchar(231) NOT NULL,
  `kondisi` varchar(213) NOT NULL,
  `tanggal_penggantian` varchar(231) NOT NULL,
  `masa_pemakaian` varchar(231) NOT NULL,
  `tanggal_refill` date NOT NULL,
  `tanggal_expired` date NOT NULL,
  `nozzle` varchar(221) NOT NULL,
  `tabung` varchar(212) NOT NULL,
  `presure` varchar(221) NOT NULL,
  `catridge` varchar(212) NOT NULL,
  `pin` varchar(221) NOT NULL,
  `handle` varchar(212) NOT NULL,
  `berat` varchar(111) NOT NULL,
  `plat_nomer` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_apar`
--

INSERT INTO `data_apar` (`id`, `code_apar`, `lokasi`, `departemen`, `jenis_apar`, `vendor`, `kondisi`, `tanggal_penggantian`, `masa_pemakaian`, `tanggal_refill`, `tanggal_expired`, `nozzle`, `tabung`, `presure`, `catridge`, `pin`, `handle`, `berat`, `plat_nomer`) VALUES
(1, 'AP001', '4', '1', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(2, 'AP002', '4', '2', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(3, 'AP003', '4', '3', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(4, 'AP004', '5', '4', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6,8 Kg', ''),
(5, 'AP005', '6', '5', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '25 Kg', ''),
(6, 'AP006', '7', '6', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,6 Kg', ''),
(7, 'AP007', '9', '7', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(8, 'AP008', '9', '8', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-09-07', '2026-09-07', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(9, 'AP009', '9', '9', '2', 'CV MERPA', 'Layak', '', '1 Tahun', '2023-09-04', '2024-09-04', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '2 Kg', ''),
(10, 'AP010', '9', '10', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(11, 'AP011', '9', '11', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(12, 'AP012', '1', '12', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 kg', ''),
(13, 'AP013', '1', '13', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(14, 'AP014', '1', '14', '3', 'CV. Merpa', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(15, 'AP015', '1', '15', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(16, 'AP016', '1', '16', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(17, 'AP017', '1', '17', '2', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6,8 Kg', ''),
(18, 'AP018', '1', '18', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(19, 'AP019', '1', '19', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(20, 'AP020', '1', '20', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(21, 'AP021', '1', '21', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(22, 'AP022', '1', '22', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '50 Kg', ''),
(23, 'AP023', '1', '23', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,6 Kg', ''),
(24, 'AP024', '1', '24', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6 Kg', ''),
(25, 'AP025', '1', '25', '3', 'CV MERPA', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6 Kg', ''),
(26, 'AP026', '1', '26', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(27, 'AP027', '1', '27', '2', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6,8 Kg', ''),
(28, 'AP028', '1', '28', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(29, 'AP029', '1', '29', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(30, 'AP030', '1', '30', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '5 Kg', ''),
(31, 'AP031', '1', '31', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(32, 'AP032', '1', '32', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(33, 'AP033', '1', '33', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(34, 'AP034', '1', '34', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(35, 'AP035', '1', '35', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '5 kg', ''),
(36, 'AP036', '1', '36', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(37, 'AP037', '1', '37', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(38, 'AP038', '1', '38', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(39, 'AP039', '1', '39', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,6 Kg', ''),
(40, 'AP040', '1', '40', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 kg', ''),
(41, 'AP041', '1', '41', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '25 Kg', ''),
(42, 'AP042', '1', '42', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(43, 'AP043', '3', '43', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(44, 'AP044', '3', '44', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(45, 'AP045', '3', '45', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(46, 'AP046', '3', '46', '4', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '9 kg', ''),
(47, 'AP047', '3', '47', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(48, 'AP048', '2', '48', '3', 'CV MERPA', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(49, 'AP049', '2', '49', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '25 Kg', ''),
(50, 'AP050', '2', '50', '3', 'CV MERPA', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(51, 'AP051', '2', '51', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(52, 'AP052', '2', '52', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(53, 'AP053', '2', '53', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(54, 'AP054', '2', '54', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(55, 'AP055', '2', '55', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2023-09-04', '2024-09-04', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(56, 'AP056', '2', '56', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(57, 'AP057', '2', '57', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(58, 'AP058', '2', '58', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(59, 'AP059', '2', '59', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(60, 'AP060', '2', '60', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(61, 'AP061', '2', '61', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6,8 Kg', ''),
(62, 'AP062', '2', '62', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(63, 'AP063', '2', '63', '3', 'PT Mutiara Safetyndo', 'Layak', '', '1 Tahun', '2024-07-09', '2025-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(64, 'AP064', '2', '64', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(65, 'AP065', '2', '65', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(66, 'AP066', '2', '66', '4', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '9 Kg', ''),
(67, 'AP067', '2', '67', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(68, 'AP068', '2', '68', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(69, 'AP069', '2', '69', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '3 Kg', ''),
(70, 'AP070', '2', '70', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(71, 'AP071', '2', '71', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(72, 'AP072', '2', '72', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(73, 'AP073', '2', '73', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(74, 'AP074', '2', '74', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(75, 'AP075', '8\n', '75', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(76, 'AP076', '8\n', '76', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(77, 'AP077', '8\n', '77', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(78, 'AP078', '8\n', '78', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(79, 'AP079', '8\n', '79', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(80, 'AP080', '8', '80', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(81, 'AP081', '3', '81', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(82, 'AP082', '3', '82', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '7 Kg', ''),
(83, 'AP083', '3', '83', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(84, 'AP084', '3', '84', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(85, 'AP085', '3', '85', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2023-08-04', '2024-08-04', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(86, 'AP086', '3', '86', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(87, 'AP087', '3', '87', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(88, 'AP088', '3', '88', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(89, 'AP089', '3', '89', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(90, 'AP090', '3', '90', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-02-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(91, 'AP091', '3', '91', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(92, 'AP092', '3', '92', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(93, 'AP093', '3', '93', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(94, 'AP094', '3', '94', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(95, 'AP095', '3', '95', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2023-09-04', '2024-09-04', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(96, 'AP096', '3', '96', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,6 Kg', ''),
(97, 'AP097', '1', '97', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(98, 'AP098', '1', '98', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(101, 'AP099', '', '', '3', 'CV MERPA', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '2 Kg', 'B 2359 BRK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_hydrant`
--

CREATE TABLE `data_hydrant` (
  `id` int(111) NOT NULL,
  `code_hydrant` varchar(231) NOT NULL,
  `nomer_urut` varchar(231) NOT NULL,
  `lokasi` varchar(231) NOT NULL,
  `jenis_lokasi` varchar(231) NOT NULL,
  `hose` varchar(231) NOT NULL,
  `nozzle` varchar(231) NOT NULL,
  `valve` varchar(231) NOT NULL,
  `kunci` varchar(231) NOT NULL,
  `seal_karet_hose` varchar(231) NOT NULL,
  `seal_karet_nozzle` varchar(231) NOT NULL,
  `box_hydrant` varchar(231) NOT NULL,
  `keterangan` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_hydrant`
--

INSERT INTO `data_hydrant` (`id`, `code_hydrant`, `nomer_urut`, `lokasi`, `jenis_lokasi`, `hose`, `nozzle`, `valve`, `kunci`, `seal_karet_hose`, `seal_karet_nozzle`, `box_hydrant`, `keterangan`) VALUES
(1, 'HDR001', '-', 'Toilet FA', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', 'Selang Retak'),
(2, 'HDR002', '-', 'Frame FA', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(3, 'HDR003', '-', 'Spindle FA', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', 'Drum Hose Rill Penyok'),
(4, 'HDR004', '-', 'Schelling', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(5, 'HDR005', '-', 'Boiler Besar FC', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(6, 'HDR006', '-', 'Powermate 2', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(7, 'HDR007', '-', 'Offline', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(8, 'HDR008', '-', 'Tool Room', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(9, 'HDR009', '-', 'Ruang NPD/Quality', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(10, 'HDR010', '-', 'SAP Subcont FB', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(11, 'HDR011', '-', 'Panel PLN FB', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(12, 'HDR012', 'A1', 'Pintu Gerbang Pos security', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(13, 'HDR013', 'A2', 'Assembly Point', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(14, 'HDR014', 'A3', 'Area Parkiran Motor FB 1', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(15, 'HDR015', 'A4', 'Area Parkiran Motor FB 2', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', 'Selang Ada 2'),
(16, 'HDR016', 'A5', 'Belakang Toilet FB', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(17, 'HDR017', 'A6', 'Belakang MTC/IPAL', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(18, 'HDR018', 'A7', 'Kontainer Sopir/Area Yard ', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(19, 'HDR019', 'A8', 'Area WareHouse Crating', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(20, 'HDR020', 'A9', 'Klindry 13/Area Hijau ', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(21, 'HDR021', 'A10', 'Belakang Boiler', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(22, 'HDR022', 'A11', 'Glass Store/FC', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(23, 'HDR023', 'A12', 'Dust Colektor 4/FA', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(24, 'HDR024', 'A13', 'Dust Colektor 2/FA', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(25, 'HDR025', 'A14', 'Belakang Masjid', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(26, 'HDR026', 'A15', 'Ruang Isolasi', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', 'Semua Lengkap'),
(27, 'HDR027', '1', 'Gerbang Pos security (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', 'Selang ada 2 nozzle ada 2'),
(28, 'HDR028', '2', 'Assembly Point (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', 'Selang ada 2'),
(29, 'HDR029', '3', 'Unloading Eksport (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(30, 'HDR030', '4', 'Belakang KD 13 (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(31, 'HDR031', '5', 'Belakang KD 6 (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(32, 'HDR032', '6', 'Tungku Bakar Boiler (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(33, 'HDR033', '7', 'Genset (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(34, 'HDR034', '8', 'Kantin/Masjid (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ' selang ada 2'),
(35, 'HDR035', '9', 'Gardu PLN (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `nama` varchar(213) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `keterangan` varchar(323) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `events`
--

INSERT INTO `events` (`id`, `nama`, `title`, `start`, `keterangan`) VALUES
(1, 'AripL', 'AP001', '2024-07-17', 'Sudah Inspeksi'),
(2, 'AripL', 'AP002', '2024-07-17', 'Sudah Inspeksi'),
(3, 'AripL', 'AP005', '2024-07-17', 'Sudah Inspeksi'),
(4, 'AripL', 'AP006', '2024-07-17', 'Sudah Inspeksi'),
(5, 'AripL', 'AP004', '2024-07-17', 'Sudah Inspeksi'),
(6, 'AripL', 'AP007', '2024-07-17', 'Sudah Inspeksi'),
(7, 'AripL', 'AP009', '2024-07-17', 'Sudah Inspeksi'),
(8, 'Reygha', 'AP008', '2024-07-17', 'Sudah Inspeksi'),
(9, 'AripL', 'AP010', '2024-07-17', 'Sudah Inspeksi'),
(10, 'AripL', 'AP011', '2024-07-17', 'Sudah Inspeksi'),
(11, 'AripL', 'AP013', '2024-07-17', 'Sudah Inspeksi'),
(12, 'AripL', 'AP012', '2024-07-17', 'Sudah Inspeksi'),
(13, 'AripL', 'AP014', '2024-07-17', 'Sudah Inspeksi'),
(14, 'AripL', 'AP015', '2024-07-17', 'Sudah Inspeksi'),
(15, 'AripL', 'AP016', '2024-07-17', 'Sudah Inspeksi'),
(16, 'AripL', 'AP017', '2024-07-17', 'Sudah Inspeksi'),
(17, 'AripL', 'AP019', '2024-07-17', 'Sudah Inspeksi'),
(18, 'AripL', 'AP018', '2024-07-17', 'Sudah Inspeksi'),
(19, 'AripL', 'AP003', '2024-07-17', 'Sudah Inspeksi'),
(20, 'AripL', 'AP022', '2024-07-17', 'Sudah Inspeksi'),
(21, 'AripL', 'AP023', '2024-07-17', 'Sudah Inspeksi'),
(22, 'AripL', 'AP025', '2024-07-17', 'Sudah Inspeksi'),
(23, 'AripL', 'AP026', '2024-07-17', 'Sudah Inspeksi'),
(24, 'AripL', 'AP021', '2024-07-17', 'Sudah Inspeksi'),
(25, 'AripL', 'AP020', '2024-07-17', 'Sudah Inspeksi'),
(26, '', 'AP029', '2024-07-17', 'Belum Inspeksi'),
(27, 'AripL', 'AP030', '2024-07-17', 'Sudah Inspeksi'),
(28, 'AripL', 'AP031', '2024-07-17', 'Sudah Inspeksi'),
(29, '', 'AP027', '2024-07-17', 'Belum Inspeksi'),
(30, '', 'AP028', '2024-07-17', 'Belum Inspeksi'),
(31, 'AripL', 'AP032', '2024-07-17', 'Sudah Inspeksi'),
(32, 'AripL', 'AP024', '2024-07-17', 'Sudah Inspeksi'),
(33, 'AripL', 'AP033', '2024-07-17', 'Sudah Inspeksi'),
(34, 'AripL', 'AP034', '2024-07-17', 'Sudah Inspeksi'),
(35, 'AripL', 'AP035', '2024-07-17', 'Sudah Inspeksi'),
(36, '', 'AP037', '2024-07-17', 'Belum Inspeksi'),
(37, 'AripL', 'AP038', '2024-07-17', 'Sudah Inspeksi'),
(38, 'AripL', 'AP039', '2024-07-17', 'Sudah Inspeksi'),
(39, 'AripL', 'AP040', '2024-07-17', 'Sudah Inspeksi'),
(40, 'Reygha', 'AP036', '2024-07-17', 'Sudah Inspeksi'),
(41, 'AripL', 'AP041', '2024-07-17', 'Sudah Inspeksi'),
(42, 'AripL', 'AP042', '2024-07-17', 'Sudah Inspeksi'),
(43, '', 'AP043', '2024-07-17', 'Belum Inspeksi'),
(44, 'Reygha', 'AP045', '2024-07-17', 'Sudah Inspeksi'),
(45, '', 'AP046', '2024-07-17', 'Belum Inspeksi'),
(46, 'Reygha', 'AP044', '2024-07-17', 'Sudah Inspeksi'),
(47, '', 'AP048', '2024-07-17', 'Belum Inspeksi'),
(48, 'Reygha', 'AP049', '2024-07-17', 'Sudah Inspeksi'),
(49, '', 'AP047', '2024-07-17', 'Belum Inspeksi'),
(50, '', 'AP051', '2024-07-17', 'Belum Inspeksi'),
(51, '', 'AP050', '2024-07-17', 'Belum Inspeksi'),
(52, 'AripL', 'AP053', '2024-07-17', 'Sudah Inspeksi'),
(53, '', 'AP052', '2024-07-17', 'Belum Inspeksi'),
(54, '', 'AP054', '2024-07-17', 'Belum Inspeksi'),
(55, '', 'AP056', '2024-07-17', 'Belum Inspeksi'),
(56, '', 'AP057', '2024-07-17', 'Belum Inspeksi'),
(57, '', 'AP055', '2024-07-17', 'Belum Inspeksi'),
(58, 'AripL', 'AP058', '2024-07-17', 'Sudah Inspeksi'),
(59, '', 'AP059', '2024-07-17', 'Belum Inspeksi'),
(60, '', 'AP060', '2024-07-17', 'Belum Inspeksi'),
(61, 'AripL', 'AP061', '2024-07-17', 'Sudah Inspeksi'),
(62, 'AripL', 'AP065', '2024-07-17', 'Sudah Inspeksi'),
(63, 'Reygha', 'AP067', '2024-07-17', 'Sudah Inspeksi'),
(64, 'Reygha', 'AP066', '2024-07-17', 'Sudah Inspeksi'),
(65, 'Reygha', 'AP063', '2024-07-17', 'Sudah Inspeksi'),
(66, '', 'AP062', '2024-07-17', 'Belum Inspeksi'),
(67, 'Reygha', 'AP064', '2024-07-17', 'Sudah Inspeksi'),
(68, 'AripL', 'AP068', '2024-07-17', 'Sudah Inspeksi'),
(69, '', 'AP069', '2024-07-17', 'Belum Inspeksi'),
(70, '', 'AP070', '2024-07-17', 'Belum Inspeksi'),
(71, 'AripL', 'AP071', '2024-07-17', 'Sudah Inspeksi'),
(72, 'Reygha', 'AP072', '2024-07-17', 'Sudah Inspeksi'),
(73, 'Reygha', 'AP073', '2024-07-17', 'Sudah Inspeksi'),
(74, 'AripL', 'AP075', '2024-07-17', 'Sudah Inspeksi'),
(75, 'Reygha', 'AP074', '2024-07-17', 'Sudah Inspeksi'),
(76, '', 'AP076', '2024-07-17', 'Belum Inspeksi'),
(77, '', 'AP079', '2024-07-17', 'Belum Inspeksi'),
(78, 'Reygha', 'AP080', '2024-07-17', 'Sudah Inspeksi'),
(79, 'Reygha', 'AP081', '2024-07-17', 'Sudah Inspeksi'),
(80, 'AripL', 'AP082', '2024-07-17', 'Sudah Inspeksi'),
(81, 'AripL', 'AP083', '2024-07-17', 'Sudah Inspeksi'),
(82, '', 'AP084', '2024-07-17', 'Belum Inspeksi'),
(83, '', 'AP078', '2024-07-17', 'Belum Inspeksi'),
(84, 'Reygha', 'AP077', '2024-07-17', 'Sudah Inspeksi'),
(85, '', 'AP086', '2024-07-17', 'Belum Inspeksi'),
(86, '', 'AP085', '2024-07-17', 'Belum Inspeksi'),
(87, '', 'AP087', '2024-07-17', 'Belum Inspeksi'),
(88, '', 'AP088', '2024-07-17', 'Belum Inspeksi'),
(89, '', 'AP089', '2024-07-17', 'Belum Inspeksi'),
(90, '', 'AP090', '2024-07-17', 'Belum Inspeksi'),
(91, '', 'AP091', '2024-07-17', 'Belum Inspeksi'),
(92, '', 'AP093', '2024-07-17', 'Belum Inspeksi'),
(94, 'AripL', 'AP095', '2024-07-17', 'Sudah Inspeksi'),
(95, 'Reygha', 'AP094', '2024-07-17', 'Sudah Inspeksi'),
(96, 'Reygha', 'AP092', '2024-07-17', 'Sudah Inspeksi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_apar`
--

CREATE TABLE `jenis_apar` (
  `id` int(111) NOT NULL,
  `jenis_apar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_apar`
--

INSERT INTO `jenis_apar` (`id`, `jenis_apar`) VALUES
(2, 'Carbon Dioxide (CO2)'),
(3, 'Dry Chemical Powder'),
(4, 'Foam'),
(5, 'Water'),
(6, 'Inergen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id` int(111) NOT NULL,
  `nama` varchar(231) NOT NULL,
  `tanggal_inspeksi` date NOT NULL,
  `code_apar` varchar(231) NOT NULL,
  `lokasi` varchar(231) NOT NULL,
  `departemen` varchar(231) NOT NULL,
  `jenis_apar` varchar(213) NOT NULL,
  `vendor` varchar(231) NOT NULL,
  `kondisi` varchar(213) NOT NULL,
  `tanggal_penggantian` varchar(231) NOT NULL,
  `masa_pemakaian` varchar(231) NOT NULL,
  `tanggal_refill` date NOT NULL,
  `tanggal_expired` date NOT NULL,
  `nozzle` varchar(221) NOT NULL,
  `tabung` varchar(212) NOT NULL,
  `presure` varchar(221) NOT NULL,
  `catridge` varchar(212) NOT NULL,
  `pin` varchar(221) NOT NULL,
  `handle` varchar(212) NOT NULL,
  `berat` varchar(111) NOT NULL,
  `plat_nomer` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `nama`, `tanggal_inspeksi`, `code_apar`, `lokasi`, `departemen`, `jenis_apar`, `vendor`, `kondisi`, `tanggal_penggantian`, `masa_pemakaian`, `tanggal_refill`, `tanggal_expired`, `nozzle`, `tabung`, `presure`, `catridge`, `pin`, `handle`, `berat`, `plat_nomer`) VALUES
(4, 'AripL', '2024-10-03', 'AP007', '9', '7', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(5, 'AripL', '2024-10-03', 'AP008', '9', '8', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(6, 'AripL', '2024-10-03', 'AP009', '9', '9', '2', 'CV MERPA', 'Layak', '', '1 Tahun', '2023-09-04', '2024-09-04', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '2 kg', ''),
(7, 'AripL', '2024-10-03', 'AP010', '9', '10', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(8, 'AripL', '2024-10-03', 'AP068', '2', '68', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(9, 'AripL', '2024-10-03', 'AP075', '8', '75', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(10, 'AripL', '2024-10-07', 'AP013', '1', '13', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(11, 'AripL', '2024-10-07', 'AP014', '1', '14', '3', 'CV. Merpa', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(12, 'AripL', '2024-10-07', 'AP021', '1', '21', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(13, 'AripL', '2024-10-07', 'AP022', '1', '22', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '50 kg', ''),
(14, 'AripL', '2024-10-07', 'AP024', '1', '24', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6 kg', ''),
(15, 'AripL', '2024-10-07', 'AP023', '1', '23', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.6 kg', ''),
(16, 'AripL', '2024-10-07', 'AP030', '1', '30', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '5 kg', ''),
(17, 'AripL', '2024-10-07', 'AP031', '1', '31', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(18, 'AripL', '2024-10-07', 'AP040', '1', '40', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 kg', ''),
(19, 'AripL', '2024-10-07', 'AP039', '1', '39', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.6kg', ''),
(20, 'AripL', '2024-10-07', 'AP041', '1', '41', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '25 kg', ''),
(21, 'AripL', '2024-10-07', 'AP042', '1', '42', '', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(22, 'AripL', '2024-10-07', 'AP038', '1', '38', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(23, 'AripL', '2024-10-07', 'AP096', '3', '96', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,6 kg', ''),
(24, 'AripL', '2024-10-07', 'AP095', '3', '95', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2023-09-04', '2024-09-04', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 kg', ''),
(25, 'AripL', '2024-10-07', 'AP082', '3', '82', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '7 kg', ''),
(26, 'AripL', '2024-10-07', 'AP098', '1', '98', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(27, 'AripL', '2024-10-07', 'AP061', '2', '61', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6.8 kg', ''),
(28, 'AripL', '2024-10-07', 'AP058', '2', '58', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(29, 'AripL', '2024-10-08', 'AP065', '2', '65', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(30, 'AripL', '2024-10-08', 'AP071', '2', '71', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(31, 'AripL', '2024-10-10', 'AP097', '1', '97', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(32, 'AripL', '2024-10-10', 'AP006', '7', '6', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.6 kg', ''),
(33, 'AripL', '2024-10-10', 'AP005', '6', '5', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '25 kg', ''),
(34, 'AripL', '2024-10-10', 'AP004', '5', '4', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6.8 kg', ''),
(35, 'AripL', '2024-10-10', 'AP001', '4', '1', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 kg', ''),
(36, 'AripL', '2024-10-10', 'AP002', '4', '2', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 kg', ''),
(37, 'AripL', '2024-10-10', 'AP003', '4', '3', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(38, 'AripL', '2024-10-10', 'AP012', '1', '12', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 kg', ''),
(39, 'AripL', '2024-10-10', 'AP011', '9', '11', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(40, 'AripL', '2024-10-10', 'AP015', '1', '15', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(41, 'AripL', '2024-10-10', 'AP016', '1', '16', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(42, 'AripL', '2024-10-10', 'AP017', '1', '17', '2', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6.8 kg', ''),
(43, 'AripL', '2024-10-10', 'AP018', '1', '18', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 kg', ''),
(44, 'AripL', '2024-10-10', 'AP019', '1', '19', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(45, 'AripL', '2024-10-10', 'AP032', '1', '32', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(46, 'AripL', '2024-10-10', 'AP053', '2', '53', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(47, 'AripL', '2024-10-10', 'AP083', '3', '83', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(48, 'AripL', '2024-10-11', 'AP020', '1', '20', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(49, 'AripL', '2024-10-11', 'AP025', '1', '25', '3', 'CV MERPA', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(50, 'AripL', '2024-10-11', 'AP026', '1', '26', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(51, 'AripL', '2024-10-11', 'AP033', '1', '33', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(52, 'AripL', '2024-10-11', 'AP034', '1', '34', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(53, 'AripL', '2024-10-11', 'AP035', '1', '35', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '5 kg', ''),
(54, 'AripL', '2024-10-18', 'AP069', '2', '69', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '3 Kg', ''),
(56, 'AripL', '2024-10-18', 'AP063', '2', '63', '3', 'PT Mutiara Safetyndo', 'Layak', '', '1 Tahun', '2024-07-09', '2025-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6 kg', ''),
(57, 'AripL', '2024-10-18', 'AP064', '2', '64', '3', 'PT Mutiara Safetyndo', 'Layak', '', '', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6 kg', ''),
(58, 'AripL', '2024-10-18', 'AP052', '2', '52', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(59, 'AripL', '2024-10-18', 'AP059', '2', '59', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(60, 'AripL', '2024-10-18', 'AP060', '2', '60', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(61, 'AripL', '2024-10-21', 'AP043', '3', '43', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(62, 'AripL', '2024-10-21', 'AP046', '3', '46', '4', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '9 kg', ''),
(63, 'AripL', '2024-10-21', 'AP047', '3', '47', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(65, 'Reygha', '2024-10-29', 'AP008', '9', '8', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(66, 'Reygha', '2024-10-29', 'AP008', '9', '8', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(67, 'Reygha', '2024-10-31', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', ''),
(68, '', '2024-10-31', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', ''),
(69, '', '2024-10-31', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', ''),
(70, 'Reygha', '2024-10-31', 'AP008', '9', '8', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-09-07', '2026-09-07', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(71, 'Reygha', '2024-10-31', 'AP008', '9', '8', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '1 Tahun', '2024-09-07', '2026-09-07', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(72, 'Reygha', '2024-10-31', 'AP008', '9', '8', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-09-07', '2026-09-07', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(75, 'AripL', '2024-11-15', 'AP007', '9', '7', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(77, 'AripL', '2024-11-15', 'AP009', '9', '9', '2', 'CV MERPA', 'Layak', '', '1 Tahun', '2023-09-04', '2024-09-04', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '2 kg', ''),
(78, 'AripL', '2024-11-15', 'AP008', '9', '8', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-09-07', '2026-09-07', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(79, 'AripL', '2024-11-15', 'AP010', '9', '10', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(80, 'AripL', '2024-11-15', 'AP006', '7', '6', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.6 kg', ''),
(81, 'AripL', '2024-11-15', 'AP005', '6', '5', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '25 kg', ''),
(82, 'AripL', '2024-11-15', 'AP004', '5', '4', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6.8 kg', ''),
(83, 'AripL', '2024-11-15', 'AP002', '4', '2', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 kg', ''),
(84, 'AripL', '2024-11-15', 'AP001', '4', '1', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 kg', ''),
(85, 'AripL', '2024-11-15', 'AP003', '4', '3', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(86, 'AripL', '2024-11-15', 'AP011', '9', '11', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(87, 'AripL', '2024-11-15', 'AP012', '1', '12', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 kg', ''),
(88, 'AripL', '2024-11-15', 'AP013', '1', '13', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(89, 'AripL', '2024-11-15', 'AP014', '1', '14', '3', 'CV. Merpa', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(90, 'AripL', '2024-11-15', 'AP021', '1', '21', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(91, 'AripL', '2024-11-15', 'AP022', '1', '22', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '50 kg', ''),
(92, 'AripL', '2024-11-15', 'AP024', '1', '24', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6 kg', ''),
(93, 'AripL', '2024-11-15', 'AP023', '1', '23', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.6 kg', ''),
(94, 'AripL', '2024-11-15', 'AP020', '1', '20', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(95, 'AripL', '2024-11-15', 'AP028', '1', '28', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(96, 'AripL', '2024-11-15', 'AP027', '1', '27', '2', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6.8 kg', ''),
(97, 'AripL', '2024-11-15', 'AP029', '1', '29', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(98, 'AripL', '2024-11-15', 'AP031', '1', '31', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(99, 'AripL', '2024-11-15', 'AP030', '1', '30', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '5 kg', ''),
(100, 'AripL', '2024-11-15', 'AP032', '1', '32', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(101, 'AripL', '2024-11-15', 'AP033', '1', '33', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(103, 'AripL', '2024-11-15', 'AP034', '1', '34', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(104, 'AripL', '2024-11-15', 'AP037', '1', '37', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6kg', ''),
(105, 'AripL', '2024-11-15', 'AP036', '1', '36', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 kg', ''),
(106, 'AripL', '2024-11-15', 'AP038', '1', '38', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(107, 'AripL', '2024-11-15', 'AP043', '3', '43', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(108, 'AripL', '2024-11-15', 'AP044', '3', '44', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(109, 'AripL', '2024-11-15', 'AP045', '3', '45', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(111, 'AripL', '2024-11-15', 'AP040', '1', '40', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 kg', ''),
(112, 'AripL', '2024-11-15', 'AP039', '1', '39', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.6kg', ''),
(113, 'AripL', '2024-11-15', 'AP042', '1', '42', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(114, 'AripL', '2024-11-15', 'AP041', '1', '41', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '25 kg', ''),
(115, 'AripL', '2024-11-15', 'AP091', '3', '91', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 kg', ''),
(117, 'AripL', '2024-11-15', 'AP093', '3', '93', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(118, 'AripL', '2024-11-15', 'AP092', '3', '92', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,5 kg', ''),
(119, 'AripL', '2024-11-15', 'AP094', '3', '94', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(120, 'AripL', '2024-11-15', 'AP096', '3', '96', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4,6 kg', ''),
(121, 'AripL', '2024-11-15', 'AP095', '3', '95', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2023-09-04', '2024-09-04', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 kg', ''),
(122, 'AripL', '2024-11-15', 'AP051', '2', '51', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(123, 'AripL', '2024-11-15', 'AP026', '1', '26', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(124, 'AripL', '2024-11-15', 'AP025', '1', '25', '3', 'CV MERPA', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6 kg', ''),
(125, 'AripL', '2024-11-15', 'AP019', '1', '19', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(126, 'AripL', '2024-11-15', 'AP018', '1', '18', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 kg', ''),
(127, 'AripL', '2024-11-15', 'AP016', '1', '16', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(128, 'AripL', '2024-11-15', 'AP017', '1', '17', '2', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6.8 kg', ''),
(129, 'AripL', '2024-11-15', 'AP015', '1', '15', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(130, 'AripL', '2024-11-16', 'AP035', '1', '35', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '5 kg', ''),
(131, 'AripL', '2024-11-16', 'AP053', '2', '53', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(132, 'AripL', '2024-11-16', 'AP052', '2', '52', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(133, 'AripL', '2024-11-16', 'AP056', '2', '56', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(134, 'AripL', '2024-11-16', 'AP060', '2', '60', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(135, 'AripL', '2024-11-16', 'AP059', '2', '59', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(136, 'AripL', '2024-11-16', 'AP061', '2', '61', '2', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '6.8 kg', ''),
(138, 'AripL', '2024-11-16', 'AP057', '2', '57', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(139, 'AripL', '2024-11-16', 'AP058', '2', '58', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(140, 'AripL', '2024-11-16', 'AP064', '2', '64', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(141, 'AripL', '2024-11-16', 'AP063', '2', '63', '3', 'PT Mutiara Safetyndo', 'Layak', '', '1 Tahun', '2024-07-09', '2025-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(142, 'AripL', '2024-11-16', 'AP055', '2', '55', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2023-09-04', '2024-09-04', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(143, 'AripL', '2024-11-16', 'AP054', '2', '54', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(144, 'AripL', '2024-11-16', 'AP071', '2', '71', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(145, 'AripL', '2024-11-16', 'AP068', '2', '68', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-02-01', '2026-02-01', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(146, 'AripL', '2024-11-16', 'AP065', '2', '65', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(147, 'AripL', '2024-11-16', 'AP072', '2', '72', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(148, 'AripL', '2024-11-16', 'AP073', '2', '73', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(149, 'AripL', '2024-11-16', 'AP074', '2', '74', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(150, 'AripL', '2024-11-16', 'AP067', '2', '67', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(151, 'AripL', '2024-11-16', 'AP075', '8', '75', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(152, 'AripL', '2024-11-16', 'AP076', '8', '76', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(153, 'AripL', '2024-11-16', 'AP077', '8', '77', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(154, 'AripL', '2024-11-16', 'AP078', '8', '78', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(156, 'AripL', '2024-11-16', 'AP079', '8', '79', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(157, 'AripL', '2024-11-16', 'AP098', '1', '98', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(158, 'AripL', '2024-11-16', 'AP082', '3', '82', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '7 kg', ''),
(160, 'AripL', '2024-11-16', 'AP090', '3', '90', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-02-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(161, 'AripL', '2024-11-16', 'AP088', '3', '88', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(163, 'AripL', '2024-11-16', 'AP087', '3', '87', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(164, 'AripL', '2024-11-16', 'AP086', '3', '86', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(165, 'AripL', '2024-11-16', 'AP089', '3', '89', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(166, 'AripL', '2024-11-16', 'AP081', '3', '81', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4.5 kg', ''),
(167, 'AripL', '2024-11-16', 'AP084', '3', '84', '3', 'PT Mutiara Safetyndo', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(168, 'AripL', '2024-11-16', 'AP083', '3', '83', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(169, 'AripL', '2024-11-16', 'AP085', '3', '85', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2023-08-04', '2024-08-04', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Baik', '4.5 kg', ''),
(170, 'AripL', '2024-11-16', 'AP047', '3', '47', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 kg', ''),
(171, 'AripL', '2024-11-16', 'AP046', '3', '46', '4', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '9 kg', ''),
(174, 'AripL', '2024-11-18', 'AP048', '2', '48', '3', 'CV MERPA', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(175, 'AripL', '2024-11-18', 'AP049', '2', '49', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '25 Kg', ''),
(176, 'AripL', '2024-11-18', 'AP050', '2', '50', '3', 'CV MERPA', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(177, 'AripL', '2024-11-18', 'AP062', '2', '62', '3', 'CV MERPA', 'Layak', '', '1 Tahun', '2024-01-15', '2025-01-15', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(178, 'AripL', '2024-11-18', 'AP066', '2', '66', '4', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '9 Kg', ''),
(179, 'AripL', '2024-11-18', 'AP069', '2', '69', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '3 Kg', ''),
(180, 'AripL', '2024-11-18', 'AP070', '2', '70', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(181, 'AripL', '2024-11-18', 'AP080', '8', '80', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(182, 'AripL', '2024-11-18', 'AP097', '1', '97', '3', 'CV ALBINDO', 'Layak', '', '2 Tahun', '2024-08-22', '2026-08-22', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '6 Kg', ''),
(183, 'Reygha', '2024-11-20', 'AP001', '4', '1', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', ''),
(184, 'Reygha', '2024-11-20', 'AP099', '', '', '3', 'CV MERPA', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '2 Kg', 'B 2359 BRK'),
(186, 'Reygha', '2024-12-20', 'AP001', '4', '1', '3', 'PT MUTIARA SAFETYNDO', 'Layak', '', '2 Tahun', '2024-07-09', '2026-07-09', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', '4,5 Kg', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_hydrant`
--

CREATE TABLE `laporan_hydrant` (
  `id` int(111) NOT NULL,
  `nama` varchar(231) NOT NULL,
  `tanggal_inspeksi` date NOT NULL,
  `code_hydrant` varchar(231) NOT NULL,
  `nomer_urut` varchar(231) NOT NULL,
  `lokasi` varchar(231) NOT NULL,
  `jenis_lokasi` varchar(231) NOT NULL,
  `hose` varchar(231) NOT NULL,
  `nozzle` varchar(231) NOT NULL,
  `valve` varchar(231) NOT NULL,
  `kunci` varchar(231) NOT NULL,
  `seal_karet_hose` varchar(231) NOT NULL,
  `seal_karet_nozzle` varchar(231) NOT NULL,
  `box_hydrant` varchar(231) NOT NULL,
  `keterangan` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laporan_hydrant`
--

INSERT INTO `laporan_hydrant` (`id`, `nama`, `tanggal_inspeksi`, `code_hydrant`, `nomer_urut`, `lokasi`, `jenis_lokasi`, `hose`, `nozzle`, `valve`, `kunci`, `seal_karet_hose`, `seal_karet_nozzle`, `box_hydrant`, `keterangan`) VALUES
(18, 'Reygha', '2024-11-07', 'HDR036', '10', 'Kantin/Masjid (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Tidak Baik', 'Baik', 'Baik', 'Ada', 'Tidak ada kunci dan selang ada 2'),
(19, 'AripL', '2024-11-08', 'HDR026', 'A15', 'Ruang Isolasi', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', 'Semua Lengkap'),
(20, 'AripL', '2024-11-08', 'HDR027', '1', 'Gerbang Pos security (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', 'Selang ada 2 nozzle ada 2'),
(21, 'AripL', '2024-11-08', 'HDR012', 'A1', 'Pintu Gerbang Pos security', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(22, 'AripL', '2024-11-08', 'HDR013', 'A2', 'Assembly Point', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(23, 'AripL', '2024-11-08', 'HDR028', '2', 'Assembly Point (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', 'Selang ada 2'),
(24, 'AripL', '2024-11-08', 'HDR014', 'A3', 'Area Parkiran Motor FB 1', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(25, 'AripL', '2024-11-08', 'HDR015', 'A4', 'Area Parkiran Motor FB 2', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', 'Selang Ada 2'),
(27, 'nama', '0000-00-00', 'code_hydrant', 'nomer_urut', 'lokasi', 'jenis_lokasi', 'hose', 'nozzle', 'valve', 'kunci', 'seal_karet_hose', 'seal_karet_nozzle', 'box_hydrant', 'keterangan'),
(28, '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', ''),
(29, 'Reygha', '2024-11-12', 'HDR018', 'A7', 'Kontainer Sopir/Area Yard ', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(30, 'AripL', '2024-11-15', 'HDR022', 'A11', 'Glass Store/FC', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(31, 'AripL', '2024-11-15', 'HDR021', 'A10', 'Belakang Boiler', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(32, 'AripL', '2024-11-15', 'HDR005', '-', 'Boiler Besar FC', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(33, 'AripL', '2024-11-15', 'HDR032', '6', 'Belakang KD 13 (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(34, 'AripL', '2024-11-15', 'HDR020', 'A9', 'Klindry 13/Area Hijau ', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(35, 'AripL', '2024-11-15', 'HDR006', '-', 'Powermate 2', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(36, 'AripL', '2024-11-15', 'HDR006', '-', 'Powermate 2', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(37, 'AripL', '2024-11-15', 'HDR008', '-', 'Tool Room', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(38, 'AripL', '2024-11-16', 'HDR007', '-', 'Offline', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(39, 'AripL', '2024-11-16', 'HDR004', '-', 'Schelling', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(40, 'AripL', '2024-11-16', 'HDR003', '-', 'Spindle FA', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', 'Drum Hose Rill Penyok'),
(41, 'AripL', '2024-11-16', 'HDR010', '-', 'SAP Subcont FB', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(42, 'AripL', '2024-11-16', 'HDR011', '-', 'Panel PLN FB', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(43, 'AripL', '2024-11-16', 'HDR017', 'A6', 'Belakang MTC/IPAL', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(44, 'AripL', '2024-11-16', 'HDR019', 'A8', 'Area WareHouse Crating', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(45, 'AripL', '2024-11-18', 'HDR001', '-', 'Toilet FA', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', 'Selang Retak'),
(46, 'AripL', '2024-11-18', 'HDR002', '-', 'Frame FA', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(47, 'AripL', '2024-11-18', 'HDR009', '-', 'Ruang NPD/Quality', 'Indoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Tidak Ada', ''),
(48, 'AripL', '2024-11-18', 'HDR016', 'A5', 'Belakang Toilet FB', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(49, 'AripL', '2024-11-18', 'HDR023', 'A12', 'Dust Colektor 4/FA', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(50, 'AripL', '2024-11-18', 'HDR024', 'A13', 'Dust Colektor 2/FA', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(51, 'AripL', '2024-11-18', 'HDR025', 'A14', 'Belakang Masjid', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(52, 'AripL', '2024-11-18', 'HDR029', '3', 'Unloading Eksport (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(53, 'AripL', '2024-11-18', 'HDR031', '5', 'Belakang KD 6 (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(54, 'AripL', '2024-11-18', 'HDR032', '6', 'Tungku Bakar Boiler (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(55, 'AripL', '2024-11-18', 'HDR033', '7', 'Genset (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', ''),
(56, 'AripL', '2024-11-18', 'HDR035', '9', 'Gardu PLN (Lama)', 'Outdoor', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Ada', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_departemen`
--

CREATE TABLE `tbl_departemen` (
  `id` int(111) NOT NULL,
  `departemen` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_departemen`
--

INSERT INTO `tbl_departemen` (`id`, `departemen`) VALUES
(1, 'Pos Security luar'),
(2, 'Pos Security dalam'),
(3, 'Locker lama'),
(4, 'Gardu PLN 1'),
(5, 'Gardu PLN 2'),
(6, 'Ruang kubikel PLN'),
(7, 'Kantin'),
(8, 'Lobby Office'),
(9, 'Server IT'),
(10, 'Toilet Office '),
(11, 'Ruang NPD'),
(12, 'Bandsaw Jamb'),
(13, 'X-Cut Jamb'),
(14, 'HF Encaps/JCL'),
(15, 'Ripsaw 1 & 2'),
(16, 'Tool room 1'),
(17, 'Tool room 2'),
(18, 'Ruang Training '),
(19, 'Gaujing 1'),
(20, 'DET 1 & 2'),
(21, 'Panel PLN 1'),
(22, 'Panel PLN 2'),
(23, 'Panel PLN 3'),
(24, 'Panel PLN 4'),
(25, '5 in 1'),
(26, 'Hydromat'),
(27, 'Ruang Genset 1'),
(28, 'Ruang Genset 2'),
(29, 'Ruang Genset 3'),
(30, 'Schelling 1 & 2'),
(31, 'X-Brasi Sanding'),
(32, 'Assembling Komponen'),
(33, 'Vacum Time Saver'),
(34, 'Taylor HF Cramping 1'),
(35, 'Taylor HF Cramping 2'),
(36, 'DET Time Saver 1'),
(37, 'DET Time Saver 2'),
(38, 'Ruang pompa Hydrant lama'),
(39, 'Boiler kecil 1'),
(40, 'Boiler kecil 2'),
(41, 'Boiler Besar 1'),
(42, 'Boiler Besar 2'),
(43, 'Glass store 1'),
(44, 'Glass Store 2'),
(45, 'Glass Store 3'),
(46, 'Tanki Solar 1'),
(47, 'Tanki Solar 2'),
(48, 'Ruang Kompresor 1'),
(49, 'Ruang Kompresor 2'),
(50, 'Ruang Penyimpanan Oli'),
(51, 'Radial Arm saw Rijection'),
(52, 'Membran Press'),
(53, 'CNC Pollybase'),
(54, 'Pollybase Assembling'),
(55, 'Finishing Repair'),
(56, 'Finishing 1'),
(57, 'Finishing 2'),
(58, 'PDI'),
(59, 'Panel PLN 1'),
(60, 'Panel PLN 2'),
(61, 'Panel Duscolektor FB'),
(62, 'Srawping'),
(63, 'DET FB 1'),
(64, 'DET FB 2'),
(65, 'Gudang Transit Cat'),
(66, 'Gudang Cat Material B3'),
(67, 'Workshop TPM'),
(68, 'Store Iventory'),
(69, 'Store Sprepart 1'),
(70, 'Store Sprepart 2'),
(71, 'Store Sprepart 3'),
(72, 'Painting 1'),
(73, 'Painting 2'),
(74, 'Sample Maker'),
(75, 'Maintenance 1'),
(76, 'Maintenance 2'),
(77, 'Maintenance 3'),
(78, 'Maintenance 4'),
(79, 'Maintenance Actilen 1'),
(80, 'Maintenance Actilen 2'),
(81, 'Kontainer ruang Driver'),
(82, 'TPS B3'),
(83, 'Office FC'),
(84, 'Unloading Ekspor'),
(85, 'Distribusi Ware House'),
(86, 'Ware House 1'),
(87, 'Ware House 2'),
(88, 'Ware House 3'),
(89, 'Ware House 4'),
(90, 'Crating Area'),
(91, 'Loker Wanita'),
(92, 'Klindry 12'),
(93, 'Klindry 13'),
(94, 'Klindry 14'),
(95, 'Ruang pompa Hydrant baru'),
(96, 'Ruang pompa Hydrant baru'),
(97, 'Ruang Isolasi'),
(98, 'IPAL Domestik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lokasi`
--

CREATE TABLE `tbl_lokasi` (
  `id` int(111) NOT NULL,
  `lokasi` varchar(1322) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_lokasi`
--

INSERT INTO `tbl_lokasi` (`id`, `lokasi`) VALUES
(1, 'FA'),
(2, 'FB'),
(3, 'FC'),
(4, 'Security'),
(5, 'Parkiran Office 1'),
(6, 'Parkiran Office 2'),
(7, 'Parkiran Office 3'),
(8, 'Maintenance\r\n'),
(9, 'Office');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(111) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Reygha', 'rey', '$2y$10$H4zoPpMHa8Sri36Q2o3KpunIVrqQ1wHpYoAuEe87VUybUr2zQMcXO', 'admin'),
(2, 'Bayu', 'bayu', '$2y$10$ZKfGf..v4fqqI7c1CbRFLeNP2nwQiFWgtI0eAdnRzParA8rv4l9hC', 'admin'),
(4, 'AripL', '4608', '$2y$10$hG6cd9Zp4Wfm76J6dCeCQuotqvky5rbrVl.6H6jbY5gcJuKnavIsW', 'admin'),
(12, 'User', 'user', '$2y$10$4WqGM6sI7Uej3VyyNVe2A.X6zmPNmVVmd75EHueg9RPSvGLvm3viy', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_apar`
--
ALTER TABLE `data_apar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_hydrant`
--
ALTER TABLE `data_hydrant`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_apar`
--
ALTER TABLE `jenis_apar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_hydrant`
--
ALTER TABLE `laporan_hydrant`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_departemen`
--
ALTER TABLE `tbl_departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id` int(231) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT untuk tabel `data_apar`
--
ALTER TABLE `data_apar`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT untuk tabel `data_hydrant`
--
ALTER TABLE `data_hydrant`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT untuk tabel `jenis_apar`
--
ALTER TABLE `jenis_apar`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT untuk tabel `laporan_hydrant`
--
ALTER TABLE `laporan_hydrant`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `tbl_departemen`
--
ALTER TABLE `tbl_departemen`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT untuk tabel `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
