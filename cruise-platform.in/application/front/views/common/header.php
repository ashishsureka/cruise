<body <?php if(!$this->session->userdata('cruise_user')){ ?>id="main" <?php } ?>>
        <!--header start-->
        <header <?php if($this->uri->segment(1) != 'login' && $this->uri->segment(1) != 'dashboard' && $this->uri->segment(1) != ''){ ?>id="header_con" <?php } ?>>
            <div class="topheader">
                <div class="container">
                    <div class="logo col-sm-6">
                        <a href="<?php echo site_url() ?>"><img src="<?php echo base_url('images/Logo.png') ?>" alt="<?php echo $site_name ?>" title="<?php echo $site_name ?>"></a>
                    </div>
                    <div class="col-sm-6 right_button">
                        <div class="div_button pull-right">
                            <?php if($this->session->userdata('cruise_user')){ ?>
                            <span onclick="">Welcome, <a href="<?php echo site_url('profile'); ?>"><?php if(isset($loged_in_user[0]['user_first_name'])){ echo $loged_in_user[0]['user_first_name']; } ?></a>
                                <a href="<?php echo site_url('login/logout') ?>" type="submit" class="signout"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign Out</a></span>
                            <?php } else { ?>                            
                            <!--<button type="submit" class="btn buttons">Login</button>-->
                            <button type="submit" class="btn buttons" data-toggle="modal" data-target="#myModal">Register</button>
                            <?php echo form_open('register',array('name'=>'register_frm','id'=>'register_frm','method'=>'POST'));  ?>
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog" >

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <button type="button" class="close" data-dismiss="modal"><img src="images/x.png" alt="close"/></button>
                                        <div class="modal-body" id="sign_up">
                                            <div class="login text-center">
                                                <h1>Create CRUISE Account</h1>                                                
                                                <div class="alert fade in alert-success" id="success" style="display: none">
                                                    <i class="icon-remove close" data-dismiss="alert"></i>
                                                    <p></p>
                                                </div>                                                
                                                <div class="alert fade in alert-danger myalert" id="unsuccess" style="display: none" >
                                                    <i class="icon-remove close" data-dismiss="alert"></i>                                                
                                                    <p></p>
                                                </div>
                                                
                                                <div class="con_mail">
                                                    <input type="email" name="reg_email" id="reg_email" placeholder="Email address"/>
                                                    <input type="text" name="reg_firstname" id="reg_firstname" placeholder="First name"/>
                                                    <input type="text" name="reg_lastname" id="reg_lastname" placeholder="Last name"/>
                                                    <input type="password" name="reg_password" id="reg_password" placeholder="Password"/><br>                                                    
                                                    <input type="button" name="reg_submit" id="reg_submit" value="Submit" class="btn fill_btn pull-right" />                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>            
        </header>