<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = MstUser::model()->find('username=?', array($this->username));
		
        if ($user === null) {
			$_SESSION['login'] = NULL;			
			die(json_encode($_SESSION));
            $this->errorCode = self::ERROR_USERNAME_INVALID;
			
        } else if (!$user->validatePassword($this->password)) {
			$_SESSION['login'] = $this->password;
			die(json_encode($_SESSION));
            $this->errorCode = self::ERROR_PASSWORD_INVALID;			
        } else {

			Yii::app()->session->add('proj_userid_usr', $user->id);
			Yii::app()->session->add('proj_username', $user->username);
			
			$role = MstRole::model()->findByPk($user->role_id);
			Yii::app()->session->add('proj_rolenama_usr', $role->role);
			Yii::app()->session->add('proj_roleposisi_usr', $role->posisi);
			
			$profil = MstProfil::model()->findByAttributes(array('uid' => $user->id));
			
            if (!empty($profil)) {
                Yii::app()->session->add('proj_profilid_usr', $profil->uid);
                Yii::app()->session->add('proj_nama_usr', $profil->nama);
                Yii::app()->session->add('proj_email_usr', $profil->email);
                Yii::app()->session->add('proj_alamat_usr', $profil->alamat);
                Yii::app()->session->add('proj_telepon_usr', $profil->telepon);
                Yii::app()->session->add('proj_idamil', $profil->idamil);
            }
			
			Yii::app()->db->createCommand("update tbl_mst_user set `status`=2 where id='".$user->id."' ")->execute();
			
			date_default_timezone_set('Asia/Jakarta');
			$getDate = date("Y-m-d H:i:s");
			$logactivity = new LogActivity;
			$logactivity->user_id = $user->id;
			$logactivity->interfaces = "Web";
			$logactivity->keterangan = "Login User";
			$logactivity->log_date = $getDate;
			$logactivity->save();
			
            $this->errorCode = self::ERROR_NONE;
        }
		return !$this->errorCode;
	}
}