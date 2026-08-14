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
