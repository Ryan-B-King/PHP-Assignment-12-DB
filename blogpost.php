<?php

    // INITIALIZE VARIABLE
    $msg="";

    // RETRIEVE FORM VALUES
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = htmlspecialchars(trim(addslashes($_POST["blogtitle"])));
        $entry = htmlspecialchars(trim(addslashes($_POST["blogentry"])));
    } else {
        exit("There is a problem.");
    }

    $dsn = "mysql:host=localhost;dbname=myblog"; // DATA SOURCE HOST AND DB NAME
    $username = "root";
    $password = "";

    // CHECK CONNECTION AND INSERT USING TRY/CATCH STATEMENT
    try {

        $conn = new PDO($dsn, $username, $password);

        // SET THE PDO ERROR MODE TO EXCEPTION
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // print "Connection is sucessful<br><br>\n\r";

        // CREATE SQL QUERY
        $sql = "INSERT INTO my_table (Title, Entry) VALUES ('$title', '$entry')";

        // EXECUTE THE STATEMENT - QUERY() IS NOT USED BECAUSE NO RECORDS ARE RETURNED
        $conn ->exec($sql);
        print "The record was successfully entered\n\r";
        $msg = "Thank you for submitting a blog post! You may see your entry <a href='blog_home.php'>Here</a>.";
   
    } catch (PDOException $e) {

        $error_message = $e->getMessage();
        print "An error occured: $error_message";

    } // END TRY CATCH

    $conn = null; // DISCONNECT FROM DB

?>

<!DOCTYPE html><!-- Ryan King -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserting Date into the Database</title>
</head>
<body>
    <header>
        <h1>Blog Post Results</h1>
    </header>
    <p><?php print $msg; ?></p> <!-- DISPLAY SUCCESS OR ERROR MESSAGE -->
</body>
</html>