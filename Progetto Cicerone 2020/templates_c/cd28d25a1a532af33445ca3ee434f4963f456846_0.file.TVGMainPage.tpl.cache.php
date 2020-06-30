<?php
/* Smarty version 3.1.34-dev-7, created on 2020-06-23 16:51:07
  from 'D:\XAMPP2\htdocs\Cicero\Progetto Cicerone 2020\templates\TVGMainPage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ef216db0b6674_99154216',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd28d25a1a532af33445ca3ee434f4963f456846' => 
    array (
      0 => 'D:\\XAMPP2\\htdocs\\Cicero\\Progetto Cicerone 2020\\templates\\TVGMainPage.tpl',
      1 => 1592923866,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:navbar.tpl' => 1,
  ),
),false)) {
function content_5ef216db0b6674_99154216 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '17084124905ef216db0b52d3_23379708';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.min.css">
  <link rel="stylesheet" href="now-ui-kit.css" type="text/css">
  <link rel="stylesheet" href="assets/css/nucleo-icons.css" type="text/css">
  <link rel="icon" href="https://templates.pingendo.com/assets/Pingendo_favicon.ico">
  <title>Html Test</title>
</head>

<body class="">
  <!-- Navbar here -->
  <?php $_smarty_tpl->_subTemplateRender("file:navbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <!-- Sezione Ricerca here -->
  <div class="column" draggable="true" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, .75), rgba(0, 0, 0, .75)), url(https://static.pingendo.com/cover-bubble-dark.svg);  background-position: center center, center center;  background-size: cover, cover;  background-repeat: repeat, repeat;">
    <div class="container" style="background-color:#E3E3E3">
      <form method="post" id="Ricercaform">
        <div class="row">
          <label for="Parametro">Parametro:</label><br>
          <input type="text" id="Parametro" name="Parametro">
          <label for="Tipo">Scegli un tipo di ricerca:</label>
          <select id="Tipo" name="TipoRicerca" form="carform">
            <option value="Nome">Nome</option>
            <option value="Autore">Autore</option>
            <option value="Altro">Altro</option>
          </select>
          <button> Cerca </button>
        </div>
      </form>
    </div>
    <!-- Sezione I miei PG here -->
    <div class="row pi-draggable">
      <div class="col-md-2" style="Text-align:center">
        <p style="color:White;">Nome</p>
      </div>
      <div class="col-md-2" style="Text-align:center">
        <p style="color:White;">Classe</p>
      </div>
      <div class="col-md-2" style="Text-align:center">
        <p style="color:White;">Livello</p>
      </div>
      <div class="col-md-2" style="Text-align:center">
        <button> Dettagli </button>
      </div>
      <div class="col-md-2" style="Text-align:center">
        <button> Modifica </button>
      </div>
      <div class="col-md-2" style="Text-align:center">
        <button> Elimina </button>
      </div>
    </div>
    <!-- Fine Sezione -->
    <br>
    <div style="Text-align:center">
      <p style="color:White;">Personaggi in attesa di approvazione:</p>
    </div>
    <br>
    <!-- Sezione PG In attesa di approvazione here -->
    <div class="row pi-draggable">
      <div class="col-md-3" style="Text-align:center">
        <p style="color:White;">Nome</p>
      </div>
      <div class="col-md-3" style="Text-align:center">
        <p style="color:White;">Classe</p>
      </div>
      <div class="col-md-3" style="Text-align:center">
        <p style="color:White;">Livello</p>
      </div>
      <div class="col-md-3" style="Text-align:center">
        <button> Dettagli Approvazione </button>
      </div>
    </div>
    <!-- Fine Sezione -->
  </div>
  <!-- Sezione Our Team -->
  <pingendo onclick="window.open('https://pingendo.com/', '_blank')" style="cursor:pointer;position: fixed;bottom: 20px;right:20px;padding:4px;background-color: #00b0eb;border-radius: 8px; width:220px;display:flex;flex-direction:row;align-items:center;justify-content:center;font-size:14px;color:white">Made with Pingendo Free&nbsp;&nbsp;<img src="https://pingendo.com/site-assets/Pingendo_logo_big.png" class="d-block" alt="Pingendo logo" height="16"></pingendo>
</body>

</html><?php }
}
