<?php if(isset($_COOKIE['hide_menu_help']) AND $_COOKIE['hide_menu_help'] == '1'){ }else{?>
    <div class="filter_information">
        Для выбора 1 фильтра нажмите на его наименование, для выбора 2-х и более фильтров - поставьте галочки и нажмите кнопку Применить.
        <br><span style="margin-top: 7px;margin-bottom: 3px;display: block;"><a href="javascript:;" class="hide_menu_help" style="margin-top: 7px;text-decoration: underline;color: white; float: left;">Не показывать больше</a>
        <a href="javascript:;" class="hide_menu_help_ok" style="margin-top: 7px;text-decoration: underline;color: white; float: right;">Ok</a></span>
    </div>
    <script>
    $(document).on('click', '.hide_menu_help', function(){
        //debugger;
        $.ajax({
            type: "POST",
            url: "/<?php echo TMP_DIR; ?>/index.php?route=product/category/setHideMenuHelp",
            dataType: "text",
            data: "",
            beforeSend: function(){
            },
            success: function(msg){
                console.log( msg );
                $('.filter_information').hide();
                $('.filter_information').removeClass('filter_information');
            }
        });
     });
    $(document).on('click', '.hide_menu_help_ok', function(){
        $('.filter_information').hide();
        $('.filter_information').removeClass('filter_information');
     }); 
    </script>
<?php } ?>
   
    <form action="<?php echo '/'.TMP_DIR.$_GET['_route_']; ?>" class="form-filter" id="form-filter">
        <input type="hidden" name="filter" value="true">
        <div class="title left" id="filter_title_desctop">Фильтры:</div>
        <div class="top-line clearfix" id="filter_title_tablet">
            <div class="title left">Фильтр товаров</div>
            <a href="/<?php echo $category_alias; ?>" class="right">Сбросить</a>
        </div>
        <a class="filter-box-wrap-arrow-left"><img src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/image/btn/filter-prev-button.png" alt="arrow-left"></a>
        <div class="filter-box-wrap">
            <div class="filter-box-wrap2">
                <div class="filter-box-wrap3">
      <!--div class="filter-box left">
          <a href="javascript:void(0)" class="filter-link">Размер-->
            <?php
                $list = '';
                $count_id = 1;
                foreach($size as $index => $group_size){
                    foreach($group_size['sizes'] as $size_i){
                        if(isset($selected_sizes[$size_i['size_id']])) $list .= '<span class="selected_filter_list">'.$size_i['size_name'].'</span><span class="dell_filter" data-id="'.$group_size['filter_group_name'].'_'.$size_i['size_name'].'">&times;</span>'; 
                    }
                }
                if($list != ''){ ?>
                    <div class="filter-box left filter_selected">
                    <?php echo '<a href="javascript:void(0)" class="filter-link" data-mfp-src="#drop-filter-box-'.$count_id.'">Размер</a><span class="tablet-off">:</span>'.$list;
                }else{ ?>
                    <div class="filter-box left">
                    <?php echo '<a href="javascript:void(0)" class="filter-link" data-mfp-src="#drop-filter-box-'.$count_id.'">Размер</a>';
                }
            ?>
          <!--/a-->
          <div class="drop-filter-box mfp-hide" style="width: 280px;z-index: 99;" id="drop-filter-box-<?php echo $count_id; $count_id++; ?>">
                <div class="drop-filter-box-title desktop-off">Размер</div>
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
                    <div class="size-tab size-tab-<?php echo $group_size['filter_group_name']; ?>"<?php if($count++ > 1) echo ' style="display:none;"';?>">
                        <div class="line clearfix">
                            <?php foreach($group_size['sizes'] as $size_i){ ?>
                                <div class="checkbox-box">
                                    <input type="checkbox" id="<?php echo $group_size['filter_group_name'].'_'.$size_i['size_name'];?>" name="<?php echo $group_size['filter_group_name'].'_'.$size_i['size_name'];?>"
                                    <?php if(isset($selected_sizes[$size_i['size_id']])) echo ' checked '; ?>
                                    />
                                    <label for="<?php echo $group_size['filter_group_name'].'_'.$size_i['size_name'];?>"><?php echo $size_i['size_name'];?></label>
                                </div>
                            <?php } ?>    
                        </div>
                    </div>
                  <?php } ?>
                </div>
                <button class="yellow-button tablet-off">Применить</button>
                <button class="drop-filter-botton-reset desktop-off" data-mfp-src="#filter-popup">Сбросить</button>
                <button class="drop-filter-botton-ok desktop-off" data-mfp-src="#filter-popup">Готово</button>
          </div>
      </div>
<script>
$(document).on('click', '.dell_filter', function(){
    var url = '<?php echo $_GET['_route_']; ?>';
    var filter = $(this).data('id');

    var redir = url.replace(filter+'-', '');

    if ($('#helikopter').val().length > 0) {
        var redir = redir.replace('-'+$('#helikopter').val()+'click', '');
    }
    

location.href = '/'+redir;
//console.log(url+' '+filter+' '+redir);

});

</script>

   
<?php if(isset($product_attributes) AND is_array($product_attributes) AND count($product_attributes) > 0){ ?>
 
       <?php foreach($product_attributes as $product_attribute){ ?>

                <?php
                    $list = '';
                    foreach($product_attribute['attributes'] as $attributes){
                        if(isset($selected_attributes[$attributes['attribute_id']])) $list .= '<span class="selected_filter_list">'.$attributes['name'].'</span><span class="dell_filter" data-id="'.$attributes['filter_name'].'">&times;</span>'; 
                    }
                    if($list != ''){ ?>
                        <div class="filter-box left filter_selected">
                        <?php echo '<a href="javascript:void(0)" class="filter-link" data-mfp-src="#drop-filter-box-'.$count_id.'">'.$product_attribute['attribute_group_name'].'</a><span class="tablet-off">:</span>'.$list;
                    }else{ ?>
                        <div class="filter-box left">
                        <?php echo '<a href="javascript:void(0)" class="filter-link" data-mfp-src="#drop-filter-box-'.$count_id.'">'.$product_attribute['attribute_group_name'].'</a>';
                    }
                ?>
             <div class="drop-filter-box mfp-hide" style="z-index: 100;" id="drop-filter-box-<?php echo $count_id; $count_id++; ?>">
                <div class="drop-filter-box-title desktop-off"><?php echo $product_attribute['attribute_group_name']; ?></div>
                <?php if($product_attribute['attribute_group_id'] == 22){ ?>
                    <div class="wrap-drop-filter-box">
                        <div class="checkbox-box filters_item" style="width: 240px;">
                            
                            <div class="filters-price">От:&nbsp;&nbsp;&nbsp;</div><div class="filters-price"><input type="text" id="price_from" name="price_from" value="<?php echo (isset($_GET['price_from'])) ? $_GET['price_from'] : '';?>" placeholder="<?php echo (isset($total_product_info['min_price'])) ? number_format($total_product_info['min_price'], 0, '','') : '';?>" style="width: 70px;" /></div>
                            <div class="filters-price">&nbsp;&nbsp;&nbsp;До:&nbsp;&nbsp;&nbsp;&nbsp;</div><div class="filters-price"><input type="text" id="price_to" name="price_to" value="<?php echo (isset($_GET['price_to'])) ? $_GET['price_to'] : '';?>" placeholder="<?php echo (isset($total_product_info['max_price'])) ? number_format($total_product_info['max_price'], 0, '','') : '';?>" style="width: 70px;"/></div>
                        
                        </div>
                
                <?php }else{ ?>
                <div class="wrap-drop-filter-box">
                    <div class="filter_description"><?php echo $product_attribute['description']; ?></div>                
                    <?php foreach($product_attribute['attributes'] as $attributes){ ?>
                        <div class="checkbox-box filters_item">
                            <input type="checkbox" id="<?php echo $attributes['filter_name']; ?>" name="<?php echo $attributes['filter_name']; ?>"
                            <?php if(isset($selected_attributes[$attributes['attribute_id']])) echo ' checked '; ?>
                            class="filters"/>

                                <?php if(count($selected_attributes)){?>
                                
                                    <?php if(strpos($selected_attributes_alias, $attributes['filter_name']) !== false){ ?>
                                        <div class="links" style="display: inline;" data-link="/<?php echo str_replace($attributes['filter_name'].'-', '', $selected_attributes_alias).str_replace($attributes['filter_name'].'-', '', $category_alias);?>"><?php echo $attributes['name']; ?></div>
                                    <?php }else{ ?>
                                        <div class="links" style="display: inline;" data-link="/<?php echo $attributes['filter_name'].'-'.$selected_attributes_alias.$category_alias;?>"><?php echo $attributes['name']; ?></div>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <a href="/<?php echo $attributes['filter_name'].'-'.$category_alias;?>"><?php echo $attributes['name']; ?></a>
                                <?php } ?>
                            
                        </div>
                    
                    <?php } ?>
                    
                <?php } ?>
                <div style="clear: both;"></div>
                </div>
                <button class="yellow-button tablet-off">Применить</button>
                <button class="drop-filter-botton-reset desktop-off" data-mfp-src="#filter-popup">Сбросить</button>
                <button class="drop-filter-botton-ok desktop-off" data-mfp-src="#filter-popup">Готово</button>
            </div>
        </div>
    <?php } ?> 
<?php } ?>
      <!--a href="#" class="next-filter-button left"></a-->
                </div>
            </div>
        </div>
        <div class="filter-bottom-tablet desktop-off">
            <button class="yellow-button">Показать товары</button>
        </div>
        <a class="filter-box-wrap-arrow-right"><img src="/<?php echo TMP_DIR; ?>catalog/view/theme/FA/image/btn/filter-next-button.png" alt="arrow-right"></a>
    </form>