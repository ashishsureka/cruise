<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('likes'))
{
    function likes($requirement_id=0){ //true for two different menu
        
        
        
        $CI = get_instance();
        $CI->load->model('common');             
        
        
            $contition_array = array('prrld_status' => 'enable','prr_id'=>$requirement_id, 'prrld_type' => 'like');
            $count = count($CI->common->select_data_by_condition('project_requirement_likes_dislikes', $contition_array, 'prrld_id'));
        
            return $count;
    }

}

if ( ! function_exists('dislikes'))
{
    function dislikes($requirement_id=0){ //true for two different menu
    
        $CI = get_instance();
        $CI->load->model('common');             
                
            $contition_array = array('prrld_status' => 'enable','prr_id'=>$requirement_id, 'prrld_type' => 'dislike');
            $count = count($CI->common->select_data_by_condition('project_requirement_likes_dislikes', $contition_array, 'prrld_id'));
        
            return $count;
        
    }

}