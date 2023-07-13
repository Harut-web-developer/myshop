<?php
session_start();
require("../model/model.php");
if (isset($_GET["catId"])) {
   $catId = $_GET["catId"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="../controller/productController.php" method="post" enctype="multipart/form-data">
    <div class = 'add_product_container'>
    <div>
      <label for="prodName">Name</label>
      <input type="text" name="prodName" class="prodName">
      
    </div>
    <div>
      <label for="prodPrice">Price</label>
      <input type="text" name="prodPrice" class="prodPrice">
    </div>
    <div>
      <label for="prodDesc">Description</label>
      <textarea name="prodDesc" class="prodDesc"></textarea>
    </div>
    <div>
      <label for="prodCount">Count</label>
      <input type="number" name="prodCount" class="prodCount">
      
    </div>
    <div>
      <label for="prodImage">Image</label>
      <input type="file" name="prodImage" class="prodImage">
    </div>

    <input type="hidden" name="catId" value="<?=$catId?>">
    
  </div>
  <button type="submit" class="btn btn-primary" name="action" value="addProduct">Add</button>


  <?php
  if (isset($SESSION["status"])) {
    if ($SESSION["status"] === "success") {
      echo $SESSION["messege"];
    }else{
      echo $SESSION["messege"];
    }
    unset($SESSION["status"]);
    unset($SESSION["messege"]);
  }

?>
</body>
</html>