<style>
#forget .input-group-addon{
    min-width:90px;
    text-align:left;
}
</style>
<div id="main">
<div class="container">
	
<h1>ลืมรหัสผ่าน</h1>
<br>

<div class="row">
    <div id="post" class="col-md-4 col-xs-12">
        <form id="forget" class="form-horizontal" method="post" action="users/forget_pass_save">
            <div class="input-group">
			  <span class="input-group-addon">อีเมล์</span>
			  <input type="text" class="form-control" placeholder="Email" name="email">
			</div>
			
			<div class="input-group">
			  <span class="input-group-addon">Captcha</span>
			  <img src="users/captcha" /><Br>
			  <input type="text" class="form-control" placeholder="กรอกรหัสที่เห็นในภาพ" name="captcha">
			</div>
		
            <div style="text-align: center; margin-top: 10px;">
			<button type="submit" class="btn btn-primary">ส่งข้อมูล</button>
			</div>
        </form>
    </div>
</div>

</div>
</div>