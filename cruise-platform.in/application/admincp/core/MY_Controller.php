<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();


      if (!$this->session->userdata('cruise_admin')) {
            
            redirect('login', 'refresh');
        } else if ($this->session->userdata('cruise_admin')== '0') {
            //unset the user session
            $this->session->unset_userdata('cruise_admin');
            $this->session->set_flashdata('error', 'Error Occurred. Try Again.');
            redirect('login', 'refresh');
        }
        
        $user_id=$this->session->userdata('cruise_admin');
        
        $this->data['loged_in_user']=$this->common->select_data_by_id('admin','adm_id',$user_id,'adm_email,adm_name');
    }

    function last_query() {
        echo "<pre>";
        echo $this->db->last_query();
        echo "</pre>";
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
