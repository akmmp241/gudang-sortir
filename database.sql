CREATE DATABASE gudang_sortir;
CREATE DATABASE gudang_sortir_test;

USE gudang_sortir;
USE gudang_sortir_test;

CREATE TABLE users
(
    id_user  INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email    VARCHAR(100) NOT NULL,
    nama     VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE InnoDB;

CREATE TABLE sessions
(
    id         VARCHAR(255) NOT NULL PRIMARY KEY,
    user_id    INT          NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    CONSTRAINT FOREIGN KEY (user_id)
        REFERENCES users (id_user)
) ENGINE InnoDB;

CREATE TABLE kategori
(
    id_kategori   VARCHAR(200) NOT NULL,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi     TEXT         NULL,
    PRIMARY KEY (id_kategori)
) ENGINE InnoDB;

CREATE TABLE barang
(
    id_barang   VARCHAR(200) NOT NULL PRIMARY KEY,
    id          VARCHAR(200) NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    kuantitas   INT          NOT NULL DEFAULT 0,
    deskripsi   TEXT         NULL,
    id_kategori VARCHAR(200) NOT NULL,
    CONSTRAINT fk_barang_kategori FOREIGN KEY (id_kategori)
        REFERENCES kategori (id_kategori),
    UNIQUE KEY barang_unique (id_barang)
) ENGINE InnoDB;

CREATE TABLE jenis_transaksi
(
    kode_transaksi VARCHAR(10)  NOT NULL PRIMARY KEY,
    nama_trans     VARCHAR(100) NOT NULL,
    deskripsi      TEXT         NULL
) ENGINE InnoDB;

CREATE TABLE transaksi
(
    id                INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_transaksi      VARCHAR(255) NOT NULL UNIQUE KEY,
    kode_transaksi    VARCHAR(10)  NOT NULL,
    tanggal_transaksi DATE         NOT NULL,
    deskripsi         TEXT         NULL,
    CONSTRAINT fk_transaksi_jenis_transaksi
        FOREIGN KEY (kode_transaksi)
        REFERENCES jenis_transaksi (kode_transaksi)
) ENGINE InnoDB;

CREATE TABLE detail_transaksi
(
    id_transaksi VARCHAR(255)  NOT NULL PRIMARY KEY,
    id_barang    VARCHAR(200)  NOT NULL,
    kuantitas    INT  NOT NULL DEFAULT 0,
    deskripsi    TEXT NULL,
    CONSTRAINT fk_detail_transaksi_transaksi
        FOREIGN KEY (id_transaksi)
        REFERENCES transaksi (id_transaksi),
    CONSTRAINT fk_detail_transaksi_barang
        FOREIGN KEY (id_barang)
        REFERENCES barang (id_barang)
) ENGINE InnoDB;

INSERT INTO jenis_transaksi
    (kode_transaksi, nama_trans, deskripsi)
VALUES ('BM',
        'Barang Masuk',
        '');

INSERT INTO jenis_transaksi
(kode_transaksi, nama_trans, deskripsi)
VALUES ('BK',
        'Barang Keluar',
        '');
