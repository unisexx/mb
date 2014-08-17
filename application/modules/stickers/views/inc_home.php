<?php $nation_color = array('creator'=>'black','global'=>'black','taiwan'=>'green','brazil'=>'green','indonesia'=>'yellow','malaysia'=>'yellow','japan'=>'red','korea'=>'brown','spain'=>'magenta','india'=>'yellow','us'=>'magenta','china'=>'red','???'=>'???');?>

<section id="สติ๊กเกอร์มาใหม่" class="clearfix">
<h2>LINE Stickers อัพเดทใหม่ล่าสุด</h2>
    <div id="sticker" class="row">
    <?php foreach($stickers_update as $sticker):?>
      <div class="col-sm-12 col-md-6 col-xs-4" style="margin-top:10px;">
        <a href="sticker/<?php echo $sticker->slug?>" target="_blank" alt="<?php echo $sticker->title?>">
        <div class="thumbnail">
          <img src="<?php echo $sticker->cover?>" alt="<?php echo $sticker->title?>">
          <div class="caption">
            <h3><?php echo $sticker->title?></h3>
            <div class="awesome small <?php echo $nation_color[$sticker->category]?>"><?php echo ucfirst($sticker->category)?></div> <div class="awesome small blue"><?php echo ($sticker->sticker_code > 999999 || $sticker->sticker_code == 2345 || $sticker->sticker_code == 2532)?'30':'60';?>.-</div>
            <br clear="all">
          </div>
        </div>
        </a>
      </div>
    <?php endforeach;?>
    <br clear="all"><br>
    <center>
    	<a class="btn btn-primary btn-xs" href="http://line.me/ti/p/B3xVEzyp6j">แอดไอดีร้านค้า</a>
	    <a class="btn btn-primary btn-xs" href="sticker">ดูสติ๊กเกอร์ไลน์ทั้งหมด</a>
    </center>
    </div>
</section>