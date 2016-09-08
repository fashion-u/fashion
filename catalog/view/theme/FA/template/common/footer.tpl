<!-- Theme created by Welford Media for OpenCart 2.0 www.welfordmedia.co.uk -->
<div class="footer-spacer"></div>
<!-- footer section -->
	<section class="footer-section">
		<div class="inner-block clearfix">

			<div class="footer-column left">
				<div class="title">Для посетителей</div>
				<ul>
					<li><div class="links link_style_1" data-link="/about">О проекте</div></li>
					<li><a href="/brands_and_shops">Бренды и магазины</a></li>
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
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter23765311 = new Ya.Metrika({
                    id:23765311,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/23765311" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45991278-1', 'auto');
  ga('send', 'pageview');
  setTimeout("ga('send','event','Engaged users','More than 15 seconds')",15000);

</script>        
						
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
					<li><div class="links link_style_1" data-link="/<?php echo TMP_DIR; ?>add_shop">Добавить магазин</div></li>
					<li><div class="links link_style_1" data-link="/<?php echo TMP_DIR; ?>membership">Cтраница виджетов</div></li>
					<li><div class="links link_style_1" data-link="/<?php echo TMP_DIR; ?>post-requirements">Условия размещения</div></li>
                    <li><div class="links link_style_1" data-link="/<?php echo TMP_DIR; ?>xml-requirements">Требованиея к xml</div></li>
					<li><div class="links link_style_1" data-link="/<?php echo TMP_DIR; ?>partner_enter">Вход для партнеров</div></li>
				</ul>
			</div>

		</div>
	</section>
	
	<DIV ID = "toTop" ><img src="/<?php echo TMP_DIR; ?>image/totop.png" alt="totop"></DIV>
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
            
            element.addClass('dell-love-btn');
            
            $.ajax({
                url: '/index.php?route=product/product/addLovedProduct',
                type: 'post',
                data: 'product_id=' + product_id,
                dataType: 'text',
                success: function(json) {
            
                    $('.loved_count').html(json);
					if (json == '0' || json == '') {
                        $('.loved_count').hide(1000);
                    }else{
						$('.loved_count').show(1000);
					}
                    
                    element.removeClass('add-love-btn');
                    
                    element.html('<img src="/'+tmp_dir+'image/love.png" class="as_link">');
                }
            });    
        });
		
		       $(document).on('click', '.dell-love-btn', function(){
            
            var product_id = $(this).data('id');
            var element = $(this);
            
            element.removeClass('dell-love-btn');
            
            $.ajax({
                url: '/index.php?route=product/product/dellLovedProduct',
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