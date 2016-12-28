<?php echo $head; ?>
<?php echo $header; ?>
    
        <!--header end-->
    <!--content start-->
    <div class="inner_head">
            <div class="container">
                <div class="col-sm-6 head_left"><h2>Help</h2></div>
            </div>
        </div>
    <div class="content" style="min-height: 560px">
        <div class="container">  
            <div class="information-blocks">
                        <div class="col-md-12 information-entry">
                            <div class="content_div">                              
                                <div class="demo">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<?php 
	$i=0;
	foreach($help_list as $help){ ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne<?php echo $i ?>">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $i ?>" aria-expanded="true" aria-controls="collapseOne">
                        <i class="more-less glyphicon <?php if($i == 0){ echo 'glyphicon-minus';} else { echo 'glyphicon-plus';} ?>"></i>
                      <?php echo $help['help_title'] ?>
                    </a>
                </h4>
            </div>
            <div id="collapseOne<?php echo $i ?>" class="panel-collapse collapse <?php if($i == 0) echo 'in'; ?>" role="tabpanel" aria-labelledby="headingOne<?php echo $i ?>">
                <div class="panel-body">
                      <?php echo $help['help_description'] ?>
                </div>
            </div>
        </div>
	<?php $i++; } ?>
    </div><!-- panel-group -->
    
    
</div><!-- container -->
                            </div>
                        </div>
            </div>
        </div>
    </div>
       
    <!--content end-->
        
<?php echo $footer; ?>
    </body>


<script>
        function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);

</script>
</html>