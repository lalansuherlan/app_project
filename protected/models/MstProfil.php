<?php

/**
 * This is the model class for table "{{mst_profil}}".
 *
 * The followings are the available columns in table '{{mst_profil}}':
 * @property string $uid
 * @property string $idamil
 * @property string $nama
 * @property string $alamat
 * @property string $email
 * @property string $telepon
 * @property string $foto
 * @property string $user_id
 * @property integer $flag_active
 * @property string $logdate
 */
class MstProfil extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mst_profil}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('flag_active', 'numerical', 'integerOnly'=>true),
			array('idamil', 'length', 'max'=>15),
			array('nama, foto', 'length', 'max'=>100),
			array('email, telepon', 'length', 'max'=>50),
			array('user_id', 'length', 'max'=>20),
			array('alamat, logdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('uid, idamil, nama, alamat, email, telepon, foto, user_id, flag_active, logdate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'Uid',
			'idamil' => 'Idamil',
			'nama' => 'Nama',
			'alamat' => 'Alamat',
			'email' => 'Email',
			'telepon' => 'Telepon',
			'foto' => 'Foto',
			'user_id' => 'User',
			'flag_active' => 'Flag Active',
			'logdate' => 'Logdate',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('idamil',$this->idamil,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('telepon',$this->telepon,true);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('flag_active',$this->flag_active);
		$criteria->compare('logdate',$this->logdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MstProfil the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
