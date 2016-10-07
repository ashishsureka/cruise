<?php echo $head ?>
<?php echo $header ?>
        <div class="inner_head">
            <div class="container">
                <div class="col-sm-6 head_left"><h2><?php if(isset($project_detail[0]['prj_title'])){ echo $project_detail[0]['prj_title']; }  ?></h2></div>
                <div class="col-sm-6 head_right"><button type="submit" class="btn buttons" data-toggle="modal" data-target="#myModal6"> <i class="fa fa-plus" aria-hidden="true"></i>Add Module</button></div>
                <div class="modal fade" id="myModal6" role="dialog">
                    <div class="modal-dialog" >

                        <!-- Modal content-->
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url('images/x.png') ?>" alt="close"/></button>
                            <div class="modal-body" id="sign_up">
                                <div class="login text-center" id="pro">
                                    <h1>Create New Module</h1>
                                    <div class="alert fade in alert-success module_success" style="display:none">
                                            <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                        </div>                                                
                                    <div class="alert fade in alert-danger myalert module_error" style="display:none" >
                                            <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                        </div>                                                
                                    <div class="con_mail">
                                        <?php echo form_open('contributor/add_module',array('name'=>'add_module_frm','id'=>'add_module_frm','method'=>'POST'));  ?>
                                        <input type="hidden" name="project_url" id="module_project_url" value="<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>" >
                                        <input type="text" name="module_title" id="module_title" placeholder="Module Title *"/>
                                        <textarea name="module_description" id="module_description" placeholder="Module Description * (max 500 Words)" class="textare"></textarea>
                                        <button type="button" data-dismiss="modal" class="btn fill_btn">Cancel</button>
                                        <button type="button" class="btn fill_btn send" onclick="add_module()">Add</button>
                                        <?php echo form_close() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <!--content start-->
    <div class="content">
        <!--tab start-->
        <div class="container" id="module_con">
            <!--left tab start-->
            <div class="col-sm-3">
                <ul class="nav nav-tabs">
                    <?php if($project_user_type == 'owner'){ ?>
                    <li <?php if(!$this->uri->segment(3)){ ?>class="active" <?php } ?>><a href="<?php echo site_url('projects') ?>/<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>" ><img src="<?php echo base_url('images/icon_group_unselect.png') ?>" class="norm"/> <img src="<?php echo base_url('images/icon_group_select.png') ?>" class="act"/>Contributers <img src="<?php echo base_url('images/right_arrow.png') ?>" class="arrow"/></a></li>
                    <?php } ?>
                    <li class="general <?php if($this->uri->segment(3) == 'general_requirements' || ($project_user_type != 'owner' && $this->uri->segment(3) == '')){ echo 'active'; } ?>"><a href="<?php echo site_url('projects') ?>/<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>/general_requirements" class="generic requi"><img src="<?php echo base_url('images/icon_inbox_unselect.png') ?>" class="norm"/> <img src="<?php echo base_url('images/icon_inbox_select.png') ?>" class="act"/>Generic Requirements <img src="<?php echo base_url('images/right_arrow.png') ?>" class="arrow"/></a></li>
                    <li class="button-dropdown <?php if($this->uri->segment(3) == 'module_requirements'){ echo 'active'; } ?>" >
                        <a class="dropdown-toggle module_menu"  data-toggle="dropdown" href=""><img src="<?php echo base_url('images/icon_list_unselect.png') ?>" class="norm" /> <img src="<?php echo base_url('images/icon_list_select.png') ?>" class="act"/> Modules<img src="<?php echo base_url('images/right_arrow.png') ?>" class="arrow a1"/><img src="<?php echo base_url('images/down_arrow.png') ?>" class="darrow"/></a>
                        <ul class="dropdown-menu"<?php if($this->uri->segment(3) != 'module_requirements'){ echo 'style="display:none"'; } ?> >
                            <?php
                            $i=0;
                            if(isset($project_modules) && $project_modules){                                
                                    foreach($project_modules as $project_module){
                                        
                            ?>
                            <li class="<?php if($this->uri->segment(3) == 'module_requirements' && $this->uri->segment(4) == $project_module['prm_url']){ echo 'active'; } ?>"><a href="<?php echo site_url('projects') ?>/<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>/module_requirements/<?php echo $project_module['prm_url'] ?>"><?php echo $project_module['prm_title'] ?><img src="<?php echo base_url('images/right_arrow.png') ?>" class="arrow"/></a></li>                            
                            <?php
                            $i++;   }
                            } ?>
                            
                        </ul> 
                    </li>
                </ul><!-- end of nav -->
            </div>
            <!--left tab end-->
            <!--right content start-->
            <div class="col-sm-9 tab-content">
                <!--contributor start-->
                <div class="tab-pane <?php if(!$this->uri->segment(3) && $project_user_type == 'owner'){ echo 'active'; } ?>" id="tab_a">
                    <div class="tab_tead"><h4>Contributors</h4><button type="submit" class="btn buttons" data-toggle="modal" data-target="#myModal2"> <i class="fa fa-paper-plane-o" aria-hidden="true"></i>Send Invites</button></div>
                    <div class="modal fade" id="myModal2" role="dialog">
                        <div class="modal-dialog" >
                            <!-- Modal content-->
                            <div class="modal-content">
                                <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url('images/x.png') ?>" alt="close"/></button>
                                <div class="modal-body" id="sign_up">
                                    <div class="edit_con login text-center" id="invite">
                                        <h1>Send Invites</h1>
                                        <div class="alert fade in alert-success invitation_success" style="display:none">
                                                <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                            </div>                                                
                                        <div class="alert fade in alert-danger myalert invitation_error" style="display:none" >
                                                <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                            </div>                                                
                                        <div class="con_mail">
                                            <?php echo form_open('send_invite',array('name'=>'send_invite_frm','id'=>'send_invite_frm','method'=>'POST'));  ?>                                            
                                            <input type="hidden" name="invite_project_url" id="invite_project_url" value="<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>" >
                                            <textarea name="invitation_emails" id="invitation_emails" placeholder="example1@email.com,example2@email.com,example3@email.com" ></textarea>
                                            <button type="button" class="btn fill_btn">Back</button>
                                            <button type="button" class="btn fill_btn send" onclick="submit_invitations()">Send</button>
                                            <?php echo form_close() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" tab_inner">
                        <ul>
                            <?php if(isset($project_invitations) && $project_invitations) {
                                    foreach ($project_invitations as $project_invitation){
                                ?>
                                        <li>
                                            <p><?php echo $project_invitation['pri_email'] ?> <a href="<?php echo site_url('contributor/delete_invitation/'.base64_encode($project_invitation['pri_id'])) ?>/<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>"  
                                                                                                 onclick="if(!confirm('Are sure you want to delete this invitation ?')){ return false; }"><i class="fa fa-trash-o" aria-hidden="true"></i></a></p>
                                        </li>                            
                                    <?php } } ?>
                        </ul>
                    </div>
                </div>
                <!--contributor end-->
                <!--requirement start-->
                <div class="tab-pane <?php if(($this->uri->segment(3) == 'general_requirements' || $this->uri->segment(3) == '') && $project_user_type != 'owner'){ echo 'active'; } elseif($this->uri->segment(3) == 'general_requirements'){ echo 'active'; } ?>" id="tab_b">
                    <div class="require_tab">
                        <div class="tab_tead"><h4>Requirements</h4><button type="submit" class="btn buttons" data-toggle="modal" data-target="#myModal7"> <i class="fa fa-plus" aria-hidden="true"></i>Add Requirement</button></div>
                        <div class="modal fade" id="myModal7" role="dialog">
                            <div class="modal-dialog" >
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url('images/x.png') ?>" alt="close"/></button>
                                    <div class="modal-body" id="sign_up">
                                        <div class="login text-center" id="pro">
                                            <h1>Create New Requirement</h1>
                                            <div class="alert fade in alert-success gr_success" style="display:none">
                                                    <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                </div>                                                
                                            <div class="alert fade in alert-danger myalert gr_error" style="display:none" >
                                                    <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                </div>                                                
                                            <div class="con_mail">
                                                <?php echo form_open('contributor/add_general_requirement',array('name'=>'general_requirement_frm','id'=>'general_requirement_frm','method'=>'POST'));  ?>
                                                <input type="hidden" name="project_url" id="gr_project_url" value="<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>" >
                                                <input type="text" name="general_requirement_title" id="general_requirement_title" placeholder="Requirement Title *"/>
                                                <textarea name="general_requirement_desc" id="general_requirement_desc" placeholder="Requirement Description * (max 500 Words)" class="textare"></textarea>
                                                <select name="general_requirement_priority" id="general_requirement_priority">
                                                    <option value="">-- Select Priority --</option>
                                                    <option value="high">High</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="low">Low</option>
                                                </select>
                                                <button type="button" data-dismiss="modal" class="btn fill_btn">Cancel</button>
                                                <button type="button" class="btn fill_btn send" name="add" id="add" onclick="general_requirement()">Add</button>                                                
                                                <?php echo form_close() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>                        
                        
                        <?php if(isset($project_requirements) && $project_requirements) { ?>
                        <!--Sections start-->
                        <section>
                            <div class="requirement_con">
                                <div class="col-sm-12">
                                    <div class="project_con">
                                        <div class="col-sm-1 heading_pro2">
                                            <h5>Sr.No</h5>
                                        </div>
                                        <div class="col-sm-6 heading_pro2">
                                            <h5>Requirement Title</h5>
                                        </div>
                                        <div class="col-sm-3 heading_pro2">
                                            <h5>Actions</h5>
                                        </div>
                                        <div class="col-sm-2 heading_pro2">
                                            <h5>Priority</h5>
                                        </div>
                                    </div>
                                </div>
                                <!--<div id="easyPaginate">-->
                                <?php 
                                $j=0;
                                foreach($project_requirements as $project_requirement) { $j++; ?>
                                <div class="modal fade" id="myModal8<?php echo $j ?>" role="dialog">
                                    <div class="modal-dialog" >
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url('images/x.png') ?>" alt="close"/></button>
                                            <div class="modal-body" id="sign_up">
                                                <div class="login text-center" id="pro">
                                                    <h1>Edit Requirement</h1>
                                                    <div class="alert fade in alert-success gr_success" style="display:none">
                                                            <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                        </div>                                                
                                                    <div class="alert fade in alert-danger myalert gr_error" style="display:none" >
                                                            <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                        </div>                                                
                                                    <div class="con_mail">
                                                        <?php echo form_open('contributor/edit_general_requirement',array('name'=>'edit_general_requirement_frm','id'=>'edit_general_requirement_frm'.$j,'method'=>'POST'));  ?>
                                                        <input type="hidden" name="edit_gr_project_url" id="edit_gr_project_url" value="<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>" >
                                                        <input type="text" name="edit_general_requirement_title" id="edit_general_requirement_title" placeholder="Requirement Title *" value="<?php echo $project_requirement['prr_title'] ?>"/>
                                                        <textarea name="edit_general_requirement_desc" id="edit_general_requirement_desc" placeholder="Requirement Description * (max 500 Words)" class="textare"><?php echo $project_requirement['prr_description'] ?></textarea>
                                                        <select name="edit_general_requirement_priority" id="edit_general_requirement_priority">
                                                            <option value="">-- Select Priority --</option>
                                                            <option value="high" <?php if($project_requirement['prr_priority']=="high"){ echo "selected = 'seleceted'"; } ?>>High</option>
                                                            <option value="medium" <?php if($project_requirement['prr_priority']=="medium"){ echo "selected = 'seleceted'"; } ?>>Medium</option>
                                                            <option value="low" <?php if($project_requirement['prr_priority']=="low"){ echo "selected = 'seleceted'"; } ?>>Low</option>
                                                        </select>
                                                        <button type="button" data-dismiss="modal" class="btn fill_btn">Cancel</button>
                                                        <button type="button" class="btn fill_btn send" name="edit" id="edit" onclick="edit_general_requirement(<?php echo $project_requirement['prr_id'] ?>,<?php echo $j ?>)">Submit</button>                                                
                                                        <?php echo form_close() ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="myModal_view_req<?php echo $j ?>" role="dialog">
                                    <div class="modal-dialog" >
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url('images/x.png') ?>" alt="close"/></button>
                                            <div class="modal-body" id="sign_up">
                                                <div class="login text-center" id="detail">
                                                    <h1>Requirement Details</h1>
                                                    <div class="con_pro" >
                                                        <h2><?php echo $project_requirement['prr_title'] ?></h2>
                                                        <p><?php echo $project_requirement['prr_description'] ?></p>                                                        
                                                        <button type="submit" class="btn fill_btn" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 paging_divs" id="project_requirement<?php echo $j ?>">
                                    <div class="project_desc2">
                                        <div class="col-sm-1 pro_content2 fi_head">
                                            <h3>Sr.No</h3>
                                            <h5><?php echo $j ?></h5>
                                        </div>
                                        <div class="col-sm-6 pro_content2">
                                            <h3>Requirement Title</h3>
                                            <h5><?php echo $project_requirement['prr_title'] ?></h5>
                                        </div>
                                        <div class="col-sm-3 pro_content2 last_head">
                                            <h3>Actions</h3>
                                            <ul>
                                                <?php if($project_user_type == 'owner' || $project_requirement['user_id']==$user_id){ ?>
                                                <li>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal8<?php echo $j ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </li>
                                                <?php } ?>
                                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_view_req<?php echo $j ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                <li><a href="javascript:void(0)" class="comment" onclick="show_comments(2,<?php echo $project_requirement['prr_id'] ?>)"><i class="fa fa-comment-o" aria-hidden="true"></i></a></li>                                                
                                                <li class="like" id="like<?php echo $j ?>" <?php if(!$project_requirement['like_count'] && !$project_requirement['dislike_count']){ echo 'style="display:inline-block"'; } else { echo 'style="display:none"'; } ?> onclick="like_dislike(1,<?php echo $project_requirement['prr_id'] ?>,<?php if(isset($project_detail[0]['prj_id'])){ echo $project_detail[0]['prj_id']; } ?>,$(this).attr('id'))"><a href="javascript:void(0)"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a></li>
                                                <li class="dislike" id="dislike<?php echo $j ?>" <?php if(!$project_requirement['like_count'] && !$project_requirement['dislike_count']){ echo 'style="display:inline-block"'; } else { echo 'style="display:none"'; } ?> onclick="like_dislike(2,<?php echo $project_requirement['prr_id'] ?>,<?php if(isset($project_detail[0]['prj_id'])){ echo $project_detail[0]['prj_id']; } ?>,$(this).attr('id'))"><a href="javascript:void(0)"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a></li>                                                
                                                <li id="after_like<?php echo $j ?>" class="after_like" <?php if($project_requirement['like_count']){ echo 'style="display:inline-block"'; } else { echo 'style="display:none"'; } ?> onclick="clear_like_dislike(<?php echo $project_requirement['prr_id'] ?>,<?php if(isset($project_detail[0]['prj_id'])){ echo $project_detail[0]['prj_id']; } ?>,$(this).attr('id'))"><a href="javascript:void(0)"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a></li>
                                                <li id="after_dislike<?php echo $j ?>" class="after_dislike" <?php if($project_requirement['dislike_count']){ echo 'style="display:inline-block"'; } else { echo 'style="display:none"'; } ?> onclick="clear_like_dislike(<?php echo $project_requirement['prr_id'] ?>,<?php if(isset($project_detail[0]['prj_id'])){ echo $project_detail[0]['prj_id']; } ?>,$(this).attr('id'))"><a href="javascript:void(0)"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a></li>                                                
                                                <?php if($project_user_type == 'owner' || $project_requirement['user_id']==$user_id){ ?>                                                
                                                <li><a href="<?php echo site_url('contributor/delete_requirement/'.base64_encode($project_requirement['prr_id'])) ?>/<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>"
                                                       onclick="if(!confirm('Are sure you want to delete this requirement ?')){ return false; }"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <div class="col-sm-2 pro_content2 last_head2">
                                            <h3>Priority</h3>
                                            <?php if($project_requirement['prr_priority'] == 'high') { ?>
                                                <h5><img src="<?php echo base_url('images/high_pri.png') ?>"/>High</h5>
                                            <?php } elseif($project_requirement['prr_priority'] == 'medium'){ ?>
                                                <h5><img src="<?php echo base_url('images/medium.png') ?>"/>Medium</h5>
                                            <?php } elseif($project_requirement['prr_priority'] == 'low'){ ?>    
                                                <h5><img src="<?php echo base_url('images/low_pri.png') ?>"/>Low</h5>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>                                
                                <?php } ?>
                                <!--</div>-->                                
                                <div class="col-sm-12">
                                    <?php if ($this->pagination->create_links()) { ?>
                                    <div class="pagination pull-right"> <?php echo $this->pagination->create_links(); ?> </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
                        <!--section end-->
                        <?php } ?>
                    </div>
                    <div class="general_content_comment" style="display:none">                        
                    </div>
                </div>
                <!--requirement end-->
                <?php
                $i=0;
                if(isset($project_modules) && $project_modules){
                    $count = count($project_modules);
                    $count = $count-1;                    
                        foreach($project_modules as $project_module){
                $module_array[]=$i;
                ?>
                <!--module start-->
                <div class="tab-pane modules <?php if($this->uri->segment(3) == 'module_requirements' && $this->uri->segment(4) == $project_module['prm_url']){ echo 'active'; } ?> " id="tab_d<?php echo $i ?>">
                    <div class="require_tab">
                        <div class="tab_tead"><h4><?php echo $project_module['prm_title'] ?></h4>
                            <ul>
                                <?php if($project_user_type == 'owner' || $project_module['user_id']==$user_id) { ?>
                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_edit_module<?php echo $i ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Module</a></li>
                                <li><a href="<?php echo site_url('contributor/delete_module/'. $project_module['prm_url']) ?>/<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>" onclick="if(!confirm('Are sure you want to delete this module ?')){ return false;}"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Module</a></li>
                                <?php } ?>
                                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal_view_mod<?php echo $i ?>">View Details <i class="fa fa-caret-down" aria-hidden="true"></i></a></li>

                            </ul>
                        </div>
                        <div class="modal fade" id="myModal_edit_module<?php echo $i ?>" role="dialog">
                            <div class="modal-dialog" >
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url('images/x.png') ?>" alt="close"/></button>
                                    <div class="modal-body" id="sign_up">
                                        <div class="login text-center" id="pro">
                                            <h1>Edit Module</h1>
                                            <div class="alert fade in alert-success module_success" style="display:none">
                                                    <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                </div>                                                
                                            <div class="alert fade in alert-danger myalert module_error" style="display:none" >
                                                    <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                </div>                                                
                                            <div class="con_mail">
                                                <?php echo form_open('contributor/edit_module',array('name'=>'edit_module_frm','id'=>'edit_module_frm'.$i,'method'=>'POST'));  ?>
                                                <input type="hidden" name="project_url" id="module_project_url" value="<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>" >
                                                <input type="hidden" name="module_id" id="module_id" value="<?php echo $project_module['prm_id'] ?>" >
                                                <input type="text" name="module_title" id="module_title" placeholder="Module Title *" value="<?php echo $project_module['prm_title'] ?>"/>
                                                <textarea name="module_description" id="module_description" placeholder="Module Description * (max 500 Words)" class="textare"><?php echo $project_module['prm_description'] ?></textarea>
                                                <button type="button" data-dismiss="modal" class="btn fill_btn">Cancel</button>
                                                <button type="button" class="btn fill_btn send" onclick="edit_module($(this).closest('form').prop('id'))">Submit</button>
                                                <?php echo form_close() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="myModal_view_mod<?php echo $i ?>" role="dialog">
                            <div class="modal-dialog" >
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url('images/x.png') ?>" alt="close"/></button>
                                    <div class="modal-body" id="sign_up">
                                        <div class="login text-center" id="detail">
                                            <h1>Module Details</h1>
                                            <div class="con_pro" >
                                                <h2><?php echo $project_module['prm_title'] ?></h2>
                                                <p><?php echo $project_module['prm_description'] ?></p>                                                        
                                                <button type="submit" class="btn fill_btn" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab_tead sec_con"><h4>Requirements</h4><button type="submit" class="btn buttons" data-toggle="modal" data-target="#myModal_mod_req<?php echo $i ?>"> <i class="fa fa-plus" aria-hidden="true"></i>Add Requirement</button></div>
                        <div class="modal fade" id="myModal_mod_req<?php echo $i ?>" role="dialog">
                            <div class="modal-dialog" >

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url('images/x.png') ?>" alt="close"/></button>
                                    <div class="modal-body" id="sign_up">
                                        <div class="login text-center" id="pro">
                                            <h1>Create New Requirement</h1>
                                            <div class="alert fade in alert-success mr_success" style="display:none">
                                                    <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                </div>                                                
                                            <div class="alert fade in alert-danger myalert mr_error" style="display:none" >
                                                    <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                </div>                                                
                                            <div class="con_mail">
                                                <?php echo form_open('contributor/add_module_requirement',array('name'=>'module_requirement_frm'.$project_module['prm_id'],'id'=>'module_requirement_frm'.$project_module['prm_id'],'method'=>'POST'));  ?>
                                                <input type="hidden" name="project_url" id="mr_project_url" value="<?php if(isset($project_detail[0]['prj_url'])){ echo $project_detail[0]['prj_url']; } ?>" >
                                                <input type="hidden" name="module_id" id="module_id" value="<?php echo $project_module['prm_id']; ?>" >
                                                <input type="text" name="module_requirement_title" id="module_requirement_title" placeholder="Requirement Title *"/>
                                                <textarea name="module_requirement_desc" id="module_requirement_desc" placeholder="Requirement Description * (max 500 Words)" class="textare"></textarea>
                                                <select name="module_requirement_priority" id="module_requirement_priority">
                                                    <option value="">-- Select Priority --</option>
                                                    <option value="high">High</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="low">Low</option>
                                                </select>
                                                <button type="button" class="btn fill_btn">Cancel</button>
                                                <button type="button" class="btn fill_btn send" onclick="module_requirement($(this).closest('form').prop('id'))">Add</button>
                                                <?php echo form_close() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <?php if(module_requirement($project_module['prm_url'])){ ?>
                        <!--Sections start-->
                        <section>
                            <div class="requirement_con">
                                <div class="col-sm-12">
                                    <div class="project_con">
                                        <div class="col-sm-1 heading_pro2">
                                            <h5>Sr.No</h5>
                                        </div>
                                        <div class="col-sm-6 heading_pro2">
                                            <h5>Requirement Title</h5>
                                        </div>
                                        <div class="col-sm-3 heading_pro2">
                                            <h5>Actions</h5>
                                        </div>
                                        <div class="col-sm-2 heading_pro2">
                                            <h5>Priority</h5>
                                        </div>
                                    </div>
                                </div>
                                <?php echo module_requirement($project_module['prm_url'],$i) ?>
                            </div>
                        </section>
                        <!--section end-->
                        <?php } ?>
                    </div>
                    
                </div>
                <!--module 1 end -->
                <?php 
                        $i++; }
                }
                ?>                
                <div class="module_content_comment">
                        
                </div>
            </div>
            <!-- right content end -->

        </div>
        <!--tab end-->
    </div>
    <!--content end-->
    <?php echo $footer ?>
        <script>
            $(function () {
                $('#media').change(function () {
                    $('.contents').hide();
                    $('#' + $(this).val()).show();
                });
            });
            $(function () {
                $('#media2').change(function () {
                    $('.contents').hide();
                    $('#' + $(this).val()).show();
                });
            });
            $(function () {
                $('#media3').change(function () {
                    $('.contents').hide();
                    $('#' + $(this).val()).show();
                });
            });

            $(document).ready(function () {
                $('.modal').on('hidden.bs.modal', function () {
                   location.reload(true);
               })
            });

function like_dislike(ld,requirement_id,project_id,current_id)
{    
    //return false;
    //alert(current_id);    
    if(ld && requirement_id && project_id){            
        $.ajax({
            url:"<?php echo base_url('contributor/like_dislike') ?>",
            type:"post",
            dataType:"html",
            data:{'ld_value':ld,'requirement_id':requirement_id,'project_id':project_id,
                  '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                 },
            success:function(data){      

                if(data=='success')
                {                       
                    if(ld=='1')
                    {                                             
                          $('#'+current_id).parent().find('.like').css('display','none');
                          $('#'+current_id).parent().find('.dislike').css('display','none');
                          $('#'+current_id).parent().find('.after_like').css('display','inline-block');                          
                    }
                    else if(ld=='2')
                    {                                                
                          $('#'+current_id).parent().find('.like').css('display','none');
                          $('#'+current_id).parent().find('.dislike').css('display','none');
                          $('#'+current_id).parent().find('.after_dislike').css('display','inline-block');                          
                    }
                    
                }
                else
                {
                    alert('Error Occurred');
                }

            }
        });
    }
}

function clear_like_dislike(requirement_id,project_id,my_id)
{
    //return false;
    if(requirement_id && project_id){            
        $.ajax({
            url:"<?php echo base_url('contributor/clear_like_dislike') ?>",
            type:"post",
            dataType:"html",
            data:{'requirement_id':requirement_id,'project_id':project_id,
                  '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                 },
            success:function(data){      
//                alert(data);
//                return false;
                if(data=='success')
                {                           
                        $('#'+my_id).css('display','none');
                        $('#'+my_id).parent().find('.like').css('display','inline-block');
                        $('#'+my_id).parent().find('.dislike').css('display','inline-block');
                }
                else
                {
                    alert('Error Occurred');
                }

            }
        });
    }
}

function comment_like(lk,project_id,comment_id)
{
    var module_id = $('#comment_module_id').val();
    var requirement_id = $('#comment_requirement_id').val();
    if(lk && project_id && comment_id){            
        $.ajax({
            url:"<?php echo base_url('contributor/comment_like') ?>",
            type:"post",
            dataType:"html",
            data:{'like_type':lk,'project_id':project_id,'comment_id':comment_id,
                  '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                 },
            success:function(data){      
                
                if(data=='success')
                {   
                    show_comments(2,requirement_id,module_id);                                            
                }
                else
                {
                    alert('Error Occurred');
                }

            }
        });
    }
}

        </script>
        <script>

$(document).ajaxComplete(function(){    
    
    var text_max = 3000;
    $('#count_text').text('Character remaining:' + text_max);
    //alert($('#count_text').text());
    $('#comment_text').keyup(function() {        
        var text_length = $('#comment_text').val().length;
        var text_remaining = text_max - text_length;

        $('#count_text').text('Character remaining:' + text_remaining);
    });
    
    $('#comment_btn').click(function() {
        
        var text_length = $('#comment_text').val().length;
        var text_val = $('#comment_text').val();
        var requirement_id = $('#comment_requirement_id').val();
        var project_id = <?php if(isset($project_detail[0]['prj_id'])){ echo $project_detail[0]['prj_id']; } ?>;
        var module_id = $('#comment_module_id').val();
        if(text_length){            
            $.ajax({
                url:"<?php echo base_url('contributor/add_comment') ?>",
                type:"post",
                dataType:"html",
                data:{'comment_text':text_val,'requirement_id':requirement_id,'project_id':project_id,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){      
//                    alert(data);
//                    return false;
                    if(data=='success')
                    {
                        show_comments(2,requirement_id,module_id);                        
                    }
                    else
                    {
                        alert('Error Occurred');
                    }
                }
            });
        }
    });
    
    
    $('.reply').find('span').text('Character remaining:' + text_max);            
    $('.comment').keyup(function() {
        var text_length = $('.reply:visible').find('textarea').val().length;        
        var text_remaining = text_max - text_length;

        $('.reply:visible').find('span').text('Character remaining:' + text_remaining);
    });        
    
    $('button[name=reply_btn]').click(function() {
        
        var text_length = $('.reply:visible').find('textarea').val().length;
        var text_val = $('.reply:visible').find('textarea').val();
        var requirement_id = $('#comment_requirement_id').val();
        var comment_id = $('.reply:visible').find('input[name=comment_id]').val();        
        var project_id = <?php if(isset($project_detail[0]['prj_id'])){ echo $project_detail[0]['prj_id']; } ?>;
        var module_id = $('#comment_module_id').val();
        if(text_length){            
            $.ajax({
                url:"<?php echo base_url('contributor/add_comment_reply') ?>",
                type:"post",
                dataType:"html",
                data:{'comment_text':text_val,'requirement_id':requirement_id,'comment_id':comment_id,'project_id':project_id,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){      

                    if(data=='success')
                    {
                        show_comments(2,requirement_id,module_id);                        
                    }
                    else
                    {
                        alert('Error Occurred');
                    }
                    
                }
            });
        }
    });
});
    $(".project_requirement").attr("data-count");
            
    function general_requirement()
    {       
        
        $("#general_requirement_frm").validate({
            
            rules: {
              
                general_requirement_title:{
                    required: true,                    
                    maxlength: 120,
                },
                general_requirement_desc:{
                    required: true,
                    maxlength: 500,
                },                  
                general_requirement_priority:{
                    required: true,
                }
            },
            messages:{
                general_requirement_title: {
                    required: "Requirement title is required",                                        
                    maxlength: "Requirement title must be less than 120 characters",
                },
                general_requirement_desc: {
                    required: "Requirement description is required",                    
                    maxlength: "Requirement description must be less than 500 characters",
                },                                
                general_requirement_priority:{
                    required: "Requirement priority is required",                    
                }
            },
        });
        
        var validated = $("#general_requirement_frm").valid();
        var project_url = $("#gr_project_url").val();        
        var general_requirement_title = $("#general_requirement_title").val();        
        var general_requirement_desc = $("#general_requirement_desc").val();        
        var general_requirement_priority = $("#general_requirement_priority").val();        
        
        if(validated)
        {
            $.ajax({
                url:"<?php echo base_url('contributor/add_general_requirement') ?>",
                type:"post",
                dataType:"html",
                data:{'project_url':project_url,'general_requirement_title':general_requirement_title,'general_requirement_desc':general_requirement_desc,'general_requirement_priority':general_requirement_priority,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){      
                    
                    if(data=='success')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        $(".gr_success").css("display","none");
                        $(".gr_error").text(data).css("display","block");
                    }
                }
             });
        }
    }
    
    
    function edit_general_requirement(requirement_id,unique)
    {                 
        
        $("#edit_general_requirement_frm"+unique).validate({
            
            rules: {
              
                edit_general_requirement_title:{
                    required: true,                    
                    maxlength: 120,
                },
                edit_general_requirement_desc:{
                    required: true,
                    maxlength: 500,
                },                  
                edit_general_requirement_priority:{
                    required: true,
                }
            },
            messages:{
                edit_general_requirement_title: {
                    required: "Requirement title is required",                                        
                    maxlength: "Requirement title must be less than 120 characters",
                },
                edit_general_requirement_desc: {
                    required: "Requirement description is required",                    
                    maxlength: "Requirement description must be less than 500 characters",
                },                                
                edit_general_requirement_priority:{
                    required: "Requirement priority is required",                    
                }
            },
        });
        
        var validated = $("#edit_general_requirement_frm"+unique).valid();
        var project_url = $("#edit_general_requirement_frm"+unique+" input[name=edit_gr_project_url]").val();        
        var general_requirement_title = $("#edit_general_requirement_frm"+unique+" input[name=edit_general_requirement_title]").val();        
        var general_requirement_desc = $("#edit_general_requirement_frm"+unique+" textarea[name=edit_general_requirement_desc]").val();        
        var general_requirement_priority = $("#edit_general_requirement_frm"+unique+" select[name=edit_general_requirement_priority]").val();        
        
        if(validated)
        {
            $.ajax({
                url:"<?php echo base_url('contributor/edit_general_requirement') ?>",
                type:"post",
                dataType:"html",
                data:{'requirement_id':requirement_id,'project_url':project_url,'general_requirement_title':general_requirement_title,'general_requirement_desc':general_requirement_desc,'general_requirement_priority':general_requirement_priority,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){      
                    
                    if(data=='success')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        $(".gr_success").css("display","none");
                        $(".gr_error").text(data).css("display","block");
                    }
                }
             });
        }
    }
    
    function module_requirement(form_id)
    {
        
        $("#"+form_id).validate({
            
            rules: {
              
                module_requirement_title:{
                    required: true,                    
                    maxlength: 120,
                },
                module_requirement_desc:{
                    required: true,
                    maxlength: 500,
                },                  
                module_requirement_priority:{
                    required: true,
                }
            },
            messages:{
                module_requirement_title: {
                    required: "Requirement title is required",                                        
                    maxlength: "Requirement title must be less than 120 characters",
                },
                module_requirement_desc: {
                    required: "Requirement description is required",                    
                    maxlength: "Requirement description must be less than 500 characters",
                },                                
                module_requirement_priority:{
                    required: "Requirement priority is required",                    
                }
            },
        });
        
        var validated = $("#"+form_id).valid();
        
        var project_url = $("#"+form_id+" input[name=project_url]").val();        
        var module_id = $("#"+form_id+" input[name=module_id]").val();        
        var module_requirement_title = $("#"+form_id+" input[name=module_requirement_title]").val();        
        var module_requirement_desc = $("#"+form_id+" textarea[name=module_requirement_desc]").val();        
        var module_requirement_priority = $("#"+form_id+" select[name=module_requirement_priority]").val();        
        
        if(validated)
        {
            $.ajax({
                url:"<?php echo base_url('contributor/add_module_requirement') ?>",
                type:"post",
                dataType:"html",
                data:{'project_url':project_url,'module_id':module_id,'module_requirement_title':module_requirement_title,'module_requirement_desc':module_requirement_desc,'module_requirement_priority':module_requirement_priority,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){      
                    
                    if(data=='success')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        $(".mr_success").css("display","none");
                        $(".mr_error").text(data).css("display","block");
                    }
                }
            });
        }
    }
    
    function edit_module_requirement(form_id)
    {
        
        $("#"+form_id).validate({
            
            rules: {
              
                module_requirement_title:{
                    required: true,                    
                    maxlength: 120,
                },
                module_requirement_desc:{
                    required: true,
                    maxlength: 500,
                },                  
                module_requirement_priority:{
                    required: true,
                }
            },
            messages:{
                module_requirement_title: {
                    required: "Requirement title is required",                                        
                    maxlength: "Requirement title must be less than 120 characters",
                },
                module_requirement_desc: {
                    required: "Requirement description is required",                    
                    maxlength: "Requirement description must be less than 500 characters",
                },                                
                module_requirement_priority:{
                    required: "Requirement priority is required",                    
                }
            },
        });
        
        var validated = $("#"+form_id).valid();        
        var project_url = $("#"+form_id+" input[name=project_url]").val();        
        var requirement_id = $("#"+form_id+" input[name=requirement_id]").val();        
        var module_id = $("#"+form_id+" input[name=module_id]").val();        
        var module_requirement_title = $("#"+form_id+" input[name=module_requirement_title]").val();        
        var module_requirement_desc = $("#"+form_id+" textarea[name=module_requirement_desc]").val();        
        var module_requirement_priority = $("#"+form_id+" select[name=module_requirement_priority]").val();        
        
        if(validated)
        {
            $.ajax({
                url:"<?php echo base_url('contributor/edit_module_requirement') ?>",
                type:"post",
                dataType:"html",
                data:{'project_url':project_url,'requirement_id':requirement_id,'module_id':module_id,'module_requirement_title':module_requirement_title,'module_requirement_desc':module_requirement_desc,'module_requirement_priority':module_requirement_priority,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){      
                    
                    if(data=='success')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        $(".mr_success").css("display","none");
                        $(".mr_error").text(data).css("display","block");
                    }
                }
             });
        }
    }
    
    function add_module()
    {
        $("#add_module_frm").validate({
            
            rules: {
              
                module_title:{
                    required: true,                    
                    maxlength: 120,
                },
                module_description:{
                    required: true,
                    maxlength: 500,
                },                                  
            },
            messages:{
                module_title: {
                    required: "Module title is required",                                        
                    maxlength: "Module title must be less than 120 characters",
                },
                module_description: {
                    required: "Module description is required",                    
                    maxlength: "Module description must be less than 500 characters",
                },                                                
            },
        });               
        
        var validated = $("#add_module_frm").valid();
        var project_url = $("#module_project_url").val();        
        var module_title = $("#module_title").val();        
        var module_description = $("#module_description").val();        
        
        if(validated)
        {
            $.ajax({
                url:"<?php echo base_url('contributor/add_module') ?>",
                type:"post",
                dataType:"html",
                data:{'project_url':project_url,'module_title':module_title,'module_description':module_description,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){      
                    
                    if(data!='error')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        $(".module_success").css("display","none");
                        $(".module_error").text(data).css("display","block");
                    }
                }
             });
        }
    }
    
    
    function edit_module(form_id)
    {
        
        $("#"+form_id).validate({
            
            rules: {
              
                module_title:{
                    required: true,                    
                    maxlength: 120,
                },
                module_description:{
                    required: true,
                    maxlength: 500,
                },                                  
            },
            messages:{
                module_title: {
                    required: "Module title is required",                                        
                    maxlength: "Module title must be less than 120 characters",
                },
                module_description: {
                    required: "Module description is required",                    
                    maxlength: "Module description must be less than 500 characters",
                },                                                
            },
        });               
        
        var validated = $("#"+form_id).valid();
        var module_id = $("#"+form_id+" input[name=module_id]").val();        
        var module_title = $("#"+form_id+" input[name=module_title]").val();        
        var module_description = $("#"+form_id+" textarea[name=module_description]").val();        
        
        if(validated)
        {
            $.ajax({
                url:"<?php echo base_url('contributor/edit_module') ?>",
                type:"post",
                dataType:"html",
                data:{'module_id':module_id,'module_title':module_title,'module_description':module_description,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){      
                    
                    if(data=='success')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        $(".module_success").css("display","none");
                        $(".module_error").text(data).css("display","block");
                    }
                }
             });
        }
    }
    
    function submit_invitations()
    {
        
        jQuery.validator.addMethod(
            "multiemail",
            function (value, element) {
                var email = value.split(/[,]+/); // split element by , and ;
                valid = true;
                for (var i in email) {
                    value = email[i];
                    valid = valid && jQuery.validator.methods.email.call(this, $.trim(value), element);
                }
                return valid;
            },
            jQuery.validator.messages.multiemail
        );
        $("#send_invite_frm").validate({
            
            rules: {
              
                invitation_emails:{
                    required: true,
                    multiemail: true,
                    maxlength: 500,
                },                
            },
            messages:{
                invitation_emails: {
                    required: "Emails are required",                    
                    multiemail: "Invalid email format",
                    maxlength: "maximum 500 characters allowed",
                },                
            },
        });        
        var validated = $("#send_invite_frm").valid();
        var project_url = $("#invite_project_url").val();        
        var invitation_emails = $("#invitation_emails").val();        
        
        if(validated)
        {
            $.ajax({
                url:"<?php echo base_url('contributor/send_invitation') ?>",
                type:"post",
                dataType:"html",
                data:{'project_url':project_url,'invitation_emails':invitation_emails,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){      
                    
                    if(data=='success')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        $(".invitation_error").css("display","none");
                        $(".invitation_success").css("display","none");
                        $(".invitation_error").text(data).css("display","block");
                    }
                }
             });
        }
    }
            $(".forgatp").click(function () {
                $("#detail").hide();
                $("#edits").show();

            });
            $(".forgatp").click(function () {
                $("#detail2").hide();
                $("#edits2").show();

            });
            $(".invi").click(function () {
                $("#pro").hide();
                $("#invite").show();

            });
            $(".save").click(function () {
                $("#edits").hide();
                $("#detail").show();

            });
            
    function show_comments(sort_by,req_id,module_id)
    {
        
        if(req_id)
        {
            $.ajax({
                url:"<?php echo base_url('contributor/requirement_comments') ?>",
                type:"post",
                dataType:"html",
                data:{'sort_by':sort_by,'requirement_id':req_id,'module_id':module_id,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){                          
                    //alert(data);
                    if(data!='empty')
                    {    
                        if(!module_id)
                        {
                            $(".general_content_comment").empty();
                            $(".general_content_comment").append(data);
                            $(".require_tab").hide();
                            $(".general_content_comment").show();
                        }
                        else
                        {
                            $(".module_content_comment").empty();
                            $(".module_content_comment").append(data);
                            $(".require_tab").hide();
                            $(".module_content_comment").show();
                        }                        
                    }                    
                }
            });
        }
    }
            
//            $(".generic").click(function () {
//                $(".content_comment").hide();
//                $(".require_tab").show();
//
//            });


        </script>
        <script>

            $(".button-dropdown").click(function () {

                $(".dropdown-menu li:first-child").addClass("active");
                //$("#tab_d1").addClass("active");                
                //$("#tab_d2").removeClass("active");
                //$("#tab_d3").removeClass("active");
            });
            $(function () {
                // The user clicks anywhere in the document
                $(document).click(function (e) {
                    // If a dropdown has a class active AND if the dropdown or the link is not the target of the click
                    if ($(".dropdown-menu li").hasClass("active") && !$(".dropdown-menu li").is(e.target)) {
                        // Remove class active
                        $(".dropdown-menu li.active").removeClass("active");
                    }

                });

            });
            var i=0;
            $(".module_menu").click(function () {
                i++;
                if(i%2 != 0){
                    $(".nav-tabs li ul").show();                    
                } else {
                    $(".nav-tabs li ul").hide();
                }
                //document.getElementsByTagName("dropdown-menu")[0].removeAttribute("style");

            });
            
           
        </script>
    </body>
</html>