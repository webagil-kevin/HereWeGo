<!DOCTYPE html>
<html>
    <head>
          <meta charset="utf-8">
          <title>Herewego</title>
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta http-equiv="x-ua-compatible" content="ie=edge">
          <meta name="description" content="Herewego, explorez et découvrez des événements dans le monde entier! Vous trouverez des événements conseillés en fonction de vos intérêt!">
          <link rel="icon" href="img/logo.jpg" />
					<link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css">
					<link rel="stylesheet" href="bootstrap/css/bootstrap-reboot.min.css">
					<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  				<link rel="stylesheet" href="styles/style.css">
  </head>
	<body>
      <div class=container-fluid>
        <?php
          require_once "header.php";
        ?>
        <main>
            <div class="row">
              <div class="col-sm-12 mb-2">
                <ul class="nav justify-content-center ">
                   <li class="nav-item alert text-light">
                     <h1 class="card-title text-center font-italic font-weight-light">Titre de l'Evenement</h1>
                   </li>
                </ul>
              </div>
            </div>
            <div class="card bg-dark text-white mb-5">
                <img src="img/banner.jpg" class="card-img" alt="IMG">
            </div>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="card-deck">
                    <div class="card">
                      <img src="img/avatar.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                    <div class="card">
                      <img src="img/avatar.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                    <div class="card">
                      <img src="img/avatar.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="card-deck">
                    <div class="card">
                      <img src="img/avatar.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                    <div class="card">
                      <img src="img/avatar.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                    <div class="card">
                      <img src="img/avatar.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="card-deck">
                    <div class="card">
                      <img src="img/avatar.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                    <div class="card">
                      <img src="img/avatar.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                    <div class="card">
                      <img src="img/avatar.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            <div class="row mt-5 mb-5">
              <div class="col-12">
                <h2 class="card-title btn-info text-center">CATEGORIES</h2>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12">
                  <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                      <a class="nav-link active" href="#">Culture</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active ml-5" href="#">Sport</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active ml-5" href="#">Business</a>
                    </li>
                  </ul>
              </div>
            </div>
            <div class="row mt-5 mb-5">
              <div class="col-12">
                <ul class="nav nav-pills nav-justified">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Gastronomie</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active ml-5" href="#">Loisir</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active ml-5" href="#">Musique</a>
                  </li>
                </ul>
              </div>
            </div>


        </main>
        <?php
          require_once "footer.php";
        ?>
      </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>

  </body>
  </html>
