<?php

class Sitecontents extends CI_Model
{
    //get all settings details
    function getSettingDetails()
    {
        $this->db->select('site_content_id,site_content_name,site_content_description');
        return $this->db->get('site_content')->result_array();
    }
    
    //get admin setting by id
    function getSettingById($setting_id)
    {
        //$this->db->select('setting_id,setting_name,setting_value');
        $this->db->select('site_content_id,site_content_name,site_content_description');
        $this->db->where('site_content_id',$setting_id);
        return $this->db->get('site_content')->result_array();
    }
    
    //update setting value
    function update_setting($setting_id,$setting_val)
    {
        $this->db->where('site_content_id',$setting_id);
        if($this->db->update('site_content',$setting_val))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    
    
}