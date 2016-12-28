<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller{

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
        
        //$this->load->model('logins');                

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display Login form
    public function index() {
       
        if($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $condition_array=array('user_email' => $email,'user_password' => md5($password), 'user_status' => 'enable');
            $login_result = $this->common->select_data_by_condition('users', $condition_array, 'user_id');
            
            if($login_result){
                $this->session->set_userdata('cruise_user', $login_result[0]['user_id']);
                redirect(site_url('dashboard') ,'refresh');
            } else {
                $condition_array=array('user_email' => $email, 'user_status' => 'not-verify');
                $not_varified = $this->common->select_data_by_condition('users', $condition_array, 'user_id');
                if($not_varified){
                    $this->session->set_flashdata('error', 'not varified ! Please click on cruise activation link from your email');
                    redirect(site_url('login'), 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Invalid email / password');
                    redirect(site_url('login'), 'refresh');
                }
                
            }            
        }        
        
        $this->load->view('login/index',$this->data);
    }
    
    //display Login form
    public function register() {
       
        if($this->input->is_ajax_request() && $this->input->post()) {
            
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
                    echo 'Already registered check your email for activation !';
                    die();
                    $this->session->set_flashdata('error', 'Already registered check your email for activation !');
                    redirect(site_url('login'), 'refresh');
                } else {                    
                    $condition_array=array('user_email' => $email, 'user_status' => 'not-registered');
                    $not_register_exist = $this->common->select_data_by_condition('users', $condition_array, 'user_id');
                    if($not_register_exist){
                        $rand_key = $this->random_password(16);
                        $update_array = array(
                            'user_first_name'=>trim($this->input->post('reg_firstname')),
                            'user_last_name'=>trim($this->input->post('reg_lastname')),
                            'user_email'=>trim($this->input->post('reg_email')),
                            'user_password'=>  md5($this->input->post('reg_password')),
                            'user_key'=> $rand_key,
                            'user_status'=> 'not-verify',                                            
                            'editdatetime' => date('Y-m-d H:i:s'),
                            'editip' => $_SERVER['REMOTE_ADDR'],
                        );


                        $update_result = $this->common->update_data($update_array, 'users','user_id',$not_register_exist[0]['user_id']);

                        $site_setting = $this->common->select_data_by_condition('settings', array(), '*');

                        $send_mail = '';
                        if($site_setting){
                            $site_name = $site_setting[0]['setting_value']; 

                            $email_template = $this->common->select_data_by_id('email_templates', 'et_id', '3', '*');
                            $subject = $mail_body = "";

                            if($email_template){
                                $site_url = "";
                                $site_url = site_url("login/activation/".base64_encode($email)."/".base64_encode($rand_key));
                                $subject = $email_template[0]['et_subject'];
                                $mail_body = str_replace("%site_url%", $site_url, stripslashes($email_template[0]['et_description']));
                            }                

                            $send_mail = $this->sendEmail($site_name, $email, $subject, $mail_body);                
                        }      

                        if ($update_result && $send_mail) {
                            echo 'success';
                            die();
                            $this->session->set_flashdata('success', 'Please check your email for activation !');
                            redirect($redirect_url, 'refresh');
                        } else {
                            echo 'Error Occurred. Try Again!';
                            die();
                            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                            redirect($redirect_url, 'refresh');
                        }
                    } else {
                        echo 'Please contact CRUISE admin to receive an invite to start using CRUISE by clicking on Contact button below.';
                        die();
                    }
                }
            } else {
                echo 'This email id is already registered';
                die();
                $this->session->set_flashdata('error', 'This email id is already registered');
                redirect(site_url('login'), 'refresh');
            }
                        
        } else {
            redirect(site_url(), 'refresh');
        }
                
    }
        
    public function logout() {
         if ($this->session->userdata('cruise_user')) {
            $this->session->unset_userdata('cruise_user');
            redirect(site_url('login'), 'refresh');
        } else {
            redirect(site_url('login'), 'refresh');
        }
    }                
    
    
     public function forgot() {

        //check post and save data
        if ($this->input->post('forgot_email')) {
            
        $email=$this->input->post('forgot_email');         
            
        $user_detail = $this->common->select_data_by_id('users', 'user_email', $email, '*');
        if($user_detail){
        $site_setting = $this->common->select_data_by_condition('settings', array(), '*');                
                
        $emailformat = $this->common->select_data_by_id('email_templates', 'et_id', '4', '*');
                    
        
        $new_password = $this->random_password(8);                                          
                                
                
                $mail_body = $emailformat[0]['et_description'];
                
                $mail_body = html_entity_decode(str_replace("%password%", $new_password, stripslashes($mail_body)));                
                                
                
                $this->sendEmail($site_setting[0]['setting_value'],$user_detail[0]['user_email'],$emailformat[0]['et_subject'],$mail_body);  
                
                $encrypted_password=(md5($new_password));
                $data=array('user_password' => $encrypted_password);
                $condition=array('user_email'=>$email,'user_status'=>'enable');
                $update_data = $this->common->update_login($data, 'users', $condition);
                
                if($update_data){                                        
                    $this->session->set_flashdata('success', 'New password is sent to your email id');
                redirect(site_url('login'), 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Sorry, Error occured !');
                    redirect(site_url('login'), 'refresh');
                }
                
            } else {
                $this->session->set_flashdata('error', 'Invalid email id !');
                redirect(site_url('login'), 'refresh');
            }
        }

    }    
  
    public function activation($email = '', $key = '', $project_id = '') {        
        $email = base64_decode($email);
        $key = base64_decode($key);
        $project_id = base64_decode($project_id);
        $condition_array=array('user_email' => $email,'user_key' => $key, 'user_status' => 'not-verify');
        $varification_record = $this->common->select_data_by_condition('users', $condition_array, 'user_id');
        
         if($varification_record){
            $update_array = array(
                'user_key'=>'',
                'user_status' => 'enable'
                );
            $condition=array('user_email'=>$email,'user_status'=>'not-verify');

            $update_login = $this->common->update_login( $update_array, 'users', $condition);            
            
            if($update_login){                
                $this->session->set_userdata('cruise_user', $varification_record[0]['user_id']);
                redirect(site_url(), 'refresh');
            }else{
                $this->session->set_flashdata('error', 'Sorry, activation fail !');
                redirect(site_url('login'), 'refresh');
            }
            
         }else{
             redirect(site_url(), 'refresh');
         }
     }
     
    public function sendEmail($name='',$to_email='',$subject='',$mail_body='',$cc='',$bcc='')
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
            return $this->email->print_debugger();
        }
    }                
    
    public function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
    }
   
}

?>