<div align="center">
	<h4>Result Search</h4>
</div>
<?php
	if($this->message)
	{
?>
	<h3><?=$this->message;?></h3>
<?php
	}
	else
	{
?>
<?php
	$i = 1;
	foreach($this->search as $item):
?>
	<a href="index.php?view=detail&id=<?=$item['id']?>">Result <?=$i;?></a><br />
<?php
	$i++;
	endforeach;
	}
?>