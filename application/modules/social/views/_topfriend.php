<h2 style="margin-top:0;">Top Friends</h2>
<?php foreach($topfriend as $row):?>
<a href="<?php echo "$social/".$row->id?>" class="thumbnail">
	<?php // echo thumb('uploads/user/'.$row->image,120,120,1);?>
	<img src="uploads/user/<?=$row->image?>" width="120" height="120">
</a>
<?php endforeach;?>