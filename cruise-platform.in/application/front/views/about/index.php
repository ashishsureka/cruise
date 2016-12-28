<?php echo $head; ?>
<?php echo $header; ?>
    
        <!--header end-->
    <!--content start-->
    <div class="inner_head">
            <div class="container">
                <div class="col-sm-6 head_left"><h2><?php echo $page_detail[0]['page_title'] ?></h2></div>
            </div>
        </div>
    <div class="content" style="min-height: 560px">
        <div class="container">  
            <div class="information-blocks">
                    <div class="row">
                  
                        <div class="col-md-12 information-entry">
                            <div class="content_div">
                              <?php echo $page_detail[0]['page_description'] ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
        
<?php echo $footer; ?>
    </body>
</html>