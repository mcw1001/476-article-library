<?php
/**
 * given a book id
 * 
 * 
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookindex";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$conn->select_db("bookindex");
// 
$id = (int)$_POST["id"];
// $id=1;


$inStack = getInspiration($conn,$id);

//check for initial error or nones
if(array_key_exists("ERROR",$inStack)){
    echo "Error: ".$inStack["ERROR"];
}else if(array_key_exists("NONE",$inStack)){
    echo $inStack["NONE"];
}else{
    $foundStack=[];
    $finalJsonArray=[];
    while(!empty($inStack)){
        $tid = array_pop($inStack);
        //if
        if(!isset($foundStack[$tid])){
            $foundStack[]=$tid;
            $book = getBook($conn,$tid);
            //add book to array, jsonify later
            if(!is_string($book)){
                $finalJsonArray[$tid]=$book;                
            }
            $tidIns = getInspiration($conn, $tid);
            if(!array_key_exists("ERROR",$tidIns) && !array_key_exists("NONE",$tidIns)){
                foreach($tidIns as $ins){
                    if(!in_array($ins,$foundStack,true) and !in_array($ins,$inStack,true)){
                        $inStack[]=$ins;
                    }
                }
            }

        }
    }
    $json = json_encode($finalJsonArray);//,JSON_PRETTY_PRINT);
    echo $json;

}


$conn->close();





function getInspiration($mysqli, $id){
    $sql="SELECT * FROM inspirations WHERE book_id=$id LIMIT 100";
    $result = $mysqli->query($sql);
    
    $returnStr="";
    $arr = [];
    $arr["NONE"]= "No inspiration found."; //default state, overridden if anything else
    if($result === FALSE){
        // $returnStr= "\nError: ".$mysqli->error;
        $arr = [];
        $arr["ERROR"]=$mysqli->error;
    }else{
        if($result->num_rows > 0){
            $arr = [];
            //encode in JSON then convert to string?
            // $books=[];
            while ($row = $result->fetch_assoc()) {
                // $returnStr .= $row["keyword"]." ";
                $arr[]= $row["inspiration_id"];
            }
            // $json=json_encode($books);
            // $returnStr.=$json;
    
        }
        
    }
    return $arr;
}


function getBook($mysqli, $id){
    $sql="SELECT * FROM books WHERE book_id=$id";

    $result = $mysqli->query($sql);
    if($result === FALSE){
        return "ERROR ".$conn->error;
    }else if ($result->num_rows<1){
        return "NONE";
    }
    return $result->fetch_assoc();
    // $json = json_encode($result->fetch_assoc());
    // return $json;
}
?>