<!DOCTYPE html>
<html> 
<head>
    <meta charset='UTF-8'>
    <title>Cetak KTA</title>
</head>
<body onload='window.print()' style="font-family:arial; font-size: 12px; position:absolute;">

<div style="width:220px; height:690px;">
<!--Depan-->
<div id="depan1" style="width:220px; height:340px; margin:5px; background-image: url('{{ asset('images/depan.png') }}'); background-size: cover;">
    <p style="padding-top:80px; padding-left:10px; font-size: 11px"><b>KARTU IDENTITAS PETUGAS PARKIR</b></p> 
    <img style="position:absolute; margin-left:60px;" src="{{ asset(ltrim($row->foto, './')) }}" width="90px">
    <p style="padding-top:145px; width:220px; text-align:center;"><b>{{ strtoupper($row->nama) }}</b></p>
    <img style="position:absolute; margin-left:70px; margin-top: -10px;" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(url('profil/jukir/'.$row->nik)) }}" width="75px">
</div>
<!--Belakang-->
<div id="belakang1" style="width:220px; height:340px; margin:5px; background-image: url('{{ asset('images/belakang.png') }}'); background-size: cover; transform: rotate(180deg)">
    <table style="padding:5px 0px 5px; position:relative; font-family: arial; font-size: 10px;" cellpadding="0" cellspacing="0">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $row->nama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $row->domisili_alamat }} RT: {{ $row->domisili_rt }} RW: {{ $row->domisili_rw }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Kec. {{ $row->kec }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{ $row->kab }}</td>
        </tr>
        <tr>
            <td>Lokasi Parkir</td>
            <td>:</td>
            <td>{{ $row->nama_lokasi }}</td>
        </tr>
        <tr>
            <td>Ruas Jalan</td>
            <td>:</td>
            <td>{{ $row->nama_ruas }}</td>
        </tr>
       <tr>
            <td>Jam Kerja</td>
            <td>:</td>
            <td>{{ $row->jam_kerja_awal }} s.d {{ $row->jam_kerja_akhir }}</td>
        </tr>
    </table>
    <ol style="padding:0px 5px 5px 20px; position:relative; font-family:arial; font-size: 10px;" align="justify">
        <li>
            Kartu Identitas Petugas Parkir harus dipakai saat bertugas dan tidak boleh dipinjamkan / dipakai orang lain
        </li>
        <li>
            Petugas Parkir berkewajiban :
            <ol type="a" style="padding-left:15px;">
                <li>
                    Memberikan pelayanan masuk dan keluarnya kendaraan ditempat parkir
                </li>
                <li>
                    Menjaga ketertiban dan keamanan terhadap kendaraan yang diparkir
                </li>
                <li>
                    Menyerahkan karcis parkir, menerima pembayaran dan menyetorkan retribusi parkir sesuai ketentuan
                </li>
                <li>
                    Mematuhi batas-batas parkir / petak parkir yang telah ditetapkan
                </li>
            </ol>
        </li>
        <li>
            Pelanggaran terhadap ketentuan ini, dapat diberikan sanksi sesuai dengan peraturan
        </li>
    </ol>
    <p style="padding-top:3px; width:220px; text-align:center; font-size:10px"><b>Berlaku sampai dengan 31 Desember {{ $row->tahun_pengelolaan }}</b></p>
</div>
</div>

<div style="margin-top:-700px; padding-left:250px; width:220px; height:690px;">
<!--Depan-->
<div id="depan2" style="width:220px; height:340px; margin:5px; background-image: url('{{ asset('images/depan.png') }}'); background-size: cover;">
    <p style="padding-top:80px; padding-left:10px; font-size: 11px"><b>KARTU IDENTITAS PETUGAS PARKIR</b></p> 
    <img style="position:absolute; margin-left:60px;" src="{{ asset(ltrim($row->foto, './')) }}" width="90px">
    <p style="padding-top:145px; width:220px; text-align:center;"><b>{{ strtoupper($row->nama) }}</b></p>
    <img style="position:absolute; margin-left:70px; margin-top: -10px;" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(url('profil/jukir/'.$row->nik)) }}" width="75px">
</div>
<!--Belakang-->
<div id="belakang2" style="width:220px; height:340px; margin:5px; background-image: url('{{ asset('images/belakang.png') }}'); background-size: cover; transform: rotate(180deg)">
    <table style="padding:5px 0px 5px; position:relative; font-family: arial; font-size: 10px;" cellpadding="0" cellspacing="0">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $row->nama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $row->domisili_alamat }} RT: {{ $row->domisili_rt }} RW: {{ $row->domisili_rw }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Kec. {{ $row->kec }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{ $row->kab }}</td>
        </tr>
        <tr>
            <td>Lokasi Parkir</td>
            <td>:</td>
            <td>{{ $row->nama_lokasi }}</td>
        </tr>
        <tr>
            <td>Ruas Jalan</td>
            <td>:</td>
            <td>{{ $row->nama_ruas }}</td>
        </tr>
       <tr>
            <td>Jam Kerja</td>
            <td>:</td>
            <td>{{ $row->jam_kerja_awal }} s.d {{ $row->jam_kerja_akhir }}</td>
        </tr>
    </table>
    <ol style="padding:0px 5px 5px 20px; position:relative; font-family:arial; font-size: 10px;" align="justify">
        <li>
            Kartu Identitas Petugas Parkir harus dipakai saat bertugas dan tidak boleh dipinjamkan / dipakai orang lain
        </li>
        <li>
            Petugas Parkir berkewajiban :
            <ol type="a" style="padding-left:15px;">
                <li>
                    Memberikan pelayanan masuk dan keluarnya kendaraan ditempat parkir
                </li>
                <li>
                    Menjaga ketertiban dan keamanan terhadap kendaraan yang diparkir
                </li>
                <li>
                    Menyerahkan karcis parkir, menerima pembayaran dan menyetorkan retribusi parkir sesuai ketentuan
                </li>
                <li>
                    Mematuhi batas-batas parkir / petak parkir yang telah ditetapkan
                </li>
            </ol>
        </li>
        <li>
            Pelanggaran terhadap ketentuan ini, dapat diberikan sanksi sesuai dengan peraturan
        </li>
    </ol>
    <p style="padding-top:3px; width:220px; text-align:center; font-size:10px"><b>Berlaku sampai dengan 31 Desember {{ $row->tahun_pengelolaan }}</b></p>
</div>
</div>

<div style="margin-top:-700px; padding-left:500px; width:220px; height:690px;">
<!--Depan-->
<div id="depan3" style="width:220px; height:340px; margin:5px; background-image: url('{{ asset('images/depan.png') }}'); background-size: cover;">
    <p style="padding-top:80px; padding-left:10px; font-size: 11px"><b>KARTU IDENTITAS PETUGAS PARKIR</b></p> 
    <img style="position:absolute; margin-left:60px;" src="{{ asset(ltrim($row->foto, './')) }}" width="90px">
    <p style="padding-top:145px; width:220px; text-align:center;"><b>{{ strtoupper($row->nama) }}</b></p>
    <img style="position:absolute; margin-left:70px; margin-top: -10px;" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(url('profil/jukir/'.$row->nik)) }}" width="75px">
</div>
<!--Belakang-->
<div id="belakang3" style="width:220px; height:340px; margin:5px; background-image: url('{{ asset('images/belakang.png') }}'); background-size: cover; transform: rotate(180deg)">
    <table style="padding:5px 0px 5px; position:relative; font-family: arial; font-size: 10px;" cellpadding="0" cellspacing="0">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $row->nama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $row->domisili_alamat }} RT: {{ $row->domisili_rt }} RW: {{ $row->domisili_rw }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Kec. {{ $row->kec }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{ $row->kab }}</td>
        </tr>
        <tr>
            <td>Lokasi Parkir</td>
            <td>:</td>
            <td>{{ $row->nama_lokasi }}</td>
        </tr>
        <tr>
            <td>Ruas Jalan</td>
            <td>:</td>
            <td>{{ $row->nama_ruas }}</td>
        </tr>
       <tr>
            <td>Jam Kerja</td>
            <td>:</td>
            <td>{{ $row->jam_kerja_awal }} s.d {{ $row->jam_kerja_akhir }}</td>
        </tr>
    </table>
    <ol style="padding:0px 5px 5px 20px; position:relative; font-family:arial; font-size: 10px;" align="justify">
        <li>
            Kartu Identitas Petugas Parkir harus dipakai saat bertugas dan tidak boleh dipinjamkan / dipakai orang lain
        </li>
        <li>
            Petugas Parkir berkewajiban :
            <ol type="a" style="padding-left:15px;">
                <li>
                    Memberikan pelayanan masuk dan keluarnya kendaraan ditempat parkir
                </li>
                <li>
                    Menjaga ketertiban dan keamanan terhadap kendaraan yang diparkir
                </li>
                <li>
                    Menyerahkan karcis parkir, menerima pembayaran dan menyetorkan retribusi parkir sesuai ketentuan
                </li>
                <li>
                    Mematuhi batas-batas parkir / petak parkir yang telah ditetapkan
                </li>
            </ol>
        </li>
        <li>
            Pelanggaran terhadap ketentuan ini, dapat diberikan sanksi sesuai dengan peraturan
        </li>
    </ol>
    <p style="padding-top:3px; width:220px; text-align:center; font-size:10px"><b>Berlaku sampai dengan 31 Desember {{ $row->tahun_pengelolaan }}</b></p>
</div>
</div>

<div style="margin-top:-700px; padding-left:750px; width:220px; height:690px;">
<!--Depan-->
<div id="depan4" style="width:220px; height:340px; margin:5px; background-image: url('{{ asset('images/depan.png') }}'); background-size: cover;">
    <p style="padding-top:80px; padding-left:10px; font-size: 11px"><b>KARTU IDENTITAS PETUGAS PARKIR</b></p> 
    <img style="position:absolute; margin-left:60px;" src="{{ asset(ltrim($row->foto, './')) }}" width="90px">
    <p style="padding-top:145px; width:220px; text-align:center;"><b>{{ strtoupper($row->nama) }}</b></p>
    <img style="position:absolute; margin-left:70px; margin-top: -10px;" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode(url('profil/jukir/'.$row->nik)) }}" width="75px">
</div>
<!--Belakang-->
<div id="belakang4" style="width:220px; height:340px; margin:5px; background-image: url('{{ asset('images/belakang.png') }}'); background-size: cover; transform: rotate(180deg)">
    <table style="padding:5px 0px 5px; position:relative; font-family: arial; font-size: 10px;" cellpadding="0" cellspacing="0">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $row->nama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $row->domisili_alamat }} RT: {{ $row->domisili_rt }} RW: {{ $row->domisili_rw }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Kec. {{ $row->kec }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{ $row->kab }}</td>
        </tr>
        <tr>
            <td>Lokasi Parkir</td>
            <td>:</td>
            <td>{{ $row->nama_lokasi }}</td>
        </tr>
        <tr>
            <td>Ruas Jalan</td>
            <td>:</td>
            <td>{{ $row->nama_ruas }}</td>
        </tr>
       <tr>
            <td>Jam Kerja</td>
            <td>:</td>
            <td>{{ $row->jam_kerja_awal }} s.d {{ $row->jam_kerja_akhir }}</td>
        </tr>
    </table>
    <ol style="padding:0px 5px 5px 20px; position:relative; font-family:arial; font-size: 10px;" align="justify">
        <li>
            Kartu Identitas Petugas Parkir harus dipakai saat bertugas dan tidak boleh dipinjamkan / dipakai orang lain
        </li>
        <li>
            Petugas Parkir berkewajiban :
            <ol type="a" style="padding-left:15px;">
                <li>
                    Memberikan pelayanan masuk dan keluarnya kendaraan ditempat parkir
                </li>
                <li>
                    Menjaga ketertiban dan keamanan terhadap kendaraan yang diparkir
                </li>
                <li>
                    Menyerahkan karcis parkir, menerima pembayaran dan menyetorkan retribusi parkir sesuai ketentuan
                </li>
                <li>
                    Mematuhi batas-batas parkir / petak parkir yang telah ditetapkan
                </li>
            </ol>
        </li>
        <li>
            Pelanggaran terhadap ketentuan ini, dapat diberikan sanksi sesuai dengan peraturan
        </li>
    </ol>
    <p style="padding-top:3px; width:220px; text-align:center; font-size:10px"><b>Berlaku sampai dengan 31 Desember {{ $row->tahun_pengelolaan }}</b></p>
</div>
</div>

</body>
</html>
