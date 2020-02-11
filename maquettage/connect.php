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
            <div class="main-container border border-dark d-flex justify-content-center mt-2 mb-5">
              <div class="main-container2">
                <div class="row mt-5 mb-5">
                  <div class="col-12">
                    <ul class="nav justify-content-center">
                      <li class="nav-item">
                        <h2 class="card-title btn-info text-center rounded">Se connecter</h2>
                      </li>
                    </ul>
                  </div>
                </div>
                <form>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Adresse Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mot de Passe</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <a href="recup-pwd.php"><h6 class="card-subtitle mb-2 text-muted">Mot de passe oublié ?</h6></a>
                  <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">Memoriser mes informations de connection</label>
                  </div>
                  <button type="submit" class="btn btn-info mb-5">Valider</button>
                  <a href="#"><h6 class="card-subtitle mb-2 text-muted">Pas encore inscrit ? M'inscrire</h6></a>
                </form>
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
