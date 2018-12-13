<?php
	function hari_english($hari)
	{
		switch($hari){
		case "Minggu":
			return "Sunday";
			break;
		case "Senin":
			return "Monday";
			break;
		case "Selasa":
			return "Tuesday";
			break;
		case "Rabu":
			return "Wednesday";
			break;
		case "Kamis":
			return "Thursday";
			break;
		case "Jumat":
			return "Friday";
			break;
		case "Sabtu":
			return "Saturday";
			break;
		}
	}
	
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
	function tgl_english($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulanEnglish(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $bulan.' '.$tanggal.', '.$tahun;		 
	}	

	function getBulanEnglish($bln){
				switch ($bln){
					case 1: 
						return "January";
						break;
					case 2:
						return "February";
						break;
					case 3:
						return "March";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "May";
						break;
					case 6:
						return "June";
						break;
					case 7:
						return "July";
						break;
					case 8:
						return "August";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "October";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "December";
						break;
				}
			} 
?>
