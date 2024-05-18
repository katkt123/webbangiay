<?php
    session_start();
    // if(!isset($_SESSION['taikhoan'])){
    //     header('Location: login.php');
    // }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiêu đề ở đây</title>
    <!-- reset css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"> 
    <!-- icon -->
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css"> 
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,100;1,300&display=swap" rel="stylesheet">
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="./assets/css/slick.css">

    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/reponsive.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- font pro -->
    <link rel="stylesheet" href="./assets/fonts/fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome.com/releases/v6.4.0/css/sharp-light.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome.com/releases/v6.4.0/css/sharp-solid.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Latest version of SweetAlert2 -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 -->
    <script
        type="text/javascript"
        src="./assets/js/sweetalert.js"
    ></script>
</head>

<body>

    <?php require_once 'config/config.php' ?>

    <div class="app">
        <!-- Header -->
        <?php include_once 'pages/header.php' ?>

        <!-- Main -->
        <?php include_once 'pages/main.php' ?>

        <div class="load-main">
            <div class="load-img">
                <img src="./assets/img/loadpage.gif" alt="" class="">
            </div>
        </div>
        <!-- Footer -->
        <?php include_once 'pages/footer.php' ?>
        <!-- <script src="https://cdn.commoninja.com/sdk/latest/commonninja.js" defer></script>
<div class="commonninja_component pid-16db97ad-06ff-4bdd-ac35-d5f634a3af0e"></div>
         -->
    </div>
    
    <script>
        window.addEventListener("load", function(){
            var load= document.querySelector('.load-main');
            // load.style.display='none';
            setTimeout(function() {
            if (load) {
                load.classList.add('fadeOut'); // Thêm lớp 'fadeOut'
                setTimeout(function() {
                    load.style.display = 'none'; // Ẩn phần tử
                }, 200); // Thời gian cho animation 'fast' là 200 milliseconds trong jQuery
            }
        }, 300);
        });
    </script>
    <!-- Slick -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-1.11.0.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
    ></script>
    <script
      type="text/javascript"
      src="./assets/js/slick.min.js"
    ></script>
    <script src="./assets/js/index.js">
    </script>
</body>

</html>

