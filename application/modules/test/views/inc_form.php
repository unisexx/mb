<style>
#frm-post .input-group-addon,#frm-edit-login .input-group-addon{
    min-width:90px;
    text-align:left;
}
#frm-post .input-group,#frm-edit-login .input-group{
    margin-bottom:3px;
}
#frm-post textarea,#frm-post input[type=file]{
    border: 1px solid #ccc;
    border-radius: 0 4px 4px 0;
    width:100%;
    background: #fff;
}
#frm-post legend{
    margin-bottom:5px;
}
</style>
<form id="frm-post" action="test/save" method="post" enctype="multipart/form-data">
	<fieldset>
	  <legend>อยากมีเพื่อนเพิ่มข้อมูลเลยจ้า ^^</legend>
	  
        <div class="input-group">
          <span class="input-group-addon">รูปภาพ</span>
            <input type="file" name="image" id="image">
        </div>
	  
	  	<div class="input-group">
		  <span class="input-group-addon">ชื่อ</span>
		  <input type="text" class="form-control" placeholder="ชื่อ" name="name">
		</div>
	  
	  	<div class="input-group">
		  <span class="input-group-addon">อายุ</span>
			<select class="form-control" name="age">
			  <?php for($i=12;$i<=75;$i++): ?>
			  	<option value="<?php echo $i?>"><?php echo $i?></option>
			  <?php endfor?>
			</select>
		</div>
		
	  	<div class="input-group">
		  <span class="input-group-addon">เพศ</span>
			<?=form_dropdown('sex_id',get_option('id','title','sexs order by id asc'),'','id="sex" class="form-control"');?>
		</div>
	  
	  	<div class="input-group">
		  <span class="input-group-addon">จังหวัด</span>
			<?=form_dropdown('province_id',get_option('id','name','provinces order by name asc'),'','id="province" class="form-control"');?>
		</div>
	  
	  	<div class="input-group">
		  <span class="input-group-addon">แนะนำตัว</span>
			<textarea name="detail" rows="3"></textarea>
		</div>
		
		<?php foreach($apps as $app):?>
        <div class="input-group">
          <span class="input-group-addon"><?php echo $app->title?></span>
          <input type="text" name="social_data[]" class="form-control" placeholder="<?php echo $app->placeholder?>" value="">
          <input type="hidden" name="app_id[]" value="<?php echo $app->id?>">
          <input type="hidden" name="user_app_id[]" value="<?php echo @$user_app->id?>">
        </div>
        <?php endforeach;?>
	</fieldset>
	
	<fieldset>
	  <legend>ตั้งรหัสผ่านสำหรับแก้ไขข้อมูล</legend>
	  	<div class="input-group">
		  <span class="input-group-addon">Email</span>
			<input type="text" class="form-control" placeholder="Email" name="email" value="">
		</div>
	  
	  
	  	<div class="input-group">
		  <span class="input-group-addon">Password</span>
	          <input id="password" type="text" class="form-control" placeholder="Password" name="password">
		</div>
		
		<div class="input-group">
          <span class="input-group-addon">Password</span>
          <input type="password" class="form-control" placeholder="Re-Password" name="_password">
        </div>
	</fieldset>
  
  	<!-- <img src="users/captcha" />
  	<div class="input-group">
	  <span class="input-group-addon">captcha</span>
        <input type="text" class="form-control" name="captcha" id="inputCaptcha" placeholder="กรอกรหัสลับ">
	</div> -->
	
	<div style="text-align: center; margin-top: 10px;">
	<button type="submit" class="btn btn-primary">ส่งข้อมูลใหม่</button>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">แก้ไขข้อมูลเดิมที่เคยลงไว้</button>
	</div>
</form>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="test/login" id="frm-edit-login" class="form-horizontal" role="form">
          
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">แก้ไขข้อมูล</h4>
      </div>
      <div class="modal-body" style="padding:20px;">
          
       
      <div class="input-group">
          <span class="input-group-addon">อีเมล์</span>
          <input type="text" class="form-control" placeholder="Email" name="email">
      </div>
      
      <div class="input-group">
          <span class="input-group-addon">รหัสผ่าน</span>
          <input type="password" class="form-control" placeholder="Password" name="password">
      </div>
      
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">ยืนยัน</button>
          <a href="users/forget_pass" class="btn btn-danger">ลืมรหัสผ่าน</a>
          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">close</button> -->
      </div>
      
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->