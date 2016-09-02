<?php echo $header; ?>
<input type="hidden" id="helikopter" value="<?php echo $helikopter; ?>">
<input type="hidden" id="helikopter_next_href" value="<?php echo $helikopter_next_href; ?>">
 
  <!--content section-->
  <section class="content-section">
      <div class="inner-block">

          <div class="special-row clearfix">
      <style>
		.cont {
			float: none;
			margin: 0;
		}
	  </style>        
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
              
                      <!--menu tablet line-->
					  <?php if(isset($categories['categories'])){ ?>
						<div class="menu-tablet-line-section">
							<div class="menu-tablet-line scrollblock">
								<div class="inner clearfix">
									<ul class="clearfix left">
										<li class="title left mobile-off"><a href="#" class="active"><?php echo $heading_title; ?></a></li>
										<?php $count = 1; ?>
										
										
										  <?php foreach($categories['categories'] as $category){ ?> //$categories
										  <li>
											  <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
											  <?php if($count < count($categories)){ ?>
											  <span>-</span>
											  <?php } ?>
										  </li>
										  <?php } ?>
									  
									</ul>
								</div>
							</div>
						</div>
					  <?php } ?>
                      <!--end menu tablet line-->


                      <!--sort section-->
                      <section class="sort-section">
                          <div class="big-title"><span class="__large2" style="float: left; font-weight: bold;"><?php echo $heading_title; ?></span></div>
                          <div class="sort-select-line clearfix">
                              <div class="sort-mobile-box left clearfix">
                                  <a href="javascript:void(0)" class="item-1 active left"></a>
                                  <a href="javascript:void(0)" class="item-2 left"></a>
                              </div>
                              <div class="filter-drop-box right">
                                  <a href="javascript:void(0)" class="filter-button">Фильтры</a>
                                      
                              </div>
								<div class="sort-select right" style="z-index:9999;">
									 <div class="title"><!--Сортировать:--></div>
									   <select class="sort">
										   <option value="">Сортировать:</option>
										   <option value="viewed" <?php if(isset($_GET['sort']) AND $_GET['sort'] == 'viewed') echo 'selected';?>>по популярности</option>
										   <option value="cheap" <?php if(isset($_GET['sort']) AND $_GET['sort'] == 'cheap') echo 'selected';?>>по цене 0 -> 100</option>
										   <option value="expensive" <?php if(isset($_GET['sort']) AND $_GET['sort'] == 'expensive') echo 'selected';?>>по цене 100 -> 0</option>
									   </select>
								 </div>
                          </div>
						    <script>
								$(document).on('change', '.sort', function(){
									if ($(this).val() == '') {
										location.href = '<?php echo $_GET['_route_']?>';
									}else{
										location.href = '<?php echo $_GET['_route_']?>?sort='+$(this).val();
									}
									
								});
								
							</script>
                          
                                                 <?php if ($products) { ?>
                          <div class="product-line special clearfix">
                              <!--product-->
                              <?php
                                    $products_id = array();
                                    foreach ($products as $product) {
                                    $products_id[] = $product['product_id'];
                              } ?>
                              <?php foreach ($products as $product) { ?>
                              <div class="links_blank" data-link="<?php echo $product['href']; ?>">
                                    <div class="product left">
                                        <div class="inner">
                                            <!--div class="discount">20%</div-->
                                          <?php if(isset($_SESSION['default']) AND isset($_SESSION['default']['user_id']) AND (int)$_SESSION['default']['user_id'] > 0){ ?>
                                              <div class="discount">                                            
                                                  <a style="z-index:99999;" class="moderation_link" href="/<?php echo TMP_DIR; ?>backend/index.php?route=moderation/product.list.php&amp;id=<?php echo $product['product_id'];?>&amp;products=<?php echo implode(',',$products_id); ?>" target="_blank">
                                                      <img src="/<?php echo TMP_DIR; ?>backend/img/remit_c_icon4.png" class="as_link" title="модерировать" width="32" height="32">
                                                  </a>
                                              </div>
                                          <?php } ?>
                                          <?php if(isset($product['loved']) AND $product['loved'] > 0){ ?>
                                              <a  href="javascript:;" class="love-button dell-love-btn loved_link" data-id="<?php echo $product['product_id'];?>">
												<img src="/image/love.png" class="as_link" style="">
											  </a>
                                          <?php }else{ ?>
                                              <a  href="javascript:;" class="love-button add-love-btn loved_link" data-id="<?php echo $product['product_id'];?>"></a>
                                          <?php } ?>
                                            <figure>
                                                <img src="<?php echo $product['thumb'];?>" alt="" title="" />
                                            </figure>
                                            <div class="name"><?php echo $product['name'];?></div>
                                            <div class="status"><?php echo $product['manufacturer'];?></div>
                                            <div class="price"><?php echo $product['price'];?> грн.</div>
                                            <div class="site"><?php echo $product['shop_name'];?></div>
                                            <?php if(count($product['size']) > 0){ ?>
                                              <?php
                                                $size = array();
                                                $group = '';
                                                foreach($product['size'] as $size_a) {
                                                  $group = $size_a['group_name'];
                                                  $size[] = $size_a['size_name'];
                                                }
                                              ?>
                                              <div class="size">Размеры <!--(<?php echo $group; ?>)-->:  <?php echo implode(', ',$size); ?></div>
                                            <?php } ?>
                                            
                                            <div class="links info-button" data-link="<?php echo $product['href']; ?>"target="_blank"></div>
                                        </div>
                                    </div>
                              </div>
                              <?php } ?>
                              <!--end product-->
                            </div>
                          <?php } ?>
  
    <script>

	   
	    var loading = false;
        var position = 0;
        var page = 2;
       
        $(document).on('click', '.upload_content', function(){
       
            var key = 1;
            
            $('.navigation').hide(500);
            var page = $(this).data('page');
            
            $('.upload_content').html('Загружаю');
            
             setTimeout(load_products(page), 1400);
            
            page = page + 1;
            $(this).data('page', page);
       
        });
          
        $(window).scroll(function(){
			if ($('.upload_content').length > 0) {
				if((($(window).scrollTop()+$(window).height())-150)>=$('.upload_content').offset().top){
					
					//console.log($('.upload_content').offset().top);
					
					if(loading == false){
						loading = true;
						
						if (position < $(window).scrollTop()) {
							
							position = $(window).scrollTop();
							
							$('.upload_content').trigger('click');
							 
							//console.log('+'+$(window).scrollTop());
							
						}
						
						
					}
				}
			}
            });
        
		$(document).on('click', '.upload_content_click', function(){
            $(this).addClass('upload_content');
            $(this).removeClass('upload_content_click');
            $('.upload_content').trigger('click');
        });
        
        $(document).ready(function() {
            //$('#loaded_max').val(50);
        });
       
        function load_products(page) {
            //$('.product-line').append('1111111111111111111');
            
            $.ajax({
                url: '/<?php echo $_GET['_route_']; ?>?page='+page,
                type: 'post',
                data: 'autoload=true',
                dataType: 'json',
                success: function(json) {

                    //console.log(json);
                    
                    $.each(json, function( index, value ) {
                            
                            //Клонируем последний обьект
                            var html = '<div class="links_blank" data-link="*">';
                                html = html + '<div class="product left">'+$('.product').last().html()+'</div></div>'
                            $('.product-line').append(html);
                            
                            //Заполним его новыми данными
                            $('.product-line').last().children('.name').html(value['name']);
                            
							$('.links_blank').last().data('link', value['href']);
                            $('.product').last().children('.inner').children('.name').html(value['name']);
                            $('.product').last().children('.inner').children('.price').html(value['price']+' грн.');
                            $('.product').last().children('.inner').children('.status').html(value['manufacturer']);
                           // $('.product').last().children('.inner').children('.status').children('a').prop('href', value['manufacturer_href']);
                            $('.product').last().children('.inner').children('figure').children('img').attr('src', value['thumb']);
                            
                            $('.product').last().children('.inner').children('.site').children('a').html(value['shop_name']);
                            $('.product').last().children('.inner').children('.loved_link').attr('data-id', value['product_id']);
                           
                            $('.product').last().children('.inner').children('.discount').children('.moderation_link').prop('href', '/backend/index.php?route=moderation/product.list.php&id='+value['product_id']+'&products='+value['product_id']);
                            $('.product').last().children('.inner').children('.info-button').prop('href', value['href']);
                            
                             
                            var size = ''; 
                            $.each(value['size'], function( size_index, size_value ) {
                                size = size + size_value['size_name'] + ', ';
                            });
                            size = size.substring(0, size.length - 2);
                            
                            $('.product').last().children('.inner').children('.size').html('Размеры : '+size);
                       
                    });
                    
                    if (json != '') {
                        page = page + 1;
                        //setTimeout(load_products(page), 1000);
                        $('.upload_content').html('Посмотреть все');
                        
                        loading = false;
                    }else{
                        $('.upload_content').html('Показаны все товары');
                    }
                    
                }
            });
            
        }
       
	   
    </script>                        
                          
                          <div class="navigation-line clearfix">
                                <?php if(!isset($_GET['page']) OR (isset($_GET['page']) AND $_GET['page'] == 1)){ ?>
                                    <a href="javascript:void(0)" class="border-button upload_content_click" data-page="2">Посмотреть все</a>
                                <?php } ?>          
                                <nav class="navigation right inline" style="margin-right: 30px;">
                                      <?php echo $pagination; ?>
                                </nav>
                            </div>

                  </div>
              </section>
              <!--end cont-->

          </div>

          <section class="about-product clearfix">
              <!--figure class="left"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img8.jpg" alt="" /></figure-->
              <div class="info">
                  <h2><?php echo $heading_title;?></h2>
                  <p>
                      <?php echo $description;?>
                  </p>
              </div>
          </section>

      </div>
  </section>

<?php echo $footer; ?>
