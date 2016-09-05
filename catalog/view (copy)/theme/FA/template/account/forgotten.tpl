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
                      
                        <p><?php echo $text_email; ?></p>
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <fieldset>
                            <legend><?php echo $text_your_email; ?></legend>
                            <div class="form-group required">
                              <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
                              <div class="col-sm-10">
                                <input type="text" name="email" value="" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
                              </div>
                            </div>
                          </fieldset>
                          <div class="buttons clearfix">
                            <div class="pull-left"><a href="<?php echo $back; ?>" class="btn btn-default"><?php echo $button_back; ?></a></div>
                            <div class="pull-right">
                              <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
                            </div>
                          </div>
                        </form>
      
                      
                  </div>
              </section>
          </div>

      </div>
  </section>

<?php echo $footer; ?>