<style>
.modal-header{
    cursor: move;
    padding-top: 8px;
    padding-bottom: 8px;
    background-color: #ececec;
    background-repeat: repeat-x;
    background-image: -moz-linear-gradient(top,#f5f5f5 0,#ececec 100%);
    background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#f5f5f5),color-stop(100%,#ececec));
    background-image: -webkit-linear-gradient(top,#f5f5f5 0,#ececec 100%);
    background-image: -ms-linear-gradient(top,#f5f5f5 0,#ececec 100%);
    background-image: -o-linear-gradient(top,#f5f5f5 0,#ececec 100%);
    background-image: linear-gradient(top,#f5f5f5 0,#ececec 100%);
    border-bottom: 1px solid #ddd;
    border-radius: 6px 6px 0 0;
    -webkit-box-shadow: inset 0 1px 0 #fff;
    box-shadow: inset 0 1px 0 #fff;
}
.modal-header .modal-title {
    width: 75%;
    margin: 0 auto;
    overflow: hidden;
    font-size: 14px;
    font-weight: bold;
    line-height: 18px;
    color: #555;
    text-align: center;
    text-shadow: 0 1px 0 #fff;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.modal-body{padding:0;}
.modal-body h1{margin:0;font-size: 24px;white-space: nowrap;}
.modal-body .profile-header{
    text-align:center; 
    background: url('https://abs.twimg.com/a/1385011337/t1/img/grey_header_web.jpg'); 
    color: #fff; 
    padding-top:10px;
}
.modal-body .social-data{padding:10px 0;}
</style>

<h2 style="margin-top:0;">Top Friends</h2>
<?php foreach($topfriend as $row):?>
<a href="#" class="thumbnail" data-toggle="modal" data-target="#myModal-<?php echo $row->id?>">
	<img src="uploads/user/<?php echo $row->image?>">
</a>
<?php endforeach;?>

<?php foreach($topfriend as $row):?>
<!-- Modal -->
<div class="modal fade" id="myModal-<?php echo $row->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Profile Summary</h4>
      </div>
      <div class="modal-body">
        
        <!------- Modal Body ------->
        <div class="profile-header">
            <div class="list-img thumbnail">
                <?php 
                if(is_file('uploads/user/'.$row->image)){
                    echo img(array('src' => 'uploads/user/'.$row->image, 'width' => 120, 'height' => 120));    
                }
                else {
                    echo img(array('src' => 'media/images/sex-'.$row->sex_id.'.png', 'width' => 120, 'height' => 120)); 
                }
                ?>
            </div>
            <div class="list-detail">
                <h1 class="list-name"><?php echo $row->name; ?></h1>
                <span class="list-age"><?php echo $row->age; ?></span>
                <div><?php echo $row->detail; ?></div>
                
                <?php foreach($row->user_app as $user_app): ?>
                    <?php if(!empty($user_app->social_data) and $user_app->app_id == $app->id): ?>
                    <div><?php echo $app->placeholder?>: <?php echo $user_app->social_data; ?></div>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <span class="label" style="background: <?php echo $row->sex->color?>"><?php echo $row->sex->title; ?></span>
                <span class="label label-warning"><?php echo $row->province->name?></span>
            </div>
            
            <br clear="all">
        </div>
        <br clear="all">
        <!------- Modal Body ------->
        
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endforeach;?>