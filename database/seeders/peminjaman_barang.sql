-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 13 Des 2023 pada 15.52
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan_barang` enum('satuan','kelompok') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_barang` enum('ada','dipinjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_satuan` int NOT NULL,
  `tipe_barang_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barangs`
--

INSERT INTO `barangs` (`id`, `kode_barang`, `nama_barang`, `satuan_barang`, `status_barang`, `jumlah_satuan`, `tipe_barang_id`, `created_at`, `updated_at`) VALUES
(1, 'LTP-ACER-07', 'Laptop Acer No 07', 'satuan', 'ada', 1, 1, '2023-10-21 08:18:59', '2023-12-13 15:38:15'),
(2, 'LTP-ACER-21', 'Laptop Acer No 21', 'satuan', 'ada', 1, 1, '2023-10-21 08:18:59', '2023-10-21 08:18:59'),
(3, 'LTP-ASUS-29', 'Laptop Asus No 29', 'satuan', 'ada', 1, 1, '2023-10-21 08:18:59', '2023-12-13 15:38:15'),
(4, 'LTP-ASUS-02', 'Laptop Asus No 02', 'satuan', 'ada', 1, 1, '2023-10-21 08:18:59', '2023-10-21 08:18:59'),
(6, 'RTR-BOX-01', 'Router Box 1', 'kelompok', 'ada', 10, 2, '2023-10-21 08:18:59', '2023-10-23 02:04:19'),
(7, 'RTR-BOX-02', 'Router Box 2', 'kelompok', 'ada', 10, 2, '2023-10-21 08:18:59', '2023-10-23 02:04:43'),
(8, 'RTR-BOX-03', 'Router Box 3', 'kelompok', 'ada', 10, 2, '2023-10-21 08:18:59', '2023-10-21 08:18:59'),
(9, 'CONV-LAN-BOX-01', 'Konverter LAN Box 1', 'kelompok', 'ada', 10, 3, '2023-10-21 08:18:59', '2023-10-21 08:18:59'),
(10, 'CONV-LAN-BOX-02', 'Konverter LAN Box 2', 'kelompok', 'ada', 10, 3, '2023-10-21 08:18:59', '2023-10-21 08:18:59'),
(11, 'CONV-LAN-BOX-03', 'Konverter LAN Box 3', 'kelompok', 'ada', 10, 3, '2023-10-21 08:18:59', '2023-10-22 08:22:28'),
(12, 'RTR-BOX-04', 'Router Box No 4', 'kelompok', 'ada', 10, 2, '2023-10-21 08:33:04', '2023-10-21 08:33:04'),
(14, 'LTP-ACER-12', 'Laptop Acer No 12', 'satuan', 'ada', 1, 1, '2023-10-21 08:33:04', '2023-10-21 08:33:04'),
(15, 'LTP-ASUS-32', 'Laptop Acer No 32', 'satuan', 'ada', 1, 1, '2023-10-21 08:33:04', '2023-10-21 08:33:04'),
(16, 'SW-BOX-01', 'Switch Box 1', 'kelompok', 'ada', 5, 4, '2023-10-22 08:19:53', '2023-10-23 02:03:58'),
(17, 'SW-BOX-02', 'Switch Box 2', 'kelompok', 'ada', 5, 4, '2023-10-22 08:28:06', '2023-10-23 02:04:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `created_at`, `updated_at`) VALUES
(1, 'X TJKT 1', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(2, 'X TJKT 2', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(3, 'X TJKT 3', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(4, 'X TJKT 4', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(5, 'X TO 1', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(6, 'X TO 2', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(7, 'X TO 3', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(8, 'X TO 4', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(9, 'X TE 1', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(10, 'X TE 2', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(11, 'X TE 3', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(12, 'X TE 4', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(13, 'XI TJKT 1', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(14, 'XI TJKT 2', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(15, 'XI TJKT 3', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(16, 'XI TJKT 4', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(17, 'XI TO 1', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(18, 'XI TO 2', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(19, 'XI TO 3', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(20, 'XI TO 4', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(21, 'XI TE 1', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(22, 'XI TE 2', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(23, 'XI TE 3', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(24, 'XI TE 4', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(25, 'XII TKJ 1', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(26, 'XII TKJ 2', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(27, 'XII TKJ 3', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(28, 'XII TKJ 4', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(29, 'XII TKRO 1', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(30, 'XII TKRO 2', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(31, 'XII TKRO 3', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(32, 'XII TKRO 4', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(33, 'XII TAV 1', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(34, 'XII TAV 2', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(35, 'XII TAV 3', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(36, 'XII TAV 4', '2023-07-05 07:47:41', '2023-07-05 07:47:41'),
(37, 'ADMIN', '2023-10-21 08:14:37', '2023-10-21 08:14:37'),
(38, 'UMUM', NULL, NULL),
(40, 'ALUMNI', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_10_11_000000_create_kelas_table', 1),
(5, '2023_10_11_000000_create_tahun_ajarans_table', 1),
(6, '2023_10_11_000000_create_tipe_barangs_table', 1),
(7, '2023_10_11_000001_create_users_table', 1),
(8, '2023_10_11_013049_create_barangs_table', 1),
(9, '2023_10_11_014254_create_pinjams_table', 1),
(10, '2023_10_11_014858_create_pengaturans_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturans`
--

CREATE TABLE `pengaturans` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_sekolah` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjams`
--

CREATE TABLE `pinjams` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `tahun_ajaran_id` bigint UNSIGNED NOT NULL,
  `waktu_pinjam` datetime NOT NULL,
  `waktu_kembali` datetime DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajarans`
--

CREATE TABLE `tahun_ajarans` (
  `id` bigint UNSIGNED NOT NULL,
  `tahun_ajaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_ajarans`
--

INSERT INTO `tahun_ajarans` (`id`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
(1, '2023/2024', '2023-10-21 08:18:59', '2023-10-21 08:18:59'),
(2, '2024/2025', '2023-10-21 08:18:59', '2023-10-21 08:18:59'),
(3, '2025/2026', '2023-10-21 08:18:59', '2023-10-21 08:18:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_barangs`
--

CREATE TABLE `tipe_barangs` (
  `id` bigint UNSIGNED NOT NULL,
  `tipe_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tipe_barangs`
--

INSERT INTO `tipe_barangs` (`id`, `tipe_barang`, `total_stok`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 6, '2023-10-21 08:18:59', '2023-12-13 15:38:15'),
(2, 'Router', 40, '2023-10-21 08:18:59', '2023-10-23 02:04:43'),
(3, 'Konverter LAN', 30, '2023-10-21 08:18:59', '2023-10-22 08:22:28'),
(4, 'Switch', 20, '2023-10-22 08:02:01', '2023-10-23 02:04:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nisn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nis`, `nisn`, `nama`, `gender`, `kelas_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'Admin', 'L', 37, '$2y$10$wj8a0JrHqh2B2TYOvOsmhObrpY9O1YjhM7G.Ynu5OOIAyDRz9GS9i', '2023-10-22 07:47:12', '2023-12-13 15:40:55'),
(2, '0001', '0', 'User 1', 'L', 1, NULL, '2023-10-22 07:47:24', '2023-12-13 15:48:16'),
(3, '0002', '0', 'User 2', 'L', 1, NULL, '2023-10-22 07:47:24', '2023-10-22 07:47:24'),
(4, '0003', '0', 'User 3', 'P', 1, NULL, '2023-10-22 07:47:24', '2023-10-22 07:47:24'),
(5, '0004', '0', 'User 4', 'P', 1, NULL, '2023-10-22 07:47:24', '2023-10-22 07:47:24'),
(6, '0005', '0', 'User 5', 'P', 1, NULL, '2023-10-22 07:47:24', '2023-10-22 07:47:24'),
(7, '0006', '0', 'User 6', 'P', 1, NULL, '2023-10-22 07:47:24', '2023-10-22 07:47:24'),
(8, '0007', '0', 'User 7', 'L', 1, NULL, '2023-10-22 07:47:24', '2023-10-22 07:47:24'),
(9, '0008', '0', 'User 8', 'P', 1, NULL, '2023-10-22 07:47:24', '2023-10-22 07:47:24'),
(10, '0009', '0', 'User 9', 'P', 1, NULL, '2023-10-22 07:47:24', '2023-10-22 07:47:24');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barangs_tipe_barang_id_foreign` (`tipe_barang_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pengaturans`
--
ALTER TABLE `pengaturans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `pinjams`
--
ALTER TABLE `pinjams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pinjams_user_id_foreign` (`user_id`),
  ADD KEY `pinjams_barang_id_foreign` (`barang_id`),
  ADD KEY `pinjams_tahun_ajaran_id_foreign` (`tahun_ajaran_id`);

--
-- Indeks untuk tabel `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tipe_barangs`
--
ALTER TABLE `tipe_barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_kelas_id_foreign` (`kelas_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengaturans`
--
ALTER TABLE `pengaturans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pinjams`
--
ALTER TABLE `pinjams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tipe_barangs`
--
ALTER TABLE `tipe_barangs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=434;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `barangs_tipe_barang_id_foreign` FOREIGN KEY (`tipe_barang_id`) REFERENCES `tipe_barangs` (`id`);

--
-- Ketidakleluasaan untuk tabel `pinjams`
--
ALTER TABLE `pinjams`
  ADD CONSTRAINT `pinjams_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barangs` (`id`),
  ADD CONSTRAINT `pinjams_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`),
  ADD CONSTRAINT `pinjams_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
