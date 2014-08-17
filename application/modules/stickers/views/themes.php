<div id="sticker">
	
<section id="creator" class="clearfix">
<div class="btn-group">
  <a href="sticker/themes?sort=new&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'new')? "active" : "" ;?>">ใหม่</a>
  <a href="sticker/themes?sort=hot&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'hot')? "active" : "" ;?>">ยอดนิยม</a>
  <a href="sticker/themes?sort=rand&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'rand')? "active" : "" ;?>">สุ่ม</a>
</div>

<div class="btn-group">
  <a href="sticker/themes?sort=<?=@$_GET['sort']?>&n=30" class="btn btn-default <?=(@$_GET['n'] == '30')? "active" : "" ;?>">30</a>
  <a href="sticker/themes?sort=<?=@$_GET['sort']?>&n=90" class="btn btn-default <?=(@$_GET['n'] == '90')? "active" : "" ;?>">90</a>
  <a href="sticker/themes?sort=<?=@$_GET['sort']?>&n=9999" class="btn btn-default <?=(@$_GET['n'] == '9999')? "active" : "" ;?>">ทั้งหมด</a>
</div>
	
<section id="oversea" class="clearfix">
<h2>LINE Theme ยอดนิยม</h2>
    <div class="row">
    <?php foreach($themes as $row):?>
      <div class="col-sm-3 col-md-2 col-xs-4" style="margin-top:10px; position: relative;">
        <a href="theme/<?php echo $row->slug?>" target="_blank" alt="<?php echo $row->title?>">
        <div class="thumbnail">
          <img src="<?php echo $row->cover?>" alt="<?php echo $row->title?>">
          <div class="caption">
            <h3><?php echo $row->title?></h3>
                <div class="awesome small yellow">Theme</div> <div class="awesome small blue">90.-</div>
            <br clear="all">
          </div>
        </div>
        </a>
        <?=(datediff(datetime2date($row->created)) >= -7)?'<img src="themes/line/images/new.png" style="position: absolute; right: 15px; top: 0;" alt="ใหม่">':'';?>
      </div>
    <?php endforeach;?>
    </div>

</section>

	<?=($_GET['sort'] != 'hot') ? $themes->pagination() : $pagination ;?>
	
<div style="margin:10px 0 0 0">
<div class="btn-group">
  <a href="sticker/themes?sort=new&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'new')? "active" : "" ;?>">ใหม่</a>
  <a href="sticker/themes?sort=hot&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'hot')? "active" : "" ;?>">ยอดนิยม</a>
  <a href="sticker/themes?sort=rand&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'rand')? "active" : "" ;?>">สุ่ม</a>
</div>

<div class="btn-group">
  <a href="sticker/themes?sort=<?=@$_GET['sort']?>&n=30" class="btn btn-default <?=(@$_GET['n'] == '30')? "active" : "" ;?>">30</a>
  <a href="sticker/themes?sort=<?=@$_GET['sort']?>&n=90" class="btn btn-default <?=(@$_GET['n'] == '90')? "active" : "" ;?>">90</a>
  <a href="sticker/themes?sort=<?=@$_GET['sort']?>&n=9999" class="btn btn-default <?=(@$_GET['n'] == '9999')? "active" : "" ;?>">ทั้งหมด</a>
</div>
</div>

</div>