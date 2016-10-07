<?php

class Logins extends CI_Model {
    
    function authenticate_user($user_name,$password){
        //$this->db->select('id,username,password_hash');
        $this->db->select('adm_id,adm_name,adm_password,adm_status');
        $this->db->where(array('adm_name'=>$user_name,'adm_password'=>md5($password)));
        $result=  $this->db->get('admin')->result_array();
        if(!empty($result)){
            if($result[0]['adm_name']===$user_name && $result[0]['adm_password']===md5($password)){
                return $result;
            }
            else{
                return array();
            }
        }
        else{
            return array();
        }
    }
}
