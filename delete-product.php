<?php
include 'config.php';
$id = $_GET['prodid'];
$sql = "DELETE FROM products WHERE id = {$id}";
$result = mysqli_query($connect,$sql);
if ($result) {
    header("Location:test-products.php");
}else{
  echo "<p style='color:red;margin: 10px 0;'>Can't Delete the product.</p>";
}
mysqli_close($connect);

?>


