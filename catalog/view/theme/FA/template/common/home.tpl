<?php echo $header; ?>

<?php //echo $column_left; ?>
<?php //echo $column_right; ?>
  <!--content section-->
		<section class="content-section">
			<div class="inner-block">

				<!--category list info-->
				<div class="category-list-info clearfix">

					<!--category menu-->
					<nav class="category-menu left">
                        <ul>
							<?php foreach($left_category as $index => $categ){ ?>
							<li><a href="<?php echo $categ['href']; ?>"><?php echo $categ['name']; ?></a></li>
							<?php } ?>
						</ul>
					</nav>
					<!--end category menu-->
					<script>
						var rotation_count = 0;
						
						//$(document).ready(function(){rotation();});
						setTimeout(function(){rotation();}, 5000);
						
						function rotation(){
							
							//Добавим счетчик
							rotation_count = rotation_count + 1;
							
							//Обнулить
							if($('#folder-slider-'+rotation_count).hasClass('folder-slider')){
							}else{
								rotation_count = 0;
							}
						
							//Покажем обьект
							$('#folder-slider-'+rotation_count).show(500);
							
							//Скроем все остальные обьекты
							$.each($('.folder-slider'), function( index, value ) {
								
								if ($(this).attr('id') == 'folder-slider-'+rotation_count) {
									   
                                }else{
									$(this).hide(500);
								}
							});
							
							//Поехали по кругу
							setTimeout(function(){rotation();}, 5000);
						}
					</script>
					
					
					<div class="banners clearfix">
						<div class="inner-special-box">
							<div class="banner left">
								<?php $count = 0;
									foreach($large_banners as $baner){ ?>
								<div class="folder-slider" id="folder-slider-<?php echo $count++; ?>">
									<a href="<?php echo $baner['baner_url'];?>"><img src="/<?php echo TMP_DIR;?>image/banners/mainpage_large/<?php echo $baner['baner_pic'];?>" alt="картинка <?php echo $baner['baner_header'];?>" /></a>
									<?php if($baner['baner_title'] != ''){?>
									<a href="<?php echo $baner['baner_url'];?>"><span><?php echo $baner['baner_title'];?></span></a>
									<?php } ?>
								</div>
								<?php } ?>
							</div>
							<div class="banner right">
								<?php foreach($medium_banners as $medium_banner){ ?>
								<figure><a href="<?php echo $medium_banner['baner_url'];?>"><img src="/<?php echo TMP_DIR;?>image/banners/mainpage_medium/<?php echo $medium_banner['baner_pic'];?>" alt="Картинка <?php echo $medium_banner['baner_header'];?>" /></a></figure>
								<?php } ?>
							</div>
						</div>
					</div>

				</div>
				<!--end category list info-->

				<!--important product-->
				<section class="important-product">
					<span class="__large2">Актуально</span>
					<div class="row clearfix">
						<?php foreach($season_products as $season_product){ ?>
						<article class="small-product-box left">
							<a href="<?php echo $season_product['baner_url'];?>">
								<img src="/<?php echo TMP_DIR;?>image/banners/season_products/<?php echo $season_product['baner_pic'];?>" alt="Картинка <?php echo $season_product['baner_header'];?>" />
								<div class="__large2"><?php echo $season_product['baner_title'];?></div>
							</a>
						</article>
						<?php } ?>
					</div>
				</section>
				<!--end important product-->

				<!--top store section-->
				<section class="top-store-section">
					<span class="__large2">магазин недели</span>
					<div class="info-line clearfix">
						<figure class="left"><a href="/shops"><img src="/<?php echo TMP_DIR;?>image/shops/<?php echo $shop['image'];?>" alt="Картинка <?php echo $shop['name'];?>" /></a></figure>
						<div class="info">
							<?php echo $shop['description'];?>
						</div>
					</div>
					<div class="product-line clearfix">

						<!--product-->
						<?php foreach ($viewed_products as $product) { ?>
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
                                              <a  href="javascript:;" class="love-button dell-love-btn loved_link" data-id="<?php echo $product['product_id'];?>">+</a>
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
                                              <div class="size">Размеры <!--(<?php echo $group; ?>)-->:  <?php echo implode(', ',$size); ?>
                                            <?php } ?>
                                            </div>
                                            <div class="links info-button" data-link="<?php echo $product['href']; ?>"></div>
                                        </div>
                                    </div>
                              </div>
                              <?php } ?>
						<!--end product-->

					</div>
				</section>
				<!--end top store section-->

				<!--popular brands section-->
				<section class="popular-brands-section">
					<span class="__large2">Популярные бренды</span>
					<ul class="clearfix">
						<?php foreach($manufacturer_baners as $manufacturer){ ?>
						<li>
							<div class="inner">
								<a href="/<?php echo $manufacturer['href'];?>"><img src="/<?php echo TMP_DIR; ?>image/brands/<?php echo $manufacturer['image'];?>" alt="" /></a>
							</div>
						</li>
						<?php } ?>
					</ul>
				</section>
				<!--end popular brands section-->

				<section class="about-section">
					<?php echo $description; ?>
				</section>

				

			</div>
		</section>
	    <!--end content section-->
	            
		<!-- end wrapper -->

<?php echo $footer; ?>