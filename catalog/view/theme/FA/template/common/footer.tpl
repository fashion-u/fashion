<!-- Theme created by Welford Media for OpenCart 2.0 www.welfordmedia.co.uk -->
<div class="footer-spacer"></div>
<!-- footer section -->
	<section class="footer-section">
		<div class="inner-block clearfix">

			<div class="footer-column left">
				<div class="title">Для посетителей</div>
				<ul>
					<li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>about">О проекте</div></li>
					<li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>brands_and_shops">Бренды и магазины</a></li>
					<li>&nbsp;</li>
					<!--li><div class="links link_style_1" data-link="/user-license">Пользовательское соглашение</div></li-->
					<li>
	
	
<script src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/js/lib/jquery-ui.min.js" type="text/javascript"></script>
<script src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/js/lib/icheck.min.js" type="text/javascript"></script>
<script src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/js/lib/placeholders.js" type="text/javascript"></script>
<script src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/js/lib/jquery.selectBoxIt.min.js" type="text/javascript"></script>
<script src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/js/lib/jquery.jscrollpane.min.js" type="text/javascript"></script>
<script src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/js/lib/jquery.mousewheel.js" type="text/javascript"></script>
<script src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/js/lib/magnific-popup.min.js" type="text/javascript"></script>
<script src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/js/scripts.js" type="text/javascript"></script>
<script src="/<?php echo TMP_DIR; ?>catalog/view/javascript/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!-- Yandex.Metrika counter -->
<?php
	if(strpos($_SERVER['HTTP_HOST'], '.shopsplum.com') !== false){
        include ".assets/domain.shopsplum.com/metrika.php";  
    }elseif(strpos($_SERVER['HTTP_HOST'], 'shopsplum.com') !== false){
        include ".assets/shopsplum.com/metrika.php";  
    }else{
        include ".assets/".$_SERVER['HTTP_HOST']."/metrika.php";    
    }
?>	

     
						
					</li>
				</ul>
			</div>

			<div class="footer-column left">
				<div class="title">Мы в соцсетях</div>
				<div class="socials-line">
					<a href="https://www.facebook.com/FashionUcomua/" target="_blank" class="social item-1"></a>
					<a href="https://vk.com/fashionucomua" target="_blank" class="social item-2"></a>
					<a href="https://twitter.com/FashionUcomua" target="_blank" class="social item-3"></a>
					<a href="javascript:;" target="_blank" class="social item-4"></a>
				</div>
			</div>

			<div class="footer-column left">
				<div class="title">Для магазинов</div>
				<ul>
					<li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>add_shop">Добавить магазин</div></li>
					<li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>membership">Cтраница виджетов</div></li>
					<li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>post-requirements">Условия размещения</div></li>
                    <li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>xml-requirements">Требованиея к xml</div></li>
					<!--li><div class="links link_style_1" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>partner_enter">Вход для партнеров</div></li-->
				</ul>
			</div>

		</div>
	</section>
	
	<DIV ID = "toTop" ><img src="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>image/totop.png" alt="totop"></DIV>
	<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script-->
 
	<script type="text/javascript">
	 
		$(function() {
		 
			$(window).scroll(function() {
			 
				if($(this).scrollTop() != 0) {
				 
					$('#toTop').fadeIn();
					
					if ($(document).width() > 1280) {
                        $('.filter-line').addClass('fixed_position');
                    }
				 
				} else {
				 
					$('#toTop').fadeOut();
					$('.filter-line').removeClass('fixed_position');
				 
				}
				 
			});
				 
				$('#toTop').click(function() {
				 
				$('body,html').animate({scrollTop:0},800);
			 
			});
		 
		});
		$(document).on('click', '.add-love-btn', function(){
            
            var product_id = $(this).data('id');
            var element = $(this);
            
            $.ajax({
                url: '/'+tmp_dir+'index.php?route=product/product/addLovedProduct',
                type: 'post',
                data: 'product_id=' + product_id,
                dataType: 'text',
                success: function(json) {
            
					console.log(json);
					
					if (json == 'nologin') {
                        alert('Вам нужно зарегистрироваться или войти.');
                    }else{
					
						element.addClass('dell-love-btn');
						element.removeClass('add-love-btn');
						element.html('<img src="/'+tmp_dir+'image/love.png" class="as_link">');
				
						$('.loved_count').html(json);
						if (json == '0' || json == '') {
							$('.loved_count').hide(1000);
						}else{
							$('.loved_count').show(1000);
						}
					}
                    
                }
            });    
        });
		
		       $(document).on('click', '.dell-love-btn', function(){
            
            var product_id = $(this).data('id');
            var element = $(this);
            
            element.removeClass('dell-love-btn');
            
            $.ajax({
                url: '/'+tmp_dir+'index.php?route=product/product/dellLovedProduct',
                type: 'post',
                data: 'product_id=' + product_id,
                dataType: 'text',
                success: function(json) {
                    element.addClass('add-love-btn');
               
                    $('.loved_count').html(json);
					if (json == '0' || json == '') {
                        $('.loved_count').hide(1000);
                    }else{
						$('.loved_count').show(1000);
					}
					
                    element.html('');
                }
            });    
        });
	   

	</script>
	
	<!-- end footer section -->
</body></html>