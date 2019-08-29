<?php


$hold = array();
$a = 0;
$table1 = false;
$table2 = false;
$table3 = false;


$servername = "localhost";
$username = "guest";
$password = "guest123";
$dbname = "shopDB";

//Creates Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


//Check Connection
if(!$conn){
    die("Failed To Connect" . mysqli_connect_error());
}

//Checks if tables already created
$alltables = mysqli_query($conn,"show tables");
//Fetch data
while ($table = mysqli_fetch_array($alltables)){
//Add data to our array	
$hold[$a] = $table[0];
$a++;
}


//Checks to see if tables already exist
for($x = 0; $x < (count($hold));$x++){
switch ($hold[$x]){
case 'products':
	$table1 = true;
	break;
case 'orders':
	$table2 = true;
	break;
case 'order_items':
	$table3 = true;
	break;
default:
}
}

if(!$table1){
//Create First Table
$sql1 = "CREATE TABLE products(
	product_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	product_name VARCHAR(30) NOT NULL,
	product_image VARCHAR(30) NOT NULL,
	product_description TEXT,
	product_price DECIMAL(10,2) NOT NULL DEFAULT '0.00'
	)";
if(mysqli_query($conn,$sql1)){
	echo "Table 1 Created!";
} else {
	echo "Error Creating Table" . mysqli_error($conn);
}

$sql11 = "INSERT INTO products(product_id,product_name,product_image,product_description, product_price)
	VALUES  (1, 'ToyCar', 'car.jpg', 'Its a car', '6.00'),
                (2, 'TeddyBear', 'teddybear.jpg', 'A toy bear.', '8.00'),
                (3, 'ToyFish', 'fish.jpg', 'Best toy fish on here...', '7.50'),
                (4, 'ToyGorilla', 'gorilla.jpg', 'Unlike the bear, this one is scary.', '8.80'),
                (5, 'ToyDuck', 'duck.jpg', 'Used in the bath tub.', '9.75'),
                (6, 'Rubiks Cube', 'cube.jpg', 'Trains your intelligence. Some others claim that it\'s just frustration.', '9.30')";
 

if (mysqli_query($conn, $sql11)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

if(!$table2){
//Create Second Table
$sql2 = "CREATE TABLE orders(
	order_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	order_name VARCHAR(30) NOT NULL,
	order_email VARCHAR(30) NOT NULL
	)";

if(mysqli_query($conn,$sql2)){
	echo "Table 2 Created!";
} else {
	echo "Error Creating Table" . mysqli_error($conn);
}
}

if(!$table3){
//Create Third Table
$sql3 = "CREATE TABLE order_items(
	order_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        product_id INT(11) NOT NULL,
	quantity INT(11) NOT NULL
	)";

if(mysqli_query($conn,$sql3)){
	echo "Table 3 Created!";
} else {
	echo "Error Creating Table" . mysqli_error($conn);
}
}




$result = mysqli_query($conn,"SELECT * FROM products");

//Creates Table
echo "<table border='1'>
<tr>
<th>product_id</th>
<th>product_name</th>
<th>product_image</th>
<th>product_description</th>
<th>product_price</th>
</tr>";

//Outputs Info From MySQL into PHP
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['product_id'] . "</td>";
echo "<td>" . $row['product_name'] . "</td>";
echo "<td>" . $row['product_image'] . "</td>";
echo "<td>" . $row['product_description'] . "</td>";
echo "<td>" . $row['product_price'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($conn);

?>
