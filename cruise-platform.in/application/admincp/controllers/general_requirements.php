<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General_requirements extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();

        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
                
        $project_id = base64_decode($this->uri->segment(3));
        $this->data['project_name']='';

        $project_detail = $this->common->select_data_by_id('projects', 'prj_id', $project_id, 'prj_title');
        if($project_detail){
            $this->data['project_name'] = $project_detail[0]['prj_title'];
        }
        
        //set header, footer and leftmenu
        $this->data['title'] = 'General Requirement : ' . $site_name;
        $this->data['header'] = $this->load->view('header', $this->data);
        $this->data['leftmenu'] = $this->load->view('leftmenu', $this->data);
        $this->data['footer'] = $this->load->view('footer', $this->data,true);


        $this->load->model('common');
        $this->load->helper('like_dislike');

        //Loadin Pagination Custome Config File
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');

        //remove catch so after logout cannot view last visited page if that page is this
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display requirement list
    public function index($project_url = '') {
        
        $this->data['project_id'] = $project_id = base64_decode($project_url);
        if(!$project_id){
            redirect(site_url('projects'), 'refresh');
        }
        if ($this->session->userdata('gr_search_keyword')) {
            $this->session->unset_userdata('gr_search_keyword');
        }

        $this->data['module_name'] = 'General Requirements';
        $this->data['section_title'] = 'General Requirements List';

        $this->data['limit']=$limit = $this->paging['per_page'];
        if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
            $offset = ($this->uri->segment(6) != '') ? $this->uri->segment(6) : 0;
            $short_by = $this->uri->segment(4);
            $order_by = $this->uri->segment(5);
        } else {
            $offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
            $short_by = 'prr_id';
            $order_by = 'desc';
        }

        $this->data['offset'] = $offset;
        $contition_array = array('prr_status != ' => 'delete','prr_type' => 'generic','prj_id' => $project_id);
        $this->data['project_list'] = $this->common->select_data_by_condition('project_requirements', $contition_array, '*', $short_by, $order_by, $limit, $offset);
        
        if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
            $this->paging['base_url'] = site_url("general_requirements/index/$project_url/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("general_requirements/index/$project_url/");
        }
        if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
            $this->paging['uri_segment'] = 6;
        } else {
            $this->paging['uri_segment'] = 4;
        }
        
        $this->data['total_rows']=$this->paging['total_rows'] = count($this->common->select_data_by_condition('project_requirements', $contition_array, 'prr_id'));

        
         
        
        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('general_requirements/index', $this->data);
    }

    //search the requirement
    public function search($project_url = '') {
        
        $this->data['project_id'] = $project_id = base64_decode($project_url);        
        if(!$project_id){
            redirect(site_url('projects'), 'refresh');
        }
        
        $this->data['module_name'] = 'General Requirements';
        $this->data['section_title'] = 'General Requirement Search List';        
        
        if ($this->input->post('search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->input->post('search_keyword');
            $this->session->set_userdata('gr_search_keyword', $search_keyword);
           
           
            $limit = $this->paging['per_page'];
            if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
                $offset = ($this->uri->segment(6) != '') ? $this->uri->segment(6) : 0;
                $short_by = $this->uri->segment(4);
                $order_by = $this->uri->segment(5);
            } else {
                $offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
                $short_by = 'prr_id';
                $order_by = 'desc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(prr_title LIKE '%$search_keyword%')";

            $contition_array = array('prr_status != ' => 'delete','prr_type' => 'generic');
            $this->data['project_list'] = $this->common->select_data_by_search('project_requirements', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
                $this->paging['base_url'] = site_url("general_requirements/search/$project_url/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("general_requirements/search/$project_url/");
            }


            if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
                $this->paging['uri_segment'] = 6;
            } else {
                $this->paging['uri_segment'] = 4;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('project_requirements', $search_condition, $contition_array, 'prr_id'));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else if ($this->session->userdata('gr_search_keyword')) {
            $this->data['search_keyword'] = $search_keyword = $this->session->userdata('gr_search_keyword');

            $limit = $this->paging['per_page'];
            if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
                $offset = ($this->uri->segment(6) != '') ? $this->uri->segment(6) : 0;
                $short_by = $this->uri->segment(4);
                $order_by = $this->uri->segment(5);
            } else {
                $offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
                $short_by = 'prr_id';
                $order_by = 'desc';
            }
            $this->data['offset'] = $offset;
            //prepare search condition
            $search_condition = "(prr_title LIKE '%$search_keyword%')";

            $contition_array = array('prr_status != ' => 'delete','prr_type' => 'generic');
            $this->data['project_list'] = $this->common->select_data_by_search('project_requirements', $search_condition, $contition_array, '*', $short_by, $order_by, $limit, $offset);

            if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
                $this->paging['base_url'] = site_url("general_requirements/search/$project_url/" . $short_by . "/" . $order_by);
            } else {
                $this->paging['base_url'] = site_url("general_requirements/search/$project_url/");
            }


            if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
                $this->paging['uri_segment'] = 6;
            } else {
                $this->paging['uri_segment'] = 4;
            }
            $this->paging['total_rows'] = count($this->common->select_data_by_search('project_requirements', $search_condition, $contition_array, 'prr_id'));
            
            //for record display
            $this->data['total_rows']=$this->paging['total_rows'];
            $this->data['limit']=$limit;
            
            
            $this->pagination->initialize($this->paging);
        } else {
            redirect(site_url('general_requirements/index/'.$project_url), 'refresh');
        }

        $this->load->view('general_requirements/index', $this->data);
    }
        
    public function edit($project_url = '',$requirement_url = '') {
       
        
        
        if ($this->input->post('project_id') && $this->input->post('requirement_id')) {                                   
            
                $update_array = array(
                    'prr_title'=>trim($this->input->post('requirement_title')),
                    'prr_description'=>trim($this->input->post('requirement_desc')),                                
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );
                
                $update_result = $this->common->update_data($update_array, 'project_requirements', 'prr_id', $this->input->post('requirement_id'));
            
            $project_url = base64_encode($this->input->post('project_id'));
            if ($update_result) {
                
                $this->session->set_flashdata('success', 'General Requirement successfully updated.');
                redirect(site_url('general_requirements/index/'.$project_url), 'refresh');
            } else {
                $this->session->set_flashdata('error', 'Errorin Occurred. Try Again!');
                redirect(site_url('general_requirements/index/'.$project_url), 'refresh');
            }
        }
        
        $this->data['project_id'] = $project_id = base64_decode($project_url);        
        if(!$project_id){
            redirect(site_url('projects'), 'refresh');
        }
        
        $this->data['requirement_id'] = $requirement_id = base64_decode($requirement_url);        
        if(!$requirement_id){
            redirect(site_url('general_requirements/index/'.$project_url), 'refresh');
        }
        
        $contition_array = array('prr_id'=>$requirement_id,'prj_id'=>$project_id);
        $this->data['requirement_detail'] = $this->common->select_data_by_condition('project_requirements', $contition_array, 'prr_id,prj_id,prr_title,prr_description');
        
            $this->data['module_name'] = 'General Requirements';
            $this->data['section_title'] = 'Edit General Requirement';            
            $this->load->view('general_requirements/edit', $this->data);
        
    }
        
    //change status
    public function change_status($requirement_url='',$status=''){
        $requirement_id = base64_decode($requirement_url);
        $status = base64_decode($status);
        if($requirement_id=='' || $status==''){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('projects','refresh');
        }
        if($status=='enable'){
            $status="disable";
        }else{
            $status='enable';
        }
        
        
        $update_data=array('prr_status'=>$status);
        
        $update_result=  $this->common->update_data($update_data,'project_requirements','prr_id',$requirement_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'projects';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'Requirement status successfully changed');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }
    
    //delete requirement
    public function delete($requirement_url=''){
        $requirement_id = base64_decode($requirement_url);
        
        if($requirement_id==''){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            redirect('projects','refresh');
        }
        
        $update_data=array('prr_status'=>'delete');
        
        $update_result=  $this->common->update_data($update_data,'project_requirements','prr_id',$requirement_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            $redirect_url = site_url() . 'projects';
        }
        if($update_result){
            $this->session->set_flashdata('success', 'Requirement status successfully changed');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }
    
    //change comment status
    public function change_comment_status($comment_url='',$status=''){
        $comment_id = base64_decode($comment_url);
        $status = base64_decode($status);
        if($comment_id=='' || $status==''){
            $this->session->set_flashdata('error','Error Occurred. Try Agaim!');
            if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
            } else {
                redirect('projects','refresh');
            }
        }
        if($status=='enable'){
            $status="disable";
        }else{
            $status='enable';
        }
        
        $update_data=array('prrc_status'=>$status);
        
        $update_result=  $this->common->update_data($update_data,'project_requirement_comments','prrc_id',$comment_id);
        if (isset($_SERVER['HTTP_REFERER'])) {
            $redirect_url = $_SERVER['HTTP_REFERER'];
        } else {
            redirect('projects','refresh');
        }
        if($update_result){
            $this->session->set_flashdata('success', 'Comment status successfully changed');
            redirect($redirect_url, 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Error Occurred. Try Again!');
            redirect($redirect_url, 'refresh');
        }
    }
        
    //clear search
    public function clear_search() {
        $this->session->unset_userdata('gr_search_keyword');
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }    
    
    //display comments list
    public function comments($project_url = '',$requirement_url = '') {

        
        $this->data['requirement_id'] = $requirement_id = base64_decode($requirement_url);
        $this->data['project_id'] = $project_id = base64_decode($project_url);        
        if(!$project_id){
            redirect(site_url('projects'), 'refresh');
        }
        if(!$requirement_id){
            redirect(site_url('general_requirements/index/'.$project_url), 'refresh');
        } else {            
            $this->data['gr_name']='';

            $gr_detail = $this->common->select_data_by_id('project_requirements', 'prr_id', $requirement_id, 'prr_title');
            if($gr_detail){
                $this->data['gr_name'] = $gr_detail[0]['prr_title'];
            }
        }
        
        $this->data['module_name'] = 'Comments';
        $this->data['section_title'] = 'Comments List';

        $this->data['limit']=$limit = $this->paging['per_page'];
        if ($this->uri->segment(5) != '' && $this->uri->segment(6) != '') {
            $offset = ($this->uri->segment(7) != '') ? $this->uri->segment(7) : 0;
            $short_by = $this->uri->segment(5);
            $order_by = $this->uri->segment(6);
        } else {
            $offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
            $short_by = 'prr_id';
            $order_by = 'desc';
        }

        $this->data['offset'] = $offset;
        $contition_array = array('prrc_status != ' => 'delete','user_status != ' => 'delete','prj_id' => $project_id,'prr_id' => $requirement_id);
        
        $join_str[0]['table'] = 'users';
        $join_str[0]['join_table_id'] = 'users.user_id';
        $join_str[0]['from_table_id'] = 'project_requirement_comments.user_id';
        $join_str[0]['join_type'] = '';
        
        $required_data = 'users.user_first_name,users.user_last_name,project_requirement_comments.*';
        $this->data['comment_list'] = $this->common->select_data_by_condition('project_requirement_comments', $contition_array, $required_data, $short_by, $order_by, $limit, $offset, $join_str);
        

        if ($this->uri->segment(5) != '' && $this->uri->segment(6) != '') {
            $this->paging['base_url'] = site_url("general_requirements/comments/$project_url/$requirement_url/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("general_requirements/comments/$project_url/$requirement_url/");
        }
        if ($this->uri->segment(5) != '' && $this->uri->segment(6) != '') {
            $this->paging['uri_segment'] = 7;
        } else {
            $this->paging['uri_segment'] = 5;
        }
        
        $this->data['total_rows']=$this->paging['total_rows'] = count($this->common->select_data_by_condition('project_requirement_comments', $contition_array, 'prr_id', $short_by, '', '', '', $join_str));

        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
        $this->load->view('general_requirements/comments', $this->data);
    }
    
    public function requirement_detail() {
            
        
        if ($this->input->is_ajax_request() && $this->input->post('requirement_id')) {
 
        $contition_array = array('prr_id' => $this->input->post('requirement_id'),'prr_status !=' => 'delete');
        
        $requirement_detail = $this->common->select_data_by_condition('project_requirements', $contition_array, '*');
        
        if($requirement_detail) { 
        
            $data="<table class='table'>";        
            $data.="<tr>";
            $data.="<td>Requirement Title</td>";        
            $data.="<td>".$requirement_detail[0]['prr_title']."</td>";            
            $data.="</tr>";
            $data.="<tr>";
            $data.="<td>Requirement Description</td>";        
            $data.="<td>".$requirement_detail[0]['prr_description']."</td>";            
            $data.="</tr>";                    
            
        }
        $data.="</table>";
        print_r($data);        
        die();
        
        }
        
        
    }        

}

?>