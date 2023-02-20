-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Feb 2023 pada 17.04
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkbnt`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_entropy`
--

CREATE TABLE `bobot_entropy` (
  `id_bobot` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bobot_entropy`
--

INSERT INTO `bobot_entropy` (`id_bobot`, `id_kriteria`, `nilai_bobot`) VALUES
(1, 9, 0.423665),
(2, 10, 0.16796),
(3, 11, 0.0435106),
(4, 12, 0.0364126),
(5, 13, 0.0435106),
(6, 14, 0.0578199),
(7, 15, 0.227122);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_kriteria`
--

CREATE TABLE `detail_kriteria` (
  `id_detail_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_kriteria`
--

INSERT INTO `detail_kriteria` (`id_detail_kriteria`, `id_kriteria`, `keterangan`, `nilai`) VALUES
(30, 9, '1.000.000-1.500.000', 5),
(31, 9, '1.500.000-3000.000', 4),
(32, 9, '3.000.000 - Lebih', 2),
(33, 10, 'Mempunyai', 5),
(34, 10, 'Tidak mempunyai', 3),
(35, 11, 'Tidak layak (Rumah  berdinding Gedek,beralas tanah liat)', 5),
(36, 11, 'Sedang (Rumah 1 Lantai Beralas Keramik)', 4),
(37, 11, 'Bagus  ( rumah 2 Lantai ber Alas Granit)', 3),
(38, 12, '≥5 Orang', 5),
(39, 12, '4 Orang', 4),
(40, 12, '3 Orang', 3),
(41, 12, '2 Orang', 2),
(42, 13, 'Belum Berkeluarga', 3),
(43, 13, 'Berkeluarga', 4),
(44, 14, '450 Watt', 5),
(45, 14, '900 Watt', 4),
(46, 14, '1300 Watt', 2),
(47, 15, '1 Buah', 4),
(48, 15, '2 Buah ', 3),
(49, 15, '3 Buah', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ej`
--

CREATE TABLE `ej` (
  `id_ej` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_ej` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ej`
--

INSERT INTO `ej` (`id_ej`, `id_kriteria`, `nilai_ej`) VALUES
(1, 9, 0.0262558),
(2, 10, 0.010409),
(3, 11, 0.00269648),
(4, 12, 0.0022566),
(5, 13, 0.00269648),
(6, 14, 0.00358327),
(7, 15, 0.0140754);

-- --------------------------------------------------------

--
-- Struktur dari tabel `entropy_tiap_atribut`
--

CREATE TABLE `entropy_tiap_atribut` (
  `id_entropy_tiap_atribut` int(11) NOT NULL,
  `nik` varchar(110) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_entropy_tiap_atribut` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `entropy_tiap_atribut`
--

INSERT INTO `entropy_tiap_atribut` (`id_entropy_tiap_atribut`, `nik`, `id_kriteria`, `nilai_entropy_tiap_atribut`) VALUES
(1, '3514091106780001', 9, -0.346574),
(2, '3514091106780001', 10, -0.331751),
(3, '3514091106780001', 11, -0.315853),
(4, '3514091106780001', 12, -0.326795),
(5, '3514091106780001', 13, -0.315853),
(6, '3514091106780001', 14, -0.331751),
(7, '3514091106780001', 15, -0.352468),
(8, '3515040504550002', 9, -0.346574),
(9, '3515040504550002', 10, -0.331751),
(10, '3515040504550002', 11, -0.315853),
(11, '3515040504550002', 12, -0.298627),
(12, '3515040504550002', 13, -0.315853),
(13, '3515040504550002', 14, -0.304209),
(14, '3515040504550002', 15, -0.321888),
(15, '3515040307520005', 9, -0.321888),
(16, '3515040307520005', 10, -0.331751),
(17, '3515040307520005', 11, -0.315853),
(18, '3515040307520005', 12, -0.326795),
(19, '3515040307520005', 13, -0.315853),
(20, '3515040307520005', 14, -0.331751),
(21, '3515040307520005', 15, -0.321888),
(22, '3515040601640001', 9, -0.230259),
(23, '3515040601640001', 10, -0.331751),
(24, '3515040601640001', 11, -0.315853),
(25, '3515040601640001', 12, -0.326795),
(26, '3515040601640001', 13, -0.315853),
(27, '3515040601640001', 14, -0.331751),
(28, '3515040601640001', 15, -0.268653);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `nik` varchar(123) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `jawaban_peserta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `nik`, `id_kriteria`, `jawaban_peserta`) VALUES
(92, '3514091106780001', 9, 5),
(93, '3514091106780001', 10, 5),
(94, '3514091106780001', 11, 4),
(95, '3514091106780001', 12, 5),
(96, '3514091106780001', 13, 4),
(97, '3514091106780001', 14, 5),
(98, '3514091106780001', 15, 4),
(99, '3515040504550002', 9, 5),
(100, '3515040504550002', 10, 5),
(101, '3515040504550002', 11, 4),
(102, '3515040504550002', 12, 4),
(103, '3515040504550002', 13, 4),
(104, '3515040504550002', 14, 4),
(105, '3515040504550002', 15, 3),
(106, '3515040307520005', 9, 4),
(107, '3515040307520005', 10, 5),
(108, '3515040307520005', 11, 4),
(109, '3515040307520005', 12, 5),
(110, '3515040307520005', 13, 4),
(111, '3515040307520005', 14, 5),
(112, '3515040307520005', 15, 3),
(113, '3515040601640001', 9, 2),
(114, '3515040601640001', 10, 5),
(115, '3515040601640001', 11, 4),
(116, '3515040601640001', 12, 5),
(117, '3515040601640001', 13, 4),
(118, '3515040601640001', 14, 5),
(119, '3515040601640001', 15, 2),
(127, '', 9, 0),
(128, '', 10, 0),
(129, '', 11, 0),
(130, '', 12, 0),
(131, '', 13, 0),
(132, '', 14, 0),
(133, '', 15, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
(9, 'Gaji/Penghasilan'),
(10, 'Mempunyai Kartu Kis'),
(11, 'KONDISI RUMAH YANG DIHUNI '),
(12, 'JUMLAH PENERIMA MANFAAT BANTUAN '),
(13, 'BERKELUARGA ATAU BELUM BERKELUARGA'),
(14, 'DAYA LISTRIK RUMAH YANG DIPAKAI'),
(15, 'JUMLAH KENDARAAN BERMOTOR YANG DIMILIKI ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `matrix_perbatasan`
--

CREATE TABLE `matrix_perbatasan` (
  `id_matrix_perbatasan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_matrix_perbatasan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `matrix_perbatasan`
--

INSERT INTO `matrix_perbatasan` (`id_matrix_perbatasan`, `id_kriteria`, `nilai_matrix_perbatasan`) VALUES
(1, 9, 0.0216657),
(2, 10, 0.000305528),
(3, 11, 0.0000000445561),
(4, 12, 0.000000146312),
(5, 13, 0.0000000445561),
(6, 14, 0.000000738552),
(7, 15, 0.000341084);

-- --------------------------------------------------------

--
-- Struktur dari tabel `matrix_tertimbang`
--

CREATE TABLE `matrix_tertimbang` (
  `id_matrix_tertimbang` int(11) NOT NULL,
  `nik` varchar(123) NOT NULL,
  `id_kriteria` int(123) NOT NULL,
  `nilai_matrix_tertimbang` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `matrix_tertimbang`
--

INSERT INTO `matrix_tertimbang` (`id_matrix_tertimbang`, `nik`, `id_kriteria`, `nilai_matrix_tertimbang`) VALUES
(1, '3514091106780001', 9, 0.84733),
(2, '3514091106780001', 10, 0.33592),
(3, '3514091106780001', 11, 0.0435106),
(4, '3514091106780001', 12, 0.0728252),
(5, '3514091106780001', 13, 0.0435106),
(6, '3514091106780001', 14, 0.11564),
(7, '3514091106780001', 15, 0.378537),
(8, '3515040504550002', 9, 0.84733),
(9, '3515040504550002', 10, 0.33592),
(10, '3515040504550002', 11, 0.0435106),
(11, '3515040504550002', 12, 0.0364126),
(12, '3515040504550002', 13, 0.0435106),
(13, '3515040504550002', 14, 0.0578199),
(14, '3515040504550002', 15, 0.302829),
(15, '3515040307520005', 9, 0.706108),
(16, '3515040307520005', 10, 0.33592),
(17, '3515040307520005', 11, 0.0435106),
(18, '3515040307520005', 12, 0.0728252),
(19, '3515040307520005', 13, 0.0435106),
(20, '3515040307520005', 14, 0.11564),
(21, '3515040307520005', 15, 0.302829),
(22, '3515040601640001', 9, 0.423665),
(23, '3515040601640001', 10, 0.33592),
(24, '3515040601640001', 11, 0.0435106),
(25, '3515040601640001', 12, 0.0728252),
(26, '3515040601640001', 13, 0.0435106),
(27, '3515040601640001', 14, 0.11564),
(28, '3515040601640001', 15, 0.227122);

-- --------------------------------------------------------

--
-- Struktur dari tabel `normaliasi_entropy`
--

CREATE TABLE `normaliasi_entropy` (
  `id_normalisasi_entropy` int(11) NOT NULL,
  `nik` varchar(113) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_normaliasi_entropy` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `normaliasi_entropy`
--

INSERT INTO `normaliasi_entropy` (`id_normalisasi_entropy`, `nik`, `id_kriteria`, `nilai_normaliasi_entropy`) VALUES
(1, '3514091106780001', 9, 0.25),
(2, '3514091106780001', 10, 0.217391),
(3, '3514091106780001', 11, 0.190476),
(4, '3514091106780001', 12, 0.208333),
(5, '3514091106780001', 13, 0.190476),
(6, '3514091106780001', 14, 0.217391),
(7, '3514091106780001', 15, 0.266667),
(8, '3515040504550002', 9, 0.25),
(9, '3515040504550002', 10, 0.217391),
(10, '3515040504550002', 11, 0.190476),
(11, '3515040504550002', 12, 0.166667),
(12, '3515040504550002', 13, 0.190476),
(13, '3515040504550002', 14, 0.173913),
(14, '3515040504550002', 15, 0.2),
(15, '3515040307520005', 9, 0.2),
(16, '3515040307520005', 10, 0.217391),
(17, '3515040307520005', 11, 0.190476),
(18, '3515040307520005', 12, 0.208333),
(19, '3515040307520005', 13, 0.190476),
(20, '3515040307520005', 14, 0.217391),
(21, '3515040307520005', 15, 0.2),
(22, '3515040601640001', 9, 0.1),
(23, '3515040601640001', 10, 0.217391),
(24, '3515040601640001', 11, 0.190476),
(25, '3515040601640001', 12, 0.208333),
(26, '3515040601640001', 13, 0.190476),
(27, '3515040601640001', 14, 0.217391),
(28, '3515040601640001', 15, 0.133333);

-- --------------------------------------------------------

--
-- Struktur dari tabel `normalisasi_mabac`
--

CREATE TABLE `normalisasi_mabac` (
  `id_normalisasi_mabac` int(11) NOT NULL,
  `nik` varchar(123) NOT NULL,
  `id_kriteria` int(123) NOT NULL,
  `nilai_normalisasi_mabac` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `normalisasi_mabac`
--

INSERT INTO `normalisasi_mabac` (`id_normalisasi_mabac`, `nik`, `id_kriteria`, `nilai_normalisasi_mabac`) VALUES
(1, '3514091106780001', 9, 1),
(2, '3514091106780001', 10, 1),
(3, '3514091106780001', 11, 0),
(4, '3514091106780001', 12, 1),
(5, '3514091106780001', 13, 0),
(6, '3514091106780001', 14, 1),
(7, '3514091106780001', 15, 0.666667),
(8, '3515040504550002', 9, 1),
(9, '3515040504550002', 10, 1),
(10, '3515040504550002', 11, 0),
(11, '3515040504550002', 12, 0),
(12, '3515040504550002', 13, 0),
(13, '3515040504550002', 14, 0),
(14, '3515040504550002', 15, 0.333333),
(15, '3515040307520005', 9, 0.666667),
(16, '3515040307520005', 10, 1),
(17, '3515040307520005', 11, 0),
(18, '3515040307520005', 12, 1),
(19, '3515040307520005', 13, 0),
(20, '3515040307520005', 14, 1),
(21, '3515040307520005', 15, 0.333333),
(22, '3515040601640001', 9, 0),
(23, '3515040601640001', 10, 1),
(24, '3515040601640001', 11, 0),
(25, '3515040601640001', 12, 1),
(26, '3515040601640001', 13, 0),
(27, '3515040601640001', 14, 1),
(28, '3515040601640001', 15, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perangkingan_alternatif`
--

CREATE TABLE `perangkingan_alternatif` (
  `id_perangkingan_alternatif` int(11) NOT NULL,
  `nik` varchar(123) NOT NULL,
  `nilai_perankingan_alternatif` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perangkingan_alternatif`
--

INSERT INTO `perangkingan_alternatif` (`id_perangkingan_alternatif`, `nik`, `nilai_perankingan_alternatif`) VALUES
(1, '3514091106780001', 0.00000167084),
(2, '3515040504550002', 0.000000334091),
(3, '3515040307520005', 0.0000011078),
(4, '3515040601640001', 0.000000487806);

-- --------------------------------------------------------

--
-- Struktur dari tabel `perkiraan_perbatasan`
--

CREATE TABLE `perkiraan_perbatasan` (
  `id_perkalian_perbatasan` int(11) NOT NULL,
  `nik` varchar(123) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_perkalian_perbatasan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perkiraan_perbatasan`
--

INSERT INTO `perkiraan_perbatasan` (`id_perkalian_perbatasan`, `nik`, `id_kriteria`, `nilai_perkalian_perbatasan`) VALUES
(1, '3514091106780001', 9, 0.825664),
(2, '3514091106780001', 10, 0.335614),
(3, '3514091106780001', 11, 0.0435106),
(4, '3514091106780001', 12, 0.0728251),
(5, '3514091106780001', 13, 0.0435106),
(6, '3514091106780001', 14, 0.115639),
(7, '3514091106780001', 15, 0.378196),
(8, '3515040504550002', 9, 0.825664),
(9, '3515040504550002', 10, 0.335614),
(10, '3515040504550002', 11, 0.0435106),
(11, '3515040504550002', 12, 0.0364125),
(12, '3515040504550002', 13, 0.0435106),
(13, '3515040504550002', 14, 0.0578192),
(14, '3515040504550002', 15, 0.302488),
(15, '3515040307520005', 9, 0.684442),
(16, '3515040307520005', 10, 0.335614),
(17, '3515040307520005', 11, 0.0435106),
(18, '3515040307520005', 12, 0.0728251),
(19, '3515040307520005', 13, 0.0435106),
(20, '3515040307520005', 14, 0.115639),
(21, '3515040307520005', 15, 0.302488),
(22, '3515040601640001', 9, 0.401999),
(23, '3515040601640001', 10, 0.335614),
(24, '3515040601640001', 11, 0.0435106),
(25, '3515040601640001', 12, 0.0728251),
(26, '3515040601640001', 13, 0.0435106),
(27, '3515040601640001', 14, 0.115639),
(28, '3515040601640001', 15, 0.226781);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nik` varchar(113) NOT NULL,
  `nama` varchar(123) NOT NULL,
  `jenis_kelamin` varchar(110) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(113) NOT NULL,
  `rt` varchar(10) NOT NULL,
  `rw` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nik`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `rt`, `rw`) VALUES
(1, '3514091106780001', 'ALIMAN', 'LAKI-LAKI', '1978-11-06', 'CANDIPARI', '7', 2),
(2, '3515040504550002', 'SURASID', 'LAKI-LAKI', '1955-05-04', 'CANDIPARI', '8', 2),
(3, '3515040307520005', 'ASKAN', 'LAKI-LAKI', '1952-03-07', 'CANDIPARI', '16', 4),
(4, '3515040601640001', 'UMBARAN', 'LAKI-LAKI', '1964-06-01', 'CANDIPARI', '19', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(123) NOT NULL,
  `password` varchar(123) NOT NULL,
  `role` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'kades', 'kades', 'kades');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bobot_entropy`
--
ALTER TABLE `bobot_entropy`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indeks untuk tabel `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
  ADD PRIMARY KEY (`id_detail_kriteria`);

--
-- Indeks untuk tabel `ej`
--
ALTER TABLE `ej`
  ADD PRIMARY KEY (`id_ej`);

--
-- Indeks untuk tabel `entropy_tiap_atribut`
--
ALTER TABLE `entropy_tiap_atribut`
  ADD PRIMARY KEY (`id_entropy_tiap_atribut`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `matrix_perbatasan`
--
ALTER TABLE `matrix_perbatasan`
  ADD PRIMARY KEY (`id_matrix_perbatasan`);

--
-- Indeks untuk tabel `matrix_tertimbang`
--
ALTER TABLE `matrix_tertimbang`
  ADD PRIMARY KEY (`id_matrix_tertimbang`);

--
-- Indeks untuk tabel `normaliasi_entropy`
--
ALTER TABLE `normaliasi_entropy`
  ADD PRIMARY KEY (`id_normalisasi_entropy`);

--
-- Indeks untuk tabel `normalisasi_mabac`
--
ALTER TABLE `normalisasi_mabac`
  ADD PRIMARY KEY (`id_normalisasi_mabac`);

--
-- Indeks untuk tabel `perangkingan_alternatif`
--
ALTER TABLE `perangkingan_alternatif`
  ADD PRIMARY KEY (`id_perangkingan_alternatif`);

--
-- Indeks untuk tabel `perkiraan_perbatasan`
--
ALTER TABLE `perkiraan_perbatasan`
  ADD PRIMARY KEY (`id_perkalian_perbatasan`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bobot_entropy`
--
ALTER TABLE `bobot_entropy`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
  MODIFY `id_detail_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `ej`
--
ALTER TABLE `ej`
  MODIFY `id_ej` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `entropy_tiap_atribut`
--
ALTER TABLE `entropy_tiap_atribut`
  MODIFY `id_entropy_tiap_atribut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `matrix_perbatasan`
--
ALTER TABLE `matrix_perbatasan`
  MODIFY `id_matrix_perbatasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `matrix_tertimbang`
--
ALTER TABLE `matrix_tertimbang`
  MODIFY `id_matrix_tertimbang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `normaliasi_entropy`
--
ALTER TABLE `normaliasi_entropy`
  MODIFY `id_normalisasi_entropy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `normalisasi_mabac`
--
ALTER TABLE `normalisasi_mabac`
  MODIFY `id_normalisasi_mabac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `perangkingan_alternatif`
--
ALTER TABLE `perangkingan_alternatif`
  MODIFY `id_perangkingan_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `perkiraan_perbatasan`
--
ALTER TABLE `perkiraan_perbatasan`
  MODIFY `id_perkalian_perbatasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
