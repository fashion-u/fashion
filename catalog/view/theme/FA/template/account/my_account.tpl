<?php echo $header; ?>
<script src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/js/admin_scripts.js" type="text/javascript"></script>
    <!-- content section-->
    <section class="content-section">
        <div class="inner-block"> <!-- inner-block -->
            <div class="header-table">
                <button class="btn yellow-btn dropdown">Изменить в выделеных <span class="icon-select3"></span></button>
                <div class="changes-menu dropdown-menu">
                    <div class="changes-menu__block">
                        <a href="javascript:;" data-status="1" class="status_all"><span class="ic-switch-on"></span> Включить</a>
                        <br>
                        <a href="javascript:;" data-status="0" class="status_all"><span class="ic-switch-pause"></span> Пауза</a>
                    </div>
                    <div class="changes-menu__block">
                        <label for="all_money_limit">Лимит</label>
                        <button class="btn yellow-btn all_money_limit">Ок</button>
                        <input type="text" name="all_money_limit" id="all_money_limit">
                    </div>
                    <div class="changes-menu__block">
                        <label for="all_money_click">Цена</label>
                        <button class="btn yellow-btn all_money_click">Ок</button>
                        <input type="text" name="all_money_click" id="all_money_click">
                    </div>
                </div>
                <button class="btn green-btn">Скачать эту таблицу в Excel</button>
                <?php if(isset($shop) AND is_array($shop) AND count($shop)){ ?>
                <button class="btn yellow-btn dropdown-setup">Настройки <span class="icon-select3"></span></button>
                <div class="changes-menu dropdown-setup-menu">
                    <div class="changes-setup__block">
                        <span class="changes-setup__block-title">Игнорировать IP</span>
                        <input type="hidden" id="shop_id" value="<?php echo $shop['id']; ?>">
                        <input type="hidden" id="remote_id" value="<?php echo $_SERVER['REMOTE_ADDR'];?>">
                        <?php $x = 0; while($x++ < 5){ ?>
                            <input type="text" class="input_ignore_ip" id="ignore_ip_<?php echo $x; ?>" placeholder="<?php echo $_SERVER['REMOTE_ADDR'];?>" value="<?php echo array_shift($ip_list);?>">
                        <?php } ?>
                    </div>
                    <div class="changes-setup__block">
                        <span class="changes-setup__block-title">Белые IP</span>
                        <input type="hidden" id="shop_id_W" value="">
                        <input type="hidden" id="remote_id_w" value="">
                        <?php $x = 0; while($x++ < 5){ ?>
                            <input type="text" class="input_ignore_ip" id="ignore_ip_<?php echo $x; ?>_w" placeholder="<?php echo $_SERVER['REMOTE_ADDR'];?>" value="<?php echo array_shift($ip_list);?>">
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
                <!-- <form method="GET" action="/my_account" charset="UTF-8" class="my_account_form_sort"> -->
                <form method="GET" action="/my_account" class="my_account_form_sort">
                    <select name="limit" class="select count_product" OnChange='submit();'>
                        <option value="100">По 100 товаров на странице</option>
                        <option value="200">По 200 товаров на странице</option>
                        <option value="300">По 300 товаров на странице</option>
                    </select>
                    <select name="count_day" class="select count_day" OnChange='submit();'>
                        <option value="30">За последние 30 дней</option>
                        <option value="20">За последние 20 дней</option>
                        <option value="10">За последние 10 дней</option>
                    </select>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table-list">
                    <thead>
                            <tr>
                                <td>
                                    <input type="checkbox" id="checked_all">
                                </td>
                                <td>
                                    <a href="javascript:;"  id="sort_status" data-key="<?php if(isset($_GET['sort_status']) AND $_GET['sort_status'] == 'desc') {echo 'asc';}else{echo 'desc';} ?>">Статус</a>
                                    <!-- классы asc и desc для отображения сортировки:
                                    <a href="#" class="asc">Статус</a>
                                    <a href="#" class="desc">Статус</a> -->
                                </td>
                                <td>
                                    <a href="javascript:;" id="sort_limit" data-key="<?php if(isset($_GET['sort_limit']) AND $_GET['sort_limit'] == 'desc') {echo 'asc';}else{echo 'desc';} ?>">Лимит</a>
                                </td>
                                <td>
                                    <a href="javascript:;" id="sort_product" data-key="<?php if(isset($_GET['sort_product']) AND $_GET['sort_product'] == 'desc') {echo 'asc';}else{echo 'desc';} ?>">Товар</a>
                                </td>
                                <td>
                                    <a href="javascript:;" id="category_tree" class="select_category">Категория(дерево)</a>
                                </td>
                                <td>
                                    <a href="javascript:;" id="sort_brand">Бренд(список)</a>
                                </td>
                                <td>
                                    <a href="javascript:;" id="sort_views" data-key="<?php if(isset($_GET['sort_views']) AND $_GET['sort_views'] == 'desc') {echo 'asc';}else{echo 'desc';} ?>">Переходы / Уникальные</a>
                                </td>
                                <td>
                                    <div class="wrap-relative">
                                        <a href="javascript:;" id="sort_clicks" data-key="<?php if(isset($_GET['sort_clicks']) AND $_GET['sort_clicks'] == 'desc') {echo 'asc';}else{echo 'desc';} ?>">P</a>
                                        <span class="ic-info"></span>
                                        <div class="pop-up-info">
                                            Информация по колонке ... Информация по колонке ... Информация по колонке ... Информация по колонке ...
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="wrap-relative">
                                        <a href="#"><span class="ic-p2"></span></a>
                                        <span class="ic-info"></span>
                                        <div class="pop-up-info">
                                            Информация по колонке ... Информация по колонке ... Информация по колонке ... Информация по колонке ...
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="wrap-relative">
                                        <a href="#"><span class="ic-sum"></span></a>
                                        <span class="ic-info"></span>
                                        <div class="pop-up-info">
                                            Информация по колонке ... Информация по колонке ... Информация по колонке ... Информация по колонке ...
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="wrap-relative">
                                        <a href="#"><span class="ic-rating"></span></a>
                                        <span class="ic-info"></span>
                                        <div class="pop-up-info">
                                            Информация по колонке ... Информация по колонке ... Информация по колонке ... Информация по колонке ...
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#">Источник</a>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($products as $product){ ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="product_checkbox" id="<?php echo $product['product_id'];?>">
                                </td>
                                <td>
                                    <div class="wrap-relative">
                                        <?php if($product['status'] == 2){ //Продукт на модерации?>
                                            <span class="ic-switch-pause dropdown"></span><br><font color="red">модерация</font>
                                        <?php }elseif($product['status'] == 1){ ?>
                                            <span class="ic-switch-on dropdown" id="status<?php echo $product['product_id'];?>"></span>
                                        <?php }else{ ?>
                                            <span class="ic-switch-pause dropdown" id="status<?php echo $product['product_id'];?>"></span>
                                        <?php } ?>
                                        <?php if($product['status'] != 2){ //Продукт на модерации ?>
                                        <div class="changes-menu-switch dropdown-menu">
                                            <a href="javascript:;" class="status" data-status="1" data-product_id="<?php echo $product['product_id'];?>"><span class="ic-switch-on"></span> Включить</a>
                                            <br>
                                            <a href="javascript:;" class="status" data-status="0" data-product_id="<?php echo $product['product_id'];?>"><span class="ic-switch-pause"></span> Пауза</a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="wrap-relative">
                                        <span class="span-underline dropdown" id="money_limit<?php echo $product['product_id'];?>"><?php echo number_format($product['money_limit'], 0, '.',''); ?></span> <?php echo $currency; ?> в день
                                        <div class="changes-menu-limit dropdown-menu">
                                                <input type="text" name="limit" data-product_id="<?php echo $product['product_id'];?>" value="<?php echo number_format($product['money_limit'], 0, '.',''); ?>">
                                                <button class="btn yellow-btn money_limit">Сохранить</button>
                                                <button class="btn money_limit_close">Отмена</button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?php echo $product['original_url']; ?>" target="_blank"><?php //echo $product['product_id'];?> <?php echo $product['name']; ?></a>
                                </td>
                                <td>
                                    <?php echo implode('<br>',$product['categories']); ?>
                                </td>
                                <td>
                                    <a href="<?php echo $product['manufacturer_href']; ?>" target="_blank"><?php echo $product['manufacturer']; ?></a>
                                </td>
                                <td>
                                    <div class="wrap-relative">
                                        <span class="span-underline dropdown" data-id="<?php echo $product['product_id'];?>" data-key="not_unique"><?php echo $product['count_view'];?></span>
                                        <div class="info-menu-ip dropdown-menu block_not_unique_<?php echo $product['product_id'];?>">
                                            <table class="table-ip">
                                                <thead>
                                                    <tr>
                                                        <td>Время и дата</td>
                                                        <td>IP</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="not_unique<?php echo $product['product_id'];?>">
                                                    <tr>
                                                        <td>12:03 17:08:2016</td>
                                                        <td>136.143.201.225</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12:03 17:08:2016</td>
                                                        <td>136.143.201.225</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12:03 17:08:2016</td>
                                                        <td>136.143.201.225</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12:03 17:08:2016</td>
                                                        <td>136.143.201.225</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                        /
                                    <div class="wrap-relative">
                                        <span class="span-underline dropdown" data-id="<?php echo $product['product_id'];?>" data-key="unique"><?php echo $product['unique_count_view'];?></span>
                                        <div class="info-menu-ip dropdown-menu block_unique_<?php echo $product['product_id'];?>">
                                            <table class="table-ip">
                                                <thead>
                                                    <tr>
                                                        <td>Время и дата</td>
                                                        <td>IP</td>
                                                    </tr>
                                                </thead>
                                                <tbody id="unique<?php echo $product['product_id'];?>">
                                                    <tr>
                                                        <td>12:03 17:08:2016</td>
                                                        <td>136.143.201.225</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12:03 17:08:2016</td>
                                                        <td>136.143.201.225</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                                <td style="white-space: nowrap;"><span id="money_click<?php echo $product['product_id'];?>"><?php echo number_format($product['money_click'], 2, '.', ''); ?></span><a href="javascript:;" class="click_up" data-product_id="<?php echo $product['product_id'];?>"><span class="ic-arrow-up"></span></a><a href="javascript:;" class="click_down" data-product_id="<?php echo $product['product_id'];?>"><span class="ic-arrow-down"></span></a>
                                </td>
                                <td>
                                    1,00
                                </td>
                                <td>
                                    4,00
                                </td>
                                <td>
                                    7
                                </td>
                                <td>
                                    <a href="#">Синее платье (ссылка)</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <nav class="navigation-line">
                    <nav class="navigation right inline" style="margin-right: 30px;">
                        <?php echo $pagination; ?>
                    </nav>
                </nav>
                
             </div>


        </div>  <!-- end inner-block -->
    </section>
    <!-- end content section-->
  
<?php echo $footer; ?>
    <!-- ДЕРЕВО -->
      <!-- ======================================================================== -->
        <?php echo $category_tree; ?>
    <!-- Конец Дерева -->
<script>
    
    $(document).on('click', '.dropdown', function(){
        var key = $(this).data('key');
        var id = $(this).data('id');
    
        $.ajax({
            type: "POST",
            url: "/"+tmp_dir+"index.php?route=product/product/getClickStatistik",
            dataType: "text",
            data: "product_id="+id+"&key="+key,
            beforeSend: function(){
            },
            success: function(msg){
                //console.log(msg);
                $('#'+key+id).html(msg);
            }
        });
        
    
    });
    
    
    
    //Категория = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    <?php
        $get = '';
        foreach($_GET as $index => $value){
            if($index != 'category_id' and $index != '_route_'){
                $get .= $index.'='.$value.'&';
            }
        }
    ?>
    $(document).on('click', '.tree', function(){
        var id = $(this).attr('id');
        location.href = "my_account?<?php echo $get; ?>category_id="+id;
    });
    $(document).on('click', '.tree_ul', function(){
        var id = $(this).attr('id');
        location.href = "my_account?<?php echo $get; ?>category_id="+id;
    });
    
    
    
    //Просмотры = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    $(document).on('click', '#sort_views', function(){
        <?php
            $get = '';
            /*foreach($_GET as $index => $value){
                if($index != '_route_' AND $index != 'sort_status' ){
                    $get .= $index.'='.$value.'&';
                }
            }*/
        ?>
        location.href = "my_account?<?php echo $get; ?>sort_views="+$(this).data('key');;
    });
    
    //Статус = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    $(document).on('click', '#sort_status', function(){
        <?php
            $get = '';
            /*foreach($_GET as $index => $value){
                if($index != '_route_' AND $index != 'sort_status' ){
                    $get .= $index.'='.$value.'&';
                }
            }*/
        ?>
        location.href = "my_account?<?php echo $get; ?>sort_status="+$(this).data('key');;
    });
    
    //Лимит = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    $(document).on('click', '#sort_limit', function(){
        <?php
            $get = '';
            /*foreach($_GET as $index => $value){
                if($index != '_route_' AND $index != 'sort_limit' ){
                    $get .= $index.'='.$value.'&';
                }
            }*/
        ?>
        location.href = "my_account?<?php echo $get; ?>sort_limit="+$(this).data('key');;
    });
   
     //Click = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    $(document).on('click', '#sort_clicks', function(){
        <?php
            $get = '';
            /*foreach($_GET as $index => $value){
                if($index != '_route_' AND $index != 'sort_limit' ){
                    $get .= $index.'='.$value.'&';
                }
            }*/
        ?>
        location.href = "my_account?<?php echo $get; ?>sort_clicks="+$(this).data('key');;
    });
   
    //Продукт = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    $(document).on('click', '#sort_product', function(){
        <?php
            $get = '';
            /*foreach($_GET as $index => $value){
                if($index != '_route_' AND $index != 'sort_product' ){
                    $get .= $index.'='.$value.'&';
                }
            }*/
        ?>
        location.href = "my_account?<?php echo $get; ?>sort_product="+$(this).data('key');;
    });
   
   //Бренд = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
    $(document).on('click', '.sort_manufacture', function(){
        <?php
            $get = '';
            /*foreach($_GET as $index => $value){
                if($index != '_route_' AND $index != 'sort_manufacture' ){
                    $get .= $index.'='.$value.'&';
                }
            }*/
        ?>
        location.href = "my_account?<?php echo $get; ?>sort_manufacture="+$(this).data('key');;
    });
   
    $(document).on('click', '#sort_brand', function(){
        $("#container_back").show();
        $("#sort_manufacture_wrapper").show();
    });
    
    $(document).on('click', '#container_back', function(){
        $("#container_back").hide();
        $("#sort_manufacture_wrapper").hide();
     });
    
</script>
    <div id="sort_manufacture_wrapper">
        <ul><b>Бренды:</b>
            <li><a href="javascript:;" class="sort_manufacture" data-key="0">Показать все</a></li>
            <?php foreach($manufacturer_list as $index => $value){ ?>
                <li><a href="javascript:;" class="sort_manufacture" data-key="<?php echo $value['manufacturer_id'] ?>"><?php echo $value['name'] ?></a></li>
            <?php } ?>
        </ul>    
    </div>
    <style>
        #sort_manufacture_wrapper{
            position: fixed;
            padding: 10px;
            top:100px;
            left:50%;
            margin-left: -150px;
            width: 300px;
            height: 80%;
            overflow: auto;
            border: 1px solid gray;
            border-radius: 10px;
            background-color: #F4F9EA;
            text-align: left;
             display: none; 
            z-index: 11001;
        }
    </style>