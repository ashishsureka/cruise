<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Register extends CI_Controller{

    public $data;

    public function __construct() {

        parent::__construct();
               
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '1', '*');
        
        $this->data['metatag_title'] = $metatag_title = $page_data[0]['page_meta_title'];
        $this->data['metatag_keywords'] = $metatag_keywords = $page_data[0]['page_meta_keywords'];
        $this->data['metatag_description'] = $metatag_description = $page_data[0]['page_meta_descriptions'];        
        $this->data['page_title'] = $page_title = $page_data[0]['page_title'];
        
        
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        
        $this->data['title'] = $site_name.' | '.$page_title;

        require_once 'include.php';                

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display Login form
    public function index() {
       
        if($this->input->post()) {
            
            $email = $this->input->post('reg_email');
            $firstname = $this->input->post('reg_firstname');
            $lastname = $this->input->post('reg_lastname');
            $password = $this->input->post('reg_password');
            
            $condition_array=array('user_email' => $email, 'user_status' => 'enable');
            $exist_result = $this->common->select_data_by_condition('users', $condition_array, 'user_id');
            
            if(!$exist_result){
                $condition_array=array('user_email' => $email, 'user_status' => 'not-verify');
                $not_varified = $this->common->select_data_by_condition('users', $condition_array, 'user_id');
                if($not_varified){
                    $this->session->set_flashdata('error', 'Already registered check your email for activation !');
                    redirect(site_url('login'), 'refresh');
                } else {
                    $condition_array=array('user_email' => $email, 'user_status' => 'not-registered');
                    $not_register_exist = $this->common->select_data_by_condition('users', $condition_array, 'user_id');
                    if($not_register_exist){
                        $rand_password = $this->random_password(8);
                        $rand_key = $this->random_password(16);
                        $insert_array = array(
                            'user_first_name'=>trim($this->input->post('reg_firstname')),
                            'user_last_name'=>trim($this->input->post('reg_lastname')),                            
                            'user_password'=>  md5($rand_password),
                            'user_key'=> $rand_key,
                            'user_status'=> 'not-verify',                                            
                            'editdatetime' => date('Y-m-d H:i:s'),
                            'editip' => $_SERVER['REMOTE_ADDR'],
                        );


                        $insert_result = $this->common->update_data($insert_array, 'users','user_id',$not_register_exist[0]['user_id']);

                        $site_setting = $this->common->select_data_by_condition('settings', array(), '*');

                        $send_mail = '';
                        if($site_setting){
                            $site_name = $site_setting[0]['setting_value']; 

                            $email_template = $this->common->select_data_by_id('email_templates', 'et_id', '1', '*');
                            $subject = $mail_body = "";

                            if($email_template){
                                $site_url = "";
                                $site_url = $site_setting[1]['setting_value'];
                                $subject = $email_template[0]['et_subject'];
                                $mail_body = str_replace("%emailid%", $this->input->post('email'), str_replace("%password%", $rand_password, str_replace("%site_url%", $site_url, stripslashes($email_template[0]['et_description']))));
                            }                

                            $send_mail = $this->sendEmail($site_name, $this->input->post('email'), $subject, $mail_body);                
                        }      
                        if ($insert_result && $send_mail) {

                            $this->session->set_flashdata('success', 'Please check your email for activation !');
                            redirect($redirect_url, 'refresh');
                        } else {
                            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                            redirect($redirect_url, 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Sorry, you are not allowed to register in cruise');
                        redirect(site_url('login'), 'refresh');
                    }
                }
            } else {                
                $this->session->set_flashdata('error', 'This email id is already registered');
                redirect(site_url('login'), 'refresh');                
            }
                        
        } else {
            redirect(site_url(), 'refresh');
        }
                
    }
    
    public function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
    }
   
}

?>