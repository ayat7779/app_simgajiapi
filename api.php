<?php
// $menu = $_GET['menu']; versi php 5.3.
$menu = isset($_GET['menu']) ? $_GET['menu']:'';
switch ($menu) {
	case 'getPegawai':
		$data = getPegawai($_GET['nip']);
		break;
	case 'getHubKeluarga':
		$data = getHubKeluarga($_GET['nip']);
		break;
	case 'getGaji':
		$data = getGaji($_GET['nip'], $_GET['gaji']);
		break;
	case 'getGajiT':
		$data = getGajiT($_GET['nip'], $_GET['gaji'], $_GET['gajiT']);
		break;
	case 'getKDSatker':
		$data = getKDSatker();
		break;
	case 'getNMSatker':
		$data = getNMSatker($_GET['kd']);
		break;
	case 'getGajiSatker':
		$data = getGajiSatker($_GET['kd'], $_GET['Tgaji']);
		break;
	case 'getGajiSatkerPersonal':
		$data = getGajiSatkerPersonal($_GET['kd'], $_GET['Tgaji'], $_GET['nip']);
		break;
	case 'getGajiPersonalView':
		$data = getGajiPersonalView($_GET['Tgaji'], $_GET['nip']);
		break;
	default:

		break;
}
// print_r(json_encode($data))  versi php 5.3.
$result = isset($data) ? print_r(json_encode($data)) : '';
echo $result;
function getPegawai($nip)
{
	include "page/koneksi.php";
	$qry = "SELECT * FROM vwpegawai a, stawin_tbl b, mstpegawai c, satker_tbl d, skpd_tbl e  WHERE e.KDSKPD = d.KDSKPD AND d.KDSATKER=c.KDSATKER AND a.kdstawin=b.kdstawin AND c.NIP=a.NIP AND a.NIP='" . $nip . "' ";
	$pnsd = $db1->prepare($qry);
	$pnsd->execute();
	$res1 = $pnsd->get_result();
	$data = $res1->fetch_array();
	$results=isset($data) ? $data :'Data Tidak Ditemukan';
	return $results;
}
function getHubKeluarga($nip)
{
	include "page/koneksi.php";
	$qry = "SELECT NMHUBKEL, TRIM(CONCAT(TRIM(b.GLRDEPAN), ' ', TRIM(NMKEL), ' ', TRIM(b.GLRBELAKANG))) AS NAMA, b.TGLLHR, b.TGLNIKAH, b.TGLCERAI, b.TGLWAFAT, b.PEKERJAAN, TRIM(b.NIPSUAMIISTRI)  
			FROM vwpegawai a, keluarga b, hubkel_tbl c
			WHERE a.NIP=b.NIP AND c.KDHUBKEL=b.KDHUBKEL AND a.NIP='" . $nip . "' AND c.KDHUBKEL != 00";
	$result = $db1->query($qry);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$rows[] = $row;
	}
	$results=isset($rows) ? $rows :'Data Tidak Ditemukan';
	return $results;
}
function getGaji($nip, $gaji)
{
	include "page/koneksi.php";
	$qry = "SELECT 
			TGLGAJI, GAPOK, TJISTRI, TJANAK, TJESELON, TJFUNGSI, TJKHUSUS, TJBERAS, TJASKES, TJUMUM, TBULAT, KOTOR,  
			PIWP, PIWP8, PIWP2, PASKES, PPAJAK, PTAPERUM, POTONGAN, BERSIH
			FROM fgaji WHERE NIP='" . $nip . "' AND TGLGAJI LIKE '" . $gaji . "%'";
	$result = $db1->query($qry);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$rows[] = $row;
	}
	$results=isset($rows) ? $rows :'Data Tidak Ditemukan';
	return $results;
}
function getGajiT($nip, $gaji, $gajiT)
{
	include "page/koneksi.php";
	$qry = "SELECT SUM(TGLGAJI) TGLGAJI, SUM(GAPOK) GAPOK, SUM(TJISTRI) TJISTRI, SUM(TJANAK) TJANAK, SUM(TJESELON) TJESELON, SUM(TJFUNGSI) TJFUNGSI, SUM(TJKHUSUS) TJKHUSUS, SUM(TJBERAS) TJBERAS, SUM(TJASKES) TJASKES, SUM(TJUMUM) TJUMUM, SUM(TBULAT) TBULAT, SUM(KOTOR) KOTOR,  SUM(PIWP) PIWP, SUM(PIWP8) PIWP8, SUM(PIWP2) PIWP2, SUM(PASKES) PASKES, SUM(PPAJAK) PPAJAK, SUM(PTAPERUM) PTAPERUM, SUM(POTONGAN) POTONGAN, SUM(BERSIH) BERSIH FROM fgaji WHERE NIP='" . $nip . "' AND (TGLGAJI = '" . $gajiT . "' OR (TGLGAJI = '" . $gaji . "'))";
	$result = $db1->query($qry);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$rows[] = $row;
	}
	$results=isset($rows) ? $rows :'Data Tidak Ditemukan';
	return $results;
}
function getKDSatker()
{
	include "page/koneksi.php";
	$qry = "SELECT * FROM satker_tbl a, skpd_tbl b WHERE a.KDSKPD = b.KDSKPD GROUP BY a.KDSKPD ORDER BY NMSKPD";
	$result = $db1->query($qry);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$rows[] = $row;
	}
	$results=isset($rows) ? $rows :'Data Tidak Ditemukan';
	return $results;
}
function getNMSatker($kd)
{
	include "page/koneksi.php";
	$qry = "SELECT * FROM satker_tbl a, skpd_tbl b WHERE a.KDSKPD = b.KDSKPD AND a.KDSKPD='" . $kd . "' GROUP BY a.KDSKPD ORDER BY NMSKPD";
	$result = $db1->query($qry);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$rows[] = $row;
	}
	$results=isset($rows) ? $rows :'Data Tidak Ditemukan';
	return $results;
}
function getGajiSatker($kd, $Tgaji)
{
	include "page/koneksi.php";
	$qry = "SELECT fg.NAMA, m.NIP, fg.NOKTP, m.TEMPATLHR, m.TGLLHR, m.ALAMAT, m.NOTELP, m.KDFUNGSI, m.KDESELON, et.URAIAN, pt.NMGOL, st.NMSTAPEG, jt.NMJABATAN, m.KDSTAWIN, m.induk_bank, fg.NPWP, m.NOREK, m.JANAK, m.JISTRI, fg.GAPOK, fg.TJISTRI, fg.TJANAK, fg.TJESELON, fg.TJFUNGSI, fg.TJUMUM, fg.TJBERAS, fg.TJPAJAK, fg.TBULAT, fg.TJASKES, fg.TJKK, fg.TJKM, fg.piwp8, fg.piwp2, fg.PTAPERUM, fg.MASKER, st3.nmstawin 
	from mstpegawai m
	join pangkat_tbl pt on pt.KDPANGKAT = m.KDPANGKAT 
	join stapeg_tbl st on st.KDSTAPEG = m.KDSTAPEG
	join jabatan_tbl jt on jt.KDJABATAN = m.KDFUNGSI
	join fgaji fg on fg.NIP = m.NIP 
	join satker_tbl st2 on st2.KDSATKER =m.KDSATKER
	join stawin_tbl st3 on st3.kdstawin =m.KDSTAWIN
	join eselon_tbl et on et.KDESELON=m.KDESELON
	WHERE m.TMTSTOP IS NULL AND m.KDJNSTRANS = 1 AND fg.TGLGAJI = '" . $Tgaji . "' AND st2.KDSKPD ='" . $kd . "' ORDER BY NIP";
	$result = $db1->query($qry);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$rows[] = $row;
	}
	$results=isset($rows) ? $rows :'Data Tidak Ditemukan';
	return $results;
}
function getGajiSatkerPersonal($kd, $Tgaji, $nip)
{
	include "page/koneksi.php";
	$qry = "SELECT fg.NAMA, m.NIP, fg.NOKTP, m.TEMPATLHR, m.TGLLHR, m.ALAMAT, m.NOTELP, et.URAIAN, pt.NMPANGKAT, pt.NMGOL, st.NMSTAPEG, jt.NMJABATAN, fg.NPWP, mb.name, m.NOREK, m.JANAK, m.JISTRI, fg.MASKER, st3.NMSTAWIN, m.PENDIDIKAN, st2.NMSATKER
	from mstpegawai m
	join pangkat_tbl pt on pt.KDPANGKAT = m.KDPANGKAT 
	join stapeg_tbl st on st.KDSTAPEG = m.KDSTAPEG
	join jabatan_tbl jt on jt.KDJABATAN = m.KDFUNGSI
	join fgaji fg on fg.NIP = m.NIP 
	join satker_tbl st2 on st2.KDSATKER =m.KDSATKER
	join stawin_tbl st3 on st3.kdstawin =m.KDSTAWIN
	join eselon_tbl et on et.KDESELON=m.KDESELON
	join master_banks mb on mb.code=m.induk_bank
	WHERE m.TMTSTOP IS NULL AND m.KDJNSTRANS = 1 AND fg.TGLGAJI = '" . $Tgaji . "' AND st2.KDSKPD ='" . $kd . "' AND m.NIP='" . $nip . "' ORDER BY NIP";
	$result = $db1->query($qry);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$rows[] = $row;
	}
	$results=isset($rows) ? $rows :'Data Tidak Ditemukan';
	return $results;
}
function getGajiPersonalView($Tgaji, $nip)
{
	include "page/koneksi.php";
	$qry = "SELECT fg.TGLGAJI, fg.NAMA, fg.NIP, fg.GAPOK, fg.TJISTRI, fg.TJANAK, fg.TJESELON, fg.TJFUNGSI, fg.TJUMUM, fg.TJBERAS, fg.TJPAJAK, fg.TBULAT, fg.TJASKES, fg.TJKK, fg.TJKM, fg.piwp8, fg.piwp2, fg.PTAPERUM
	FROM fgaji fg 
	WHERE fg.TMTSTOP IS NULL AND fg.KDJNSTRANS = 1 AND fg.TGLGAJI = '" . $Tgaji . "' AND fg.NIP ='" . $nip . "' ORDER BY NIP";
	$result = $db1->query($qry);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$rows[] = $row;
	}
	$results=isset($rows) ? $rows :'Data Tidak Ditemukan';
	return $results;
}
