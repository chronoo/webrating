var item;
var block;
var act;
$('#users .item p').each(function(){ 
        $(this).bind('click', function(){ 
            block=$(this).parent().children('span').text();
            item=$(this).text();           
            if(block=="(заблокирован)")
                var action='разблокировать'
            else 
                var action='заблокировать'
            $('#users .item p').each(function(){  
                 $(this).css('color','');
            });
            $(this).css('color','blue');
            $('#users .item .use_tool').remove();
            $(this).parent().append('<div class="use_tool"><p>'+action+'</p><p>удалить</p></p>');
            $('.use_tool p').bind('click', function(){ 
                act=$(this).text();
                //console.log(item+" "+act);
                blok();
            });
    });
 });

function blok (action) {
        $.ajax({
        type: "POST",
        url: "user_control_script.php",
        data: "user="+item+"&action="+act,
        success: function(data)
        {   
            location.reload();
        }  
    });  
}