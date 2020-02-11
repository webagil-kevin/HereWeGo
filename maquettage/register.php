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
            <div class="row mt-5 ">
              <div class="col-12">
                <ul class="nav justify-content-center">
                  <li class="nav-item">
                    <h2 class="card-title btn-info text-center rounded">S'inscrire</h2>
                  </li>
                </ul>
              </div>
            </div>
            <form method="POST" action="#">
              <div class="form-row ">
                <div class="col-md-4 mb-3">
                  <label for="validationDefault01">Nom</label>
                  <input type="text" class="form-control" id="validationDefault01" value="" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationDefault02">Prenom</label>
                  <input type="text" class="form-control" id="validationDefault02" value="" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationDefault02">Adresse</label>
                  <input type="text" class="form-control" id="validationDefault02" value="" required>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationDefault03">Ville</label>
                  <input type="text" class="form-control" id="validationDefault03" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="validationDefault03">Code postal</label>
                  <input type="text" class="form-control" id="validationDefault03" required>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="validationDefault05">Pays</label>
                  <input type="text" class="form-control" id="validationDefault05" required>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="validationDefaultUsername">Mail</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupPrepend2">@</span>
                    </div>
                    <input type="text" class="form-control" id="validationDefaultUsername"  aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationDefault02">Mot de Passe</label>
                  <input type="password" class="form-control" id="inputPassword2">
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationDefault02">Telephone</label>
                  <input type="text" class="form-control" id="validationDefault02" value="" required>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-3 mb-3">
                  <label for="validationDefault04">Avatar</label>
                  <select class="custom-select" id="validationDefault04" required>
                    <option selected disabled value="">choix...</option>
                    <option>...</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                  <label class="form-check-label" for="invalidCheck2">
                    J'accepte les conditions d'utlisation
                  </label>
                </div>
              </div>
              <button class="btn btn-primary mb-5" type="submit">Valider</button>
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
