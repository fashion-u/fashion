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
								<li><div class="links link_style_1" data-link="/about">О проекте</div></li>
								<li><a href="/brands_and_shops">Бренды и магазины</a></li>
								<li><div class="links link_style_1" data-link="/user-license">Пользовательское соглашение</div></li>
							</ul>
							<h2>Для магазинов</h2>
							<ul>
								<li><div class="links link_style_1" data-link="/add_shop">Добавить магазин</div></li>
								<li><div class="links link_style_1" data-link="/post-requirements">Условия размещения</div></li>
								<li><div class="links link_style_1" data-link="/xml-requirements">Требованиея к xml</div></li>
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
		$(document).on('click', '.add_shop_submit', function(){
			var name = $('.name').val();
			var email = $('.email').val();
			var adress = $('.adress').val();
			var phone = $('.phone').val();
			
		
			var error = 0;
			
			if(email != 0){
				if(isValidEmailAddress(email)){
					$(".error_email").hide(500);
				} else {
					$(".error_email").show(500);
					error = 1;
				}
			} else {
				$(".error_email").show(500);
				error = 1;
			}
			
			if (phone != '') {
                if(isValidPhone(phone)){
					$(".error_phone").hide(500);
				} else {
					$(".error_phone").show(500);
					error = 1;
				}
            }else{
				$(".error_phone").show(500);
				error = 1;
			}
			
			if (name != '') {
               	$(".error_name").hide(500);
            }else{
				$(".error_name").show(500);
				error = 1;
			}
			 
			if(error == 0){
				
				$(".add_shop_form").submit();
					
			}
		
			
		});
	
		function isValidEmailAddress(emailAddress) {
			var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return pattern.test(emailAddress);
		}
		
		function isValidPhone(phoneV) {
			
			phoneV = phoneV.replace(/[^+0-9]/gim,'')
			
			// Определяем длину значения поля
			var phoneLngth = phoneV.length;
		
			// Проверяем чтобы в поле были только цифры
			if( /[^+0-9]/.test(phoneV) ){
				$('.error_phone').html('Номер телефона должен содержать только цифры');
				return false;
			}else if (phoneLngth <= 11){
			// Проверяем чтобы длина номера телефона была 7 символов
				$('.error_phone').html('Введите пожалуйста ваш номер телефона');
				return false;
			}else if ((phoneV.indexOf('+380') + 1) == 0){
			// Не верный формат
				$('.error_phone').html('Не верный формат +380 067 111 2233');
				return false;
			}else{
			// Здесь мы пишем что должно быть, если все введено верно
				return true;
			}
	
		}
		
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
                                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                                <?php } ?>
                              <?php } ?>
                          </ul>
                      </nav>
                      <!--end breadcrumbs-->
                      
                      	<!--alphabet section-->
						<?php if(isset($success)){ ?>
							<section class="add-store-form">
								<h2>Заявка отправлена успешно</h2>
								<script>
									$(document).ready(function(){
										
										setTimeout(function(){
											location.href = '/';
											}, 5000);
											
									});
								</script>
							</section>
						<?php }else{ ?>
							<section class="add-store-form">
								<h2>Добавить магазин</h2>
								
								<?php if(isset($error)){ ?>
									<b><font color="red"><?php echo $error;?></font></b><br>
								<?php } ?>
								
								<form action="/add_shop" method="post" enctype="multipart/form-data" class="add_shop_form">
									<div class="row">
										<span class="form__error error_email">Не верный емаил</span>
										<input type="text" placeholder="Email" name="email" class="email">
									</div>
									<div class="row">
										<input type="text" placeholder="Адрес сайта" name="adress" class="adress">
									</div>
									<div class="row">
										<span class="form__error error_name">Вы не представились</span>
										<input type="text" placeholder="Имя" name="name" class="name">
									</div>
									<div class="row">
										<span class="form__error error_phone">Не верный формат телефона</span>
										<input type="text" placeholder="+380 067 111 2233" name="phone" class="phone">
									</div>
									
									<div class="row">
										<span class="form__error error_file">Не верная ссылка на фаил</span>
										<input type="text" class="inputFileUrl"  name="file_url" id="fileUrl" placeholder="URL xml-файла">
									</div>
									
									<div class="row">
										<div class="type_file">
											<input type="file" name="file" size="61" class="inputFile" onchange="document.getElementById(&quot;fileName&quot;).value=this.value">
											<div class="fonTypeFile"></div>
											<input type="text" class="inputFileVal" readonly="readonly" id="fileName" placeholder="Прикрепить xml-файл">
										</div>
									</div>
									<div class="row">
										<div class="yellow-button-no-link add_shop_submit">Добавить магазин</div>
									</div>
								</form>
							</section>
							<script>
								$(document).on('click', '.add_shop_submit', function(){
									$('.add_shop_form').submit();
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
