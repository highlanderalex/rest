<div align="center">
	<?php
		if ($this->success)
		{
		?>
			<h2><?=$this->success;?></h2>
		<?php
		}
		else
		{
		?>
	<div style="color:red;width:400px;margin:0 auto;margin-top:10px;"><?=$this->error;?></div>
		<div style="width:400px;margin:0 auto;margin-bottom:50px;">
		<form action="index.php?view=order" method="post">
		<input type="hidden" name="id"  value="<?=(isset($_POST['id']))? $_POST['id']:$_GET['id']?>">
		  <div class="form-group">
		  <label for="exampleInputName">Name</label>
		  <input type="text" class="form-control" id="exampleInputName" name="name" maxlength="15" placeholder="Your name" value="<?=(isset($_POST['name']))? $_POST['name']:''?>">
		  </div>
		  <div class="form-group">
			<label for="exampleInputAddress">Email</label>
			<input type="email" class="form-control" id="exampleInputAddress" name="email" maxlength="25" placeholder="Your email" value="<?=(isset($_POST['email']))? $_POST['email']:''?>">
		  </div>
		  <div class="form-group">System payment
			<select name="pay">
				<option value="1" selected>Cash</option>
				<option value="2">VISA</option>
			</select>
		  </div>
		  <input type="submit" class="btn btn-primary" value="Order" name="order">
		</form>
		</div>
		<?php
		}
		?>
</div>
