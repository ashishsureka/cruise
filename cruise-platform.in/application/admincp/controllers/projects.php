<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Projects extends MY_Controller {

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

        if ($this->session->userdata('project_search_keyword')) {
            $this->session->unset_userdata('project_search_keyword');
        }

        $this->data['module_name'] = 'Project Management';
        $this->data['section_title'] = 'Projects List';

        $this->data['limit']=$limit = $this->paging['per_page'];
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'prj_id';
            $order_by = 'desc';
        }

        $this->data['offset'] = $offset;
        $contition_array = array('prj_status != ' => 'delete');
        $this->data['project_list'] = $this->common->select_data_by_condition('projects', $contition_array, '*', $short_by, $order_by, $limit, $offset);
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("projects/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("projects/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        
        $this->data['total_rows']=$this->paging['total_rows'] = count($this->common->select_data_by_condition('projects', $contition_array, 'prj_id'));

        
         
        
        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('projects/index', $this->data);
    }

    //search the user
    public function search() {
        $this->data['module_name'] = 'Project Management';
        $this->data['section_title'] = 'Projects Search List';

        
        
        if ($this->input->post('search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->input->post('search_keyword');
            $this->session->set_userdata('project_search_keyword', $search_keyword);
           
           
            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'prj_id';
                $order_by = 'desc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(prj_title LIKE '%$search_keyword%')";

            $contition_array = array('prj_status != ' => 'delete');
            $this->data['project_list'] = $this->common->select_data_by_search('projects', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("projects/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("projects/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('projects', $search_condition, $contition_array, 'prj_id'));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else if ($this->session->userdata('project_search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('project_search_keyword');

            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'prj_id';
                $order_by = 'desc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(prj_title LIKE '%$search_keyword%')";

            $contition_array = array('prj_status != ' => 'delete');
            $this->data['project_list'] = $this->common->select_data_by_search('projects', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("projects/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("projects/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('projects', $search_condition, $contition_array, 'prj_id'));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else {
            redirect(site_url('projects'), 'refresh');
        }

        $this->load->view('projects/index', $this->data);
    }
    
    public function add() {
       
        if ($this->input->post()) {                                   
            
            $project_url=$this->common->create_unique_url($this->input->post('project_title'),'projects','prj_url');
            $insert_array = array(
                'user_id'=>trim($this->input->post('project_user')),
                'prj_title'=>trim($this->input->post('project_title')),
                'prj_description'=>trim($this->input->post('project_description')),
                'prj_url'=>$project_url,
                'prj_createdby'=>'admin',
                'prj_status'=> 'enable',                
                'insertdatetime' => date('Y-m-d H:i:s'),
                'insertip' => $_SERVER['REMOTE_ADDR'],
                'editdatetime' => date('Y-m-d H:i:s'),
                'editip' => $_SERVER['REMOTE_ADDR'],
            );
           
            
            $insert_result = $this->common->insert_data_getid($insert_array, 'projects');
            
            if($insert_result){
            $insert_array = array(
                'project_id'=>$insert_result,
                'user_id'=>trim($this->input->post('project_user')),                
                'user_status'=> 'owner',                                
            );           
            
            $insert_result2 = $this->common->insert_data($insert_array, 'project_users');
            }
            
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('projects') ;
            }

            if ($insert_result) {
                
                $this->session->set_flashdata('success', 'Project successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }
        
        $contition_array = array('user_status' => 'enable');
        $this->data['users_list'] = $this->common->select_data_by_condition('users', $contition_array, 'user_id,user_first_name,user_last_name');
            $this->data['module_name'] = 'Project Management';
            $this->data['section_title'] = 'Add Project';            
            $this->load->view('projects/add', $this->data);
        
    }

    public function edit($id = '') {
       $id = base64_decode($id);
        if ($this->input->post('project_id')) {
            $project_detail = $this->common->select_data_by_id('projects', 'prj_id', $this->input->post('project_id'), 'prj_createdby,user_id');        
           
            
            if($project_detail[0]['prj_createdby']=='admin' && $project_detail[0]['user_id']!=$this->input->post('project_user')){
                $update_array = array(
                    'user_id'=>trim($this->input->post('project_user')),
                    'prj_title'=>trim($this->input->post('project_title')),
                    'prj_description'=>trim($this->input->post('project_description')),                                
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


                $update_result = $this->common->update_data($update_array, 'projects', 'prj_id', $this->input->post('project_id'));
                
                $contition_array = array('user_status'=>'owner');
                $this->common->delete_data('project_users','project_id',$this->input->post('project_id'),$contition_array);
                
                $insert_array = array(
                    'project_id'=>$this->input->post('project_id'),
                    'user_id'=>trim($this->input->post('project_user')),                
                    'user_status'=> 'owner',                                
                );           

                $insert_result2 = $this->common->insert_data($insert_array, 'project_users');
                
            } else {
                
                $update_array = array(
                    'prj_title'=>trim($this->input->post('project_title')),
                    'prj_description'=>trim($this->input->post('project_description')),                                
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );
                
                $update_result = $this->common->update_data($update_array, 'projects', 'prj_id', $this->input->post('project_id'));
            }
            //$this->common->delete_data('project_users','project_id',$this->input->post('project_id'));
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('projects') ;
            }

            if ($update_result) {
                
                $this->session->set_flashdata('success', 'Project successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }

        $project_detail = $this->common->select_data_by_id('projects', 'prj_id', $id, '*');
        $contition_array = array('user_status' => 'enable');
        $this->data['users_list'] = $this->common->select_data_by_condition('users', $contition_array, 'user_id,user_first_name,user_last_name');
        if (!empty($project_detail)) {
            $this->data['module_name'] = 'Project Management';
            $this->data['section_title'] = 'Edit';
            
            $this->data['project_detail'] = $project_detail;
            $this->load->view('projects/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('projects', 'refresh');
        }
    }
    
    //send invitation
    public function send_invite(){
    
        $insert_result = "";
        $send_mail = "";
        $emailErr = "";
        $contition_array = array('prj_id'=>$this->input->post('project_id'));
        $invite_by = $this->common->select_data_by_condition('projects', $contition_array, 'user_id');
        
        if($this->input->post('emails') && $invite_by){
        
        $emails = explode(',', $this->input->post('emails'));
        
            foreach($emails as $email){
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "1"; 
                    $this->session->set_flashdata('error', 'invalid email format given');
                    redirect(site_url('projects'), 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('error', 'email field is empty');
            redirect(site_url('projects'), 'refresh');
        }
        foreach($emails as $email){

            $contition_array = array('prj_id'=>$this->input->post('project_id'), 'pri_email'=>$email);
            $exist = $this->common->select_data_by_condition('project_invites', $contition_array, 'prj_id');
            if(!$exist && !$emailErr){    
            $insert_array = array(
                    'prj_id'=>$this->input->post('project_id'),
                    'pri_email'=>trim($email),
                    'pri_invited_by'=>$invite_by[0]['user_id'],                
                    'insertdatetime' => date('Y-m-d H:i:s'),
                    'insertip' => $_SERVER['REMOTE_ADDR'],
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


                $insert_result = $this->common->insert_data($insert_array, 'project_invites');

                $site_setting = $this->common->select_data_by_condition('settings', array(), '*');

                $send_mail = '';
                if($site_setting){
                    $site_name = $site_setting[0]['setting_value']; 

                    $email_template = $this->common->select_data_by_id('email_templates', 'et_id', '2', '*');
                    $subject = $mail_body = "";

                    if($email_template){
                        $site_url = "";
                        $site_url = $site_setting[1]['setting_value'];
                        $subject = $email_template[0]['et_subject'];
                        $mail_body = str_replace("%link%", $site_url, stripslashes($email_template[0]['et_description']));
                    }                

                    $send_mail = $this->sendEmail($site_name, $email, $subject, $mail_body);                
                }        
            }
        }
        
            
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('projects') ;
            }

            if ($insert_result && $send_mail) {
                
                $this->session->set_flashdata('success', 'Invitation successfully sent.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
    
    }
    
    //change status
    public function change_status($user_id='',$status=''){
        $user_id = base64_decode($user_id);
        $status = base64_decode($status);
        if($user_id=='' || $status==''){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('projects','refresh');
        }
        if($status=='enable'){
            $status="disable";
        }else{
            $status='enable';
        }
                
        $update_data=array('prj_status'=>$status);
        
        $update_result=  $this->common->update_data($update_data,'projects','prj_id',$user_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'projects';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'Project status successfully changed');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }
    
    public function delete($project_id=''){
        $project_id = base64_decode($project_id);
        
        if(!$project_id){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('project','refresh');
        }
        
        //project delete
        
        $update_data=array('prj_status'=>'delete');
        
        $update_result=  $this->common->update_data($update_data,'projects','prj_id',$project_id);
        
        //module delete
        
        $update_data2=array('prm_status'=>'delete');
        
        $this->common->update_data($update_data2,'project_modules','prj_id',$project_id);
        
        //requirement delete
        
        $update_data3=array('prr_status'=>'delete');
        
        $this->common->update_data($update_data3,'project_requirements','prj_id',$project_id);
        
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'project';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'Project status successfully deleted');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    public function clear_search() {
        $this->session->unset_userdata('project_search_keyword');
        redirect('projects', 'refresh');
    }
        
    
    //check old password
    public function check_email() {
        if ($this->input->is_ajax_request() && $this->input->post('email')) {


            $email = $this->input->post('email');
            if(!$this->input->post('projectid')){
                $contition_array = array('prj_status !=' => 'delete', 'project_email' => $email);
                $check_result = $this->common->select_data_by_condition('projects', $contition_array);
            } else {
                $contition_array = array('prj_status !=' => 'delete', 'project_email' => $email,'prj_id !=' => $this->input->post('projectid'));
                $check_result = $this->common->select_data_by_condition('projects', $contition_array);
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
    
    public function project_detail() {
            
        
        if ($this->input->is_ajax_request() && $this->input->post('project_id')) {
 
        $contition_array = array('prj_id' => $this->input->post('project_id'),'prj_status !=' => 'delete');
        
        $project_detail = $this->common->select_data_by_condition('projects', $contition_array, '*');
        
        if($project_detail) { 
        
            $data="<table class='table'>";        
            $data.="<tr>";
            $data.="<td>Project Title</td>";        
            $data.="<td>".$project_detail[0]['prj_title']."</td>";            
            $data.="</tr>";
            $data.="<tr>";
            $data.="<td>Project Description</td>";        
            $data.="<td>".$project_detail[0]['prj_description']."</td>";            
            $data.="</tr>";                    
            
        }
        $data.="</table>";
        print_r($data);        
        die();
        
        }
        
        
    }        
    
    public function project_users() {
            
        
        if ($this->input->is_ajax_request() && $this->input->post('project_id')) {
 
        $contition_array = array('prj_id' => $this->input->post('project_id'),'prj_status !=' => 'delete');
        $short_by = 'prm_id';        
        
        $join_str[0]['table'] = 'project_users';
        $join_str[0]['join_table_id'] = 'project_users.project_id';
        $join_str[0]['from_table_id'] = 'projects.prj_id';
        $join_str[0]['join_type'] = '';
        
        $join_str[1]['table'] = 'users';
        $join_str[1]['join_table_id'] = 'users.user_id';
        $join_str[1]['from_table_id'] = 'projects.user_id';
        $join_str[1]['join_type'] = '';
        
        $required_data = 'users.user_first_name,users.user_last_name,users.user_email,project_users.user_status';
        $project_users_list = $this->common->select_data_by_condition('projects', $contition_array, $required_data, $short_by, '', '', '', $join_str);
        
        if($project_users_list) { 
        $data="<table class='table'>";   
            $data.="<tr>";
            $data.="<th>Sr No.</th>";        
            $data.="<th>User Name</th>";
            $data.="<th>Email</th>";  
            $data.="<th>User Type</th>";            
            $data.="</tr>";

            $id=0;
            foreach($project_users_list as $project_user) {

                //$data="<table>";
                $data.="<tr>";
                $data.="<td>".++$id."</td>";            
                $data.="<td>".$project_user['user_first_name']." ".$project_user['user_last_name']."</td>";
                $data.="<td>".$project_user['user_email']."</td>";
                $data.="<td>".$project_user['user_status']."</td>";                
                $data.="</tr>";            
            }        
        } else {            
            $data="<tr>";
            $data.="<td colspan='5'>users not found</td>";            
            $data.="</tr>";
            
        }
        $data.="</table>";
        print_r($data);        
        die();
        
        }
        
        
    }       
    
    public function invited_users() {
            
        
        if ($this->input->is_ajax_request() && $this->input->post('project_id')) {
 
        $contition_array = array('projects.prj_id' => $this->input->post('project_id'),'prj_status !=' => 'delete');
        $short_by = 'prm_id';        
        
        $join_str[0]['table'] = 'project_invites';
        $join_str[0]['join_table_id'] = 'project_invites.prj_id';
        $join_str[0]['from_table_id'] = 'projects.prj_id';
        $join_str[0]['join_type'] = '';
        
        $join_str[1]['table'] = 'users';
        $join_str[1]['join_table_id'] = 'users.user_id';
        $join_str[1]['from_table_id'] = 'projects.user_id';
        $join_str[1]['join_type'] = 'left';
        
        $required_data = 'users.user_first_name,users.user_last_name,project_invites.pri_email';
        $project_users_list = $this->common->select_data_by_condition('projects', $contition_array, $required_data, $short_by, '', '', '', $join_str);
        
        if($project_users_list) { 
        $data="<table class='table'>";   
            $data.="<tr>";
            $data.="<th>Sr No.</th>";        
            $data.="<th>Email Id</th>";
            $data.="<th>Invited By</th>";              
            $data.="</tr>";

            $id=0;
            foreach($project_users_list as $project_user) {

                //$data="<table>";
                $data.="<tr>";
                $data.="<td>".++$id."</td>";            
                $data.="<td>".$project_user['pri_email']."</td>";
                $data.="<td>".$project_user['user_first_name']." ".$project_user['user_last_name']."</td>";                
                $data.="</tr>";            
            }        
        } else {            
            $data="<tr>";
            $data.="<td colspan='5'>users not found</td>";            
            $data.="</tr>";
            
        }
        $data.="</table>";
        print_r($data);        
        die();
        
        }
        
        
    }        

}

?>