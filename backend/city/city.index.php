<!-- Sergey Kotlyarov 2016 folder.list@gmail.com -->
<?php
$file = explode('/', __FILE__);
if(strpos($_SERVER['PHP_SELF'], $file[count($file)-1]) !== false){
	header("Content-Type: text/html; charset=UTF-8");
	die('Прямой запуск запрещен!');
}
$table = 'citys';
$main_key = 'CityID';

$sql = 'SELECT * FROM '.DB_PREFIX.$table.' ORDER BY Domain, CityLable;';
$r = $mysqli->query($sql);

$arr = array();
while($row = $r->fetch_assoc()){
	$arr[$row['CityID']] = $row;
}

?>
<br>
<!--script type="text/javascript" src="/<?php echo TMP_DIR;?>backend/js/backend/ajax_edit_attributes.js"></script-->
<h1>Справочник : Города</h1>
<div style="width: 90%">
<div class="table_body">

<table class="text">
    <tr>
        <th>id</th>
        <th>Домен</th>
        <th>Город [именительный] (Москва)</th>
        <th>Город [дательный] (В Москву)</th>
        <th>Город [предложный](По Москве)</th>
    </tr>

    <tr>
        <td class="mixed">новый</td>
        <td class="mixed"><input type="text"        id="Domain" style="width:100px;" value="" placeholder="Название фильтра"></td>
        <td class="mixed"><input type="text"        id="CityLable" style="width:200px;" value=""></td>
        <td class="mixed"><input type="text"        id="CityLableKuda" style="width:200px;" value=""></td>
        <td class="mixed"><input type="text"        id="CityLablePoChemu" style="width:200px;" value=""></td>
        <td>        
            <a href="javascript:" class="add">
                <img src="/<?php echo TMP_DIR; ?>backend/img/add.png" title="Добавить" width="16" height="16">
            </a>
        </td>              
    </tr>
    <td>
        <td colspan="6">&nbsp;</td>
    </td>

<?php foreach($arr as $index => $ex){ ?>
    <tr id="<?php echo $ex['CityID'];?>">
        <td class="mixed"><?php echo $ex['CityID'];?></td>
        <td class="mixed"><input type="text" class="edit" id="Domain<?php echo $ex['CityID'];?>" style="width:100px;" value="<?php echo $ex['Domain']; ?>"></td>
        <td class="mixed"><input type="text" class="edit" id="CityLable<?php echo $ex['CityID'];?>" style="width:200px;" value="<?php echo $ex['CityLable']; ?>"></td>
        <td class="mixed"><input type="text" class="edit" id="CityLableKuda<?php echo $ex['CityID'];?>" style="width:200px;" value="<?php echo $ex['CityLableKuda']; ?>"></td>
        <td class="mixed"><input type="text" class="edit" id="CityLablePoChemu<?php echo $ex['CityID'];?>" style="width:200px;" value="<?php echo $ex['CityLablePoChemu']; ?>"></td>
        <td>        
            <a href="javascript:;" class="dell" data-id="<?php echo $ex['CityID'];?>">
                <img src="/<?php echo TMP_DIR; ?>backend/img/cancel.png" title="удалить" width="16" height="16">
            </a>
        </td>              
    </tr>
<?php } ?>

</table>
<input type="hidden" id="table" value="<?php echo $table; ?>">
<script>

    
</script>



</div>

</div>


<script>
	 //======================================================================   
    
    $(document).on('change','.edit', function(){
		var id = jQuery(this).parent('td').parent('tr').attr('id');
	
		var Domain = $('#Domain'+id).val();
		var CityLable = $('#CityLable'+id).val();
		var CityLableKuda = $('#CityLableKuda'+id).val();
		var CityLablePoChemu = $('#CityLablePoChemu'+id).val();
		
		//name = name.replace('&','@*@');
		//href = href.replace('&','@*@');
		
		$.ajax({
			type: "POST",
			url: "/<?php echo TMP_DIR; ?>backend/ajax/ajax_edit_universal.php",
			dataType: "text",
			data: "id="+id+"&Domain="+Domain+"&CityLable="+CityLable+"&CityLableKuda="+CityLableKuda+"&CityLablePoChemu="+CityLablePoChemu+"&mainkey=<?php echo $main_key;?>&table=<?php echo $table; ?>&key=edit",
			beforeSend: function(){
			},
			success: function(msg){
			  console.log(  msg );
			}
		});
	});
	
	//Add
	$(document).on('click','.add', function(){
	
		var Domain = $('#Domain').val();
		var CityLable = $('#CityLable').val();
		var CityLableKuda = $('#CityLableKuda').val();
		var CityLablePoChemu = $('#CityLablePoChemu').val();
		
		//name = name.replace('&','@*@');
		//href = href.replace('&','@*@');
		
		if (CityLable == '') {
            alert('Название города пустое!');
			return false;
        }
		$.ajax({
			type: "POST",
			url: "/<?php echo TMP_DIR; ?>backend/ajax/ajax_edit_universal.php",
			dataType: "text",
			data: "&Domain="+Domain+"&CityLable="+CityLable+"&CityLableKuda="+CityLableKuda+"&CityLablePoChemu="+CityLablePoChemu+"&mainkey=<?php echo $main_key;?>&table=<?php echo $table; ?>&key=add",
			beforeSend: function(){
			},
			success: function(msg){
			  console.log(  msg );
			  location.reload();
			}
		});
		
	});
	
   	//Удаление
   $(document).on('click','.dell', function(){
       var id = jQuery(this).parent('td').parent('tr').attr('id');
      
	  if (confirm('Вы действительно желаете удалить город?')){
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
		  }
		});
	  }
    });
    //======================================================================
</script>
