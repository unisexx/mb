<style type="text/css" media="screen">
	.profile-header{
    text-align:center; 
    background: url('themes/addfriend/img/social-bg.png') center; 
    color: #fff; 
    padding-top:10px;
}
.list-img.thumbnail {margin: 0 auto; width: 120px;}
	.social-data{padding:10px 0;}
	<?php if($this->agent->is_mobile()) echo '.list-box-msg img {width: 100%;}'; else echo '.img-responsive {display: inline;}'; ?>
.list-box-title {padding: 5px; border-bottom: 1px dotted #ccc;}
.list-box-msg {padding: 10px 5px;}
.list-box-thumbnail {float: left; width: 65px;}
.list-box-info {float: left; display: inline; margin-left: 0px;}
.list-box-name {font-weight: bold; color: #164D76;}
.list-box-time {font-size: 11px; color: #888;}
</style>
<div id="listfriend">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12">
        
				<?php /*
				<div class="btn-group btn-group-justified">
					<a class="btn btn-success" role="button"><span class="glyphicon glyphicon-pencil"></span> Write</a>
					<a class="btn btn-info" role="button"><span class="glyphicon glyphicon-picture"></span> Photo</a>
				</div>
				 * 
				 */ ?>
				
			<ul id="list-row" class="list-unstyled" style="margin-top: 67px;">
				<?php foreach($posts as $item): ?>
				<li style="position: relative;">
					<div class="list-box-title">
						<div class="list-box-thumbnail">
			                <?php 
			                if(is_file('uploads/user/'.$item->image)){
			                    echo anchor('line/'.$item->id, img(array('src' => 'uploads/user/'.$item->image, 'width' => 50, 'height' => 50)));    
			                }
			                else {
			                    echo anchor('line/'.$item->id, img(array('src' => 'media/images/sex-'.$item->sex_id.'.png', 'width' => 50, 'height' => 50))); 
			                }
			                ?>
			            </div>
			            <div class="list-box-info">
			            	<div>
			            		<span class="list-box-name"><?php echo $item->name; ?></span>
			            	</div>
			            	<div>
							  	<span class="label label-green"><?php echo $item->age; ?></span> 
								<span class="label" style="background: <?php echo $item->sex_color?>"><?php echo $item->sex_title; ?></span> 
								<span class="label label-warning"><?php echo $item->province_name?></span>
							</div>
			            	<div class="list-box-time"><?php echo $item->created; ?></div>
			            </div>
			            <div style="clear: both;"></div>
					</div>
					
					<div class="list-box-msg"><?php echo $item->msg; ?></div>
				</li>
				<?php endforeach; ?>
			</ul>	
			<?php echo $pagination; ?>	
			</div>
			<div class="col-md-4 col-xs-12">
			    <?php echo modules::run('stickers/inc_home'); ?><br>
                <div class="fb-like-box" data-href="https://www.facebook.com/pages/LINE-Thailand-Fanclub/619024168129948?ref=hl" data-width="100%" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
			</div>
		</div>
	</div>
</div>