<style type="text/css">
.newcontent img {
  border: 0 !important;
  width: 100% !important;
  display: block !important;
  /*max-width: 65% !important;*/
}
</style>

<div style="background: #fff; padding: 10px; margin-top: 25px;">
<ul class="breadcrumb">
    <li><a href="home">หน้าแรก</a> </li>
    <li><a href="pages">เพจ</a> </li>
    <li class="active"><a href="pages/view/<?=$page->id?>"><?=$page->title?></a></li>
</ul>
<h1><?=$page->title?></h1>
<?=addThis()?>
<div class="newcontent">
    <?=$page->detail?>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('.newcontent img').addClass("img-responsive");
	$('.newcontent img').removeAttr('width').removeAttr('height');
});
</script>