<?php
include '../includes/conn.php';
session_start();
if(!isset($_FILES['image']['name'])){
    $_SESSION['error'] = 'An error occured while process your request!';
    header('location: ../manual_view.php');
}
else{
    $conn = $pdo->open();
$title =  $_POST['title'];
$source = $_POST['source'];
$deep_link = $_POST['deep_link'];
$category = $_POST['category'];
$author = $_POST['author'];
$content = $_POST['content'];
$frame_color = $_POST['frame_color'];
$tag_1 = $_POST['tag_a'];
$tag_2 = $_POST['tag_b'];
$tag_3 = $_POST['tag_3'];
$title_badge = $_POST['title_badge'];
$meta_title = $_POST['meta_title'];
$meta_desc = $_POST['meta_desc'];
$meta_keywords = $_POST['meta_keywords'];
$post_date = $_POST['postDate'];

$published = date("D, d M Y H:i:s");
$input = "manual";

$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$code = 'ukrzmi_'.substr(str_shuffle($set), 0, 12);

$stmt = $conn->prepare("SELECT * FROM blocks");
$stmt->execute();
$blocks = $stmt->fetchAll();

////////////////check whether the card was pinned
foreach($blocks as $row){
    if($_POST['pinCard'.$row['id']] != ""){
   $pin = 1;
   break;
    }
    else{
        $pin = 0;
    }
}

////////////////process the image sent
$photo = $_FILES['image']['name'];
$photo_path = realpath($_FILES['image']['name']);
$ext = pathinfo($photo, PATHINFO_EXTENSION);
$time_id = time();
$the_id = sha1($time_id);
$new_filename = $the_id.'.'.$ext;
 move_uploaded_file($_FILES['image']['tmp_name'], '../../images/'.$new_filename);
 $filename = $new_filename;


//////////////////////process content type
$type = $_POST['type'];
if($type == 'video'){   
    $video_link = $_POST['video_url'];
    if($video_link != ''){
        $video_url = $video_link;
    }
    else{
        $type = '';
        $video_url = '';
    }
}
else{
    $video_url = '';
}

////////////////upload article to the database
$stmt = $conn->prepare("INSERT INTO news (
    source,
    deep_link,
    title,
    published,
    author,
    article,
    tag_1,
    tag_2,
    tag_3,
    photo,
    category,
    time,
    code,
    type,
    frame_color,
    title_badge,
    meta_title,
    meta_desc,
    meta_keywords,
    post_date,
    pin,
    input,
    post_status,
    video_url
) VALUES (
    :source,
    :deep_link,
    :title,
    :published,
    :author,
    :article,
    :tag_1,
    :tag_2,
    :tag_3,
    :photo,
    :category,
    :time,
    :code,
    :type,
    :frame_color,
    :title_badge,
    :meta_title,
    :meta_desc,
    :meta_keywords,
    :post_date,
    :pin,
    :input,
    :post_status,
    :video_url

)");
$stmt->execute([
    'source'=>$source,
    'deep_link'=>$deep_link,
    'title'=>$title,
    'published'=>$published,
    'author'=>$author,
    'article'=>$content,
    'tag_1'=>$tag_1,
    'tag_2'=>$tag_2,
    'tag_3'=>$tag_3,
    'photo'=>$filename,
    'category'=>$category,
    'time'=>$published,
    'code'=>$code,
    'type'=>$type,
    'frame_color'=>$frame_color,
    'title_badge'=>$title_badge,
    'meta_title'=>$meta_title,
    'meta_desc'=>$meta_desc,
    'meta_keywords'=>$meta_keywords,
    'post_date'=>$post_date,
    'pin'=>$pin,
    'input'=>$input,
    'post_status'=>1,
    'video_url'=>$video_url
]);
$cardid = $conn->lastInsertId();
////////////////record pinned card to its specific block
foreach($blocks as $row){
    if($_POST['pinCard'.$row['id']] != ""){
   $position = $_POST['cardPosition'.$row['id']];
   $pin_from = $_POST['pinFrom'.$row['id']];
   $pin_to = $_POST['pinTo'.$row['id']];
   $block_id = $row['id'];
   
   $stmt = $conn->prepare("INSERT INTO pinned (block_id, card_id, pinned_from, pinned_to, position) VALUES (:block_id, :card_id, :pinned_from, :pinned_to, :position)");
   $stmt->execute(['block_id'=>$block_id, 'card_id'=>$cardid, 'pinned_from'=>$pin_from, 'pinned_to'=>$pin_to, 'position'=>$position]);

    }
}

////////////////////////////////////////////////////////////record pinned card to its specific block on pages
for ($x = 0; $x <= 40; $x++){
    if($_POST['pinCardd'.$x] != ""){
        $position = $_POST['cardPositionn'.$x];
        $pin_from = $_POST['pinFromm'.$x];
        $pin_to = $_POST['pinToo'.$x];
        $pin_page = $_POST['cardPage'.$x];
        $block_id = $x;
        
        $stmt = $conn->prepare("INSERT INTO pinned (block_id, card_id, pinned_from, pinned_to, position, page) VALUES (:block_id, :card_id, :pinned_from, :pinned_to, :position, :page)");
        $stmt->execute(['block_id'=>$block_id, 'card_id'=>$cardid, 'pinned_from'=>$pin_from, 'pinned_to'=>$pin_to, 'position'=>$position, 'page'=>$pin_page]);
     
         }
    }


$_SESSION['success'] = 'New article added successfully!';
header('location: ../manual_view.php');



}
?>