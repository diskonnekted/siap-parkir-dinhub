<?php

if (!function_exists('parse_tgl')) {
    function parse_tgl($tgl) {
        if (empty($tgl)) return '-';
        $t = explode('-', $tgl);
        $thn = @$t[0];
        $tbln = @$t[1];
        $varbulan = array(
            '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
            '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember',
            '1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni',
            '7'=>'Juli','8'=>'Agustus','9'=>'September'
        );
        $bln = @$varbulan[$tbln];
        $tgl = @$t[2];
        $format = "$tgl $bln $thn";
        return $format;
    }
}

if (!function_exists('parse_tanggal')) {
    function parse_tanggal($tgl) {
        if (empty($tgl)) return '-';
        $w = explode(' ', $tgl);
        $t = explode('-', $w[0]);
        $thn = @$t[0];
        $tbln = @$t[1];
        $varbulan = array(
            '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
            '07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember',
            '1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni',
            '7'=>'Juli','8'=>'Agustus','9'=>'September'
        );
        $bln = @$varbulan[$tbln];
        $tgl = @$t[2];
        $time = isset($w[1]) ? $w[1] : '';
        $format = "$tgl $bln $thn $time";
        return trim($format);
    }
}

if (!function_exists('bulan')) {
    function bulan($bulan) {
        $nama_bulan = array(
            '01'=>'Januari',
            '02'=>'Februari',
            '03'=>'Maret',
            '04'=>'April',
            '05'=>'Mei',
            '06'=>'Juni',
            '07'=>'Juli',
            '08'=>'Agustus',
            '09'=>'September',
            '10'=>'Oktober',
            '11'=>'Nopember',
            '12'=>'Desember'    
        );
        return isset($nama_bulan[$bulan]) ? $nama_bulan[$bulan] : '';
    }
}

if (!function_exists('tgl')) {
    function tgl($x) {
        if ($x == '01' || $x == 1) $tgl = 1;
        elseif ($x == '02') $tgl = 2;
        elseif ($x == '03') $tgl = 3;
        elseif ($x == '04') $tgl = 4;
        elseif ($x == '05') $tgl = 5;
        elseif ($x == '06') $tgl = 6;
        elseif ($x == '07') $tgl = 7;
        elseif ($x == '08') $tgl = 8;
        elseif ($x == '09') $tgl = 9;
        else $tgl = $x;
        return $tgl;
    }
}

if (!function_exists('terbilang')) {
    function terbilang($x) {
        $x = (int) $x;
        $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        if ($x < 12)
            return " " . $abil[$x];
        elseif ($x < 20)
            return terbilang($x - 10) . " belas";
        elseif ($x < 100)
            return terbilang((int)($x / 10)) . " puluh" . terbilang($x % 10);
        elseif ($x < 200)
            return " Seratus" . terbilang($x - 100);
        elseif ($x < 1000)
            return terbilang((int)($x / 100)) . " ratus" . terbilang($x % 100);
        elseif ($x < 2000)
            return " Seribu" . terbilang($x - 1000);
        elseif ($x < 1000000)
            return terbilang((int)($x / 1000)) . " ribu" . terbilang($x % 1000);
        elseif ($x < 1000000000)
            return terbilang((int)($x / 1000000)) . " juta" . terbilang($x % 1000000);
        return "";
    }
}

