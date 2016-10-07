<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Dashboard extends MY_Controller {

    public $data;

    public function __construct() {
        
        parent::__construct();
        
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '2', '*');
        
        $this->data['metatag_title'] = $metatag_title = $page_data[0]['page_meta_title'];
        $this->data['metatag_keywords'] = $metatag_keywords = $page_data[0]['page_meta_keywords'];
        $this->data['metatag_description'] = $metatag_description = $page_data[0]['page_meta_descriptions'];        
        $this->data['page_title'] = $page_title = $page_data[0]['page_title'];
        
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        
        $this->data['title'] = $site_name.' | '.$page_title;

        require_once 'include.php';
        
        $this->load->helper('datalist');

        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display Login form
    public function index() {
        
        $join_str[0]['table'] = 'project_users';
        $join_str[0]['join_table_id'] = 'project_users.project_id';
        $join_str[0]['from_table_id'] = 'projects.prj_id';
        $join_str[0]['join_type'] = '';
        
        $condition_array=array('project_users.user_id' => $this->data['user_id'],'project_users.user_status' => 'owner','prj_status' => 'enable','is_archive' => 'no');
        $this->data['owner_projects_list'] = $this->common->select_data_by_condition('projects', $condition_array, '*','prj_id','','','',$join_str);
        
        $join_str[0]['table'] = 'project_users';
        $join_str[0]['join_table_id'] = 'project_users.project_id';
        $join_str[0]['from_table_id'] = 'projects.prj_id';
        $join_str[0]['join_type'] = '';
        
        $condition_array=array('project_users.user_id' => $this->data['user_id'],'project_users.user_status' => 'contributor','prj_status' => 'enable','is_archive' => 'no');
        $this->data['contributor_projects_list'] = $this->common->select_data_by_condition('projects', $condition_array, '*','prj_id','','','',$join_str);
        
        $join_str[0]['table'] = 'project_users';
        $join_str[0]['join_table_id'] = 'project_users.project_id';
        $join_str[0]['from_table_id'] = 'projects.prj_id';
        $join_str[0]['join_type'] = '';
        
        $condition_array=array('project_users.user_id' => $this->data['user_id'],'project_users.user_status' => 'other','prj_status' => 'enable','is_archive' => 'no');
        $this->data['other_projects_list'] = $this->common->select_data_by_condition('projects', $condition_array, '*','prj_id','','','',$join_str);
        
        $join_str[0]['table'] = 'project_users';
        $join_str[0]['join_table_id'] = 'project_users.project_id';
        $join_str[0]['from_table_id'] = 'projects.prj_id';
        $join_str[0]['join_type'] = '';
        
        $condition_array=array('project_users.user_id' => $this->data['user_id'],'prj_status' => 'enable','is_archive' => 'yes');
        $this->data['archived_projects_list'] = $this->common->select_data_by_condition('projects', $condition_array, '*','prj_id','','','',$join_str);
        
        $this->load->view('dashboard/index',$this->data);
    }
    
    
    public function add_project() {
        
        if($this->input->is_ajax_request() && $this->input->post()) {
            
            $project_title = $this->input->post('project_title');
            $project_description = $this->input->post('project_description');
            $project_url=$this->common->create_unique_url($project_title,'projects','prj_url');
            $insert_array = array(
                    'user_id'=>$this->data['user_id'],
                    'prj_title'=>$project_title,
                    'prj_description'=>$project_description,
                    'prj_url'=>$project_url,
                    'prj_createdby'=>  'user',
                    'prj_status'=> 'enable',                    
                    'insertdatetime' => date('Y-m-d H:i:s'),
                    'insertip' => $_SERVER['REMOTE_ADDR'],
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );

            $insert_result = $this->common->insert_data_getid($insert_array, 'projects');
            
            $insert_array2 = array(
                    'project_id'=>$insert_result,
                    'user_id'=>$this->data['user_id'],
                    'user_status'=>'owner',                    
                    'is_archive'=> 'no',                
                );

            $insert_result2 = $this->common->insert_data($insert_array2, 'project_users');
            
            if($insert_result && $insert_result2){
                echo $insert_result;
                die();
            } else {
                echo 'fail';
                die();
            }
            
        }
            
    }
    
    public function edit_project() {
        
        if($this->input->is_ajax_request() && $this->input->post()) {
            
            $project_title = $this->input->post('project_title');
            $project_description = $this->input->post('project_description');
            
            $update_array = array(                    
                    'prj_title'=>$project_title,
                    'prj_description'=>$project_description,                    
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );
            
            $update_result = $this->common->update_data($update_array, 'projects','prj_id',$this->input->post('project_id'));
                                    
            if($update_result){
                echo 'success';
                die();
            } else {
                echo 'fail';
                die();
            }
            
        }

    }
    
    public function edit_module() {
        
        if($this->input->is_ajax_request() && $this->input->post()) {
            
            $module_title = $this->input->post('module_title');
            $module_description = $this->input->post('module_description');
            
            $update_array = array(                    
                    'prm_title'=>$module_title,
                    'prm_description'=>$module_description,                    
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );
            
            $update_result = $this->common->update_data($update_array, 'project_modules','prm_id',$this->input->post('module_id'));
                        
            
            if($update_result){
                echo 'success';
                die();
            } else {
                echo 'fail';
                die();
            }
            
        }        
    
    }
    
    public function send_invitation() {
        
        if($this->input->is_ajax_request() && $this->input->post()) {
            
            $invitation_emails = $this->input->post('invitation_emails');            
            
        $emailErr = '';
        $emails = explode(',', $invitation_emails);
        
            foreach($emails as $email){
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "invalid";                     
                }
                $contition_array = array('prj_id'=>$this->input->post('project_id'), 'pri_email'=>$email);
                $exist = $this->common->select_data_by_condition('project_invites', $contition_array, 'prj_id');
                
                if($exist || $email == $this->data['loged_in_user'][0]['user_email']){    
                    echo 'One or more email id already invited.';
                    die();
                }
                if($emailErr){
                    echo 'Invalid email format inserted';
                    die();
                }
            }
        
        foreach($emails as $email){

            
            
            $insert_array = array(
                    'prj_id'=>$this->input->post('project_id'),
                    'pri_email'=>$email,
                    'pri_invited_by'=>$this->data['user_id'],                
                    'insertdatetime' => date('Y-m-d H:i:s'),
                    'insertip' => $_SERVER['REMOTE_ADDR'],
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


                $insert_result = $this->common->insert_data($insert_array, 'project_invites');
                
            $contition_array = array('user_email'=>$email, 'user_status != '=>'delete');
            $user_exist = $this->common->select_data_by_condition('users', $contition_array, 'user_id');
            if($user_exist){
                $user_id = $user_exist[0]['user_id'];
            } else {
                $insert_array2 = array(
                        
                        'user_email'=>trim($email),                        
                        'user_status'=> 'not-registered',                
                        'insertdatetime' => date('Y-m-d H:i:s'),
                        'insertip' => $_SERVER['REMOTE_ADDR'],
                        'editdatetime' => date('Y-m-d H:i:s'),
                        'editip' => $_SERVER['REMOTE_ADDR'],
                    );

                    $user_id = $this->common->insert_data_getid($insert_array2, 'users');
            }
            $insert_array3 = array(
                    'project_id'=>$this->input->post('project_id'),
                    'user_id'=>$user_id,                    
                    'user_status'=>'other',                                    
                );

                $insert_result3 = $this->common->insert_data($insert_array3, 'project_users');

                $site_setting = $this->common->select_data_by_condition('settings', array(), '*');

                $send_mail = '';
                if($site_setting){
                    $site_name = $site_setting[0]['setting_value']; 

                    $email_template = $this->common->select_data_by_id('email_templates', 'et_id', '2', '*');
                    $subject = $mail_body = "";

                    if($email_template){
                        $site_url = "";
                        $site_url = site_url();
                        $subject = $email_template[0]['et_subject'];
                        $mail_body = str_replace("%link%", $site_url, stripslashes($email_template[0]['et_description']));
                    }                

                    $send_mail = $this->sendEmail($site_name, $email, $subject, $mail_body);                
                }        
            
        }
            
            if($send_mail){
                echo 'success';
                die();
            } else {
                echo 'Error Occurred. Try Again!';
                die();
            }
            
        }
            
    }
    
    public function project_delete() {
        if($this->input->is_ajax_request() && $this->input->post('project_id')) {
            $data=array('prj_status' => 'delete');
            $condition=array('prj_id'=>$this->input->post('project_id'));
            $update_data = $this->common->update_login($data, 'projects', $condition);
            if($update_data){
                echo 'success';
                die();
            } else {
                echo 'fail';
                die();
            }
        }
    }

    public function project_archive() {
        if($this->input->is_ajax_request() && $this->input->post('project_id')) {
            $data=array('is_archive' => 'yes');
            $condition=array('project_id'=>$this->input->post('project_id'),'user_id'=>$this->data['user_id']);
            $update_data = $this->common->update_login($data, 'project_users', $condition);
            if($update_data){
                echo 'success';
                die();
            } else {
                echo 'fail';
                die();
            }
        }
    }
    
    public function project_unarchive($project_id = '') {
        $project_id = base64_decode($project_id);
        if($project_id) {
            $data=array('is_archive' => 'no');
            $condition=array('project_id'=>$project_id,'user_id'=>$this->data['user_id']);
            $update_data = $this->common->update_login($data, 'project_users', $condition);
            if($update_data){
                redirect(site_url('dashboard'), 'refresh');
            } else {
                redirect(site_url('dashboard'), 'refresh');
            }
        } else {
            redirect(site_url('dashboard'), 'refresh');
        }
    }
    
    public function project_contribute() {
        if($this->input->is_ajax_request() && $this->input->post('project_id')) {
            $data=array('user_status' => 'contributor');
            $condition=array('project_id'=>$this->input->post('project_id'),'user_id'=>$this->data['user_id']);
            $update_data = $this->common->update_login($data, 'project_users', $condition);
            if($update_data){
                echo 'success';
                die();
            } else {
                echo 'fail';
                die();
            }
        }
    }
    
    public function withdraw_user() {
        if($this->input->is_ajax_request() && $this->input->post('project_id')) {
            $condition=array('user_id'=>$this->data['user_id']);
            $delete_data = $this->common->delete_data('project_users','project_id',$this->input->post('project_id'), $condition);
            if($delete_data){
                echo 'success';
                die();
            } else {
                echo 'fail';
                die();
            }
        }
    }

}

?>