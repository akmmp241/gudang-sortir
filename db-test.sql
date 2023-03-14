CREATE DATABASE gudang_sortir;
CREATE DATABASE gudang_sortir_test;

USE gudang_sortir;
USE gudang_sortir_test;

CREATE TABLE users
(
    id_user  INT          NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE KEY,
    email    VARCHAR(100) NOT NULL UNIQUE KEY,
    nama     VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE InnoDB;

CREATE TABLE sessions
(
    id         VARCHAR(255) NOT NULL PRIMARY KEY UNIQUE KEY,
    id_user    INT          NOT NULL UNIQUE KEY,
    email_user VARCHAR(255) NOT NULL UNIQUE KEY,
    CONSTRAINT FOREIGN KEY (id_user)
        REFERENCES users (id_user)
) ENGINE InnoDB;

CREATE TABLE kategori
(
    id            INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_user       INT          NOT NULL,
    kategori_id   VARCHAR(200) NOT NULL,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi     TEXT         NULL,
    CONSTRAINT fk_kategori_user FOREIGN KEY (id_user)
        REFERENCES users (id_user)
) ENGINE InnoDB;

CREATE TABLE barang
(
    id          INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    counter     VARCHAR(200) NOT NULL,
    barang_id   VARCHAR(200) NOT NULL,
    id_user     INT          NOT NULL,
    id_kategori INT          NOT NULL,
    nama_barang VARCHAR(100) NOT NULL,
    kuantitas   INT          NOT NULL DEFAULT 0,
    deskripsi   TEXT         NULL,
    CONSTRAINT fk_barang_kategori FOREIGN KEY (id_kategori)
        REFERENCES kategori (id),
    CONSTRAINT fk_barang_user FOREIGN KEY (id_user)
        REFERENCES users (id_user)
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
    id_user           INT          NOT NULL,
    transaksi_id      VARCHAR(255) NOT NULL,
    counter           VARCHAR(255) NOT NULL,
    kode_transaksi    VARCHAR(10)  NOT NULL,
    tanggal_transaksi DATETIME     NOT NULL,
    deskripsi         TEXT         NULL,
    CONSTRAINT fk_transaksi_jenis_transaksi FOREIGN KEY (kode_transaksi)
        REFERENCES jenis_transaksi (kode_transaksi),
    CONSTRAINT fk_transaksi_user FOREIGN KEY (id_user)
        REFERENCES users (id_user)
) ENGINE InnoDB;

CREATE TABLE detail_transaksi
(
    id           INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_transaksi INT  NOT NULL,
    id_barang    INT  NOT NULL,
    id_user      INT  NOT NULL,
    kuantitas    INT  NOT NULL DEFAULT 0,
    deskripsi    TEXT NULL,
    CONSTRAINT fk_detail_transaksi_transaksi
        FOREIGN KEY (id_transaksi)
            REFERENCES transaksi (id),
    CONSTRAINT fk_detail_transaksi_barang
        FOREIGN KEY (id_barang)
            REFERENCES barang (id),
    CONSTRAINT fk_detail_transaksi_user FOREIGN KEY (id_user)
        REFERENCES users (id_user)
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

DROP DATABASE gudang_sortir;
DROP DATABASE gudang_sortir_test;