<?php $nation_color = array('creator'=>'brown','global'=>'black','taiwan'=>'green','brazil'=>'green','indonesia'=>'yellow','malaysia'=>'yellow','japan'=>'red','korea'=>'brown','spain'=>'magenta','india'=>'yellow','us'=>'magenta','china'=>'red','???'=>'???');?>

<div id="sticker">
	
<section id="creator" class="clearfix">

<?php echo modules::run('stickers/form_search'); ?>

<div class="btn-group">
  <a href="sticker/oversea?sort=new&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'new')? "active" : "" ;?>">ใหม่</a>
  <a href="sticker/oversea?sort=hot&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'hot')? "active" : "" ;?>">ยอดนิยม</a>
  <a href="sticker/oversea?sort=rand&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'rand')? "active" : "" ;?>">สุ่ม</a>
</div>

<div class="btn-group">
  <a href="sticker/oversea?sort=<?=@$_GET['sort']?>&n=30" class="btn btn-default <?=(@$_GET['n'] == '30')? "active" : "" ;?>">30</a>
  <a href="sticker/oversea?sort=<?=@$_GET['sort']?>&n=90" class="btn btn-default <?=(@$_GET['n'] == '90')? "active" : "" ;?>">90</a>
  <a href="sticker/oversea?sort=<?=@$_GET['sort']?>&n=9999" class="btn btn-default <?=(@$_GET['n'] == '9999')? "active" : "" ;?>">ทั้งหมด</a>
</div>
	
<section id="oversea" class="clearfix">
<h2>สติ๊กเกอร์ไลน์ต่างประเทศ</h2>
    <div class="row">
    <?php foreach($stickers_japan as $sticker):?>
      <div class="col-sm-3 col-md-2 col-xs-4" style="margin-top:10px; position: relative;">
          <a href="sticker/<?php echo $sticker->slug?>" target="_blank" alt="<?php echo $sticker->title?>">
        <div class="thumbnail">
          <img src="<?php echo $sticker->cover?>" alt="<?php echo $sticker->title?>">
          <div class="caption">
            <h3><?php echo $sticker->title?></h3>
                <div class="awesome small <?php echo $nation_color[$sticker->category]?>"><?php echo ucfirst($sticker->category)?></div> <div class="awesome small blue"><?php echo ($sticker->sticker_code == 1805 or $sticker->sticker_code == 1881)?'30':'60';?>.-</div>
            <br clear="all">
          </div>
        </div>
        </a>
        <?=(datediff(datetime2date($sticker->created)) >= -7)?'<img src="themes/line/images/new.png" style="position: absolute; right: 15px; top: 0;" alt="ใหม่">':'';?>
      </div>
    <?php endforeach;?>
    </div>

</section>

	<?=($_GET['sort'] != '') ? $stickers_japan->pagination() : $pagination ;?>
	
<div style="margin:10px 0 0 0">
<div class="btn-group">
  <a href="sticker/oversea?sort=new&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'new')? "active" : "" ;?>">ใหม่</a>
  <a href="sticker/oversea?sort=hot&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'hot')? "active" : "" ;?>">ยอดนิยม</a>
  <a href="sticker/oversea?sort=rand&n=<?=@$_GET['n']?>" type="button" class="btn btn-default <?=(@$_GET['sort'] == 'rand')? "active" : "" ;?>">สุ่ม</a>
</div>

<div class="btn-group">
  <a href="sticker/oversea?sort=<?=@$_GET['sort']?>&n=30" class="btn btn-default <?=(@$_GET['n'] == '30')? "active" : "" ;?>">30</a>
  <a href="sticker/oversea?sort=<?=@$_GET['sort']?>&n=90" class="btn btn-default <?=(@$_GET['n'] == '90')? "active" : "" ;?>">90</a>
  <a href="sticker/oversea?sort=<?=@$_GET['sort']?>&n=9999" class="btn btn-default <?=(@$_GET['n'] == '9999')? "active" : "" ;?>">ทั้งหมด</a>
</div>
</div>

</div>