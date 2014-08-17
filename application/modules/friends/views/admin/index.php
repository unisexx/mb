<h1>Friends</h1>
<div class="search">
    <form method="get">
        <table class="form">
            <tr><th>Line ID:</th><td><input type="text" name="search" value="<?php echo (isset($_GET['search']))?$_GET['search']:'' ?>" /></td><td><input type="submit" value="ค้นหา" /></td></tr>
        </table>
    </form>
</div>

<?php echo $friends->pagination()?>
<table class="list">
    <tr>
        <th>แสดง</th>
        <th>รูปภาพ</th>
        <th>ชื่อ</th>
        <th>LINE ID</th>
        <th>ข้อความทักทาย</th>
        <th>IP</th>
        <th width="90"></th>
    </tr>
    <?php foreach($friends as $row): ?>
    <tr <?php echo cycle()?>>
        <td><input type="checkbox" name="status" value="<?php echo $row->id ?>" <?php echo ($row->status=="approve")?'checked="checked"':'' ?> /></td>
        <td>
            <?php if($row->image != ""):?>
                <img class="image" src="uploads/friend/<?php echo $row->image?>" width="64" height="64">
            <?php else:?>
                <?php echo ($row->sex_id == 1)?'<img class="image" src="themes/line/images/cmn_cnt_bg01.png" height="64">':'<img class="image" src="themes/line/images/cmn_cnt_bg02.png" height="64">';?>
            <?php endif;?>
        </td>
        <td><?php echo $row->name;?></td>
        <td><?php echo $row->line_id?></td>
        <td><?php echo $row->detail?></td>
        <td><?php echo $row->ip?></td>
        <td>
            <a class="btn" href="friends/admin/friends/form/<?php echo $row->id?>" >แก้ไข</a> 
            <a class="btn" href="friends/admin/friends/delete/<?php echo $row->id?>" onclick="return confirm('<?php echo lang('notice_confirm_delete');?>')">ลบ</a>
        </td>
        </tr>
        <?php endforeach; ?>
</table>
<?php echo $friends->pagination()?>