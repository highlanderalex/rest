$(document).ready(function(){
    	getAllAuto();
	 });

function getAllAuto(){
	$('#right_block').empty();
    str = '';
    $.ajax({
        type:'GET',
        url:'/~user4/PHP/rest/client/api/auto/allAuto',
        dataType:'json',
        success:function(data)
        {
            $.each(data, function(key,obj){
            $('#right_block').append('id' + obj.id + 'model' + obj.model + 'desc' + obj.description +
                    'price' + obj.price + 'image' + obj.image + '<br />');    
           });
        }
    });
}

function loginPage(){
	$('#right_block').empty();
	str = '<div align="center"><h2>Page LOGIN</h2></div>';
	$('#right_block').append(str);
}

function adminPage(){
	$('#right_block').empty();
	str = '<div align="center"><h2>Page ADMIN</h2></div>';
	$('#right_block').append(str);
}
