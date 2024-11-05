-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Okt 2023 pada 15.09
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `peran` varchar(10) DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `peran`) VALUES
(4, 'admin@gmail.com', '$2y$10$0a2vQrGas1L.xTUICyPO5uhMM0YBcHR5TGAH/2k8n5t4PX5icK3be', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_terjual`
--

CREATE TABLE `data_terjual` (
  `id_terjual` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'berhasil',
  `tanggal_terjual` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_menu` int(11) DEFAULT NULL,
  `jumlah_terjual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_terjual`
--

INSERT INTO `data_terjual` (`id_terjual`, `id_order`, `status`, `tanggal_terjual`, `id_menu`, `jumlah_terjual`) VALUES
(14, NULL, 'berhasil', '2023-10-22 23:40:04', 12, 1),
(15, NULL, 'berhasil', '2023-10-22 23:40:07', 12, 1),
(16, NULL, 'berhasil', '2023-10-22 23:40:35', 12, 1),
(17, NULL, 'berhasil', '2023-10-22 23:40:38', 12, 1),
(18, NULL, 'berhasil', '2023-10-22 23:40:40', 12, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id_order` int(11) NOT NULL,
  `tanggal_order` date NOT NULL,
  `total_belanja` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_product`
--

CREATE TABLE `order_product` (
  `id_order_product` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_menu` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `jenis_menu` varchar(50) NOT NULL,
  `deskripsi` varchar(225) NOT NULL,
  `stok` int(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_menu`, `nama_menu`, `jenis_menu`, `deskripsi`, `stok`, `harga`, `gambar`) VALUES
(5, 'Shoyu Ramen Noodles', 'Makanan', 'A ramen dish with a broth made of soy sauce. Shoyu means soy sauce in Japanese.', 100, 46500, '6238083cdbed4e1243890eb8f4e53867.jpg'),
(6, 'Sweet Iced Tea', 'Minuman', ' made by adding sugar or simple syrup to black tea while the tea is either brewing or still hot, and adding iced after it.', 100, 15600, '0ae73e9c750417147f5808f284989399.jpg'),
(7, 'Tonkotsu Ramen', 'Makanan', 'Dish that originated in Fukuoka, The soup broth is based on pork bones and other ingredients, which are typically boiled for several hours.', 100, 52700, 'e7a055c298143b479ade0bda6bd53dcf.jpg'),
(8, 'Miso Soup', 'Makanan', 'Traditional Japanese soup consisting of a dashi stock into which softened miso paste is mixed. ', 100, 37900, 'dc872932570ac88f164fd2715c3f6a84.jpg'),
(9, 'Tsukemen', 'Makanan', 'A ramen dish in Japanese cuisine consisting of noodles that are eaten after being dipped in a separate bowl of soup or broth.', 100, 48500, 'tsukemen.jpg'),
(13, 'Ocha', 'Minuman', 'A type of tea that is made from Camellia sinensis leaves and buds that have not undergone the same withering and oxidation process.', 100, 15600, 'c2c9ec3de5965dcfb42ec77ab9ec8f6d.jpg'),
(14, 'Lemon Tea', 'Minuman', 'A refreshing tea where lemon juice is added in black or green tea.', 100, 20600, '457f5fd968dde3006ceb686b69dcc2b5.jpg'),
(15, 'Sakura Latte', 'Minuman', 'A sweet and creamy warm drink that blends milk with cherry blossom powder. ', 100, 25600, 'dec0a5277cd5ea35553f78d561a9bfae.jpg'),
(16, 'Coffe Latte', 'Minuman', 'A milk coffee that is a made up of one or two shots of espresso, steamed milk and a final, thin layer of frothed milk on top.', 100, 25600, 'a1d88cadc7f1b9fd65238f39ae295d1b.jpg'),
(17, 'Sashimi Platter', 'Makanan', 'Japanese delicacy consisting of fresh raw fish or meat sliced into thin pieces and often eaten with soy sauce.', 100, 76200, 'd65241e127481217f729a3762db5e386.jpg'),
(18, 'Takoyaki', 'Makanan', 'A ramen dish in Japanese cuisine consisting of noodles that are eaten after being dipped in a separate bowl of soup or broth.', 100, 48500, 'takos.jpg'),
(19, 'Okonomiyaki', 'Makanan', 'Japanese teppanyaki, savoury pancake dish consisting of wheat flour batter and other ingredients cooked on a teppan.', 100, 38700, 'WhatsApp Image 2023-10-24 at 17.00.41 (1).jpeg'),
(20, 'Matcha Latte', 'Minuman', 'Consists of matcha powder (made from the finely-ground leaves of certain green tea plants), water, and milk.', 100, 25600, 'WhatsApp Image 2023-10-24 at 17.00.41.jpeg'),
(21, 'Sushi Platter', 'Makanan', 'A dish of vinegared rice served with various fillings and toppings, which may include raw fish.', 100, 52300, 'efca2616e091e0d86892c94961c0be61.jpg'),
(22, 'Gyoza', 'Makanan', 'Japanese dumpling dish. Made by wrapping a mixture of ground meat and vegetables in a thin dough wrapper.', 100, 36500, 'a4dd549cecc7e72402f2e5f893f0d0ea.jpg'),
(23, 'Miso Ramen', 'Makanan', 'Japanese noodle soup typically made with a base of chicken or pork stock, combined with miso paste.', 100, 50200, '9f1a597a328fecd51e46d1ce89857408.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `peran` varchar(10) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `nomor_telepon`, `password`, `gender`, `birthdate`, `peran`) VALUES
(1, 'tamara', 'zumaidah', 'user@gmail.com', '0987654321', '$2y$10$QT1lDqJoxZArPpA.o4hF/OW61JlAAkVZvAax1RmR4ulT4h4IFW8cu', 'female', '2004-01-02', 'user'),
(7, 'saya', 'saya', 'saya@gmail.com', '34143141', '$2y$10$YZQOG9emkXU7SxbwnR5y/.ecmu33BBW4BPxrT2SCnU0ZyGQLwUxbi', 'male', '2023-10-23', 'user'),
(8, 'saya', 'saya', 'saya@saya.com', '3512531', '$2y$10$T14Y/Zv2X8.FzOAtMoC6HOAWTcuYYu64dKIiypHmLhcMvxW2E5V.G', 'female', '2023-10-13', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `data_terjual`
--
ALTER TABLE `data_terjual`
  ADD PRIMARY KEY (`id_terjual`),
  ADD KEY `id_order` (`id_order`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id_order_product`),
  ADD KEY `id_order` (`id_order`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_terjual`
--
ALTER TABLE `data_terjual`
  MODIFY `id_terjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id_order_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_terjual`
--
ALTER TABLE `data_terjual`
  ADD CONSTRAINT `data_terjual_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
