<style>
@media screen and (max-width: 568px) {
    body #post {margin-left:0px;}
}
#post {margin-left:15px;}
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
#main{background:#fff;}
</style>
<div id="main">
<div class="container">
<div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="alert alert-info"><i class="fa fa-exclamation-circle"></i> การอัพเดทข้อมูล หรือถูกกดแจ่ม (ด้วยตัวเองหรือจากบุคคลอื่น) จะทำให้รายชื่อของท่านถูกดันขึ้นไปตำแหน่งบนสุด</div>
        <div class="alert alert-info"><i class="fa fa-exclamation-circle"></i> ถ้าจำนวนแจ่มของท่านมีมากชื่อของท่านจะถูกจัดอันดับขึ้นมาแสดงใน Top Friends</div>
    </div>
    <br clear="all">
    <div id="post" class="col-md-4 col-xs-12">
        <form id="frm-post" action="test/save" method="post" enctype="multipart/form-data">
            <fieldset>
              <legend>เพิ่มข้อมูลของท่าน</legend>
              
                <?php if($user->image):?>
                    <?php // echo thumb('uploads/user/'.$user->image,120,120,1);?>
                    <img src="uploads/user/<?=$user->image?>" width="120" height="120">
                    <br clear="all">
                <?php endif;?>
                <div class="input-group">
                  <span class="input-group-addon">รูปภาพ</span>
                    <input type="file" name="image" id="image">
                </div>
              
                <div class="input-group">
                  <span class="input-group-addon">ชื่อ</span>
                  <input type="text" class="form-control" placeholder="ชื่อ" name="name" value="<?php echo $user->name?>">
                </div>
              
                <div class="input-group">
                  <span class="input-group-addon">อายุ</span>
                    <select class="form-control" name="age">
                      <?php for($i=12;$i<=75;$i++): ?>
                        <option value="<?php echo $i?>" <?php echo ($i == @$user->age)?'selected':'';?>><?php echo $i?></option>
                      <?php endfor?>
                    </select>
                </div>
                
                <div class="input-group">
                  <span class="input-group-addon">เพศ</span>
                    <?=form_dropdown('sex_id',get_option('id','title','sexs order by id asc'),@$user->sex_id,'id="sex" class="form-control"');?>
                </div>
              
                <div class="input-group">
                  <span class="input-group-addon">จังหวัด</span>
                    <?=form_dropdown('province_id',get_option('id','name','provinces order by name asc'),@$user->province_id,'id="province" class="form-control"');?>
                </div>
              
                <div class="input-group">
                  <span class="input-group-addon">แนะนำตัว</span>
                    <textarea name="detail" rows="3"><?php echo $user->detail?></textarea>
                </div>
                
                <?php foreach($apps as $app):?>
                    <?php 
                        $user_app = new User_app();
                        $user_app->where('user_id = '.$this->session->userdata('id').' and app_id = '.$app->id)->get(1);
                    ?>
                <div class="input-group">
                  <span class="input-group-addon"><?php echo $app->title?></span>
                  <input type="text" name="social_data[]" class="form-control" placeholder="<?php echo $app->placeholder?>" value="<?php echo @$user_app->social_data;?>">
                  <input type="hidden" name="app_id[]" value="<?php echo $app->id?>">
                  <input type="hidden" name="user_app_id[]" value="<?php echo @$user_app->id?>">
                </div>
                <?php endforeach;?>
            </fieldset>
            
            <!-- <fieldset>
              <legend>รหัสผ่านสำหรับแก้ไขข้อมูล</legend>
                <div class="input-group">
                  <span class="input-group-addon">Email</span>
                    <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $user->email?>">
                </div>
              
                <div class="input-group">
                  <span class="input-group-addon">Password</span>
                      <input type="password" class="form-control" placeholder="Password" value="" name="password">
                </div>
                
                <div class="input-group">
                  <span class="input-group-addon">Password</span>
                  <input type="password" class="form-control" placeholder="Re-Password" name="_password">
                </div>
            </fieldset> -->
          
            <!-- <img src="users/captcha" />
            <div class="input-group">
              <span class="input-group-addon">captcha</span>
                <input type="text" class="form-control" name="captcha" id="inputCaptcha" placeholder="กรอกรหัสลับ">
            </div> -->
            
            <div style="text-align: center; margin-top: 10px;">
            <button type="submit" class="btn btn-primary">อัพเดทข้อมูล</button>
            </div>
        </form>

        
        
    </div>
</div>
</div>
</div>