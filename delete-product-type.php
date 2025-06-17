<?php
include 'config.php';
$id = $_GET['prodid'];
$sql = "DELETE FROM product_types WHERE id = {$id}";
$result = mysqli_query($connect,$sql);
if ($result) {
    header("Location:product-type.php");
}else{
  echo "<p style='color:red;margin: 10px 0;'>Can't Delete the product_type.</p>";
}
mysqli_close($connect);

?>


