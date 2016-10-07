<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        
        //set header, footer and leftmenu
        $this->data['title'] = 'User : ' . $site_name;
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

        if ($this->session->userdata('user_search_keyword')) {
            $this->session->unset_userdata('user_search_keyword');
        }

        $this->data['module_name'] = 'User Management';
        $this->data['section_title'] = 'User List';

        $this->data['limit']=$limit = $this->paging['per_page'];
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'user_id';
            $order_by = 'desc';
        }

        $this->data['offset'] = $offset;
        $search_condition = "user_status = 'enable' OR user_status = 'disable'";
        $contition_array = array();
        $this->data['user_list'] = $this->common->select_data_by_search('users', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("user/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("user/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        
        $this->data['total_rows']=$this->paging['total_rows'] = count($this->common->select_data_by_search('users', $search_condition, $contition_array, 'user_id'));

        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('user/index', $this->data);
    }

    //search the user
    public function search() {
        $this->data['module_name'] = 'User Management';
        $this->data['section_title'] = 'User Search';

        
        
        if ($this->input->post('search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->input->post('search_keyword');
            $this->session->set_userdata('user_search_keyword', $search_keyword);
           
           
            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'user_id';
                $order_by = 'desc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(user_status = 'enable' OR user_status = 'disable') and (user_first_name LIKE '%$search_keyword%' OR user_last_name LIKE '%$search_keyword%' OR user_email LIKE '%$search_keyword%')";

            $contition_array = array();
            $this->data['user_list'] = $this->common->select_data_by_search('users', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("user/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("user/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('users', $search_condition, $contition_array, 'user_id'));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else if ($this->session->userdata('user_search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('user_search_keyword');

            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'user_id';
                $order_by = 'desc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(user_status = 'enable' OR user_status = 'disable') and (user_first_name LIKE '%$search_keyword%' OR user_last_name LIKE '%$search_keyword%' OR user_email LIKE '%$search_keyword%')";

            $contition_array = array();
            $this->data['user_list'] = $this->common->select_data_by_search('users', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("user/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("user/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('users', $search_condition, $contition_array, 'user_id'));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else {
            redirect(site_url('user'), 'refresh');
        }

        $this->load->view('user/index', $this->data);
    }
    
    public function add() {
       
        if ($this->input->post()) {
                       
            $rand_password = $this->random_password(8);
            
            $insert_array = array(
                'user_first_name'=>trim($this->input->post('firstname')),
                'user_last_name'=>trim($this->input->post('lastname')),
                'user_email'=>trim($this->input->post('email')),
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
                    $site_url = site_url('../');
                    $subject = $email_template[0]['et_subject'];
                    $mail_body = str_replace("%emailid%", $this->input->post('email'), str_replace("%password%", $rand_password, str_replace("%site_url%", $site_url, stripslashes($email_template[0]['et_description']))));
                }                
                
                $send_mail = $this->sendEmail($site_name, $this->input->post('email'), $subject, $mail_body);                
            }            
            
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('user') ;
            }

            if ($insert_result && $send_mail) {
                
                $this->session->set_flashdata('success', 'User successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }
        
            $this->data['module_name'] = 'User Management';
            $this->data['section_title'] = 'Add User';            
            $this->load->view('user/add', $this->data);
        
    }

    public function edit($id = '') {
       $id = base64_decode($id);
        if ($this->input->post('userid')) {
                       
           
            $update_array = array(
                'user_first_name'=>trim($this->input->post('firstname')),
                'user_last_name'=>trim($this->input->post('lastname')),
                'user_email'=>trim($this->input->post('email')),                                
                'editdatetime' => date('Y-m-d H:i:s'),
                'editip' => $_SERVER['REMOTE_ADDR'],           
            );
           
            
            $update_result = $this->common->update_data($update_array, 'users', 'user_id', $this->input->post('userid'));
           
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('user') ;
            }

            if ($update_result) {
                
                $this->session->set_flashdata('success', 'User successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }

        $user_detail = $this->common->select_data_by_id('users', 'user_id', $id, '*');
        if (!empty($user_detail)) {
            $this->data['module_name'] = 'User Management';
            $this->data['section_title'] = 'Edit User';
            
            $this->data['user_detail'] = $user_detail;
            $this->load->view('user/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('user', 'refresh');
        }
    }
    
    //change status
    public function change_status($user_id='',$status=''){
        $user_id = base64_decode($user_id);
        $status = base64_decode($status);
        if($user_id=='' || $status==''){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('users','refresh');
        }
        if($status=='enable'){
            $status="disable";
        }else{
            $status='enable';
        }
        
        
        $update_data=array('user_status'=>$status);
        
        $update_result=  $this->common->update_data($update_data,'users','user_id',$user_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'user';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'User status successfully changed');
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
            redirect('user','refresh');
        }
        
        $update_data=array('user_status'=>'delete');
        
        $update_result=  $this->common->update_data($update_data,'users','user_id',$user_id);
        
        //project delete
        
        $update_data1=array('prj_status'=>'delete');
        
        $this->common->update_data($update_data1,'projects','user_id',$user_id);
        
        //module delete
        
        $update_data2=array('prm_status'=>'delete');
        
        $this->common->update_data($update_data2,'project_modules','user_id',$user_id);
        
        //requirement delete
        
        $update_data3=array('prr_status'=>'delete');
        
        $this->common->update_data($update_data3,'project_requirements','user_id',$user_id);
        
        
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'user';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'User status successfully deleted');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    public function clear_search() {
        $this->session->unset_userdata('user_search_keyword');
        redirect('user', 'refresh');
    }
        
    
    //check old password
    public function check_email() {
        if ($this->input->is_ajax_request() && $this->input->post('email')) {


            $email = $this->input->post('email');
            if(!$this->input->post('userid')){
                $contition_array = array('user_status !=' => 'delete', 'user_email' => $email);
                $check_result = $this->common->select_data_by_condition('users', $contition_array);
            } else {
                $contition_array = array('user_status !=' => 'delete', 'user_email' => $email,'user_id !=' => $this->input->post('userid'));
                $check_result = $this->common->select_data_by_condition('users', $contition_array);
            }
            if ($check_result) {
                echo 'false';
                die();
            } else {
                echo 'true';
                die();
            }
        }
    }
    

}

?>