<div style="background: #fff; padding: 10px; margin-top: 25px;">
<?foreach($pages as $row):?>
<h2><?=$row->category?></h2>
<ul>
	<?$pages2 = $pages2->where('category = "'.$row->category.'"')->get();?>
	<?foreach($pages2 as $item):?>
	<li><a href="pages/view/<?=$item->id?>"><?=$item->title?></a></li>
	<?endforeach;?>
</ul>
<?endforeach;?>
</div>
