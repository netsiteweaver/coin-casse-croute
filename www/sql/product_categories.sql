-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2024 at 03:23 AM
-- Server version: 10.5.22-MariaDB-cll-lve
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cassecroute_db`
--

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `uuid`, `name`, `created_by`, `created_date`, `status`, `photo`, `display_order`) VALUES
(1, '94c5f9c4-f1c3-42a9-85bc-29c4655cb3ca', 'Water', 1, '2023-06-20 13:10:06', 1, '8886def4d27fb4674d6756bc1611a593.jpg', 1),
(7, 'af11b543-727c-4082-bed0-2164805f0569', 'Vehicles', 1, '2023-06-20 13:10:11', 0, '61382059be2e54e4a90fa80c494105eb.jpg', 1),
(8, '22228c9a-590b-4950-ad5c-6a4343a3698f', 'Mine bouillie', 1, '2023-06-20 13:14:58', 1, 'f4833b88d802896c293b7144f003e6cf.jpg', 3),
(9, 'bed50eb2-f680-48d6-b8a0-3d0ae27b53ff', 'Patisserie', 1, '2023-06-20 13:15:03', 0, 'deee7fd34504e69fc942207964392ad0.jpg', 1),
(10, '56d931b8-acfa-494f-8124-d1b79bc60d1e', 'Snacks', 1, '2023-06-26 08:58:07', 1, '619702162d3b86861afedb234dca8970.jpg', 2),
(11, '3f75027d-717f-48d7-a282-d0682a6046d9', 'Cocktails', 2, '2024-02-28 16:26:16', 1, '67d8a403231fb42050b8a58a42ec95e8.jpg', 6),
(12, '34ad9e4b-67e7-4fb9-adc0-fc507e98c204', 'mine frit', 2, '2024-02-28 16:32:54', 1, 'aedb223c8381312068febee1707fe3b0.jpg', 11),
(13, 'e1c1714c-f9d0-4da3-ab06-e6c21fb0c1cb', 'Mine Renversé', 2, '2024-02-28 16:34:26', 1, 'a1710144554323b9a630e55066b24c0f.jpg', 12),
(14, 'c08cf312-4019-46d0-bb53-20951a0c672b', 'Curry & Daube', 2, '2024-02-28 16:35:34', 1, 'c1f49bb0c005adaafca9c3afac450572.jpg', 7),
(15, '3eaef2a6-a6ba-499f-a048-17e8e0b36a57', 'Bol Renversé', 2, '2024-02-28 16:43:40', 1, '34c9f6d4b6d75fefedbc3b6f3f2f5b2b.jpg', 5),
(16, '24398c74-02b3-46e4-b964-8057f30fc25d', 'Riz frit', 2, '2024-02-28 16:44:41', 1, 'a4ad387153d8dcb4aba06a3cd8368591.jpg', 13),
(17, 'cbf4b1c5-405e-4b9f-8e5b-44d1b857368b', 'Sauté uniquement', 2, '2024-02-28 16:45:15', 1, '3bba069c9735e9dd2a623b215bd214f5.jpg', 15),
(18, 'd46a647f-2d53-4e0b-a99c-1e16155a1eaf', 'Bouillion meefoon', 2, '2024-02-28 16:49:12', 1, '3373469239c728ca51e2b5ae534ed72f.jpg', 4),
(19, 'd426a0e7-6e7d-4712-b33d-2f3365377b2f', 'Meefoon frit', 2, '2024-02-28 16:53:48', 1, '73f05d50ea2193db4e6b66c8dad2c2c5.jpg', 10),
(20, 'bc8bcd63-7d5d-4842-b30f-b11d869a57c6', 'Basilique', 2, '2024-02-28 16:54:03', 1, '84897826cf7e7cee3d964f5655894729.jpg', 16),
(21, 'b9d754bc-3a61-4c1a-a56a-2f2bf376ef75', 'Drinks', 2, '2024-02-28 16:57:54', 1, '2a3328c6957923facfc310b28460c8d7.jpg', 8),
(22, '8d7ce13e-6337-4f4d-84e7-bf439dd5ac48', 'Entrée', 2, '2024-02-28 17:03:21', 1, '3574a51c1571b6ee47e66a02c730aa61.jpg', 9),
(23, '78446d2e-bd04-466d-9992-a13e4d88fe7e', 'Salmi', 2, '2024-02-28 17:03:31', 1, 'fd84dff37367853d3fbbfb58b1629b33.jpg', 14);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
