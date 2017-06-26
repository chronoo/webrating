var begin= new Date();
var finish = new Date();
begin.setDate(begin.getDate() -7);

$(document).ready(function() {
     draw();
 });

$('#date_select').children().each(function(){        
        $(this).bind('click', function(){
        begin= new Date();    
        finish = new Date();
            $('#date_select').children().each(function(){  
                 $(this).css('color','');
            });
            $(this).css('color','red');
            switch($(this).text())
            {
                case 'Неделя':
                begin.setDate(begin.getDate() -7);
                break;
                case 'Месяц':
                begin.setMonth(begin.getMonth() -1);
                break;
                case 'Год':
                begin.setFullYear(begin.getFullYear() -1);
                break;
            }
            draw();
    });
 });


var mode="visit";
$('#go').click(function() {
    begin = new Date($('#us_begin').val());
    finish = new Date($('#us_finish').val());
    draw();  
});

$('#visit').click(function() {
    mode="visit";
    $('#control').children().each(function(){
        $(this).css('color','');
    });
    $('#visit').css('color','red');  
    draw();  
});
$('#referer').click(function() {
    mode="part";
    $('#control').children().each(function(){
        $(this).css('color','');
    });
    $('#referer').css('color','red');  
    draw();  
});
$('#visitor').click(function() {
    mode="all";
    $('#control').children().each(function(){
        $(this).css('color',''); 
    });
    $('#visitor').css('color','red');  
    draw();  
});

 function Graf (array) {
        Highcharts.chart('graf', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Страницы'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegfinish: true
                }
            },
            series: [{
                name: 'Посетители',
                colorByPoint: true,
                data : array,
            }]
        });    
};

 function Graf2 (array,array2) {
    Highcharts.chart('graf', {
        title: {
            text: 'Динамика посещений',
            x: -20 //center
        },
        xAxis: {
            categories: array2
        },
        yAxis: {
            title: {
                text: 'Посещения'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legfinish: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'посетителя',
            data: array
        }, ]
    });
}

function draw () {
        var site = $('#site_title').text();
        var lenght=Math.round((finish-begin)/(1000*60*60*24));
        $.ajax({
        type: "POST",
        url: "graf_create.php",
        data: "begin="+begin.toISOString()+"&finish="+finish.toISOString()+"&mode="+mode+"&site="+site+"&period="+lenght,
        dataType: 'json',
        success: function(data)
        {   
            var res = data;
              if(mode=='visit'||mode=='part')
                {
                    var result = [];
                    for(var k in res) {
                        var v = res[k];
                        if(v[0]!=='undefined')                        
                            var mrArray = {name : v[0], y : parseFloat(v[1])};
                        else
                            var mrArray = {name : 'сохранённые и прочие страницы', y : parseFloat(v[1])};
                        result.push(mrArray);
                    }                                      
                }
                else if(mode=='all')
                {
                    lenght=Math.round((finish-begin)/(1000*60*60*24));
                    var rez=[];
                    var mult=1;
                    var result = [];
                    var result2 = [];
                    if(lenght>29&&lenght<90)    
                    {
                        lenght/=7;
                        mult=7;
                    }else if(lenght>89){
                        lenght/=30;
                        mult=30;
                    }                    
                    for(var i=0;i<lenght;i++){
                        var now = new Date(finish-(1000*60*60*24)*i*mult);
                        rez[i]=new Intl.DateTimeFormat('en-GB').format(now);
                        result[i]=0;
                        result2[i]=0;
                    }
                    for(var k in res) {
                        var v = res[k];                        
                        result[parseFloat(v[0])]=parseFloat(v[1]);                  
                    }
                    rez.reverse();
                    result.reverse();
                }

            if(mode=='visit'||mode=='part'){
                Graf(result);
            }
            else if(mode=='all'){
                    Graf2(result,rez);
                }
            }
    });  
}