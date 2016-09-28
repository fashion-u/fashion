<?php echo $header; ?>
<style>
    .sale{
        float: right;
        color: red;
        font-size: 14px;
        font-weight: bold;
    }
    .old_price{
        float: left;
    }
    .content-section .inner-block {
        min-height: 400px;
    }
</style>
 <!--System-->
 <input type="hidden" id="helikopter" value="<?php echo $helikopter; ?>">
 <input type="hidden" id="helikopter_next_href" value="<?php echo $helikopter_next_href; ?>">
 <!-- end System-->
  <!--content section-->  
  <section class="content-section" >
      <div class="inner-block" style="min-height: 100%;">

          <div class="special-row clearfix">
        
              <section class="cont right">
                  <div class="inner-special-box special">

                      <!--breadcrumbs-->
                      <nav class="breadcrumbs inline mobile-off">
                          <ul class="clearfix">
                              <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                                <?php if($breadcrumb['href'] == ''){ ?>
                                    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                                <?php }else{ ?>
                                    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'; ?><?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                                <?php } ?>
                              <?php } ?>
                          </ul>
                      </nav>
                      <!--end breadcrumbs-->
                      
                      <div>
                        Сейчас Вы будете автоматически перенаправлены на нужную страницу...<br/>
                        Если ваш браузер не поддерживает перенаправления, нажмите здесь: <a href="<?php echo $original_url;?>"><?php echo $original_url;?></a>.
                      </div>
                  </div>
                  
                 
                      
              </section>
        </div>
      </div>
  </section> <!-- end .content-section -->
<script>
  $(document).ready(function(){
    
      setTimeout(function(){location.href = '<?php echo $original_url; ?>';},3000);
    
    });
</script>
<?php echo $footer; ?>
               