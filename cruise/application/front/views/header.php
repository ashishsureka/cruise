<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $metatag_title; ?></title>
        <!-- for-mobile-apps -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <link rel="icon" href="<?php echo base_url('images/favicon.png'); ?>" type="image/x-icon" >
        <meta name="description" content="<?php echo $metatag_description ?>">
        <meta name="keywords" content="<?php echo $metatag_keywords ?>">
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //for-mobile-apps -->
        <link href="<?php echo base_url('css/bootstrap.css'); ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url('css/font-awesome.css'); ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="<?php echo base_url('css/animate.css'); ?>" rel="stylesheet" type="text/css" media="all"/>
        <!-- js -->
        <script src="<?php echo base_url('js/jquery-1.11.1.min.js'); ?>">
        </script>
        <!-- //js -->
        <!-- fonts -->
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <!-- //fonts -->	
        <!-- start-smoth-scrolling -->		
        <script type="text/javascript" src="<?php echo base_url('js/move-top.js'); ?>">
        </script>		
        <script type="text/javascript" src="<?php echo base_url('js/easing.js'); ?>">




        </script>		
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    //event.preventDefault();
                    $('html,body').animate({
                        scrollTop: $(this.hash).offset().top
                    }
                    , 1000);
                }
                );
            }
            );
        </script>	
        <!-- start-smoth-scrolling -->

        <!--//        for validation-->
        <script type="text/javascript" src="<?php echo base_url('admincp/plugins/validation/jquery.validate.min.js'); ?>"></script>
    </head>
    <body> 



        <!-- header -->
        <div class="header-top">	
            <div class="container">				
                <div class="header-top-left">				
                    <ul>						
                        <li>
                            <a href="<?php echo $sem_data[0]['semfieldvalue'] ?>" class="f1" target="_blank"> 
                            </a>
                        </li>						

                    </ul>				
                </div>				
                <div class="header-top-mid">					
                    <p>
                        <span class="glyphicon glyphicon-envelope " aria-hidden="true">
                        </span><?php echo $phone[4]['setting_value'] ?> |
                    </p>                                        
                    <p>
                        <span class="glyphicon glyphicon-earphone" aria-hidden="true">
                        </span>&nbsp;<?php echo $phone[5]['setting_value'] ?>
                    </p>				
                </div>				

                <!--modal (popup) for login and register are in  footer.php and also
                script for it is also in this and ajax for login and register also-->

                <?php // if(!isset($loged_in_customer[0]['customername'])){ ?>   <?php // }else{ ?>
                            <!--<li class="active"><a href="<?php // echo base_url('login/logout');  ?>" data-toggle="tab" >Logout</a></li>-->
                <?php // } ?>
                <!--login header--> 
                <div class="header-top-right">
                    <?php if (!isset($loged_in_customer[0]['customername'])) { ?>
                        <div class="login">
                            <a href="javascrip:void(0)" type="button" id="login_click" data-toggle="modal" data-target="#myModal" class="login3 log_popup">Login</a>
                        </div>

                        <div class="register">
                            <a href="javascrip:void(0)" type="button" data-toggle="modal" data-target="#myModal" id="register_click" class="register3 log_popup">Register</a>
                        </div> 
                         <?php $total = 0; ?>
                            <?php if($this->uri->segment(1) != 'menu' && $this->uri->segment(1) != 'cateringmenu' && $this->uri->segment(1) != 'checkout') { ?>
                            <ul class="icon1 sub-icon1 profile_img ">
                                
                                <li><a href="#" class="basketcount active-icon c1"><i class="fa fa-shopping-cart"></i></a>
                                    <?php if($this->cart->contents()) { ?>
                                    <ul class="sub-icon1 list">                                    
                                        <h3 id="carttext">Recently added items</h3>
                                        <div class="shopping_cart">
                                        <?php foreach($this->cart->contents() as $recent_menucart) { ?>
                                            <div class="cart_box1" id="cart_box_<?php echo $recent_menucart['rowid'] ?>">
                                                <div class="message" >
                                                    <div class="alert-close cart_delete" id="<?php echo $recent_menucart['rowid'] ?>"> </div> 
<!--                                                    <div class="list_img"><img src="images/1.jpg" class="img-responsive" alt=""/></div>-->
                                                    <div class="list_desc"><h4><a href="#"><?php echo $recent_menucart['name'] ?></a></h4><?php echo $recent_menucart['qty'] ?> x
                                                        <span class="actual_<?php echo $recent_menucart['rowid'] ?>" id="actual_<?php echo $recent_menucart['rowid'] ?>">
                                                            $<?php echo $recent_menucart['price'] ?></span></div>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        <?php                                        
                                        $total += $recent_menucart['subtotal'];                                        
                                        } ?>                                            
                                        </div>
                                        <h6>Plus 6% PA Sales Tax</h6>
                                        <div class="total1" id="total">
                                            <div class="total_left">Cart Subtotal : </div>
                                            <div class="total_right_<?php echo $recent_menucart['rowid'] ?>" id="total_right">$<?php echo $total ?></div>
                                            <div class="clear"> </div>
                                        </div>
                                        <div class="login_buttons" id="chkbutton">
                                            <div class="check_button"><a href="<?php echo base_url('checkout/index') ?>">Check out</a></div>
                                        </div>
                                    
                                    
                                    </ul>
                                    <?php }  else { ?>
                                            <ul class="sub-icon1 list">
                                                <h3>No item found in cart.</h3>
                                            </ul>
                                    <?php } ?>
                                </li>
                            </ul>
                            <?php } ?>

                    <?php } else { ?>

                        <div class="dropdown logout" style="position: absolute">
                            <a class="dropdown-toggle" type="button" data-toggle="dropdown" style="cursor: pointer; color: white; ">Welcome <?php echo $loged_in_customer[0]['customername'] ?>
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('myaccount/index') ?>">My Account</a></li>
                                <li><a href="<?php echo base_url('login/logout') ?>">Logout</a></li>    
                            </ul>
                            
                            <?php $total = 0; ?>
                            <?php if($this->uri->segment(1) != 'menu' && $this->uri->segment(1) != 'cateringmenu' && $this->uri->segment(1) != 'checkout') { ?>
                            <ul class="icon1 sub-icon1 profile_img ">
                                
                                <li><a href="#" class="basketcount active-icon c1"><i class="fa fa-shopping-cart"></i></a>
                                    <?php if($this->cart->contents()) { ?>
                                    <ul class="sub-icon1 list">                                    
                                        <h3 id="carttext">Recently added items</h3>
                                        <div class="shopping_cart">
                                        <?php foreach($this->cart->contents() as $recent_menucart) { ?>
                                            <div class="cart_box1" id="cart_box_<?php echo $recent_menucart['rowid'] ?>">
                                                <div class="message" >
                                                    <div class="alert-close cart_delete" id="<?php echo $recent_menucart['rowid'] ?>"> </div> 
<!--                                                    <div class="list_img"><img src="images/1.jpg" class="img-responsive" alt=""/></div>-->
                                                    <div class="list_desc"><h4><a href="#"><?php echo $recent_menucart['name'] ?></a></h4><?php echo $recent_menucart['qty'] ?> x
                                                        <span class="actual_<?php echo $recent_menucart['rowid'] ?>" id="actual_<?php echo $recent_menucart['rowid'] ?>">
                                                            $<?php echo $recent_menucart['price'] ?></span></div>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        <?php                                        
                                        $total += $recent_menucart['subtotal'];                                        
                                        } ?>                                            
                                        </div>
                                        <h6>Plus 6% PA Sales Tax</h6>
                                        <div class="header_checkout_error" style="display:none;color:red;"><h5>Order value must be minimum $35.</h5></div>
                                        <div class="total1" id="total">
                                            <div class="total_left">Cart Subtotal : </div>
                                            <div class="total_right_<?php echo $recent_menucart['rowid'] ?>" id="total_right">$<?php echo $total ?></div>
                                            <div class="clear"> </div>
                                        </div>
                                        <div class="login_buttons" id="chkbutton">
                                            <div class="check_button"><a href="<?php echo base_url('checkout/index') ?>">Check out</a></div>
                                        </div>
                                    
                                    
                                    </ul>
                                    <?php }  else { ?>
                                            <ul class="sub-icon1 list">
                                                <h3>No item found in cart.</h3>
                                            </ul>
                                    <?php } ?>
                                </li>
                            </ul>
                            <?php } ?>
                        </div>

                    <?php } ?>

                </div>			


                <div class="clearfix">
                </div>	
            </div>
        </div>
        <!-- //header -->
        <!-- strip -->
        <div class="strip">
        </div>
        <!-- //strip -->
        <!-- logo -->
        <div class="logo-head">	
            <div class="container">            
                <div class="row">                
                    <div class="col-sm-2 logo">                    
                        <a href="<?php echo site_url() ?>">
                            <img src="<?php echo base_url('images/logo.png') ?>" alt="Aangan Express"/>
                        </a>                
                    </div>                
                    <div class="col-sm-3">
                    </div>                
                    <div class="col-sm-7">                    
                        <div class="navigation">				
                            <span class="menu">
                                <img src="<?php echo base_url('images/menu.png'); ?>" alt=""/>
                            </span>				
                            <div class="clearfix">
                            </div>				
                            <ul class="nav1">					
                                <li>
                                    <a class="hvr-overline-from-center button2" href="<?php echo site_url(); ?>">Home
                                    </a>
                                </li>					
                                <li>
                                    <a class="hvr-overline-from-center button2" href="<?php echo site_url('menu'); ?>">Menu
                                    </a>
                                </li>					
                                <li>
                                    <a class="hvr-overline-from-center button2" href="<?php echo site_url('cateringmenu'); ?>">Catering Menu
                                    </a>
                                </li>					
                                <li>
                                    <a class="hvr-overline-from-center button2" href="<?php echo site_url('gallery'); ?>">Gallery
                                    </a>
                                </li>					
                                <li>
                                    <a class="hvr-overline-from-center button2" href="<?php echo site_url('events'); ?>">Events
                                    </a>
                                </li>						
                                <li>
                                    <a class="hvr-overline-from-center button2" href="<?php echo site_url('contactus'); ?>">Contact Us
                                    </a>
                                </li>                                        				
                            </ul>				
                            <!-- script for menu -->					

                            <!-- //script for menu -->			
                        </div>                
                    </div>
                    <!--                <div class="col-sm-2">                    <div class="order-online"><a style="color: white !important">Order Online</a></div>                </div>-->            
                </div>            	
            </div>
        </div>
        <!-- //logo -->


