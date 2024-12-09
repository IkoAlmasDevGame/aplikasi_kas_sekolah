<?php

namespace controller;

use model\registerasi;
use model\authentication;
use model\DaftarSiswa;
use model\bulan_pembayaran;
use model\uang_kas;
use model\pengeluaran;
use model\jabatan;
use model\profile;

class registeration
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new registerasi($konfig);
    }

    public function signup()
    {
        $nama = htmlspecialchars($_POST['nama_lengkap']) ? htmlentities($_POST['nama_lengkap']) : strip_tags($_POST['nama_lengkap']);
        $username = htmlspecialchars($_POST['username']) ? htmlentities($_POST['username']) : strip_tags($_POST['username']);
        $password = htmlspecialchars(md5($_POST['password'], false));
        $jabatan = htmlspecialchars($_POST['id_jabatan']) ? htmlentities($_POST['id_jabatan']) : strip_tags($_POST['id_jabatan']);
        $data = $this->konfig->register($nama, $username, $password, $jabatan);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class AuthLogin
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new authentication($konfig);
    }

    public function signin()
    {
        $userInput = htmlspecialchars($_POST['userInput']) ? htmlentities($_POST['userInput']) : $_POST['userInput'];
        $passInput = htmlspecialchars(md5($_POST['password'], false));
        $data = $this->konfig->LoginAuth($userInput, $passInput);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}


class Siswa
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new DaftarSiswa($konfig);
    }

    public function tambahsiswa()
    {
        $nama = htmlspecialchars($_POST['nama_siswa']) ? htmlentities($_POST['nama_siswa']) : strip_tags($_POST['nama_siswa']);
        $jenis = htmlspecialchars($_POST['jenis_kelamin']) ? htmlentities($_POST['jenis_kelamin']) : strip_tags($_POST['jenis_kelamin']);
        $telepon = htmlspecialchars($_POST['no_telepon']) ? htmlentities($_POST['no_telepon']) : strip_tags($_POST['no_telepon']);
        $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
        $data = $this->konfig->tambah($nama, $jenis, $telepon, $email);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function ubahsiswa()
    {
        $nama = htmlspecialchars($_POST['nama_siswa']) ? htmlentities($_POST['nama_siswa']) : strip_tags($_POST['nama_siswa']);
        $jenis = htmlspecialchars($_POST['jenis_kelamin']) ? htmlentities($_POST['jenis_kelamin']) : strip_tags($_POST['jenis_kelamin']);
        $telepon = htmlspecialchars($_POST['no_telepon']) ? htmlentities($_POST['no_telepon']) : strip_tags($_POST['no_telepon']);
        $email = htmlspecialchars($_POST['email']) ? htmlentities($_POST['email']) : strip_tags($_POST['email']);
        $id = htmlspecialchars($_POST['id_siswa']) ? htmlentities($_POST['id_siswa']) : strip_tags($_POST['id_siswa']);
        $data = $this->konfig->ubah($nama, $jenis, $telepon, $email, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function hapussiswa()
    {
        $id = htmlspecialchars($_GET['id']) ? htmlentities($_GET['id']) : strip_tags($_GET['id']);
        $data = $this->konfig->hapus($id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}


class bulan
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new bulan_pembayaran($konfig);
    }

    public function tambahmonth()
    {
        $nama_bulan = htmlspecialchars($_POST['nama_bulan']);
        $tahun = htmlspecialchars($_POST['tahun']);
        $pembayaran_perminggu = htmlspecialchars($_POST['pembayaran_perminggu']);
        $data = $this->konfig->tambahbulan($nama_bulan, $tahun, $pembayaran_perminggu);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function ubahmonth()
    {
        $id_bulan_pembayaran = htmlspecialchars($_POST['id_bulan_pembayaran']);
        $nama_bulan = htmlspecialchars($_POST['nama_bulan']);
        $tahun = htmlspecialchars($_POST['tahun']);
        $pembayaran_perminggu = htmlspecialchars($_POST['pembayaran_perminggu']);
        $data = $this->konfig->ubahbulan($nama_bulan, $tahun, $pembayaran_perminggu, $id_bulan_pembayaran);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusmonth()
    {
        $id_bulan_pembayaran = htmlspecialchars($_GET['id_bulan_pembayaran']);
        $data = $this->konfig->hapusbulan($id_bulan_pembayaran);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class uang
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new uang_kas($konfig);
    }

    public function tambahkas()
    {
        $id_bulan_pembayaran = htmlspecialchars($_POST['id_bulan_pembayaran']);
        $id_siswa = htmlspecialchars($_POST['id_siswa']);
        $data = $this->konfig->tambahuangkasSiswa($id_siswa, $id_bulan_pembayaran);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}

class pengeluaran_kas
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new pengeluaran($konfig);
    }

    public function tambah_pengeluaran()
    {
        $jumlah_pengeluaran = (int)$_POST['jumlah_pengeluaran'];
        $keterangan = htmlspecialchars($_POST['keterangan']);
        $data = $this->konfig->tambahpengeluaran($jumlah_pengeluaran, $keterangan);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_pengeluaran()
    {
        $id_pengeluaran = htmlspecialchars($_POST['id_pengeluaran']);
        $jumlah_pengeluaran = (int)$_POST['jumlah_pengeluaran'];
        $keterangan = htmlspecialchars($_POST['keterangan']);
        $data = $this->konfig->ubahpengeluaran($jumlah_pengeluaran, $keterangan, $id_pengeluaran);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_pengeluaran()
    {
        $id_pengeluaran = htmlspecialchars($_GET['id_pengeluaran']);
        $data = $this->konfig->hapuspengeluaran($id_pengeluaran);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}


class Jabatant
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new jabatan($konfig);
    }

    public function tambah_jabatan()
    {
        $nama_jabatan = htmlspecialchars($_POST['nama_jabatan']) ? htmlentities($_POST['nama_jabatan']) : $_POST['nama_jabatan'];
        $data = $this->konfig->tambahjabatan($nama_jabatan);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function ubah_jabatan()
    {
        $id_jabatan = htmlspecialchars($_POST['id_jabatan']) ? htmlentities($_POST['id_jabatan']) : strip_tags($_POST['id_jabatan']);
        $nama_jabatan = htmlspecialchars($_POST['nama_jabatan']) ? htmlentities($_POST['nama_jabatan']) : strip_tags($_POST['nama_jabatan']);
        $data = $this->konfig->ubahjabatan($nama_jabatan, $id_jabatan);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function hapus_jabatan()
    {
        $id_jabatan = htmlspecialchars($_GET['id_jabatan']) ? htmlentities($_GET['id_jabatan']) : strip_tags($_GET['id_jabatan']);
        $data = $this->konfig->hapusjabatan($id_jabatan);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}


class dataUser
{
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new profile($konfig);
    }

    public function editdata()
    {
        $id = htmlspecialchars($_POST['id_user']);
        $nama = htmlspecialchars($_POST['nama_lengkap']);
        $username = htmlspecialchars($_POST['username']);
        $id_jabatan = htmlspecialchars($_POST['id_jabatan']);
        $data = $this->konfig->profile($nama, $username, $id_jabatan, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }

    public function editpassword()
    {
        $id = htmlspecialchars($_POST['id_user']);
        $new_password = htmlspecialchars(md5($_POST['new_password'], false));
        $data = $this->konfig->changepassword($new_password, $id);
        if ($data === true) {
            return true;
        } else {
            return false;
        }
    }
}
