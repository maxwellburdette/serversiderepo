<!-- 
    File: dbfCreate.php (Web page to create new database and tables. Populate table data and display it)
    Server Side Development / Project: Crud
    Maxwell Burdette / burdettm@csp.edu
    03/27/2021
 -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="dbf.css">
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
            runQuery($sql, "Deleted previous DB", false);

            //Function to create new database
            createDatabase();

            //Function to populate same data in tables
            populateTables();

            //Display product table
            $productHead = array("Product Name", "Color", "Price", "Quantity", "Product Page");
            $tableTitle = "Product Data";
            $sql = "SELECT productName, color, price, quantity, productPage
            FROM product";
            $result = $conn->query($sql);
            displayTable($productHead, $tableTitle, $result);

            //Display department table
            $departmentHead = array("Department", "Department Manager");
            $departmentTitle = "Department Data";
            $sql = "SELECT departmentName, departmentManager FROM department";
            $result = $conn->query($sql);
            //Display tables of data
            displayTable($departmentHead, $departmentTitle, $result);

            //Display manufacturer tables
            $manufacturerArray = array("Manufacturer", "Website");
            $manufacturerTitle = "Manufacturer Data";
            $sql = "SELECT manufactureName, manufactureWebsite FROM manufacturer";
            $result = $conn->query($sql);
            displayTable($manufacturerArray, $manufacturerTitle, $result);



            //Create our database
            function createDatabase()
            {
                global $conn;
                $sql = "CREATE DATABASE IF NOT EXISTS " . DATABASE_NAME;
                runQuery($sql, "Creating " . DATABASE_NAME, true);

                //Select newly created database
                $conn->select_db(DATABASE_NAME);

                /*
                 * Create tables 
                 */

                //Create Table: Products
                $sql = "CREATE TABLE IF NOT EXISTS product (
                    productID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    productName VARCHAR(20) NOT NULL,
                    color VARCHAR(20) NOT NULL,
                    price decimal(18,2) NOT NULL,
                    quantity INT,
                    productPage VARCHAR(65),
                    manufacturerID INT,
                    departmentID INT
                    )";
                runQuery($sql, "Creating products... ", true);

                //Create Table: department
                $sql = "CREATE TABLE IF NOT EXISTS department (
                    departmentID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    departmentName VARCHAR(15) NOT NULL,
                    departmentManager VARCHAR(15)
                    )";
                runQuery($sql, "Creating departments...", true);

                //Create Table: manufacturer
                $sql = "CREATE TABLE IF NOT EXISTS manufacturer (
                    manufacturerID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    manufactureName VARCHAR(20) NOT NULL,
                    manufactureWebsite VARCHAR(65) NOT NULL,
                    departmentID INT
                )";
                runQuery($sql, "Creating manufacturers...", true);
            }

            function populateTables()
            {
                /*
                 * Populate tables
                 */

                 //Populate product table
                $productArray = array(
                    array("Bath Towel", "Black", 5.75, 75, "http://MyStore.com/bathtowel.php", 1, 1),
                    array("Wash Cloth", "White", 0.99, 225, "http://MyStore.com/washcloth.php", 1, 1),
                    array("Shower Curtain", "White", 11.99, 73, "http://MyStore.com/showercurtain.php", 2, 1),
                    array("Pantry Organizer", "Clear", 3.99, 52, "http://MyStore.com/pantryorganizer.php", 2, 2),
                    array("Storage Jar", "Clear", 5.99, 18, "http://MyStore.com/storagejar.php", 2, 2),
                    array("Firm Pillow", "White", 12.99, 24, "http://MyStore.com/pillow.php", 1, 3),
                    array("Comforter", "White", 34.99, 12, "http://MyStore.com/comforter.php", 3, 3),
                    array("Rollaway Bed", "Black", 249.99, 3, "http://Mystore.com/rollaway.php", 3, 3)

                );
                foreach($productArray as $product)
                {
                    //echo $product[0] . " " . $product[1] . "<br />";
                    $sql = "INSERT INTO product (productName, color, price, quantity, productPage, manufacturerID, departmentID) "
                        . "VALUES ('" . $product[0] . "', '" 
                        . $product[1] . "', '" 
                        . $product[2] . "', '"
                        . $product[3] . "', '"
                        . $product[4] . "', '"
                        . $product[5] . "', '"
                        . $product[6] . "')";
                    runQuery($sql, "Record inserted for: " . $product[1], false);
                }

                //Populate department tables
                $departmentArray = array(
                    array("Bath", "Michael"),
                    array("Kitchen", "John"),
                    array("Bedroom", "Liz"),
                );
                foreach($departmentArray as $department)
                {
                    //echo "Department: " . $department[0] . ", Manager: " . $department[1] . "<br />";
                    $sql = "INSERT INTO department (departmentName, departmentManager) "
                        . "VALUES ('" . $department[0] . "', '"
                        . $department[1] . "')";
                    runQuery($sql, "Record inserted for: " . $department[1], false);
                }

                //Populate manufacturer table
                $manufacturerArray = array(
                    array("Cannon", "http://www.cannonhome.com/", 1),
                    array("InterDesign", "http://www.interdesignusa.com/", 2),
                    array("LinenSpa", "http://www.linenspa.com/", 3),
                    array("Dell", "http://dell.com/", 4),
                    array("Samsung", "http://samsung.com/", 5)
                );
                foreach($manufacturerArray as $manufacturer)
                {
                    //echo "Manufacturer: " . $manufacturer[0] . "<br />";
                    $sql = "INSERT INTO manufacturer (manufactureName, manufactureWebsite, departmentID) "
                        . " VALUES ('" . $manufacturer[0] . "', '" 
                        . $manufacturer[1] . "', '"
                        . $manufacturer[2] . "')";
                    runQuery($sql, "Record inserted for: " . $manufacturer[1], false);
                }
            }

            function displayTable($tableHead, $title, $result)
            {
                echo "<h2>".$title."</h2>";
		        echo '<table>';
		        echo '<tr>';
                foreach($tableHead as $value)
                {
                    echo "<th>".$value."</th>";
                }
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
                echo '</tr>';
                echo "</table>";
                echo '<br />';
            }

            function runQuery($sql, $msg, $echoSuccess) {
                global $conn;
         
                // run the query
                if ($conn->query($sql) === TRUE) {
                   if($echoSuccess) {
                      echo $msg . "<br />";
                   }
                 } 
                 else {
                     echo "<strong>Error when: " . $msg . "</strong> using SQL: " . $sql . "<br />" . $conn->error;
                 }           
             } // end of runQuery( ) 

        ?>
    </body>
</html>