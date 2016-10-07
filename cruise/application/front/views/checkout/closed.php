<?php
    echo $header;
?>
<!-- banner -->
<div class="banner inner_banner wow fadeInLeft animated page-head">
    <?php $page_image = $page_data[0]['image'] ?>
    <img src="<?php echo base_url('uploads/pages/main/' . $page_image) ?>"/>
</div> 
<div class="thanku">
    <div class="container">
        <div class="col-sm-12 ">
            <div class="col-sm-12 thanx_page">
                <?php echo $page_image = $page_data[0]['page_description'] ?>
            </div>

        </div>

    </div>
</div>
<!--blog-ends--> 
<?php echo $footer; ?>
