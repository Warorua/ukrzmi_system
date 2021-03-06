
<style>
  .slickk-next-<?php echo $block[0]['name']; ?>{
  width: 100%;
}
.slickk-prev-<?php echo $block[0]['name']; ?>{
  width: 100%;
}

</style>
<?php //echo $block[0]['name']; ?>
<h2 class="newsHead"><?php echo $block[0]['name']; ?></h2>
<div style="background-color:<?php echo $block[0]['bg_color']; ?>" class="cardBlock carousel-<?php echo $block[0]['name']; ?>">
<?php
if($block[0]['active'] == 1){

$stmt = $conn->prepare("SELECT * FROM news 
WHERE NOT category=:cat_not
AND type=:type
AND pin=:pin
ORDER BY id");
$stmt->execute(['cat_not'=>'international', 'type'=>"", 'pin'=>2]);
$block_news_orig = $stmt->fetchAll();


$stmt = $conn->prepare("SELECT * FROM pinned
LEFT JOIN news ON pinned.card_id = news.id 
WHERE NOT category=:cat_not
AND type=:type
AND pin=:pin
AND block_id=:block_id
  AND page=:page
 
ORDER BY pinned.position ASC");
$stmt->execute(['cat_not'=>'international', 'page'=>'', 'type'=>"", 'pin'=>1, 'block_id'=>$block[0]['id']]);
$block_news_pinned = $stmt->fetchAll();
foreach($block_news_pinned as $value => $row){
   $pos = $row['position'];      
  $val = Array
        (
            'id' => $row['id'],
            'position' => $row['position'],
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

$block_news = array_merge(array_slice($block_news_orig, 0, $pos), array($val), array_slice($block_news_orig, $pos));

$block_news_orig = $block_news;

}


foreach($block_news as $row){
$rowtitle = $row['title'];  

$maxPos = 92;
if($row['sub_1'] != ''){
  $catHolder = $row['sub_1'];
 }else{
   $catHolder = '??????????????????????';
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
if (strlen($row['title']) < $maxPos){
  $rowtitle = $row['title'];
  $filtTit = str_replace('"', '', $row['title']);
}
else{
    $lastPos = ($maxPos - 3) - strlen($row['title']);
      $rowtitle = substr($row['title'], 0, strrpos($row['title'], ' ', $lastPos)) . '...'; 
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

      echo '
  <div class="card col-sm-4 col-md-3 newsCard" style="background-color:'.$block[0]['bg_color'].'">
    <div class="card-content">

<a href="article_content.php?code='.$row['code'].'">
<div class="imgFrame">
      <div class="imgTitle">
         <p class="blogTitle">'.$rowParent.'</p>
        <div class="cardFrame" style="border-color: '.$frameColor.';"></div>
        <img class="cardPhoto" src="https://www.ukrzmi.com/images/'.$row['photo'].'" height="122px" alt="'.$row['title'].'" />
    </div>
 </div>   
  </a>    
    <div class="card-body">
          <a href="article_content.php?code='.$row['code'].'" class="cardLink"> <h6 class="cardHead" data-toggle="tooltip" data-placement="bottom" title="'.$row['title'].'">'.$titleBadge.''.$rowtitle.'</h6></a>
      <div class="cardFoot clearfix">
        <div class="cardCat">
         <div class="btn-group dropend shareIcon">
        <a type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
        </a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
         <li>
         <a class="dropdown-item trigger right-caret">Share</a>
         <ul class="dropdown-menu sub-menu">
         <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i> Telegram</a></li>
         <li><a class="dropdown-item" href="https://twitter.com/share?url=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Viber</a></li>
          <li><a class="dropdown-item" href="https://www.facebook.com/sharer.php?u=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
          <li><a class="dropdown-item" href="https://twitter.com/share?url=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
          <li><a class="dropdown-item" href="whatsapp://send?text=http://localhost/news/desktop/article_content.php?code='.$row['code'].'" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i> Whatsapp</a></li>
          <li><a class="dropdown-item" href="https://pinterest.com/pin/create/button/?url=http://localhost/news/desktop/article_content.php?code='.$row['code'].'&media=https://localhost/news/scrap2/images/'.$row['photo'].'&description='.$row['title'].'" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> Pinterest</a></li>
          
         </ul>
         </li>
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
  </div>
  ';
}
}
//for ($x = 0; $x <= 48; $x++) {}
?>
  
</div>
<div style="background-color:<?php echo $block[0]['bg_color']; ?>" class="cardBlock container">
  <div class="d-flex justify-content-between">
   <button id="carPrev<?php echo $block[0]['name']; ?>" type="button" data-role="" class="slickk-prev-<?php echo $block[0]['name']; ?> btn btn-outline-dark btn-sm w-25" <?php if(isset($hide_control_button)){echo $hide_control_button;} ?>>Previous</button>
  <button id="carNext<?php echo $block[0]['name']; ?>" type="button" data-role="" class="slickk-next-<?php echo $block[0]['name']; ?> btn btn-outline-dark btn-sm w-25" <?php if(isset($hide_control_button)){echo $hide_control_button;} ?>>Next</button>
  </div>
 
  
</div>
<script>
    
    var slickopts = {
  slidesToShow: 4,
  slidesToScroll: 4,
  loop: false,
  swipe:false,
  infinite: false,
  arrows: false,
  // prev arrow
  //prevArrow:'<button type="button" id="prevBtn" data-role="none" class="slick-prev btn btn-primary">Previous</button>',
  // next arrow
  //nextArrow:'<button type="button" id="nxtBtn" data-role="none" class="slick-next btn btn-primary">Next</button>',
  rows: 2, // Removes the linear order. Would expect card 5 to be on next row, not stacked in groups.

};

$('.carousel-<?php echo $block[0]['name']; ?>').on('init',function(event, slick){
  document.getElementById('carPrev<?php echo $block[0]['name']; ?>').style.display = 'none';
});

// On before slide change
$('.carousel-<?php echo $block[0]['name']; ?>').on('afterChange', function(event, slick, currentSlide){
  
  let CarNo = $('.carousel-<?php echo $block[0]['name']; ?>').slick('slickCurrentSlide');
  //alert('['+ CarNo+']');
  if (CarNo==0) {
    //alert('this is page 0')
    document.getElementById('carPrev<?php echo $block[0]['name']; ?>').style.display = 'none';
  }
  else if(CarNo!=0){
    document.getElementById('carPrev<?php echo $block[0]['name']; ?>').style.display = '';
  }
  if (CarNo==8) {
    //alert('this is page 0')
    document.getElementById('carNext<?php echo $block[0]['name']; ?>').style.display = 'none';
  }
  else if(CarNo!=8){
    document.getElementById('carNext<?php echo $block[0]['name']; ?>').style.display = '';
  }


});

$('.slickk-prev-<?php echo $block[0]['name']; ?>').click(function(e){ 
      	//e.preventDefault(); 
		$('.carousel-<?php echo $block[0]['name']; ?>').slick('slickPrev');
	} );
	
	$('.slickk-next-<?php echo $block[0]['name']; ?>').click(function(e){
		//e.preventDefault(); 
		$('.carousel-<?php echo $block[0]['name']; ?>').slick('slickNext');
	} );  


$('.carousel-<?php echo $block[0]['name']; ?>').slick(slickopts);
</script>


