<?php
session_start();
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$sql = 'INSERT INTO queue (id,member_id,product_id) VALUES (0,'.$_SESSION['customer_id'].','.$_GET['product_id'].');';
$result = $conn->query($sql);

echo $result?'Success':'Failure';
?>