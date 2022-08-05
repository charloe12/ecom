<?php 
include 'templates/functions.php';

if(!empty($_POST)){
// lorsque nous appuyons sur le bouton afficher
// echo $_POST['search'];
 $categories = searchProduits($_POST['search']);
}else{
  $categories = getAllcategories();
}
?>
<?php include 'templates/header.php'?>
<main class="mt-5">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarTogglerDemo01"
      aria-controls="navbarTogglerDemo01"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse " id="navbarTogglerDemo01">
      <strong><a class="text-dark mr-2" href="#">Categories:</a></strong>
      
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">All</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Sport</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Clasic</a
          >
        </li>
      </ul>
      <form action="home.php" class="d-flex input-group w-auto" method="POST">
        <input
          mame='search'
          type="search"
          class="form-control"
          placeholder="Type query"
          aria-label="Search"
        />
        <button
          class="btn btn-outline-warning"
          type="submit"
          data-mdb-ripple-color="dark"
        >
          Search
        </button>
      </form>
    </div>
  </div>
</nav>
    <!-- products section -->
    <section class="text-center mb-4">
      <div class="row">
        <?php
  foreach($categories as $categorie) {
    print '
    <div class="col-lg-4 col-md-12 mb-4">
<div class="card">
  <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
    <img src="img/'.$categorie['image'].'"  class="img-fluid"/>
    <a href="#!">
      <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
    </a>
  </div>
  <div class="card-body">
    <h5 class="card-title">'.$categorie['nom'].'</h5>
    <p class="card-text">'.$categorie['description'].'</p>
    <a href="produit.php?nom='.$categorie['nom'].'" class="btn btn-primary">CHECK</a>
  
  </div>
</div>
</div>
  
';
}
      ?>
<nav aria-label="...">
  <ul class="pagination pagination-circle d-flex justify-content-center ">
    <li class="page-item">
      <a class="page-link">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active" aria-current="page">
      <a class="page-link" href="#">2 <span class="visually-hidden">(current)</span></a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
      </div>
          </section>


  



</main>

<?php include 'templates/footer.php'?>

