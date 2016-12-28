<?php echo $head ?>
<?php echo $header ?>
        <!--content start-->
        <div class="content">
            <div class="container">
                <div class="col-sm-12 heading">
                    <h4>CRUISE DASHBOARD</h4>
                </div>
            </div>
            <div class="con_head text-center">
                <h2>PROJECT OVERVIEW</h2>
            </div>
            

            <?php if(!$owner_projects_list && !$contributor_projects_list && !$other_projects_list && !$archived_projects_list){ ?>
                        <!--Sections start-->
            <section>
                <div class="container">
                    <div class="col-sm-12">
                        <div class="cre_btn  pull-right">
                            <button type="submit" class="btn buttons" data-toggle="modal" data-target="#myModal2"> <i class="fa fa-plus" aria-hidden="true"></i>Create Project</button>

                            <!--//////////////////create project popup start////////////////////-->
                            <div class="modal fade" id="myModal2" role="dialog">
                                <div class="modal-dialog" >

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal"><img src="images/x.png" alt="close"/></button>
                                        <div class="modal-body" id="sign_up">
                                            <div class="login text-center" id="pro">
                                                <h1>Create New Project</h1>                                                                                               
                                                <div class="con_mail">
                                                    <?php echo form_open('dashboard',array('name'=>'add_project_frm','id'=>'add_project_frm','method'=>'POST'));  ?>
                                                    <input type="text" placeholder="Project Title *" name="project_title" id="project_title" />
                                                    <textarea placeholder="Project Description * (max 500 Words)" name="project_description" id="project_description" class="textare"></textarea>
                                                    <button type="button" class="btn fill_btn"  data-dismiss="modal">Cancel</button>
                                                    <!--<button type="button" class="btn fill_btn" onclick="">Send Invite</button>-->
                                                    <button type="button" name="submit_project" id="submit_project" onclick="submit_projects()" class="btn fill_btn">Submit</button>
                                                    <?php echo form_close() ?>
                                                </div>
                                            </div>
                                            <div class="edit_con login text-center" id="invite" style="display: none">
                                                <h1>Send Invites</h1>
                                                <div class="alert fade in alert-success project_success" style="display:none">
                                                        <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                    </div>                                                
                                                <div class="alert fade in alert-danger myalert project_error" style="display:none" >
                                                        <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                    </div>                                                
                                                <div class="con_mail">
                                                    <?php echo form_open('dashboard',array('name'=>'send_invitation_frm','id'=>'send_invitation_frm','method'=>'POST'));  ?>
                                                    <input type="hidden" name="project_send_id" id="project_send_id" value="" >
                                                    <textarea placeholder="example1@email.com,example2@email.com,example3@email.com" name="invitation_emails" id="invitation_emails"></textarea>
                                                    <button type="button" class="btn fill_btn" onclick="Hideshow(invite.id,pro.id)">Back</button>
                                                    <button type="button" name="submit_invite" id="submit_invite" onclick="submit_invitations($(this).closest('form').attr('id'));" class="btn fill_btn">Send</button>
                                                    <button type="button" class="btn fill_btn"  data-dismiss="modal">Cancel</button>
                                                    <?php echo form_close() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--//////////////////selects media popup start////////////////////-->
                <div class="container">
                    <div class="col-sm-12 media_con">
                        <div class="col-sm-12">
                            <div class="project_desc">
                                <h3 style="text-align: center;">No Project Found</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!--//////////////////selects media popup end////////////////////-->
                <div class="container main_desc">
                    <div class="col-sm-12">
                        <div class="project_con">
                            <div class="col-sm-3 heading_pro first_head">
                                <h5>Projects you own</h5>
                            </div>
                            <div class="col-sm-6 heading_pro">
                                <h5>Brief Overview</h5>
                            </div>
                            <div class="col-sm-3 heading_pro last_head">
                                <h5>Date Posted</h5>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="project_desc">
                            <h1 style="text-align: center;">No Project Found</h1>
                        </div>
                    </div>
                </div>
            </section>
            <?php } ?>
            <?php if($owner_projects_list){ ?>
            
            <!--Sections start-->
            <section>
                <div class="container">
                    <div class="col-sm-12">
                        <div class="cre_btn  pull-right">
                            <button type="submit" class="btn buttons" data-toggle="modal" data-target="#myModal2"> <i class="fa fa-plus" aria-hidden="true"></i>Create Project</button>
                            <button type="submit" class="btn buttons" data-toggle="modal" id="view_owner_project" data-target="" onclick="$(this).attr('data-target','#myModal6'+$('input[name=owner_project_selected]:checked').prop('id').substr(14));"> <i class="fa fa-eye" aria-hidden="true"></i>View Project</button>

                            <!--//////////////////create project popup start////////////////////-->
                            <div class="modal fade" id="myModal2" role="dialog">
                                <div class="modal-dialog" >

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal"><img src="images/x.png" alt="close"/></button>
                                        <div class="modal-body" id="sign_up">
                                            <div class="login text-center" id="pro">
                                                <h1>Create New Project</h1>                                                                                               
                                                <div class="con_mail">
                                                    <?php echo form_open('dashboard',array('name'=>'add_project_frm','id'=>'add_project_frm','method'=>'POST'));  ?>
                                                    <input type="text" placeholder="Project Title *" name="project_title" id="project_title" />
                                                    <textarea placeholder="Project Description * (max 500 Words)" name="project_description" id="project_description" class="textare"></textarea>
                                                    <button type="button" class="btn fill_btn"  data-dismiss="modal">Cancel</button>
                                                    <!--<button type="button" class="btn fill_btn" onclick="">Send Invite</button>-->
                                                    <button type="button" name="submit_project" id="submit_project" onclick="submit_projects()" class="btn fill_btn">Submit</button>
                                                    <?php echo form_close() ?>
                                                </div>
                                            </div>
                                            <div class="edit_con login text-center" id="invite" style="display: none">
                                                <h1>Send Invites</h1>
                                                <div class="alert fade in alert-success project_success" style="display:none">
                                                        <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                    </div>                                                
                                                <div class="alert fade in alert-danger myalert project_error" style="display:none" >
                                                        <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                    </div>                                                
                                                <div class="con_mail">
                                                    <?php echo form_open('dashboard',array('name'=>'send_invitation_frm','id'=>'send_invitation_frm','method'=>'POST'));  ?>
                                                    <input type="hidden" name="project_send_id" id="project_send_id" value="" >
                                                    <textarea placeholder="example1@email.com,example2@email.com,example3@email.com" name="invitation_emails" id="invitation_emails"></textarea>
                                                    <button type="button" class="btn fill_btn" onclick="Hideshow(invite.id,pro.id)">Back</button>
                                                    <button type="button" name="submit_invite" id="submit_invite" onclick="submit_invitations($(this).closest('form').attr('id'));" class="btn fill_btn">Send</button>
                                                    <button type="button" class="btn fill_btn"  data-dismiss="modal">Cancel</button>
                                                    <?php echo form_close() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--//////////////////create project popup end////////////////////-->
                            
                            <button type="button" class="btn buttons" id="delete_project" onclick="if(!confirm('Are sure you want to delete this project ?')){ return false; };delete_projects();"> <i class="fa fa-trash" aria-hidden="true"></i>Delete</button>
                            <button type="button" class="btn buttons" id="archive_project" onclick="archive_projects($('input[name=owner_project_selected]:checked').val())"> <i class="fa fa-file-text-o" aria-hidden="true"></i>Archive</button>
                        </div>
                    </div>
                </div>
                <!--//////////////////selects media popup start////////////////////-->
                <div class="container">
                    <div class="col-sm-12 media_con">
                        <Select id="media">
                            <option>Projects you own</option>
                            <?php foreach ($owner_projects_list as $my_project){ ?>
                            <option value="<?php echo 'res_prj_'.$my_project['prj_id'] ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> <?php echo $my_project['prj_title'] ?></option>
                            <?php } ?>                            
                        </Select>
                        <?php foreach ($owner_projects_list as $my_project){ ?>
                        <?php echo project_list($my_project['prj_id'],10); ?>
                        <div id="<?php echo 'res_prj_'.$my_project['prj_id'] ?>" class="contents" style="display:none">  
                            <div class="project_desc">
                                <div class="col-sm-3 pro_content">
                                    <h5><input type="radio" name="owner_project_selected" id="project_detail<?php echo $my_project['prj_id'] ?>10" value="<?php echo $my_project['prj_id'] ?>" /> <a href="<?php echo site_url("projects/".$my_project['prj_url']); ?>" ><?php echo $my_project['prj_title'] ?></a></h5>
                                </div>
                                <div class="col-sm-6 pro_content miiddle_con">
                                    <?php echo module_list($my_project['prj_id'],1) ?>
                                </div>
                                <div class="col-sm-3 pro_content last_head">
                                    <h5><?php echo date('d F, Y', strtotime($my_project['insertdatetime'])) ?></h5>
                                </div>
                            </div> </div>                        
                        <?php } ?>
                    </div>
                </div>
                <!--//////////////////selects media popup end////////////////////-->
                <div class="container main_desc">
                    <div class="col-sm-12">
                        <div class="project_con">
                            <div class="col-sm-3 heading_pro first_head">
                                <h5>Projects you own</h5>
                            </div>
                            <div class="col-sm-6 heading_pro">
                                <h5>Brief Overview</h5>
                            </div>
                            <div class="col-sm-3 heading_pro last_head">
                                <h5>Date Posted</h5>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($owner_projects_list as $my_project){ ?>
                    <?php echo project_list($my_project['prj_id'],20); ?>
                    <div class="col-sm-12">
                        <div class="project_desc">
                            <div class="col-sm-3 pro_content">                                
                                <h5><input type="radio" name="owner_project_selected" id="project_detail<?php echo $my_project['prj_id'] ?>20" value="<?php echo $my_project['prj_id'] ?>" /> <a href="<?php echo site_url("projects/".$my_project['prj_url']); ?>" ><?php echo $my_project['prj_title'] ?></a></h5>
                            </div>                            
                            <div class="col-sm-6 pro_content miiddle_con">
                            <?php echo module_list($my_project['prj_id'],2) ?>
                            </div>
                            <div class="col-sm-3 pro_content last_head">
                                <h5><?php echo date('d F, Y', strtotime($my_project['insertdatetime'])) ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </section>
            <!--section end-->
            <?php } ?>
            <?php if($contributor_projects_list){ ?>
            <!--section start-->
            <section>
                <div class="container">
                    <div class="col-sm-12">
                        <div class="cre_btn  pull-right">
                            <?php if(!$owner_projects_list){ ?>
                                <button type="submit" class="btn buttons" data-toggle="modal" data-target="#myModal2"> <i class="fa fa-plus" aria-hidden="true"></i>Create Project</button>
                                <!--//////////////////create project popup start////////////////////-->
                            <div class="modal fade" id="myModal2" role="dialog">
                                <div class="modal-dialog" >

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal"><img src="images/x.png" alt="close"/></button>
                                        <div class="modal-body" id="sign_up">
                                            <div class="login text-center" id="pro">
                                                <h1>Create New Project</h1>                                                                                               
                                                <div class="con_mail">
                                                    <?php echo form_open('dashboard',array('name'=>'add_project_frm','id'=>'add_project_frm','method'=>'POST'));  ?>
                                                    <input type="text" placeholder="Project Title *" name="project_title" id="project_title" />
                                                    <textarea placeholder="Project Description * (max 500 Words)" name="project_description" id="project_description" class="textare"></textarea>
                                                    <button type="button" class="btn fill_btn"  data-dismiss="modal">Cancel</button>
                                                    <!--<button type="button" class="btn fill_btn" onclick="">Send Invite</button>-->
                                                    <button type="button" name="submit_project" id="submit_project" onclick="submit_projects()" class="btn fill_btn">Submit</button>
                                                    <?php echo form_close() ?>
                                                </div>
                                            </div>
                                            <div class="edit_con login text-center" id="invite" style="display: none">
                                                <h1>Send Invites</h1>
                                                <div class="alert fade in alert-success project_success" style="display:none">
                                                        <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                    </div>                                                
                                                <div class="alert fade in alert-danger myalert project_error" style="display:none" >
                                                        <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                    </div>                                                
                                                <div class="con_mail">
                                                    <?php echo form_open('dashboard',array('name'=>'send_invitation_frm','id'=>'send_invitation_frm','method'=>'POST'));  ?>
                                                    <input type="hidden" name="project_send_id" id="project_send_id" value="" >
                                                    <textarea placeholder="example1@email.com,example2@email.com,example3@email.com" name="invitation_emails" id="invitation_emails"></textarea>
                                                    <button type="button" class="btn fill_btn" onclick="Hideshow(invite.id,pro.id)">Back</button>
                                                    <button type="button" name="submit_invite" id="submit_invite" onclick="submit_invitations($(this).closest('form').attr('id'));" class="btn fill_btn">Send</button>
                                                    <button type="button" class="btn fill_btn"  data-dismiss="modal">Cancel</button>
                                                    <?php echo form_close() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--//////////////////create project popup end////////////////////-->
                            <?php $owner_projects_list=1;  } ?>
                            <button type="submit" class="btn buttons" data-toggle="modal" id="view_contributor_project" data-target="" onclick="$(this).attr('data-target','#myModal6'+$('input[name=contributor_project_selected]:checked').prop('id').substr(14));"> <i class="fa fa-eye" aria-hidden="true"></i>View Project</button>
                            <button type="submit" class="btn buttons" id="withdraw_project"> <i class="fa fa-comment" aria-hidden="true"></i>Withdraw</button>
                            <button type="button" class="btn buttons" id="archive_project" onclick="archive_projects($('input[name=contributor_project_selected]:checked').val())"> <i class="fa fa-file-text-o" aria-hidden="true"></i>Archive</button>
                        </div>
                    </div>
                </div>
                <!--//////////////////selects media popup start////////////////////-->
                <div class="container">
                    <div class="col-sm-12 media_con">
                        <Select id="media2">
                            <option>Projects As Contributors</option>
                            <?php foreach ($contributor_projects_list as $contributor_project){ ?>
                            <option value="<?php echo 'res_prj_'.$contributor_project['prj_id'] ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> <?php echo $contributor_project['prj_title'] ?></option>
                            <?php } ?>                            
                        </Select>
                        <?php foreach ($contributor_projects_list as $contributor_project){ ?>
                        <?php echo project_list($contributor_project['prj_id'],10); ?>
                        <div id="<?php echo 'res_prj_'.$contributor_project['prj_id'] ?>" class="contents" style="display:none">  
                            <div class="project_desc">
                                <div class="col-sm-3 pro_content">
                                    <h5><input type="radio" name="contributor_project_selected" id="project_detail<?php echo $contributor_project['prj_id'] ?>10" value="<?php echo $contributor_project['prj_id'] ?>" /> <a href="<?php echo site_url("projects/".$contributor_project['prj_url']); ?>" ><?php echo $contributor_project['prj_title'] ?></a></h5>
                                </div>
                                <div class="col-sm-6 pro_content miiddle_con">
                                    <?php echo module_list($contributor_project['prj_id'],3) ?>
                                </div>
                                <div class="col-sm-3 pro_content last_head">
                                    <h5><?php echo date('d F, Y', strtotime($contributor_project['insertdatetime'])) ?></h5>
                                </div>
                            </div> </div>
                    <?php } ?>
                    </div>
                </div>
                <!--//////////////////selects media popup end////////////////////-->
                <div class="container main_desc">
                    <div class="col-sm-12">
                        <div class="project_con">
                            <div class="col-sm-3 heading_pro first_head">
                                <h5>Projects As Contributors</h5>
                            </div>
                            <div class="col-sm-6 heading_pro">
                                <h5>Brief Overview</h5>
                            </div>
                            <div class="col-sm-3 heading_pro last_head">
                                <h5>Date Posted</h5>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($contributor_projects_list as $contributor_project) { ?>
                    <?php echo project_list($contributor_project['prj_id'],20); ?>
                    <div class="col-sm-12">
                        <div class="project_desc">
                            <div class="col-sm-3 pro_content">
                                <h5><input type="radio" name="contributor_project_selected" id="project_detail<?php echo $contributor_project['prj_id'] ?>20" value="<?php echo $contributor_project['prj_id'] ?>" /> <a href="<?php echo site_url("projects/".$contributor_project['prj_url']); ?>" ><?php echo $contributor_project['prj_title'] ?></a></h5>
                            </div>
                            <div class="col-sm-6 pro_content miiddle_con">
                                <?php echo module_list($contributor_project['prj_id'],4) ?>
                            </div>
                            <div class="col-sm-3 pro_content last_head">
                                <h5><?php echo date('d F, Y', strtotime($contributor_project['insertdatetime'])) ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php } ?>                    
                </div>
            </section>
            <!--section end-->
            <?php } ?>
            <?php if($other_projects_list){ ?>
            <!--section start-->
            <section>
                <div class="container">
                    <div class="col-sm-12">
                        <div class="cre_btn  pull-right">
                            <?php if(!$owner_projects_list){ ?>
                                <button type="submit" class="btn buttons" data-toggle="modal" data-target="#myModal2"> <i class="fa fa-plus" aria-hidden="true"></i>Create Project</button>
                                <!--//////////////////create project popup start////////////////////-->
                            <div class="modal fade" id="myModal2" role="dialog">
                                <div class="modal-dialog" >

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal"><img src="images/x.png" alt="close"/></button>
                                        <div class="modal-body" id="sign_up">
                                            <div class="login text-center" id="pro">
                                                <h1>Create New Project</h1>                                                                                               
                                                <div class="con_mail">
                                                    <?php echo form_open('dashboard',array('name'=>'add_project_frm','id'=>'add_project_frm','method'=>'POST'));  ?>
                                                    <input type="text" placeholder="Project Title *" name="project_title" id="project_title" />
                                                    <textarea placeholder="Project Description * (max 500 Words)" name="project_description" id="project_description" class="textare"></textarea>
                                                    <button type="button" class="btn fill_btn"  data-dismiss="modal">Cancel</button>
                                                    <!--<button type="button" class="btn fill_btn" onclick="">Send Invite</button>-->
                                                    <button type="button" name="submit_project" id="submit_project" onclick="submit_projects()" class="btn fill_btn">Submit</button>
                                                    <?php echo form_close() ?>
                                                </div>
                                            </div>
                                            <div class="edit_con login text-center" id="invite" style="display: none">
                                                <h1>Send Invites</h1>
                                                <div class="alert fade in alert-success project_success" style="display:none">
                                                        <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                    </div>                                                
                                                <div class="alert fade in alert-danger myalert project_error" style="display:none" >
                                                        <i class="icon-remove close" data-dismiss="alert"></i>                                                        
                                                    </div>                                                
                                                <div class="con_mail">
                                                    <?php echo form_open('dashboard',array('name'=>'send_invitation_frm','id'=>'send_invitation_frm','method'=>'POST'));  ?>
                                                    <input type="hidden" name="project_send_id" id="project_send_id" value="" >
                                                    <textarea placeholder="example1@email.com,example2@email.com,example3@email.com" name="invitation_emails" id="invitation_emails"></textarea>
                                                    <button type="button" class="btn fill_btn" onclick="Hideshow(invite.id,pro.id)">Back</button>
                                                    <button type="button" name="submit_invite" id="submit_invite" onclick="submit_invitations($(this).closest('form').attr('id'));" class="btn fill_btn">Send</button>
                                                    <button type="button" class="btn fill_btn"  data-dismiss="modal">Cancel</button>
                                                    <?php echo form_close() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--//////////////////create project popup end////////////////////-->
                            <?php } ?>
                            <button type="button" class="btn buttons" data-toggle="modal" id="view_other_project"  data-target="" onclick="$(this).attr('data-target','#myModal6'+$('input[name=other_project_selected]:checked').prop('id').substr(14));" > <i class="fa fa-eye" aria-hidden="true"></i>View Project</button>
                            <button type="button" class="btn buttons" id="contribute_project" onclick="contribute_projects()" > <i class="fa fa-share-alt" aria-hidden="true"></i>Contribute</button>
                            <button type="button" class="btn buttons" id="archive_project" onclick="archive_projects($('input[name=other_project_selected]:checked').val())"> <i class="fa fa-file-text-o" aria-hidden="true"></i>Archive</button>
                        </div>
                    </div>
                </div>
                <!--//////////////////selects media popup start////////////////////-->
                <div class="container">
                    <div class="col-sm-12 media_con">
                        <Select id="media3">
                            <option>Other Projects</option>
                            <?php foreach ($other_projects_list as $other_project) { ?>
                            <option value="<?php echo 'res_prj_'.$other_project['prj_id'] ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> <?php echo $other_project['prj_title'] ?></option>
                            <?php } ?>
                        </Select>
                        <?php foreach ($other_projects_list as $other_project) { ?>
                        <?php echo project_list($other_project['prj_id'],10); ?>
                        <div id="<?php echo 'res_prj_'.$other_project['prj_id'] ?>" class="contents" style="display:none">  
                            <div class="project_desc">
                                <div class="col-sm-3 pro_content">
                                    <h5><input type="radio" name="other_project_selected" id="project_detail<?php echo $other_project['prj_id'] ?>10" value="<?php echo $other_project['prj_id'] ?>" /> <a href="<?php echo site_url("projects/".$other_project['prj_url']); ?>" ><?php echo $other_project['prj_title'] ?></a></h5>
                                </div>
                                <div class="col-sm-6 pro_content miiddle_con">
                                    <?php echo module_list($other_project['prj_id'],5) ?>
                                </div>
                                <div class="col-sm-3 pro_content last_head">
                                    <h5><?php echo date('d F, Y', strtotime($other_project['insertdatetime'])) ?></h5>
                                </div>
                            </div>
                        </div>
                        <?php } ?>                        
                    </div>
                </div>
                <!--//////////////////selects media popup end////////////////////-->
                <div class="container main_desc">
                    <div class="col-sm-12">
                        <div class="project_con">
                            <div class="col-sm-3 heading_pro first_head">
                                <h5>Other Projects</h5>
                            </div>
                            <div class="col-sm-6 heading_pro">
                                <h5>Brief Overview</h5>
                            </div>
                            <div class="col-sm-3 heading_pro last_head">
                                <h5>Date Posted</h5>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($other_projects_list as $other_project) { ?>
                    <?php echo project_list($other_project['prj_id'],20); ?>
                    <div class="col-sm-12">
                        <div class="project_desc">
                            <div class="col-sm-3 pro_content">
                                <h5><input type="radio" name="other_project_selected" id="project_detail<?php echo $other_project['prj_id'] ?>20" value="<?php echo $other_project['prj_id'] ?>" /> <a href="<?php echo site_url("projects/".$other_project['prj_url']); ?>" ><?php echo $other_project['prj_title'] ?></a></h5>
                            </div>
                            <div class="col-sm-6 pro_content miiddle_con">
                                <?php echo module_list($other_project['prj_id'],6) ?>  
                            </div>
                            <div class="col-sm-3 pro_content last_head">
                                <h5><?php echo date('d F, Y', strtotime($other_project['insertdatetime'])) ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php } ?>                    
                </div>
            </section>
            <!--section end-->
            <?php } ?>
            <?php if($archived_projects_list){ ?>
            <!--Sections start-->
            <section>                
                <div class="container">
                    <div class="col-sm-12 media_con">
                        <Select id="media4">
                            <option>Archived Projects</option>
                            <?php foreach ($archived_projects_list as $archived_project){ ?>
                            <option value="<?php echo 'res_prj_'.$archived_project['prj_id'] ?>"><i class="fa fa-circle-o" aria-hidden="true"></i> <?php echo $archived_project['prj_title'] ?></option>
                            <?php } ?>                            
                        </Select>
                        <?php foreach ($archived_projects_list as $archived_project){ ?>
                        <?php echo project_list($archived_project['prj_id'],10); ?>
                        <div id="<?php echo 'res_prj_'.$archived_project['prj_id'] ?>" class="contents" style="display:none">  
                            <div class="project_desc">
                                <div class="col-sm-6 pro_content miiddle_con">
                                    <h5> <a href="<?php echo site_url("projects/".$archived_project['prj_url']); ?>" ><?php echo $archived_project['prj_title'] ?></a></h5>
                                </div>                                
                                <div class="col-sm-6 pro_content last_head">
                                    <h5><a href="<?php echo site_url("dashboard/project_unarchive/".base64_encode($archived_project['prj_id'])); ?>" >Archived</a></h5>
                                </div>
                            </div> </div>                        
                        <?php } ?>
                    </div>
                </div>
                <!--//////////////////selects media popup end////////////////////-->
                <div class="container main_desc">
                    <div class="col-sm-12">
                        <div class="project_con">
                            <div class="col-sm-6 heading_pro first_head">
                                <h5>Archived Projects</h5>
                            </div>
                            
                            <div class="col-sm-6 heading_pro last_head">
                                <h5>Status</h5>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($archived_projects_list as $archived_project){ ?>
                    <?php echo project_list($archived_project['prj_id'],20); ?>
                    <div class="col-sm-12">
                        <div class="project_desc">
                            <div class="col-sm-6 pro_content">                                
                                <h5> <a href="<?php echo site_url("projects/".$archived_project['prj_url']); ?>" ><?php echo $archived_project['prj_title'] ?></a></h5>
                            </div>                                                        
                            <div class="col-sm-6 pro_content last_head">
                                <h5><a href="<?php echo site_url("dashboard/project_unarchive/".base64_encode($archived_project['prj_id'])); ?>" >Archived</a></h5>
                            </div>
                        </div>
                    </div>
                    <?php } ?>                    
                </div>
            </section>
            <!--section end-->
            <?php } ?>
            <!--content end-->

        </div>
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
             $(function () {
                $('#media4').change(function () {
                    $('.contents').hide();
                    $('#' + $(this).val()).show();
                });
            });
            $("#delete_project").click(function(){
                if(!$('input[name=owner_project_selected]:checked').val())
                {
                    alert("Please select atleast one project to delete");
                }                
            });            
            $("#view_owner_project").click(function(){
                if(!$('input[name=owner_project_selected]:checked').val())
                {
                    alert("Please select atleast one project to view");
                }
            });
            $("#view_contributor_project").click(function(){
                if(!$('input[name=contributor_project_selected]:checked').val())
                {
                    alert("Please select atleast one project to view");
                }
            });
            $("#withdraw_project").click(function(){
                if(!$('input[name=contributor_project_selected]:checked').val())
                {
                    alert("Please select atleast one project to withdraw");
                }
                else
                {
                    if(!confirm('Are sure you want to withdraw from this project ?')){ return false; };
                    withdraw_user();
                }
            });
            $("#view_other_project").click(function(){
                if(!$('input[name=other_project_selected]:checked').val())
                {
                    alert("Please select atleast one project to view");
                }
            });
            $("#contribute_project").click(function(){
                if(!$('input[name=other_project_selected]:checked').val())
                {
                    alert("Please select atleast one project to contribute");
                }
            });
        </script>
        <script>
            function Hideshow(h , s) {             
                $('#'+h).hide();
                $('#'+s).show();
            }                        
        </script>
<script type="text/javascript">
    //validation form
    $(document).ready(function () {

$('.alert-success').fadeOut(3000).css("display","none");
$('.alert-danger').fadeOut(3000).css("display","none");

        $("#add_project_frm").validate({
            
            rules: {
              
                project_title:{
                    required: true,                    
                    maxlength: 120,
                },
                project_description:{
                    required: true,
                    maxlength: 500,
                },                  
            },
            messages:{
                project_title: {
                    required: "Project title is required",                                        
                    maxlength: "Project title must be less than 120 characters",
                },
                project_description: {
                    required: "Project description is required",                    
                    maxlength: "Project description must be less than 500 characters",
                },                                
            },
        });
 
        $('.modal').on('hidden.bs.modal', function () {
           location.reload(true);
       })
    });
    
    
    function submit_projects()
    {
        $(".alert").css("display","none");        
        var validated = $("#add_project_frm").valid();
        var project_title = $("#project_title").val();
        var project_description = $("#project_description").val();
        
        if(validated)
        {
            Hideshow(pro.id,invite.id);
            $.ajax({
                url:"<?php echo base_url('dashboard/add_project') ?>",
                type:"post",
                dataType:"html",
                data:{'project_title':project_title,'project_description':project_description,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){                                        
                    if(data && data != 'fail')
                    {
                        $("#project_send_id").val(data);
                        $(".project_success").text('Project successfully added').css("display","block");
                    }
                    else
                    {
                        $(".project_error").text('Error Occurred. Try Again!').css("display","block");
                    }
                }
            });
        }
    }
    
    function edit_projects(form_id)
    {
        
        
        $("#"+form_id).validate({
            
            rules: {
              
                edit_project_title:{
                    required: true,                    
                    maxlength: 120,
                },
                edit_project_description:{
                    required: true,
                    maxlength: 500,
                },                  
            },
            messages:{
                edit_project_title: {
                    required: "Project title is required",                                        
                    maxlength: "Project title must be less than 120 characters",
                },
                edit_project_description: {
                    required: "Project description is required",                    
                    maxlength: "Project description must be less than 500 characters",
                },                                
            },
            
        });
        var validated = $("#"+form_id).valid();
        var form_name = 'edit_project_frm';
        var unique = form_id.substr(form_name.length);
        var project_id = $("#edit_project_id"+unique).val();
        var project_title = $("#edit_project_title"+unique).val();
        var project_description = $("#edit_project_description"+unique).val();        
        if(validated && form_id)
        {            
            $.ajax({
                url:"<?php echo base_url('dashboard/edit_project') ?>",
                type:"post",
                dataType:"html",
                data:{'project_id':project_id,'project_title':project_title,'project_description':project_description,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){                    
                    
                    
                    if(data=='success')
                    {
                        
                        Hideshow('edits'+unique,'detail'+unique);
                        $('#pro_title'+unique).text(project_title);
                        $('#pro_desc'+unique).text(project_description);
                        $(".edit_project_success").text('Project successfully updated').css("display","block");
                    }
                    else
                    {   Hideshow('edits'+unique,'detail'+unique);        
                        $(".edit_project_error").text('Error Occurred. Try Again!').css("display","block");
                    }
                }
             });
        }
    }
    
    function edit_modules(form_id)
    {
        
        
        $("#"+form_id).validate({
            
            rules: {
              
                edit_module_title:{
                    required: true,                    
                    maxlength: 120,
                },
                edit_module_description:{
                    required: true,
                    maxlength: 500,
                },                  
            },
            messages:{
                edit_module_title: {
                    required: "Module title is required",                                        
                    maxlength: "Module title must be less than 120 characters",
                },
                edit_module_description: {
                    required: "Module description is required",                    
                    maxlength: "Module description must be less than 500 characters",
                },                                
            },
            
        });
        var validated = $("#"+form_id).valid();
        var form_name = 'edit_module_frm';
        var unique = form_id.substr(form_name.length);
        var module_id = $("#edit_module_id"+unique).val();
        var module_title = $("#edit_module_title"+unique).val();
        var module_description = $("#edit_module_description"+unique).val();        
        if(validated && form_id)
        {            
            $.ajax({
                url:"<?php echo base_url('dashboard/edit_module') ?>",
                type:"post",
                dataType:"html",
                data:{'module_id':module_id,'module_title':module_title,'module_description':module_description,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){                    
                    
                    
                    if(data=='success')
                    {
                        
                        Hideshow('edits'+unique,'detail'+unique);
                        $('#mo_title'+unique).text(module_title);
                        $('#mo_desc'+unique).text(module_description);
                        $(".module_success").text('Module successfully updated').css("display","block");
                    }
                    else
                    {   Hideshow('edits'+unique,'detail'+unique);        
                        $(".module_error").text('Error Occurred. Try Again!').css("display","block");
                    }
                }
             });
        }
    }
    
    function submit_invitations(form_id)
    {
//        $(".project_error").css("display","none");
//        $(".project_success").css("display","none");
        var form_name = 'send_invitation_frm';
        var unique = form_id.substr(form_name.length);        
        
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
        $("#"+form_id).validate({
            
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
        var validated = $("#"+form_id).valid();
        var project_id = $("#project_send_id"+unique).val();        
        var invitation_emails = $("#invitation_emails"+unique).val();        
        
        if(validated)
        {
            $.ajax({
                url:"<?php echo base_url('dashboard/send_invitation') ?>",
                type:"post",
                dataType:"html",
                data:{'project_id':project_id,'invitation_emails':invitation_emails,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){      
                    
                    if(data=='success')
                    {
                        location.reload(true);
                        //$(".project_error").css("display","none");
                        //$(".project_success").text('Invitations successfully sent').css("display","block");
                    }
                    else
                    {
                        $(".project_error").css("display","none");
                        $(".project_success").css("display","none");
                        $(".project_error").text(data).css("display","block");
                    }
                }
             });
        }
    }
    
    function view_project(project_id,current_id)
    {
        
        $($(current_id).data("target",$('#myModal6620')));
    }
    
    function delete_projects()
    {        
        var selected_project = $("input[name=owner_project_selected]:checked").val();
        if(selected_project){
            $.ajax({
                url:"<?php echo base_url('dashboard/project_delete') ?>",
                type:"post",
                dataType:"html",
                data:{'project_id':selected_project,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){                    
                    if(data=='success')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        //$(".invitation_error").text('Error Occurred. Try Again!').css("display","block");
                    }
                }
             });
        } else {
            //$(".invitation_error").text('Error Occurred. Try Again!').css("display","block");
            //alert('error');
        }
    }
    
    function withdraw_user()
    {        
        var selected_project = $("input[name=contributor_project_selected]:checked").val();
        if(selected_project){
            $.ajax({
                url:"<?php echo base_url('dashboard/withdraw_user') ?>",
                type:"post",
                dataType:"html",
                data:{'project_id':selected_project,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){                    
                    if(data=='success')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        //$(".invitation_error").text('Error Occurred. Try Again!').css("display","block");
                    }
                }
             });
        } else {
            //$(".invitation_error").text('Error Occurred. Try Again!').css("display","block");
            //alert('error');
        }
    }
    
    function archive_projects(selected_project)
    {        
        if(!selected_project)
        {
            alert("Please select atleast one project to archive");
            return false;
        }                
        if(selected_project){
            $.ajax({
                url:"<?php echo base_url('dashboard/project_archive') ?>",
                type:"post",
                dataType:"html",
                data:{'project_id':selected_project,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){                    
                    if(data=='success')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        //$(".invitation_error").text('Error Occurred. Try Again!').css("display","block");
                    }
                }
             });
        } else {
            //$(".invitation_error").text('Error Occurred. Try Again!').css("display","block");
            //alert('error');
        }
    }
    
    function contribute_projects()
    {        
        var selected_project = $("input[name=other_project_selected]:checked").val();
        if(selected_project){
            $.ajax({
                url:"<?php echo base_url('dashboard/project_contribute') ?>",
                type:"post",
                dataType:"html",
                data:{'project_id':selected_project,
                      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                     },
                success:function(data){                    
                    if(data=='success')
                    {
                        location.reload(true);
                    }
                    else
                    {
                        //$(".invitation_error").text('Error Occurred. Try Again!').css("display","block");
                    }
                }
             });
        } else {
            //$(".invitation_error").text('Error Occurred. Try Again!').css("display","block");
            //alert('error');
        }
    }
    
    
</script>    
    </body>
</html>
