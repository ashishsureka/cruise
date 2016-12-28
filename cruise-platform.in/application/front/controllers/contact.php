<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contact extends CI_Controller{

    public $data;

    public function __construct() {

        parent::__construct();
        
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '7', '*');
        
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

    //send inquiry
    public function index() {
       
        if($this->input->post()) {			
			
			$insert_array = array(
                    'inq_name'=>$this->input->post('contact_name'),
                    'inq_email'=>$this->input->post('contact_email'),
                    'inq_contact'=>$this->input->post('contact_phone'),
                    'inq_comment'=>$this->input->post('contact_message'),
                    'inq_status'=>  'pending',                    
                );

            $insert_result = $this->common->insert_data_getid($insert_array, 'inquiry');
			
            if($insert_result){
				
				$site_setting = $this->common->select_data_by_condition('settings', array(), '*');                
                
				$emailformat = $this->common->select_data_by_id('email_templates', 'et_id', '5', '*');
				
				$emailsetting = $this->common->select_data_by_condition('email_settings', array(), '*');
				
                $mail_body = $emailformat[0]['et_description'];
                
                $mail_body = html_entity_decode(str_replace("%name%", $this->input->post('contact_name'),str_replace("%email%", $this->input->post('contact_email'),str_replace("%phone%", $this->input->post('contact_phone'),str_replace("%message%", $this->input->post('contact_message'), stripslashes($mail_body))))));                
                
                $this->sendEmail($site_setting[0]['setting_value'],$emailsetting[4]['es_value'],$emailformat[0]['et_subject'],$mail_body);                  
				
                $this->session->set_flashdata('success', 'Inquiry Successfully Sent');
                redirect(site_url('contact') ,'refresh');
            } else {
                $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
                redirect(site_url('contact') ,'refresh');                
            }            
        }        
		$condition_array=array('page_id' => 7);
        $this->data['page_detail'] = $this->common->select_data_by_condition('pages', $condition_array, '*');
        
        $this->load->view('contact/index',$this->data);
    }
             
   public function check_email() {
        if ($this->input->is_ajax_request() && $this->input->post('email')) {

            $email = $this->input->post('email');
            //$client_id = $this->input->post('client_id');
            $condition_array=array('inq_status !=' => 'delete', 'inq_email' => $email);
			$check_result1 = $this->common->select_data_by_condition('inquiry', $condition_array, 'inq_id');
			
			if (!$check_result1) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
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
    
    
   
}

?>