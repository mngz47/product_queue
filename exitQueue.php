<?php

session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

if(ISSET($_SESSION['customer_id'])){
  
$sql = 'DELETE FROM queue WHERE member_id='.$_SESSION['customer_id'].' AND product_id='.$_GET['product_id'];
$result = $conn->query($sql);
echo ($result?'Success':'Failure');

}else{
 echo 'Sign In'; 
}

?>
