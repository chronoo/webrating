var item;
var act;
$('#users .item p').each(function(){ 
        $(this).bind('click', function(){ 
            item=$(this).text();           
            $('#users .item p').each(function(){  
                 $(this).css('color','');
            });
            $(this).css('color','blue');
            $('#users .item .use_tool').remove();
            $(this).parent().append('<div class="use_tool"><p>удалить</p></p>');
            $('.use_tool p').bind('click', function(){ 
                act=$(this).text();
                blok();
            });
    });
 });

function blok (action) {
        $.ajax({
        type: "POST",
        url: "site_control_script.php",
        data: "site="+item+"&action="+act,
        success: function(data)
        {   
            location.reload();
        }  
    });  
}