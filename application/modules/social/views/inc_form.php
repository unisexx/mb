<form id="frm-post" action="social/save" method="post" enctype="multipart/form-data">
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
          <span class="input-group-addon"><?php echo $app?></span>
          <input type="text" name="social_<?php echo $app; ?>" class="form-control" placeholder="<?php echo ucfirst($app)?> ID" value="">
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
  
  	<img src="users/captcha" />
  	<div class="input-group">
	  <span class="input-group-addon">captcha</span>
        <input type="text" class="form-control" name="captcha" id="inputCaptcha" placeholder="กรอกรหัสลับ">
	</div>
	
	<div style="text-align: center; margin-top: 10px;">
	<button type="submit" class="btn btn-primary">ส่งข้อมูลใหม่</button>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">แก้ไขข้อมูลเดิมที่เคยลงไว้</button>
	</div>
</form>