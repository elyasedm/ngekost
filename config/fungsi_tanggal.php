<?php
	function check_tgl($tanggal)
	{
		$tgl_skrg=date('Ymd');
		$tgl 	= date('Ymd',strtotime($tanggal));		
		if($tgl_skrg < $tgl)
		{
			$tmpl = 2;
		}
		elseif($tgl_skrg == $tgl)
		{
			$tmpl = 1;
		}
		else
		{
			$tmpl = 0;
		}
		return $tmpl;
	}

	function tanggal_antara($awal,$akhir)
	{
		$tgl_skrg=date('Ymd');
		$awal	= date('Ymd',strtotime($awal));		
		$akhir	= date('Ymd',strtotime($akhir));		
		if($tgl_skrg < $awal && $tgl_skrg < $akhir)
		{
			$tmpl = 2;
		}
		elseif($tgl_skrg >= $awal && $tgl_skrg<=$akhir)
		{
			$tmpl = 1;
		}
		elseif($tgl_skrg > $awal && $tgl_skrg>$akhir)
		{
			$tmpl = 0;
		}
		return $tmpl;
	}
?>