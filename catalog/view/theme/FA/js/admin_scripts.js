
 $(document).mouseup(function (e){
  var div = $('.dropdown-menu');
  if (!div.is(e.target)
      && div.has(e.target).length === 0) {
   div.hide();
  }
 var div = $('.dropdown-setup-menu');
  if (!div.is(e.target)
      && div.has(e.target).length === 0) {
   div.hide();
  }
 var div = $('.account-setings-menu');
  if (!div.is(e.target)
      && div.has(e.target).length === 0) {
   div.hide();
  }
 });
// search form
$(document).on('click', '.search-button', function(){
    $('.search').slideToggle();
});
// end search form



//Ip list
$(document).on('change', '.input_ignore_ip', function(){
    var ip_list = '';
    
    $.each($('.input_ignore_ip'), function( index, value ) {
        var ip = $(this).val();
        
        if (ip != '' && ValidateIPaddress(ip)) {
            
            ip_list = ip_list + ip + ',';
        }

    }).promise().done(function (i) {
        
        $.ajax({
            type: "POST",
            url: "/"+tmp_dir+"index.php?route=account/my_account/save_ignore_ip",
            dataType: "text",
            data: "shop_id="+$('#shop_id').val()+"&ip_list="+ip_list,
            beforeSend: function(){
            },
            success: function(msg){
              console.log(  msg );
              
            }
        });
           
    });
    
});

$(document).on('click', '.count_product', function(){
    console.log($(this).val());
});
$(document).on('click', '.count_product', function(){
    console.log($(this).val());
});

$(document).on('ifChanged', '#checked_all', function(){
   
    var checked = $(this).prop('checked');
    
    $.each($('.product_checkbox'), function( index, value ) {
        console.log(checked);
        if (checked) {
            $(this).prop('checked', 'checked');    
        }else{
            $(this).prop('checked', '');
        }
        
        $(this).iCheck('update');
    });
});

//status ========================================
function set_product_new_status(product_id, status_id){
    if (status_id == 1) {
        $('#status'+product_id).removeClass('ic-switch-pause');
        $('#status'+product_id).addClass('ic-switch-on');
    }else{
        $('#status'+product_id).addClass('ic-switch-pause');
        $('#status'+product_id).removeClass('ic-switch-on');
    }
    
    $.ajax({
        type: "POST",
        url: "/"+tmp_dir+"index.php?route=account/my_account/set_status_ajax",
        dataType: "text",
        data: "product_id="+product_id+"&status_id="+status_id,
        beforeSend: function(){
        },
        success: function(msg){
            //console.log(  msg );
        }
    });
}

$(document).on('click', '.status', function(){
    
    var status_id = $(this).data('status');
    var product_id = $(this).data('product_id');

    set_product_new_status(product_id, status_id);
        
    $(this).parent('div').hide();
    
});

$(document).on('click', '.status_all', function(){
    
    var status_id = $(this).data('status');
    
    $.each($('.product_checkbox'), function( index, value ) {
        if($(this).prop('checked')){
            set_product_new_status($(this).attr('id'), status_id);
        }
    });
    
    $('.changes-menu').hide();
    
});


//money limit ===============================================
function set_product_money_limit(product_id, money_limit){
   
    $.ajax({
        type: "POST",
        url: "/"+tmp_dir+"index.php?route=account/my_account/set_money_limit_ajax",
        dataType: "text",
        data: "product_id="+product_id+"&money_limit="+money_limit,
        beforeSend: function(){
        },
        success: function(msg){
            $('#money_limit'+product_id).html(money_limit);
            console.log(  msg );
        }
    });
}

$(document).on('click', '.money_limit', function(){
    var product_id = $(this).parent('div').children('input').first().data('product_id');
    var money_limit = $(this).parent('div').children('input').first().val();
    
    set_product_money_limit(product_id, money_limit);
    //console.log(product_id+' '+money_limit);
    
    $(this).parent('div').hide()
    
});

$(document).on('click', '.money_limit_close', function(){
    $(this).parent('div').hide();
});

$(document).on('click', '.all_money_limit', function(){
    
    var money_limit = $('#all_money_limit').val().replace(',','.');;
    
    $.each($('.product_checkbox'), function( index, value ) {
        if($(this).prop('checked')){
            set_product_money_limit($(this).attr('id'), money_limit);
        }
    });
    
    $('.changes-menu').hide();
    
});

//price of clicks ======================================
function set_product_money_click(product_id, money_click){
   
    if (money_click < 1) {
        money_click = 1;
    }
    
        $.ajax({
            type: "POST",
            url: "/"+tmp_dir+"index.php?route=account/my_account/set_money_click_ajax",
            dataType: "text",
            data: "product_id="+product_id+"&money_click="+money_click.toFixed(2),
            beforeSend: function(){
            },
            success: function(msg){
                $('#money_click'+product_id).html(parseFloat(money_click).toFixed(2));
                console.log(  msg );
            }
        });
}

$(document).on('click', '.click_up', function(){
    
    var product_id = $(this).data('product_id');
    var money_click = parseFloat($('#money_click'+product_id).html()) + 0.1;
    
    set_product_money_click(product_id, money_click);

});

$(document).on('click', '.click_down', function(){
    
    var product_id = $(this).data('product_id');
    var money_click = parseFloat($('#money_click'+product_id).html()) - 0.1;
   
    set_product_money_click(product_id, money_click);

});
$(document).on('click', '.all_money_click', function(){
    
    var money_click = $('#all_money_click').val().replace(',','.');
    
    if (money_click < 1) {
        money_click = 1.00;
    }
    
    $.each($('.product_checkbox'), function( index, value ) {
        if($(this).prop('checked')){
            set_product_money_click($(this).attr('id'), money_click);
        }
    });
    
    $('.changes-menu').hide();
    
});


//category_tree



