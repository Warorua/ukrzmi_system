<div class="card-header d-flex justify-content-between bg-white p-0 m-0">
          <h3 class="newsHead">Previously seen</h3>
               <div class="">
                <a href="all_content.php?page=<?php echo $page ?>&A0034=LoPHH8986&block_id=<?php echo $block_id ?>&cat_id=<?php echo $_GET['cat_id'] ?>" class="btn btn-outline-dark btn-sm">All headlines</a>
                </div>
          <div class="card-tools">
             <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>



<div class="col-md-3">    
  <div class="card col-sm-4 col-md-3 newsCard">
    <div class="card-content">
<div class="imgFrame">
      <div class="imgTitle">
        <div class="cardFrame d-flex align-items-center justify-content-center" style="border-color: grey;">
      <tx class="text-secondary text-center">Previous seen headlines</tx>
      </div>   
    </div>
 </div>   
 <a href="#" class="stretched-link"> </a>        
  </div>
  </div>    
</div>

<?php
if(1 == 1){
 if(isset($_GET['subcat'])){
  $block_news_1 = array_slice($block_news_orig,0,40);
 }
 elseif(isset($_GET['A0034'])){
  $block_news_1 = array_slice($block_news_orig,0,48);
 }
 else{
   $block_news_1 = array_slice($block_news_orig,40,40);
 }


$block_news_list = $block_news;
$allcount = sizeof($block_news)-1;
foreach($block_news_1 as $row){
$rowtitle = $row['title'];  

$maxPos = 500;
if($row['sub_1'] != ''){
  $catHolder = $row['sub_1'];
 }else{
   $catHolder = 'General';
 }
if($row['parent'] == "ua.korrespondent.net"){
  $rowParent = "Кореспондент";
}
elseif($row['parent'] == "pravda.com.ua"){
  $rowParent = "правда";
}
elseif($row['parent'] == "eurointegration.com.ua"){
  $rowParent = "євроінтеграція";
}
elseif($row['parent'] == "unian.ua"){
  $rowParent = "уніанської";
}
elseif($row['parent'] == "life.pravda.com.ua"){
  $rowParent = "правда";
}
elseif($row['parent'] == "theguardian.com"){
  $rowParent = "The guardian";
}
elseif($row['parent'] == ""){
  $rowParent = "правда";
}



if (strlen($row['title']) < $maxPos){
  $rowtitle = $row['title'];
  $filtTit = str_replace('"', '', $row['title']);
}
else{
    $lastPos = ($maxPos - 3) - strlen($row['title']);
      $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . '...';
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
////////////////////////////////////////////////
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
  <div class="col-md-3 post">    
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
            <i class="fa fa-ellipsis-v text-dark" aria-hidden="true"></i>
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
}
}
//for ($x = 0; $x <= 48; $x++) {}
$_SESSION['all_content_items'] = $block_news;
?>  
