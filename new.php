<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Create Store Database </h1>
        <?PHP
            // Set up connection constants
            define("SERVER_NAME","localhost");
            define("DBF_USER_NAME", "root");
            define("DBF_PASSWORD", "mysql");
            define("DATABASE_NAME", "storedatabase");
            // Using default username and password for AMPPS  

            // Create connection object
            $conn = new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //DROP table if it already exists
            $sql = "DROP DATABASE IF EXISTS " . DATABASE_NAME;
            runQuery($sql, "Deleted previous DB", true);
            //Create our database
            function createDatabase()
            {

            }

            function populateTable()
            {

            }

            function displayTable()
            {

            }

            function runQuery($sql, $msg, $echoSuccess) {
                global $conn;
         
                // run the query
                if ($conn->query($sql) === TRUE) {
                   if($echoSuccess) {
                      echo $msg . " successful.<br />";
                   }
                 } 
                 else {
                     echo "<strong>Error when: " . $msg . "</strong> using SQL: " . $sql . "<br />" . $conn->error;
                 }           
             } // end of runQuery( ) 

        ?>
    </body>
</html>