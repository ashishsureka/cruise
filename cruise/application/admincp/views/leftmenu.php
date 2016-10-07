<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            </div>
        </div>
        
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <!--<li class="header">MAIN NAVIGATION</li>-->
            <li <?php if ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
                <a href="<?php echo site_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                </a>
                
            </li>
            
<!--            <li <?php //if ($this->uri->segment(1) == 'setting' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php //} else { ?> class="treeview"   <?php //} ?> >
                <a href="<?php //echo site_url('setting'); ?>">
                    <i class="fa fa-wrench"></i> <span>Setting</span> 
                </a>
                
            </li>-->
            <li <?php if ($this->uri->segment(1) == 'emailsetting' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
                <a href="<?php echo site_url('emailsetting'); ?>">
                    <i class="fa fa-envelope"></i> <span>Email Setting</span> 
                </a>                
            </li>
            <li <?php if ($this->uri->segment(1) == 'email_format' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
                <a href="<?php echo site_url('email_format'); ?>">
                    <i class="fa fa-envelope-o"></i> <span>Email Format</span> 
                </a>                
            </li>
<!--            <li <?php if ($this->uri->segment(1) == 'sem' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
                <a href="<?php echo site_url('sem'); ?>">
                    <i class="fa fa-facebook"></i> <span>SEM</span> 
                </a>                
            </li>            -->
            <li <?php if ($this->uri->segment(1) == 'seo' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
                <a href="<?php echo site_url('seo'); ?>">
                    <i class="fa fa-bullhorn"></i> <span>SEO</span> 
                </a>                
            </li>            
             <!--For Pages-->
           <li <?php if ($this->uri->segment(1) == 'pages' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
               
               <a href="<?php echo site_url('pages'); ?>">
                   <i class="fa fa-file"></i> <span> Page Management</span></a>
            </li>
            <li <?php if ($this->uri->segment(1) == 'user' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?>>
                <a href="#">
                    <i class="fa fa-user"></i> <span>User Management</span> 
                </a>                
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('user/add'); ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
                    <li><a href="<?php echo base_url('user'); ?>"><i class="fa fa-circle-o"></i> List Users</a></li>
                </ul>
            </li> 
            <li <?php if ($this->uri->segment(1) == 'projects' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
               
                <a href="#">
                    <i class="fa fa-cubes"></i> <span> Project Management </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('projects/add'); ?>"><i class="fa fa-circle-o"></i> Add Project</a></li>
                    <li><a href="<?php echo base_url('projects'); ?>"><i class="fa fa-circle-o"></i> List Projects</a></li>
                </ul>               
            </li>
            <li <?php if ($this->uri->segment(1) == 'modules' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
               
               <a href="<?php echo site_url('modules'); ?>">
                   <i class="fa fa-clone"></i> <span> Module Management </span></a>
            </li>
            <li <?php if ($this->uri->segment(1) == 'inquiry' || $this->uri->segment(1) == '') { ?> class="active treeview" <?php } else { ?> class="treeview"   <?php } ?> >
               
               <a href="<?php echo site_url('inquiry'); ?>">
                   <i class="fa fa-search"></i> <span> Inquiry Management </span></a>
            </li>
            
            <!--End of my code-->
            
            
            
           
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>