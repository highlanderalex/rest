$(document).ready(function(){
    	getAllAuto();
	 });

function getAllAuto(){

	$('#right_block').empty();
    var i = 0;
    $.ajax({
        type:'GET',
        //url:'/rest/server/api/shop/auto/allAuto',
        url:'/~user4/PHP/rest/client/api/auto/allAuto',
        dataType:'json',
        success:function(data)
        {
            $.each(data, function(key,obj){
            //$('#right_block').append
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
        //url:'/rest/server/api/shop/auto/detailInfo/' + id,
        url:'/~user4/PHP/rest/client/api/auto/detailInfo/' + id,
        dataType:'json',
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
	
    $('#right_block').empty();
	str = '<div align="center"><h2>Page Orders</h2></div>';
	$('#right_block').append(str);

}

function userAuth(){

    email = $('input[name=email]').val();
    pass = $('input[name=password]').val();
    //valid data
    $('#orders, #exit').css('display', 'block');
    $('#enter').css('display', 'none');
    getAllAuto();

}

function getSearch(){

    model = $('select[name=model]').val();
    year = $('select[name=year]').val();
    color = $('select[name=color]').val();
    speed = $('select[name=speed]').val();
    volume = $('select[name=volume]').val();
    price = $('select[name=price]').val();
	str = '<div align="center"><h2>Result Search</h2></div>';
    str += model + ' ' + year + ' ' + color + ' ' + speed + ' ' + volume + ' ' + price;
    $('#right_block').empty();
    $('#right_block').append(str);

}

function buy(id){

	str = '<div align="center"><h2>Thanks for your choice</h2></div>';
    pay = $('select[name=pay]').val();
    str += pay + 'id #' + id;
    $('#right_block').empty();
    $('#right_block').append(str);

}

function logout(){

    //del localstorage
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
           + '<a href="" onclick="userAuth();return false;"><button class="btn btn-primary">Login</button></div>';
	$('#right_block').append(str);

}

function adminPage(){

	$('#right_block').empty();
	str = '<div align="center"><h2>Page ADMIN</h2></div>';
	$('#right_block').append(str);

}
