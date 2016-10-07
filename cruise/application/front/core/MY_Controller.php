<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();


      if (!$this->session->userdata('cruise_user')) {
            
            redirect('login', 'refresh');
        } else if ($this->session->userdata('cruise_user')== '0') {
            //unset the user session
            $this->session->unset_userdata('cruise_user');
            $this->session->set_flashdata('error', 'Error Occurred. Try Again.');
            redirect('login', 'refresh');
        }
        
        $user_id=$this->session->userdata('cruise_user');
        $condition_array=array('user_status' => 'enable');
        $this->data['loged_in_user']=$this->common->select_data_by_id('users','user_id',$user_id,'user_email,user_first_name,user_last_name',$condition_array);
        
        if($this->uri->segment(1) == 'projects') {
            $condition_array=array('prj_status' => 'enable');
            $this->data['project_detail'] = $this->common->select_data_by_id('projects', 'prj_url', $this->uri->segment(2), '*', $condition_array);
            
            $condition_array=array('project_id' => $this->data['project_detail'][0]['prj_id'], 'user_id' => $user_id);
            $project_user = $this->common->select_data_by_condition('project_users', $condition_array);

            if(!$this->data['project_detail'] || !$project_user){
                redirect(site_url(), 'refresh');
            }
            $this->data['project_user_type'] = $project_user[0]['user_status'];
        }
    }

    public function make_contributor($project_id = '', $user_id = '') {
        $condition = array('project_id'=>$project_id,'user_id'=>$user_id,'user_status'=>'other');
        $is_other_user = $this->common->select_data_by_condition('project_users', $condition);
        if($project_id && $user_id && $is_other_user){
            $data=array('user_status' => 'contributor');
            $condition=array('project_id'=>$project_id,'user_id'=>$user_id);
            $update_data = $this->common->update_login($data, 'project_users', $condition);
        }
    }


    
    function sendEmail($name='',$to_email='',$subject='',$mail_body='',$cc='',$bcc='')
    {
        $setting = $this->common->select_data_by_condition('settings', array(), '*');
        
        $emailsetting = $this->common->select_data_by_condition('email_settings', array(), '*');

        //Loading E-mail Class
        $this->load->library('email');
                
                $config['protocol'] = "smtp";
                $config['smtp_host'] = $emailsetting[0]['es_value'];
                $config['smtp_port'] = $emailsetting[1]['es_value'];
                $config['smtp_user'] = $emailsetting[2]['es_value'];
                $config['smtp_pass'] = $emailsetting[3]['es_value'];
                $config['charset'] = "utf-8";
                $config['mailtype'] = "html";
                $config['newline'] = "\r\n";

                $this->email->initialize($config);                        
        
        $this->email->from($emailsetting[2]['es_value'],$setting[0]['setting_value']);
        
        $this->email->to($to_email);
        
        $this->email->cc($cc);
        
        $this->email->bcc($bcc);
        
        $this->email->subject($subject);
   
        $this->email->message(html_entity_decode($mail_body));                
        
        if($this->email->send()) {
            return true;
        } else {            
            return FALSE;
        }
    }                
    
    public function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
    }

}
