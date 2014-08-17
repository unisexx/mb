<h1>Friends</h1>
<div class="search">
    <form method="get">
        <table class="form">
            <tr><th>Line ID:</th><td><input type="text" name="search" value="<?php echo (isset($_GET['search']))?$_GET['search']:'' ?>" /></td><td><input type="submit" value="ค้นหา" /></td></tr>
        </table>
    </form>
</div>

<?php echo $users->pagination()?>
<table class="list">
    <tr>
        <th>แสดง</th>
        <th>รูปภาพ</th>
        <th>ชื่อ</th>
        <th>Social ID</th>
        <th>ข้อความทักทาย</th>
        <th>E-mail</th>
        <th>IP</th>
        <th width="90"></th>
    </tr>
    <?php foreach($users as $row): ?>
    <tr <?php echo cycle()?>>
        <td><input type="checkbox" name="status" value="<?php echo $row->id ?>" <?php echo ($row->status=="approve" or $row->status=="active")?'checked="checked"':'' ?> /></td>
        <td>
            <?php if($row->image != ""):?>
                <img class="image" src="uploads/user/<?php echo $row->image?>" width="64" height="64">
            <?php else:?>
                <?php echo ($row->sex_id == 1)?'<img class="image" src="themes/line/images/cmn_cnt_bg01.png" height="64">':'<img class="image" src="themes/line/images/cmn_cnt_bg02.png" height="64">';?>
            <?php endif;?>
        </td>
        <td><?php echo $row->name?></td>
        <td>
            <?php foreach($row->user_app as $user_app): ?>
                <?php // if(!empty($user_app->social_data) and $user_app->app_id == $app->id): ?>
                <div class="input-group">
                  <!-- <span class="input-group-addon"><?php echo $user_app->app->name?></span> -->
                  <input type="text" class="form-control" value="<?php echo $user_app->social_data; ?>">
                </div>
                <?php // endif; ?>
            <?php endforeach; ?>
        </td>
        <td><?php echo $row->detail?></td>
        <td><?php echo $row->email?></td>
        <td><?php echo $row->ip?></td>
        <td>
            <a class="btn" href="test/admin/test/form/<?php echo $row->id?>" >แก้ไข</a> 
            <a class="btn" href="test/admin/test/delete/<?php echo $row->id?>" onclick="return confirm('<?php echo lang('notice_confirm_delete');?>')">ลบ</a>
        </td>
        </tr>
        <?php endforeach; ?>
</table>
<?php echo $users->pagination()?>