<style type="text/css">
/* text responsive */
@media screen and (max-width: 568px) {
   body{background:#FFFFFF !important;}
   h1{font-size:20px !important; font-weight:bold !important; margin-top:0px !important;}
   .price{font-size: 14px !important;}
}

body{background:#FFFFFF !important;}
h1{font-size:30px; font-weight:bold; margin-top:0px !important;}
h3{height:22px; overflow: hidden;}
/*h4{border-bottom:1px solid #eee;}*/
.price{
	font-size: 22px;
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
.wordwrap { 
   white-space: pre-wrap;      /* CSS3 */   
   white-space: -moz-pre-wrap; /* Firefox */    
   white-space: -pre-wrap;     /* Opera <7 */   
   white-space: -o-pre-wrap;   /* Opera 7 */    
   word-wrap: break-word;      /* IE */
}
.credit{color:#adafb2;font-size:12px;}
.credit-title{color:#333;font-size:12px;margin:0px;}
.btn-success{background:#00C300 !important; border:1px solid #00C300 !important; margin-top:5px;}
</style>


	<div class="row">
		<!-- <div class="col-md-7 col-sm-12 col-xs-12 col-centered" style="max-width: 595px;"> -->
		<div class="col-md-7 col-sm-12 col-xs-12">
			<div class="row">
			    <div class="col-md-5 col-sm-5 col-xs-5">
			    	<?php
						@$url=getimagesize("http://dl.stickershop.line.naver.jp/products/0/0/1/".$sticker->sticker_code."/LINEStorePC/main.png");
						if(!is_array($url)):
					?>
						<img class="img-responsive" src="<?php echo $sticker->cover?>" alt="สติ๊กเกอร์ไลน์ <?php echo $sticker->title?>">
					<?else:?>
						<img class="img-responsive" src="http://dl.stickershop.line.naver.jp/products/0/0/1/<?=$sticker->sticker_code?>/LINEStorePC/main.png" alt="สติ๊กเกอร์ไลน์ <?php echo $sticker->title?>">
					<?endif;?>
				</div>
				<div class="col-md-7 col-sm-7 col-xs-7">
					<p class="credit-title"><?=@$sticker->title_credit?></p>
					<h1 class="wordwrap"><?php echo $sticker->title?></h1>
					<div class="price">
					<?php
						if($sticker->sticker_code == 809){
			            echo 90;
				        }elseif($sticker->sticker_code > 999999  || $sticker->sticker_code == 1340 || $sticker->sticker_code == 1671 || $sticker->sticker_code == 1805 || $sticker->sticker_code == 1916 || $sticker->sticker_code == 2003 || $sticker->sticker_code == 2043 || $sticker->sticker_code == 2269 || $sticker->sticker_code == 2345 || $sticker->sticker_code == 2532){
				            echo 30;
				        }else{
				            echo 60;
				        }
						echo "บาท";
					?>
					<span style="margin-left:5px;">
<script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
<script type="text/javascript">
new media_line_me.LineButton({"pc":false,"lang":"en","type":"a"});
</script>
</span>
					</div>
					<div class="expired">ไม่มีวันหมดอายุ</div>
					<!-- <a class="btn btn-success" href="http://line.me/ti/p/B3xVEzyp6j">แอดไอดีร้านค้า</a> 
					<br clear="all"> -->
				</div>
				<div style="text-align: center;">
				<a class="btn btn-success" href="http://line.me/ti/p/B3xVEzyp6j" style="width: 90%;">แอดไอดีร้านค้า</a>
				</div>
			</div>
			<div class="row">
				<div id="sticker_view" class="col-md-12 col-xs-12">
					<a href="http://line.me/ti/p/B3xVEzyp6j">สนใจฝากซื้อสติ๊กเกอร์ไลน์ชุดนี้แตะที่นี่เพื่อแอดไอดีไลน์ร้านค้าได้เลยครับ ให้เลือกเปิดด้วยแอพไลน์ (หรือแอดไอดีไลน์ ratasak)</a>
					<center>
					<?php
						@$url=getimagesize("http://dl.stickershop.line.naver.jp/products/0/0/1/".$sticker->sticker_code."/LINEStorePC/preview.png");
						if(!is_array($url)):
					?>
						<img class="img-responsive" src="<?php echo $sticker->preview?>" alt="สติ๊กเกอร์ไลน์ <?php echo $sticker->title?>">
					<?else:?>
						<img class="img-responsive" src="http://dl.stickershop.line.naver.jp/products/0/0/1/<?=$sticker->sticker_code?>/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ <?php echo $sticker->title?>">
					<?endif;?>
					<p class="credit"><?=@$sticker->credit?></p>
					<div style="margin:5px 0 10px 0;"><a class="btn btn-default" href="sticker/view_rand">สุ่มดูสติ๊กเกอร์ไลน์ลายอื่น</a></div>
					</center>
				</div>
			</div>
		</div>
		
		<?php echo modules::run('stickers/promote'); ?>
        
	</div>