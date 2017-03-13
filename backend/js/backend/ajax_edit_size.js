//=========================================================================================================================    
//=========================================================================================================================    
//=========================================================================================================================    
    jQuery(document).on('change','.edit_size_detail', function(){
       
        var id = jQuery(this).parent('td').parent('tr').attr('id');
        var name = jQuery('#name'+id).val();
        var table = jQuery('#table').val();
        var enable_tmp = 0;
        var group = jQuery('#group'+id).val();//<?php echo (int)$_GET['guide'];?>;
        var sort = jQuery('#sort'+id).val();
        
        if (jQuery('#enable'+id).prop('checked')) {
             enable_tmp = 1;
        }
        
        jQuery.ajax({
            type: "POST",
            url: "/backend/ajax/ajax_guideuniversal.php",
            dataType: "text",
            data: "id="+id+"&group="+group+"&name="+name+"&enable="+enable_tmp+"&sort="+sort+"&table="+table+"&key=edit",
            beforeSend: function(){
            },
            success: function(msg){
                console.log( msg );
            }
        });
        
    });
 
    jQuery(document).on('click','.add_size_detail', function(){
        var id = 0;
        var name = jQuery('#name').val();
        var table = jQuery('#table').val();
        var enable_tmp = 0;
        var sort = jQuery('#sort').val();
        var group = jQuery('#group').val(); //<?php echo (int)$_GET['guide'];?>;
       
        if (jQuery('#enable').prop('checked')) {
             enable_tmp = 1;
        }
        
        if (name != "") {
            jQuery.ajax({
                type: "POST",
                url: "/backend/ajax/ajax_guideuniversal.php",
                dataType: "text",
                data: "id="+id+"&group="+group+"&name="+name+"&enable="+enable_tmp+"&sort="+sort+"&table="+table+"&key=add",
                beforeSend: function(){
                },
                success: function(msg){
                    console.log( msg );
                    location.reload();
                }
            });
        }
    });
    
    jQuery(document).on('click','.dell_size_detail', function(){
        var id = jQuery(this).data('id');
        var table = jQuery('#table').val();
        
        if (confirm('Вы действительно желаете удалить размер?')){
            jQuery.ajax({
                type: "POST",
                url: "/backend/ajax/ajax_guideuniversal.php",
                dataType: "text",
                data: "id="+id+"&table="+table+"&key=dell",
                beforeSend: function(){
                },
                success: function(msg){
                    console.log( msg );
                    jQuery('#'+id).hide();
                }
            });
        }
    });
    
//======================================================================   
//======================================================================   
//======================================================================   
   
    jQuery(document).on('change','.edit_size', function(){
       
        var id = jQuery(this).parent('td').parent('tr').attr('id');
        var name = jQuery('#name'+id).val();
        var enable_tmp = 0;
        var sort = jQuery('#sort'+id).val();
        var table = jQuery('#table').val();
        
        if (jQuery('#enable'+id).prop('checked')) {
             enable_tmp = 1;
        }
        
        jQuery.ajax({
            type: "POST",
            url: "/backend/ajax/ajax_guideuniversal.php",
            dataType: "text",
            data: "id="+id+"&name="+name+"&enable="+enable_tmp+"&sort="+sort+"&table="+table+"&key=edit",
            beforeSend: function(){
            },
            success: function(msg){
                console.log( msg );
            }
        });
        
    });
 
    jQuery(document).on('click','.add_size', function(){
        var id = 0;
        var name = jQuery('#name').val();
        var enable_tmp = 0;
        var sort = jQuery('#sort').val();
        var table = jQuery('#table').val();
        
        if (jQuery('#enable').prop('checked')) {
             enable_tmp = 1;
        }
        
        if (name != "") {
            jQuery.ajax({
                type: "POST",
                url: "/backend/ajax/ajax_guideuniversal.php",
                dataType: "text",
                data: "id="+id+"&name="+name+"&enable="+enable_tmp+"&sort="+sort+"&table="+table+"&key=add",
                beforeSend: function(){
                },
                success: function(msg){
                    console.log( msg );
                    location.reload();
                }
            });
        }
        
    });
    
    jQuery(document).on('click','.dell_size', function(){
        var id = jQuery(this).data('id');
        var table = jQuery('#table').val();
        
        if (confirm('Вы действительно желаете удалить Группу размеров?')){
            jQuery.ajax({
                type: "POST",
                url: "/backend/ajax/ajax_guideuniversal.php",
                dataType: "text",
                data: "id="+id+"&table="+table+"&key=dell",
                beforeSend: function(){
                },
                success: function(msg){
                    console.log( msg );
                    jQuery('#'+id).hide();
                }
            });
        }
    });