<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo $lang; ?>">
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<script>
  var tmp_dir = "<?php echo TMP_DIR; ?>";
</script>
<!-- <script src="/<?php echo TMP_DIR; ?>catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script> -->

<!--link href="catalog/view/javascript/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" /-->
<link href="/<?php echo TMP_DIR; ?>catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css" />
<!--link href="catalog/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet"-->

<link rel="stylesheet" type="text/css" href="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/stylesheet/jscrollpane.min.css" />
<link rel="stylesheet" type="text/css" href="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/stylesheet/magnific-popup.min.css" />
<link rel="stylesheet" type="text/css" href="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/stylesheet/style.desktop.min.css" />
<link rel="stylesheet" type="text/css" href="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/stylesheet/style.tablet.min.css" />
<link rel="stylesheet" type="text/css" href="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/stylesheet/style.mobile.min.css" />
<link rel="stylesheet" type="text/css" href="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/stylesheet/style.develop.css" />
<link rel="stylesheet" type="text/css" href="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/stylesheet/account.desktop.min.css" />

<script src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/js/lib/jquery-3.0.min.js" type="text/javascript"></script>

<!--script type="text/javascript" src="catalog/view/theme/FA/js/click-carousel.js"></script>
<script type="text/javascript" src="catalog/view/theme/FA/js/carousel.js"></script-->

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="/<?php echo TMP_DIR; ?>catalog/view/javascript/common.min.js" type="text/javascript"></script>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1804192209864141',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</head>

<body class="<?php echo $class; ?>">
<nav id="top">
<?php if(isset($_GET['_route_']) AND ($_GET['_route_'] == 'lastviewed' OR $_GET['_route_'] == 'lovedproducts')){ ?>
  <div class="wrapper wrapper2">
<?php }else{ ?>
  <div class="wrapper">
<?php } ?>
       <!-- header section -->
		<section class="header-section">
			<div class="inner-block clearfix">

				<a href="<?php echo HTTP_SERVER; ?>" class="logo left">
					<img src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/image/icon/logo.png" alt="" />
				</a>
<?php //echo "<pre>";  print_r(var_dump( $categories )); echo "</pre>"; ?>
				<!--head menu-->
				<nav class="head-menu inline left">
					<a href="javascript:void(0)" class="menu-button">Каталог</a>
					<div class="mobile-menu" style="/*z-index:99999*/">
						<a href="javascript:void(0)" class="close"></a>
						<ul class="clearfix">
                            <?php foreach($categories as $categs_1){ ?>
							<li>
                                <a href="<?php echo $categs_1['href'];?>" class="drop"><?php echo $categs_1['name'];?></a>
								<div class="drop-menu-box clearfix">
									<div class="column left">
                                        <?php $count = 0; $col_len = 13;?> 
                                        <?php foreach($categs_1['children'] as $categs_2){ ?>
										<span class="__large2"><a href="<?php echo $categs_2['href'];?>"><?php echo $categs_2['name'];?></a></span>
										<ul>
                                            <?php if($count++ > $col_len){ ?>
                                            <?php $count = 0; ?> 
                                                    </ul>
                                                </div>
                                                <div class="column left">
                                                    <ul>
                                            <?php } ?>
                                            
                                            <?php foreach($categs_2['children'] as $categs_3){ ?>
                                                <?php if($count++ > $col_len){ ?>
                                                <?php $count = 0; ?> 
                                                        </ul>
                                                    </div>
                                                    <div class="column left">
                                                        <ul>
                                                <?php } ?>
                                            
                                                <li><a href="<?php echo $categs_3['href'];?>"><?php echo $categs_3['name'];?></a></li>
                                            <?php } ?>
										</ul>
                                        <?php  } ?>
									</div>
									
									<div class="column long left">
										<figure class="menu-banner"><img src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/image/uploads/img7.jpg" alt="" /></figure>
										<div class="line clearfix">
									</div>
									</div>
								</div>
							</li>
                            <?php } ?>
							<?php if(isset($shop) AND is_array($shop) AND count($shop) AND isset($_GET['_route_']) AND $_GET['_route_'] == TMP_DIR.'my_account'){ ?>
								<li><a href="/<?php echo TMP_DIR;?><?php echo $shop['href']; ?>">Все товары <?php echo $shop['name']; ?></a></li>
								<li><a href="/<?php echo TMP_DIR;?>my_account/ClickFrogCode">Вставить код <i><b>ClickFrog.ru</b></i></a></li>
							<?php } ?>

						</ul>
					</div>
				</nav>
				
				
				<!--end head menu-->
				<?php if (!$logged) { ?>
				<div class="private-office right">
					<a href="javascript:void(0)" class="form-office-drop-button"></a>
                </div>
				<?php } ?>
				<div class="form-office-back"></div>

                    <?php if ($logged) { ?>
					  <div class="account-top-bar">
						  <?php if(isset($shop) AND is_array($shop) AND count($shop) AND isset($_GET['_route_']) AND $_GET['_route_'] == 'my_account'){ ?>
						  <div class="account-payment-menu">
							  <div class="purse">
								  <span class="ic-purse"></span><?php echo number_format($money['summ'], 2, '.', ''); ?>
							  </div>
							  <a href="#">Пополнить</a>
							  <a href="#">История</a>
						  </div>
						  <?php } ?>
						  <div class="account-menu">
							  <div class="account-name"><?php echo (isset($shop['name'])) ? $shop['name'] : 'нет магазина'; ?></div>
                              <?php if(isset($_GET['_route_']) AND $_GET['_route_'] == 'my_account'){ ?>
                              <a href="javascript:void(0)" class="account-setings">Настройки</a>
                              <?php }else{ ?>
							  <a href="/<?php echo TMP_DIR;?>my_account" class="my-account">Кабинет</a>
                              <?php } ?>
							  <a href="<?php echo $logout; ?>">Выйти</a>
						  </div>
                          <div class="account-setings-menu">
                                <div class="account-setup__block">
                                    <span class="account-setup__block-title">Соцсеть для входа</span>
                                        <!-- Facebook -->
                                        <div class="setup_element_social">
                                        <?php if($customer_info['social_fb'] != ''){ ?>
                                            <a href="javascript:;"><?php echo $social_images['facebook']; ?></a><span class="social_status_on">Привязан</span>
                                        <?php }else{ ?>
                                            <a href="<?php echo $adapters['facebook']->getAuthUrl(); ?>"><?php echo $social_images['facebook']; ?></a><span class="social_status_off">Не привязан</span>
                                        <?php } ?>
                                        </div>

                                        <div class="setup_element_social">
                                        <!-- Google+ -->
                                        <?php if($customer_info['social_go'] != ''){ ?>
                                            <a href="javascript:;"><?php echo $social_images['google']; ?></a><span class="social_status_on">Привязан</span>
                                        <?php }else{ ?>
                                            <a href="<?php echo $adapters['google']->getAuthUrl(); ?>"><?php echo $social_images['google']; ?></a><span class="social_status_off">Не привязан</span>
                                        <?php } ?>
                                        </div>

                                        <div class="setup_element_social">
                                        <!-- VK -->
                                        <?php if($customer_info['social_vk'] != ''){ ?>
                                            <a href="javascript:;"><?php echo $social_images['vk']; ?></a><span class="social_status_on">Привязан</span>
                                        <?php }else{ ?>
                                            <a href="<?php echo $adapters['vk']->getAuthUrl(); ?>"><?php echo $social_images['vk']; ?></a><span class="social_status_off">Не привязан</span>
                                        <?php } ?>
                                        </div>




                                        <!-- <div class="setup_element_social">
                                            <label class="social_status"> -->
                                            <!-- Facebook -->
                                            <!-- <?php if($customer_info['social_fb'] != ''){ ?>
                                                <font color="green">Привязан</font>
                                                </label>
                                                <a href="javascript:;"><?php echo $social_images['facebook']; ?></a>
                                            <?php }else{ ?>
                                                <font color="red">Нет привязки</font>
                                                </label>
                                                <a href="<?php echo $adapters['facebook']->getAuthUrl(); ?>"><?php echo $social_images['facebook']; ?></a>
                                            <?php } ?> -->
                                            
                                            <!-- Google+ -->
                                            <!-- label class="social_status">
                                            <?php if($customer_info['social_go'] != ''){ ?>
                                                <font color="green">Привязан</font>
                                                </label>
                                                <a href="javascript:;"><?php echo $social_images['google']; ?></a>
                                            <?php }else{ ?>
                                                <font color="red">Нет привязки</font>
                                                </label>
                                                <a href="<?php echo $adapters['google']->getAuthUrl(); ?>"><?php echo $social_images['google']; ?></a>
                                            <?php } ?> -->
                                        
                                            <!-- VK -->
                                            <!-- <label class="social_status">
                                            <?php if($customer_info['social_vk'] != ''){ ?>
                                                <font color="green">Привязан</font>
                                                </label>
                                                <a href="javascript:;"><?php echo $social_images['vk']; ?></a>
                                            <?php }else{ ?>
                                                <font color="red">Нет привязки</font>
                                                </label>
                                                <a href="<?php echo $adapters['vk']->getAuthUrl(); ?>"><?php echo $social_images['vk']; ?></a>
                                            <?php } ?>
                                   
                                        </div> -->



                                </div>
                                <div class="account-setup__block">
                                    <span class="account-setup__block-title">Сменить пароль</span>
                                    <div class="account-setup__block-row">
                                        <label for="pass1">Новый пароль:</label><input type="text" name="pass1" id="pass1">
                                    </div>
                                    <div class="account-setup__block-row">
                                        <label for="pass2">Ещё раз:</label><input type="text" name="pass2" id="pass2">
                                    </div>
                                    <button class="btn yellow-btn">Сменить пароль</button>
                                </div>
                          </div>
						  <div class="change-password-form">
							  Пароль успешно изменен
						  </div>
					  </div>
			        <?php } else { ?>
                      
                    <form  class="form-registration-drop" id="registration" method="post" enctype="multipart/form-data">
						<div class="title">Регистрация</div>
						<div class="register-wrapper">
						  <input type="hidden" name="customer_group_id" value="1" />
						  <input type="hidden" name="firstname" value="" id="input-firstname" class="form-control" />
						  <input type="hidden" name="lastname" value="" id="input-lastname" class="form-control" />
						  <div id="register-login-error" class="error_box">Некорректный e-mail!</div>
						  <div id="register-exist_email-error" class="error_box">Указанный e-mail уже загегистрирован!</div>
						  <input type="email" name="email" value="" placeholder="Email" id="input-email" class="form-control" />
						  <input type="hidden" name="telephone" value="" id="input-telephone" class="form-control" />
						  <input type="hidden" name="city" value="" id="input-city" class="form-control" />
						  <div id="register-password-error" class="error_box">Слишком короткий пароль!</div>
						  <input type="password" name="password" value="" placeholder="Пароль" id="input-password" class="form-control" />
						  <input type="hidden" name="confirm" value="" id="input-confirm" class="form-control" />
						  
						  <input type="hidden" name="fax" value="123456" id="input-fax" class="form-control" />
						  <input type="hidden" name="company" value="none" id="input-company" class="form-control" />
						  <input type="hidden" name="address_1" value="none" id="input-address-1" class="form-control" />
						  <input type="hidden" name="address_2" value="none" id="input-address-2" class="form-control" />
						  <input type="hidden" name="postcode" value="79000" id="input-postcode" class="form-control" />
						  <input type="hidden" name="country_id" value="220">
						  <input type="hidden" name="zone_id" value="0" id="input-zone" class="form-control">
						  <input type="hidden" name="agree" value="1"/>
						  <input type="hidden" name="newsletter" value="0" />
						
						  <div class="social_key_wrapper">
							<?php foreach ($adapters as $title => $adapter) { ?>
							  <div class="form_element_social">
								  <a href="<?php echo $adapter->getAuthUrl(); ?>"><?php echo $social_images[$title]; ?></a>
							  </div>
							<?php  } ?>
						  </div>
						</div>
						
						<div class="yellow-button" id="register-submit">Зарегестрироваться</div>
						<div class="register-wrapper1">
						  <a href="javascript:;" class="login">Уже есть аккаунт?</a>
						  <br><a href="javascript:;" class="forgotten">Забыли пароль?</a>
						</div>
					</form>
                  
                    <form  class="form-registration-drop" id="forgotten" method="post">
						<div class="title">Восстановление пароля</div>
						<div id="forgotten-error" class="error_box">Некорректный e-mail!</div>
						<div class="forgotten-wrapper">
						  <input type="text" placeholder="Email" name="email" id="forgotten-email"/>
						</div>
						<div class="yellow-button" id="forgotten-submit">Востановить</div>
						<a href="javascript:;" class="login">Уже есть аккаунт?</a>
						<br /><a href="javascript:;" class="registration">Зарегистрироваться</a>
					</form>
                   <?php } ?> 
  
				<!--end registration office-->

				<!--private office-->
				    <?php if ($logged) { ?>
					<?php } else { ?>
                    <form action="/<?php echo TMP_DIR;?>index.php?route=account/login" class="form-office-drop" method="post">
						<div class="title">Вход в интернет-магазин</div>
						<div class="login-wrapper">
						  <div id="login-error" class="error_box">Некорректный e-mail!</div>
						  <input type="text" placeholder="Email" name="email" id="login-email"/>
						  <div id="password-error" class="error_box">Некорректный пароль!</div>
						  <input type="password" placeholder="Пароль" name="password" id="login-password"/>
						  <div class="row clearfix">
							  <input type="checkbox" id="lbl1" />
							  <label for="lbl1">Запомнить меня</label>
						  </div>

                      	  <div class="social_key_wrapper">
                          <?php foreach ($adapters as $title => $adapter) { ?>
                            <div class="form_element_social">
                                <a href="<?php echo $adapter->getAuthUrl(); ?>"><?php echo $social_images[$title]; ?></a>
                            </div>
                          <?php  } ?>
						  </div>
                        
                        </div>
                        
                        <div style="clear: both;"></div>
                        <br>

						<div class="yellow-button" id="login-submit">Войти</div>
						<a href="javascript:;" class="forgotten">Забыли пароль?</a>
						<br /><a href="javascript:;" class="registration">Зарегистрироваться</a>
					</form>
                   <?php } ?> 
					
				<script>
				  //Регистрация
				  $(document).on('click', '#register-submit', function(){
					
					if ($(this).hasClass('close-btn')) {
                      $('.form-office-back').trigger('click');
					  return;
                    }
					
					var email = $('#input-email').val();
					var password = $('#input-password').val();
				
					if (email == '') {
                        showError('register-login-error');
						return;
                    }
					if (!isValidEmailAddress(email)) {
						showError('register-login-error');
                        return;
                    }
					if (password.length < 5) {
						showError('register-password-error');
                        return;
                    }
					
					$.ajax({
					  type: "POST",
					  url: "/"+tmp_dir+"index.php?route=account/register/register_ajax",
					  dataType: "text",
					  data: "email="+email+"&password="+password,
					  beforeSend: function(){
					  },
					  success: function(msg){
						console.log(  msg );
						if (msg == 'error') {
                            showError('register-login-error');
                            showError('register-password-error');
                        }
						else if (msg == 'exist_email') {
                            showError('register-exist_email-error');
                        }
						else if (msg == 'is_logined'){
						
						}
						else if(msg =='success') {
							$('.register-wrapper').html('Поздравляем с регистрацией.<br><br>');
							$('.register-wrapper1').html('');
                            $('#register-submit').html('OK');
							$('#register-submit').addClass('close-btn');
							setTimeout(function(){location.reload;}, 3000);
                        }
						
					  }
					});
					
				  });
				  
				  //ЛОГИН login
				  $(document).on('click', '#login-submit', function(){
					
					if ($(this).hasClass('close-btn')) {
                      $('.form-office-back').trigger('click');
					  return;
                    }
				
					var email = $('#login-email').val();
					var password = $('#login-password').val();
				
					if (email == '') {
                        showError('login-error');
						return;
                    }
					if (!isValidEmailAddress(email)) {
						showError('login-error');
                        return;
                    }
					
					$.ajax({
					  type: "POST",
					  url: "/"+tmp_dir+"index.php?route=account/login/login_ajax",
					  dataType: "text",
					  data: "email="+email+"&password="+password,
					  beforeSend: function(){
					  },
					  success: function(msg){
						console.log(  msg );
						if (msg == 'error') {
                            showError('login-error');
                            showError('password-error');
                        }
						if (msg == 'is_logined' || msg =='success') {
							$('.login-wrapper').html('Вы успешно вошли.');
                     		$('.login-wrapper').css('padding-bottom','30px');
                            $('#login-submit').html('OK');
							$('#login-submit').addClass('close-btn');
							setTimeout(function(){location.reload;}, 3000);
                        }
						
					  }
					});
					
				  });
				  
				  //Востановление пароля 
				  $(document).on('click', '#forgotten-submit', function(){
					var email = $('#forgotten-email').val();
					
					if ($(this).hasClass('close-btn')) {
                      $('.form-office-back').trigger('click');
					  return;
                    }
					
					if (email == '') {
                        showError('forgotten-error');
						return;
                    }
					if (!isValidEmailAddress(email)) {
						showError('forgotten-error');
                        return;
                    }
					
					$.ajax({
					  type: "POST",
					  url: "/"+tmp_dir+"index.php?route=account/forgotten/forgotten_ajax",
					  dataType: "text",
					  data: "email="+email,
					  beforeSend: function(){
					  },
					  success: function(msg){
						console.log(  msg );
						if (msg == 'error') {
                            showError('login-error');
                            showError('password-error');
                        }
						if (msg == 'is_logined' || msg =='success') {
                            $('.forgotten-wrapper').html('На e-mail выслан новый пароль.');
                            $('#forgotten-submit').html('OK');
							$('#forgotten-submit').addClass('close-btn');
					   }
						
					  }
					});
					
				  });
				  
				  function showError(target) {
					$('#'+target).show();
					setTimeout(function(){$('#'+target).hide(500);}, 3000);
                  }
				  
				  $(document).on('click', '#close-btn', function(){
					$('.form-office-back').trigger('click');
				  });
				
				  
				  $(document).on('click', '.forgotten', function(){
					$('.form-office-back').show();
					$('.form-office-drop').hide();
					$('#forgotten').show();
					$('#registration').hide();
				  });
				  $(document).on('click', '.registration', function(){
					$('.form-office-back').show();
					$('.form-office-drop').hide();
					$('#registration').show();
					$('#forgotten').hide();
				  });
				  $(document).on('click', '.form-office-drop-button', function(){
					$('.form-office-back').show();
					$('#forgotten').hide();
					$('#registration').hide();
					$('.form-office-drop').show();
				  });
				  $(document).on('click', '.login', function(){
					$('.form-office-back').show();
					$('#forgotten').hide();
					$('#registration').hide();
					$('.form-office-drop').show();
				  });
				  $(document).on('click', '.form-office-back', function(){
					$('.form-office-back').hide();
					$('#forgotten').hide();
					$('#registration').hide();
					$('.form-office-drop').hide();
				  });
				
				  
			
				  
				</script>
				<!--end private office-->
<?php //} ?>
				<!-- скроем избранное и просмотренное в кабинете -->
				<?php if(isset($shop) AND is_array($shop) AND count($shop) AND isset($_GET['_route_']) AND $_GET['_route_'] == TMP_DIR.'my_account'){ ?>
				<?php }else{ ?>
				  <div class="top-button right">
					  <div data-link="/<?php echo TMP_DIR;?>lovedproducts" class="links like-button right links-view-button">
						  <?php if($total_loved_products != ''){ ?>
							<span class="number loved_count"><?php echo $total_loved_products; ?></span>
						  <?php }else{ ?>
							<span class="number loved_count" style="display: none;"></span>
						  <?php } ?>
					  </div>
				  </div>
  
				  <div class="top-button right">
					  <div data-link="/<?php echo TMP_DIR;?>lastviewed" class="links view-button right">
						  <?php if($total_viewed_products != '0' AND $total_viewed_products != ''){ ?>
						  <span class="number"><?php echo $total_viewed_products; ?></span>
						  <?php } ?>
					  </div>
				  </div>
				<?php } ?>
				
				<!-- скроем поиск в кабинете -->
				<?php if(isset($shop) AND is_array($shop) AND count($shop) AND isset($_GET['_route_']) AND $_GET['_route_'] == TMP_DIR.'my_account'){ ?>
				<?php }else{ ?>
				  <div class="top-button top-button-search right">
					  <div data-link="/<?php echo TMP_DIR;?>?search" class="links search-button right">
					  </div>
				  </div>
				  
  
				  <form action="<?php echo trim(HTTP_SERVER, '/'.TMP_DIR);?>" class="search right clearfix">
					  <input type="text" class="left" name="search"/>
					  <button class="right"></button>
				  </form>
				<?php } ?>
      
			</div>
		</section>
	    <!-- end header section -->
        <!--tablet menu-->
        <div class="tablet-menu" id="tablet-menu">
            <a href="javascript:void(0)" class="close-tablet-menu">&times;</a>
            <div class="tab-link2">
                <?php foreach($categories as $categs_1){ ?>
                <a href="#tab<?php echo $categs_1['category_id'];?>"><?php echo $categs_1['name'];?></a>
                <?php } ?>
            </div>
            <div class="tab-cont2">
                <?php $count = 1; ?>
                <?php foreach($categories as $categs_1){ ?>
                <div id="tab<?php echo $categs_1['category_id'];?>" class="clearfix">
                    <div class="left-side left">
                        <ul>
                            <?php $count = 1; ?>
                            <?php foreach($categs_1['children'] as $categs_21){ ?>
                                <?php //Если это мобильная версия ?>
                                <?php if(IS_MOBILE == true){ ?>
                                    <li><a href="<?php echo $categs_21['href'];?>" class="item-<?php echo $count;?> <?php if($count++ == 1) echo 'active';?>"><?php echo $categs_21['name'];?></a></li>
                                <?php }else{ ?>
                                    <li><a href="javascript:void(0)" class="item-<?php echo $count;?> <?php if($count++ == 1) echo 'active';?>" data-link="<?php echo $categs_21['href'];?>"><?php echo $categs_21['name'];?></a></li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>

                    <?php $count_1 = 1; ?>
                    <?php //foreach($categories as $categs_11){ ?>
                    <div class="right-side right clearfix">
                        <?php foreach($categs_1['children'] as $categs_2){ ?>
                      
                        <div class="drop-menu-column item-<?php echo $count_1;?> clearfix <?php if($count_1++ == 1) echo 'active';?>">
                            
                            <?php $categ_tmp = array(); ?>
                            <?php foreach($categs_2['children'] as $categs_3){
                                $categ_tmp[] = $categs_3;
                            } ?>
                            
                            <ul class="column-menu left">
                                <?php for($i = 0; $i < (count($categ_tmp)/2); $i++){ ?>
                                    <li><a href="<?php echo $categ_tmp[$i]['href'];?>"><?php echo $categ_tmp[$i]['name'];?></a></li>
                                <?php } ?>
                               </ul>
                            <ul class="column-menu right">
                                <?php for($i = ((count($categ_tmp)/2)+1); $i < count($categ_tmp); $i++){ ?>
                                    <li><a href="<?php echo $categ_tmp[$i]['href'];?>"><?php echo $categ_tmp[$i]['name'];?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>
                    </div>
                    <?php //} ?>
                 </div>
            <?php } ?>
            </div>
			
        </div>
        <!--end tablet menu-->
        
    </div>   
</nav>
	
