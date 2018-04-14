<?php
header('Access-Control-Allow-Origin: *');

if(isset($_GET['type'])){


$type = $_GET['type'];

// insert a story
if($type == 'newstory' || $type == 'newstory'){
     $story = $_GET['data'];
     $userid = $_GET['id'];

  try {
        $host = '127.0.0.1';
        $dbname = 'test';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch(PDOException $e) {echo 'Error';}  

    $sql = "INSERT INTO `data` (`userid`, `story`) VALUES (?, ?);";
    $sth = $DBH->prepare($sql);
	
	$sth->bindParam(1, $userid, PDO::PARAM_INT);
	$sth->bindParam(2, $story, PDO::PARAM_INT);
	
	$sth->execute();
    
 



}
else if($type == 'getmystories'){

  $userid = $_GET['id'];

  try {
        $host = '127.0.0.1';
        $dbname = 'test';
        $user = 'root';
        $pass = '';
        # MySQL with PDO_MYSQL
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch(PDOException $e) {echo 'Error';}  

    $sql = "select * from data where userid = ?";
    $sth = $DBH->prepare($sql);
	
	$sth->bindParam(1, $userid, PDO::PARAM_STR);
		
	$sth->execute();

       $result = $sth->fetchAll(PDO::FETCH_ASSOC);
       foreach($result as $item){
         echo $item['story'] . '<br>';
       }

}
elseif($type == 'top10stories'){

echo '{
	"news": {
		"story": [
			" Trump has been elected ",
			" CCT shown to be the best college ever",
			" Trinity College closes doors one last time",
			" Pet dog shown how to drive car",
			" Java used for the last time, replaced by python",
			" Irish president has been nominated",
			" Word peace has finally been achieved",
			" Back to the future film released",
			" Another story",
			" Out of news at this point..."
		]
	}
}';


} 
elseif($type == 'currentauthors'){

echo '{
	"authors": {
		"author": [
			" John Smith",
			" Alex Murphy",
			" Philip Brennan",
			" James Cambell",
			" Ronald McDonald",
			" Graham Glanville",
			" Kyle Goslin"
		]
	}
}';

}


}

if(isset($_GET['type']) == False){
echo 'Looks like your missing the type parameter from the URL try change the URL to db.php?type=top10stories';
}