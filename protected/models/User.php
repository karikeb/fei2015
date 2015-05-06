<?php

class User extends BaseUser
{
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
}
