CREATE DATABASE gudang_sortir;

USE gudang_sortir;

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
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
