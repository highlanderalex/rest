<?php
	foreach($this->cars as $item):
?>
<div class="auto">
				<a href="index.php?view=detail&id=<?=$item['id']?>"><img src="resources/img/small/<?=$item['image']?>"></a>
				<p align="center"><?=$item['titleCat']?> <?=$item['model']?> Price: $<?=$item['price']?></p>
				<p align="justify">Description: <?=$item['description']?></p>
				<p align="center"><a href="index.php?view=detail&id=<?=$item['id']?>"><button class="btn btn-default">Detail</button></a></p>
			</div>
<?php
	endforeach;
?>
			
