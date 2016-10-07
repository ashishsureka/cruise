<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contactus extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '2', '*');
        
        $this->data['metatag_title'] = $metatag_title = $page_data[0]['metatag_title'];
        $this->data['metatag_keywords'] = $metatag_keywords = $page_data[0]['metatag_keywords'];
        $this->data['metatag_description'] = $metatag_description = $page_data[0]['metatag_description'];
        $this->data['page_image'] = $image = $page_data[0]['image'];
        
        include_once 'include.php';
/*     if ($this->session->userdata('aangan_front')) {
            redirect('dashboard', 'refresh');
        }
*/
        //set header, footer and leftmenu
        $this->data['title'] = 'Contact Us | Aangan Express';
       
//    $this->load->model('logins');
            
        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display Login form
    public function index() {

//        
//        $contition_array = array('page_name' => 'contact');
//        $this->data['pages_list'] = $this->common->select_data_by_condition('pages', $contition_array, '*');
//        
//        echo "<pre>";
//        print_r($this->data['pages_list']);
//        die();
        
        $this->load->view('contactus/index',$this->data);
    }
    
    public function mail() {
        
        
        if ($this->input->is_ajax_request() && $this->input->post()) {
            

            
                $name = $this->input->post('name-c');
                $email = $this->input->post('email-c');
                $contact = $this->input->post('phone-c');
                $comment = $this->input->post('message-c');
                
        $setting = $this->common->select_data_by_condition('settings', array(), '*');
        
        $emailsetting = $this->common->select_data_by_condition('emailsetting', array(), '*');
        
        $condition_array=array('emailid' => '3');
        $emailformat = $this->common->select_data_by_condition('emails', $condition_array, '*');
            

            $mail_body = "<b style='font-size:24px;'>CONTACT INFORMATION</b> <br><br> <b style='font-size:20px;'>Name :</b> <span style='font-size:18px;'> $name </span> <br> <b style='font-size:20px;'>Email :</b> <span style='font-size:18px;'> $email </span>  <br> <b style='font-size:20px;'>Contact :</b> <span style='font-size:18px;'> $contact </span> <br> <b style='font-size:20px;'>Comment :</b> <span style='font-size:20px;'> $comment </span>";

            $mail_sent=$this->sendEmail($name,$email,$emailformat[0]['varsubject'],$mail_body);            

if($mail_sent)
{
            $insert_array = array(
                'name' => trim($this->input->post('name-c')),
                'email' => trim($this->input->post('email-c')),
                'number' => trim($this->input->post('phone-c')),
                'discription' => trim($this->input->post('message-c')),
                'timestamp' => date('Y-m-d H:i:s')
                
            );

            $insert_result = $this->common->insert_data($insert_array, 'inquiries');
            if($insert_result){
                echo 'true';
            } else {
                echo 'false';
            }
            die();
        
        }

    
        }
    }
}

