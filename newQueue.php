<?php
session_start();
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

$sql = 'SELECT id FROM queue WHERE member_id='.$_SESSION['customer_id'].' AND product_id='.$_GET['product_id'];
$result = $conn->query($sql);

  if($row = $result->fetch_assoc()){
    echo 'Already in queue.';
  }else{
    $sql = 'INSERT INTO queue (id,member_id,product_id) VALUES (0,'.$_SESSION['customer_id'].','.$_GET['product_id'].');';
    $result = $conn->query($sql);

    echo ($result?'Success':'Failure');
  }

?>
