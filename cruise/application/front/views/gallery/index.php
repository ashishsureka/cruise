<?php echo $header; ?>

<div class="banner inner_banner wow fadeInLeft animated page-head">	
    <img src="<?=  base_url('uploads/pages/main/'.$page_image)?>"/>
</div>

<!-- //banner -->

<!--gallery-starts--> 

<div class="facilities">

	<div class="container">

		<h3 class="tittle">GALLERY</h3> 

		<?php 
                if(count($gallery_list)>0){
                    foreach($gallery_list as $gallery){ ?>	
                    <div class="view view-seventh">
                        <a src="<?= base_url('uploads/gallery/main/'.$gallery['galleryimage']); ?>" class="b-link-stripe b-animate-go  swipebox"  title="Image Title">
                            <img src="<?= base_url('uploads/gallery/main/'.$gallery['galleryimage']); ?>" alt="" class="img-responsive">
                        </a>

                    </div>
                <?php
                    } 
                }    ?>

	
				<div class="clearfix"></div>

                             

	</div>

</div>

<!--gallery-ends--> 

<!-- footer -->

   <link rel="stylesheet" src="<?= base_url(''); ?>css/swipebox.css">

			<script src="<?= base_url(''); ?>js/jquery.swipebox.min.js"></script> 

			<script type="text/javascript">

						jQuery(function($) {

							$(".swipebox").swipebox();

						});

			</script>
<?php echo $footer; ?>