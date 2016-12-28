<?php

class Logins extends CI_Model {
    
    function authenticate_user($customer_name,$password){
       
        //$this->db->select('id,customername,password_hash');
        $this->db->select('customerid,email,password,status');
        $this->db->where(array('email'=>$customer_name,'password'=>md5($password)));
        $result=  $this->db->get('customer')->result_array();
       
        if(!empty($result)){
            if($result[0]['email']===$customer_name && $result[0]['password']===md5($password)){
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
