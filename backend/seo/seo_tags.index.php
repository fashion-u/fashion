<?php
?>
<style>
	.top_select{
		float: left;
		padding: 10px;
		border: solid 1px #aacfe4;
		margin: 10px;
        height: 100px;
	}
	.table_body{
		margin: 10px;
	}
    .top_header{
        margin: 10px;
    }
	
	body{
		overflow: auto;
	}
</style>

<!-- Заголовок -->
	<div class="top_header">
		<h1 style="margin-bottom: 10px;" class="header">Импорт / экспорт Сео тегов для категорий и фильтров</h1>
	</div>

    <div style="max-width: 1375px;">
    <div class="table_body">
        
        <div class="navigation">
            <form name="import_exel_carfit" method="post" enctype="multipart/form-data">
            
			        <div class="top_select">
                       <div class="select_top get_file_wrapper"  style="margin-top: 10px;">
                            <label class="select_lable">Фаил</label>
                            <!--input type="file" name="file" style="width:300px;"-->
                            <input type="file" name="import_file"> <!--accept=".txt,image/*"-->
                                <div class="ajax-respond"></div>
                        </div>
					    <br><br>
						<div class="select_top shop">
                            <label class="select_lable">Фаил</label>
                            <input type="submit" value="Загрузить" style="width:300px;">
                        </div>
						
						<br><br><br><br><br>
						<ul>Памятка по полям:
							<li><b>type</b> - Тип (filter / category)</li>
							<li><b>id</b> - ид элемента</li>
							<li><b>name</b> - название элемента</li>
							<li><b>url</b> - урл элемента</li>
							<li><b>block_name</b> - Существительный (белая блузка)</li>
							<li><b>block_name_rod</b> - Родительный (белую блузку)</li>
							<li><b>block_name_several</b> - Множина (белые блузки)</li>
							
						</ul>
                    
					</div>
            </form>                
                    <div class="top_select">
                        <div class="select_top shop">
                            <button style="width:300px;" id="export">Сказать фаил</button>
                         </div>
                    </div>
       
        </div>
		<div style="clear: both"></div>

<script>
    $(document).on('click', '#export', function(){  
      location.href = '/<?php echo TMP_DIR; ?>backend/seo/get_excel.php';
    });

</script>
<?php
//====================================================================================================================				
//====================================================================================================================				
//====================================================================================================================				
//====================================================================================================================				
//====================================================================================================================				
//====================================================================================================================				
//====================================================================================================================				
//====================================================================================================================

if(isset( $_FILES['import_file']['tmp_name'])){
	
	$tmpFilename = $_FILES['import_file']['tmp_name'];
	require_once ('libs/docs/PHPExcel/IOFactory.php');
	
	$worksheet = PHPExcel_IOFactory::load($tmpFilename)->getSheet(0);
	
	if(!$worksheet) {die('<h2>Ошибка: лист c данными не найден</h2>');}
	
	$rows = $worksheet->getHighestRow();

	$count =2;
	
	while('' != $worksheet->getCellByColumnAndRow(0,$count)->getValue()){
		
		//Прочитаесм строчку
		$x = 0;
		$row = array();
		while('' != $worksheet->getCellByColumnAndRow($x,1)->getValue()){
			$row[$worksheet->getCellByColumnAndRow($x,1)->getValue()] = $worksheet->getCellByColumnAndRow($x,$count)->getCalculatedValue();
			$x++;
		}
		$count++;
		
		if(!$row['type']){
			echo '<br>Не указан тип! Строка '.$count;
			continue;
		}
		if(!$row['id']){
			echo '<br>Не указан ID! Строка '.$count;
			continue;
		}
		
		if($row['type'] == 'category'){
			
			$sql = 'UPDATE 	'.DB_PREFIX.'category_description SET
				name_sush = "'.$row['block_name'].'",
				name_rod = "'.$row['block_name_rod'].'",
				name_several = "'.$row['block_name_several'].'"
				WHERE category_id = "'.(int)$row['id'].'";';
				
		}elseif($row['type'] == 'filter'){
			
			$sql = 'UPDATE 	'.DB_PREFIX.'alias_description SET
				name_sush = "'.$row['block_name'].'",
				name_rod = "'.$row['block_name_rod'].'",
				name_several = "'.$row['block_name_several'].'"
				WHERE id = "'.(int)$row['id'].'";';
	
		}
		$mysqli->query($sql) or die('<br>Ошибка импорта : '.$sql);
		
		
	}
	


}