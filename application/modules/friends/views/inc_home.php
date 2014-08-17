<div id="friend">
    <form id="line-form" class="form-inline" role="form">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-lg-3">
            <?=form_dropdown('sex_id',get_option('id','title','sexs order by id asc'),@$_GET['sex_id'],'id="sex" class="form-control"','- ทุกเพศ -');?>
            </div>
            <div class="row col-xs-6 col-sm-6 col-lg-3">
            <?=form_dropdown('province_id',get_option('id','name','provinces order by name asc'),@$_GET['province_id'],'id="province" class="form-control"','- ทุกจังหวัด -');?>
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-3">
            <?=form_dropdown('image',array('image'=>'มีรูป','noimage'=>'ไม่มีรูป'),@$_GET['image'],'class="form-control"','- ทั้งหมด -');?>
            </div>
            <div class="row col-xs-6 col-sm-6 col-lg-3">
            <?=form_dropdown('app_id',get_option('id','title','apps order by orderlist asc'),@$_GET['app_id'],'id="apps" class="form-control"',false);?>
            </div>
        </div>
    </form>
    
    <h2>รายชื่อเพื่อนที่อัพเดทข้อมูลล่าสุด</h2>
    <?php foreach($users as $row):?>
        <div class="item">
            <!-- <table class="table table-responsive">
                <tr>
                    <td rowspan="5" width="110">
                        <?php if($row->image != ""):?>
                            <img class="image" src="uploads/user/<?php echo $row->image?>" width="100" height="100">
                        <?php else:?>
                            <img class="image noimg" src="<?php echo $row->sex->image?>" width="36" height="64">
                        <?php endif;?>
                    </td>
                    <td>
                        <p class="date"><?php echo mysql_to_th($row->updated,'s',true)?> น.</p>
                    </td>
                </tr>
                <tr>
                    <td><?php echo mysql_to_th($row->updated,'s',true)?> น.</td>
                </tr>
                <tr>
                    <td><h3 style="color:<?php echo $row->sex->color?>"><?php echo ($row->name != "")?$row->name:"ไม่ระบุชื่อเล่น";?></h3></td>
                </tr>
                <tr>
                    <td>
                        <ul class="list-unstyled list-inline">
                            <li><?php echo ($row->birth_date != "")?cal_age($row->birth_date):"ไม่ระบุอายุ";?></li>
                            <li><?php echo $row->sex->title?></li>
                            <li><?php echo $row->province->name?></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td><input type="text" value="<?php echo $row->user_app->where('app_id = '.$app->id)->get()->social_data?>" onclick="this.select()"></td>
                </tr>
            </table> -->
            <div class="profile">
                <?php if($row->image != ""):?>
                    <img class="image" src="uploads/user/<?php echo $row->image?>" width="100" height="100">
                <?php else:?>
                    <img class="image noimg" src="<?php echo $row->sex->image?>" width="36" height="64">
                <?php endif;?>
                <p class="date"><?php echo mysql_to_th($row->updated,'s',true)?> น.</p>
                <h3 style="color:<?php echo $row->sex->color?>"><?php echo ($row->name != "")?$row->name:"ไม่ระบุชื่อเล่น";?></h3>
                <ul class="list-unstyled list-inline">
                    <li><?php echo ($row->birth_date != "")?cal_age($row->birth_date):"ไม่ระบุอายุ";?></li>
                    <li><?php echo $row->sex->title?></li>
                    <li><?php echo $row->province->name?></li>
                </ul>
            </div>
            <div class="idBox"><?php echo $app->placeholder?> : 
            	<input type="text" value="<?php echo $row->user_app->where('app_id = '.$app->id)->get()->social_data?>" onclick="this.select()">
            </div>
            <p class="comment"><?php echo badWordFilter($row->detail)?></p>
        </div>
    <?php endforeach;?>
    <?php echo $users->pagination()?>
</div>
<br>