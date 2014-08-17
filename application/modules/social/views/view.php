<style type="text/css" media="screen">
	.profile-header{
    text-align:center; 
    background: url('themes/addfriend/img/social-bg.png') center; 
    color: #fff; 
    padding-top:10px;
}
.list-img.thumbnail {margin: 0 auto; width: 120px;}
	.social-data{padding:10px 0;}
	<?php if($this->agent->is_mobile()) echo '.list-box-msg img {width: 100%;}'; else echo '.img-responsive {display: inline;}' ?>
.list-box-title {padding: 5px; border-bottom: 1px dotted #ccc;}
.list-box-msg {padding: 10px 5px; text-align: center;}
.list-box-thumbnail {float: left; width: 65px;}
.list-box-info {float: left; display: inline; margin-left: 0px;}
.list-box-name {font-weight: bold; color: #164D76;}
.list-box-time {font-size: 11px; color: #888;}
.user-detail {padding: 0 10px;}
.comment {background: #fff; padding: 5px 0 5px 15px;}
.comment .form-group {margin: 10px 0px 10px 0;}
</style>


		    <!-- <h2>เพื่อนที่อัพเดทข้อมูลล่าสุด</h2> -->
			<div class="profile-header" style="margin-top: 21px;">
        <div class="list-img thumbnail">
            <?php 
            if(is_file('uploads/user/'.$row->image)){
                echo img(array('src' => 'uploads/user/'.$row->image, 'width' => 120, 'height' => 120));
                // echo thumb('uploads/user/'.$row->image,120,120,1);    
            }
            else {
                echo img(array('src' => 'media/images/sex-'.$row->sex_id.'.png', 'width' => 120, 'height' => 120)); 
            }
            ?>
        </div>
        <div class="list-detail" >
            <h1 class="list-name"><?php echo $row->name; ?></h1>
            <div class="user-detail"><?php echo badWordFilter($row->detail); ?></div>
            <div><?php echo ucfirst($social)?> ID : <?php echo $row->{'social_'.$social}; ?></div>
            <span class="label label-success"><?php echo $row->age; ?></span>
            <span class="label" style="background: <?php echo $row->sex->color?>"><?php echo $row->sex->title; ?></span>
            <span class="label label-warning"><?php echo $row->province->name?></span>
            <?php if(is_login() && user_login()->level_id == 1): ?>
		    	<div style="margin-top: 5px;">
		    		<a href="social/delete_all_img/<?php echo $row->id; ?>" class="btn btn-danger btn-sm" rel="del"><span class="glyphicon glyphicon-picture"></span></a>
		    		<a href="social/hide/<?php echo $row->id; ?>" class="btn btn-danger btn-sm" rel="del"><span class="glyphicon glyphicon-eye-close"></span></a>
		    	</div>
		    <?php endif; ?>
        </div>
        
        <br style="clear: both;" />
    </div>
    
    <?php if(is_file('uploads/user/big/'.$row->image)): ?>
    <ul id="list-row" class="list-unstyled">
			<?php //foreach($posts as $item): ?>
			<li style="position: relative;" rel="img-<?php echo $row->id; ?>">
				<div class="list-box-title">
					<div class="row">
					<div class="col-md-1">
		                <?php 
		                if(is_file('uploads/user/'.$row->image)){
		                    echo img(array('src' => 'uploads/user/'.$row->image, 'width' => 50, 'height' => 50));   
                            // echo thumb('uploads/user/'.$row->image,50,50,1);   
		                }
		                else {
		                    echo img(array('src' => 'media/images/sex-'.$row->sex_id.'.png', 'width' => 50, 'height' => 50)); 
		                }
		                ?>
		            </div>
		            <div class="col-md-8">
		            	<div>
		            		<span class="list-box-name"><?php echo $row->name; ?></span>
		            	</div>
		            	<div class="list-box-time"><?php echo $row->updated; ?></div>
		            </div>
		            <div class="col-md-3 text-right">
		            	<?php if(is_login() && user_login()->level_id == 1): ?>
		            	<a href="javascript:removeImg(<?php echo $row->id; ?>)" class="btn btn-danger btn-sm" rel="del"><span class="glyphicon glyphicon-trash"></span></a>
		            	<?php endif; ?>
		            </div>
		            </div>
		            <div style="clear: both;"></div>
				</div>
				
				<div class="list-box-msg"><?php echo img(array('src' => 'uploads/user/big/'.$row->image, 'class' => 'img-responsive')); ?></div>
			</li>
			<?php //endforeach; ?>
		</ul>	
    	<?php endif; ?>
    	
        <!--
    	<?php if(user_login()->id === $row->id): ?>
			<div class="btn-group btn-group-justified" style="margin-top: 8px;">
				<a class="btn btn-success" role="button"><span class="glyphicon glyphicon-pencil"></span> แก้ไขข้อมูลส่วนตัว</a>
				<a class="btn btn-info" role="button"><span class="glyphicon glyphicon-picture"></span> เพิ่มรูป</a>
			</div>
		<?php elseif(is_login()): ?>
			<div class="comment">
			<div class="row">
				<div class="col-md-1">
				<?php 
                if(is_file('uploads/user/'.user_login()->image)){
                    // echo img(array('src' => 'uploads/user/'.user_login()->image, 'width' => 50, 'height' => 50)); 
                    // echo thumb('uploads/user/'.user_login()->image,50,50,1);   
                }
                else {
                    echo img(array('src' => 'media/images/sex-'.user_login()->sex_id.'.png', 'width' => 50, 'height' => 50)); 
                }
                ?>
                </div>
                <div class="col-md-11">
                	<form class="form-horizontal" role="form">
						<div class="form-group col-xs-8">
							<input type="text" name="comment" class="form-control" />
						</div>
					</form>
				</div>
			</div>
			</div>
		<?php endif; ?>
		-->
		<?php /*
		<ul id="list-row" class="list-unstyled">
			<?php foreach($posts as $item): ?>
			<li style="position: relative;" rel="img-<?php echo $item->id; ?>">
				<div class="list-box-title">
					<div class="row">
					<div class="col-md-1">
		                <?php 
		                if(is_file('uploads/user/'.$row->image)){
		                    // echo img(array('src' => 'uploads/user/'.$row->image, 'width' => 50, 'height' => 50));   
                            // echo thumb('uploads/user/'.$row->image,50,50,1);   
		                }
		                else {
		                    echo img(array('src' => 'media/images/sex-'.$row->sex_id.'.png', 'width' => 50, 'height' => 50)); 
		                }
		                ?>
		            </div>
		            <div class="col-md-8">
		            	<div>
		            		<span class="list-box-name"><?php echo $row->name; ?></span>
		            	</div>
		            	<div class="list-box-time"><?php echo $item->created; ?></div>
		            </div>
		            <div class="col-md-3 text-right">
		            	<?php if(is_login() && user_login()->level_id == 1): ?>
		            	<a href="javascript:removeImg(<?php echo $item->id; ?>)" class="btn btn-danger btn-sm" rel="del"><span class="glyphicon glyphicon-trash"></span></a>
		            	<?php endif; ?>
		            </div>
		            </div>
		            <div style="clear: both;"></div>
				</div>
				
				<div class="list-box-msg"><?php echo $item->msg; ?></div>
			</li>
			<?php endforeach; ?>
		</ul>	
		 * 
		 */?>
				
			
<script>
	$(function(){
		
	});
	function removeImg(id) {
		if(confirm('Do you want to delete image?')) {
			var img = $('#list-row div.list-box-msg img').attr('src').replace(/^.*[\\\/]/, '');
			$.post('social/delete_img', {id:id, img:img}, function(){
				$('#list-row').find('li[rel=img-'+id+']').hide();
			});
		}
		return false;
	}
</script>