<?php echo $header; ?>
<style>
    .rabat{
        float: right;
        color: red;
        font-size: 14px;
        font-weight: bold;
    }
    .old_price{
        float: left;
    }
</style>
 <!--System-->
 <input type="hidden" id="helikopter" value="<?php echo $helikopter; ?>">
 <input type="hidden" id="helikopter_next_href" value="<?php echo $helikopter_next_href; ?>">
 <!-- end System-->
  <!--content section-->  
  <section class="content-section">
      <div class="inner-block">

          <div class="special-row clearfix">

              <!--sidebar-->
              <?php if(count($categories) > 0){ ?>
              <section class="sidebar left">
                  <!--category menu-->
                  <nav class="category-menu">
                      <?php if(isset($categories['header'])){ ?>
                        <span class="__large2"><?php echo $categories['header']; ?></span>
                      <?php } ?>
                      <ul class="catalog__ul">
                        <?php if(isset($categories['categories'])){ ?>
                            <?php foreach($categories['categories'] as $category){ ?>
                                <?php if($category_id == $category['category_id']) { ?>
                                    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $category['href']; ?>" class="active_categ"><?php echo $category['name']; ?></a></li>
                                <?php }else{ ?>
                                    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>  
                                <?php } ?>
                            <?php } ?>  
                        <?php } ?>
                      </ul>
                  </nav>
                  <!--end category menu-->
              </section>
              <?php }else{ ?>
                <style>
                  .cont{
                    margin: 0;
                  }
                </style>
              <?php } ?>
              <!--end sidebar-->

              <!--cont-->
              <section class="cont right">
                  <div class="inner-special-box special">

                      <!--breadcrumbs-->
                      <nav class="breadcrumbs inline mobile-off">
                          <ul class="clearfix">
                              <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                                <?php if($breadcrumb['href'] == ''){ ?>
                                    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                                <?php }else{ ?>
                                    <li><a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                                <?php } ?>
                              <?php } ?>
                          </ul>
                      </nav>
                      <!--end breadcrumbs-->

                      <?php if(isset($_GET['_route_']) AND ($_GET['_route_'] == 'lastviewed' OR $_GET['_route_'] == 'lovedproducts')){ ?>
                      <?php }else{ ?>
                      <!--menu tablet line-->
                      <div class="menu-tablet-line-section">
                          <a class="menu-tablet-arrow-left"><img src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/image/btn/filter-prev-button.png" alt="arrow-left"></a>
                          <div class="menu-tablet-line scrollblock">
                              <div class="inner clearfix">
                                  <ul class="clearfix left">
                                      <!-- <li class="title left mobile-off"><a href="#" class="active"><?php echo $heading_title; ?></a></li> -->
                                      <?php $count = 1; ?>
                                      <?php foreach($categories['categories'] as $category){ ?> 
                                      <li>
                                          <a href="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>&nbsp;&nbsp;
                                          <?php if($count < count($categories)){ ?>
                                          <span>-</span>
                                          <?php } ?>
                                      </li>
                                      <?php } ?>
                                      <!--li>
                                          <a href="#" class="active">Юбки</a>
                                          <span>-</span>
                                      </li-->
                                  </ul>
                              </div>
                          </div>
                          <a class="menu-tablet-arrow-right"><img src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/image/btn/filter-next-button.png" alt="arrow-right"></a>
                      </div>
                      <!--end menu tablet line-->
                      <?php } ?>

                      <!--sort section-->
                      <section class="sort-section">
                        <?php if($heading_title != ''){ ?>
                          <div class="big-title">
                            <h1 style="font-size:22px;margin-top: 0; margin-bottom: 0;"><?php echo $heading_title; ?></h1>
                          </div>
                        <?php } ?> 
                    <?php if(isset($_GET['_route_']) AND ($_GET['_route_'] == 'women' OR $_GET['_route_'] == 'children' OR $_GET['_route_'] == 'man' OR $_GET['_route_'] == 'lastviewed' OR $_GET['_route_'] == 'lovedproducts')){ ?>
                    <?php }else{ ?>
                         
                         
                          <div class="sort-select-line clearfix">
                              <div class="sort-mobile-box left clearfix">
                                  <a href="javascript:void(0)" class="item-1 active left"></a>
                                  <a href="javascript:void(0)" class="item-2 left"></a>
                              </div>
                              <div class="filter-drop-box right">
                                  <a href="javascript:void(0)" class="filter-button" data-mfp-src="#filter-popup">Фильтры</a>
                              </div>
                              <div class="sort-select right" style="z-index:99;">
                                  <div class="title"><!--Сортировать:--></div>
                                    <select class="sort" >
                                        <option value="viewed" data-hrefurl="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $nosort_alias; ?>" <?php if(isset($_GET['sort']) AND $_GET['sort'] == 'viewed') echo 'selected';?>>по популярности</option>
                                        <option value="cheap" data-hrefurl="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $nosort_alias; ?>" <?php if(isset($_GET['sort']) AND $_GET['sort'] == 'cheap') echo 'selected';?>>по возрастанию цены</option>
                                        <option value="expensive" data-hrefurl="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $nosort_alias; ?>" <?php if(isset($_GET['sort']) AND $_GET['sort'] == 'expensive') echo 'selected';?>>по убыванию цены</option>
                                        <option value="sale" data-hrefurl="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $nosort_alias; ?>" <?php if(isset($_GET['sort']) AND $_GET['sort'] == 'sale') echo 'selected';?>>по скидке</option>
                                    </select>
                              </div>
                          </div>
                  
                          <script>
                            $(document).on('change', '.sort', function(){
                             
                                var route = '<?php echo $_GET['_route_']?>';
                                route = route.replace('viewed-','');
                                route = route.replace('cheap-', '');
                                route = route.replace('sale-','');
                                route = route.replace('expensive-','');
                                
                                if ($(this).val() == '') {
                                    location.href = 'http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>'+route;
                                }else{
                                    location.href = 'http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>'+$(this).val()+'-'+route;
                                }
                                
                            });
                            
                          </script>
                          <?php
                          //echo "<pre>";  print_r(var_dump( $_COOKIE )); echo "</pre>";
                          ?>
                          <div id="filter-popup" class="filter-line clearfix mfp-hide" style="">
                           
                                
                            <?php include($_SERVER['DOCUMENT_ROOT'].'/'.TMP_DIR.'catalog/view/theme/FA/template/product/filter.tpl');?>

                              </div>               

                      </section>
                      <!--end sort section-->

                   <script>

                    $("select").on('change', function(ev, obj) {
                        
                        var target = obj.selectbox.context.value;
                        
                        $('.size-tab').each(function(index){
                            $(this).hide();
                        });
                        
                        $('.size-tab-'+target).show();
                         
                    });
                    $('input').on('ifChecked', function(event){
                        var url = '<?php echo $_GET['_route_'];?>';
                        var tmp_dir = '<?php echo TMP_DIR;?>';
                        var filter = event.target.id;
                        
                        url = url.replace(tmp_dir,'');
                        url = filter+'-'+url;
                        url = tmp_dir+url;
                        
                        //location.href = '/'+url;
                    });
                    
                   $('input').on('ifUnchecked', function(event){
                        var url = '<?php echo $_GET['_route_'];?>';
                        var tmp_dir = '<?php echo TMP_DIR;?>';
                        var filter = event.target.id;
                        
                        url = url.replace(tmp_dir,'');
                        url = url.replace(filter,'');
                        url = url.replace('--','-');
                        
                        if (url[0] == '-') {
                            url = url.substr(1);
                        }
                        
                        url = tmp_dir+url;
                        
                        //location.href = '/'+url;
                    });
                    
                </script>
                    
            <?php } ?> 
                
             
                        <?php if ($products) { ?>
                          <div class="product-line special clearfix">
                              <!--product-->
                              <?php $date_v = date('Y-m-d') ?>
                              <?php
                                    $products_id = array();
                                    foreach ($products as $product) {
                                    $products_id[] = $product['product_id'];
                              } ?>
                              <?php foreach ($products as $product) { ?>
                               
                              <?php if(isset($_GET['_route_']) AND $_GET['_route_'] == 'lastviewed'){ ?>
                                <?php if(date('Y-m-d', strtotime($date_v)) != date('Y-m-d', strtotime($product['viewed']))) {
                                      $date_v = date('Y-m-d', strtotime($product['viewed'])); ?>
                                  
                                      <div style="clear: both;"></div>    
                                      <div class="viewed_date"><?php echo $date_v;?></div>
                                <?php } ?>
                              <?php } ?>
                              
                              <?php if($product['product_id'] == 'system' AND $product['name'] == 'break_stop_line') { ?>
                                    <div style="clear: both;"></div>    
                                    <div class="viewed_date"><div class="links" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $product['href'];?>"><?php echo $product['header_name'];?></div></div>
                                    <?php continue; ?>
                              <?php } ?>
                            
                              
                              <div class="links_blank helikopter" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $product['href']; ?>">
                                    <div class="product left">
                                        <div class="inner">
                                            <!--div class="discount">20%</div-->
                                          <?php if(isset($_SESSION['default']) AND isset($_SESSION['default']['user_id']) AND (int)$_SESSION['default']['user_id'] > 0){ ?>
                                              <div class="discount">                                            
                                                  <a style="z-index:99;" class="moderation_link" href="/<?php echo TMP_DIR; ?>backend/index.php?route=moderation/product.list.php&amp;id=<?php echo $product['product_id'];?>&amp;products=<?php echo implode(',',$products_id); ?>" target="_blank">
                                                      <img src="/<?php echo TMP_DIR; ?>backend/img/remit_c_icon4.png" class="as_link" title="модерировать" width="32" height="32">
                                                  </a>
                                              </div>
                                          <?php } ?>
                                          <?php if(isset($product['loved']) AND $product['loved'] > 0){ ?>
                                              <a  href="javascript:;" class="love-button dell-love-btn loved_link" data-id="<?php echo $product['product_id'];?>">
                                                <img src="/<?php echo TMP_DIR; ?>image/love.png" class="as_link" >
                                                </a>
                                          <?php }else{ ?>
                                              <a  href="javascript:;" class="love-button add-love-btn loved_link" data-id="<?php echo $product['product_id'];?>"></a>
                                          <?php } ?>
                                            <figure>
                                                <img src="<?php echo $product['thumb'];?>" alt="" title="" />
                                            </figure>
                                            <div class="name"><?php echo $product['name'];?></div>
                                            <div class="status"><?php echo $product['manufacturer'];?></div>
                                            <?php if($product['old_price'] > 0 AND $product['old_price'] > $product['price']){ ?>
                                                <div class="old_price"><?php echo $product['old_price'];?> грн.</div><div class="rabat">-<?php echo number_format(100 - ((int)$product['price'] / ((int)$product['old_price'] / 100)), '2', '.', '');?> %</div>
                                            <?php }else{ ?>
                                                <div class="old_price"></div>
                                            <?php } ?>
                                            <div style="clear: both;"></div>
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
                                            <?php } else { ?>
                                              <div class="size">&nbsp;</div>
                                            <?php } ?>                                            
                                            <div class="links info-button" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?><?php echo $product['href']; ?>"></div>
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
                
                    if(loading == false){
                        loading = true;
                        
                        if (position < $(window).scrollTop()) {
                            
                            position = $(window).scrollTop();
                            
                            $('.upload_content').trigger('click');
                             
                         }
                        
                        
                    }
                }
            }
        });
        
        
        $(document).ready(function() {
            //$('#loaded_max').val(50);
        });
       
        var date_v = '<?php echo $date_v;?>';
       
        function load_products(page) {
            debugger;
            $.ajax({
                url: 'http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>/<?php echo $_route_; ?>?page='+page,
                type: 'post',
                data: 'autoload=true',
                dataType: 'json',
                success: function(json) {
                        console.log(json);
                    $.each(json, function( index, value ) {
                            
                            var date_html = '';
                                
                                
                            //Добавим строку даты
                            <?php if(isset($_GET['_route_']) AND $_GET['_route_'] == 'lastviewed'){ ?>
                            if(date_v != value['viewed']) {
                                date_v = value['viewed'];
                                
                                date_html = '<div style="clear: both;"></div>';
                                date_html = date_html + '<div class="viewed_date">'+date_v+'</div>';
                            } 
                            <?php } ?>
                            
                            if(value['product_id'] == 'system' && value['name'] == 'break_stop_line') { 
                                date_html = '<div style="clear: both;"></div>';   
                                date_html = date_html + '<div class="viewed_date"><div class="links" data-link="http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>'+value['href']+'">'+value['header_name']+'</div></div>';
                                $('.product-line').append(date_html);
                                
                                $('.upload_content').hide(500);
                                $('.upload_content').removeClass('upload_content');
                            }else{
                                //Клонируем последний обьект
                                var html = '<div class="links_blank helikopter" data-link="*">';
                                    html = html + '<div class="product left">'+$('.product').last().html()+'</div></div>'
                                $('.product-line').append(date_html+html);
                                
                                //Заполним его новыми данными
                                $('.product-line').last().children('.name').html(value['name']);
                                
                                $('.links_blank').last().data('link', 'http://<?php echo $_SERVER['HTTP_HOST'].'/'.TMP_URL; ?>'+value['href']);
                                $('.product').last().children('.inner').children('.name').html(value['name']);
                                
                                if (value['old_price'] > 0 && value['old_price'] > value['price']) {
                                    $('.product').last().children('.inner').children('.old_price').html(value['old_price']+' грн.');    
                                }else{
                                    $('.product').last().children('.inner').children('.old_price').html('');    
                                }
                                
                                $('.product').last().children('.inner').children('.price').html(value['price']+' грн.');
                                
                                $('.product').last().children('.inner').children('.status').html(value['manufacturer']);
                                //$('.product').last().children('.inner').children('.status').children('a').prop('href', value['manufacturer_href']);
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
                            }
                    });
                    
                    if (json != '') {
                        page = page + 1;
                        
                        if ($('.upload_content').length > 0) {
                            $('.upload_content').html('Посмотреть все');
                        }
                        
                        loading = false;
                    }else{
                        if ($('.upload_content').length > 0) {
                            $('.upload_content').hide(500);
                        }
                    }
                    
                }
            });
            
        }
       
        $(document).on('click', '.upload_content_click', function(){
            $(this).addClass('upload_content');
            $(this).removeClass('upload_content_click');
            $('.upload_content').trigger('click');
        });
        
      
       
    </script>
  
                <?php if(isset($_GET['_route_']) AND ($_GET['_route_'] == 'lastviewed' OR $_GET['_route_'] == 'lovedproducts')){?>
                    <div class="navigation-line clearfix">
                        <a href="javascript:void(0)" class="border-button upload_content" data-page="2">Посмотреть все</a>
                    </div>
                <?php }else{ ?>
                
                    <div class="navigation-line clearfix">
                        <?php if($last_page == 0 AND (!isset($_GET['page']) OR (isset($_GET['page']) AND $_GET['page'] == 1))){ ?>
                            <a href="javascript:void(0)" class="border-button upload_content_click" data-page="2">Посмотреть все</a>
                        <?php } ?>          
                        <nav class="navigation right inline" style="margin-right: 30px;">
                              <?php echo $pagination; ?>
                        </nav>
                    </div>
                
                <?php } ?>
          </div>

              </section>
              <!--end cont-->
        <?php if(isset($_GET['_route_']) AND ($_GET['_route_'] == 'lastviewed' OR $_GET['_route_'] == 'lovedproducts')){}else{?>
            <section class="about-product clearfix">
                <!--figure class="left"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img8.jpg" alt="" /></figure-->
                <div class="info">
                        <?php echo $description;?>
                </div>
            </section>
        <?php } ?>
      </div>
      </div>
  </section> <!-- end .content-section -->

<?php echo $footer; ?>
