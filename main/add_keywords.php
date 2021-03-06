
<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookindex";
// check db creation scripts in db-utility

/**
 * post data: {name: txtTitle, author: txtAuthor, publisher: txtPublisher,
 *               publishdate: datePublished, description: txtDescription,
 *  reception: txtReception, keywords: txtKeywords}
         
    */

$id = (int)$_POST["id"];
//split keyword string into array of keywords, by whitespace, comma, or newline
if($_POST["keywords"]!=''){
    $keywords = preg_split('/[\ \n\,]+/',trim($_POST["keywords"]));
}else{$keywords=NULL;}
if($id && $keywords){
    // $errorFlag=0;
    //enable special error reporting
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    $conn->select_db("bookindex");
    foreach($keywords as $keyword){
        echo $keyword."\n";
        $statement = $conn->prepare("INSERT INTO keywords(book_id,keyword) VALUES(?, ?)");
        $statement->bind_param('is',$id,$keyword);
        if($statement->execute()!=TRUE){
            echo "\nError: ".$conn->error;
            // $errorFlag=1;
            break;
        }
    }

    $conn->close();

}else{
    echo "Error: missing information!";
}

?>