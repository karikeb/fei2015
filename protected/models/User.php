<?php

class User extends BaseUser
{
        public function rules(){
            return CMap::mergeArray(parent::rules(),array(
                array('fnac', 'date', 'format'=>'yyyy-MM-dd'),
            ));
        }

        public function getUsuarioCompleto(){
            $usuarioc = !empty($this->email)?"(".$this->email.")".$this->username:'';
            return $usuarioc;
        }
        
        public function getCantidadPost(){
            return count($this->posts);
        }
        
        public function validatePassword($password){
            return CPasswordHelper::verifyPassword($password,$this->password);
        }
        
        public function hashPassword($password){
            return CPasswordHelper::hashPassword($password);
        }
        
        public function afterFind(){
            if(!empty($this->fnac)){
                $this->fnac = Yii::app()->format-date(strtotime($this->fnac));
            }
            return parent::afterFind();
        }
        
        public function beforeValidate(){
            if(!empty($this->fnac) && CDateTimeParser::parse($this->fnac, Yii::app()->locale->dateFormat)){
                $this->fnac = date('Y-m-d', CDateTimeParser::parse($this->fnac, Yii::app()->locale->dateFormat));
            }
            return parent::beforeValidate();
        }

        

        public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('edad',$this->edad);
                if(!empty($this->fnac)){
                    $criteria->compare('fnac', date('Y-m-d', CDateTimeParser::parse($this->fnac, Yii::app()->locale->dateFormat)));
                }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
