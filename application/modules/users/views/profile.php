<form id="profile" role="form" method="post" action="users/profile_save" enctype="multipart/form-data">
<div class="row">
	
<div class="col-md-12">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="users/profile">ข้อมูลส่วนตัว</a></li>
	  <li><a href="users/social">ข้อมูลติดต่อ Social</a></li>
	</ul><br>
	<div class="alert alert-info">
      <i class="fa fa-exclamation-circle"></i> บันทึกข้อมูลส่วนตัวแล้วอย่าลืมไปเพิ่มข้อมูลติดต่อ social ด้วยนะครับ มิเช่นนั้นรายชื่อจะไม่แสดงที่หน้าแรกครับผม<br>
      <!-- <i class="fa fa-exclamation-circle"></i> การกดปุ่มอัพเดทข้อมูลที่หน้านี้จะทำให้รายชื่อของเราถูกดันขึ้นไปอยู่บนสุด -->
    </div>
</div>
	
<div class="col-md-6">
  <div class="form-group">
    <?php if($user->image):?>
        <?php // echo thumb('uploads/user/'.$user->image,120,120,1);?>
        <img src="uploads/user/<?=$user->image?>" width="120" height="120">
        <br clear="all">
    <?php endif;?>
    <label for="image">รูปภาพ</label>
    <input type="file" name="image" id="image">
  </div>
  <div class="form-group">
    <label for="nickname">ชื่อเล่น</label>
    <input type="text" name="name" class="form-control" id="nickname" placeholder="ชื่อเล่น" value="<?php echo $user->name?>">
  </div>
  <div class="form-group">
    <label for="birth_date">วันเกิด <i>ตัวอย่าง (24/08/2527)</i></label>
    <input type="text" name="birth_date" class="form-control" id="birth_date" value="<?php echo DB2Date(($user->birth_date)?$user->birth_date:date("Y-m-d"))?>">
  </div>
  <div class="form-group">
      <label for="sex">เพศ</label>
            <?=form_dropdown('sex_id',get_option('id','title','sexs order by id asc'),@$user->sex_id,'id="sex" class="form-control"',FALSE);?>
  </div>
  <div class="form-group">
      <label for="province">จังหวัด</label>
        <?=form_dropdown('province_id',get_option('id','name','provinces order by name asc'),@$user->province_id,'id="province" class="form-control"',FALSE);?>
  </div>
  <div class="form-group">
    <label for="detail">แนะนำตัว</label>
    <textarea name="detail" id="detail" class="form-control" rows="5"><?php echo $user->detail?></textarea>
  </div>
  
  <!-- <hr>
  	<h3>ข้อมูลติดต่อ Social</h3>
	<?php foreach($apps as $row):?>
		<?php 
			$user_app = new User_app();
			$user_app->where('user_id = '.$this->session->userdata('id').' and app_id = '.$row->id)->get(1);
		?>
	<div class="form-group">
		<label for="<?php echo $row->title?>"><?php echo $row->title?></label>
	    <input type="text" name="social_data[]" class="form-control" id="<?php echo $row->title?>" placeholder="<?php echo $row->title?>" value="<?php echo $user_app->social_data?>">
	    <input type="hidden" name="app_id[]" value="<?php echo $row->id?>">
	    <input type="hidden" name="user_app_id[]" value="<?php echo $user_app->id?>">
	</div>
	<?php endforeach;?> -->
	<div class="form-group">
        <img src="users/captcha" /><Br>
        <input type="text" class="input-small" name="captcha" id="inputCaptcha" placeholder="กรอกรหัสลับ">
    </div>
  <button type="submit" class="btn btn-default btn-primary">อัพเดทข้อมูล</button>
</div>
</div>
</form>