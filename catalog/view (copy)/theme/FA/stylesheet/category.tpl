<?php echo $header; ?>
  <!--content section-->
  
  <?php
  //header("Content-Type: text/html; charset=UTF-8");
  //echo "<pre>";  print_r(var_dump( get_defined_vars())); echo "</pre>";
  
  ?>
  
  <section class="content-section">
      <div class="inner-block">

          <div class="special-row clearfix">

              <!--sidebar-->
              <?php if(count($categories) > 0){ ?>
              <section class="sidebar left">
                  <!--category menu-->
                  <nav class="category-menu">
                      <?php if(isset($categories['header'])){ ?>
                        <span class="__large2"><?php echo $categories['header']; ?></span class="__large2">
                      <?php } ?>
                      <ul class="catalog__ul">
                        <?php foreach($categories['categories'] as $category){ ?>
                            <?php if($category_id == $category['category_id']) { ?>
                                <li><a href="<?php echo $category['href']; ?>" class="active_categ"><?php echo $category['name']; ?></a></li>
                            <?php }else{ ?>
                                <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>  
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
                                    <li><?php echo $breadcrumb['text']; ?></li>
                                <?php }else{ ?>
                                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                                <?php } ?>
                              <?php } ?>
                          </ul>
                      </nav>
                      <!--end breadcrumbs-->

                      <!--menu tablet line-->
                      <div class="menu-tablet-line-section">
                          <div class="menu-tablet-line scrollblock">
                              <div class="inner clearfix">
                                  <ul class="clearfix left">
                                      <div class="title left mobile-off"><a href="#" class="active"><?php echo $heading_title; ?></a></div>
                                      <?php $count = 1; ?>
                                      <?php foreach($categories['categories'] as $category){ ?> 
                                      <li>
                                          <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>&nbsp;&nbsp;
                                          <?php if($count < count($categories)){ ?>
                                          <span>-</span>
                                          <?php } ?>
                                      </li>
                                      <?php } ?>
                                      <!--li>
                                          <a href="#" class="active">Юбки</a>
                                          <span>-</span>
                                      </li-->
                                      <li>
                                          <a href="#">Костюмы</a>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                      <!--end menu tablet line-->


                      <!--sort section-->
                      <section class="sort-section">
                          <div class="big-title">
                            <!--span class="__large2" style="float: left; font-weight: bold;"><?php echo $heading_title; ?></span-->
                            <h1 style="font-size:22px;margin-top: 0; margin-bottom: 0;"><?php echo $heading_title; ?></h1>
                          </div>
                         
                    <?php if(isset($_GET['_route_']) AND ($_GET['_route_'] == 'women' OR $_GET['_route_'] == 'children' OR $_GET['_route_'] == 'man' OR $_GET['_route_'] == 'lastviewed' OR $_GET['_route_'] == 'lovedproducts')){ ?>
                    <?php }else{ ?>
                         
                         
                          <div class="sort-select-line clearfix">
                              <div class="sort-mobile-box left clearfix">
                                  <a href="javascript:void(0)" class="item-1 active left"></a>
                                  <a href="javascript:void(0)" class="item-2 left"></a>
                              </div>
                              <div class="filter-drop-box right">
                                  <a href="javascript:void(0)" class="filter-button">Фильтры</a>
                              </div>
                              <div class="sort-select right" style="z-index:99;">
                                  <div class="title"><!--Сортировать:--></div>
                                    <select class="sort">
                                        <option value="">Сортировать:</option>
                                        <option value="viewed" <?php if(isset($_GET['sort']) AND $_GET['sort'] == 'viewed') echo 'selected';?>>по популярности</option>
                                        <option value="cheap" <?php if(isset($_GET['sort']) AND $_GET['sort'] == 'cheap') echo 'selected';?>>Недорогие</option>
                                        <option value="expensive" <?php if(isset($_GET['sort']) AND $_GET['sort'] == 'expensive') echo 'selected';?>>Дорогие</option>
                                    </select>
                              </div>
                          </div>
                  
                          <script>
                            $(document).on('change', '.sort', function(){
                             
                                var route = '<?php echo $_GET['_route_']?>';
                                route = route.replace('viewed-','');
                                route = route.replace('cheap-', '');
                                route = route.replace('expensive-','');
                                
                                if ($(this).val() == '') {
                                    location.href = '/'+route;
                                }else{
                                    location.href = '/'+$(this).val()+'-'+route;
                                }
                                
                            });
                            
                          </script>
                          <?php
                          //echo "<pre>";  print_r(var_dump( $_COOKIE )); echo "</pre>";
                          ?>
                          <div class="filter-line clearfix" style="">
                            <?php if(isset($_COOKIE['hide_menu_help']) AND $_COOKIE['hide_menu_help'] == '1'){ }else{?>
                                <div id="filter_information">
                                    Для выбора 1 фильтра нажмите на его наименование, для выбора 2-х и более фильтров - поставьте галочки и нажмите кнопку Применить.
                                    <br><span style="margin-top: 7px;margin-bottom: 3px;display: block;"><a href="javascript:;" class="hide_menu_help" style="margin-top: 7px;text-decoration: underline;color: white; float: left;">Не показывать больше</a>
                                    <a href="javascript:;" class="hide_menu_help_ok" style="margin-top: 7px;text-decoration: underline;color: white; float: right;">Ok</a></span>
                                </div>
                                <script>
                                $(document).on('click', '.hide_menu_help', function(){
                                    debugger;
                                    $.ajax({
                                        type: "POST",
                                        url: "/index.php?route=product/category/setHideMenuHelp",
                                        dataType: "text",
                                        data: "",
                                        beforeSend: function(){
                                        },
                                        success: function(msg){
                                            console.log( msg );
                                            $('#filter_information').hide();
                                        }
                                    });
                                 });
                                $(document).on('click', '.hide_menu_help_ok', function(){
                                    $('#filter_information').hide();
                                 }); 
                                </script>
                            <?php } ?>
                        
                                <form action="<?php echo '/'.TMP_DIR.$_GET['_route_']; ?>">
                                <input type="hidden" name="filter" value="true">
                                    <div class="title left" id="filter_title_desctop">Фильтры:</div>
                                    <div class="top-line clearfix" id="filter_title_tablet">
                                        <div class="title left">Фильтр товаров</div>
                                        <a href="/<?php echo $category_alias; ?>" class="right">Сбросить</a>
                                    </div>
                                    <div class="filter-box-wrap">
                                        <a class="filter-box-wrap-arrow-left"></a>
                                        <a class="filter-box-wrap-arrow-right"></a>
                                    <div class="filter-box-wrap2">
                                    <div class="filter-box-wrap3">
                                  <!--div class="filter-box left">
                                      <a href="javascript:void(0)" class="filter-link">Размер-->
                                        <?php
                                            $list = '';
                                            foreach($size as $index => $group_size){
                                                foreach($group_size['sizes'] as $size_i){
                                                    if(isset($selected_sizes[$size_i['size_id']])) $list .= '<span class="selected_filter_list">'.$size_i['size_name'].'</span><span class="dell_filter" data-id="'.$group_size['filter_group_name'].'_'.$size_i['size_name'].'">&times;</span>'; 
                                                }
                                            }
                                            if($list != ''){ ?>
                                                <div class="filter-box left filter_selected">
                                                <?php echo '<a href="javascript:void(0)" class="filter-link">Размер</a>:'.$list;
                                            }else{ ?>
                                                <div class="filter-box left">
                                                <?php echo '<a href="javascript:void(0)" class="filter-link">Размер</a>';
                                            }
                                            
                                        ?>
                                      <!--/a-->
                                      <div class="drop-filter-box" style="width: 280px;z-index: 99;">
                                            <div class="wrap-drop-filter-box wrap-drop-filter-box-min">
                                              <div class="special-select">
                                                  <select class="size_sys">
                                                    <?php foreach($size as $index => $group_size){ ?>
                                                        <option value="<?php echo $group_size['filter_group_name']; ?>"><?php echo $group_size['group_name']; ?></option>
                                                    <?php } ?>
                                                  </select>
                                              </div>
                                              <?php $count = 1; ?>
                                              <?php foreach($size as $index => $group_size){ ?>
                                                <div class="size-tab size-tab-<?php echo $group_size['filter_group_name']; ?>" style="width: 200px;<?php if($count++ > 1) echo 'display:none;';?>">
                                                    <div class="line clearfix">
                                                        <?php foreach($group_size['sizes'] as $size_i){ ?>
                                                            <div class="checkbox-box" style="width: 80px;">
                                                                <input type="checkbox" id="<?php echo $group_size['filter_group_name'].'_'.$size_i['size_name'];?>" name="<?php echo $group_size['filter_group_name'].'_'.$size_i['size_name'];?>"
                                                                <?php if(isset($selected_sizes[$size_i['size_id']])) echo ' checked '; ?>
                                                                />
                                                                <label for="<?php echo $size_i['size_id'];?>"><?php echo $size_i['size_name'];?></label>
                                                            </div>
                                                        <?php } ?>    
                                                    </div>
                                                </div>
                                              <?php } ?>
                                            </div>
                                              <button class="yellow-button">Применить</button>
                                          
                                      </div>
                                  </div>
                  <script>
                    $(document).on('click', '.dell_filter', function(){
                        var url = '<?php echo $_GET['_route_']; ?>';
                        var filter = $(this).data('id');
                        
                        var redir = url.replace(filter+'-', '');
                        
                        location.href = '/'+redir;
                        //console.log(url+' '+filter+' '+redir);
                    
                    });
                    
                   </script>
                            <?php if(isset($product_attributes) AND is_array($product_attributes) AND count($product_attributes) > 0){ ?>
                                <?php
                                    //создаем доп строку с фильтрами
                                    $selected_attributes_alias = '';
                                    foreach($product_attributes as $product_attribute){
                                        foreach($product_attribute['attributes'] as $attributes){
                                            if(isset($selected_attributes[$attributes['attribute_id']])){
                                                $selected_attributes_alias .= $attributes['filter_name'].'-';
                                            }
                                        }
                                    }
                                ?>
                         
                                <?php foreach($product_attributes as $product_attribute){ ?>
                                    
                                        
                                            <?php
                                                $list = '';
                                                foreach($product_attribute['attributes'] as $attributes){
                                                    if(isset($selected_attributes[$attributes['attribute_id']])) $list .= '<span class="selected_filter_list">'.$attributes['name'].'</span><span class="dell_filter" data-id="'.$attributes['filter_name'].'">&times;</span>'; 
                                                }
                                                if($list != ''){ ?>
                                                    <div class="filter-box left filter_selected">
                                                    <?php echo '<a href="javascript:void(0)" class="filter-link">'.$product_attribute['attribute_group_name'].'</a>:'.$list;
                                                }else{ ?>
                                                    <div class="filter-box left">
                                                    <?php echo '<a href="javascript:void(0)" class="filter-link">'.$product_attribute['attribute_group_name'].'</a>';
                                                }
                                            ?>
                                        
                                        <div class="drop-filter-box" style="z-index: 100;">
                                            <div class="wrap-drop-filter-box">
                                            <div class="filter_description"><?php echo $product_attribute['description']; ?></div>
                                            <?php foreach($product_attribute['attributes'] as $attributes){ ?>
                                                <div class="checkbox-box filters_item">
                                                    <input type="checkbox" id="<?php echo $attributes['filter_name']; ?>" name="<?php echo $attributes['filter_name']; ?>"
                                                    <?php if(isset($selected_attributes[$attributes['attribute_id']])) echo ' checked '; ?>
                                                    class="filters"/>
                                                    <!--label for="<?php echo $attributes['filter_name']; ?>"><?php echo $attributes['name']; ?></label-->
                                                    <label>
                                                        <?php if(count($selected_attributes)){
                                                            //if(isset($selected_attributes[$attributes['attribute_id']])){
                                                               //$selected_attributes_alias = str_replace($selected_attributes[$attributes['attribute_id']].'-','', $selected_attributes_alias);
                                                            //}
                                                        ?>
                                                            <?php if(strpos($selected_attributes_alias, $attributes['filter_name']) !== false){ ?>
                                                                <div class="links" style="display: inline;" data-link="/<?php echo str_replace($attributes['filter_name'].'-', '', $selected_attributes_alias).str_replace($attributes['filter_name'].'-', '', $category_alias);?>"><?php echo $attributes['name']; ?></div>
                                                            <?php }else{ ?>
                                                                <div class="links" style="display: inline;" data-link="/<?php echo $attributes['filter_name'].'-'.$selected_attributes_alias.$category_alias;?>"><?php echo $attributes['name']; ?></div>
                                                            <?php } ?>
                                                        <?php }else{ ?>
                                                            <a href="/<?php echo $attributes['filter_name'].'-'.$category_alias;?>"><?php echo $attributes['name']; ?></a>
                                                        <?php } ?>
                                                    
                                                    </label>
                                                </div>
                                            <?php } ?>
                                            <div style="clear: both;"></div>
                                            </div>
                                            <button class="yellow-button">Применить</button>
                                        </div>
                                    </div>
                                <?php } ?> 
                            <?php } ?>
                                  <!--a href="#" class="next-filter-button left"></a-->
                              </div>
                              
                              </div>
                              <a href="#" class="btn-sale">Распродажа</a> 
                              </div>
                              </div>

                              </form>
                                                 
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
                              
                              <?php if(date('Y-m-d', strtotime($date_v)) != date('Y-m-d', strtotime($product['viewed']))) {
                                    $date_v = date('Y-m-d', strtotime($product['viewed'])); ?>
                                
                                    <div style="clear: both;"></div>    
                                    <div class="viewed_date"><?php echo $date_v;?></div>
                              <?php } ?>
                              
                              <div class="links_blank" data-link="<?php echo $product['href']; ?>">
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
                                                <img src="/image/love.png" class="as_link" >
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
                                            
                                            <div class="links info-button" data-link="<?php echo $product['href']; ?>"></div>
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
            
            $.ajax({
                url: '/<?php echo $_GET['_route_']; ?>?page='+page,
                type: 'post',
                data: 'autoload=true',
                dataType: 'json',
                success: function(json) {

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
                            //Клонируем последний обьект
                            var html = '<div class="links_blank" data-link="*">';
                                html = html + '<div class="product left">'+$('.product').last().html()+'</div></div>'
                            $('.product-line').append(date_html+html);
                            
                            //Заполним его новыми данными
                            $('.product-line').last().children('.name').html(value['name']);
                            
                            $('.links_blank').last().data('link', value['href']);
                            $('.product').last().children('.inner').children('.name').html(value['name']);
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
       
        $(document).on('click', '.upload_content_click', function(){
            $(this).addClass('upload_content');
            $(this).removeClass('upload_content_click');
            $('.upload_content').trigger('click');
        });
        
      
       
    </script>
  
                        <?php if(!isset($lovedproducts)){ ?>  
                            <div class="navigation-line clearfix">
                                <?php if(!isset($_GET['page']) OR (isset($_GET['page']) AND $_GET['page'] == 1)){ ?>
                                    <a href="javascript:void(0)" class="border-button upload_content_click" data-page="2">Посмотреть все</a>
                                <?php } ?>          
                                <nav class="navigation right inline" style="margin-right: 30px;">
                                      <?php echo $pagination; ?>
                                </nav>
                            </div>
                        <?php }else{ ?>
                                <span class="border-button upload_content_click" data-page="2">Посмотреть все</span>
                        <?php } ?>
                          
                    <?php if(isset($is_last_page)){ ?>
                          <section class="product-section">
                              <div class="title-line clearfix">
                                  <h4 class="left">Сиреневые женские платья</h4>
                                  <a href="#" class="right">Все товары</a>
                              </div>
                              <div class="product-line clearfix">

                                  <!--product-->
                                  <div class="product left">
                                      <div class="inner">
                                          <div class="discount">20%</div>
                                          <a href="#" class="love-button"></a>
                                          <figure>
                                              <a href="#"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img6.jpg" alt="" /></a>
                                          </figure>
                                          <div class="name">VOVK</div>
                                          <div class="status">Платье</div>
                                          <div class="price">390 грн.</div>
                                          <div class="site"><a href="#">Lamoda.ua</a></div>
                                          <div class="size">Размеры (UKR):  44 46 48 50</div>
                                          <a href="#" class="info-button"></a>
                                      </div>
                                  </div>
                                  <!--end product-->

                                  <!--product-->
                                  <div class="product left">
                                      <div class="inner">
                                          <div class="discount">20%</div>
                                          <a href="#" class="love-button"></a>
                                          <figure>
                                              <a href="#"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img6.jpg" alt="" /></a>
                                          </figure>
                                          <div class="name">VOVK</div>
                                          <div class="status">Платье</div>
                                          <div class="price">390 грн.</div>
                                          <div class="site"><a href="#">Lamoda.ua</a></div>
                                          <div class="size">Размеры (UKR):  44 46 48 50</div>
                                          <a href="#" class="info-button"></a>
                                      </div>
                                  </div>
                                  <!--end product-->

                                  <!--product-->
                                  <div class="product left">
                                      <div class="inner">
                                          <div class="discount">20%</div>
                                          <a href="#" class="love-button"></a>
                                          <figure>
                                              <a href="#"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img6.jpg" alt="" /></a>
                                          </figure>
                                          <div class="name">VOVK</div>
                                          <div class="status">Платье</div>
                                          <div class="price">390 грн.</div>
                                          <div class="site"><a href="#">Lamoda.ua</a></div>
                                          <div class="size">Размеры (UKR):  44 46 48 50</div>
                                          <a href="#" class="info-button"></a>
                                      </div>
                                  </div>
                                  <!--end product-->

                                  <!--product-->
                                  <div class="product left">
                                      <div class="inner">
                                          <div class="discount">20%</div>
                                          <a href="#" class="love-button"></a>
                                          <figure>
                                              <a href="#"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img6.jpg" alt="" /></a>
                                          </figure>
                                          <div class="name">VOVK</div>
                                          <div class="status">Платье</div>
                                          <div class="price">390 грн.</div>
                                          <div class="site"><a href="#">Lamoda.ua</a></div>
                                          <div class="size">Размеры (UKR):  44 46 48 50</div>
                                          <a href="#" class="info-button"></a>
                                      </div>
                                  </div>
                                  <!--end product-->

                              </div>
                          </section>

                          <section class="product-section">
                              <div class="title-line clearfix">
                                  <h4 class="left">Сиреневые женские платья</h4>
                                  <a href="#" class="right">Все товары</a>
                              </div>
                              <div class="product-line clearfix">

                                  <!--product-->
                                  <div class="product left">
                                      <div class="inner">
                                          <div class="discount">20%</div>
                                          <a href="#" class="love-button"></a>
                                          <figure>
                                              <a href="#"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img6.jpg" alt="" /></a>
                                          </figure>
                                          <div class="name">VOVK</div>
                                          <div class="status">Платье</div>
                                          <div class="price">390 грн.</div>
                                          <div class="site"><a href="#">Lamoda.ua</a></div>
                                          <div class="size">Размеры (UKR):  44 46 48 50</div>
                                          <a href="#" class="info-button"></a>
                                      </div>
                                  </div>
                                  <!--end product-->

                                  <!--product-->
                                  <div class="product left">
                                      <div class="inner">
                                          <div class="discount">20%</div>
                                          <a href="#" class="love-button"></a>
                                          <figure>
                                              <a href="#"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img6.jpg" alt="" /></a>
                                          </figure>
                                          <div class="name">VOVK</div>
                                          <div class="status">Платье</div>
                                          <div class="price">390 грн.</div>
                                          <div class="site"><a href="#">Lamoda.ua</a></div>
                                          <div class="size">Размеры (UKR):  44 46 48 50</div>
                                          <a href="#" class="info-button"></a>
                                      </div>
                                  </div>
                                  <!--end product-->

                                  <!--product-->
                                  <div class="product left">
                                      <div class="inner">
                                          <div class="discount">20%</div>
                                          <a href="#" class="love-button"></a>
                                          <figure>
                                              <a href="#"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img6.jpg" alt="" /></a>
                                          </figure>
                                          <div class="name">VOVK</div>
                                          <div class="status">Платье</div>
                                          <div class="price">390 грн.</div>
                                          <div class="site"><a href="#">Lamoda.ua</a></div>
                                          <div class="size">Размеры (UKR):  44 46 48 50</div>
                                          <a href="#" class="info-button"></a>
                                      </div>
                                  </div>
                                  <!--end product-->

                                  <!--product-->
                                  <div class="product left">
                                      <div class="inner">
                                          <div class="discount">20%</div>
                                          <a href="#" class="love-button"></a>
                                          <figure>
                                              <a href="#"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img6.jpg" alt="" /></a>
                                          </figure>
                                          <div class="name">VOVK</div>
                                          <div class="status">Платье</div>
                                          <div class="price">390 грн.</div>
                                          <div class="site"><a href="#">Lamoda.ua</a></div>
                                          <div class="size">Размеры (UKR):  44 46 48 50</div>
                                          <a href="#" class="info-button"></a>
                                      </div>
                                  </div>
                                  <!--end product-->

                              </div>
                          </section>

                      </section>
                      <!--end sort section-->
                    <?php } ?>

                  </div>
              </section>
              <!--end cont-->

          </div>

          <section class="about-product clearfix">
              <!--figure class="left"><img src="/<?php echo TMP_DIR;?>catalog/view/theme/FA/image/uploads/img8.jpg" alt="" /></figure-->
              <div class="info">
                  <p>
                      <?php echo $description;?>
                  </p>
              </div>
          </section>

      </div>
  </section>

<?php echo $footer; ?>
