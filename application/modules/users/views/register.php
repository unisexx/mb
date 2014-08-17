<div class="row">
<div class="col-sm-5 col-md-6 col-lg-4">
<h1>สมัครสมาชิก</h1>

<div class="alert alert-info">
    <i class="fa fa-exclamation-circle"></i> สมัครสมาชิกกับทางเราเพื่อประหยัดเวลาในการกรอกข้อมูล จะได้ไม่ต้องกรอกข้อมูลบ่อยๆครับ
  </div>
  
<form id="regisform" role="form" method="post" action="users/signup">
    <!-- <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
    </div> -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="_password">Re Password</label>
        <input type="password" name="_password" class="form-control" id="_password" placeholder="Re Password">
    </div>
    <img src="users/captcha" />
    <div class="form-group">
        <input type="text" class="form-control " name="captcha" id="inputCaptcha" placeholder="กรอกตัวอักษรให้ตรงกับภาพ">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Sign up</button>
    </div>
</form>
</div>
</div>