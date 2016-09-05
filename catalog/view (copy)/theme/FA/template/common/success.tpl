<?php echo $header; ?>

  <!--content section-->
  <section class="content-section">
      <div class="inner-block">

          <div class="special-row clearfix">
              <!--sidebar-->
              <section class="sidebar left">

                  <!--category menu-->
                  <nav class="category-menu">&nbsp;
                      <!--ul>
                          <li><a href="/lovedproducts">Вам понравилось</a></li>
                          <li><a href="/lastviewed">Вы смотрели</a></li>
                      </ul-->
                  </nav>
                  <!--end category menu-->

              </section>
              <!--end sidebar-->

            <!--cont-->
              <section class="cont right">
                  <div class="inner-special-box special">

                      <!--breadcrumbs-->
                      <nav class="breadcrumbs inline mobile-off">
                          <ul class="clearfix">
                              <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                                <?php if($breadcrumb['href'] == ''){ ?>
                                    <li><?php echo $breadcrumb['text']; ?></li>
                                <?php }else{ ?>
                                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                                <?php } ?>
                              <?php } ?>
                          </ul>
                      </nav>
                      <!--end breadcrumbs-->
					
					<section class="alphabet-section">
						<div class="big-title"><?php echo $heading_title; ?></div>
						<?php echo $text_message; ?> 
						
					</section>

                      
                  </div>
              </section>
          </div>

      </div>
  </section>

<?php echo $footer; ?>