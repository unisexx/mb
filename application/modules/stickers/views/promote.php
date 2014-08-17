<style type="text/css">
.credit-title{margin:0px; height: 20px; overflow: hidden;}
.list-group-item-text{color:#f01;}
</style>
<div class="col-md-4 col-md-offset-1">
  	<div class="list-group hidden-sm hidden-xs">
  		<img class="img-responsive clearfix" src="themes/line/images/creator_banner2.png">
  	<?foreach($paids as $sticker):?>
  		<a href="sticker/<?php echo $sticker->slug?>" class="list-group-item clearfix">
	      	<div style="float: left; width: 64px; margin-right: 8px;">
	      		<img class="img-responsive" src="<?php echo $sticker->cover?>" alt="สติ๊กเกอร์ไลน์ <?php echo $sticker->title?>">
	      	</div>
	      	<p class="credit-title"><?=@$sticker->title_credit?></p>
	        <h4 class="list-group-item-heading"><?php echo $sticker->title?></h4>
	        <p class="list-group-item-text">30บาท</p>
		</a>
  	<?endforeach;?>
  		<a href="http://www.line2me.in.th/pages/view/8" target="_blank" class="list-group-item clearfix active">
	        <h4 class="list-group-item-heading">โปรโมทสติ๊กเกอร์ไลน์ของคุณตำแหน่งนี้คลิก</h4>
		</a>
    </div>
    
    <div class="row hidden-md hidden-lg">
    <?php $nation_color = array('creator'=>'brown','global'=>'black','taiwan'=>'green','brazil'=>'green','indonesia'=>'yellow','malaysia'=>'yellow','japan'=>'red','korea'=>'brown','spain'=>'magenta','india'=>'yellow','us'=>'magenta','china'=>'red','???'=>'???');?>
    <img class="img-responsive clearfix" src="themes/line/images/creator_banner2.png">
    <?php foreach($paids as $sticker):?>
      <div class="col-sm-4 col-md-4 col-xs-4" style="margin-top:10px; position: relative;">
          <a href="sticker/<?php echo $sticker->slug?>" alt="<?php echo $sticker->title?>">
        <div class="thumbnail">
          <img src="<?php echo $sticker->cover?>" alt="<?php echo $sticker->title?>">
          <div class="caption">
            <h3><?php echo $sticker->title?></h3>
                <div class="awesome small <?php echo $nation_color[$sticker->category]?>"><?php echo ucfirst($sticker->category)?></div> <div class="awesome small blue">30.-</div>
            <br clear="all">
          </div>
        </div>
        </a>
        <?=(datediff(datetime2date($sticker->created)) >= -7)?'<img src="themes/line/images/new.png" style="position: absolute; right: 15px; top: 0;" alt="ใหม่">':'';?>
      </div>
    <?php endforeach;?>
    <br clear="all"><br>
    <a href="http://www.line2me.in.th/pages/view/8" target="_blank"><div class="alert alert-info" role="alert">โปรโมทสติ๊กเกอร์ไลน์ของคุณตำแหน่งนี้คลิก</div></a>
    </div>
</div>