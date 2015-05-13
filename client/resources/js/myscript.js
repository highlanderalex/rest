$(document).ready(function(){
	 /*$('.orders').click(function(e){
		$(this).find('.foods').fadeIn(500);
		var _this=this;
			$.ajax({
				type: 'GET',
				url: 'libs/func/ajaxquery.php?id=' + $(this).attr('idorder'),
				dataType: 'json',
				success: function(data)
				  {
					$(_this).find('.foods').empty();
					$.each(data, function(key, obj){
						$(_this).find('.foods').append('Название ' + obj.name + ' ' + obj.qty + 'шт. Цена ' + obj.price + ' грн.<br />');
					});
				  }
			});
		});*/
		getAllAuto();
	 });

function getAllAuto(){
	$('#right_block').empty();
	str = '<div align="center">All Cars</div>';
	$('#right_block').append(str);
}