<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../Pld/now-ui-kit.css" type="text/css">
  <link rel="stylesheet" href="../Pld/assets/css/nucleo-icons.css" type="text/css">
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
</head>

<body class="">

{user->getUsername assign='Username'}
  <!-- Navbar here -->
  {include file="navbar.tpl"}

  <div class="column" draggable="true" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, .75), rgba(0, 0, 0, .75)), url(https://static.pingendo.com/cover-bubble-dark.svg);  background-position: center center, center center;  background-size: cover, cover;  background-repeat: repeat, repeat;">
    <!-- Sezione FORM -->
    <form method="post" id="ModifyAvatarForm">
      <div class="row pi-draggable" draggable="true">
        <div class="col-md-2" style="Text-align:center">
          <p style="color:White;">Old Nome:{$avatar->getNome()}</p>
        </div>
        <div class="col-md-2" style="Text-align:center">
          <p style="color:White;">New Nome:</p>
        </div>
        <div class="col-md-2" style="Text-align:center">
          <input type="text" id="Nome" name="Nome">
        </div>
      </div>
      <div class="row pi-draggable" draggable="true">
        <div class="col-md-2" style="Text-align:center">
          <p style="color:White;">Old Razza:{$avatar->getRazza()}</p>
        </div>
        <div class="col-md-2" style="Text-align:center">
          <p style="color:White;">New Razza:</p>
        </div>
        <div class="col-md-2" style="Text-align:center">
          <input type="text" id="Razza" name="Razza">
        </div>
      </div>
      <div class="row pi-draggable" draggable="true">
        <div class="col-md-2" style="Text-align:center">
          <p style="color:White;">Old Classe:{$avatar->getClasse()}</p>
        </div>
        <div class="col-md-2" style="Text-align:center">
          <p style="color:White;">New Classe:</p>
        </div>
        <div class="col-md-2" style="Text-align:center">
          <input type="text" id="Classe" name="Classe">
        </div>
      </div>
      <div class="row pi-draggable" draggable="true">
        <div class="col-md-2" style="Text-align:center">
          <p style="color:White;">Old Livello:{$avatar->getLivello()}</p>
        </div>
        <div class="col-md-2" style="Text-align:center">
          <p style="color:White;">New Livello:</p>
        </div>
        <div class="col-md-2" style="Text-align:center">
          <input type="text" id="Nome" name="Nome">
        </div>
      </div>
      <button> Invia dati </button>
    </form>
  </div>
</body>

</html>