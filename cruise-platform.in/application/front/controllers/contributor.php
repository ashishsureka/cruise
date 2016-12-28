<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contributor extends MY_Controller {

    public $data;

    public function __construct() {

        parent::__construct();
        
        $page_data = $this->common->select_data_by_id('pages', 'page_id', '3', '*');
        
        $this->data['metatag_title'] = $metatag_title = $page_data[0]['page_meta_title'];
        $this->data['metatag_keywords'] = $metatag_keywords = $page_data[0]['page_meta_keywords'];
        $this->data['metatag_description'] = $metatag_description = $page_data[0]['page_meta_descriptions'];        
        $this->data['page_title'] = $page_title = $page_data[0]['page_title'];                
                
        //site setting details
        $site_name_values = $this->common->select_data_by_id('settings', 'setting_id', '1', '*');
        $this->data['site_name'] = $site_name = $site_name_values[0]['setting_value'];
        
        $this->data['title'] = $site_name.' | '.$page_title;
        
        require_once 'include.php';
        $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');
        $this->load->helper('datalist');
        
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    //display Login form
    public function projects($project_url = '') {
        //echo $this->uri->segment(3);
//        echo '<pre>';
//        print_r($this->data['project_detail']); 
        if($this->data['project_detail'] && $project_url){
            
            $limit =$this->paging['per_page']=10;
        
        if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '' && $this->uri->segment(4) == 'general_requirements') {
            $offset = ($this->uri->segment(6) != '') ? $this->uri->segment(6) : 0;
            $short_by = $this->uri->segment(4);
            $order_by = $this->uri->segment(5);
        } else {
            $offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
            $short_by = 'project_requirements.prr_id';
            $order_by = 'asc';
        }

        $this->data['offset'] = $offset;
            
            $this->data['project_invitations'] = $this->common->select_data_by_id('project_invites', 'prj_id', $this->data['project_detail'][0]['prj_id'], '*');
            
            $condition_array=array('prj_id' => $this->data['project_detail'][0]['prj_id'], 'prm_status' => 'enable');
            $this->data['project_modules'] = $this->common->select_data_by_condition('project_modules', $condition_array);
            
            $join_str[0]['table'] = 'project_requirement_likes_dislikes';
            $join_str[0]['join_table_id'] = 'project_requirement_likes_dislikes.prr_id';
            $join_str[0]['from_table_id'] = 'project_requirements.prr_id';
            $join_str[0]['join_type'] = 'left';
            
            $condition_array=array('project_requirements.prj_id' => $this->data['project_detail'][0]['prj_id'],'prr_type' => 'generic', 'prr_status' => 'enable');
            $data = 'project_requirements.*,(select count(*) from cru_project_requirement_likes_dislikes ld where ld.prj_id = cru_project_requirements.prj_id and ld.prr_id = cru_project_requirements.prr_id and ld.user_id = '.$this->data['user_id'].' and ld.prrld_type = "like" and ld.prrld_status = "enable") as like_count,';
            $data .= '(select count(*) from cru_project_requirement_likes_dislikes ld where ld.prj_id = cru_project_requirements.prj_id and ld.prr_id = cru_project_requirements.prr_id and ld.user_id = '.$this->data['user_id'].' and ld.prrld_type = "dislike" and ld.prrld_status = "enable") as dislike_count';
            $this->data['project_requirements'] = $this->common->select_data_by_condition('project_requirements', $condition_array,$data, $short_by, $order_by, $limit, $offset);
            
        if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
            $this->paging['base_url'] = site_url("projects/".$this->data['project_detail'][0]['prj_url']."/general_requirements/" . $short_by . "/" . $order_by);
        } else {
            $this->paging['base_url'] = site_url("projects/".$this->data['project_detail'][0]['prj_url']."/general_requirements/");
        }
        if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
            $this->paging['uri_segment'] = 6;
        } else {
            $this->paging['uri_segment'] = 4;
        }
        $this->paging['total_rows'] = count($this->common->select_data_by_condition('project_requirements', $condition_array));
        
        $this->pagination->initialize($this->paging);
        $this->data['search_keyword'] = '';
            
        } else {
            redirect(site_url(), 'refresh');
        }
        
        $this->load->view('contributor/index',$this->data);
    }

    public function add_general_requirement() {

        $project_detail = $this->common->select_data_by_id('projects', 'prj_url', $this->input->post('project_url'), '*');
        if($this->input->is_ajax_request() && $this->input->post('project_url') && $project_detail){
        $insert_array = array(
                    'prj_id'=>$project_detail[0]['prj_id'],
                    'user_id'=>$this->data['user_id'],
                    'prr_title'=>$this->input->post('general_requirement_title'),
                    'prr_description'=>$this->input->post('general_requirement_title'),
                    'prr_type'=>  'generic',
                    'prr_status'=> 'enable',
                    'prr_priority'=>$this->input->post('general_requirement_priority'),
                    'insertdatetime' => date('Y-m-d H:i:s'),
                    'insertip' => $_SERVER['REMOTE_ADDR'],
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


        $insert_result = $this->common->insert_data_getid($insert_array, 'project_requirements');
        $this->make_contributor($project_detail[0]['prj_id'],$this->data['user_id']);
            if($insert_result){
                echo 'success';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url').'/general_requirements'), 'refresh');
            } else {
                echo 'Error Occurred. Try Again!';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url')).'/general_requirements', 'refresh');
            }
        } else {            
            redirect(site_url(), 'refresh');
        }
    }
    
    public function edit_general_requirement() {
                
        if($this->input->is_ajax_request() && $this->input->post('project_url')){
        $update_array = array(                    
                    'prr_title'=>$this->input->post('general_requirement_title'),
                    'prr_description'=>$this->input->post('general_requirement_desc'),                    
                    'prr_priority'=>$this->input->post('general_requirement_priority'),                    
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


        $update_result = $this->common->update_data($update_array, 'project_requirements','prr_id',$this->input->post('requirement_id'));
        
            if($update_result){
                echo 'success';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url').'/general_requirements'), 'refresh');
            } else {
                echo 'Error Occurred. Try Again!';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url')).'/general_requirements', 'refresh');
            }
        } else {            
            redirect(site_url(), 'refresh');
        }
    }
    
    
    public function add_module() {
        
        $project_detail = $this->common->select_data_by_id('projects', 'prj_url', $this->input->post('project_url'), '*');

        if($this->input->is_ajax_request() && $this->input->post('project_url') && $project_detail){
            
            $module_title = $this->input->post('module_title');            
            $module_url=$this->common->create_unique_url($module_title,'project_modules','prm_url');
        $insert_array = array(
                    'prj_id'=>$project_detail[0]['prj_id'],
                    'user_id'=>$this->data['user_id'],
                    'prm_title'=>$this->input->post('module_title'),
                    'prm_description'=>$this->input->post('module_description'),                    
                    'prm_url'=>$module_url,
                    'prm_status'=> 'enable',                    
                    'insertdatetime' => date('Y-m-d H:i:s'),
                    'insertip' => $_SERVER['REMOTE_ADDR'],
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


        $insert_result = $this->common->insert_data_getid($insert_array, 'project_modules');
        $this->make_contributor($project_detail[0]['prj_id'],$this->data['user_id']);
            if($insert_result){
                echo $insert_result;
                die();
                redirect(site_url('projects/'.$this->input->post('project_url').'/module_requirements'), 'refresh');
            } else {
                echo 'error';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url')), 'refresh');
            }
        } else {
            redirect(site_url(), 'refresh');
        }
    }
    
    
    public function edit_module() {
                
        if($this->input->is_ajax_request() && $this->input->post('module_id')){
        $update_array = array(                    
                    'prm_title'=>$this->input->post('module_title'),
                    'prm_description'=>$this->input->post('module_description'),                                        
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


        $update_result = $this->common->update_data($update_array, 'project_modules','prm_id',$this->input->post('module_id'));
        
            if($update_result){
                echo 'success';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url').'/module_requirements'), 'refresh');
            } else {
                echo 'error';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url')), 'refresh');
            }
        } else {
            redirect(site_url(), 'refresh');
        }
    }
    
    
    public function add_module_requirement() {
        
        $project_detail = $this->common->select_data_by_id('projects', 'prj_url', $this->input->post('project_url'), '*');
        if($this->input->is_ajax_request() && $this->input->post('project_url') && $project_detail){
        $insert_array = array(
                    'prj_id'=>$project_detail[0]['prj_id'],
                    'prm_id'=>$this->input->post('module_id'),
                    'user_id'=>$this->data['user_id'],
                    'prr_title'=>$this->input->post('module_requirement_title'),
                    'prr_description'=>$this->input->post('module_requirement_desc'),
                    'prr_type'=>  'module',
                    'prr_status'=> 'enable',
                    'prr_priority'=>$this->input->post('module_requirement_priority'),
                    'insertdatetime' => date('Y-m-d H:i:s'),
                    'insertip' => $_SERVER['REMOTE_ADDR'],
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


        $insert_result = $this->common->insert_data_getid($insert_array, 'project_requirements');
        $this->make_contributor($project_detail[0]['prj_id'],$this->data['user_id']);
            if($insert_result){
                echo 'success';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url').'/module_requirements'), 'refresh');
            } else {
                echo 'error';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url')).'/module_requirements', 'refresh');
            }
        } else {
            redirect(site_url(), 'refresh');
        }
    }
    
    public function edit_module_requirement() {
                
        if($this->input->is_ajax_request() && $this->input->post('project_url')){
        $update_array = array(                    
                    'prr_title'=>$this->input->post('module_requirement_title'),
                    'prr_description'=>$this->input->post('module_requirement_desc'),                    
                    'prr_priority'=>$this->input->post('module_requirement_priority'),                    
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );

        $update_result = $this->common->update_data($update_array, 'project_requirements','prr_id',$this->input->post('requirement_id'));
        
            if($update_result){
                echo 'success';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url').'/module_requirements'), 'refresh');
            } else {
                echo 'error';
                die();
                redirect(site_url('projects/'.$this->input->post('project_url')).'/module_requirements', 'refresh');
            }
        } else {
            redirect(site_url(), 'refresh');
        }
    }
    
    public function send_invitation() {
        
        $project_detail = $this->common->select_data_by_id('projects', 'prj_url', $this->input->post('project_url'));
        
        if($this->input->is_ajax_request() && $this->input->post('project_url') && $project_detail) {
            
            $invitation_emails = $this->input->post('invitation_emails');            
                        
        $emailErr = '';
        $emails = explode(',', $invitation_emails);
        
            foreach($emails as $email){
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "invalid";                     
                }
            $contition_array = array('prj_id'=>$project_detail[0]['prj_id'], 'pri_email'=>$email);
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
                    'prj_id'=>$project_detail[0]['prj_id'],
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
                    'project_id'=>$project_detail[0]['prj_id'],
                    'user_id'=>$user_id,                    
                    'user_status'=>'other',                                    
                );

                $insert_result3 = $this->common->insert_data($insert_array3, 'project_users');

                $site_setting = $this->common->select_data_by_condition('settings', array(), '*');

                $send_mail = '';
                if($site_setting){
                    $site_name = $site_setting[0]['setting_value']; 

		if($user_exist){
	                $user_id = $user_exist[0]['user_id'];
	            
                    $email_template = $this->common->select_data_by_id('email_templates', 'et_id', '6', '*');
                    $subject = $mail_body = "";

	                $site_url = "";
	                $site_url = site_url();
	                $subject = $email_template[0]['et_subject'];
	                $mail_body = str_replace("%project_name%", $project_detail[0]['prj_title'],str_replace("%link%", $site_url, stripslashes($email_template[0]['et_description'])));

                    } else {
                    
                    $email_template = $this->common->select_data_by_id('email_templates', 'et_id', '2', '*');
                    $subject = $mail_body = "";
	                    
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
    
    public function delete_invitation($invitation_id = '',$project_url = '') {
        $invitation_id = base64_decode($invitation_id);
        $invitation_detail = $this->common->select_data_by_id('project_invites', 'pri_id', $invitation_id);
        if($project_url && $invitation_detail){
        
            $delete_result = $this->common->delete_data('project_invites', 'pri_id', $invitation_id);
            if($delete_result){
                redirect(site_url('projects/'.$project_url), 'refresh');
            } else {
                redirect(site_url('projects/'.$project_url), 'refresh');
            }
        } else {
            redirect(site_url(), 'refresh');
        }
        
    }
    
    public function delete_module($module_url = '',$project_url = '') {        
        $module_detail = $this->common->select_data_by_id('project_modules', 'prm_url', $module_url);
        if($project_url && $module_detail){
        
            $delete_result = $this->common->delete_data('project_modules', 'prm_url', $module_url);
            if($delete_result){
                redirect(site_url('projects/'.$project_url), 'refresh');
            } else {
                redirect(site_url('projects/'.$project_url), 'refresh');
            }
        } else {
            redirect(site_url(), 'refresh');
        }
        
    }
    
    public function delete_requirement($requirement_id = '',$project_url = '') {
        $requirement_id = base64_decode($requirement_id);        
        $requirement_detail = $this->common->select_data_by_id('project_requirements', 'prr_id', $requirement_id);
        if($requirement_detail){
        
            $delete_result = $this->common->delete_data('project_requirements', 'prr_id', $requirement_id);
            if($delete_result){
                redirect(site_url('projects/'.$project_url.'/general_requirements'), 'refresh');
            } else {
                redirect(site_url('projects/'.$project_url), 'refresh');
            }
        } else {
            redirect(site_url(), 'refresh');
        }
        
    }
    
    public function delete_module_requirement($requirement_id = '',$project_url = '',$module_url = '') {
        $requirement_id = base64_decode($requirement_id);        
        $requirement_detail = $this->common->select_data_by_id('project_requirements', 'prr_id', $requirement_id);
        if($requirement_detail){
        
            $delete_result = $this->common->delete_data('project_requirements', 'prr_id', $requirement_id);
            if($delete_result){
                redirect(site_url('projects/'.$project_url.'/module_requirements/'.$module_url), 'refresh');
            } else {
                redirect(site_url('projects/'.$project_url), 'refresh');
            }
        } else {
            redirect(site_url(), 'refresh');
        }
        
    }
    
    public function add_comment() {
        
        if($this->input->is_ajax_request() && $this->input->post()){
            $str = '';
            $insert_array = array(
                    'user_id'=>$this->data['user_id'],
                    'prj_id'=>$this->input->post('project_id'),
                    'prr_id'=>$this->input->post('requirement_id'),
                    'prrc_comment'=>$this->input->post('comment_text'),                    
                    'prrc_status'=> 'enable',                    
                    'insertdatetime' => date('Y-m-d H:i:s'),
                    'insertip' => $_SERVER['REMOTE_ADDR'],
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


            $insert_result = $this->common->insert_data_getid($insert_array, 'project_requirement_comments');
            $this->make_contributor($this->input->post('project_id'),$this->data['user_id']);
            if($insert_result){                
                echo 'success';
                die();
            } else {
                echo 'error';
                die();
            }        
        } else {
            redirect(site_url(), 'refresh');
        }
    }
    
    public function like_dislike() {
        
        if($this->input->is_ajax_request() && $this->input->post()){
        
        $contition_array = array('user_id'=> $this->data['user_id']);
        $delete_result = $this->common->delete_data('project_requirement_likes_dislikes','prr_id',$this->input->post('requirement_id'),$contition_array);
            
            $str = '';
            $insert_array = array(
                    'user_id'=>$this->data['user_id'],
                    'prj_id'=>$this->input->post('project_id'),
                    'prr_id'=>$this->input->post('requirement_id'),
                    'prrld_type'=>$this->input->post('ld_value')==1?'like':'dislike',                    
                    'prrld_status'=> 'enable',                    
                    'insertdatetime' => date('Y-m-d H:i:s'),
                    'insertip' => $_SERVER['REMOTE_ADDR'],
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


            $insert_result = $this->common->insert_data_getid($insert_array, 'project_requirement_likes_dislikes');
            $this->make_contributor($this->input->post('project_id'),$this->data['user_id']);
            if($insert_result){                
                echo 'success';
                die();
            } else {
                echo 'error';
                die();
            }        
        } else {
            redirect(site_url(), 'refresh');
        }
    }
    
    public function clear_like_dislike() {
//        echo '<pre>';
//        print_r($this->input->post());
//        die();
        if($this->input->is_ajax_request() && $this->input->post()){
            
            $contition_array = array('user_id'=> $this->data['user_id']);
            $delete_result = $this->common->delete_data('project_requirement_likes_dislikes','prr_id',$this->input->post('requirement_id'),$contition_array);
            
            if($delete_result){                
                echo 'success';
                die();
            } else {
                echo 'error';
                die();
            }        
        } else {
            redirect(site_url(), 'refresh');
        }
    }
    
    public function add_comment_reply() {

        if($this->input->is_ajax_request() && $this->input->post()){
            $str = '';
            $insert_array = array(
                    'user_id'=>$this->data['user_id'],
                    'prj_id'=>$this->input->post('project_id'),
                    'prr_id'=>$this->input->post('requirement_id'),
                    'parent_id'=>$this->input->post('comment_id'),
                    'prrc_comment'=>$this->input->post('comment_text'),                    
                    'prrc_status'=> 'enable',                    
                    'insertdatetime' => date('Y-m-d H:i:s'),
                    'insertip' => $_SERVER['REMOTE_ADDR'],
                    'editdatetime' => date('Y-m-d H:i:s'),
                    'editip' => $_SERVER['REMOTE_ADDR'],
                );


            $insert_result = $this->common->insert_data_getid($insert_array, 'project_requirement_comments');
            $this->make_contributor($this->input->post('project_id'),$this->data['user_id']);
            if($insert_result){                
                echo 'success';
                die();
            } else {
                echo 'error';
                die();
            }        
        } else {
            redirect(site_url(), 'refresh');
        }
    }
    
    public function comment_like() {
        
        if($this->input->is_ajax_request() && $this->input->post()){
            if($this->input->post('like_type')=='1') {
                $insert_array = array(
                        'user_id'=>$this->data['user_id'],
                        'prj_id'=>$this->input->post('project_id'),
                        'cmt_id'=>$this->input->post('comment_id'),                                       
                        'cmtlk_status'=> 'enable',                    
                        'insertdatetime' => date('Y-m-d H:i:s'),
                        'insertip' => $_SERVER['REMOTE_ADDR'],
                        'editdatetime' => date('Y-m-d H:i:s'),
                        'editip' => $_SERVER['REMOTE_ADDR'],
                    );


                $insert_result = $this->common->insert_data_getid($insert_array, 'project_comment_likes');
                $this->make_contributor($this->input->post('project_id'),$this->data['user_id']);
                if($insert_result){                
                    echo 'success';
                    die();
                } else {
                    echo 'error';
                    die();
                }        
            } elseif ($this->input->post('like_type')=='2') {
                
                $delete_result = $this->common->delete_data('project_comment_likes','cmt_id',$this->input->post('comment_id'));
                if($delete_result){                
                    echo 'success';
                    die();
                } else {
                    echo 'error';
                    die();
                }        
            } else {
                echo 'error';
                die();
            }
        } else {
            redirect(site_url(), 'refresh');
        }
    }
    
    public function requirement_comments() {
                
        $join_str[0]['table'] = 'users';
        $join_str[0]['join_table_id'] = 'users.user_id';
        $join_str[0]['from_table_id'] = 'project_requirement_comments.user_id';
        $join_str[0]['join_type'] = '';
        
        
        $contition_array = array('prr_id'=> $this->input->post('requirement_id'),'prrc_status'=>'enable','parent_id'=>'0');
        $data = 'project_requirement_comments.*,users.user_first_name,users.user_last_name,users.user_profile_image,';
        $data .= '(select count(*) from cru_project_comment_likes cl where cl.prj_id = cru_project_requirement_comments.prj_id and cl.cmt_id = cru_project_requirement_comments.prrc_id and cl.user_id = '.$this->data['user_id'].' and cl.cmtlk_status = "enable") as is_like';        
        if($this->input->post('sort_by') == 2){
            $short_by = 'insertdatetime';
            $order_by = 'desc';            
            $comments_list = $this->common->select_data_by_condition('project_requirement_comments', $contition_array,$data, $short_by, $order_by, '', '', $join_str);
        } elseif($this->input->post('sort_by') == 1){
            $short_by = 'insertdatetime';
            $order_by = 'asc';            
            $comments_list = $this->common->select_data_by_condition('project_requirement_comments', $contition_array,$data, $short_by, $order_by, '', '', $join_str);
        }elseif ($this->input->post('sort_by') == 3) {
            $short_by = 'insertdatetime';
            $order_by = 'asc';
            $search_condition = 'project_requirement_comments.insertdatetime like ("%'.date('Y-m-d', strtotime('yesterday')).'%")';            
            $comments_list = $this->common->select_data_by_search('project_requirement_comments', $search_condition, $contition_array,$data, $short_by, $order_by, '', '', $join_str);
        }
        
                
        if($this->input->is_ajax_request() && $this->input->post('requirement_id')){
            $requirement_detail = $this->common->select_data_by_id('project_requirements', 'prr_id', $this->input->post('requirement_id'), 'prr_title');
            if($this->input->post('module_id')){
                $module_detail = $this->common->select_data_by_id('project_modules', 'prm_id', $this->input->post('module_id'), 'prm_title');
                $str = '<div class="tab_tead"><h4>Module Title : '.$module_detail[0]['prm_title'].'</h4></div>
                        <div class="tab_tead sec_con"><h4>Requirement Title : '.$requirement_detail[0]["prr_title"].'</h4></div>
                        <input type="hidden" name="comment_module_id" id="comment_module_id" value="'.$this->input->post('module_id').'" />';
            } else {
                $str = '<div class="tab_tead"><h4>Generic Requirements</h4></div>
                        <div class="tab_tead sec_con"><h4>Requirement Title : '.$requirement_detail[0]["prr_title"].'</h4></div>';
            }
            
            $str .= '<div class="col-sm-12 comment_part">
                <i class="fa fa-user" aria-hidden="true"></i>
                <div class="arrow-left"></div>
                <textarea class="comment" id="comment_text" maxlength="3000"></textarea>
                <span id="count_text"></span>
                <input type="hidden" name="comment_requirement_id" id="comment_requirement_id" value="'.$this->input->post('requirement_id').'" />
                <button type="button" name="comment_btn" id="comment_btn" class="btn buttons">Submit</button>
            </div>
            <div class="col-sm-12 sort">
                <p>Sort By : 
                    <select class="sort_select" onchange="show_comments($(this).val(),$(\'#comment_requirement_id\').val(),$(\'#comment_module_id\').val())">
                            <option value="">Select Option</option>
                        <option value="2">Newest</option>
                        <option value="1">Oldest</option>
                        <option value="3">Yesterday</option>
                    </select>
                </p>
            </div>
            <div class="comment_con">
                <div class="col-sm-12">
                    <p>'.count($comments_list).' Comments</p>
                </div>';
                $i=0;
                //($(this).closest(\'div\').append($(\'.comment_part\').html()))
                if($comments_list){
                    foreach($comments_list as $comment){
                            $i++;
                            $odd = $i%2;
                            $odd ? $current_class = 'odd' : $current_class = 'even';                                

                        $str .= '<div class="col-sm-12 comm '.$current_class.'">
                            <div class="comments">';
                        if(isset($comment['user_profile_image']) && $comment['user_profile_image']){                            
                            $str .= '<img src="'. base_url().$this->config->item('profile_thumb_image') . $comment['user_profile_image'] .'" class="comment_img"/>';
                        } else {
                            $str .= '<img src="'. base_url('images/comments.png') .'" class="comment_img"/>';                            
                        }
                                $str .= '<div class="comm_con">
                                    <h5>'.$comment['user_first_name'] .' '. $comment['user_last_name'].'</h5>
                                    <p>'.$comment['prrc_comment'].'</p>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="comment_reply" onclick="$(\'.reply\').hide();$(\'#reply'.$i.'\').show()">Reply</a>
                                        </li>
                                        <li>';
                                            if($comment['is_like']){
                                                $liked = 'Unlike'; 
                                                $paramtr = '2';
                                            } else { 
                                                $liked = 'Like'; 
                                                $paramtr = '1';
                                            }
                                            $str .= '<a href="javascript:void(0)" onclick="comment_like('.$paramtr.','.$comment['prj_id'].','.$comment['prrc_id'].')">'. $liked .'</a>
                                        </li>
                                        <li>'.date("M d, Y", strtotime($comment['insertdatetime'])).'
                                        </li>
                                    </ul>
                                </div>
                                <div class="reply" id="reply'.$i.'" style="display:none">
                                    <div class="arrow-left"></div>
                                    <textarea class="comment" id="comment_text'.$i.'" maxlength="3000"></textarea>
                                    <span class="count_text" id="count_text'.$i.'"></span>
                                    <input type="hidden" name="comment_id" id="comment_id'.$i.'" value="'.$comment['prrc_id'].'" />
                                    <button type="button" name="reply_btn" id="reply_btn'.$i.'" class="btn buttons">Submit</button>
                                </div>
                            </div>
                        </div>';
                        $join_str[0]['table'] = 'users';
                        $join_str[0]['join_table_id'] = 'users.user_id';
                        $join_str[0]['from_table_id'] = 'project_requirement_comments.user_id';
                        $join_str[0]['join_type'] = '';

                        $contition_array = array('prrc_status'=>'enable','parent_id'=>$comment['prrc_id']);
                        $data = 'project_requirement_comments.*,users.user_first_name,users.user_last_name,users.user_profile_image,';
                        $data .= '(select count(*) from cru_project_comment_likes cl where cl.prj_id = cru_project_requirement_comments.prj_id and cl.cmt_id = cru_project_requirement_comments.prrc_id and cl.user_id = '.$this->data['user_id'].' and cl.cmtlk_status = "enable") as is_like';        
                        $comments_reply_details = $this->common->select_data_by_id('project_requirement_comments', 'prr_id', $this->input->post('requirement_id'), $data, $contition_array, $join_str);

                        if($comments_reply_details){
                            foreach($comments_reply_details as $comments_reply_detail){
                            $str .= '<div class="comments inner">';
                            if(isset($comments_reply_detail['user_profile_image']) && $comments_reply_detail['user_profile_image']){                            
                                $str .= '<img src="'. base_url().$this->config->item('profile_thumb_image') . $comments_reply_detail['user_profile_image'] .'" class="comment_img"/>';
                            } else {
                                $str .= '<img src="'. base_url('images/comments.png') .'" class="comment_img"/>';                            
                            }
                                $str .= '<div class="comm_con">
                                            <h5>'.$comments_reply_detail['user_first_name'] .' '. $comments_reply_detail['user_last_name'].'</h5>
                                            <p>'.$comments_reply_detail['prrc_comment'].'</p>
                                            <ul>                                                
                                                <li>';
                                                if($comments_reply_detail['is_like']){
                                                    $liked = 'Unlike'; 
                                                    $paramtr = '2';
                                                } else { 
                                                    $liked = 'Like'; 
                                                    $paramtr = '1';
                                                }
                                                    $str .= '<a href="javascript:void(0)" onclick="comment_like('.$paramtr.','.$comments_reply_detail['prj_id'].','.$comments_reply_detail['prrc_id'].')">'.$liked.'</a>
                                                </li>
                                                <li>'.date("M d, Y", strtotime($comments_reply_detail['insertdatetime'])).'
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>';
                            }
                        }
                    }                
                }
                $str .= '</div>
                ';
            if($str){
                echo $str;
                die();                
            } else {
                echo 'empty';
                die();                
            }
        } else {            
            redirect(site_url(), 'refresh');
        }
        
    }

}

?>