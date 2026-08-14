<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Cetak SK</title>
</head>
<body onload="window.print()">
<img style="display:block; margin: 0 auto; padding-left:10px; padding-top:5px;" class="img-responsive img" alt="Responsive image" src="{{ asset('images/kop.jpg') }}" width="800px">

<p align="center">
<strong><u>SURAT PERINTAH TUGAS</u></strong><br>
Nomor : {{ $row->no_spt }}<br>
<br>
</p>
<table cellpadding="0px" cellspacing="2px">
	<tr>
		<td>Dasar</td>
		<td>:</td>
		<td width="10px">1. </td>
		<td colspan="3">
			Peraturan Daerah Kabupaten Banjarnegara Nomor 6 Tahun 2011 tentang Retribusi Daerah;
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td valign="top">2.</td>
		<td colspan="3">
			Peraturan Daerah Kabupaten Banjarnegara Nomor 10 Tahun 2019 tentang Penyelenggaraan Perparkiran;
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td valign="top">3.</td>
		<td align="justify" colspan="3">
			Peraturan Bupati Banjarnegara Nomor 53 Tahun 2015 tentang Peninjauan Tarif Retribuisi Pelayanan Parkir Ditepi Jalan Umum;
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td valign="top" >4.</td>
		<td align="justify" colspan="3">
			Peraturan Bupati Banjarnegara Nomor 54 Tahun 2020 Tentang Petunjuk Pelaksanaan Peraturan Daerah Kabupaten Banjarnegara Nomor 10 Tahun 2019 tentang Penyelenggaraan Perparkiran.
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td valign="top" colspan="4">
			Dengan ini Kepala Dinas Perhubungan Kabupaten Banjarnegara memerintahkan kepada :
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td align="left" colspan="2">Nama</td>
		<td align="left" width="5px">:</td>
		<td align="left"><b>{{ strtoupper($row->nama) }}</b></td>	
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td align="left" colspan="2">Tempat Tanggal Lahir</td>
		<td align="left" width="5px">:</td>
		<td align="left">{{ $row->tempat_lahir }}, {{ parse_tgl($row->tanggal_lahir) }}</td>	
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td align="left" colspan="2">Alamat</td>
		<td align="left" width="5px">:</td>
		<td align="left">{{ $row->alamat }}, {{ $row->desa }}, Kec. {{ $row->kec }}, {{ $row->kab }}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td align="left" colspan="2" valign="top">Melaksanakan Tugas Pemungutan Retribusi Parkir di 
			@if($row->jenis_fasilitas == 'dalam')
			Tepi Jalan Umum
			@elseif($row->jenis_fasilitas == 'luar')
				@if($row->jenis_parkir_luar == 'tkp')
					Tempat Khusus Parkir
				@elseif($row->jenis_parkir_luar == 'tpk')
					Tempat Parkir Khusus
				@endif
			@endif
		pada</td>
		<td align="left" width="5px" valign="top">:</td>
		<td align="left" valign="top">{{ $row1->nama_lokasi }}, {{ $row1->jenis_desa ?? '' }} {{ $row1->desa }}, Kec. {{ $row1->kec }}<br> Ruas Jalan {{ $row1->nama_ruas }}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td align="left" colspan="2">Terhitung Mulai Tanggal</td>
		<td align="left" width="5px">:</td>
		<td align="left">{{ parse_tgl($row->tmt_spt_awal) }} s.d {{ parse_tgl($row->tmt_spt_akhir) }}</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td align="left" colspan="2">Jumlah Setoran per Bulan</td>
		<td align="left" width="5px">:</td>
		<td align="left">Rp. {{ number_format($row->setoran_perbulan, 2, ',', '.') }} (<i>{{ terbilang($row->setoran_perbulan) }} rupiah</i>)</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td align="left" colspan="2">Keterangan</td>
		<td align="left" width="5px">:</td>
		<td align="left">Di setorkan paling lambat tanggal 25 pada bulan berjalan</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td valign="top" colspan="4" align="justify">
			Apabila dikemudian hari ada hal – hal yang kurang benar, maka akan dilaksanakan perbaikan.<br>
Demikian surat perintah ini diberikan kepada yang bersangkutan agar dapat dilaksanakan dengan baik dan penuh tanggung jawab.

		</td>
	</tr>
</table>
<p></p>
<table>
	<tr>
		<td width="250px"></td>
		<td></td>
		<td>Dikeluarkan di : Banjarnegara<br><u>Tanggal 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			: {{ parse_tgl($row->tgl_spt) }}</u></td>
	</tr>
	<tr>
		<td align="center" valign="top">
			Pihak Yang <br>
			Melaksanakan Perintah<br>
			<br>
			<br>
			<br>
			<br>
			<b><u>{{ strtoupper($row->nama) }}</u></b>
		</td>
		<td width="150px"></td>
		<td align="center" valign="top">
			Kepala Dinas Perhubungan<br>
			Kabupaten Banjarnegara<br>
			<br>
			<br>
			<br>
			<br>
			<b><u>{{ $row2 ? strtoupper($row2->nama_pejabat) : '' }}</u></b><br>
			{{ $row2 ? $row2->pangkat_pejabat : '' }}<br>
			NIP. {{ $row2 ? $row2->nip_pejabat : '' }}
		</td>
		
	</tr>

</table>
</body>
</html>
