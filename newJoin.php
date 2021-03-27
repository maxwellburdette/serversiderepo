<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="new.css">
    </head>
    <body>
        <?PHP
            //Set up connection contstants
            //Default aamps properties
            define("SERVER_NAME","localhost");
            define("DBF_USER_NAME", "root");
            define("DBF_PASSWORD", "mysql");
            define("DATABASE_NAME", "storedatabase");

            //Create connection object
            $conn = new mysqli(SERVER_NAME, DBF_USER_NAME, DBF_PASSWORD);
            //Check connection
            if($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //Select database
            $conn->select_db(DATABASE_NAME);

            //JOIN
            echo "<h2>JOIN<h2>";
            $sql = "SELECT product.productName, product.color, product.price, product.quantity, 
                product.productPage, department.departmentName, manufacturer.manufactureName 
                FROM department 
                JOIN product 
                ON product.departmentID = department.departmentID 
                JOIN manufacturer 
                ON product.manufacturerID = manufacturer.manufacturerID";
            echo "<pre>".$sql."</pre>";
            $result = $conn->query($sql);
            displayResult($result, $sql);
            echo "<br />";

            //LEFT OUTER JOIN
            echo "<h2>LEFT OUTER JOIN<h2>";
            $sql = "SELECT m.manufactureName, m.manufactureWebsite, p.productName
                FROM manufacturer m 
                LEFT JOIN product p 
                ON p.manufacturerID = m.manufacturerID";
            echo "<pre>".$sql."</pre>";
            displayResult($result, $sql);
            echo "<br />";


            //Displays query results
            function displayResult($result, $sql) {
                if ($result->num_rows > 0) {
                    echo "<table border='1'>\n";
                    // print headings (field names)
                    $heading = $result->fetch_assoc( );
                    echo "<tr>\n";
                    // Print field names as table headings
                    foreach($heading as $key=>$value){
                        echo "<th>" . $key . "</th>\n";
                    }
                    echo "</tr>";
                    // Print the values for the first row
                    echo "<tr>";
                    foreach($heading as $key=>$value){
                        echo "<td>" . $value . "</td>\n";
                    }
                    // Output the rest of the records
                    while($row = $result->fetch_assoc()) {
                        //print_r($row);
                        //echo "<br />";
                        echo "<tr>\n";
                        // print data
                        foreach($row as $key=>$value) {
                        echo "<td>" . $value . "</td>\n";
                        }
                        echo "</tr>\n";
                    }
                    echo "</table>\n";
                }
                // No results
                else {
                   echo "<strong>zero results using SQL: </strong>" . $sql;
                }
       
            } 

        ?>
    </body>
</html>