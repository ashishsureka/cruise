<?php echo $header; ?>

<div class="banner inner_banner wow fadeInLeft animated page-head">	
    <img src="<?=  base_url('uploads/pages/main/'.$page_image)?>"/>
</div>

<!--blog-starts--> 

<div class="blog-section">

	<div class="container"> 

		<h3 class="tittle">Events</h3>

                <div class="row">
                
              
		<?php 
                if(count($event_list)>0){
                    foreach($event_list as $event){ ?>	
                   <div class="col-sm-4 blog-post-grids">
                       <div class="blog-post">
                        <a href="<?= base_url('events/eventdetail/'.$event['eventid']); ?>"><img src="<?= base_url('uploads/events/main/'.$event['event_front_image']); ?>" class="img-responsive" alt="  "/></a>
                        
                        <div class="text">
                                <a href="<?= base_url('events/eventdetail/'.$event['eventid']); ?>"> <?php echo $event['event_title'] ?></a>
                        </div>

                        </div>
                    </div>
                <?php
                    } 
                }    ?>

	
                </div>
				<!--<div class="clearfix"></div>-->
	

		<div class="clearfix"> </div>

	</div>


	</div> 



<!--blog-ends--> 

<!-- footer -->
<?php echo $footer; ?>