<div class="col-6 col-sm-5 col-lg-4">
<form id="form_friend" role="form" method="post" action="friends/save" enctype="multipart/form-data">
  <div class="form-group">
    <label for="lineid">LINE ID</label>
    <input type="text" name="line_id" class="form-control" id="lineid" placeholder="ไอดีไลน์">
  </div>
  <div class="form-group">
    <label for="nickname">ชื่อเล่น</label>
    <input type="text" name="name" class="form-control" id="nickname" placeholder="ชื่อเล่น">
  </div>
  <div class="form-group">
      <label for="age">อายุ</label>
        <select name="age" id="age" class="form-control">
            <option value="">--- เลือกอายุ ---</option>
            <?php for ($x=12; $x<=60; $x++):?>
            <option value="<?php echo $x?>"><?php echo $x?></option>
            <?php endfor;?>
        </select>
  </div>
  <div class="form-group">
      <label for="sex">เพศ</label>
            <?=form_dropdown('sex_id',get_option('id','title','sexs order by id asc'),'','id="sex" class="form-control"','--- เลือกเพศ ---');?>
  </div>
  <div class="form-group">
      <label for="province">จังหวัด</label>
        <?=form_dropdown('province_id',get_option('id','name','provinces order by name asc'),'','id="province" class="form-control"','--- เลือกจังหวัด ---');?>
  </div>
  <div class="form-group">
    <label for="detail">แนะนำตัว</label>
    <textarea name="detail" id="detail" class="form-control" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="image">รูปภาพ</label>
    <input type="file" name="image" id="image">
    <!-- <p class="help-block">Example block-level help text here.</p> -->
  </div>
  <div class="form-group">
        <img src="users/captcha" /><Br>
        <input type="text" class="input-small" name="captcha" id="inputCaptcha" placeholder="กรอกรหัสลับ">
    </div>
  <button type="submit" class="btn btn-default btn-primary">ส่งข้อมูล</button>
</form>
</div>