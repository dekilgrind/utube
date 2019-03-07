<?php include 'EDIT.php';include 'func.php';include './YouTube.class.php';$YouTube=new YouTube;$q=str_ireplace('-',' ',$_GET['q']);
$badWordList = file_get_contents("badwords.txt",NULL);
$badWordArray = explode("\n", $badWordList);
function check_forbidden($forbiddennames, $stringtocheck) 
{
foreach ($forbiddennames as $name) {
    if (stripos($stringtocheck, $name) !== FALSE) {
            return true;
    }
}
}	
if(check_forbidden($badWordArray, $q)) {
    header('location: /dmca');
	die();
} 	
if(!empty($_GET['token'])){$res=$YouTube->search($q,base64_decode($_GET['token']));}else{$res=$YouTube->search($q);}$json=json_decode($res);$nextToken = $YouTube->nextToken;$prevToken = $YouTube->prevToken;$title='Video & MP3 '.ucwords(str_replace('-',' ',$_GET['q'])).'';include 'head.php';echo '<h2 class="razdl">'.$title.'</h2>';foreach($json as $item){$type=$item->type;if($type=='video'){$id=$item->id;$title=ucwords($item->title);$duration=$item->duration;$channel=ucwords(substr($item->channel,0,200)).'.';$view=$item->view;echo '<div id="radius"><div class="tengah"><center></center></div></div>';echo '<div class="list-a"><!--HTML Start--><table width="100%"><tbody><tr><td valign="middle" width="100px" align="center"><img src="https://i.ytimg.com/vi/'.$id.'/default.jpg" alt="'.$title.'" class="img-responsive zoom-img" style="width:120px;height:75px;border: 1px solid transparent;border-color: black;border-radius: 4px;"></td><td style="padding-left:5px;" valign="middle"><a href="/watch/'.$id.'" title="'.$title.' Video Free"> <font size="4"><i class="fa fa-youtube-play"></i> '.$title.'</font></a><br/><i class="fa fa-eye"></i> Viewer : '.$view.' &nbsp;&nbsp;<i class="fa fa-desktop"></i> by : '.$channel.'<br/> <a href="'.$fakedownload.'" title="Download '.$title.' Video Free"><font color="#BB0000;" weight="bold">Download</font></a>&nbsp;|&nbsp;<a href="/watch/'.$id.'" title="Download '.$title.' Video Free"><font color="#BB0000;" weight="bold">View</font></a></td></tr></tbody></table></div></div>';}}echo '<div class="list-a"><div class="pagenavi">';if(!empty($prevToken)){echo '<center><a  href="/download/'.$_GET['q'].'/page/'.base64_encode($prevToken).'/" class="pagenavi"><button type="button" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Prev</button></a></center><br>';}if(!empty($nextToken)){echo '<center><a  href="/download/'.$_GET['q'].'/page/'.base64_encode($nextToken).'/" class="pagenavi"><button type="button" class="btn btn-default">Next <i class="fa fa-angle-double-right"></i></button></a></center>';}echo '</div></div>';echo '<h2 class="razdl">Last Search</h2><div class="list-a">';include 'hasilcari.php';echo '</div>';include 'footer.php';?>