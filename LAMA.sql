-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2020 at 11:54 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `LAMA`
--

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `has_parent`, `parent_id`, `has_child`, `title`, `sys_title`, `file_name`, `icon`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, 0, 'داشبورد', 'dashboard', 'Dashboard', 'fa-columns', 1, 'user', NULL, '2020-05-04 05:39:39'),
(2, 0, NULL, 1, 'مدیریت ماژول ها', 'module_management', 'ModuleManagement', 'fa-paperclip', 1, 'dev', NULL, '2020-05-04 07:09:26'),
(3, 0, NULL, 0, 'مدیریت نقش ها', 'role_management', 'RoleManagement', 'fa-paperclip', 1, 'user', NULL, '2020-05-04 07:09:44'),
(4, 1, 2, 0, 'اضافه کردن ماژول', 'add_module', 'AddModule', 'fa-paperclip', 1, 'user', '2020-05-03 05:56:16', '2020-05-03 05:56:16'),
(5, 1, 2, 0, 'لیست ماژول ها', 'modules_list', 'ModulesList', 'fa-paperclip', 1, 'user', '2020-05-03 06:09:51', '2020-05-04 06:44:58');

--
-- Dumping data for table `organs`
--

INSERT INTO `organs` (`id`, `title`, `sys_title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'first organ', 'first_organ', NULL, 1, NULL, NULL),
(2, 'second organ', 'second_organ', NULL, 1, NULL, NULL),
(3, 'third organ', 'third_organ', NULL, 1, NULL, NULL);

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `sys_title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'super_admin', NULL, 1, NULL, NULL),
(2, 'test admin', 'test_admin', NULL, 1, NULL, NULL);

--
-- Dumping data for table `role__module`
--

INSERT INTO `role__module` (`id`, `role_id`, `module_id`, `read_access`, `save_access`, `edit_access`, `remove_access`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(2, 1, 2, 1, 1, 1, 1, 1, NULL, NULL),
(3, 1, 3, 1, 1, 1, 1, 1, NULL, NULL),
(4, 1, 4, 1, 1, 1, 1, 1, NULL, NULL),
(5, 1, 3, 1, 1, 1, 1, 1, NULL, NULL),
(6, 1, 4, 1, 1, 1, 1, 1, NULL, NULL),
(7, 1, 5, 1, 1, 1, 1, 1, NULL, NULL);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admini', 'admin', 'admin@gmail.com', NULL, '$2y$10$8TFLNjbIuqFGMGnl5k2N5.cS9Uaiph5dNCTmQDYQVbpK17WcIFoIu', 1, 'suxIhCD2nQPn72VJorUj6RVGCvOqPVh56YHJXk4zxm01CITswVR9xNTZnnpA', NULL, NULL),
(2, NULL, NULL, 'ali', 'ali@ali.ali', NULL, '$2y$10$TzE1xVIcJxdiq31J5UAdo.BD/Yos6Zh8prV/tD5xBUokLxm5GuB.q', 1, NULL, '2020-04-27 03:03:52', '2020-04-27 03:03:52');

--
-- Dumping data for table `user__role__organ`
--

INSERT INTO `user__role__organ` (`id`, `user_id`, `role_id`, `organ_id`, `is_default`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, NULL, NULL),
(2, 1, 2, 1, 0, 1, NULL, NULL),
(3, 1, 1, 2, 0, 1, NULL, NULL);

--
-- Dumping data for table `methods`
--

INSERT INTO `methods` (`id`, `module_id`, `public_name`, `sys_name`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'view', 'view', 'read', 1, NULL, NULL),
(2, 1, 'view', 'view', 'read', 1, NULL, NULL),
(4, 4, 'getModulesList', 'getModulesList', 'read', 1, NULL, NULL),
(5, 4, 'addModule', 'addModule', 'save', 1, NULL, NULL),
(6, 5, 'view', 'view', 'read', 1, NULL, NULL),
(7, 5, 'getModulesList', 'getModulesList', 'read', 1, NULL, NULL),
(8, 5, 'getModuleDetails', 'getModuleDetails', 'read', 1, NULL, NULL),
(9, 5, 'removeModule', 'removeModule', 'remove', 1, NULL, NULL),
(10, 5, 'editModule', 'editModule', 'edit', 1, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
