<?php

class Helpers {
	public function convertTanggal($tanggal){
		//2022-03-16
		
		$bulan = substr($tanggal,5,2);
		
		switch($bulan){
			case "01":
				$WordMonth = "Januari";
			break;
			case "02":
				$WordMonth = "Febuari";
			break;
			case "03":
				$WordMonth = "Maret";
			break;
			case "04":
				$WordMonth = "April";
			break;
			case "05":
				$WordMonth = "Mei";
			break;
			case "06":
				$WordMonth = "Juni";
			break;
			case "07":
				$WordMonth = "Juli";
			break;
			case "08":
				$WordMonth = "Agustus";
			break;
			case "09":
				$WordMonth = "September";
			break;
			case "10":
				$WordMonth = "Oktober";
			break;
			case "11":
				$WordMonth = "November";
			break;
			case "12":
				$WordMonth = "Desember";
			break;
			default:
				$WordMonth = "";
			break;
		}
		
		$result = substr($tanggal,8,2).' '.$WordMonth.' '.substr($tanggal,0,4);
		return $result;
	}
	
	public function gen_uuid() {
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

			// 16 bits for "time_mid"
			mt_rand( 0, 0xffff ),

			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand( 0, 0x0fff ) | 0x4000,

			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand( 0, 0x3fff ) | 0x8000,

			// 48 bits for "node"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
	
	public static function kirimEmail($from,$tujuan,$subject,$isi) {
		
		$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
     	$mailer->IsSMTP();
     	$mailer->IsHTML(true);
     	$mailer->SMTPAuth = true;
     	$mailer->SMTPSecure = "tls";
     	$mailer->Host = "smtp.gmail.com";
     	$mailer->Port = 587;
     	$mailer->Username = "alantea85@gmail.com";
     	$mailer->Password = "10908131";
     	$mailer->From = $from;
     	$mailer->FromName = "Email Otomatis";
     	$mailer->AddAddress($tujuan);
     	$mailer->Subject = $subject;
     	$mailer->Body = $isi;
     	if($mailer->Send()) 
     	{
          	echo "1";
			//jika sukses
     	}
     	else 
     	{
			echo "0";
			//jika error
     	}
	}
	
	public static function Encrypt($text,$key){
		 $block = mcrypt_get_block_size('rijndael_128', 'ecb');
		 $pad = $block - (strlen($text) % $block);
		 $text .= str_repeat(chr($pad), $pad);
		 return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_ECB));
	}
	
	public static function generateUniqID(){
		return sprintf( '%04x%04x',
			// 32 bits for "time_low"
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}

    public static function randNum($chars) {
        $letters = '123456789123456789123456789123456789123456789123456789';
        return substr(str_shuffle($letters), 0, $chars);
    }

    public static function randStr($chars) {
        $letters = 'abcdefghijkmnopqrstuvwxyzabcdefghijkmnopqrstuvwxyzabcdefghijkmnopqrstuvwxyzabcdefghijkmnopqrstuvwxyz';
        return substr(str_shuffle($letters), 0, $chars);
    }

    public static function rstPass() {
        return Helpers::randStr(4) . Helpers::randNum(3);
    }

    public static function money($param) {
        return number_format($param, 0, ",", ".");
    }

    public static function forNum($param) {
        return number_format($param, 2, ",", ".");
    }

    public static function logdate() {
        return date("Y-m-d H:i:s");
    }

    public static function today() {
        return date("Y-m-d");
    }

    public static function mailtostr($str) {
        $str = str_replace('@', '', $str);
        $str = str_replace('.', '', $str);
        $str = str_replace(' ', '', $str);
        $str = str_replace('-', '', $str);
        return $str;
    }

    public static function listmonth() {
        $list = array(
            1 => "Januari",
            2 => "Februari",
            3 => "Maret",
            4 => "April",
            5 => "Mei",
            6 => "Juni",
            7 => "Juli",
            8 => "Agustus",
            9 => "September",
            10 => "Oktober",
            11 => "November",
            12 => "Desember",
        );
        return $list;
    }
	
	public static function listbulan($x) {
        if($x=='01'){
			$bulan = "Januari";
		}else if($x=='02'){
			$bulan = "Februari";
		}else if($x=='03'){
			$bulan = "Maret";
		}else if($x=='04'){
			$bulan = "April";
		}else if($x=='05'){
			$bulan = "Mei";
		}else if($x=='06'){
			$bulan = "Juni";
		}else if($x=='07'){
			$bulan = "Juli";
		}else if($x=='08'){
			$bulan = "Agustus";
		}else if($x=='09'){
			$bulan = "September";
		}else if($x=='10'){
			$bulan = "Oktober";
		}else if($x=='11'){
			$bulan = "November";
		}else if($x=='12'){
			$bulan = "Desember";
		}
        return $bulan;
    }
	
	public static function getbulan($x) {
        if($x=='01'){
			$bulan = "JAN";
		}else if($x=='02'){
			$bulan = "FEB";
		}else if($x=='03'){
			$bulan = "MAR";
		}else if($x=='04'){
			$bulan = "APR";
		}else if($x=='05'){
			$bulan = "MEI";
		}else if($x=='06'){
			$bulan = "JUN";
		}else if($x=='07'){
			$bulan = "JUL";
		}else if($x=='08'){
			$bulan = "AGU";
		}else if($x=='09'){
			$bulan = "SEP";
		}else if($x=='10'){
			$bulan = "OKT";
		}else if($x=='11'){
			$bulan = "NOV";
		}else if($x=='12'){
			$bulan = "DES";
		}
        return $bulan;
    }
	
	public static function cvrTanggal($date){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
		$tahun = substr($date, 0, 4);
		$x = substr($date, 4, 2);
		$tgl   = substr($date, 6, 2);
	 
		if($x=='01'){
			$bulan = "JAN";
		}else if($x=='02'){
			$bulan = "FEB";
		}else if($x=='03'){
			$bulan = "MAR";
		}else if($x=='04'){
			$bulan = "APR";
		}else if($x=='05'){
			$bulan = "MEI";
		}else if($x=='06'){
			$bulan = "JUN";
		}else if($x=='07'){
			$bulan = "JUL";
		}else if($x=='08'){
			$bulan = "AGU";
		}else if($x=='09'){
			$bulan = "SEP";
		}else if($x=='10'){
			$bulan = "OKT";
		}else if($x=='11'){
			$bulan = "NOV";
		}else if($x=='12'){
			$bulan = "DES";
		}
		$result = $tgl.''.$bulan.''.substr($date,2,2);	 	
		return $result;
	}
	
	public static function tanggal($date){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);
	 
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
		return $result;
	}
	
	public static function bulan($date){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
		$bulan = substr($date, 5, 2);
	 
		$result = $BulanIndo[(int)$bulan-1];		
		return $result;
	}
	
	public static function tahun($date){
		$tahun = substr($date, 0, 4);
	
		$result = $tahun;		
		return $result;
	}

    public static function makeID($kode){
        //return $kode.'0'.date('ymdHi').'0'.Helpers::randNum(2);
        return Helpers::randNum(10);
    }

    public static  function Roles(){
        $crit = new CDbCriteria(array('condition' => "role_id = '1' ",));
        $level = MstUser::model()->findAll($crit);
        $roles=array();
        foreach ($level as $key => $value) {
            $roles[] = $value->username;
        }
        return $roles;
    }

}
