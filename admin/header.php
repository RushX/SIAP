
<script src="https://kit.fontawesome.com/16d37616d9.js" crossorigin="anonymous"></script>
<center>
<div id="preloader" class="fa-3x" style="padding-top:20%">
<i class="fa-solid fa-cog fa-spin"></i>
</div>
</center>
<div id="noty-holder"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-sm navbar-dark " style="background-color: lightslategrey;margin-bottom:20px">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="Sinh.png" width="80px"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="font-size: larger;font-weight:bold">
        <li class="nav-item">
          <a class="nav-link" id="Data Manager" href="index.php">Data Manager</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="UID Manager" href="u_manager.php">UID Manager</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  id="QR Manager" href="qr.php">QR Manager</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  id="QR Manager" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<script>
var page=document.title;
document.getElementById(page).className="nav-link active";
</script>