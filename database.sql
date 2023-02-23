CREATE DATABASE gudang_sortir;
CREATE DATABASE gudang_sortir_test;

USE gudang_sortir;


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
    id_kategori   VARCHAR(100) NOT NULL,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi     TEXT         NULL,
    PRIMARY KEY (id_kategori)
) ENGINE InnoDB;

CREATE TABLE barang
(
    id_barang   VARCHAR(100) NOT NULL PRIMARY KEY,
    nama        VARCHAR(100) NOT NULL,
    kuantitas   INT          NOT NULL DEFAULT 0,
    deskripsi   TEXT         NULL,
    kategori_id VARCHAR(100) NOT NULL,
    CONSTRAINT fk_barang_kategori FOREIGN KEY (kategori_id)
        REFERENCES kategori (id_kategori),
    UNIQUE KEY barang_unique (id_barang)
) ENGINE InnoDB;

ALTER TABLE barang RENAME COLUMN kategori_id TO id_kategori;
ALTER TABLE barang RENAME COLUMN nama TO nama_barang;

CREATE TABLE jenis_transaksi
(
    kode_transaksi VARCHAR(10)  NOT NULL PRIMARY KEY,
    nama_trans     VARCHAR(100) NOT NULL,
    deskripsi      TEXT         NULL
) ENGINE InnoDB;

CREATE TABLE transaksi
(
    id                INT         NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transaksi_kode    VARCHAR(10) NOT NULL,
    tanggal_transaksi DATE        NOT NULL,
    deskripsi         TEXT        NULL,
    CONSTRAINT fk_transaksi_jenis_transaksi FOREIGN KEY (transaksi_kode)
        REFERENCES jenis_transaksi (kode_transaksi)
) ENGINE InnoDB;

CREATE TABLE detail_transaksi
(
    transaksi_id INT          NOT NULL PRIMARY KEY,
    barang_id    VARCHAR(100) NOT NULL,
    kuantitas    INT          NOT NULL DEFAULT 0,
    deskripsi    TEXT         NULL,
    CONSTRAINT fk_detail_transaksi_transaksi FOREIGN KEY (transaksi_id)
        REFERENCES transaksi (id),
    CONSTRAINT fk_detail_transaksi_barang FOREIGN KEY (barang_id)
        REFERENCES barang (id_barang)
) ENGINE InnoDB;

ALTER TABLE detail_transaksi RENAME COLUMN barang_id TO id_barang;
ALTER TABLE detail_transaksi RENAME COLUMN transaksi_id TO id_transaksi;