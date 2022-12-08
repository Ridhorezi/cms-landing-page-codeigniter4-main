-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Des 2022 pada 07.27
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-landing-page`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `quote` varchar(255) NOT NULL,
  `url_video` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `quote`, `url_video`, `created_at`) VALUES
(1, 'About <span>Company</span>', 'Learn more about us, its only 30 mins', 'https://www.youtube.com/watch?v=d3ZKSmCWwJw', '2022-12-06 03:15:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(25) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `fullname`, `email`, `token`, `created_at`, `last_login`) VALUES
(1, 'Admin', '$2y$10$IMm3IbUW6xRxC1HJ/uKCqOhD5ewclQ.PnFCnOWC2o3d5pB8haFS4K', 'Ridho Suhaebi', 'ridhorezi1212@gmail.com', 'e101ff85b638aa7dd7bea0aa15cd73c4', '2022-12-06 15:12:29', '2022-11-19 11:31:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Web Development'),
(2, 'Mobile Development'),
(3, 'Startup Development\r\n'),
(4, 'Cyber Scurity'),
(5, 'UI/UX Design'),
(6, 'Database Architecture');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `homes`
--

CREATE TABLE `homes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `quote` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `homes`
--

INSERT INTO `homes` (`id`, `title`, `quote`, `video`, `created_at`) VALUES
(1, 'Hi, we are <br> GBVRJ SOLUTIONS TECHNOLOGY', '                                                                                                        Building an extraordinary Mobile App? That\'s not our job. That\'s OUR PASSION                                                                           ', '1670296300_125b5dbcf742c98005c3.mp4', '2022-12-06 03:39:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_contact` varchar(255) NOT NULL,
  `company_mail` varchar(50) NOT NULL,
  `company_location` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `info`
--

INSERT INTO `info` (`id`, `company_name`, `company_contact`, `company_mail`, `company_location`, `copyright`, `created_at`) VALUES
(1, 'Gbvrj Solutions Technology', '01212121212', 'gbvrj@gmail.com', ' Ruko Taman Kota Bekasi H-6, Jl. Ki Mangun Sarkoro, Kota Bekasi 17112 - Indonesia', '2022 - Gbrvj Solutions Technology LTD', '2022-12-06 03:31:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-09-16-044652', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1663314707, 1),
(2, '2022-09-23-160753', 'App\\Database\\Migrations\\ModifyColumnTokenAdmin', 'default', 'App', 1663949522, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `professions`
--

CREATE TABLE `professions` (
  `profession_id` int(11) NOT NULL,
  `profession_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `professions`
--

INSERT INTO `professions` (`profession_id`, `profession_name`) VALUES
(1, 'IT'),
(2, 'Bussines Analyst'),
(3, 'Project Manager');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `services_category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `quotes` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `label_icon` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `services_category_id`, `title`, `quotes`, `description`, `label_icon`, `created_at`) VALUES
(1, 1, 'Our <span>Services</span>', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.', '                                                                                                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.                                          ', 'laptop', '2022-12-06 03:38:06'),
(2, 2, 'Our <span>Services</span>', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.', '                                                                                                                                                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod', 'tablet', '2022-12-06 03:43:49'),
(3, 5, 'Our <span>Services</span>', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.', '                                                                                                                                                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod', 'layers', '2022-12-06 03:43:59'),
(4, 6, 'Our <span>Services</span>', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.', '                                                                                                                                                                                                                                Lorem ipsum dolor sit amet, con', 'database', '2022-12-06 03:46:42'),
(5, 4, 'Our <span>Services</span>', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit<br>', 'magnifier', '2022-12-06 04:07:53'),
(6, 3, 'Our <span>Services</span>', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy <br> nibh euismod tincidunt ut laoreet dolore magna.', '                                                                                                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit<br>                                                                                   ', 'star', '2022-12-06 04:09:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quote` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_profession_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`id`, `image`, `quote`, `name`, `user_profession_id`, `created_at`) VALUES
(1, '1670296829_c6765d267236412b9e8e.jpg', 'Best Company Builder In The World', 'Jefi Albukhari', '1', '2022-12-06 03:20:29'),
(2, '1670296966_ea55f9079d4a06fdbb1a.jpg', 'I am very happy with the service from gbvrj solution technology                                                                                                        ', 'Anisatul Ma\'rifah', '2', '2022-12-06 03:22:46'),
(3, '1670297196_24d8f8d2e298dd98bb87.jpg', '<font color=\"#888888\" face=\"Raleway, sans-serif\"><span style=\"font-size: 24px; background-color: rgb(245, 245, 245);\">Working with the Gbvrj team was a pleasure. They understood what I wanted and created a fantastic mobile app for my company.</span></font', 'Della Krisnauly', '3', '2022-12-06 03:26:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visitor_stats`
--

CREATE TABLE `visitor_stats` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `works`
--

CREATE TABLE `works` (
  `id` int(11) NOT NULL,
  `works_category_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `quote` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `filter` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `works`
--

INSERT INTO `works` (`id`, `works_category_id`, `title`, `quote`, `image`, `filter`, `created_at`) VALUES
(1, 1, 'Our <span>Works</span>', '                                                                                                        Since 2022, we have delivered more than 20 successful web app, mobile app, and other projects. <br> These are the most highlighted apps we have de', '1670301039_510c54ac471dd32ebcdd.jpg', 'web', '2022-12-06 04:30:39'),
(2, 2, 'Our <span>Works</span>', 'Since 2022, we have delivered more than 20 successful web app, mobile app, and other projects. &lt;br&gt; These are the most highlighted apps we have developed.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;', '1670300519_e88b8acc1d43e615b4f7.jpg', 'mobile', '2022-12-06 04:21:59'),
(3, 5, 'Our <span>Works</span>', 'Since 2022, we have delivered more than 20 successful web app, mobile app, and other projects. &lt;br&gt; These are the most highlighted apps we have developed.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;', '1670300926_9a516b9b131d697b7caf.jpg', 'uiux', '2022-12-06 04:28:46'),
(4, 6, 'Our <span>Works</span>', '                                                    <span style=\"color: rgb(96, 112, 128); font-family: Nunito;\">Since 2022, we have delivered more than 20 successful web app, mobile app, and other projects. <br> These are the most highlighted apps w', '1670301874_38e1831ce4fb6da51f2b.jpeg', 'database', '2022-12-06 04:44:34'),
(5, 4, 'Our <span>Works</span>', '<span style=\"color: rgb(96, 112, 128); font-family: Nunito;\">Since 2022, we have delivered more than 20 successful web app, mobile app, and other projects. &lt;br&gt; These are the most highlighted apps we have developed.&nbsp; &nbsp; &nbsp; &nbsp;</', '1670301626_ec4c135f4f6e43484577.png', 'cyberscurity', '2022-12-06 04:40:26'),
(7, 3, 'Our <span>Works</span>', 'Since 2022, we have delivered more than 20 successful web app, mobile app, and other projects. <br> These are the most highlighted apps we have developed.       ', '1670301781_25da6b12758c30d67518.png', 'startup', '2022-12-06 04:43:44');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`profession_id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `visitor_stats`
--
ALTER TABLE `visitor_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `homes`
--
ALTER TABLE `homes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `professions`
--
ALTER TABLE `professions`
  MODIFY `profession_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `visitor_stats`
--
ALTER TABLE `visitor_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `works`
--
ALTER TABLE `works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
