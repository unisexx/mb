<h1>แจ้งลบ</h1>
<!-- <div class="search">
    <form method="get">
        <table class="form">
            <tr><th>Line ID:</th><td><input type="text" name="search" value="<?php echo (isset($_GET['search']))?$_GET['search']:'' ?>" /></td><td><input type="submit" value="ค้นหา" /></td></tr>
        </table>
    </form>
</div> -->

<?php echo $notices->pagination()?>
<table class="list">
    <tr>
        <th>รูปภาพ</th>
        <th>ชื่อ</th>
        <th>Social ID</th>
        <th>ปัญหา</th>
        <th>รายละเอียดเพิ่มเติม</th>
        <th>IP</th>
        <th width="90"></th>
    </tr>
    <?php foreach($notices as $row): ?>
    <tr <?php echo cycle()?>>
        <td>
            <?php if($row->user->image != ""):?>
                <img class="image" src="uploads/user/<?php echo $row->user->image?>" width="64" height="64">
            <?php else:?>
                <?php echo ($row->user->sex_id == 1)?'<img class="image" src="themes/line/images/cmn_cnt_bg01.png" height="64">':'<img class="image" src="themes/line/images/cmn_cnt_bg02.png" height="64">';?>
            <?php endif;?>
        </td>
        <td><?php echo $row->user->name?></td>
        <td>
            <?php foreach($row->user->user_app as $user_app): ?>
                <?php // if(!empty($user_app->social_data) and $user_app->app_id == $app->id): ?>
                <div class="input-group">
                  <!-- <span class="input-group-addon"><?php echo $user_app->app->name?></span> -->
                  <input type="text" class="form-control" value="<?php echo $user_app->social_data; ?>">
                </div>
                <?php // endif; ?>
            <?php endforeach; ?>
        </td>
        <td><?php echo $row->notice?></td>
        <td><?php echo $row->detail?></td>
        <td><?php echo $row->ip?></td>
        <td>
            <a class="btn" href="test/admin/notices/hide/<?php echo $row->user->id?>" onclick="return confirm('<?php echo "ต้องการซ่อนผู้ใช้งานนี้";?>')">ซ่อน</a> 
            <a class="btn" href="test/admin/notices/delete/<?php echo $row->user->id?>" onclick="return confirm('<?php echo lang('notice_confirm_delete');?>')">ลบ</a>
            <br><br><a class="btn" href="test/admin/notices/delete_notice/<?php echo $row->user->id?>" onclick="return confirm('<?php echo "ลบการแจ้งเตือนนี้";?>')">ลบแจ้งเตือน</a> 
        </td>
        </tr>
        <?php endforeach; ?>
</table>
<?php echo $notices->pagination()?>