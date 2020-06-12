-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 19 Des 2019 pada 16.17
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mimishop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `id_account` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `confirm_password` varchar(100) NOT NULL,
  `role` enum('admin','member') NOT NULL,
  `phone` varchar(100) NOT NULL,
  `gender` enum('P','L') NOT NULL,
  `address` varchar(100) NOT NULL,
  `profile_picture` varchar(100) NOT NULL,
  `terms_and_condition` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`id_account`, `fullname`, `email`, `password`, `confirm_password`, `role`, `phone`, `gender`, `address`, `profile_picture`, `terms_and_condition`) VALUES
(2, 'ferdy1', 'ferdyp73@gmail.com', 'ferdot', 'ferdot', 'member', '0895355153024', 'L', 'Jl. bohar balun', 'image/uploads/account/5/profile.jpg', 'Y'),
(3, 'tes', 'tes@gmail.com', 'tes', 'tes', 'admin', '09090', 'L', 'tes', 'image/uploads/account/3/profile.jpg', 'Y'),
(4, 'ucok', 'ucok@gmail.com', 'ucok', 'ucok', 'admin', '0909090', 'L', 'ucok', 'image/uploads/account/4/profile.jpg', 'Y'),
(5, 'hai', 'hai@gmail.com', 'hai', 'hai', 'admin', '090909', 'L', 'asda', 'image/uploads/account/5/profile.jpg', 'Y'),
(6, 'admin', 'admin@gmail.com', 'admin', 'admin', 'admin', '090909', 'L', 'admin', 'image/uploads/account/6/profile.jpg', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_figure` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id_cart`, `id_figure`, `id_account`, `qty`) VALUES
(1, 1, 6, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `category_name`) VALUES
(1, 'category2'),
(2, 'tac');

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `status` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `feedback`, `status`) VALUES
(1, 'Hai', 'Y'),
(2, 'tes', 'N'),
(3, 'tes', 'N'),
(4, 'tes', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `figure`
--

CREATE TABLE `figure` (
  `id_figure` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_category` varchar(11) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `stock` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `figure`
--

INSERT INTO `figure` (`id_figure`, `name`, `id_category`, `price`, `description`, `stock`, `image`) VALUES
(1, '1asd2', '1', 1000, 'asd', 1000, 'image/uploads/figure/1/figure.jpg'),
(2, 'tes3', '1', 100000, 'asd', 90, 'image/uploads/figure/2/figure.jpg'),
(3, 'asdasd', '1', 100000, 'asdasd', 1000, 'image/uploads/figure/3/figure.jpg'),
(4, 'asdasd', '1', 10000, 'asdsad', 10000, 'image/uploads/figure/4/figure.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `id_account`, `date`) VALUES
(1, 6, '2019-12-19'),
(2, 6, '2019-12-19'),
(3, 6, '2019-12-19'),
(4, 6, '2019-12-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id_detail` int(11) NOT NULL,
  `id_transaction` int(11) NOT NULL,
  `id_figure` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction_detail`
--

INSERT INTO `transaction_detail` (`id_detail`, `id_transaction`, `id_figure`, `qty`) VALUES
(1, 2, 3, 1),
(2, 3, 3, 1),
(3, 4, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`,`id_figure`,`id_account`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Indeks untuk tabel `figure`
--
ALTER TABLE `figure`
  ADD PRIMARY KEY (`id_figure`,`id_category`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`,`id_account`);

--
-- Indeks untuk tabel `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id_detail`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
