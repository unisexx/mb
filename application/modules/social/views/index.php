<div id="main">
    <div class="container">
    
	<div class="row">
		<div id="topfriend" class="col-md-8 col-xs-12">
		<?php include_once('_topfriend.php'); ?>
	  	</div>
	  	
	  	<div id="post" class="col-md-4 col-xs-12">
	  	<?php echo modules::run('social/inc_form'); ?>
	  	</div>
	</div>
	
    </div><!-- /.container -->
</div>


<div id="social">
	<div class="container social clearfix">
	    <?php foreach($apps as $app):?>
	        <a href="<?php echo strtolower($app); ?>" <?php echo ($social == $app)?'class="selected"':'';?> title="<?php echo $app?>"><img src="media/icons/<?php echo $app?>.png" /></a>
	    <?php endforeach;?>
	</div>
</div>
<div style="clear: both;"></div>


<div id="listfriend">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-xs-12">
			    <h2>เพื่อนที่อัพเดทข้อมูลล่าสุด</h2>
			    
			    <form id="search-friends" class="form-inline" role="form">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-lg-3">
                        <?=form_dropdown('sex_id',get_option('id','title','sexs order by id asc'),@$_GET['sex_id'],'id="sex" class="form-control"','- ทุกเพศ -');?>
                        </div>
                        <div class="row col-xs-6 col-sm-6 col-lg-3">
                        <?=form_dropdown('province_id',get_option('id','name','provinces order by name asc'),@$_GET['province_id'],'id="province" class="form-control"','- ทุกจังหวัด -');?>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-lg-3">
                        <?=form_dropdown('image',array('image'=>'มีรูป','noimage'=>'ไม่มีรูป'),@$_GET['image'],'class="form-control"','- ทั้งหมด -');?>
                        </div>
                        <div class="row col-xs-6 col-sm-6 col-lg-3">
                        <?=form_dropdown('app_id',get_option('id','title','apps where status="approve" order by orderlist asc'),@$_GET['app_id'],'id="apps" class="form-control"',false);?>
                        </div>
                    </div>
                </form>
			    
				<ul id="list-row" class="list-unstyled">
					<?php foreach($users as $item): ?>
					<li style="position: relative;">
					    <a class="notice" href="#" rel="tooltip" data-title="แจ้งลบ" data-toggle="modal" data-target="#myModal-notice" style="position: absolute; top: 0; right:5px; color:#ccc;"><i class="fa fa-times"></i></a>
					    <?php if(user_login()->level_id == 1):?>					    	
					        <a href="social/delete/<?php echo $item->id?>" class="delete-user" data-title="ลบ" style="position: absolute; top: 0; right:25px;"><i class="fa fa-trash-o"></i></a>
					        <a href="social/hide/<?php echo $item->id?>" style="position: absolute; top: 0; right:45px;"><i class="fa fa-times-circle"></i>ซ่อนยูสเชอร์นี้</a>
					    <?php endif;?>
						<div class="col-md-3" style="text-align: center">
							<?php 
							if(is_file('uploads/user/'.$item->image)){
								echo anchor(strtolower($item->title).'/'.$item->id, img(array('src' => 'uploads/user/'.$item->image, 'width' => 120, 'height' => 120)));
                                // echo "<a href='".strtolower($social)."/".$item->id."' title=".$item->name.">".thumb('uploads/user/'.$item->image,120,120,1)."</a>";
							}
							else {
								echo anchor(strtolower($social).'/'.$item->id, img(array('src' => 'media/images/sex-'.$item->sex_id.'.png', 'width' => 120, 'height' => 120)));
							}
							?>
						</div>
						<div class="col-md-9">
							<h3><?php echo badWordFilter(anchor(strtolower($social).'/'.$item->id, $item->name)); ?></h3>
							<span class="label label-green"><?php echo $item->age; ?></span> 
							<span class="label" style="background: <?php echo $item->sex_color?>"><?php echo $item->sex_title; ?></span> 
							<span class="label label-warning"><?php echo $item->province_name?></span>
							<?php if($item->game_cookierun == 1): ?>
							<span class="label" style="background: #F35E4A; margin-left: 4px">Cookie Run</span>
							<?php endif; ?>
							<span class="pull-right">
							    <div class="btn-group" rel="tooltip" data-title="แจ่ม" >
							        <a class="btn btn-primary 
							        <?php 
							             $jam = new Jam();
                                         $jam->where('ip',$_SERVER['REMOTE_ADDR'])->where('user_id',$item->id)->get();
                                         if($jam->exists()){echo 'btn-danger';}
							        ?> btn-xs btn-jam"><i class="fa fa-heart"></i> </a>
							        <a class="btn btn-default btn-xs jam-counter" rel="<?php echo $item->id; ?>"><?php echo number_format($item->vote);?></a>
							        <input type="hidden" name="user_id" value="<?php echo $item->id?>">
							    </div>
							</span>
							<hr style="margin:5px 0;" />
							<p><?php echo badWordFilter($item->detail); ?></p>
							<div class="row">
							<div class="social-data col-md-5">
							<?php //foreach($item->user_app as $user_app): ?>
								<?php //if(!empty($user_app->social_data) and $user_app->app_id == $app->id): ?>
								<div class="input-group">
								  <span class="input-group-addon"><?php echo $social?></span>
								  <input type="text" class="form-control" value="<?php echo $item->{'social_'.$social}; ?>">
								</div>
								<?php //endif; ?>
							<?php //endforeach; ?>
							</div>
							</div>
						</div>
						<div style="clear: both;"></div>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php echo $pagination; ?>
			</div>
			<div class="col-md-4 col-xs-12">
				<?php echo modules::run('social/sidebar'); ?>
			</div>
		</div>
	</div>
</div>


<!-- Modal Notice -->
<div class="modal fade" id="myModal-notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">แจ้งลบ</h4>
      </div>
      <div class="modal-body" style="padding:20px;">
        
        <!------- Modal Body ------->
        <div class="list-img thumbnail"></div>
        <h1 class="list-name" style="text-align: center;"></h1>
        <br clear="all">
        
        <form method="post" action="social/notice_save" enctype="multipart/form-data">
        <div class="radio">
		  <label>
		    <input type="radio" name="notice" value="ข้อมูลติดต่อไม่ถูกต้อง" checked="checked"> ข้อมูลติดต่อไม่ถูกต้อง
		  </label>
		</div>
        <div class="radio">
		  <label>
		    <input type="radio" name="notice" value="รูปหรือข้อความไม่เหมาะสม"> รูปหรือข้อความไม่เหมาะสม
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="notice" value="โฆษณา"> โฆษณา
		  </label>
		</div>
		<div class="radio">
		  <label>
		    <input type="radio" name="notice" value="ข้อมูลซ้ำ"> ข้อมูลซ้ำซ้อน
		  </label>
		</div>
		รายละเอียดเพิ่มเติม
		<textarea class="form-control" name="detail" rows="3"></textarea>
		<br>
		<input id='u_id' type="hidden" name="user_id" value="">
		<button type="submit" class="btn btn-primary pull-right">ส่งข้อมูล</button>
		</form>
        <br clear="all">
        <!------- Modal Body ------->
        
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$(document).ready(function(){
    $('.notice').click(function(){
        var ele = $(this).closest('li');
        var user_id = ele.find('input[name=user_id]').val();
        var name = ele.find('h3').text();
        var image = ele.find('img').clone();
        
        $('#u_id').val(user_id);
        $('h1.list-name').text(name);
        $('.list-img').html(image);
        
        $('.delete-user').click(function(){
        	var link = $(this);
        	$.get(link.attr('href'), function(){
        		link.parent().hide();
        	});
        	return false;
        });
    });
    /*
    $('.jam-counter').each(function(i, index){
    	var link = $(this);
       	$.get('social/total/'+link.attr('rel'), function(total){
       		link.text(total)
       	});
    });
    */
});
</script>