<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modules extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        
        //set header, footer and leftmenu
        $this->data['title'] = 'Module : ' . $site_name;
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

        if ($this->session->userdata('module_search_keyword')) {
            $this->session->unset_userdata('module_search_keyword');
        }

        $this->data['module_name'] = 'Module Management';
        $this->data['section_title'] = 'Modules List';

        $this->data['limit']=$limit = $this->paging['per_page'];
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = $this->uri->segment(3);
            $order_by = $this->uri->segment(4);
        } else {
            $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
            $short_by = 'prm_id';
            $order_by = 'desc';
        }

        $this->data['offset'] = $offset;
        
        $join_str[0]['table'] = 'projects';
        $join_str[0]['join_table_id'] = 'projects.prj_id';
        $join_str[0]['from_table_id'] = 'project_modules.prj_id';
        $join_str[0]['join_type'] = '';
            
        $contition_array = array('prm_status != ' => 'delete', 'prj_status != ' => 'delete');
        $this->data['module_list'] = $this->common->select_data_by_condition('project_modules', $contition_array, '*', $short_by, $order_by, $limit, $offset, $join_str);
        
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['base_url'] = site_url("modules/index/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("modules/index/");
        }
        if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
            $this->paging['uri_segment'] = 5;
        } else {
            $this->paging['uri_segment'] = 3;
        }
        
        $this->data['total_rows']=$this->paging['total_rows'] = count($this->common->select_data_by_condition('project_modules', $contition_array, 'prm_id', $short_by, $order_by,'','',$join_str));

        
         
        
        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('modules/index', $this->data);
    }

    //search the user
    public function search() {
        $this->data['module_name'] = 'Module Management';
        $this->data['section_title'] = 'Modules Search List';

        
        
        if ($this->input->post('search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->input->post('search_keyword');
            $this->session->set_userdata('module_search_keyword', $search_keyword);
           
           
            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'prm_id';
                $order_by = 'desc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(prm_title LIKE '%$search_keyword%')";
            
            $join_str[0]['table'] = 'projects';
            $join_str[0]['join_table_id'] = 'projects.prj_id';
            $join_str[0]['from_table_id'] = 'project_modules.prj_id';
            $join_str[0]['join_type'] = '';

            $contition_array = array('prm_status != ' => 'delete', 'prj_status != ' => 'delete');
            $this->data['module_list'] = $this->common->select_data_by_search('project_modules', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset, $join_str);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("modules/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("modules/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('project_modules', $search_condition, $contition_array, 'prm_id', $short_by, $order_by,'','',$join_str));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else if ($this->session->userdata('module_search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('module_search_keyword');

            $limit = $this->paging['per_page'];
            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
                $short_by = $this->uri->segment(3);
                $order_by = $this->uri->segment(4);
            } else {
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
                $short_by = 'prm_id';
                $order_by = 'desc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(prm_title LIKE '%$search_keyword%')";

            $join_str[0]['table'] = 'projects';
            $join_str[0]['join_table_id'] = 'projects.prj_id';
            $join_str[0]['from_table_id'] = 'project_modules.prj_id';
            $join_str[0]['join_type'] = '';
            
            $contition_array = array('prm_status != ' => 'delete', 'prj_status != ' => 'delete');
            $this->data['module_list'] = $this->common->select_data_by_search('project_modules', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset, $join_str);

            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['base_url'] = site_url("modules/search/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("modules/search/");
            }


            if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
                $this->paging['uri_segment'] = 5;
            } else {
                $this->paging['uri_segment'] = 3;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('project_modules', $search_condition, $contition_array, 'prm_id', $short_by, $order_by,'','',$join_str));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else {
            redirect(site_url('modules'), 'refresh');
        }

        $this->load->view('modules/index', $this->data);
    }
    
    public function add() {
       
        if ($this->input->post()) {
                       
            $rand_password = $this->random_password(8);
            
            $insert_array = array(
                'prj_id' => trim($this->input->post('project_id')),
                'prm_title'=>trim($this->input->post('module_title')),
                'prm_description'=>trim($this->input->post('module_description')),                
                'prm_status'=> 'enable',                
                'insertdatetime' => date('Y-m-d H:i:s'),
                'insertip' => $_SERVER['REMOTE_ADDR'],
                'editdatetime' => date('Y-m-d H:i:s'),
                'editip' => $_SERVER['REMOTE_ADDR'],
            );
           
            
            $insert_result = $this->common->insert_data($insert_array, 'project_modules');
                        
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('modules') ;
            }

            if ($insert_result) {
                
                $this->session->set_flashdata('success', 'Module successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }
        
        $contition_array = array('prj_status'=>'enable');
        $this->data['projects_list'] = $this->common->select_data_by_condition('projects', $contition_array, '*');
        
            $this->data['module_name'] = 'Module';
            $this->data['section_title'] = 'Add Module';            
            $this->load->view('modules/add', $this->data);
        
    }

    public function edit($id = '') {
       $id = base64_decode($id);
        if ($this->input->post('projectid')) {
                       
           
            $update_array = array(
                'prm_title'=>trim($this->input->post('module_title')),
                'prm_description'=>trim($this->input->post('module_description')),                                
                'editdatetime' => date('Y-m-d H:i:s'),
                'editip' => $_SERVER['REMOTE_ADDR'],
            );
           
            
            $update_result = $this->common->update_data($update_array, 'project_modules', 'prm_id', $this->input->post('projectid'));
           
            if ($this->input->post('redirect_url')) {
                $redirect_url = $this->input->post('redirect_url');
            } else {
                $redirect_url = site_url('modules') ;
            }

            if ($update_result) {
                
                $this->session->set_flashdata('success', 'Module successfully updated.');
                redirect($redirect_url, 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect($redirect_url, 'refresh');
            }
        }

        $module_detail = $this->common->select_data_by_id('project_modules', 'prm_id', $id, '*');
        
        
        if (!empty($module_detail)) {
            $this->data['module_name'] = 'Module';
            $this->data['section_title'] = 'Edit Module';
            
            $this->data['module_detail'] = $module_detail;
            $this->load->view('modules/edit', $this->data);
        } else {
            $this->session->set_flashdata('error', 'Errorout Occurred. Try Again.');
            redirect('project', 'refresh');
        }
    }
    
    //change status
    public function change_status($user_id='',$status=''){
        $user_id = base64_decode($user_id);
        $status = base64_decode($status);
        if($user_id=='' || $status==''){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('modules','refresh');
        }
        if($status=='enable'){
            $status="disable";
        }else{
            $status='enable';
        }
        
        
        $update_data=array('prm_status'=>$status);
        
        $update_result=  $this->common->update_data($update_data,'project_modules','prm_id',$user_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'modules';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'Module status successfully changed');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }
    
    public function delete($module_id=''){
        $module_id = base64_decode($module_id);
        
        if(!$module_id){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('project','refresh');
        }
        
        //module delete
        
        $update_data=array('prm_status'=>'delete');
        
        $update_result=  $this->common->update_data($update_data,'project_modules','prm_id',$module_id);
        
        //requirement delete
        
        $update_data3=array('prr_status'=>'delete');
        
        $this->common->update_data($update_data3,'project_requirements','prm_id',$module_id);
        
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'project';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'Module status successfully deleted');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }

    public function clear_search() {
        $this->session->unset_userdata('module_search_keyword');
        redirect('modules', 'refresh');
    }
        
    
    //check old password
    public function check_email() {
        if ($this->input->is_ajax_request() && $this->input->post('email')) {


            $email = $this->input->post('email');
            if(!$this->input->post('projectid')){
                $contition_array = array('prm_status !=' => 'delete', 'project_email' => $email);
                $check_result = $this->common->select_data_by_condition('project_modules', $contition_array);
            } else {
                $contition_array = array('prm_status !=' => 'delete', 'project_email' => $email,'prm_id !=' => $this->input->post('projectid'));
                $check_result = $this->common->select_data_by_condition('project_modules', $contition_array);
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
    
    public function module_detail() {
            
        
        if ($this->input->is_ajax_request() && $this->input->post('prm_id')) {
 
        $contition_array = array('prm_id' => $this->input->post('prm_id'),'prm_status !=' => 'delete');
        
        $module_detail = $this->common->select_data_by_condition('project_modules', $contition_array, '*');
        
        if($module_detail) { 
        
            $data="<table class='table'>";        
            $data.="<tr>";
            $data.="<td>Module Title</td>";        
            $data.="<td>".$module_detail[0]['prm_title']."</td>";            
            $data.="</tr>";
            $data.="<tr>";
            $data.="<td>Module Description</td>";        
            $data.="<td>".$module_detail[0]['prm_description']."</td>";            
            $data.="</tr>";                    
            
        }
        $data.="</table>";
        print_r($data);        
        die();
        
        }
        
        
    }        

}

?>