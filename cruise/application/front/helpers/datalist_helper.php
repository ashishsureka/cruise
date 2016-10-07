<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('project_list')) {

    function project_list($project_id = '', $unique = '') { 
        
        $CI = get_instance();
        $CI->load->model('common');
                
        $contition_array = array('prj_id' => $project_id, 'prj_status' => 'enable');
        $project_detail = $CI->common->select_data_by_condition('projects', $contition_array, '*');        
        
        $join_str[0]['table'] = 'project_users';
        $join_str[0]['join_table_id'] = 'project_users.project_id';
        $join_str[0]['from_table_id'] = 'projects.prj_id';
        $join_str[0]['join_type'] = '';
        
        $contition_array = array('project_id' => $project_id,'user_id' => $CI->data['user_id'], 'user_status' => 'owner');
        $project_user = $CI->common->select_data_by_condition('project_users', $contition_array, 'user_status');
        
        $str = '';
        
        if($project_detail && $unique) {
            $str = '
                    <div class="modal fade" id="myModal6'. $project_detail[0]['prj_id'].$unique.'" role="dialog">
                        <div class="modal-dialog" >

                            <!-- Modal content-->
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal"><img src="images/x.png" alt="close" /></button>
                                <div class="modal-body" id="sign_up">
                                    <div class="login text-center" id="detail'. $project_detail[0]['prj_id'].$unique.'">
                                        <h1>Project Details</h1>
                                        <div class="alert fade in alert-success edit_project_success" style="display:none">
                                                <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                            </div>                                                
                                        <div class="alert fade in alert-danger myalert edit_project_error" style="display:none" >
                                                <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                            </div>
                                        
                                        <div class="con_pro" >
                                            <h2 id="pro_title'. $project_detail[0]['prj_id'] .$unique.'">'. $project_detail[0]['prj_title'] .'</h2>
                                            <p id="pro_desc'. $project_detail[0]['prj_id'] .$unique.'">'. $project_detail[0]['prj_description'] .'</p>';
                                        if($project_user){
                                            $str .='<button type="submit" class="btn fill_btn forgatp"  onClick="Hideshow(detail'. $project_detail[0]['prj_id'] .$unique.'.id,edits'. $project_detail[0]['prj_id'] .$unique.'.id)">Edit</button>                                            
                                            <button type="button" class="btn fill_btn" onclick="Hideshow(detail'. $project_detail[0]['prj_id'] .$unique.'.id,invite'. $project_detail[0]['prj_id'] .$unique.'.id)">Send Invite</button>
                                            <button type="button" class="btn fill_btn" data-dismiss="modal">Cancel</button>';
                                            }
                                        $str .='</div>                                        
                                    </div>
                                    <div class="edit_con login text-center edits" id="edits'. $project_detail[0]['prj_id'] .$unique.'" style="display: none">
                                        <h1>Edit Details</h1>
                                        <div class="con_mail">
                                            <form name="edit_project_frm'. $project_detail[0]['prj_id'] .$unique.'" id="edit_project_frm'. $project_detail[0]['prj_id'] .$unique.'" method="post" >
                                                <input type="hidden" name="edit_project_id" id="edit_project_id'. $project_detail[0]['prj_id'] .$unique.'" value="'. $project_detail[0]['prj_id'] .'" >
                                                <input type="text" placeholder="Project Title *" name="edit_project_title" id="edit_project_title'. $project_detail[0]['prj_id'] .$unique.'" value="'. $project_detail[0]['prj_title'] .'"/>
                                                <textarea placeholder="Project Description * (max 500 Words)" name="edit_project_description" id="edit_project_description'. $project_detail[0]['prj_id'] .$unique.'">'. $project_detail[0]['prj_description'] .'</textarea>';
                                            if(isset($project_user)){
                                            $str .='<button type="button" class="btn buttons">Edit</button>
                                            <button type="button" class="btn fill_btn" onclick="edit_projects($(this).closest(\'form\').attr(\'id\'))">Save</button>
                                            <button type="button" class="btn fill_btn" onclick="Hideshow(edits'. $project_detail[0]['prj_id'] .$unique.'.id,invite'. $project_detail[0]['prj_id'] .$unique.'.id)">Send Invite</button>
                                            <button type="button" class="btn fill_btn" data-dismiss="modal">Cancel</button>';
                                            }
                                            $str .='</form>
                                        </div>
                                    </div>
                                    <div class="edit_con login text-center" id="invite'. $project_detail[0]['prj_id'] .$unique.'" style="display: none">
                                        <h1>Send Invites</h1>
                                        <div class="alert fade in alert-success project_success" style="display:none">
                                                <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                            </div>                                                
                                        <div class="alert fade in alert-danger myalert project_error" style="display:none" >
                                                <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                            </div>                                                
                                        <div class="con_mail">
                                            <form name="send_invitation_frm" id="send_invitation_frm'. $project_detail[0]['prj_id'] .$unique.'" method="post" >                                            
                                            <input type="hidden" name="project_send_id" id="project_send_id'. $project_detail[0]['prj_id'] .$unique.'" value="'. $project_detail[0]['prj_id'] .'" >
                                            <textarea placeholder="example1@email.com,example2@email.com,example3@email.com" name="invitation_emails" id="invitation_emails'. $project_detail[0]['prj_id'] .$unique.'"></textarea>
                                            <button type="button" class="btn fill_btn" onclick="Hideshow(invite'. $project_detail[0]['prj_id'] .$unique.'.id,detail'. $project_detail[0]['prj_id'] .$unique.'.id)">Back</button>
                                            <button type="button" name="project_submit_invite" id="project_submit_invite" onclick="submit_invitations($(this).closest(\'form\').attr(\'id\'));" class="btn fill_btn">Send</button>
                                            <button type="button" class="btn fill_btn"  data-dismiss="modal">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';            
        }
        return $str;
        
    }
}

if (!function_exists('module_list')) {
    
    function module_list($project_id = '', $unique = '') { 
        $CI = get_instance();
        $CI->load->model('common');
                
        $contition_array = array('prj_id' => $project_id, 'prm_status' => 'enable');
        $module_detail = $CI->common->select_data_by_condition('project_modules', $contition_array, '*');
        
        $join_str[0]['table'] = 'project_users';
        $join_str[0]['join_table_id'] = 'project_users.project_id';
        $join_str[0]['from_table_id'] = 'projects.prj_id';
        $join_str[0]['join_type'] = '';
        
        $contition_array = array('project_id' => $project_id, 'user_status' => 'owner');
        $project_user = $CI->common->select_data_by_condition('project_users', $contition_array, 'user_status');

        $str = '';

        if ($module_detail && $unique) {
            
                $str = '            
                                    <h5><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal3'.$module_detail[0]['prm_id'].$unique.'" onClick="Hideshow(edits'.$module_detail[0]['prm_id'].$unique.'.id,detail'.$module_detail[0]['prm_id'].$unique.'.id)">'.$module_detail[0]['prm_title'].'</a></h5>
                                    <div class="modal fade" id="myModal3'.$module_detail[0]['prm_id'].$unique.'" role="dialog">
                                        <div class="modal-dialog" >

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <button type="button" class="close" data-dismiss="modal"><img src="images/x.png" alt="close" /></button>
                                                <div class="modal-body" id="sign_up">
                                                    <div class="login text-center" id="detail'.$module_detail[0]['prm_id'].$unique.'">
                                                        <h1>Module Details</h1>
                                                        <div class="alert fade in alert-success module_success" style="display:none">
                                                            <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                        </div>                                                
                                                        <div class="alert fade in alert-danger myalert module_error" style="display:none" >
                                                                <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                            </div>                                                
                                                        <div class="con_pro" >
                                                            <h2 id="mo_title'.$module_detail[0]['prm_id'].$unique.'">'.$module_detail[0]['prm_title'].'</h2>
                                                            <p id="mo_desc'.$module_detail[0]['prm_id'].$unique.'">'.$module_detail[0]['prm_description'].'</p>';
                if(($module_detail[0]['user_id'] == $CI->data['user_id']) || isset($project_user[0]['user_status']) ) {
                                                            $str .= '<button type="button" class="btn fill_btn forgatp"  onClick="Hideshow(detail'.$module_detail[0]['prm_id'].$unique.'.id,edits'.$module_detail[0]['prm_id'].$unique.'.id)">Edit</button>                                                            
                                                            <button type="button" class="btn fill_btn" data-dismiss="modal">Cancel</button>';
                }
                                                        $str .= '</div>

                                                    </div>
                                                    <div class="edit_con login text-center edits" id="edits'.$module_detail[0]['prm_id'].$unique.'" style="display: none">
                                                        <h1>Edit Details</h1>
                                                        <div class="con_mail">
                                                            <form name="edit_module_frm'.$module_detail[0]['prm_id'].$unique.'" id="edit_module_frm'.$module_detail[0]['prm_id'].$unique.'" method="POST" accept-charset="utf-8">
                                                            <input type="hidden" name="edit_module_id" id="edit_module_id'.$module_detail[0]['prm_id'].$unique.'" value="'.$module_detail[0]['prm_id'].'" />
                                                            <input type="text" placeholder="Module Title *" name="edit_module_title" id="edit_module_title'.$module_detail[0]['prm_id'].$unique.'" value="'.$module_detail[0]['prm_title'].'"  />
                                                            <textarea placeholder="Module Description * (max 500 Words)" name="edit_module_description" id="edit_module_description'.$module_detail[0]['prm_id'].$unique.'" >'.$module_detail[0]['prm_description'].'</textarea>
                                                            <button type="button" class="btn buttons">Edit</button>
                                                            <button type="button" class="btn fill_btn" onclick="edit_modules($(this).closest(\'form\').attr(\'id\'))">Save</button>                                                            
                                                            <button type="button" class="btn fill_btn" data-dismiss="modal">Cancel</button>
                                                            </form>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <p>'.$module_detail[0]['prm_description'].'</p>                                
                                ';
                return $str;
            
        }
        
    }        

}

if (!function_exists('module_requirement')) {
    function module_requirement($module_url = '', $unique = '') {
        $CI = get_instance();
        $CI->load->model('common');
        $project_url = '';
        if(isset($CI->data['project_detail'][0]['prj_url'])){ $project_url = $CI->data['project_detail'][0]['prj_url']; }
        
        $limit =$CI->paging['per_page']=10;
        
        if ($CI->uri->segment(5) != '' && $CI->uri->segment(6) != '') {
            $offset = ($CI->uri->segment(7) != '') ? $CI->uri->segment(7) : 0;
            $short_by = $CI->uri->segment(5);
            $order_by = $CI->uri->segment(6);
        } else {
            $offset = ($CI->uri->segment(5) != '') ? $CI->uri->segment(5) : 0;
            $short_by = 'prr_id';
            $order_by = 'asc';
        }

        $CI->data['offset'] = $offset;
        
        $condition_array=array('prm_url' => $module_url,'prj_id' => $CI->data['project_detail'][0]['prj_id'], 'prm_status' => 'enable');
        $module_creater = $CI->common->select_data_by_condition('project_modules', $condition_array, 'prm_id,user_id');
        
        $condition_array=array('prm_id' => $module_creater[0]['prm_id'],'prr_type' => 'module', 'prr_status' => 'enable');
        $data = 'project_requirements.*,(select count(*) from cru_project_requirement_likes_dislikes ld where ld.prj_id = cru_project_requirements.prj_id and ld.prr_id = cru_project_requirements.prr_id and ld.user_id = '.$CI->data['user_id'].' and ld.prrld_type = "like" and ld.prrld_status = "enable") as like_count,';
        $data .= '(select count(*) from cru_project_requirement_likes_dislikes ld where ld.prj_id = cru_project_requirements.prj_id and ld.prr_id = cru_project_requirements.prr_id and ld.user_id = '.$CI->data['user_id'].' and ld.prrld_type = "dislike" and ld.prrld_status = "enable") as dislike_count';
        $module_requirements = $CI->common->select_data_by_condition('project_requirements', $condition_array, $data, $short_by, $order_by, $limit, $offset);
        
        if ($CI->uri->segment(5) != '' && $CI->uri->segment(6) != '') {
            $CI->paging['base_url'] = site_url("projects/".$project_url."/module_requirements/". $module_url . "/" . $short_by . "/" . $order_by);
        } else {
            $CI->paging['base_url'] = site_url("projects/".$project_url."/module_requirements/". $module_url);
        }
        if ($CI->uri->segment(5) != '' && $CI->uri->segment(6) != '') {
            $CI->paging['uri_segment'] = 7;
        } else {
            $CI->paging['uri_segment'] = 5;
        }
        $CI->paging['total_rows'] = count($CI->common->select_data_by_condition('project_requirements', $condition_array));
        
        $CI->pagination->initialize($CI->paging);
        
        $str = '';
        if($module_requirements){
            $i=0;
            foreach ($module_requirements as $module_requirement){
                $i++;
            $str .= ' 
                        
                        <div class="modal fade" id="myModal_mod_edit_req'.$unique. $i .'" role="dialog">
                            <div class="modal-dialog" >

                                 Modal content
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal"><img src="'. base_url('images/x.png') .'" alt="close"/></button>
                                    <div class="modal-body" id="sign_up">
                                        <div class="login text-center" id="pro">
                                            <h1>Edit Requirement</h1>
                                            <div class="alert fade in alert-success mr_success" style="display:none">
                                                    <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                </div>                                                
                                            <div class="alert fade in alert-danger myalert mr_error" style="display:none" >
                                                    <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                </div>                                                
                                            <div class="con_mail">
                                                <form name="edit_module_requirement_frm" id="edit_module_requirement_frm'.$unique.$i.'" method="POST">                                                
                                                <input type="hidden" name="project_url" id="mr_project_url" value="'.$project_url.'" >
                                                <input type="hidden" name="requirement_id" id="requirement_id" value="'. $module_requirement['prr_id'] .'" >
                                                <input type="hidden" name="module_id" id="module_id" value="'. $module_requirement['prm_id'] .'" >
                                                <input type="text" name="module_requirement_title" id="module_requirement_title" placeholder="Requirement Title *" value="'. $module_requirement['prr_title'] .'" />
                                                <textarea name="module_requirement_desc" id="module_requirement_desc" placeholder="Requirement Description * (max 500 Words)" class="textare">'. $module_requirement['prr_description'] .'</textarea>';
                                                if($module_requirement['prr_priority']=="high"){
                                                    
                                                $str .= ' <select name="module_requirement_priority" id="module_requirement_priority">
                                                    <option value="">-- Select Priority --</option>
                                                    <option value="high" selected = "seleceted">High</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="low">Low</option>
                                                </select>';
                                                } elseif($module_requirement['prr_priority']=="medium"){
                                                    $str .= ' <select name="module_requirement_priority" id="module_requirement_priority">
                                                    <option value="">-- Select Priority --</option>
                                                    <option value="high">High</option>
                                                    <option value="medium" selected = "seleceted">Medium</option>
                                                    <option value="low">Low</option>
                                                </select>';
                                                }  elseif ($module_requirement['prr_priority']=="low") {
                                                    $str .= ' <select name="module_requirement_priority" id="module_requirement_priority">
                                                    <option value="">-- Select Priority --</option>
                                                    <option value="high">High</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="low" selected = "seleceted">Low</option>
                                                </select>';
                                                } else {
                                                    $str .= ' <select name="module_requirement_priority" id="module_requirement_priority">
                                                    <option value="">-- Select Priority --</option>
                                                    <option value="high">High</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="low">Low</option>
                                                </select>';
                                                }
                                                $str .= '<button type="button" class="btn fill_btn">Cancel</button>
                                                <button type="button" class="btn fill_btn send" onclick="edit_module_requirement($(this).closest(\'form\').prop(\'id\'))">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal fade" id="myModal_view_mod_req'.$unique. $i .'" role="dialog">
                            <div class="modal-dialog" >
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal"><img src="'. base_url('images/x.png') .'" alt="close"/></button>
                                    <div class="modal-body" id="sign_up">
                                        <div class="login text-center" id="detail">
                                            <h1>Requirement Details</h1>
                                            <div class="con_pro" >
                                                <h2>'. $module_requirement['prr_title'] .'</h2>
                                                <p>'. $module_requirement['prr_description'] .'</p>                                                        
                                                <button type="submit" class="btn fill_btn" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                                <div class="col-sm-12 paging_divs'.$unique.'">
                                    <div class="project_desc2">
                                        <div class="col-sm-1 pro_content2 fi_head">
                                            <h3>Sr.No</h3>
                                            <h5>'.$i.'</h5>
                                        </div>
                                        <div class="col-sm-6 pro_content2">
                                            <h3>Requirement Title</h3>
                                            <h5>'.$module_requirement['prr_title'].'</h5>
                                        </div>
                                        <div class="col-sm-3 pro_content2 last_head">
                                            <h3>Actions</h3>
                                            <ul>';
                                                if($CI->data['project_user_type']=='owner' || $module_requirement['user_id']==$CI->data['user_id'] || $module_creater[0]['user_id']==$CI->data['user_id']){
                                                    $str .= '<li>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_mod_edit_req'.$unique. $i .'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </li>';
                                                }
                                                $str .= '<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_view_mod_req'.$unique. $i .'"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                <li><a href="javascript:void(0)" class="comment" onclick="show_comments(2,'. $module_requirement['prr_id'] .','. $module_requirement['prm_id'] .')"><i class="fa fa-comment-o" aria-hidden="true"></i></a></li>';
                                                    $str .='<li class="like" id="like'.$unique. $i.'" onclick="like_dislike(1,'. $module_requirement['prr_id'] .','. $module_requirement['prj_id'] .',$(this).attr(\'id\'))" ';if(!$module_requirement['like_count'] && !$module_requirement['dislike_count']){ $str .= 'style="display:inline-block"';} else {$str .= 'style="display:none"';}$str .= '><a href="javascript:void(0)"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                            <li class="dislike" id="dislike'.$unique. $i.'" onclick="like_dislike(2,'. $module_requirement['prr_id'] .','. $module_requirement['prj_id'] .',$(this).attr(\'id\'))" ';if(!$module_requirement['like_count'] && !$module_requirement['dislike_count']){ $str .= 'style="display:inline-block"';} else {$str .= 'style="display:none"';}$str .= '><a href="javascript:void(0)" ><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a></li>
                                                            <li id="after_like'.$unique. $i.'" class="after_like" onclick="clear_like_dislike('. $module_requirement['prr_id'] .','. $module_requirement['prj_id'] .',$(this).attr(\'id\'))" ';if($module_requirement['like_count']){ $str .= 'style="display:inline-block"';} else {$str .= 'style="display:none"';}$str .= '><a href="javascript:void(0)"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                            <li id="after_dislike'.$unique. $i.'" class="after_dislike" onclick="clear_like_dislike('. $module_requirement['prr_id'] .','. $module_requirement['prj_id'] .',$(this).attr(\'id\'))" ';if($module_requirement['dislike_count']){ $str .= 'style="display:inline-block"';} else {$str .= 'style="display:none"';}$str .= '><a href="javascript:void(0)"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>';
                                                
                                                if($CI->data['project_user_type']=='owner' || $module_requirement['user_id']==$CI->data['user_id'] || $module_creater[0]['user_id']==$CI->data['user_id']){
                                                $str .= ' <li><a href="'.site_url("contributor/delete_module_requirement/".base64_encode($module_requirement["prr_id"])) .'/'.$project_url.'/'.$module_url.'"
                                                    onclick="if(!confirm(\'Are sure you want to delete this requirement ?\')){ return false; }"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </li>';
                                                }
                                            $str .= '</ul>
                                        </div>
                                        <div class="col-sm-2 pro_content2 last_head2">
                                            <h3>Priority</h3>';
                                            if($module_requirement['prr_priority'] == 'high'){
                                              $str .= '<h5><img src="'. base_url("images/high_pri.png") .'"/>High</h5>';
                                            } elseif($module_requirement['prr_priority'] == 'medium'){
                                              $str .= '<h5><img src="'. base_url("images/medium.png") .'"/>Medium</h5>';  
                                            } elseif($module_requirement['prr_priority'] == 'low'){
                                              $str .= '<h5><img src="'. base_url("images/low_pri.png") .'"/>Low</h5>';    
                                            }
                                            
                                        $str .= '</div>
                                    </div>
                                </div>';
                                
            }
                                $str .= '<div class="col-sm-12">';
                                    if ($CI->pagination->create_links()) {
                                        $str .= '<div class="pagination pull-right"> '.$CI->pagination->create_links().' </div>';
                                    }
                                $str .'</div>';     
        }
        return $str;
    }
}
