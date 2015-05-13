<link href="resources/css/prettyPhoto.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="resources/js/jquery.js"></script>
<script type="text/javascript" src="resources/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="resources/js/jquery.lavalamp.min.js"></script>
<script type="text/javascript" src="resources/js/js.js"></script>
<script src="resources/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>  
<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$("a[rel^='prettyPhoto']").prettyPhoto({
				animationSpeed: 'normal',
				padding: 40, 
				opacity: 0.90,
				showTitle: true,
				allowresize: true,
				counter_separator_label: '/', 
				theme: 'dark_square', 
				callback: function(){}
			});
		});
</script>
<?php
	if($this->error)
	{
?>
	<div align="center"><h2><?=$this->error;?></h2></div>
<?php
	}
	else
	{
	?>
		<div class="description">
				<h2 align="center"><?=$this->auto->model?></h2>
				<p align="center"><img src="resources/img/big/<?=$this->image['image'];?>"></p>
					<div align="center">
					<?php
						foreach($this->galary as $item):
					?>
						<a href="resources/img/big/<?=$item['image']?>" rel="prettyPhoto[gallery]" title=""><img src="resources/img/small/<?=$item['image']?>" width="200px" alt=""/></a>
					<?php
						endforeach;
					?>
					</div>
				<p align="center">Price $<?=$this->auto->price?></p>
				<p align="center">Color:<?=$this->auto->color?> Year:<?=$this->auto->year?> Speed:<?=$this->auto->speed?> Volume:<?=$this->auto->volume?></p>
				<p align="center"><a href="index.php?view=order&id=<?=$this->idauto?>"><button class="btn btn-default">Buy</button></a></p>
		</div>
	<?php
	}
	?>

