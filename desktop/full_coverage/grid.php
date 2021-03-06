<div class="col-md-12">
    <div class="row justify-content-center">
<?php
include ('full_coverage/vendor/autoload.php');
use \NlpTools\Tokenizers\WhitespaceTokenizer;
use \NlpTools\Similarity\CosineSimilarity;
use \NlpTools\Similarity\Simhash;
 $tok = new WhitespaceTokenizer();
$fc_algorithm = new CosineSimilarity();
//$fc_algorithm = new Simhash(16); // 16 bits hash
function fullDescSort($item1,$item2)
{
    if ($item1['full_coverage'] == $item2['full_coverage']) return 0;
    return ($item1['full_coverage'] > $item2['full_coverage']) ? -1 : 1;
}
$stmt = $conn->prepare("SELECT * FROM news WHERE id=:id");
$stmt->execute(['id'=>$fc_id]);
$evv_name = $stmt->fetch();
$s1 = $evv_name['title'];
//$s1 = strip_tags($s1);
//$s2 = "Hello, I love you, let me jump in your game";

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC LIMIT 1");
$stmt->execute();
$evv = $stmt->fetch();
$id_evv = $evv['id'] - 820;

$stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC");
$stmt->execute();
$auth = $stmt->fetchAll();
//echo sizeof($auth);
$fc_array = array();
foreach($auth as $row){
$s2 = $row['title'];
//$s2 = strip_tags($s2);
$setA = $tok->tokenize($s1);
$setB = $tok->tokenize($s2);
$eval_perc = number_format($fc_algorithm->similarity($setA,$setB), 3)*100;

if($eval_perc >= 25){
    
$fc = $eval_perc;      
$val = Array
      (
          'id' => $row['id'],
          'full_coverage' => $eval_perc,
          'source' => $row['source'],
         'deep_link' => $row['deep_link'],
          'title' => $row['title'],
          'published' => $row['published'],
          'author' => $row['author'],
          'article' => $row['article'],
          'tag_1' => $row['tag_1'], 
          'tag_2' => $row['tag_2'] ,
          'tag_3' => $row['tag_3'] ,
         'photo' => $row['photo'],
          'photo_url' => $row['photo_url'],
          'p_grapher' => $row['p_grapher'],
          'category' => $row['category'],
          'time' => $row['time'],
          'code' => $row['code'],
          'parent' => $row['parent'],
          'type' => $row['type'],
          'video_url' => $row['video_url'],
          'frame_color' => $row['frame_color'],
          'title_badge' => $row['title_badge'],
          'meta_title' => $row['meta_title'],
          'meta_desc' => $row['meta_desc'],
          'meta_keywords' => $row['meta_keywords'],
          'post_date' => $row['post_date'],
          'pin' => $row['pin'],
          'sub_1' => $row['sub_1'],
          'sub_2' => $row['sub_2'],
          'intefax' => $row['intefax'],
          'source_error' =>$row['source_error'],
          'input' => $row['input']
      );
    array_push($fc_array, $val);
}

usort($fc_array,'fullDescSort');
//echo number_format($fc_algorithm->similarity($setA,$setB), 3)*100 .'% --- <b>'.$row['title'].'</b> ---- <a class="btn btn-warning" href="../article_data.php?id='.$row['code'].'" target="_blank" >Preview</a>--- <b>'.$row['time'].'</b>--- <b>'.$row['id'].'</b><br/>';
}

$list_first_item = array_slice($fc_array,0,3);

foreach($list_first_item as $row){
    $rowtitle = $row['title'];  
    
    $maxPos = 500;
if($row['sub_1'] != ''){
  $catHolder = $row['sub_1'];
 }else{
   $catHolder = 'General';
 }
    if($row['parent'] == "ua.korrespondent.net"){
      $rowParent = "????????????????????????";
    }
    elseif($row['parent'] == "pravda.com.ua"){
      $rowParent = "????????????";
    }
    elseif($row['parent'] == "eurointegration.com.ua"){
      $rowParent = "????????????????????????????";
    }
    elseif($row['parent'] == "unian.ua"){
      $rowParent = "????????????????????";
    }
    elseif($row['parent'] == "life.pravda.com.ua"){
      $rowParent = "????????????";
    }
    elseif($row['parent'] == "theguardian.com"){
      $rowParent = "The guardian";
    }
    elseif($row['parent'] == ""){
      $rowParent = "????????????";
    }
    
    
    
    if (strlen($row['title']) > $maxPos)
    {
        $lastPos = ($maxPos - 3) - strlen($row['title']);
          $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . ' 
 ...';
      $filtTit = str_replace('"', '', $row['title']); 
    } 
    if($row['frame_color'] == ""){
      $frameColor = "rgb(0, 0, 0, 0.0)";
    }
    else{
      $frameColor = $row['frame_color'];
    }
    if($row['title_badge'] == ""){
      $titleBadge = "";
    }
    else{
      $titleBadge = '<img src="../admin/'.$row['title_badge'].'" class="titleBadge" />';
    }
    if($row['type'] == 'video'){
      $fc_icon = '<div class="fcIconVid"><i class="fa fa-play-circle" aria-hidden="true"></i></div>';
    }
    else{
      $fc_icon = '';
    }
    
    if($row['type'] == 'video'){
       $fc_link = 'video_content';
  }
  elseif($row['type'] == 'podcast'){
      $fc_link = 'podcast';
  }
  elseif($row['type'] == ''){
      $fc_link = 'article_content';
  }
  else{
     $fc_link = 'article_content';
  }
    
          echo '
      <div class="col-md-4">    
      <div class="card col-sm-4 col-md-3 newsCard">
        <div class="card-content">
    
    <a href="'.$fc_link.'.php?code='.$row['code'].'">
    <div class="imgFrame">
          <div class="imgTitle">
             <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
            <img class="cardPhoto" src="../images/'.$row['photo'].'" height="122px" alt="'.$row['title'].'" />
            '.$fc_icon.'
            </div>
     </div>   
      </a>    
        <div class="card-body">
              <a href="'.$fc_link.'.php?code='.$row['code'].'" class="cardLink"> <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="'.$row['title'].'">'.$titleBadge.''.$rowtitle.'</h6></a>
          <div class="cardFoot clearfix">
            <div class="cardCat">
             <div class="btn-group dropend shareIcon">
            <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
            </a>
            <ul class="dropdown-menu">
             <li><h6 class="dropdown-header">Share</h6></li>
              <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i> Facebook</a></li>
              <li><a class="dropdown-item" href="https://twitter.com/share?url=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i> Twitter</a></li>
              <li><a class="dropdown-item" href="whatsapp://send?text=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'" data-action="share/whatsapp/share"><i class="fab fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
              <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=https://www.ukrzmi.com/desktop/'.$fc_link.'.php?code='.$row['code'].'&media=https://www.ukrzmi.com/images/'.$row['photo'].'&description='.$row['title'].'" target="_blank"><i class="fab fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="full_coverage.php?id='.$row['id'].'" target="_blank"><i class="fa fa-clipboard" aria-hidden="true"></i> Full Coverage</a></li>
              <li><a class="dropdown-item" href="#" target="_blank"><i class="fa fa-flag" aria-hidden="true"></i> Report</a></li>
            </ul>
          </div>
    
        <p class="cardTime">'.timeago($row['time']).'</p>  
    
        <div class="ellipBox">
          <p class="cardEllip"></p>
        </div>
        
    <p class="cardCategory">'.$row['category'].'</p>
             </div>
          </div>
        </div>
       
        
      </div>
      </div>    </div>
      ';
     // echo $row['full_coverage'];
    }
?>
 </div></div>