<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function datalist_location($id=0)
    {
        $CI = get_instance();
        $CI->load->model('common');
    
        $contition_array= array('is_deleted' => '0');
        
        $arr = $CI->common->select_data_by_condition('location', $contition_array, 'location_title,location_id');
        
        $str='';
        foreach ($arr as $location) { 
            //$str='';
            $str.= "<option value='" .$location['location_id']."'";
            if($id==$location['location_id']){
              $str.="selected='selected'";
             }
            
            $str.=">" .$location['location_title'] ."</option>";
            
        }         
       echo $str;
    }   
    function datalist_job_exp($id=0)
    {
        $CI = get_instance();
        $CI->load->model('common');
    
        $contition_array= array();
        
        $arr = $CI->common->select_data_by_condition('job_experience', $contition_array, 'job_experience_id,experience_range');
        
        $str='';
        foreach ($arr as $exp) { 
            $str.= "<option value='" .$exp['job_experience_id']."'";
            if($id==$exp['job_experience_id']){
              $str.="selected='selected'";
             }
            
            $str.=">" .$exp['experience_range'] ."</option>";
            
            // echo "<option value=" .$exp['job_experience_id'] .">" .$exp['experience_range'] ."</option>";
        }   
        echo $str;
    }   
    
    function datalist_jobcategory($id=0)
    {
        $CI = get_instance();
        $CI->load->model('common');
    
        $contition_array= array('is_deleted' => '0');
        
        $arr = $CI->common->select_data_by_condition('jobcategory', $contition_array, 'category_title,category_id');
        
        $str='';
        foreach ($arr as $jobcategory) { 
            $str.= "<option value='" .$jobcategory['category_id']."'";
            if($id==$jobcategory['category_id']){
              $str.="selected='selected'";
             }
            
            $str.=">" .$jobcategory['category_title'] ."</option>";
            
            
           //  echo "<option value=" .$jobcategory['category_id'] .">" .$jobcategory['category_title'] ."</option>";
        }  
        echo $str;
    }   
    
    function datalist_company()
    {
        $CI = get_instance();
        $CI->load->model('common');
    
        $contition_array= array('is_deleted' => '0');
        $arr = $CI->common->select_data_by_condition('employer_detail', $contition_array, 'DISTINCT(company_name),employer_id', '', '', '', '', array());
//        $arr = $CI->common->select_data_by_condition('education', $contition_array, 'education_title,education_id');
        
        
        foreach ($arr as $location) { 
             echo "<option value=" .$location['employer_id'] .">" .$location['company_name'] ."</option>";
        }         
    }   
    
    function datalist_education()
    {
        $CI = get_instance();
        $CI->load->model('common');
    
        $contition_array= array('is_deleted' => '0');
        
        $arr = $CI->common->select_data_by_condition('education', $contition_array, 'education_title,education_id');
        
        
        foreach ($arr as $location) { 
             echo "<option value=" .$location['education_id'] .">" .$location['education_title'] ."</option>";
        }         
    }   
    
    function datalist_designation()
    {
        $CI = get_instance();
        $CI->load->model('common');
    
        $contition_array= array('is_deleted' => '0');
        
        $arr = $CI->common->select_data_by_condition('designation', $contition_array, 'designation_name,designation_id');
        
        
        foreach ($arr as $designation) { 
             echo "<option value=" .$designation['designation_id'] .">" .$designation['designation_name'] ."</option>";
        }         
    }   
    
    
    function datalist_currency()
    {
        $CI = get_instance();
        $CI->load->model('common');
    
        $contition_array= array('is_deleted' => '0');
        
        $arr = $CI->common->select_data_by_condition('currency', $contition_array, 'currency_symbol,currency_id');
        
        
        foreach ($arr as $currency) { 
             echo "<option value=" .$currency['currency_id'] .">" .$currency['currency_symbol'] ."</option>";
        }         
    }   
    
    
    
    function datalist_speciality()
    {
        $CI = get_instance();
        $CI->load->model('common');
    
        $contition_array= array('is_deleted' => '0');
        
        $arr = $CI->common->select_data_by_condition('speciality', $contition_array, 'speciality_name,speciality_id');
        
        
        foreach ($arr as $speciality) { 
             echo "<option value=" .$speciality['speciality_id'] .">" .$speciality['speciality_name'] ."</option>";
        }         
    }   
    function datalist_university()
    {
        $CI = get_instance();
        $CI->load->model('common');
    
        $contition_array= array('is_deleted' => '0');
        
        $arr = $CI->common->select_data_by_condition('university', $contition_array, 'university_name,university_id');
        
        
        foreach ($arr as $university) { 
             echo "<option value=" .$university['university_id'] .">" .$university['university_name'] ."</option>";
        }         
    }   
    
    function datalist_title($title='Mr')
    {
//         <option selected="selected" value="Mr">Mr</option>
                                 
        $arr=array('Mr','Miss','Mrs','Ms','Dr','Prof','Chief','Messrs');
        
       
        
        
        foreach ($arr as $exp) { 
             $str="<option value='" .$exp ."'";
             if($title==$exp){
              $str.="selected='selected'";
             }
             $str.= ">" .$exp ."</option>";
             echo $str;
        }         
    }   
}

if ( ! function_exists('datalist_applicationstatus')){
    function datalist_applicationstatus($title='pending')
    {
        $arr=array('pending','sortlisted','invited','coming','rejected');
        foreach ($arr as $exp) { 
             $str="<option value='" .$exp ."'";
             if($title==$exp){
              $str.="selected='selected'";
             }
             $str.= ">" .$exp ."</option>";
             echo $str;
        }         

    }
}
if ( ! function_exists('total_experience'))
{
    function total_experience($id=0){
        
        $CI = get_instance();
        $CI->load->model('common');
    
        $contition_array= array('is_deleted' => '0','candidate_id'=>$id);
        
        $arrays = $CI->common->select_data_by_condition('candidate_work', $contition_array, 'join_date,leave_date');
        $days=0;
        
        if($arrays){
        foreach($arrays as $array){
            $date1 = $array['join_date'];
            $date2 = $array['leave_date'];

            $diff = abs(strtotime($date1) - strtotime($date2));
            $days=$days+$diff/(24*3600);
            
            
//            $t_day=$t_day+$array['leave_date']-$array['join_date'];
            
        }
       
//        $days=590;
        
        return number_format($days/365,1);//$days;
        }else{
            return 'Fresher';
        }
    }

}
if ( ! function_exists('datalist_postedjob'))
{
    function datalist_postedjob($id=0){
        
        
        $CI = get_instance();
        $CI->load->model('common');
        $id=$CI->session->userdata('employer_id');
        
    
        $today=date('Y-m-d');
        
        $contition_array= array('is_deleted' => '0','company_id' => $id,'job_open_till >=' => $today);
        
        $arrays = $CI->common->select_data_by_condition('job', $contition_array, 'job_id,job_title');
         
        //return $arrays;
        
        foreach ($arrays as $job) { 
             echo "<option value=" .$job['job_id'] .">" .$job['job_title'] ."</option>";
        }       
        
    }

}
if ( ! function_exists('datalist_parent_cat'))
{
    function datalist_parent_cat($id=0){
        
        
        $CI = get_instance();
        $CI->load->model('common');
      
        $contition_array = array('is_deleted != ' => '1','parent_id'=>0);
        $arrays = $CI->common->select_data_by_condition('category', $contition_array, '*', 'category_title', 'asc');
        
        
        //return $arrays;
        
        if($id>0){
            $contition_array = array('categoryid'=>$id);
        
            $pid=$CI->common->select_data_by_condition('category', $contition_array, 'parent_id');
            
//            echo "<pre>";
//            print_r($pid);
//            die();
            if($pid[0]['parent_id']>0){
                $id=$pid[0]['parent_id'];
            }
        }
        $str='';
        foreach ($arrays as $cat) { 
            //$str='';
            $str.= "<option value='" .$cat['categoryid']."'";
            if($id==$cat['categoryid']){
              $str.="selected='selected'";
             }
            
            $str.=">" .$cat['category_title'] ."</option>";
            
        }         
       echo $str;
    }

}


if ( ! function_exists('datalist_sub_cat'))
{
    function datalist_sub_cat($id=0,$subid=0){
        
        $CI = get_instance();
        $CI->load->model('common');
      
        $contition_array = array('is_deleted != ' => '1','parent_id'=>$id);
        $arrays = $CI->common->select_data_by_condition('category', $contition_array, '*', 'category_title', 'asc');
        
        //return $arrays;
        
        if($id>0){
            $contition_array = array('categoryid'=>$id);
        
            $pid=$CI->common->select_data_by_condition('category', $contition_array, 'parent_id');
            
//            echo "<pre>";
//            print_r($pid);
//            die();
            if($pid[0]['parent_id']>0){
                $id=$pid[0]['parent_id'];
            }
        }
        $str='';
        foreach ($arrays as $cat) { 
            //$str='';
            $str.= "<option value='" .$cat['categoryid']."'";
            if($subid==$cat['categoryid']){
              $str.="selected='selected'";
             }
            
            $str.=">" .$cat['category_title'] ."</option>";
            
        }         
       echo $str;
    }

}