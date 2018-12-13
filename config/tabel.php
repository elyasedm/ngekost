<?php
	function tabel_jadwal($tgl,$no)
	{
		$hasil = check_tgl($tgl);
		if($hasil == 0)
		{
			$line ="<tr class='merah'>";
		}
		elseif($hasil == 1)
		{
			$line ="<tr class='hijau'>";
		}
		elseif($hasil == 2)
		{
			if($no % 2 == 0)
				$line = "<tr class='genap'>";
			else
				$line = "<tr class='ganjil'>";
		}
		return $line;
	}

	function tabel_antara($awal,$akhir,$no)
	{
		$hasil = tanggal_antara($awal,$akhir);
		if($hasil == 0)
		{
			$line ="<tr class='merah'>";
		}
		elseif($hasil == 1)
		{
			$line ="<tr class='hijau'>";
		}
		elseif($hasil == 2)
		{
			if($no % 2 == 0)
				$line = "<tr class='genap'>";
			else
				$line = "<tr class='ganjil'>";
		}
		return $line;
	}
	
	function tabel_normal($no)
	{
		if($no % 2 == 0)
			$line = "<tr class='genap'>";
		else
			$line = "<tr class='ganjil'>";
		return $line;
	}
	
	function tabel_hari($hari,$no)
	{
		if($hari == date("N"))
		{
			$line ="<tr class='hijau'>";
		}
		else
		{
			if($no % 2 == 0)
				$line = "<tr class='genap'>";
			else
				$line = "<tr class='ganjil'>";
		}
		return $line;		
	}
	
	function jk($jk){
		if($jk == 'L'){
			return "Laki - laki";
		}else{
			return "Perempuan";
		}
	}
?>