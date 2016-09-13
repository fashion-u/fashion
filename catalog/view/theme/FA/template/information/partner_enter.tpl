<?php echo $header; ?>

  <!--content section-->
  <section class="content-section">
      <div class="inner-block">

          <div class="special-row clearfix">
              <!--sidebar-->
              <section class="sidebar left">
					
					<nav class="category-menu">
							<h2>Для посетителей</h2>
							<ul>
								<li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>about">О проекте</div></li>
								<li><a href="/brands_and_shops">Бренды и магазины</a></li>
								<li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>user-license">Пользовательское соглашение</div></li>
							</ul>
							<h2>Для магазинов</h2>
							<ul>
								<li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>add_shop">Добавить магазин</div></li>
								<li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>post-requirements">Условия размещения</div></li>
								<li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>xml-requirements">Требованиея к xml</div></li>
							</ul>
						</nav>
                  <!--end category menu-->

              </section>
              <!--end sidebar-->
	<style>
		.form__error {
				margin-top: -12px;
				font-weight: 400;
				 font-style: italic; 
				font-size: 0.75rem;
				line-height: 12px;
				color: #de2500;
				float: right;
				display: none;
			}
	</style>
	<script>
		$(document).on('click', '.enter_shop_submit', function(){
			var email = $('.email').val();
			var password = $('.password').val();
			
			var error = 0;
			 
			if(error == 0){
				
				$(".add_shop_form").submit();
					
			}
		
			
		});
	
	</script>
              
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
                                    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                                <?php } ?>
                              <?php } ?>
                          </ul>
                      </nav>
                      <!--end breadcrumbs-->
                      
                      	<!--alphabet section-->
						<?php if(isset($_GET['success'])){ ?>
							<section class="add-store-form">
								<h2>Вы вошли. Через 5 секунд вы будете перенаправлены на главную страницу.</h2>
								<script>
									$(document).ready(function(){
										
										setTimeout(function(){
											location.href = 'http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>';
											}, 5000);
											
									});
								</script>
							</section>
						<?php }else{ ?>
							<section class="add-store-form">
								<h2>Вход для партнеров</h2>
								
								<?php if(isset($_GET['error'])){ ?>
									<b><font color="red">Не удалось войти</font></b><br>
								<?php } ?>
								
								<form action="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>index.php?route=account/login" method="post" enctype="multipart/form-data" class="enter_shop_submit">
									<div class="row">
										<span class="form__error error_email">Не верный емаил</span>
										<input type="text" placeholder="Email" name="email" class="email">
									</div>
									<div class="row">
										<input type="password" placeholder="Пароль" name="password" class="password">
										<input type="hidden" name="url_success" value="partner_enter">
										<input type="hidden" name="url_error" value="partner_enter">
									</div>
									<div class="row">
										<div class="yellow-button-no-link enter_shop_submit">Войти</div>
									</div>
								</form>
							</section>
							
							<section class="add-store-form">
								<div class="social_key_wrapper">
									<?php global $adapters, $social_images;?>
									<?php foreach ($adapters as $title => $adapter) { ?>
									  <div class="form_element_social">
										  <a href="<?php echo $adapter->getAuthUrl(); ?>"><?php echo $social_images[$title]; ?></a>
									  </div>
									<?php  } ?>
								</div>
							</section>
					 
							<script>
								$(document).on('click', '.enter_shop_submit', function(){
									$('.enter_shop_submit').submit();
								});
								
							</script>
						<?php } ?>
							<!--end alphabet section-->

                      
                  </div>
              </section>
          </div>

      </div>
  </section>

<?php echo $footer; ?>
