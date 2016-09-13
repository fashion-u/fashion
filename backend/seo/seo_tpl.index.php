<!-- Sergey Kotlyarov 2016 folder.list@gmail.com -->
<?php
$file = explode('/', __FILE__);
if(strpos($_SERVER['PHP_SELF'], $file[count($file)-1]) !== false){
	header("Content-Type: text/html; charset=UTF-8");
	die('Прямой запуск запрещен!');
}
$table = 'seo_tpl';
$main_key = 'seo_tpl_id';

$sql = 'SELECT * FROM '.DB_PREFIX.$table.' ORDER BY target;';
$r = $mysqli->query($sql);

$arr = array();
while($row = $r->fetch_assoc()){
	$arr[$row[$main_key]] = $row;
}

?>
<br>
<!--script type="text/javascript" src="/<?php echo TMP_DIR;?>backend/js/backend/ajax_edit_attributes.js"></script-->
<h1>Справочник : Шаблоны. После исправления не забывайте Назначать!</h1>
<div style="width: 90%">
<div class="table_body">

<table class="text">
    <tr>
        <th>id</th>
        <th>Название поля</th>
        <th>Значение (фаблон/формула)</th>
        <th>Назначить</th>
    </tr>

 
<?php foreach($arr as $index => $ex){ ?>
    <tr id="<?php echo $ex[$main_key];?>">
        <td class="mixed"><?php echo $ex[$main_key];?></td>
        <td class="mixed" style="text-align: left;"><?php echo $ex['memo']; ?></td>
        <td class="mixed">
				<input type="hidden" class="edit" id="target<?php echo $ex[$main_key];?>" value="<?php echo $ex['target']; ?>">
				<input type="text" class="edit" id="value<?php echo $ex[$main_key];?>" style="width:700px;" value="<?php echo $ex['value']; ?>"></td>
        <td>        
            <a href="javascript:;" class="set" data-id="<?php echo $ex[$main_key];?>">
                назначить
            </a>
        </td>              
    </tr>
<?php } ?>

</table>
<input type="hidden" id="table" value="<?php echo $table; ?>">
<br><br>
 <ul>Памятка по кодам
                    <li>* <b>@min_price@</b> - Минимальная цена</li>
                    <li>* <b>@products_count@</b> - Количество продуктов</li>
                    <li>* <b>@shops_count@</b> - Количество магазинов</li>
                    <li>* <b>@design_count@</b> - Количество дизайнеров</li>
                    <li>* <b>@prev_year@</b> - Предыдущий год</li>
                    <li>* <b>@now_year@</b> - Текущий год</li>
                    <li>* <b>@next_year@</b> - Следующий год</li>
                    <li>* <b>@dinamic_year@</b> - Динамический диапазон 2016-2016</li>
                    <li>* <b>@city@</b> - Город [именительный] (<i>Москва</i>)</li>
                    <li>* <b>@sity_to@</b> - Город [дательный] (<i>В Москву</i>)</li>
                    <li>* <b>@city_on@</b> - Город [предложный](<i>По Москве</i>)</li>
                    <li>* <b>@city_rod@</b> - Город [родительный](<i>Чего? Москвы</i>)</li>
                    <li></li>
                    <li>* <b>@block_name@</b> - Существительный (<i>белая блузка</i>)</li>
                    <li>* <b>@block_name_rod@</b> - Родительный (<i>белую блузку</i>)</li>
                    <li>* <b>@block_name_several@</b> - Множина (<i>белые блузки</i>)</li>
                  </ul>


</div>

</div>


<script>
	 //======================================================================   
    
    $(document).on('click','.set', function(){
		var id = jQuery(this).data('id');
	
		var target = $('#target'+id).val();
		var value = $('#value'+id).val();
		
		value = value.replace('&','@*@');
		
		$.ajax({
			type: "POST",
			url: "/<?php echo TMP_DIR; ?>backend/seo/ajax/ajax_set_tpl.php",
			dataType: "text",
			data: "id="+id+"&value="+value+"&target="+target+"",
			beforeSend: function(){
			},
			success: function(msg){
			  console.log(  msg );
			}
		});
	});
	
  $(document).on('change','.edit', function(){
		var id = jQuery(this).parent('td').parent('tr').attr('id');
	
		var value = $('#value'+id).val();
		
		value = value.replace('&','@*@');
		
		$.ajax({
			type: "POST",
			url: "/<?php echo TMP_DIR; ?>backend/ajax/ajax_edit_universal.php",
			dataType: "text",
			data: "id="+id+"&value="+value+"&mainkey=<?php echo $main_key;?>&table=<?php echo $table; ?>&key=edit",
			beforeSend: function(){
			},
			success: function(msg){
			  console.log(  msg );
			}
		});
	});
	

    //======================================================================
</script>
