<h1>LINE Sticker Shop</h1>

<div class="search">
    <form method="get">
        <table class="form">
            <tr><th>ชื่อสติ๊กเกอร์</th><td><input type="text" name="search" value="<?php echo (isset($_GET['search']))?$_GET['search']:'' ?>" /></td><td><input type="submit" value="ค้นหา" /></td></tr>
        </table>
    </form>
</div>

<?php echo $lines->pagination()?>
<table class="list">
    <tr>
        <th>สถานะ</th>
        <th>ประเภท</th>
        <th>รหัส</th>
        <!-- <th>QR</th> -->
        <th>รูป</th>
        <!-- <th>พรีวิว</th> -->
        <th>หัวข้อ</th>
        <th>เครดิต</th>
        <th width="90">
            <a class="btn" href="stickers/admin/stickers/form">เพิ่มรายการ</a>
        </th>
    </tr>
    <?php foreach($lines as $row): ?>
    <tr <?php echo cycle()?>>
        <td><input type="checkbox" name="status" value="<?php echo $row->id ?>" <?php echo ($row->status=="approve")?'checked="checked"':'' ?> <?php echo (@$_POST['status']=="approve")?'':'' ?> /></td>
        <td><?php echo $row->category?></td>
        <td><a href="http://www.line2me.in.th/get_sticker_detail_store.php?code=<?=$row->sticker_code?>" target="_blank"><?php echo $row->sticker_code?></a></td>
        <!-- <td><img src="http://qrfree.kaywa.com/?l=2&s=3&d=line%3A%2F%2Fshop%2Fdetail%2F<?php echo $row->sticker_code;?>" width="90"></td> -->
        <td><img src="<?php echo $row->cover;?>" width="90"></td>
        <!-- <td><a href="<?php echo $row->preview?>" target="_blank"><?php // echo thumb($row->preview,'90','90','1');?><img src="<?=$row->preview?>" width="90" height="90"></a></td> -->
        <td><a href="http://www.line2me.in.th/sticker/<?=$row->slug?>" target="_blank"><?php echo $row->title?></a></td>
        <td><?=$row->title_credit?></td>
        <td>
            <a class="btn" href="stickers/admin/stickers/form/<?php echo $row->id ?>" >แก้ไข</a>
            <a class="btn" href="stickers/admin/stickers/delete/<?php echo $row->id?>" onclick="return confirm('<?php echo lang('notice_confirm_delete');?>')">ลบ</a>
        </td>
        </tr>
    <?php endforeach; ?>
        
    </table>
<?php echo $lines->pagination()?>