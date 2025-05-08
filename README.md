<p align="center"><strong>Jobsy - Sistem Informasi Pencari Lowongan Pekerjaan</strong></p>

<div align="center">

![logo_unsulbar](public/gambar/image.png)

<b>Andini Putri Amrullah</b><br>
<b>D0222352</b><br>
<b>Framework Web Based</b><br>
<b>2025</b>

</div>

---

## 👥 Role dan Fitur

### 👨‍💼 Pencari Kerja (Job Seeker)

-   Registrasi & Login
-   Upload CV
-   Mencari pekerjaan berdasarkan kata kunci, kategori, dan lokasi
-   Melihat detail, melamar pekerjaan, dan status lamaran

### 🏢 Perusahaan

-   Registrasi & Login
-   Membuat, mengedit, menghapus lowongan pekerjaan
-   Melihat daftar pelamar, CV, dan profil pencari kerja
-   Menerima atau menolak lamaran

### 🛠️ Admin

-   Login
-   Mengelola akun pengguna (pencari kerja & perusahaan)
-   Mengelola kategori pekerjaan
-   Mengelola lokasi (kota)

---

## 🗃️ Struktur Tabel Database

### 1. `pengguna`

| Field          | Tipe Data | Keterangan                             |
| -------------- | --------- | -------------------------------------- |
| id             | BIGINT    | Primary key, auto increment            |
| nama           | VARCHAR   | Nama pengguna                          |
| email          | VARCHAR   | Email unik pengguna                    |
| kata_sandi     | VARCHAR   | Kata sandi (hashed)                    |
| peran          | ENUM      | `pencari_kerja`, `perusahaan`, `admin` |
| remember_token | VARCHAR   | Token untuk fitur remember me          |
| created_at     | TIMESTAMP | Timestamp pembuatan                    |
| updated_at     | TIMESTAMP | Timestamp pembaruan                    |

### 2. `pencari_kerja`

| Field       | Tipe Data | Keterangan                      |
| ----------- | --------- | ------------------------------- |
| id          | BIGINT    | Primary key                     |
| pengguna_id | BIGINT    | Foreign key ke tabel `pengguna` |
| cv          | VARCHAR   | Path atau URL CV                |
| created_at  | TIMESTAMP | Timestamp pembuatan             |
| updated_at  | TIMESTAMP | Timestamp pembaruan             |

### 3. `perusahaan`

| Field           | Tipe Data | Keterangan                      |
| --------------- | --------- | ------------------------------- |
| id              | BIGINT    | Primary key                     |
| pengguna_id     | BIGINT    | Foreign key ke `pengguna`       |
| nama_perusahaan | VARCHAR   | Nama perusahaan                 |
| logo            | VARCHAR   | Path logo perusahaan (nullable) |
| deskripsi       | TEXT      | Deskripsi perusahaan            |
| alamat          | VARCHAR   | Alamat perusahaan               |
| created_at      | TIMESTAMP | Timestamp pembuatan             |
| updated_at      | TIMESTAMP | Timestamp pembaruan             |

### 4. `kategori_pekerjaan`

| Field      | Tipe Data | Keterangan              |
| ---------- | --------- | ----------------------- |
| id         | BIGINT    | Primary key             |
| nama       | VARCHAR   | Nama kategori pekerjaan |
| created_at | TIMESTAMP | Timestamp pembuatan     |
| updated_at | TIMESTAMP | Timestamp pembaruan     |

### 5. `lokasi`

| Field      | Tipe Data | Keterangan                   |
| ---------- | --------- | ---------------------------- |
| id         | BIGINT    | Primary key                  |
| kota       | VARCHAR   | Nama kota (lokasi pekerjaan) |
| created_at | TIMESTAMP | Timestamp pembuatan          |
| updated_at | TIMESTAMP | Timestamp pembaruan          |

### 6. `lowongan`

| Field       | Tipe Data | Keterangan                             |
| ----------- | --------- | -------------------------------------- |
| id          | BIGINT    | Primary key                            |
| pengguna_id | BIGINT    | Foreign key ke `pengguna` (perusahaan) |
| judul       | VARCHAR   | Judul lowongan pekerjaan               |
| deskripsi   | TEXT      | Deskripsi pekerjaan                    |
| persyaratan | TEXT      | Syarat pekerjaan                       |
| kategori_id | BIGINT    | Foreign key ke `kategori_pekerjaan`    |
| lokasi_id   | BIGINT    | Foreign key ke `lokasi`                |
| gaji        | DECIMAL   | Gaji pekerjaan                         |
| gambar      | VARCHAR   | Path gambar lowongan (nullable)        |
| created_at  | TIMESTAMP | Timestamp pembuatan                    |
| updated_at  | TIMESTAMP | Timestamp pembaruan                    |

### 7. `lamaran`

| Field            | Tipe Data | Keterangan                         |
| ---------------- | --------- | ---------------------------------- |
| id               | BIGINT    | Primary key                        |
| pencari_kerja_id | BIGINT    | Foreign key ke `pencari_kerja`     |
| lowongan_id      | BIGINT    | Foreign key ke `lowongan`          |
| lokasi_id        | BIGINT    | Foreign key ke `lokasi` (opsional) |
| status           | ENUM      | `menunggu`, `diterima`, `ditolak`  |
| created_at       | TIMESTAMP | Timestamp pembuatan                |
| updated_at       | TIMESTAMP | Timestamp pembaruan                |

---

## 🔗 Relasi Antar Tabel

| Entitas yang Terlibat              | Jenis Relasi | Penjelasan                                                              |
| ---------------------------------- | ------------ | ----------------------------------------------------------------------- |
| Pengguna dengan Pencari Kerja      | One-to-One   | Setiap pengguna hanya bisa memiliki satu profil pencari kerja           |
| Pengguna dengan Perusahaan         | One-to-One   | Setiap pengguna hanya bisa memiliki satu profil perusahaan              |
| Perusahaan dengan Lowongan         | One-to-Many  | Satu perusahaan dapat membuat banyak lowongan pekerjaan                 |
| Pencari Kerja dengan Lamaran       | One-to-Many  | Seorang pencari kerja dapat melamar ke banyak lowongan                  |
| Lowongan dengan Lamaran            | One-to-Many  | Satu lowongan dapat menerima banyak lamaran dari berbagai pencari kerja |
| Lowongan dengan Kategori Pekerjaan | Many-to-One  | Banyak lowongan dapat memiliki satu kategori pekerjaan yang sama        |
| Lowongan dengan Lokasi (Kota)      | Many-to-One  | Banyak lowongan dapat berada dalam satu kota                            |

---
