<?php echo $header; ?>

  <!--content section-->
  <section class="content-section">
      <div class="inner-block">

          <div class="special-row clearfix">
              <!--sidebar-->
              <section class="sidebar left">

                  <!--category menu-->
                  <nav class="category-menu">
                      <ul>
                        <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
                        <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
                        <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
                        <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
                      </ul>
                  </nav>
                  <!--end category menu-->

              </section>
              <!--end sidebar-->
      
              <section class="alphabet-section">
				  <div class="big-title"><?php echo $text_my_account; ?></div>
         
              <ul class="list-unstyled">
                <li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
                <li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
                <li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
                <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
              </ul>
              <!--h2><?php echo $text_my_orders; ?></h2>
              <ul class="list-unstyled">
                <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                <li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
                <?php if ($reward) { ?>
                <li><a href="<?php echo $reward; ?>"><?php echo $text_reward; ?></a></li>
                <?php } ?>
                <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
                <li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
                <li><a href="<?php echo $recurring; ?>"><?php echo $text_recurring; ?></a></li>
              </ul-->
              <!--h2><?php echo $text_my_newsletter; ?></h2>
              <ul class="list-unstyled">
                <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
              </ul-->
              </section>
        </div>
      </div>
  </section>
  
<?php echo $footer; ?>
