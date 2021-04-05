<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookindex";

$id = (int)$_POST["id"];

if($id){
    //enable special error reporting
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    $conn->select_db("bookindex");

    conn->autocommit(false); //begins transaction

    $statement = $conn->prepare('DELETE FROM books WHERE book_id = ?');
    $statement->bind_param('i',$_POST["id"]);
    $statement->execute();
    $statement = $conn->prepare('DELETE FROM articles WHERE book_id = ?');
    $statement->bind_param('i',$_POST["id"]);
    $statement->execute();
    $statement = $conn->prepare('DELETE FROM keywords WHERE book_id = ?');
    $statement->bind_param('i',$_POST["id"]);
    $statement->execute();
    $statement = $conn->prepare('DELETE FROM reviews WHERE book_id = ?');
    $statement->bind_param('i',$_POST["id"]);
    $statement->execute();
    $statement = $conn->prepare('DELETE FROM inspirations WHERE book_id = ? OR inspiration_id = ?');
    $statement->bind_param('ii',$_POST["id"],$_POST["id"]);
    $statement->execute();

    if($conn->commit()!=TRUE){
        echo "\nError: ".$conn->error;
    }else{
        echo "Book removed successfully!";
    }
    
    $conn->autocommit(true);

    $conn->close();

}else{
    echo "Error: no book ID";
}

?>