<div id="main">
    <div class="container">
    
	<div class="row">
		<div id="topfriend" class="col-md-8 col-xs-12">
		<?php include_once('_topfriend.php'); ?>
	  	</div>
	  	
	  	<div id="post" class="col-md-4 col-xs-12">
	  	<?php echo modules::run('test/inc_form'); ?>
	  	</div>
	</div>
	
    </div><!-- /.container -->
</div>

<div id="s-wrapper">
<div id="social">
	<div class="container social clearfix">
	    <?php foreach($apps as $row):?>
	        <a href="test?app_id=<?php echo $row->id?>" <?php echo ($row->id == $app->id)?'class="selected"':'';?> title="<?php echo $row->title?>"><img src="media/icons/<?php echo $row->icon?>" /></a>
	    <?php endforeach;?>
	</div>
</div>
<div style="clear: both;"></div>
</div><br clear="all">


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
					    <a href="#" rel="tooltip" data-title="แจ้งลบ" data-toggle="modal" data-target="#myModal-notice-<?php echo $item->id?>" style="position: absolute; top: 0; right:5px; color:#ccc;"><i class="fa fa-times"></i></a>
					    <?php if(user_login()->level_id == 1):?>
					        <a href="test/hide/<?php echo $item->id?>" style="position: absolute; top: 0; right:25px;"><i class="fa fa-times-circle"></i>ซ่อนยูสเชอร์นี้</a>
					    <?php endif;?>
						<div class="col-md-3" style="text-align: center">
							<?php 
							if(is_file('uploads/user/'.$item->image)){
								echo img(array('src' => 'uploads/user/'.$item->image, 'width' => 120, 'height' => 120)); 	
							}
							else {
								echo img(array('src' => 'media/images/sex-'.$item->sex_id.'.png', 'width' => 120, 'height' => 120)); 
							}
							?>
						</div>
						<div class="col-md-9">
							<h3><?php echo $item->name; ?></h3>
							<span class="label label-green"><?php echo $item->age; ?></span> 
							<span class="label" style="background: <?php echo $item->sex->color?>"><?php echo $item->sex->title; ?></span> 
							<span class="label label-warning"><?php echo $item->province->name?></span>
							<span class="pull-right">
							    <div class="btn-group" rel="tooltip" data-title="แจ่ม" >
							        <a class="btn btn-primary 
							        <?php 
							             $jam = new Jam();
                                         $jam->where('ip',$_SERVER['REMOTE_ADDR'])->where('user_id',$item->id)->get();
                                         if($jam->exists()){echo 'btn-danger';}
							        ?> btn-xs btn-jam"><i class="fa fa-heart"></i> </a>
							        <a class="btn btn-default btn-xs jam-counter"><?php echo $item->jam->count();?></a>
							        <input type="hidden" name="user_id" value="<?php echo $item->id?>">
							    </div>
							</span>
							<hr style="margin:5px 0;" />
							<p><?php echo badWordFilter($item->detail); ?></p>
							<div class="row">
							<div class="social-data col-md-5">
							<?php foreach($item->user_app as $user_app): ?>
								<?php if(!empty($user_app->social_data) and $user_app->app_id == $app->id): ?>
								<div class="input-group">
								  <span class="input-group-addon"><?php echo $app->placeholder?></span>
								  <input type="text" class="form-control" value="<?php echo $user_app->social_data; ?>">
								</div>
								<?php endif; ?>
							<?php endforeach; ?>
							</div>
							</div>
						</div>
						<div style="clear: both;"></div>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php echo $users->pagination(); ?>
			</div>
			<div class="col-md-4 col-xs-12">
			    <?php echo modules::run('stickers/inc_home'); ?><br>
                <div class="fb-like-box" data-href="https://www.facebook.com/pages/LINE-Thailand-Fanclub/619024168129948?ref=hl" data-width="100%" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
			</div>
		</div>
	</div>
</div>


<?php foreach($users as $item): ?>
<!-- Modal Notice -->
<div class="modal fade" id="myModal-notice-<?php echo $item->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">แจ้งลบ</h4>
      </div>
      <div class="modal-body" style="padding:20px;">
        
        <!------- Modal Body ------->
        <div class="list-img thumbnail">
            <?php 
            if(is_file('uploads/user/'.$item->image)){
                echo img(array('src' => 'uploads/user/'.$item->image, 'width' => 120, 'height' => 120));    
            }
            else {
                echo img(array('src' => 'media/images/sex-'.$item->sex_id.'.png', 'width' => 120, 'height' => 120)); 
            }
            ?>
            <h1 class="list-name" style="text-align: center;"><?php echo $item->name; ?></h1>
        </div>
        <br clear="all">
        
        <form method="post" action="test/notice_save" enctype="multipart/form-data">
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
		<input type="hidden" name="user_id" value="<?php echo $item->id?>">
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
<?php endforeach;?>