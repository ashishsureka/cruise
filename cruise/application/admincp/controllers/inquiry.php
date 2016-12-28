<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inquiry extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        
        //set header, footer and leftmenu
        $this->data['title'] = 'Project Management : ' . $site_name;
        $this->data['header'] = $this->load->view('header', $this->data);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data);
        $this->data['footer'] = $this->load->view('footer', $this->data,true);


        $this->load->model('common');

        //Loadin Pagination Custome Config File
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display user list
    public function index() {

        if ($this->session->userdata('inquiry_search_keyword')) {
            $this->session->unset_userdata('inquiry_search_keyword');
        }

        $this->data['module_name'] = 'Inquiry Management';
        $this->data['section_title'] = 'Inquiry List';

        $this->data['limit']=$limit = $this->paging['per_page'];
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'inq_id';
            $order_by = 'desc';
        }

        $this->data['offset'] = $offset;
        $contition_array = array('inq_status != ' => 'delete');
        $this->data['inquiry_list'] = $this->common->select_data_by_condition('inquiry', $contition_array, '*', $short_by, $order_by, $limit, $offset);
        
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("inquiry/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("inquiry/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        
        $this->data['total_rows']=$this->paging['total_rows'] = count($this->common->select_data_by_condition('inquiry', $contition_array, 'inq_id'));
                         
        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('inquiry/index', $this->data);
    }

    //search the user
    public function search() {
        $this->data['module_name'] = 'Inquiry Management';
        $this->data['section_title'] = 'Inquiry Search List';

        
        
        if ($this->input->post('search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->input->post('search_keyword');
            $this->session->set_userdata('inquiry_search_keyword', $search_keyword);
           
           
            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'inq_id';
                $order_by = 'desc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(inq_name LIKE '%$search_keyword%' OR inq_contact LIKE '%$search_keyword%' OR inq_email LIKE '%$search_keyword%' )";

            $contition_array = array('inq_status != ' => 'delete');
            $this->data['inquiry_list'] = $this->common->select_data_by_search('inquiry', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("inquiry/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("inquiry/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('inquiry', $search_condition, $contition_array, 'inq_id'));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else if ($this->session->userdata('inquiry_search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('inquiry_search_keyword');

            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'inq_id';
                $order_by = 'desc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(inq_name LIKE '%$search_keyword%' OR inq_contact LIKE '%$search_keyword%' OR inq_email LIKE '%$search_keyword%' )";

            $contition_array = array('inq_status != ' => 'delete');
            $this->data['inquiry_list'] = $this->common->select_data_by_search('inquiry', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("inquiry/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("inquiry/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('inquiry', $search_condition, $contition_array, 'inq_id'));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else {
            redirect(site_url('inquiry'), 'refresh');
        }

        $this->load->view('inquiry/index', $this->data);
    }
       
    //change status
    public function change_status(){
        $unique_id = $this->input->post('unique_id');
        $status = $this->input->post('accepted_status');
        
        if(!$unique_id || !$status){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('inquiry','refresh');
        }
        
        $contition_array = array('inq_id' => $unique_id,'inq_status != ' => 'delete');
        $inquiry_detail = $this->common->select_data_by_condition('inquiry', $contition_array, '*');
        
        if($status == 'approved' && $inquiry_detail){
            
            $contition_array = array('user_email' => $inquiry_detail[0]['inq_email'],'user_status != ' => 'delete');
            $user_exist = $this->common->select_data_by_condition('users', $contition_array, '*');
            
            if($user_exist){
                $this->session->set_flashdata('error','This user is already exist!');
                redirect('inquiry','refresh');
            }
            
            $rand_password = $this->random_password(8);
            
            $insert_array = array(
                'user_first_name'=>$inquiry_detail[0]['inq_name'],                
                'user_email'=>$inquiry_detail[0]['inq_email'],
                'user_password'=>  md5($rand_password),
                'user_status'=> 'enable',                
                'insertdatetime' => date('Y-m-d H:i:s'),
                'insertip' => $_SERVER['REMOTE_ADDR'],
                'editdatetime' => date('Y-m-d H:i:s'),
                'editip' => $_SERVER['REMOTE_ADDR'],
            );
           
            
            $insert_result = $this->common->insert_data($insert_array, 'users');
            
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
                    $mail_body = str_replace("%emailid%", $inquiry_detail[0]['inq_email'], str_replace("%password%", $rand_password, str_replace("%site_url%", $site_url, stripslashes($email_template[0]['et_description']))));
                }                
                
                $send_mail = $this->sendEmail($site_name, $inquiry_detail[0]['inq_email'], $subject, $mail_body);                
            }            
        } elseif($unique_id && $status) {
			
		} else {
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('inquiry','refresh');
        }
        $update_data=array('inq_status'=>$status);
        
        $update_result=  $this->common->update_data($update_data,'inquiry','inq_id',$unique_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'inquiry';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'Inquiry status successfully changed');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }
    
    public function delete($user_id=''){
        $user_id = base64_decode($user_id);
        
        if(!$user_id){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('inquiry','refresh');
        }
        
        $update_data=array('inq_status'=>'delete');
        
        $update_result=  $this->common->update_data($update_data,'inquiry','inq_id',$user_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'inquiry';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'Inquiry status successfully deleted');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    public function clear_search() {
        $this->session->unset_userdata('inquiry_search_keyword');
        redirect('inquiry', 'refresh');
    }
                
    
    public function inquiry_detail() {
            
        
        if ($this->input->is_ajax_request() && $this->input->post('inquiry_id')) {
 
        $contition_array = array('inq_id' => $this->input->post('inquiry_id'),'inq_status !=' => 'delete');
        
        $inquiry_detail = $this->common->select_data_by_condition('inquiry', $contition_array, '*');
        
        if($inquiry_detail) { 
        
            $data="<table class='table'>";        
            $data.="<tr>";
            $data.="<td>Name</td>";        
            $data.="<td>".$inquiry_detail[0]['inq_name']."</td>";            
            $data.="</tr>";
            $data.="<tr>";
            $data.="<td>Contact No.</td>";        
            $data.="<td>".$inquiry_detail[0]['inq_contact']."</td>";            
            $data.="</tr>";
            $data.="<tr>";
            $data.="<td>Email Id</td>";        
            $data.="<td>".$inquiry_detail[0]['inq_email']."</td>";            
            $data.="</tr>";
            $data.="<tr>";
            $data.="<td>Comment</td>";        
            $data.="<td>".$inquiry_detail[0]['inq_comment']."</td>";            
            $data.="</tr>";                    
            
        }
        $data.="</table>";
        print_r($data);        
        die();
        
        }
        
        
    }        
        

}

?>