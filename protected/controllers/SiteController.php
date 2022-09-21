<?php

class SiteController extends Controller
{
	public function init()
    {
        Yii::app()->theme = 'classic';
        parent::init();
    } 
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
	
	public function actionArtikel()
	{
		$this->render('artikel/index');
	}
	
	public function actionGetData(){
		$tanggal     = date('Y-m-d');
		
		$sql = "SELECT
				tbl_artikel.id,
				tbl_artikel.kode_artikel,
				tbl_artikel.tipe_id,
				tbl_artikel.judul,
				tbl_artikel.`status`,
				tbl_artikel.flag_freemember,
				tbl_artikel.nama_file,
				tbl_artikel.deskripsi,
				tbl_artikel.tanggal,
				tbl_artikel.author,
				tbl_artikel.sumber,
				tbl_artikel.profil_id,
				tbl_artikel.logdate,
				tbl_mst_kategori.id,
				tbl_mst_kategori.tipe,
				tbl_mst_kategori.flag_active,
				tbl_mst_kategori.logdate
				FROM
				tbl_artikel
				Inner Join tbl_mst_kategori ON tbl_artikel.tipe_id = tbl_mst_kategori.id";
		
		$getdata = Yii::app()->db->createCommand($sql)->queryAll();
		$i =1;
		$data['data'] = array();
		foreach($getdata as $val){
			if($val['status'] == 'true'){
				$gold_produk = 'Aktif';
				$color = 'text-white';
				$bgcolor = 'bg-info';
				
				$flag = '-';
				
			}else{
				$gold_produk = 'Tidak Aktif';
				$color = 'text-dark';
				$bgcolor = 'bg-light';
			}
			
			if($val['flag_freemember'] == 0){
				$flag = 'Free';
			}else{
				$flag = 'Member';
			}			
			
			$action = '
						<div class="text-nowrap text-center">
							<a href="#" class="btn btn-icon btn-xs btn-light"><i class="demo-pli-pen-5 fs-5"></i></a>
							<a href="#" class="btn btn-icon btn-xs btn-light"><i class="demo-pli-trash fs-5"></i></a>
						</div>
			';
			
			$value['kode_artikel']    = $val['kode_artikel'];
			$value['judul'] 	      = ucfirst($val['judul']);
			$value['tipe_id']         = $val['tipe'];
			$value['status']          = '<div class="badge d-block  '.$color.' '.$bgcolor.' ">'.$gold_produk.'</div>';
			$value['flag_freemember'] = '<center>'.$flag.'</center>';
			$value['action']     	  = $action;
			
			array_push($data['data'], $value);
			$i++;
		}
		echo json_encode($data);
	}
	
	public function actionUpload() {
		$user_id    = Yii::app()->session->get('apps_userid_usr');
		date_default_timezone_set('Asia/Jakarta');
		$getDate = date("Y-m-d H:i:s");
		
		$file = 'lampiran_file';		
        if (isset($_FILES[$file])) {
			date_default_timezone_set("Asia/Jakarta");
			ini_set('memory_limit', '-1');
			ini_set('max_execution_time', 0);
			
			$filename = $_FILES[$file]['tmp_name'];
			require_once('class/PHPExcel.php');
			$objPHPExcel = new PHPExcel();			
			ob_end_clean();
			ob_start();			
			$inputFileType = PHPExcel_IOFactory::identify($filename);
			$objectReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objectReader->setReadDataOnly(true);
			$objPHPExcel = $objectReader->load($filename);

			$objPHPExcel->setActiveSheetIndex(0);

			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, TRUE, TRUE, TRUE);
			
			$date     = date("Y-m-d");
			$year     = date("Y");
			//$interval = $_POST['interval'];
			
			/*cek tanggal awal*/
			//$getTanggalAwal = date('Y-m-d', strtotime("-".$interval." day", strtotime(date("Y-m-d"))));	
			//echo $getTanggalAwal; die();
			
			$tahunold = date('Y', strtotime('-1 year', strtotime($year )));
			
			$filename = $_FILES[$file]['name'];
			$CountArray = count($sheetData);
			
			/* cek validasi data */
			//print_r($sheetData); die(); 
			$data['data'] = array();
			
			for($i=2;$i<=$CountArray;$i++){
				$judul       = $sheetData[$i]['A'];
				$deskripsi   = $sheetData[$i]['B'];
				$tanggal     = date('Y-m-d',($sheetData[$i]['C'] - 25569) * 86400);
				
				$kode = 'TEKN-'.strtoupper(Helpers::generateUniqID());
				
				$artikel = new Artikel;
				$artikel->kode_artikel    = $kode; 
				$artikel->tipe_id         = 8; 
				$artikel->judul           = $judul; 
				$artikel->status          = 'true';
				$artikel->flag_freemember = 0;
				$artikel->deskripsi       = $deskripsi;
				$artikel->profil_id       = $user_id;
				$artikel->tanggal         = $tanggal;
				$artikel->save(FALSE);
			}
			
			$logactivity = new LogActivity;
			$logactivity->user_id    = $user_id;
			$logactivity->interfaces = "website";
			$logactivity->keterangan = "Upload Artikel By Excel";
			$logactivity->log_date   = $getDate;
			$logactivity->save(false);
			
			echo '1'; //upload sukses
		}else{
			echo '0'; //file tidak ditemukan
		}

    }
	
	public function actionDownload(){
		$sql = 'SELECT
				tbl_artikel.id,
				tbl_artikel.kode_artikel,
				tbl_artikel.tipe_id,
				tbl_artikel.judul,
				tbl_artikel.`status`,
				tbl_artikel.flag_freemember,
				tbl_artikel.nama_file,
				tbl_artikel.deskripsi,
				tbl_artikel.tanggal,
				tbl_artikel.author,
				tbl_artikel.sumber,
				tbl_artikel.profil_id,
				tbl_artikel.logdate,
				tbl_mst_kategori.id,
				tbl_mst_kategori.tipe,
				tbl_mst_kategori.flag_active,
				tbl_mst_kategori.logdate
				FROM
				tbl_artikel
				Inner Join tbl_mst_kategori ON tbl_artikel.tipe_id = tbl_mst_kategori.id';
		$getData = 	Yii::app()->db->createCommand($sql)->queryAll();
		

		$this->render('artikel/report_artikel',array(
						'rekap'=>$getData
					));
	}
		
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	 
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				
				if(!empty($_POST['LoginForm']['remember'])){
					Yii::app()->request->cookies['member_login'] = new CHttpCookie('member_login', $_POST['LoginForm']['username']);
					Yii::app()->request->cookies['member_password'] = new CHttpCookie('member_password', $_POST['LoginForm']['password']);
				}else{					
					if(isset($_COOKIE['member_login'])) {						
						unset(Yii::app()->request->cookies['member_login']);
						unset(Yii::app()->request->cookies['member_password']);
					}
				}
				$_SESSION['login'] = '1'; die(json_encode($_SESSION));
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		if (Yii::app()->user->isGuest) {
            Yii::app()->theme = 'login';
			$this->render('login',array('model'=>$model));
        } else {
			$this->redirect(CController::createUrl('cpanel/index'));
		}
		
	}
	
	public function actionCpanel(){
		if (Yii::app()->user->isGuest) {
            $this->redirect(CController::createUrl('site/login'));
        } else {
			Yii::app()->theme = 'cpanel';
			$this->render('dashboard');
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}