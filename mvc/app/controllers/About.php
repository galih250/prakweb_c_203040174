<?php

class About {
    public function index($nama = 'Akbar', $pekerjaan = "Mahasiswa")
    {
        echo "Halo, nama saya $nama, saya adalah $pekerjaan";
    }
    public function page()
    {
        echo 'About/page';
    }
}