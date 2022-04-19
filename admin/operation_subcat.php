<?php
set_time_limit(500); // 

Class Database{
 
	private $server = "mysql:host=localhost;dbname=tsavosto_news";
	private $username = "tsavosto_news";
	private $password = "[VLh_tR&489,";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES cp1251",);
	protected $conn;
 	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "There is some problem in connection: " . $e->getMessage();
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
}

$pdo = new Database();
 

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM news WHERE NOT sub_1=:sub_1");
$stmt->execute(['sub_1'=>""]);
$op1 = $stmt->fetchAll();
foreach($op1 as $row){
   $stmt = $conn->prepare("SELECT * FROM category WHERE name=:name");
   $stmt->execute(['name'=>$row['category']]);
   $op2 = $stmt->fetch();
 
   $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM sub_cat WHERE name=:name");
   $stmt->execute(['name'=>$row['sub_1']]);  
   $auth = $stmt->fetch();

   if($auth['numrows'] > 0){
   echo 'Already in the DB!!!<br/>';
   }
   else{
   $stmt = $conn->prepare("INSERT INTO sub_cat (name, category) VALUES (:name, :category)");
   $stmt->execute(['name'=>$row['sub_1'], 'category'=>$op2['id']]); 
   echo 'Inserted!!!<br/>';
   }

}

echo 'finished!!!';

?>