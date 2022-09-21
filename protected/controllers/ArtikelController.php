<?php

class ArtikelController extends Controller
{
	public function init()
    {
		/*
        if (isset($_SESSION['user'])) {

        } else {
            Yii::app()->user->isGuest;
        }

        if (Yii::app()->user->isGuest) {
            Yii::app()->theme = 'login';
        } else {
			Yii::app()->theme = 'cpanel';			
        }
		*/
		
		Yii::app()->theme = 'classic';
        parent::init();
    }
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		$helpers = new Helpers();
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('SaveArtikel','UploadFile','TampilFileSD','GetData'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('SaveArtikel','UploadFile','TampilFileSD','GetData'),
				'users' => $helpers->Roles(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
		
	public function actionSaveArtikel()
	{
		if (Yii::app()->user->isGuest) {
            $this->redirect(CController::createUrl('site/login'));
        } else {
			$model=new Artikel;
			
			if(isset($_POST['data']))
			{				
				date_default_timezone_set('Asia/Jakarta');
				$getDate = date("Y-m-d H:i:s");
				$user_id    = Yii::app()->session->get('apps_userid_usr');
				
				$data   = $_POST['data'];
				$arr_d	= json_decode($data);
				$kode_artikel = $_POST['kode_artikel'];
								
				$model->kode_artikel    = $_POST['kode_artikel'];
				$model->tipe_id         = $arr_d->{'kategori'};
				$model->judul           = $arr_d->{'nama_artikel'};
				$model->status          = $_POST['status_publish']; 
				$model->flag_freemember = $_POST['freemember'];
				$model->deskripsi       = $_POST['deskripsi'];
				$model->tanggal	        = $arr_d->{'tanggal'};
				$model->sumber 	        = $arr_d->{'sumber'};
				$model->profil_id 	    = $user_id;
				$model->logdate 	    = $getDate;
				
				if($model->save(false)){
					$dts = $_POST['dts'];
					$ttt = explode(',',$dts);
					$others_image_last='';
					$image_link=Yii::app()->basePath . '/../upload/artikel/'; //folder name
					for($i=0; $i<sizeof($_FILES['upload_files']['name']); $i++) {
						if (in_array($i+1, $ttt)){}else{	 
							$new_file = md5(microtime());
							$image_type = $_FILES["upload_files"]["type"][$i];
							$image_name = $_FILES["upload_files"]["name"][$i];
							$image_error = $_FILES["upload_files"]["error"][$i];
							$image_temp_name = $_FILES["upload_files"]["tmp_name"][$i];
							if (($image_type == "image/jpeg") || ($image_type == "image/png") || ($image_type == "image/pjpeg") || ($image_type == "image/jpg")) {
								$test = explode('.', $image_name);
								$name = $new_file.'.'.end($test);
								//$url = $image_link. $name;
								$url = $image_link. $kode_artikel.'_'.$image_name;
								$info = getimagesize($image_temp_name);
								if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($image_temp_name);
								elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($image_temp_name);
								elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($image_temp_name);
								imagejpeg($image,$url,80);
								
								$nama_foto = $kode_artikel.'_'.$image_name;
								$sql="update tbl_artikel set foto = '".$nama_foto."' where kode_artikel = '".$kode_artikel."' ";
								Yii::app()->db->createCommand($sql)->execute();
							} 
							
						}
					}					
				}
				
				echo 'finish';				
			}
		}
	}

	public function actionUploadFile()
	{		
		$kode_artikel = $_POST['kode_artikel'];		
		
		$file_names = $_FILES["file"]["name"];
		$no_urut = 1;
		if (isset($file_names)) {
			for ($i = 0; $i < count($file_names); $i++) {
				$file_name=$file_names[$i];
				$nama_file = $kode_artikel.'-'.$file_name;
				$original_file_name = pathinfo($file_name, PATHINFO_FILENAME);
				$uploaddir = Yii::app()->basePath . '/../upload/download/artikel/';
				$uploadfile = $uploaddir . $nama_file;
				$success = move_uploaded_file($_FILES["file"]["tmp_name"][$i], $uploadfile);
				
				$sql="update tbl_artikel set nama_file = '".$nama_file."' where kode_artikel = '".$kode_artikel."' ";
				Yii::app()->db->createCommand($sql)->execute();
			}			
			
			if ($success) { 
				echo 'Sukses';
				exit;
			}
		}
	}
	
	public function actionTampilFileSD(){ 
        
		$criteria = new CDbCriteria();
		$criteria->condition = 'kode_artikel = "'.$_POST['kode_artikel'].'" order by id desc';
		$ShowData = Artikel::model()->findAll($criteria);
        
		$i=1;
         $rc="";
		foreach($ShowData as $data){
			$id=$data->id;
			 $rc=$rc.
				'	
					<li>
						<div class="timeline-icon"><i class="fal fa-file-alt"></i></div><div class="timeline-time">File <strong>'.$i.'</strong></div><div class="timeline-content"><a href="'.Yii::app()->getBaseUrl(true).'/upload/produk/'.$data->file.'">'.$data->file.'</a><span onclick="hapuslampiran('.$id.')" class="btn btn-outline-danger btn-xs btn-icon rounded-circle waves-effect waves-themed ml-3"><i class="fal fa-times"></i></span></div>
					</li>
				';
			   $i++;
		} 
        $arr["rincian"]["data"]=$rc;
        $arr["rincian"]["jumlah"]=count($ShowData);
        echo json_encode($arr); 
        
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
}