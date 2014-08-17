<form action="sticker/all" method="get">
	<div class="col-sm-6 col-md-4 col-xs-12 pull-right" style="padding: 0;">
    <div class="input-group" style="margin-bottom: 10px;">
      <input type="text" class="form-control" name="title" value="<?=@$_GET['title']?>" placeholder="ค้นหาสติ๊กเกอร์ไลน์">
      <span class="input-group-btn">
      	<input type="hidden" name="sort" value="<?=@$_GET['sort']?>">
      	<input type="hidden" name="n" value="<?=@$_GET['n']?>">
        <button class="btn btn-primary" type="submit">ค้นหา</button>
      </span>
    </div><!-- /input-group -->
    </div>
</form>