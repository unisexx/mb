<style type="text/css">
/* text responsive */
@media screen and (max-width: 568px) {
   body{background:#FFFFFF !important;}
}

body{background:#FFFFFF !important;}
h1{font-size:18px; font-weight:bold; margin-top:0px !important;}
.price{
	font-size: 14px;
	font-weight: bold;
	color: #f01;
}
.expired{
	border-top: 1px solid #eee;
	padding-top: 11px;
	font-size: 14px;
	color: #969799;
	line-height: 22px;
	margin: 5px 0 10px;
}
.recommend{
	font-size: 12px;
color: #a8a8a8;
line-height: 20px;
margin: 3px 10px 0;
}
#sticker_view{
	border-top: 1px solid #eee;
	padding-top: 11px;
	margin-top: 11px;
}
.col-centered{
    float: none;
    margin: 0 auto;
}
.btn-success{background:#00C300 !important; border:1px solid #00C300 !important; margin-top:5px;}
</style>


	<div class="row">
		<!-- <div class="col-md-5 col-xs-12 col-centered"> -->
		<div class="col-md-7 col-sm-12 col-xs-12">
			<div class="row">
			    <div class="col-md-5 col-sm-5 col-xs-5">
					<img class="img-responsive" src="<?php echo $theme->cover?>" alt="ธีมไลน์ <?php echo $theme->title?>">
				</div>
				<div class="col-md-7 col-sm-7 col-xs-7">
					<h1><?php echo $theme->title?></h1>
					<div class="price">90บาท</div>
					<div class="expired">ไม่มีวันหมดอายุ</div>
					<a class="btn btn-success" href="http://line.me/ti/p/1x_iPQb1Rm" style="width: 90%;">แอดไอดีร้านค้า</a>
					<br clear="all">
				</div>
			</div>
			<div class="row">
				<div id="sticker_view" class="col-md-12 col-xs-12">
					<a href="http://line.me/ti/p/1x_iPQb1Rm">สนใจฝากซื้อธีมไลน์ชุดนี้แตะที่นี่เพื่อแอดไอดีไลน์ร้านค้าได้เลยครับ ให้เลือกเปิดด้วยแอพไลน์ (หรือแอดไอดีไลน์ ratasak)</a>
					<center style="margin-top: 10px;">
					<img class="img-responsive" src="<?php echo $theme->preview?>" alt="ธีมไลน์ <?php echo $theme->title?>" style="margin-bottom:10px;">
					</center>
				</div>
			</div>
		</div>
		
		<?php echo modules::run('stickers/promote'); ?>
		
	</div>