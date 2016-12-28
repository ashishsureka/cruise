<?php

class Email_formates extends CI_Model
{
    //get All formates
    function getAllFormates($limit='',$offset='')
    {
        $this->db->select('id,title,subject');
        //Setting Limit for Paging
        if( $limit != '' && $offset == 0)
        { $this->db->limit($limit); }
        else if( $limit != '' && $offset != 0)
        {$this->db->limit($limit, $offset);}
        
        return $this->db->get('email_formate')->result_array();
    }
    
    //get email formate by id
    function getFormateById($email_id)
    {
        $this->db->where('id',$email_id);
        $query=$this->db->get('email_formate');
        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return array();
        }
    }
    
    //update email formate
    function update_formate($formate_array,$formate_id)
    {
        $this->db->where('id',$formate_id);
        if($this->db->update('email_formate',$formate_array))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
}


