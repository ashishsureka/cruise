<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        //set header, footer and leftmenu
        $this->data['title'] = 'Dashboard : ' . $site_name;
        $this->data['header'] = $this->load->view('header', $this->data);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data);
        $this->data['footer'] = $this->load->view('footer', $this->data,true);


        $this->load->model('common');

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
//        echo "hi";
//        die();
    }

    //display dashboard
    public function index() {
        $this->data['section_title'] = 'Dashboard';
        
        $page_condition=array();
        $this->data['page_count']=  count($this->common->select_data_by_condition('pages', $page_condition,'page_id','','','','',array()));        
        
        $user_condition=array('user_status != '=> '3'  );
        $this->data['user_count']=  count($this->common->select_data_by_condition('users', $user_condition,'user_id','','','','',array()));        
        
        $project_condition=array('prj_status !='=>'delete');
        $this->data['project_count']=  count($this->common->select_data_by_condition('projects', $project_condition,'prj_id','','','','',array()));                
        
        $module_condition=array('prm_status !='=>'delete');
        $this->data['module_count']=  count($this->common->select_data_by_condition('project_modules', $module_condition,'prj_id','','','','',array()));                
        
        $inquiry_condition=array('inq_status !='=>'delete');
        $this->data['inquiry_count']=  count($this->common->select_data_by_condition('inquiry', $inquiry_condition,'inq_id','','','','',array()));                
		
		$help_condition=array('help_status !='=>'delete');
        $this->data['help_count']=  count($this->common->select_data_by_condition('help', $help_condition,'help_id','','','','',array()));                
        
        $this->load->view('dashboard/index', $this->data);
    }

    //logout user
    public function logout() {
        if ($this->session->userdata('cruise_admin')) {
            $this->session->unset_userdata('cruise_admin');
            redirect('login', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }

    public function edit_profile() {
        
        if($this->data['loged_in_user'][0]['level']!='1'){
            $this->session->set_flashdata('error','You are not authorized.');
            redirect('dashboard','refresh');
        }
        
        if($this->input->post('email')){
            $email=$this->input->post('email');
            $user_name=$this->input->post('user_name');
            $name=$this->input->post('name');
            $user_id=$this->session->userdata('cruise_admin');
            
            $update_result=  $this->common->update_data($this->input->post(),'user','user_id',$user_id);
            if($update_result){
                $this->session->set_flashdata('success','Profile detail successfully updated.');
                redirect('dashboard','refresh');
            }
            else{
                $this->session->set_flashdata('error','Error Occurred. Try Again!');
                redirect('dashboard','refresh');
            }
        }
        
        $this->data['module_name'] = 'Dashboard';
        $this->data['section_title'] = 'Edit Profile';
        $this->load->view('dashboard/edit_profile', $this->data);
    }

    public function change_password() {
 
        if($this->input->post('old_pass')){
            $user_id = ($this->session->userdata('cruise_admin'));
            $old_password=$this->input->post('old_pass');
            $new_password=  $this->input->post('new_pass');
            $check_result = $this->common->select_data_by_id('admin','adm_id',$user_id,'adm_password');
            if($check_result[0]['adm_password'] === md5($old_password)){
                $update_array=array('adm_password'=>  md5($new_password));
                $update_result=  $this->common->update_data($update_array,'admin','adm_id',$user_id);
                if($update_result){
                    $this->session->set_flashdata('success','Your password is successfully changed.');
                    redirect('dashboard','refresh');
                }
                else{
                    $this->session->set_flashdata('error','Error Occurred. Try Again!');
                    redirect('dashboard/change_password','refresh');
                }
            }
            else{
                $this->session->set_flashdata('error','Old password does not match');
                redirect('dashboard/change_password','refresh');
            }
        }
        
        $this->data['module_name'] = 'Dashboard';
        $this->data['section_title'] = 'Change Password';
        $this->load->view('dashboard/change_password', $this->data);
    }

    //check old password
    public function check_old_pass() {
        if ($this->input->is_ajax_request() && $this->input->post('old_pass')) {
            $user_id = ($this->session->userdata('cruise_admin'));

            $old_pass = $this->input->post('old_pass');
            $check_result = $this->common->select_data_by_id('user','user_id',$user_id,'password');
            if ($check_result[0]['password'] === md5($old_pass)) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        }
    }
    
    public function check_email() {
        if ($this->input->is_ajax_request() && $this->input->post('email')) {
            $user_id = ($this->session->userdata('cruise_admin'));

            $email = $this->input->post('email');
            $check_result = $this->common->check_unique_avalibility('user','email',$email,'user_id',$user_id);
            if ($check_result) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        }
    }
    
    public function check_username() {
        if ($this->input->is_ajax_request() && $this->input->post('user_name')) {
            $user_id = ($this->session->userdata('cruise_admin'));

            $user_name = $this->input->post('user_name');
            $check_result = $this->common->check_unique_avalibility('user','user_name',$user_name,'user_id',$user_id);
            if ($check_result) {
                echo 'true';
                die();
            } else {
                echo 'false';
                die();
            }
        }
    }

}

?>