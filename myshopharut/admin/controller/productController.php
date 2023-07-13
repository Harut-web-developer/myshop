<?php
session_start();
require("../model/model.php");

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

if ($action === "addProduct") {
   $prodName = $_POST["prodName"];
   $prodPrice = $_POST["prodPrice"];
   $prodDesc = $_POST["prodDesc"];
   $prodCount = $_POST["prodCount"];
   $prodImage = $_FILES["prodImage"]["name"];
   $prodImagetmp = $_FILES["prodImage"]["tmp_name"];
   $catId =$_POST["catId"];
   
   copy( $prodImagetmp,  "../assets/images".$prodImage);

    $addProduct = $adminModel -> addProduct($catId, $prodName,$prodPrice,$prodDesc,$prodCount,$prodImage);
    if ($addProduct) {
       $_SESSION["status"] = "success";
       $_SESSION["messege"] = "product add";
    }else{
        $_SESSION["status"] = "error";
        $_SESSION["messege"] = "failed to add";
    }
    header("location:../view/product.php?catId=".$catId);
}



?>