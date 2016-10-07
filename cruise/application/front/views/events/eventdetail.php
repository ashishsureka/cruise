<?php 
    echo $header;
?>
<div class="banner inner_banner wow fadeInLeft animated page-head">	
    <img src="<?=  base_url('uploads/pages/main/'.$page_image)?>"/>
</div>

<!--blog-starts--> 

<div class="blog-section">

    <div class="container"> 

        <h3 class="tittle">Event</h3>

        <!--single-page-->

        <div class="banner-bdy sig">

            <div class="single">

                <div class="sing-img-text">

                    <img src="<?php echo base_url('uploads/events/main/'.$event[0]['event_front_image']); ?>" class="img-responsive" alt=" ">

                    <div class="sing-img-text1">

                        <h3><?php echo $event[0]['event_title']; ?></h3>

                        <div class="admin-tag1">

                            <p>Posted On &nbsp;
                                <a href="javascript:void(0)">
                                    <?php echo date_format(date_create($event[0]['insertdatetime']),"d/m/Y"); ?>
                                </a> </p>

                        </div>

                        <p class="est"> 
                            <?php echo $event[0]['event_description']; ?>
                        </p>

                        



                    </div>

                </div>

               

            </div>

        </div>

        <!-- /single -->   

    </div>

</div> 

<!-- footer -->

<?php echo $footer; ?>

<!-- //footer -->

