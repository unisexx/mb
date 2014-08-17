<style>
#repass .input-group-addon{
    min-width:110px;
    text-align:left;
}
</style>
<div id="main">
<div class="container">
	
<h1>ลืมรหัสผ่าน</h1>
<br>

<div class="row">
    <div id="post" class="col-md-4 col-xs-12">
        <form id="repass" class="form-horizontal" method="post" action="users/repass_save">
            
            <div class="input-group">
			  <span class="input-group-addon">รหัสผ่าน</span>
			  <input class="form-control" type="password" name="password" id="inputPass" placeholder="รหัสผ่าน">
			</div>
			
			<div class="input-group">
			  <span class="input-group-addon">ยืนยันรหัสผ่าน</span>
			  <input class="form-control" type="password" name="_password" id="re-inputPass" placeholder="ยืนยันรหัสผ่าน">
			</div>
			
            <div class="input-group">
			  <span class="input-group-addon">Captcha</span>
			  <img src="users/captcha" /><Br>
			  <input type="text" class="form-control" placeholder="กรอกรหัสที่เห็นในภาพ" name="captcha">
			</div>
			
			<div style="text-align: center; margin-top: 10px;">
			<input type="hidden" name="auth_key" value="<?=$user->auth_key?>">
			<button type="submit" class="btn btn-primary">ยืนยัน</button>
			</div>
        </form>
    </div>
</div>

</div>
</div>