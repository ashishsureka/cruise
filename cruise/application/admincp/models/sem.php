<?php

class Sem extends CI_Model
{
    //get all Sem details
    function getSemDetails()
    {
        $this->db->select('semid,semfieldname,semfieldvalue');
        return $this->db->get('sem')->result_array();
    }
    
    //get admin setting by id
    function getSemById($semid)
    {
        $this->db->select('semid,semfieldname,semfieldvalue');
        $this->db->where('semid',$semid);
        return $this->db->get('sem')->result_array();
    }
    
    //update setting value
    function update_sem($semid,$semfieldvalue)
    {
        $this->db->where('semid',$semid);
        if($this->db->update('sem',$semfieldvalue))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    
    
}