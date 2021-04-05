<!-- <html>

<head>
  <title>Add a User</title>
</head>

<body> -->
    <?php
    


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookindex";
    // check db creation scripts in db-utility
    

    $name = $_POST["name"];
    $pass = $_POST["pass"];
    $role = $_POST["role"];
    if($name && $pass && $role){
        $conn = new mysqli($servername, $username, $password);
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
        $conn->select_db("bookindex");

        //this is probably vulnerable to injection now that I think abt it
        $passHash = hash("sha256",$pass); //make a hash of the password to store and compare to (more secure)
        // echo "Password ".$pass." hashed in sha1 to ".$passHash;
        $sql = "INSERT INTO users(username,password,role)
        VALUES('".$name."','".$passHash."',".$role.");";
 
        if($conn->query($sql)!=TRUE){
            echo "\nError: ".$conn->error;
        }else{
            echo "User added successfully.";
        }


        $conn->close();

    }else{
        echo "Error: missing username, password or role number!";
    }
    
    ?>

<!-- </body>
</html> -->