CREATE DATABASE gudang_sortir;

DROP DATABASE gudang_sortir;

USE gudang_sortir;

CREATE TABLE users (
    id_user INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    nama VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
) ENGINE InnoDB;

CREATE TABLE sessions (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    user_email VARCHAR(255) NOT NULL,
    CONSTRAINT fk_sessions_users FOREIGN KEY (user_email)
                      REFERENCES users(email)
) ENGINE InnoDB;

CREATE TABLE barang (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    kuantitas INT NOT NULL DEFAULT 0,
    deskripsi TEXT NULL
) ENGINE InnoDB;

CREATE TABLE jenis_transaksi (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    kode VARCHAR(10),
    nama_transaksi VARCHAR(100)
) ENGINE InnoDB;

CREATE TABLE transaksi (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    tipe_id INT NOT NULL,
    kode_trans VARCHAR(20) NOT NULL,
    tanggal_trans DATE NOT NULL,
    deskripsi TEXT NULL,
    CONSTRAINT fk_transaksi_jenis_transaksi FOREIGN KEY (tipe_id)
        REFERENCES jenis_transaksi(id)
) ENGINE InnoDB;

ALTER TABLE transaksi_s DROP CONSTRAINT fk_transaksi_jenis_transaksi;

CREATE TABLE detail_transaksi (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_trans INT NOT NULL,
    id_barang INT NOT NULL,
    kuatitas INT NOT NULL DEFAULT 0,
    deskripsi TEXT NULL,
    CONSTRAINT fk_detail_transaksi_transaksi FOREIGN KEY (id_trans)
        REFERENCES transaksi(id),
    CONSTRAINT fk_detail_transaksi_barang FOREIGN KEY (id_barang)
        REFERENCES barang(id)
)ENGINE InnoDB;

ALTER TABLE barang RENAME TO barang_s;
ALTER TABLE jenis_transaksi RENAME TO jenis_transaksi_s;
ALTER TABLE transaksi RENAME TO transaksi_s;
ALTER TABLE detail_transaksi RENAME TO detail_transaksi_s;

DROP TABLE barang_s;
DROP TABLE jenis_transaksi_s;
DROP TABLE transaksi_s;
DROP TABLE detail_transaksi_s;

# NEW HERE

CREATE TABLE kategori (
    id_kategori VARCHAR(100) NOT NULL,
    nama_kategori VARCHAR(100) NOT NULL,
    deskripsi TEXT NULL,
    PRIMARY KEY (id_kategori)
)ENGINE InnoDB;

ALTER TABLE kategori RENAME
    COLUMN nama_kategori TO nama;

CREATE TABLE barang (
    id_barang VARCHAR(100) NOT NULL PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kuantitas INT NOT NULL DEFAULT 0,
    deskripsi TEXT NULL,
    kategori_id VARCHAR(100) NOT NULL,
    CONSTRAINT fk_barang_kategori FOREIGN KEY (kategori_id)
        REFERENCES kategori (id_kategori),
    UNIQUE KEY barang_unique (id_barang)
)ENGINE InnoDB;

CREATE TABLE jenis_transaksi (
    kode_transaksi VARCHAR(10) NOT NULL PRIMARY KEY,
    nama_trans VARCHAR(100) NOT NULL,
    deskripsi TEXT NULL
)ENGINE InnoDB;

CREATE TABLE transaksi (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    transaksi_kode VARCHAR(10) NOT NULL,
    tanggal_transaksi DATE NOT NULL,
    deskripsi TEXT NULL,
    CONSTRAINT fk_transaksi_jenis_transaksi FOREIGN KEY (transaksi_kode)
        REFERENCES jenis_transaksi (kode_transaksi)
)ENGINE InnoDB;

CREATE TABLE detail_transaksi (
    transaksi_id INT NOT NULL PRIMARY KEY,
    barang_id VARCHAR(100) NOT NULL,
    kuantitas INT NOT NULL DEFAULT 0,
    deskripsi TEXT NULL,
    CONSTRAINT fk_detail_transaksi_transaksi FOREIGN KEY (transaksi_id)
        REFERENCES transaksi (id),
    CONSTRAINT fk_detail_transaksi_barang FOREIGN KEY (barang_id)
        REFERENCES barang (id_barang)
)ENGINE InnoDB;
