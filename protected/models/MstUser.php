<?php

/**
 * This is the model class for table "{{mst_user}}".
 *
 * The followings are the available columns in table '{{mst_user}}':
 * @property string $id
 * @property string $username
 * @property string $encrypted
 * @property string $pin
 * @property string $status
 * @property integer $role_id
 * @property string $user_create
 * @property string $tgl_create
 * @property string $user_update
 * @property string $tgl_update
 * @property string $logdate
 */
class MstUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mst_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, username, encrypted, status, role_id', 'required'),
			array('role_id', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>20),
			array('username, user_create, user_update', 'length', 'max'=>50),
			array('encrypted', 'length', 'max'=>200),
			array('pin, status', 'length', 'max'=>10),
			array('tgl_create, tgl_update, logdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, encrypted, pin, status, role_id, user_create, tgl_create, user_update, tgl_update, logdate', 'safe', 'on'=>'search'),
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
			'profil' => array(self::HAS_ONE, 'MstProfil', 'uid'),
            'rle' => array(self::BELONGS_TO, 'MstRole', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'encrypted' => 'Encrypted',
			'pin' => 'Pin',
			'status' => 'Status',
			'role_id' => 'Role',
			'user_create' => 'User Create',
			'tgl_create' => 'Tgl Create',
			'user_update' => 'User Update',
			'tgl_update' => 'Tgl Update',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('encrypted',$this->encrypted,true);
		$criteria->compare('pin',$this->pin,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('user_create',$this->user_create,true);
		$criteria->compare('tgl_create',$this->tgl_create,true);
		$criteria->compare('user_update',$this->user_update,true);
		$criteria->compare('tgl_update',$this->tgl_update,true);
		$criteria->compare('logdate',$this->logdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
    {
        return CPasswordHelper::verifyPassword($password, $this->encrypted);
    }

    public function hashPassword($password)
    {
        return CPasswordHelper::hashPassword($password);
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord) {
            if (parent::beforeSave()) {
                if (!empty($this->encrypted))
                    $this->encrypted = $this->hashPassword($this->encrypted);

                return true;
            }
            return false;
        } else {
            return true;
        }

    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MstUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
