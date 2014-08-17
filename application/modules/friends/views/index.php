<div class="row">
<?php $sex_color = array('0'=>'unisex','1'=>'men','2'=>'women');?>
<div id="friend">
<div class="col-6 col-sm-7 col-lg-8 ">
    <a class="btn btn-primary pull-right" href="friends/form" style="text-align: center;">เพิ่มไอดีไลน์ของคุณ</a>
    <br clear="all">
    <form id="line-form" class="form-inline" role="form">
    <div class="row">
        <div class="col-xs-4">
        <?=form_dropdown('sex_id',get_option('id','title','sexs order by id asc'),@$_GET['sex_id'],'id="sex" class="form-control input-sm"','ทุกเพศ');?>
        </div>
        <div class="row col-xs-4">
        <?=form_dropdown('province_id',get_option('id','name','provinces order by name asc'),@$_GET['province_id'],'id="province" class="form-control input-sm"','ทุกจังหวัด');?>
        </div>
        <div class="col-xs-4">
        <?=form_dropdown('image',array('image'=>'มีรูป','noimage'=>'ไม่มีรูป'),@$_GET['image'],'class="form-control input-sm"','ทั้งหมด');?>
        </div>
    </div>
    </form>
    
    <h2>รายชื่อเพื่อนที่ลงข้อมูลล่าสุด</h2>
    <?php foreach($friends as $row):?>
        <div class="item <?php echo $sex_color[$row->sex_id]?>">
            <div class="profile">
                <?php if($row->image != ""):?>
                    <img class="image" src="uploads/friend/<?php echo $row->image?>" width="64" height="64">
                <?php else:?>
                    <?php echo ($row->sex_id == 1)?'<img class="image" src="themes/line/images/cmn_cnt_bg01.png" height="64">':'<img class="image" src="themes/line/images/cmn_cnt_bg02.png" height="64">';?>
                <?php endif;?>
                <p class="date"><?php echo mysql_to_th($row->created,'s',true)?> น.</p>
                <h3><?php echo ($row->name != "")?$row->name:"ไม่ระบุชื่อเล่น";?></h3>
                <ul class="list-unstyled list-inline">
                    <li><?php echo ($row->age != "0")?$row->age:"ไม่ระบุอายุ";?></li>
                    <li><?php echo $row->sex->title?></li>
                    <li><?php echo $row->province->name?></li>
                </ul>
            </div>
            <div class="idBox"><input name="" type="text" value="<?php echo $row->line_id?>" onclick="this.select()"></div>
            <p class="comment"><?php echo badWordFilter($row->detail)?></p>
        </div>
    <?php endforeach;?>
    <?php echo $friends->pagination()?>
</div>
</div>

<!-- <br clear="all">
<div class="col-6 col-sm-5 col-lg-4">
<form id="form" role="form" method="post" action="friends/save" enctype="multipart/form-data">
  <div class="form-group">
    <label for="lineid">LINE ID</label>
    <input type="text" name="line_id" class="form-control" id="lineid" placeholder="กรอกไอดีไลน์">
  </div>
  <div class="form-group">
    <label for="nickname">ชื่อเล่น</label>
    <input type="text" name="name" class="form-control" id="nickname" placeholder="ชื่อ">
  </div>
  <div class="form-group">
      <label for="age">อายุ</label>
        <select name="age" id="age" class="form-control">
            <option value="0">--- เลือกอายุ ---</option>
            <?php for ($x=12; $x<=60; $x++):?>
            <option value="<?php echo $x?>"><?php echo $x?></option>
            <?php endfor;?>
        </select>
  </div>
  <div class="form-group">
      <label for="sex">เพศ</label>
            <?=form_dropdown('sex_id',get_option('id','title','sexs order by id asc'),'','id="sex" class="form-control"','--- เลือกจังหวัด ---');?>
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
  </div>
  <button type="submit" class="btn btn-default btn-success">ส่งข้อมูล</button>
</form>
</div> -->
</div>