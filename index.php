
<p style="font-size:1.1em;" ><strong>Refer a friend to lower the price.</strong><br>
	The price will drop to <span style="color:green;" >R<?php  echo round($row['price']-($row['price']/3)); ?></span><br>
	After 1000 people have joined the queue.</p>
<?php

//session_start();

$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists');

//include str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']).'/api.php';

$sql = 'SELECT COUNT(id) AS ii FROM queue WHERE product_id='.$_GET['product_id'];
$result = $conn->query($sql);
	       if($q_row = $result->fetch_assoc()){
			   
		   if($q_row['ii']>0){
			   
                 $q_discount = 	round($row['price'] - (($row['price']/3)*($q_row['ii']/1000)));		   
			   
			   echo '<span>Queue Size('.($q_row['ii']+50).')</span><br>';
			   echo '<span>Product Discount(R'.$q_discount.')</span><br>';
			   
			   $msg = '';
			   
			   $sql = 'SELECT id,title FROM product WHERE id='.$_GET['product_id'];
			   $result = $conn->query($sql);
	       if($result){
		   if($q_row2 = $result->fetch_assoc()){
			  
			   if($q_row['ii']%100==0){
				   
				   //message reminder to people in queue (size of queue,price drop)
				   $msg = 'Queue for <a href="https://www.productlists.co.za/services/sell/products/open.php?product_id='.$q_row2['id'].'" >'.
				   $q_row2['title'].'</a> now has '.$q_row['ii'].' people and price has dropped to R'.$q_discount.'.<br>'.
				   ($q_row['ii']%100>7?' Add item to cart and checkout to access discount price':'');

			  } 
		   }
		   }
		   
		    if($msg){
				   
$sql = 'SELECT member_id FROM queue WHERE product_id='.$product_id;
$result = $conn->query($sql);
	       if($result){
			   while($q_row2 = $result->fetch_assoc()){
				
           $sql = 'SELECT email_cell FROM customer WHERE id='.$q_row2['member_id'];
$result2 = $conn->query($sql);
	       if($result2){
			   if($q_row3 = $result2->fetch_assoc()){
				   p_mail($q_row3['email_cell'],$msg);
			   } 
		   }	
			   }   
			   }
		   
			}
		   }
		   }
		   
		   if(ISSET($_SESSION['customer_id'])){
				   echo '<a style="font-size:1.2em;" href=# onclick="sendreq(\'feature/queue/newQueue.php?product_id='.$product_id.'\');alert(\'Success\');return false;" >Join Queue</a>';
			   }else{
				   echo '<p style="font-size:1.2em;" >Sign In</p>';
			   }
?>
