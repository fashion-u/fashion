<?php echo $header; ?>




    <!-- content section-->
    <section class="content-section">
        <div class="inner-block"> <!-- inner-block -->
            <div class="header-table">
                <button class="btn yellow-btn dropdown">Изменить в выделеных <span class="icon-select3"></span></button>
                <button class="btn green-btn">Скачать эту таблицу в Excel</button>
                <select name="count_product" class="select">
                    <option value="100">По 100 товаров на странице</option>
                    <option value="200">По 200 товаров на странице</option>
                    <option value="300">По 300 товаров на странице</option>
                </select>
                <select name="count_day" class="select">
                    <option value="30">За последние 30 дней</option>
                    <option value="20">За последние 20 дней</option>
                    <option value="10">За последние 10 дней</option>
                </select>
                <div class="changes-menu dropdown-menu">
                    <div class="changes-menu__block">
                        <a href="#"><span class="ic-switch-on"></span> Включить</a>
                        <br>
                        <a href="#"><span class="ic-switch-pause"></span> Пауза</a>
                    </div>
                    <div class="changes-menu__block">
                        <label for="limit">Лимит</label>
                        <button class="btn yellow-btn">Ок</button>
                        <input type="text" name="limit" id="limit">
                    </div>
                    <div class="changes-menu__block">
                        <label for="price">Цена</label>
                        <button class="btn yellow-btn">Ок</button>
                        <input type="text" name="price" id="price">
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table-list">
                    <thead>
                        <tr>
                            <td>
                                <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
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
                        <tr>
                            <td>
                                <input name="selected[]" value="1" type="checkbox">
                            </td>
                            <td>
                                <div class="wrap-relative">
                                    <span class="ic-switch-on dropdown"></span>
                                    <div class="changes-menu-switch dropdown-menu">
                                        <a href="#"><span class="ic-switch-on"></span> Включить</a>
                                        <br>
                                        <a href="#"><span class="ic-switch-pause"></span> Пауза</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="wrap-relative">
                                    <span class="span-underline dropdown">20</span> грн в день
                                    <div class="changes-menu-limit dropdown-menu">
                                        <form action="/">
                                            <input type="text" name="limit" id="limit_id2">
                                            <button class="btn yellow-btn">Сохранить</button>
                                            <button class="btn">Отмена</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="#">Синее платье (ссылка)</a>
                            </td>
                            <td>
                                Женское>Одежда>Платья
                            </td>
                            <td>
                                Nike, Nike, Nike, Nike
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
                            <td>
                                1,00 <a href="#"><span class="ic-arrow-up"></span></a><a href="#"><span class="ic-arrow-down"></span></a>
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
                        <tr>
                            <td>
                                <input name="selected[]" value="1" type="checkbox">
                            </td>
                            <td>
                                <div class="wrap-relative">
                                    <span class="ic-switch-pause dropdown"></span>
                                    <div class="changes-menu-switch dropdown-menu">
                                        <a href="#"><span class="ic-switch-on"></span> Включить</a>
                                        <br>
                                        <a href="#"><span class="ic-switch-pause"></span> Пауза</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="wrap-relative">
                                    <span class="span-underline dropdown">20</span> грн в день
                                    <div class="changes-menu-limit dropdown-menu">
                                        <form action="/">
                                            <input type="text" name="limit" id="limit_id3">
                                            <button class="btn yellow-btn">Сохранить</button>
                                            <button class="btn">Отмена</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="#">Синее платье (ссылка)</a>
                            </td>
                            <td>
                                Женское>Одежда>Платья
                            </td>
                            <td>
                                Nike, Nike, Nike, Nike
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
                            <td>
                                1,00 <a href="#"><span class="ic-arrow-up"></span></a><a href="#"><span class="ic-arrow-down"></span></a>
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
                        <tr>
                            <td>
                                <input name="selected[]" value="1" type="checkbox">
                            </td>
                            <td>
                                <div class="wrap-relative">
                                    <span class="ic-switch-on dropdown"></span>
                                    <div class="changes-menu-switch dropdown-menu">
                                        <a href="#"><span class="ic-switch-on"></span> Включить</a>
                                        <br>
                                        <a href="#"><span class="ic-switch-pause"></span> Пауза</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="wrap-relative">
                                    <span class="span-underline dropdown">20</span> грн в день
                                    <div class="changes-menu-limit dropdown-menu">
                                        <form action="/">
                                            <input type="text" name="limit" id="limit_id1">
                                            <button class="btn yellow-btn">Сохранить</button>
                                            <button class="btn">Отмена</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="#">Синее платье (ссылка)</a>
                            </td>
                            <td>
                                Женское>Одежда>Платья
                            </td>
                            <td>
                                Nike, Nike, Nike, Nike
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
                            <td>
                                1,00 <a href="#"><span class="ic-arrow-up"></span></a><a href="#"><span class="ic-arrow-down"></span></a>
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
                    </tbody>
                </table>
            </div>


        </div>  <!-- end inner-block -->
    </section>
    <!-- end content section-->





  
<?php echo $footer; ?>
