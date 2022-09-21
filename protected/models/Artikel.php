<?php

/**
 * This is the model class for table "{{artikel}}".
 *
 * The followings are the available columns in table '{{artikel}}':
 * @property integer $id
 * @property string $kode_artikel
 * @property integer $tipe_id
 * @property string $judul
 * @property string $status
 * @property string $flag_freemember
 * @property string $deskripsi
 * @property string $tanggal
 * @property string $sumber
 * @property string $foto
 * @property string $nama_file
 * @property string $author
 * @property string $profil_id
 * @property string $logdate
 */
class Artikel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{artikel}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipe_id', 'numerical', 'integerOnly'=>true),
			array('kode_artikel, status, flag_freemember, profil_id', 'length', 'max'=>10),
			array('judul, sumber, nama_file, author', 'length', 'max'=>255),
			array('foto', 'length', 'max'=>100),
			array('deskripsi, tanggal, logdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode_artikel, tipe_id, judul, status, flag_freemember, deskripsi, tanggal, sumber, foto, nama_file, author, profil_id, logdate', 'safe', 'on'=>'search'),
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
			'getkategori' => array(self::BELONGS_TO, 'MstKategori', 'tipe_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode_artikel' => 'Kode Artikel',
			'tipe_id' => 'Tipe',
			'judul' => 'Judul',
			'status' => 'Status',
			'flag_freemember' => 'Flag Freemember',
			'deskripsi' => 'Deskripsi',
			'tanggal' => 'Tanggal',
			'sumber' => 'Sumber',
			'foto' => 'Foto',
			'nama_file' => 'Nama File',
			'author' => 'Author',
			'profil_id' => 'Profil',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('kode_artikel',$this->kode_artikel,true);
		$criteria->compare('tipe_id',$this->tipe_id);
		$criteria->compare('judul',$this->judul,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('flag_freemember',$this->flag_freemember,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('sumber',$this->sumber,true);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('nama_file',$this->nama_file,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('profil_id',$this->profil_id,true);
		$criteria->compare('logdate',$this->logdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Artikel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
