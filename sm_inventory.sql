-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Okt 2019 pada 15.27
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `item` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `unit` varchar(50) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL,
  `stok` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `id_kategori`, `item`, `deskripsi`, `unit`, `harga_beli`, `harga_jual`, `stok`) VALUES
(1, 2, 'HNDREV-FTLU', 'Filter Udara Honda Absolut Revo', 'PCS', 30000, 32000, 0),
(2, 2, 'HNDREV-BHM-B', 'Bohlam Belakang Honda Absolut Revo', 'PCS', 5500, 7500, 0),
(3, 2, 'HNDREV-BHM-D', 'Bohlam Depan Honda Absolut Revo', 'PCS', 23000, 25000, 0),
(4, 2, 'HNDREV-GR-B', 'Gir Belakang Honda Absolut Revo', 'PCS', 61000, 63000, 0),
(5, 2, 'HNDREV-GR-D', 'Gir Depan Honda Absolut Revo', 'PCS', 33500, 35500, 0),
(6, 2, 'HNDREV-KBG', 'Kabel Gas Honda Absolut Revo', 'PCS', 18000, 20000, 0),
(7, 2, 'HNDREV-KPK', 'Kampas Kopling Honda Absolut Revo', 'SET', 146000, 148000, 0),
(8, 2, 'HNDREV-KPR-B', 'Kampas Rem Belakang Honda Absolut Revo', 'PCS', 24500, 26500, 0),
(9, 2, 'HNDREV-KPR-D', 'Kampas Rem Depan Honda Absolut Revo', 'PCS', 35000, 37000, 0),
(10, 2, 'HNDREV-PST', 'Piston Honda Absolut Revo', 'PCS', 36000, 38000, 0),
(11, 2, 'HNDREV-RNT', 'Rantai Honda Absolut Revo', 'PCS', 63000, 65000, 0),
(12, 2, 'HNDREV-RPST', 'Ring Piston Honda Absolut Revo', 'PCS', 58000, 60000, 0),
(13, 2, 'HNDBT-ROLLER', 'Roller Honda Beat', 'PCS', 5000, 7000, 25),
(14, 2, 'HNDBT-KBSPD', 'Kabel Spidometer Honda Beat', 'SET', 13000, 15000, 22),
(15, 2, 'HNDBT-RLYSTR', 'Relay Starter Honda Beat', 'PCS', 38000, 40000, 12),
(16, 2, 'HNDBT-KPR-D', 'Kampas Rem Depan Honda Beat', 'PCS', 39000, 41000, 34),
(17, 2, 'HNDBT-SRU', 'Saringan Udara Honda Beat', 'PCS', 41000, 43000, 10),
(18, 2, 'HNDBT-RPST', 'Ring Piston Honda Beat', 'PCS', 43000, 45000, 15),
(19, 2, 'HNDBT-PST', 'Piston Honda Beat', 'PCS', 43000, 45000, 50),
(20, 2, 'HNDBT-RRL', 'Rumah Roller Honda Beat', 'PCS', 52000, 54000, 15),
(21, 2, 'HNDBT-KPR-B', 'Kampas Rem Belakang Honda Beat', 'PCS', 61000, 63000, 12),
(22, 2, 'HNDBT-KPK', 'Kampas Kopling Set Honda Beat', 'SET', 108000, 110000, 46),
(23, 2, 'HNDBT-KEM', 'Kem Honda Beat', 'PCS', 113000, 115000, 23),
(24, 2, 'HNDBT-V-BELT', 'V-belt Honda Beat', 'PCS', 118000, 120000, 10),
(25, 2, 'HNDBT-SB-B', 'Sokbreker Belakang Honda Beat', 'PCS', 178000, 180000, 10),
(26, 2, 'HNDBT-CDI', 'CDI Honda Beat', 'PCS', 338000, 340000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `nama_kategori`) VALUES
(1, 'AKSESORIS'),
(2, 'SPAREPART');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `no_pembelian` char(50) NOT NULL,
  `tanggal` date NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `grand_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`no_pembelian`, `tanggal`, `id_supplier`, `id_user`, `grand_total`) VALUES
('PM-1910-0001', '2019-10-20', 12, 2, 20065000),
('PM-1910-0002', '2019-10-21', 11, 2, 2560000),
('PM-1910-0003', '2019-10-21', 11, 2, 1590000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id` int(11) NOT NULL,
  `no_pembelian` char(50) NOT NULL,
  `item` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id`, `no_pembelian`, `item`, `qty`, `subtotal`) VALUES
(117, 'PM-1910-0001', 'HNDBT-CDI', 20, 6760000),
(118, 'PM-1910-0001', 'HNDBT-KBSPD', 23, 299000),
(119, 'PM-1910-0001', 'HNDBT-KEM', 24, 2712000),
(120, 'PM-1910-0001', 'HNDBT-KPK', 45, 4860000),
(121, 'PM-1910-0001', 'HNDBT-KPR-B', 12, 732000),
(122, 'PM-1910-0001', 'HNDBT-KPR-D', 34, 1326000),
(123, 'PM-1910-0001', 'HNDBT-PST', 50, 2150000),
(124, 'PM-1910-0001', 'HNDBT-RLYSTR', 12, 456000),
(125, 'PM-1910-0001', 'HNDBT-ROLLER', 25, 125000),
(126, 'PM-1910-0001', 'HNDBT-RPST', 15, 645000),
(132, 'PM-1910-0002', 'HNDBT-RRL', 15, 780000),
(133, 'PM-1910-0002', 'HNDBT-SB-B', 10, 1780000),
(135, 'PM-1910-0003', 'HNDBT-SRU', 10, 410000),
(136, 'PM-1910-0003', 'HNDBT-V-BELT', 10, 1180000);

--
-- Trigger `pembelian_detail`
--
DELIMITER $$
CREATE TRIGGER `update_stok_pembelian` AFTER INSERT ON `pembelian_detail` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok + new.qty
WHERE item = new.item;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_list`
--

CREATE TABLE `pembelian_list` (
  `id` int(11) NOT NULL,
  `no_pembelian` char(50) NOT NULL,
  `item` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_beli` double NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `no_penjualan` char(50) NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `pembayaran` double NOT NULL,
  `grand_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`no_penjualan`, `tanggal`, `id_user`, `pembayaran`, `grand_total`) VALUES
('PJ-1910-0001', '2019-10-21', 2, 500000, 355000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id` int(11) NOT NULL,
  `no_penjualan` char(50) NOT NULL,
  `item` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id`, `no_penjualan`, `item`, `qty`, `subtotal`) VALUES
(36, 'PJ-1910-0001', 'HNDBT-CDI', 1, 340000),
(37, 'PJ-1910-0001', 'HNDBT-KBSPD', 1, 15000);

--
-- Trigger `penjualan_detail`
--
DELIMITER $$
CREATE TRIGGER `update_stok_penjualan` AFTER INSERT ON `penjualan_detail` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok - new.qty
WHERE item = new.item;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_list`
--

CREATE TABLE `penjualan_list` (
  `id` int(11) NOT NULL,
  `no_penjualan` char(50) NOT NULL,
  `item` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_jual` double NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_pembelian`
--

CREATE TABLE `return_pembelian` (
  `no_return_pembelian` char(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `grand_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `return_pembelian`
--

INSERT INTO `return_pembelian` (`no_return_pembelian`, `id_user`, `tanggal`, `keterangan`, `grand_total`) VALUES
('RPM-1910-0001', 2, '2019-10-21', 'kemasan rusak', 139000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_pembelian_detail`
--

CREATE TABLE `return_pembelian_detail` (
  `id` int(11) NOT NULL,
  `no_return_pembelian` char(50) NOT NULL,
  `item` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `return_pembelian_detail`
--

INSERT INTO `return_pembelian_detail` (`id`, `no_return_pembelian`, `item`, `qty`, `subtotal`) VALUES
(20, 'RPM-1910-0001', 'HNDBT-KBSPD', 2, 26000),
(21, 'RPM-1910-0001', 'HNDBT-KEM', 1, 113000);

--
-- Trigger `return_pembelian_detail`
--
DELIMITER $$
CREATE TRIGGER `update_stok_return_pembelian` AFTER INSERT ON `return_pembelian_detail` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok - new.qty
WHERE item = new.item;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_pembelian_list`
--

CREATE TABLE `return_pembelian_list` (
  `id` int(11) NOT NULL,
  `no_return_pembelian` char(50) NOT NULL,
  `item` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_beli` double NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_penjualan`
--

CREATE TABLE `return_penjualan` (
  `no_return_penjualan` char(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `grand_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `return_penjualan`
--

INSERT INTO `return_penjualan` (`no_return_penjualan`, `id_user`, `tanggal`, `keterangan`, `grand_total`) VALUES
('RPJ-1910-0001', 2, '2019-10-21', 'barang rusak', 140000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_penjualan_detail`
--

CREATE TABLE `return_penjualan_detail` (
  `id` int(11) NOT NULL,
  `no_return_penjualan` char(50) NOT NULL,
  `item` varchar(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `return_penjualan_detail`
--

INSERT INTO `return_penjualan_detail` (`id`, `no_return_penjualan`, `item`, `qty`, `subtotal`) VALUES
(11, 'RPJ-1910-0001', 'HNDBT-KBSPD', 2, 30000),
(12, 'RPJ-1910-0001', 'HNDBT-KPK', 1, 110000);

--
-- Trigger `return_penjualan_detail`
--
DELIMITER $$
CREATE TRIGGER `update_stok_return_penjualan` AFTER INSERT ON `return_penjualan_detail` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok + new.qty
WHERE item = new.item;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_penjualan_list`
--

CREATE TABLE `return_penjualan_list` (
  `id` int(11) NOT NULL,
  `no_return_penjualan` char(50) NOT NULL,
  `item` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_jual` double NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` text NOT NULL,
  `kota` text NOT NULL,
  `alamat` text NOT NULL,
  `kontak` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `kode`, `nama`, `kota`, `alamat`, `kontak`) VALUES
(11, 'SPL-001', 'Loaxan Motor', 'Tangerang', 'Jl. Cipto Mangunkusumo No.77 A, Sudimara Timur, Kec. Ciledug, Kota Tangerang, Banten', '0812-9458-255'),
(12, 'SPL-002', 'Abadi Motor Sport Parts &amp; Accessories', 'Tangerang', 'Jl. Dahlia IV No.5a, Nusa Jaya, Karawaci, Kota Tangerang, Banten 15116', '0878-0988-6607');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `level` enum('gudang','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `level`) VALUES
(1, 'admin', 'admin', 'Admin', 'admin'),
(2, 'gudang', 'gudang', 'Gudang', 'gudang'),
(3, 'saiful', 'saiful', 'Saiful Akbar', 'gudang');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_kategori_2` (`id_kategori`);

--
-- Indeks untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_pembelian`);

--
-- Indeks untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_pembelian` (`no_pembelian`);

--
-- Indeks untuk tabel `pembelian_list`
--
ALTER TABLE `pembelian_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_penjualan`);

--
-- Indeks untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_penjualan` (`no_penjualan`);

--
-- Indeks untuk tabel `penjualan_list`
--
ALTER TABLE `penjualan_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `return_pembelian`
--
ALTER TABLE `return_pembelian`
  ADD PRIMARY KEY (`no_return_pembelian`);

--
-- Indeks untuk tabel `return_pembelian_detail`
--
ALTER TABLE `return_pembelian_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_return_pembelian` (`no_return_pembelian`);

--
-- Indeks untuk tabel `return_pembelian_list`
--
ALTER TABLE `return_pembelian_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `return_penjualan`
--
ALTER TABLE `return_penjualan`
  ADD PRIMARY KEY (`no_return_penjualan`);

--
-- Indeks untuk tabel `return_penjualan_detail`
--
ALTER TABLE `return_penjualan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_return_penjualan` (`no_return_penjualan`);

--
-- Indeks untuk tabel `return_penjualan_list`
--
ALTER TABLE `return_penjualan_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT untuk tabel `pembelian_list`
--
ALTER TABLE `pembelian_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `penjualan_list`
--
ALTER TABLE `penjualan_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `return_pembelian_detail`
--
ALTER TABLE `return_pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `return_pembelian_list`
--
ALTER TABLE `return_pembelian_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `return_penjualan_detail`
--
ALTER TABLE `return_penjualan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `return_penjualan_list`
--
ALTER TABLE `return_penjualan_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD CONSTRAINT `pembelian_detail_ibfk_1` FOREIGN KEY (`no_pembelian`) REFERENCES `pembelian` (`no_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `penjualan_detail_ibfk_1` FOREIGN KEY (`no_penjualan`) REFERENCES `penjualan` (`no_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `return_pembelian_detail`
--
ALTER TABLE `return_pembelian_detail`
  ADD CONSTRAINT `return_pembelian_detail_ibfk_1` FOREIGN KEY (`no_return_pembelian`) REFERENCES `return_pembelian` (`no_return_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `return_penjualan_detail`
--
ALTER TABLE `return_penjualan_detail`
  ADD CONSTRAINT `return_penjualan_detail_ibfk_1` FOREIGN KEY (`no_return_penjualan`) REFERENCES `return_penjualan` (`no_return_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
