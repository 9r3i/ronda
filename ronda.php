<?php
/* Ronda application
 * Authored by Luthfie a.k.a. 9r3i
 * Luthfie@y7mail.com
 * PHP version >= 5.5.19
 * started at May 1st 2015
 */

/* Detect mobile browser */
if(!function_exists('is_mobile_browser')){function is_mobile_browser(){
  $useragent=(isset($_SERVER['HTTP_USER_AGENT']))?$_SERVER['HTTP_USER_AGENT']:'';
  if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){return true;}else{return false;}
}}

/* set a file name for raw data */
$file = defined('BAZZMU')?PUBLIC_HTML.'ronda.txt':'ronda.txt';

/* set print out title */
$title = 'Jadwal Ronda - Kp. Rawa Bogo RT. 02/03 Jati Mekar';

/* set a search word */
$search_word = 'Cari';

/* set starting date */
$start_date = 'May 1st 2015';

/* set people on ronda per day */
$perday = 4;

/* set recursive array -> minimum = 2 */
$recursive = is_mobile_browser()?2:5;

/* print output html per row -> minimum = 1 & maximum = 7 */
$perrow = is_mobile_browser()?1:7;


/* ----------- DO NOT EDIT THIS PART ----------- */

/* check the file and stop if doesn't exist */
if(!is_file($file)){
  header('content-type: text/plain;');
  exit('file doesn\'t exist');
}

/* get content data file */
$content = @file($file,FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);

/* count of content */
$jumlah = count($content);
$total_hari = $jumlah/$perday;

/* set default timezone */
date_default_timezone_set('Asia/Jakarta');

/* set a day as second */
$aday = 3600*24;

/* set auto starting date */
function new_start_date($start_date,$total_hari,$aday){
  $total_hari_time = $aday*$total_hari;
  if(strtotime($start_date)<time()-$total_hari_time){
    $start_date = date('F jS Y',strtotime($start_date)+$total_hari_time);
    if(strtotime($start_date)<time()-$total_hari_time){
      $start_date = new_start_date($start_date,$total_hari,$aday);
    }
  }
  return $start_date;
}
$start_date = new_start_date($start_date,$total_hari,$aday);

/* set starting date to time */
$start = strtotime($start_date);

/* recusrive the content */
$recursive = isset($_GET['name'])?7:$recursive;
$ncontent = array();
for($i=0;$i<$recursive;$i++){
  $ncontent = array_merge($ncontent,$content);
}
$content = $ncontent;

/* get result per day */
$result = array();
$counter = 0;
$day = 0;
foreach($content as $name){
  if($counter<$perday){
    $counter++;
  }else{
    $day++;
    $counter = 1;
  }
  $ctime = ($day*$aday)+$start;
  //$result[date('d-m',$ctime)][] = $name;
  $result[$ctime][] = $name;
}

/* set hari variable */
$hari = array(
  'Sunday'=>'Ahad',
  'Monday'=>'Senin',
  'Tuesday'=>'Selasa',
  'Wednesday'=>'Rabu',
  'Thursday'=>'Kamis',
  'Friday'=>'Jum\'at',
  'Saturday'=>'Sabtu',
);

/* set bulan variable */
$bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

/* print the sample */
//header('content-type: text/plain;'); print_r($result); exit;

/* set content type to html as output content */
header('content-type: text/html;charset=utf-8;');

/* print output html in table */
?><!DOCTYPE html><html lang="en-US"><head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8;" />
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta content="Luthfie" name="developer" />
  <meta content="luthfie@y7mail.com" name="developer-email" />
  <title><?php print($title); ?></title>
<style type="text/css">
body,table{font-family:monospace;font-size:medium;color:#333;}
body{padding:0px;margin:0px;background-color:#7bf;}
a{text-decoration:none;color:#37b;}
a:hover{text-decoration:none;text-shadow:0 0 5px #37b;}
#index{
  margin:0px auto;
  padding:0px;
  background-color:#fff;
  min-height:300px;
  <?php echo is_mobile_browser()?'max-':''; ?>width:1000px;
  box-shadow:0 0 10px #fff;
}
.title{padding:10px;margin:0px;font-size:large;text-align:center;font-weight:bold;}
.tdiv{padding:10px;margin:0px;}
.table{border:1px solid #777;width:100%;}
.table th{border:1px solid #777;background-color:#bdf;color:#333;padding:3px;}
.table td{border:1px solid #777;vertical-align:top;overflow:hidden;}
.each-td{padding:3px;border-bottom:1px dotted #999;}
.footer{padding:10px;margin:0px;font-size:small;text-align:center;}
.form{padding:5px 10px 10px;margin:0px;text-align:center;}
.form-select{border:1px solid #999;padding:4px;margin:0px;}
.form-submit{border:0px none;padding:5px 9px;margin:0px;background-color:#333;color:#fff;cursor:pointer;}
</style>
</head><body><div id="index">
<div class="title"><a href="<?php print($_SERVER['PHP_SELF']); ?>"><?php print($title); ?></a></div>
<div class="form"><form action="" method="get"><select name="name" class="form-select" onchange="load_search(this.value)">
<option value="">-- <?php print($search_word); ?> --</option>
<?php
$contents = array_unique($content);
asort($contents);
foreach($contents as $name){
  echo '<option value="'.$name.'" '.($name==$_GET['name']?'selected="true"':'').'>'.$name.'</option>';
} ?>
</select>
<noscript>
<input class="form-submit" type="submit" value="<?php print($search_word); ?>" />
</noscript>
</form></div>
<div class="tdiv"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table"><tbody>
<?php
$row = 0;
$counter = 0;
$section = array();
$header = array();
/* print as table */
if(isset($_GET['name'])){foreach($result as $key=>$value){if($key>=(time()-$aday)&&in_array($_GET['name'],$value)){
  if($counter==0){
    $header[] = '<tr>';
    $section[] = '<tr>';
  }
  $counter++;
  $thari = isset($hari[date('l',$key)])?$hari[date('l',$key)].'<br />':'';
  $header[] = '<th>'.$thari.date('j ',$key).$bulan[date('n',$key)].date(' Y',$key).'</th>';
  $section[] = '<td>';
  foreach($value as $val){
    $section[] = '<div class="each-td">'.$val.'</div>';
  }
  $section[] = '</td>';
  if(is_mobile_browser()&&$counter>=$perrow){
    $counter = 0;
    $header[] = '</tr>';
    $section[] = '</tr>';
    echo implode('',$header);
    $header = array();
    echo implode('',$section);
    $section = array();
  }
}}
if(!is_mobile_browser()&&count($section)>0){
    $counter = 0;
    $header[] = '</tr>';
    $section[] = '</tr>';
    echo implode('',$header);
    $header = array();
    echo implode('',$section);
    $section = array();
}
}else{foreach($result as $key=>$value){if($key>=(time()-$aday)){
  if($counter==0){
    $header[] = '<tr>';
    $section[] = '<tr>';
  }
  $counter++;
  $thari = isset($hari[date('l',$key)])?$hari[date('l',$key)].'<br />':'';
  $header[] = '<th>'.$thari.date('j ',$key).$bulan[date('n',$key)].date(' Y',$key).'</th>';
  $section[] = '<td>';
  foreach($value as $val){
    $section[] = '<div class="each-td">'.$val.'</div>';
  }
  $section[] = '</td>';
  if($counter>=$perrow){
    $counter = 0;
    $header[] = '</tr>';
    $section[] = '</tr>';
    echo implode('',$header);
    $header = array();
    echo implode('',$section);
    $section = array();
  }
}}}
?>
</tbody></table></div>
<div class="footer">Presented by <a href="https://github.com/9r3i" title="9r3i" target="_blank">9r3i</a> version <?php print(PHP_VERSION); ?></div>
<script type="text/javascript">
function load_search(val){
  window.location.assign('?name='+val);
}
</script>
</div></body></html>



