<?php echo $header; ?>

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
                                    <a href="#">Статус</a>
                                    <!-- классы asc и desc для отображения сортировки:
                                    <a href="#" class="asc">Статус</a>
                                    <a href="#" class="desc">Статус</a> -->
                                </td>
                                <td>
                                    <a href="#">Лимит</a>
                                </td>
                                <td>
                                    <a href="#">Товар</a>
                                </td>
                                <td>
                                    <a href="#">Категория(дерево)</a>
                                </td>
                                <td>
                                    <a href="#">Бренд(список)</a>
                                </td>
                                <td>
                                    <a href="#">Переходы / Уникальные</a>
                                </td>
                                <td>
                                    <div class="wrap-relative">
                                        <a href="#">P</a>
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
                                        <span class="span-underline dropdown" id="money_limit<?php echo $product['product_id'];?>"><?php echo number_format($product['money_limit'], 0, '.',''); ?></span> грн в день
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
                                        <span class="span-underline dropdown">4</span>
                                        <div class="info-menu-ip dropdown-menu">
                                            <table class="table-ip">
                                                <thead>
                                                    <tr>
                                                        <td>Время и дата</td>
                                                        <td>IP</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
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
                                        <span class="span-underline dropdown">2</span>
                                        <div class="info-menu-ip dropdown-menu">
                                            <table class="table-ip">
                                                <thead>
                                                    <tr>
                                                        <td>Время и дата</td>
                                                        <td>IP</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
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
