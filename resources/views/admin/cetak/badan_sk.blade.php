<head>
    <meta charset='UTF-8'>
    <title>Cetak SK</title>
</head>
<body>
<img style="display:block; margin: 0 auto; padding-left:10px; padding-top:5px;" class="img-responsive img" alt="Responsive image" src="<?php echo asset('/')?>images/kop.jpg" width="800px">

<p align="center">
SURAT PERJANJIAN KERJASAMA ANTARA <br>
DINAS PERHUBUNGAN KABUPATEN BANJARNEGARA<br><br>
DENGAN<br><br>
PENGELOLA PARKIR DI <?php echo strtoupper($row->jenis_lokasi)?><br>
<?php echo strtoupper($row->zona)?><br>
(<?php echo strtoupper($row->nama_lokasi)?>)<br>
KABUPATEN BANJARNEGARA<BR>
Nomor : <?php echo $row->no_sk?><br><br>
TENTANG <br><br>
PENGELOLAAN RETRIBUSI PARKIR <?php echo strtoupper($row->jenis_lokasi)?> DI WILAYAH <br>
<?php echo strtoupper($row->zona)?><br>
( <?php echo strtoupper($row->nama_lokasi)?> )
KABUPATEN BANJARNEGARA <br>
TAHUN ANGGARAN <?php echo $row->tahun_pengelolaan?>
</p>
<p align="justify">
	<?php
	$t = explode('-',$row->tgl_sk);
	$tgl = tgl($t[2]);
	?>
	Pada hari ini <b><?php echo $row->hari_sk?></b> tanggal <b><?php echo terbilang($tgl)?></b> bulan <b><?php echo bulan($t[1])?></b> tahun <b><?php echo terbilang($t[0])?></b>, yang bertanda tangan dibawah ini :
</p>
<br>
<table cellpadding="2px" cellspacing="2px">
	<tr>
		<td valign="top">1.</td>
		<td valign="top">
			<?php echo $row2 ? $row2->nama_pejabat : '' ?>
		</td>
		<td valign="top">:</td>
		<td align="justify">
			Kepala Dinas Perhubungan Kabupaten Banjarnegara berkedudukan di Banjarnegara, Jalan Selamanik No. 1 Semampir Banjarnegara, yang diangkat berdasarkan Keptusan Bupati Banjarnegara Nomor : 821.2/197 Tahun 2020 tanggal 30 Januari 2020 tentang Penunjukan Kepala Dinas Perhubungan Kabupaten Banjarnegara selaku Pejabat Pengguna Anggaran Pada Dinas Perhubun,gan Kabupaten Banjarnegara Tahun 2020, dalam hal ini bertindak dan atas nama serta sah mewakili Pemerintah Kabupaten Banjarnegara selanjutnya disebut PIHAK KESATU.
		</td>
	</tr>
	<tr>
		<td valign="top">2.</td>
		<td valign="top">
			<?php echo strtoupper($row->pengurus_nama)?>
		</td>
		<td valign="top">:</td>
		<td align="justify">
			<?php echo $row->pengurus_jabatan?> <?php echo $row->nama_badan?> sebagai Pengelola Parkir <?php echo $row->jenis_lokasi?> wilayah <?php echo $row->zona?> ( <?php echo $row->nama_lokasi?> ), berkedudukan di <?php echo $row->alamat_kantor?> RT <?php echo $row->rt?> RW <?php echo $row->rw?> <?php echo $row->desa?>, Kecamatan <?php echo $row->kec?> <?php echo $row->kab?>, dalam hal ini bertindak dan atas nama serta sah sebagai Pengelola Parkir <?php echo $row->jenis_lokasi?>  <?php echo $row->zona?> ( <?php echo $row->nama_lokasi?> ) Kabupaten Banjarnegara selanjutnya disebut PIHAK KEDUA.
		</td>
	</tr>
</table>
<br>
<p align="justify">
	PIHAK KESATU dan PIHAK KEDUA (untuk selanjutnya secara bersama-sama disebut PARA PIHAK) sepakat melakukan Perjanjian Kerjasama Pengelolaan Retribusi Parkir Di  <?php echo $row->jenis_lokasi?> Di Wilayah <?php echo $row->zona?> (<?php echo $row->nama_lokasi?>) Kabupaten Banjarnegara, dengan didasarkan pada ketentuan sebagai berikut : 
</p>
<p align="justify">
<ol>
	<li>Undang-Undang Nomor 13 Tahun 1950 tentang Pembentukan Daerah-daerah Kabupaten Dalam Lingkungan Provinsi Jawa Tengah;</li>
	<li>Undang-Undang Nomor 32 Tahun 2004 tentang Pemerintahan Daerah (Lembaran Negara Republik Indonesia Tahun 2004 Nomor 125, Tambahan Lembaran Negara Republik Indonesia Nomor 4437), sebagaimana telah diubah beberapa kali terakhir dengan 
Undang-Undang Nomor 38 Tahun 2004 tentang Jalan (Lembaran Negara Republik Indonesia Tahun 2004 Nomor 132, Tambahan Lembaran Negara Republik Indonesia Nomor 4444);</li>
	<li>Undang-Undang Nomor 22 Tahun 2009 tentang Lalu Lintas dan Angkutan Jalan (Lembaran Negara Republik Indonesia Tahun 2009 Nomor 96, Tambahan Lembaran Negara Republik Indonesia Nomor 5025);</li>
	<li>Undang-Undang Nomor 28 Tahun 2009 tentang Pajak Daerah dan Retribusi Daerah (Lembaran Negara Republik Indonesia Tahun 2009 Nomor 130, Tambahan Lembaran Negara Republik Indonesia Nomor 5049);</li>
	<li>Peraturan Pemerintah Nomor 58 Tahun 2005 tentang Pengelolaan Keuangan Daerah ( Lembaran Negara Republik Indonesia Tahun 2005 Nomor 140, Tambahan Lembaran Negara Republik Indonesia Nomor 4578 );</li>
	<li>Keputusan Menteri Perhubungan Nomor : KM 66 Tahun 1993 tentang Fasilitas Parkir Untuk Umum;</li>
	<li>Keputusan Menteri Dalam Negeri Nomor : 73 Tahun 1999 tentang Pedoman Penyelenggaraan Perparkiran Daerah;</li>
	<li>Peraturan Daerah Nomor 94 Tahun 2009 tentang Kerja sama Daerah;</li>
	<li>Peraturan Bupati Nomor 19 Tahun 2014 tentang Tata Cara Pengelolaan Kerja sama Daerah;</li>
	<li>Peraturan Daerah No 10 Tahun 2019 tentang Penyelenggaraan Perparkiran;</li>
	<li>Peraturan Bupati Banjarnegara Nomor 53 Tahun 2015 Tentang Peninjauan Tarif Retribusi Pelayanan Parkir Di Tepi Jalan Umum;
	<li>Peraturan Bupati Banjarnegara Nomor 23 Tahun 2016 Tentang Peninjauan Tarif Retribusi Tempat Khusus Parkir;</li>
	<li>Peraturan Bupati Banjarnegara Nomor 74 Tahun 2016 Tentang Kedudukan, Susunan Organisasi, Tugas dan Fungsi Serta Tata Kerja Dinas Perhubungan Kabupaten Banjarnegara;</li>
	<li>Peraturan Bupati Banjarnegara Nomor 54 Tahun 2020 Tentang Petunjuk Pelaksanaan Peraturan Daerah Nomor 10 Tahun 2019 tentang Penyelenggaraan Perparkiran.</li>
</ol>
</p>
<p align="center">
<b>BAB I</b><br>
Maksud dan Tujuan<br> 
Pasal 1<br>
</p>
<p align="justify">
	<ol>
		<li>
			Perjanjian Kerjasama ini dimaksudkan untuk menjadikan acuan PARA PIHAK dalam rangka Pelaksanaan Pegelolan, Penataan, dan Pemungutan Retribusi Pakir di <?php echo $row->jenis_lokasi?> Wilayah  <?php echo $row->zona?> (  <?php echo $row->nama_lokasi?> ) Kabupaten Banjarnegara.
		</li>
		<li>
			Perjanjian Kerjasama ini bertujuan :
		</li>
		<ol type="a">
			<li>Agar Pengelolaan  dan Penataan Parkir di Lingkungan Wilayah <?php echo $row->zona?>(<?php echo $row->nama_lokasi?> ) Kabupaten Banjarnegara kondisi Aman, Tertib, Selamat dan Lancar dalam berlalu lintas (KAMTIBSELANCARLANTAS).</li>
			<li>Meningkatkan Pendapatan Daerah Kabupaten Banjarnegara dan memberikan kesejahteraan kepada Pengelola Parkir.</li>
			<li>Meningkatkan Pelayanan kepada Masyarakat Pengguna Jasa Parkir  di <?php echo $row->jenis_lokasi?>  Wilayah <?php echo $row->zona?> ( <?php echo $row->nama_lokasi?>) Kabupaten Banjarnegara. </li>

		</ol>
	</ol>
</p>
<p align="center">
<b>BAB II</b><br>
Ruang Lingkup Perjanjian Kerjasama<br> 
Pasal 2<br>
</p>
<p align="justify">
Ruang Lingkup Perjanjian Kerjasama ini meliputi :
<ol>
<li>Tugas dan tangung jawab,</li>
<li>Pelaksanaan,</li>
<li>Pembiayaan, dan</li>
<li>Jangka waktu.</li>
</ol>
</p>
<p align="center">
<b>BAB III</b><br>
Pengelolaan Retribusi Parkir di Tepi Jalan Umum <br> 
Pasal 3<br>
</p>
<p align="justify">
Pengelolaan Retribusi Parkir di Lokasi atau Tempat Parkir di  Tepi Jalan Umum diperlukan untuk mendukung peningkatan Pendapatan Asli Daerah Kabupaten Banjarnegara, melalui Pendapatan Retribusi Parkir.
</p>
<p align="center">
<b>BAB IV</b><br>
Hak dan Kewajiban Para Pihak <br> 
Pasal 4<br>
</p>
<p align="justify">
	<ol>
		<li>Hak PIHAK KESATU sebagai berikut :</li>
		<ol type="a" align="justify">
			<li>Menerima hasil Pemungutan Retribusi Parkir di <?php echo $row->jenis_lokasi?> di Wilayah <?php echo $row->zona?> ( <?php echo $row->nama_lokasi?> ) Kabupaten Banjarnegara sejumlah Rp. <?php echo number_format($row->retribusi_pertahun,2,',','.')?> (<?php echo terbilang($row->retribusi_pertahun)?> Rupiah) Per Tahun atau Rp. <?php echo number_format($row->retribusi_perbulan,2,',','.')?> (<?php echo terbilang($row->retribusi_perbulan)?> Rupiah) Per Bulan paling akhir tanggal 25 pada bulan berjalan;</li>
			<li>Menagih hasil Pemungutan Retribusi Parkir yang tidak disetor pada waktu yang ditentukan;</li>
			<li>Memantau dan mengevaluasi pelaksanaan Pemungutan Retribusi Parkir di Tepi Jalan Umum.</li>
		</ol>
		<li>Kewajiban PIHAK KESATU sebagai berikut :</li>
		<ol type="a">
			<li>Melakukan Survey Potensi Retribusi Parkir di <?php echo $row->jenis_lokasi?>;</li>
			<li>Menyelenggarakan Seleksi Pengelola Retribusi Parkir di<?php echo $row->jenis_lokasi?>;</li>
			<li>Menetapkan dan menyerahkan Pengelolaan Tempat Parkir di <?php echo $row->jenis_lokasi?>;</li>
			<li>Memberikan Pembinaan, Bimbingan, Pemantauan dan Evaluasi Pengelolaan Parkir.</li>
		</ol>
		<li>Hak PIHAK KEDUA sebagai berikut :</li>
		<ol type="a">
			<li>Mengelola Tempat Parkir di <?php echo $row->jenis_lokasi?> di Wilayah <?php echo $row->zona?> ( <?php echo $row->nama_lokasi?> ) Kabupaten Banjarnegara;</li>
			<li>Memungut Tarif Retribusi parkir di <?php echo $row->jenis_lokasi?> yang besarnya sesuai dengan Peraturan Perundang-undangan yang berlaku dan memberikan Karcis Parkir kepada Pengguna Jasa Parkir.</li>
		</ol>
		<li>Kewajiban PIHAK KEDUA sebagai berikut :</li>
		<ol type="a">
			<li>Bersedia membantu melarang Pedagang Kaki Lima (PKL) berjualan di Lokasi Parkir;</li>
			<li>Bersedia tidak memindahtangankan/ menyewakan/ memperjualbelikan Lokasi Parkir;</li>
			<li>Tidak merubah fungsi Lahan Parkir;</li>
			<li>Menyerahkan uang jaminan 2 (dua) bulan setelah dinyatakan sebagai Pengelola Parkir di <?php echo $row->jenis_lokasi?> ;</li>
			<li>Melaksanakan Keamanan, Ketertiban dan Kelancaran Lalu Lintas Parkir di <?php echo $row->jenis_lokasi?> yang dikelola; </li>
			<li>Memberikan pelayanan kepada Pengguna Jasa Parkir dengan sebaik-baiknya; </li>
			<li>Memungut Tarif Retribusi Parkir di <?php echo $row->jenis_lokasi?> yang besarnya sesuai dengan Peraturan Perundang-undangan yang berlaku dan memberikan Karcis Parkir kepada Pengguna Jasa Parkir; </li>
			<li>Menyetorkan hasil Pemungutan Retribusi Parkir di <?php echo $row->jenis_lokasi?> kepada PIHAK KESATU sejumlah Rp. <?php echo number_format($row->retribusi_perbulan,2,',','.')?>/bulan selambat-lambatnya tanggal 25 pada bulan berjalan; </li>
			<li>Memberikan Baju Seragam atau Rompi Parkir dan Tanda Pengenal serta kelengkapannya kepada Juru Parkir;</li>
			<li>Memberikan Ganti Rugi atas kehilangan Kendaraan termasuk kelengkapannya and/atau kerusakan yang dialami karena kesengajaan atau kealpaan Juru Parkir;</li>
			<li>Menyerahkan bukti Retribusi Parkir yang diterbitkan Pemerintah Daerah kepada Pengguna Jasa Parkir; </li>
			<li>Mematuhi ketentuan Tarif Retribusi Parkir yang berlaku; dan </li>
			<li>Mematuhi dan Mentaati Ketentuan-ketentuan yang tertuang dalam Surat Perjanjian Kerjasama.</li>

		</ol>
	</ol>
</p>
<p align="center">
<b>BAB V</b><br>
Akses Data <br> 
Pasal 5<br>
</p>
<p align="justify">
PIHAK KESATU menyerahkan Data Tempat Parkir di <?php echo $row->jenis_lokasi?> kepada PIHAK KEDUA untuk pelaksanaan penataan Parkir.</p>
<p align="center">
<b>BAB VI</b><br>
Korespondensi dan Komunikasi<br> 
Pasal 6<br>
</p>
<p align="justify">
Setiap Dokumen dan/atau Pemberitahuan, Persetujuan, Izin, Permintaan, atau Komunikasi lainnya yang berhubungan dengan Perjanjian Kerjasama ini harus dibuat secara tertulis dan/atau dapat disampaikan secara langsung oleh PARA PIHAK.
<ol>
	<li>
		Alamat yang akan dipergunakan untuk komunikasi PARA PIHAK sebagaimana dimaksud pada pasal (8) adalah sebagai berikut :
		<ol type="a">
			<li>
				Seksi Pendataan, Pengawasan dan Pembinaan, serta Seksi Pemungutan, Bidang Perparkiran Dinas Perhubungan Dinas Perhubungan  Kabupaten Banjarnegara, Jalan Selamanik No. 1 Banjarnegara
			</li>
			<li>
				Pengelola Parkir di <?php echo $row->jenis_lokasi?> <?php echo $row->zona?> ( <?php echo $row->nama_lokasi?> ) Kabupaten Banjarnegara, yang beralamat di <?php echo $row->alamat_kantor?> RT <?php echo $row->rt?> RW <?php echo $row->rw?> <?php echo $row->desa?>, Kecamatan <?php echo $row->kec?> <?php echo $row->kab?>.
			</li>
		</ol>
	</li>
</ol>
</p>
<p align="center">
<b>BAB VII</b><br>
Evaluasi<br> 
Pasal 7<br>
</p>
<p align="justify">
<ol>
	<li>Pelaksanaan Perjanjian Kerjasama ini akan dievaluasi secara berkala sekurang-kurangnya 1 (satu) kali dalam <b><i>3 ( Tiga ) bulan</i></b> secara bersama-sama oleh PARA PIHAK.
	<li>Hasil evaluasi sebagaimana tersebut pada ayat (1) akan digunakan sebagai masukan dan bahan pertimbangan dalam Perjanjian Kerjasama selanjutnya.</li>
</ol>
</p>
<p align="center">
<b>BAB VIII</b><br>
Jangka Waktu<br> 
Pasal 8<br>
</p>
<p align="justify">
Perjanjian kerja sama <b><i>selama 1 ( satu ) tahun</i></b>  mulai berlaku sejak  1 Januari 2021 sampai dengan tanggal 31 Desember 2021 dapat diperpanjang atas persetujuan PARA PIHAK
</p>
<p align="center">
<b>BAB IX</b><br>
Denda Retribusi<br> 
Pasal 9<br>
</p>
<p align="justify">
Jika wajib retribusi melakukan keterlambatan pembayaran dari waktu yang telah ditetapkan maka dikenakan denda sesuai dengan peraturan yang berlaku, yaitu sebesar 2% per bulan.
</p>
<p align="center">
Pasal 10<br>
</p>
<p align="justify">
Apabila Pihak KEDUA tidak memenuhi kewajiban sebagaimana tertuang dalam Pasal 4 ayat 4 ( empat )Keputusan ini, maka diberikan Sanksi berupa :
<ol type="a">
	<li>Teguran Lisan;</li>
	<li>Teguran Tertulis;</li>
	<li>Pemutusan Kerjasama Pengelolaan Parkir.</li>
</ol>
</p>
<p align="center">
<b>BAB X</b><br>
Keadaan Memaksa (Force Majeur)<br> 
Pasal 11<br>
</p>
<p align="justify">
<ol>
<li>Apabila terjadi hal-hal yang di luar kekuasaan PARA PIHAK atau keadaan memaksa, dapat dilakukan perubahan pelaksanaan Perjanjian Kerjasama atas persetujuan PARA PIHAK.</li>
<li>Keadaan memaksa sebagaimana dimaksud pada ayat (1), adalah adanya Kebijakan Pemerintah yang mengakibatkan tidak dapat dilanjutkannya pelaksanaan Perjanjian Kerjasama ini.</li>
</ol>
</p>
<p align="center">
<b>BAB XI</b><br>
Berakhirnya Perjanjian Kerjasama<br> 
Pasal 12<br>
</p>
<p align="justify">
Perjanjian Kerjasama berakhir apabila :
<ol type="a">
	<li>Jangka waktu Perjanjian Kerjasama telah selesai; atau </li>
	<li>Atas kesepakatan PARA PIHAK untuk mengakhiri kerjasama sebelum jangka waktu Perjanjian Kerjasama berakhir.</li>
</ol>
</p>
<p align="center">
<b>BAB XII</b><br>
Penyelesaian Perselisihan<br> 
Pasal 13<br>
</p>
<p align="justify">
<ol>
<li>Apabila dikemudian hari timbul permasalahan dalam perbedaan penafsiran dan pelaksanaan Perjanjian Kerjasama ini antara PARA PIHAK akan diselesaikan secara musyawarah untuk mufakat.</li>
<li>Dalam hal musyawarah dan mufakat sebagaimana dimaksud padaayat (1) tidak tercapai, maka akan diselesaikan sesuai dengan     Peraturan Perundang-undangan.</li>
</ol>
</p>
<p align="center">
<b>BAB XIII</b><br>
Lain-lain<br> 
Pasal 14<br>
</p>
<p align="justify">
<ol>
<li>Hal-hal yang belum diatur atau belum cukup diatur dalam perjanjian kerja sama ini akan diatur dan ditetapkan kemudian dalam bentuk addendum serta merupakan bagian yang tidak terpisahkan dari perjanjian kerja sama ini.</li>
<li>Dalam hal diperlukan, dapat disusun suatu Pedoman atau Standar Operasional Prosedur untuk melaksanakan Perjanjian Kerjasama ini yang ditandatangani oleh Pengelola atau juru parkir dengan Kepala Dinas Perhubungan Kabupaten Banjarnegara.</li>
</ol>
</p>
<p align="center">
<b>BAB XIV</b><br>
Penutup<br> 
Pasal 15<br>
</p>
<p align="justify">
	Demikian Perjanjian Kerjasama ini dibuat dalam rangkap 2 (dua), masing-masing sama aslinya yang dibubuhi materai, ditandatangani PARA PIHAK dan disahkan dengan Stempel Jabatan.
</p>
<p></p>
<table>
	<tr>
		<td width="250px"></td>
		<td width="150px"></td>
		<td>Banjarnegara, <?php echo parse_tgl($row->tgl_sk)?></u></td>
		
	</tr>
	<tr>
		<td align="center" valign="top">
			PIHAK KEDUA<br>
			<br>
			<br>
			<br>
			<br>
			<u><?php echo strtoupper($row->pengurus_nama)?></u>
		</td>
		<td></td>
		<td align="center" valign="top">
			PIHAK KESATU<br>
			<br>
			<br>
			<br>
			<br>
			<u><?php echo $row2 ? strtoupper($row2->nama_pejabat) : '' ?></u><br>
			<?php echo $row2 ? $row2->pangkat_pejabat : '' ?><br>
			NIP. <?php echo $row2 ? $row2->nip_pejabat : '' ?>
		</td>
		
	</tr>

</table>
</body>
