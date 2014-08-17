<form id="social" role="form" method="post" action="users/social_save" enctype="multipart/form-data">
<div class="row">
<div class="col-md-12">
	<ul class="nav nav-tabs">
	  <li><a href="users/profile">ข้อมูลส่วนตัว</a></li>
	  <li class="active"><a href="users/social">ข้อมูลติดต่อ Social</a></li>
	</ul>
  
  <br>
  <div class="alert alert-info">
    <i class="fa fa-exclamation-circle"></i> กรอกข้อมูลติดต่อ ทำการบันทึกก่อน แล้วค่อยเลือกแสดงสถานะครับ<br>
    <i class="fa fa-exclamation-circle"></i> ควรกรอกข้อมูลที่ติดต่อได้จริง มิเช่นนั้นจะไม่มีใครหาเราเจอแล้วจะเสียเครดิตจากคนอื่นๆด้วยครับ
  </div>
  
  <table class="table table-bordered table-responsive">
  	<tr>
		<th>สถานะ</th>
		<th>social</th>
		<th>ข้อมูลติดต่อ</th>  		
  	</tr>
  	<?php foreach($apps as $row):?>
  	    <?php 
            $user_app = new User_app();
            $user_app->where('user_id = '.$this->session->userdata('id').' and app_id = '.$row->id)->get(1);
        ?>
  	    <tr>
  	        <td><input type="checkbox" name="status" value="<?php echo $user_app->id ?>" <?php echo ($user_app->status=="approve")?'checked="checked"':'' ?> <?php echo (@$_POST['status']=="approve")?'':'' ?> /></td>
  	        <td><?php echo $row->title?></td>
  	        <td>
  	            <input type="text" name="social_data[]" class="form-control" id="<?php echo $row->title?>" value="<?php echo ($user_app->social_data == "")?$row->default_data:$user_app->social_data;?>">
                <input type="hidden" name="app_id[]" value="<?php echo $row->id?>">
                <input type="hidden" name="user_app_id[]" value="<?php echo $user_app->id?>">
  	        </td>
  	    </tr>
  	<?php endforeach;?>
  </table>
  
  <!-- <div class="form-group">
        <img src="users/captcha" /><Br>
        <input type="text" class="input-small" name="captcha" id="inputCaptcha" placeholder="กรอกรหัสลับ">
    </div> -->
  <button type="submit" class="btn btn-default btn-primary">บันทึกข้อมูล</button>
  
</div>
</div>
</form>