var baseUrl = '/rest/server/api/shop/';
//var baseUrl = '/~user4/PHP/rest/client/api/';
var type = 'json';

$(document).ready(function(){
		if(localStorage.getItem("user_info"))
		{
			data = JSON.parse(localStorage.getItem("user_info"));
			name = data[1];
			$('#orders a, #exit a').empty();
			$('#orders a').append(name + 'Orders');
			$('#exit a').append(name + 'Exit');
			$('#orders, #exit').css('display', 'block');
			$('#enter').css('display', 'none');
		}
    	getAllAuto();
});

function getAllAuto(){
	$('#right_block').empty();
    var i = 0;
    $.ajax({
        type:'GET',
        url:baseUrl + 'auto/allAuto',
        dataType:type,
        success:function(data)
        {
            $.each(data, function(key,obj){
            str = '<div class="auto" style="display:none;"><p align="center"><img src="resources/img/small/' + obj.image + '"></p>'
							+ '<p align="center">' + obj.titleCat + ' ' + obj.model + ' Price: $' + obj.price + '</p>' 
							+ '<p align="justify">Description:' + obj.description + '</p>'
							+ '<p align="center"><a href="" onclick="detailInfo(' + obj.id + ');return false;"><button class="btn btn-default">Detail</button></a></p></div>';
            $('#right_block').append(str);
            $('.auto').fadeIn(500+i);
            i = i+500;   
           });
        }
    });
}

function detailInfo(id){
	$('#right_block').empty();
    $.ajax({
        type:'GET',
        url:baseUrl + 'auto/detailInfo/' + id,
        dataType:type,
        success:function(data)
        {
            $('#right_block').append('<div class="description"><h2 align="center">' + data.model + '</h2>'
									 + '<p align="center"><img src="resources/img/big/' + data.image + '"></p>'
									 + '<p align="center">Price $' + data.price + '</p>'
									 + '<p align="center">Color:' + data.color + ' Year:' + data.year +' Speed:' + data.speed + ' Volume:' + data.volume + '</p>'
									 + '<p align="center">'
                                     + 'System payment <select name="pay"><option value="1" selected>Cash</option><option value="2">VISA</option></select>' 
                                     + ' <a href="" onclick="buy(' + data.id + ');return false;"><button class="btn btn-default">Buy</button></a></p>');    
           
        }
    });
}

function getOrders(){
	arr = localStorage.getItem("user_info") ? JSON.parse(localStorage.getItem("user_info")) : '';
	id = arr[0];
    $('#right_block').empty();
	str = '<div align="center"><h2>Page Orders</h2></div>';
	$('#right_block').append(str);
	$.ajax({
        type:'POST',
        url:baseUrl + 'order/userOrder/',
		data:'id=' + id,
        dataType:type,
        success:function(data)
        {
            if (data.result == 0)
            {
	            str = '<div align="center"><h5>Orders empty</h5></div>'; 
                $('#right_block').append(str);
                return;
            }
            else
            {
				str = '<div align="center"><table class="table table-bordered">';
				$.each(data, function(key,obj){
				str += '<tr><td>' + obj.data + '</td>'
						+ '<td>' + obj.pay + '</td>' 
						+ '<td>' + obj.model + '</td>'
						+ '<td>' + obj.color + '</td>'
						+ '<td>$' + obj.price + '</td>'
						+ '<td align="center"><img src="resources/img/small/' + obj.image + '" width="100px"></td></tr>';
				});
			}
		   str += '</table></div>';
		   $('#right_block').append(str);
        }
    });
}

function userAuth(){
    email = $('input[name=email]').val();
    pass = $('input[name=password]').val();
    $.ajax({
        type:'POST',
        url:baseUrl + 'user/userAuth/',
        data:'email=' + email + '&password=' + pass,
        dataType:type,
        success:function(data)
        {
			if(data.result)
			{
				str = data.result;
				$('.error').empty();
				$('.error').append(str);
			}
			else
			{
				var user = [data.id, data.name, data.code];
				localStorage.setItem('user_info', JSON.stringify(user));
				$('#right_block').empty();
				$('#orders a, #exit a').empty();
				$('#orders a').append(data.name + 'Orders');
				$('#exit a').append(data.name + 'Exit');
				$('#orders, #exit').css('display', 'block');
				$('#enter').css('display', 'none');
				getAllAuto();
			}
        }
    });
}

function userReg(){
    name = $('input[name=name]').val();
	email = $('input[name=email]').val();
    pass = $('input[name=password]').val();
    $.ajax({
        type:'POST',
        url:baseUrl + 'user/userReg/',
        data:'name=' + name + '&email=' + email + '&password=' + pass,
        dataType:type,
        success:function(data)
        {
			if(data.result)
			{
				str = data.result;
				$('.error').empty();
				$('.error').append(str);
			}
			else
			{
				str = '<div align="center"><h2>' + data.success + '</h2></div>';
				$('#right_block').empty();
				$('#right_block').append(str);
			}
        }
    });
}

function getSearch(){
    model = $('select[name=model]').val();
    year = $('select[name=year]').val();
    color = $('select[name=color]').val();
    speed = $('select[name=speed]').val();
    volume = $('select[name=volume]').val();
    price = $('select[name=price]').val();
	$('#right_block').empty();
	str = '<div align="center"><h2>Result Search</h2></div>';
    $('#right_block').append(str);	
    $.ajax({
        type:'POST',
        url:baseUrl + 'auto/getSearch/',
        data:'model=' + model + '&year=' + year + '&color=' + color + '&speed=' + speed + '&volume=' + volume + '&price=' + price,
        dataType:type,
        success:function(data)
        {
            if (data.result == 0)
            {
	            str = '<div align="center"><h5>Result return empty</h5></div>'; 
                $('#right_block').append(str);
                return;
            }
            else
            {
                $.each(data, function(key, obj){
                    
                    $('#right_block').append('<a href="" onclick="detailInfo(' + obj.id +');return false;">Result</a><br />');
                });
            }
        }
    });
}

function buy(idAuto){
    pay = $('select[name=pay]').val();
	if (localStorage.getItem("user_info"))
	{
		arr = JSON.parse(localStorage.getItem("user_info"));
		id = arr[0];
		$.ajax({
			type:'POST',
			url:baseUrl + 'order/addOrder/',
			data:'idAuto=' + idAuto + '&idUser=' + id + '&pay=' + pay,
			dataType:type,
			success:function(data)
			{
				$('#right_block').empty();
				if(data.result == 1)
				{
					str = '<div align="center"><h2>Thanks for your choice</h2></div>';
					$('#right_block').append(str);
				}
			}
		});
		}
	else
	{
		loginPage();
	}
}

function logout(){
    localStorage.clear();
    $('#orders, #exit').css('display', 'none');
    $('#enter').css('display', 'block');
    getAllAuto();
    
}

function loginPage(){
	$('#right_block').empty();
	str = '<div style="color:red;width:400px;margin:0 auto;margin-top:10px;" class="error"></div>'
		   + '<div style="width:400px;margin:0 auto; margin-top:30px;margin-bottom:50px;">'
		   + '<label for="exampleInputEmail1">Email</label>'
		   + '<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Your email" name="email" value=""><br />'
		   + '<label for="exampleInputPassword1">Password</label>'
           + '<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password"><br />'
           + '<a href="" onclick="userAuth();return false;"><button class="btn btn-primary">Login</button><a href="" onclick="regPage();return false;">&nbsp;Registration</a></div>';
	$('#right_block').append(str);
}

function regPage(){
	$('#right_block').empty();
	str = '<div style="color:red;width:400px;margin:0 auto;margin-top:10px;" class="error"></div>'
		   + '<div style="width:400px;margin:0 auto; margin-top:30px;margin-bottom:50px;">'
		   + '<label for="exampleInputName">Name</label>'
		   + '<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Your name" name="name" value=""><br />'
		   + '<label for="exampleInputEmail1">Email</label>'
		   + '<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Your email" name="email" value=""><br />'
		   + '<label for="exampleInputPassword1">Password</label>'
           + '<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password"><br />'
           + '<a href="" onclick="userReg();return false;"><button class="btn btn-primary">Registration</button></div>';
	$('#right_block').append(str);
}

function adminPage(){
	$('#right_block').empty();
	str = '<div align="center"><h2>Page ADMIN</h2></div>';
	str += '<div style="color:red" class="error" align="center"></div>';
	$('#right_block').append(str);
    $.ajax({
        type:'GET',
        url:baseUrl + 'admin/getInfo/',
        dataType:type,
        success:function(data)
        {
            //alert(data);
			$.each(data, function(key,obj){
            str = '<div class="auto"><p align="center">Image<input auto="' + obj.id + '" type="text" name="image" value="' + obj.image + '"></p>'
							+ '<p align="center">Model<input auto="' + obj.id + '" type="text" name="model" value="' + obj.model + '"></p>'
							+ '<p align="center">Color<input auto="' + obj.id + '" type="text" name="color" value="' + obj.color + '"></p>'
							+ '<p align="center">Year<input auto="' + obj.id + '" type="text" name="year" value="' + obj.year + '"></p>'
							+ '<p align="center">Price<input auto="' + obj.id + '" type="text" name="price" value="' + obj.price + '"></p>' 
							+ '<p align="center"><a href="" onclick="updateAuto(' + obj.id + ');return false;"><button class="btn btn-default">Update</button></a></p>'
							+ '<p align="center"><a href="" onclick="deleteAuto(' + obj.id + ');return false;"><button class="btn btn-default">Delete</button></a></p></div>';
            $('#right_block').append(str);
           });
        }
    });
}

function updateAuto(id){
	idAuto = id;
	color = $('input[name=color][auto=' + idAuto + ']').val();
	year = $('input[name=year][auto=' + idAuto + ']').val();
	model = $('input[name=model][auto=' + idAuto + ']').val();
	price = $('input[name=price][auto=' + idAuto + ']').val();
	image = $('input[name=image][auto=' + idAuto + ']').val();
	//alert(idAuto + color + year + model + price + image);
    $.ajax({
        type:'POST',
        url:baseUrl + 'admin/getInfo/',
		data:'id=' + idAuto + '&color=' + color + '&year=' + year + '&model=' + model + '&price=' + price + '&image=' + image,
        dataType:type,
        success:function(data)
        {
            if(data.result)
			{
				$('.error').empty();
				$('.error').append(data.result);
			}
			else
			{
				$('.error').empty();
				adminPage();
			}
           
        }
    });
}

function deleteAuto(id){
    $.ajax({
        type:'DELETE',
        url:baseUrl + 'admin/getInfo/' + id,
        dataType:type,
        success:function(data)
        {
            if(data.result)
			{
				$('.error').empty();
				$('.error').append(data.result);
			}
			else
			{
				$('.error').empty();
				adminPage();
			}
           
        }
    });
}
