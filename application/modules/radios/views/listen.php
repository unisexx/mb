<h1>Radio: <?php echo $radio->title; ?></h1>
<?php if($radio->format == 'src'): ?>
    <object width="300" height="63" classid="CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701" standby="Loading Microsoft Windows Media Player components..." type="application/x-oleobject">
    <param name="FileName" value="http://nbtstream1.prd.go.th:8000/live_fm88_131.mp3.m3u">
    <param name="AutoStart" value="True">
    <param name="ShowStatusBar" value="True">
    <param name="DefaultFrame" value="mainFrame">
    <!-- BEGIN PLUG-IN HTML FOR FIREFOX-->
    <embed type="application/x-mplayer2" pluginspage = "http://www.microsoft.com/Windows/MediaPlayer/" src="<?php echo $radio->src; ?>" width="300" height="63" defaultframe="rightFrame" showstatusbar="true"></embed>
    <!-- END PLUG-IN HTML FOR FIREFOX-->
    </object>
<?php elseif($radio->format == 'flashvars'): ?>
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="300" height="23">
    <param name="movie" value="swf/player.swf">
    <param name="allowfullscreen" value="true">
    <param name="allowscriptaccess" value="always">
    <param name="wmode" value="transparent">
    <param name="flashvars" value="<?php echo $radio->src; ?>">
    <embed type="application/x-shockwave-flash" src="swf/player.swf" width="300" height="23" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" flashvars="<?php echo $radio->src; ?>"></embed>
    </object>
<?php endif; ?>