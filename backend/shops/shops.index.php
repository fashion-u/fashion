<?php
$file = explode('/', __FILE__);
if(strpos($_SERVER['PHP_SELF'], $file[count($file)-1]) !== false){
	header("Content-Type: text/html; charset=UTF-8");
	die('Прямой запуск запрещен!');
}
$type = 'shops';
$table = 'shops';
$catalog = 'shops';
$main_key = 'id';
$uploaddir = '/'.TMP_DIR.'image/'.$catalog.'/';

// Если прилетела форма - сохраним===============================
if(isset($_POST['key']) AND $_POST['key'] == 'add'){
     
	  $enable = 0;
	  if(isset($_POST['enable'])) $enable = '1';
	  
	  //Если это код 0 - новый
	    $sql = 'INSERT INTO '.DB_PREFIX.$table.' SET
				  `name` = "'.$_POST['name'].'",
		    	  `href` = "'.$_POST['href'].'",
				  `xml_name` = "'.$_POST['xml_name'].'",
				  `sort` = "'.$_POST['sort'].'",
				  `modul` = "'.$_POST['modul'].'",
				  `description` = "'.$_POST['description'].'",
				  `enable` = "'.$enable.'"
			    ;';
			//echo $sql;
	    $r = $mysqli->query($sql);
		
	echo "<H2>Добавлено! Подождите, идет сохранение.</H2><SCRIPT>\n\nvar i = setTimeout(\"window.location.href='/".TMP_DIR."backend/index.php?route=shops/shops.index.php'\", 500);\n</SCRIPT>";
}
?>
<br>
<h1>Магазины</h1>
<h2>Лого магазина. Размер 200 х 100 px!</h2>
<style>
 .table tr td {
	border: 1px solid gray;
	margin: 0;
	border-spacing: 0;
	border-collapse: collapse;
	padding: 10px 5px 10px 5px;
 }
 .table tr th {
	border: 1px solid gray;
	margin: 0;
	border-spacing: 0;
	border-collapse: collapse;
 }
 .table {
	border: 1px solid gray;
	margin: 0;
	border-spacing: 0;
	border-collapse: collapse;
 }

</style>
<?php
$sql = 'SELECT * FROM '.DB_PREFIX.$table.' ORDER BY sort, name;';
$r = $mysqli->query($sql);
?>
<div style="width: 90%">
    <div class="table_body">
        <table class="text">
		<tr>
			<th>#</th>
			<th> + + + </th>
			<th>Показывать</th>
			<th>Тексты</th>
			<th colspan="2"></th>
		</tr>
      
		<tr><form method=post>
			<td>новый<input type="hidden" name="id0" value=""></td>
			<td><!--img src="reklama/img/large_banner_help.jpg" width="125"--></td>
			<td><input type="checkbox" name="enable" class="enable" data-id="0" checked></td>
			<td>
			  <br>Название</b> : <input type="text" name="name" class="name" data-id="0" style="width:400px;" value="" placeholder="Название магазина">
			  <br>ЧПУ</b> : <input type="text" name="href" id="href" class="href" data-id="0" style="width:400px;" value="" placeholder="URL">
			  <br>Имя в XML</b> : <input type="text" name="xml_name" class="xml_name" data-id="0" style="width:400px;" value="" placeholder="Для автоопределения магазина при импорте">
			  <br>Свой модуль обработки</b> : <input type="modul" name="modul" class="modul" data-id="0" style="width:400px;" value="" placeholder="модуль">
			  <br>Сортировка</b> : <input type="sort" name="sort" class="sort" data-id="0" style="width:400px;" value="0" placeholder="0">
			  <br>Описание</b> : <input type="text" name="description" class="description" data-id="0" style="width:400px;" value="" placeholder="Сюда потом прикрутить редактор де">
			</td>
			<td colspan="1"><input type="submit" name="key" value="add" style="width:50px;"></td>
			<td colspan="2">Фото после добавляния</td>
		</tr></form>

<?php while($value = $r->fetch_assoc()){ ?>
 <tr id="<?php echo $value['id']; ?>">
      <td><?php echo $value['id']; ?></td>
	  <td><img src="<?php echo $uploaddir.$value['image']; ?>" width="125" height="125">
	  </td>
	  <td><input type="checkbox" id="enable<?php echo $value['id']; ?>" class="enable edit" data-id="<?php echo $value['id']; ?>" <?php if($value['enable'] == 1) echo ' checked '; ?> ></td>
      <td>
		  <br>Название</b> : <input type="text" id="name<?php echo $value['id'];?>" class="name edit" data-id="<?php echo $value['id'];?>" style="width:400px;" value="<?php echo $value['name']; ?>">
		  <br>ЧПУ</b> : <input type="text" id="href<?php echo $value['id']; ?>" class="href edit" data-id="<?php echo $value['id'];?>" style="width:400px;" value="<?php echo $value['href']; ?>">
		  <br>Имя в XML [company]</b> : <input type="text" id="xml_name<?php echo $value['id']; ?>" class="xml_name edit" data-id="<?php echo $value['id']; ?>" style="width:400px;" value="<?php echo $value['xml_name']; ?>">
		  <br>Свой модуль обработки</b> : <input type="text" id="modul<?php echo $value['id'];?>" class="modul edit" data-id="<?php echo $value['id']; ?>" style="width:400px;" value="<?php echo $value['modul']; ?>">
		  <br>Сортировка</b> : <input type="text" id="sort<?php echo $value['id'];?>" class="sort edit" data-id="<?php echo $value['id']; ?>" style="width:400px;" value="<?php echo $value['sort']; ?>">
		  <br>Описание</b> : <input type="text" id="description<?php echo $value['id'];?>" class="description edit" data-id="<?php echo $value['id']; ?>" style="width:400px;" value="<?php echo $value['description']; ?>">
	  </td>
  
	  <td>
		<a href="javascript:" class="dell" id="dell_<?php echo $value['baner_id']; ?>"><img src="/<?php echo TMP_DIR; ?>backend/img/cancel.png" title="удалить" width="16" height="16"></a>
	  </td>
	
	  <td>
		<form enctype="multipart/form-data" method="post" action="main_page/load_photo.php">
		  <input type="hidden" name="type" value="<?php echo $type; ?>">
		  <input type="hidden" name="MAX_FILE_SIZE" value="'.(1048*1048*1048).'">
		  <input type="hidden" name="filename"  value="<?php echo $value['id']; ?>">
		  <input type="file" min="1" max="999" multiple="false" style="width:250px"  name="userfile" OnChange="submit();"/>
		</form>
	  </td>
	  
      </tr>
  
<?php } ?>

	</table>
	</div>
</div>
  <script>
	  $(document).on('change','.edit', function(){
		var id = jQuery(this).parent('td').parent('tr').attr('id');
		var enable = '0';
		var name = $('#name'+id).val();
		var href = $('#href'+id).val();
		var xml_name = $('#xml_name'+id).val();
		var modul = $('#modul'+id).val();
		var sort = $('#sort'+id).val();
		var description = $('#description'+id).val();
		
		//console.log($('#enable'+id).prop('checked'));
		if ($('#enable'+id).prop('checked')) {
            enable = '1' ;
        }
		
		 $.ajax({
		type: "POST",
		url: "/<?php echo TMP_DIR; ?>backend/ajax/ajax_edit_universal.php",
		dataType: "text",
		data: "id="+id+"&enable="+enable+"&name="+name+"&href="+href+"&xml_name="+xml_name+"&modul="+modul+"&sort="+sort+"&description="+description+"&mainkey=<?php echo $main_key;?>&table=<?php echo $table; ?>&key=edit",
		beforeSend: function(){
		},
		success: function(msg){
		  console.log(  msg );
		  //$('#msg').html('Изменил');
		  //setTimeout($('#msg').html(''), 1000);
		}
	  });
		
	});
	
   	//Удаление
   $(document).on('click','.dell', function(){
       var id = jQuery(this).parent('td').parent('tr').attr('id');
      
	  if (confirm('Вы действительно желаете удалить баннер?')){
		$.ajax({
		  type: "POST",
		  url: "/<?php echo TMP_DIR; ?>backend/ajax/ajax_edit_universal.php",
		  dataType: "text",
		  data: "id="+id+"&table=<?php echo $table; ?>&mainkey=<?php echo $main_key;?>&key=dell",
		  beforeSend: function(){
			
		  },
		  success: function(msg){
			console.log(  msg );
			location.reload;
			jQuery('#'+id).hide()
			//$('#msg').html('Удалил');
			//setTimeout($('#msg').html(''), 1000);
		  }
		});
	  } 
    });
  </script>