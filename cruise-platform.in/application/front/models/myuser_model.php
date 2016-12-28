<?php

class Myuser_model extends CI_Model {
    
    function select_data(){
       $query = $this->db->get('myuser');
       return $query->result_array();
    }
    
}

?>

