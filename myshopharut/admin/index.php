<?php
session_start();
include("./model/model.php");

if (!$_SESSION["userlogin"]) {
    header("location:.view/registration.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/adminStyle.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <header>
        <div class="logo">

        </div>
        <div class="exit">
            <ul>
                <li><a href="./view/login.php">exit</a></li>
            </ul>
        </div>
    </header>
    <?php
        if (isset($_SESSION["status"])) {
            if ($_SESSION["status"] === "success") {?>
      <div class="msg">
            <p><?php echo $_SESSION["messege"]   ?></p>
     </div>
 <?php  }else if($_SESSION["status"] === "error"){?>
    <div class="msg">
    <p  class = "error_msg"><?php echo $_SESSION["messege"]   ?></p>
</div>
<?php }
    unset($_SESSION["status"]);
    unset($_SESSION["error"]);
        }
    ?>

    <form action="./controller/catController.php" method="post">
        <input name="catName" placeholder="categories" type="text">
        <button name="catBut" class="btn btn-success">add categories</button>
    </form>



        <div>
            <?php
            $showCat = $adminModel -> showCategory();
                  if ($showCat !== []) {
            ?>
            <table class="table table-hover tab">
                <thead>
                    <tr>
                        <th class="th1">nameCat</th>
                        <th class="th2">actions</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($showCat as $value){
                         ?>   
                         <tr>
                            <td contenteditable class="cName"><?= $value['catName'] ?></td>
                            <td class="flex">
                                <a class="btn btn-info" href="./view/product.php?catId=<?=$value["cat_id"]?>&catName=<?=$value["catName"]?>">open</a>
                                <button class="btn btn-warning updateCat" data-value ="<?= $value["cat_id"] ?>">update</button>
                                <button class="btn btn-danger deleteCat" data-value ="<?= $value["cat_id"] ?>">delete</button>

                            </td>
                         </tr>
                         <?php
                        }
                    ?>
                </tbody>
            </table>
                       <?php          }  ?>
        </div>
        <div class="alert alert-success" role="alert" style="display:none;"></div>
    <div class="alert alert-danger" role="alert" style="display:none;" ></div>
        <!-- <script src="./assets/js/home.js"></script> -->
        <script >

                // $(function(){
                //     $(".updateCat").click(function(){
                //         let catName = $(this).closest("tr").children('.cName').text();
                //         let catId = $(this).data("value");
                    
                //         $.ajax({
                //             url: "./controller/catController.php",
                //             method: "post",
                //             datatype: "json",
                //             data: {
                //                 catName,
                //                 catId,
                //                 action: "update",
                //             },
                //             success: function(data){
                //         // console.log(data);

                //             //   let pars = JSON.parse(data);
                //             //   console.log(pars);
                //                 if (data["status"] === 1) {

                //                     $(".alert-success").html(data["messege"]);
                //                     $(".alert-success").fadeIn();
                //                     $(".alert-success").fadeOut(2000);
                //                     setTimeout(function(){
                //                         location.reload();
                //                     },2500)
                //                 }else{
                //                     $(".alert-danger").html(data["messege"]);
                //                     $(".alert-danger").fadeIn();
                //                     $(".alert-danger").fadeOut(2000);
                //                     setTimeout(function(){
                //                         location.reload();
                //                     },2500)
                //                 }
                //                 // console.log(data);   
                //             }
                //                             })
                //                         })
                //                     })
            



                $(function(){
      $('.updateCat').on('click', function(){
        let catName = $('.cName').html();
        let catId = $(this).data('value');

        $.ajax({
          url:'./controller/catController.php',
          method:'post',
          dataType:'json',
          data:{
            catName,
            catId,
            action:'updateCat'

          
          },
          success: function(data){
            if(data['Action'] == '1'){
              $('.alert-success').html(data['message']);
              $('.alert-success').fadeIn();
              $('.alert-success').fadeOut(2500);
              setTimeout(function(){
                location.reload();
              },3000);
            }else{
              $('.alert-danger').html(data['message']);
              $('.alert-danger').fadeIn();
              $('.alert-danger').fadeOut(2500);
              setTimeout(function(){
                location.reload();
              },3000);
            }
          }
        })
        
      })
    })




                


            $(function(){
                $(".deleteCat").click(function(){
                    let delName = $(this).closest("tr").children(".cName").text();
                    let delId = $(this).data("value");

                    $.ajax({
                        url:"./controller/catController.php",
                        method: "post",
                        datatype:"json",
                        data:{
                            delName,
                            delId,
                            action:"delete",
                        },
                        success: function(data){
                            let parse = JSON.parse(data);
                            if (parse["status"] === 1) {
                                $(".alert-success").html(parse["messege"]);
                                $(".alert-success").fadeIn();
                                $(".alert-success").fadeOut(2000);
                                    setTimeout(function(){
                                        location.reload();
                                    },2500)
                            }else{
                                $(".alert-danger").html(parse["messege"]);
                                $(".alert-danger").fadeIn();
                                $(".alert-danger").fadeOut(2000);
                                    setTimeout(function(){
                                        location.reload();
                                    },2500)
                            }
                        }

                    })
                })
            })

        </script>
</body>
</html>