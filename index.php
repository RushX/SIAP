<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Martel&family=Montserrat:wght@500&family=Yantramanav:wght@500&display=swap" rel="stylesheet">
  <script src="/js/notify.js"></script>
  <title>Document</title>
  <style>
    body{
    font-family: 'Montserrat', sans-serif !important;
    }
    .card{
    border-radius: 4px;
    background: #fff;
    box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
      transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
  cursor: pointer;
}

.card:hover{
     transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

.card h3{
  font-weight: 600;
}

.card img{
  position: absolute;
  top: 20px;
  right: 15px;
  max-height: 120px;
}

.card-1{
  background-image: url(https://ionicframework.com/img/getting-started/ionic-native-card.png);
      background-repeat: no-repeat;
    background-position: right;
    background-size: 80px;
}

.card-2{
   background-image: url(https://ionicframework.com/img/getting-started/components-card.png);
      background-repeat: no-repeat;
    background-position: right;
    background-size: 80px;
}

.card-3{
   background-image: url(https://ionicframework.com/img/getting-started/theming-card.png);
      background-repeat: no-repeat;
    background-position: right;
    background-size: 80px;
}

@media(max-width: 990px){
  .card{
    margin: 20px;
  }
} 
  </style>
</head>

<body>
<script src="https://kit.fontawesome.com/16d37616d9.js" crossorigin="anonymous"></script>
<center>
<div id="preloader" class="fa-3x" style="padding-top:20%">
<i class="fa-solid fa-cog fa-spin"></i>
</div>
</center>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-sm navbar-dark " style="background-color: lightslategrey;margin-bottom:20px;width:100%">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../admin/Sinh.png" width="70px"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size: larger;font-weight:bold">
        <li class="nav-item">
          <a class="navbar-brand" id="Data Manager" href="#">SIAP</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <center>
    <h3>I AM </h3>
    <div class="table-responsive-sm">
    <table class="table">
    <tr>
    <div class="card" style="width: 18rem;text-align:center">
    <div style="padding-top:20px" class="fa-3x">
    <center><i class="fa-solid fa-chalkboard-user"></i></center>
    </div>
      <div class="card-body">
        <h5 class="card-title">ADMINISTRATOR</h5>
        <p class="card-text">For Staff Only</p>
        <a href="admin/login.php" class="btn btn-success" style="width: 100px;">GO</a>
      </div>
    </div>
</tr>
    <tr>
    <div class="card" style="width: 18rem;text-align:center">
    <div style="padding-top:20px" class="fa-3x">
    <center><i class="fa-solid fa-user-tie"></i></center>
    </div>
      <div class="card-body">
        <h5 class="card-title">STUDENT</h5>
        <p class="card-text">For All Users</p>
        <a href="student/scanner.php" class="btn btn-success" style="width: 100px;">GO</a>
      </div>
    </div>
</tr>
    </table>
    </div>
  </center>
  <script>
        var loader =document.getElementById("preloader");
        window.addEventListener("load",function(){
            loader.style.display="none";
        })
    </script>
      <?php
    include("php/footer.php") ?>
</body>

</html>