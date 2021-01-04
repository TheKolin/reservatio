<!DOCTYPE html>
<html lang="pl">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>Reservatio v. 1.0</title>
	<meta name="description" content="System rezerwacji sal zajęciowych">
	<meta name="author" content="Marcin Łukasiewicz, Kacper Witak">
	<meta http-equiv="X-Ua-Compatible" content="IE=edge">
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style1.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	
	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->

	<script>
function check(){
  var checkBox= document.getElementById("checkbox");
  var time = document.querySelector("hidden");
  if(checkBox.checked==true){
    time.innerHTML = '<input type="time" id="dateend" name="time_stop" class="form-control">';
  }
  else{
    time.innerHTML = "";
  }
}
</script>
</head>
<body>
    <header>
	<header>
		<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
		
			<a class="navbar-brand" href="index.php"><img src="img/logopollub.png" width="30" height="30" class="d-inline-block mr-1 align-bottom" alt=""> Reservatio</a>
		
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse" id="mainmenu">
			
				<ul class="navbar-nav mr-auto">
				
					<li class="nav-item active">
						<a class="nav-link" href="index.php"> Start </a>
					</li>
					
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="submenu" aria-haspopup="true"> Formularz </a>
						
						<div class="dropdown-menu" aria-labelledby="submenu">
						
							<a class="dropdown-item" href="add_reservation.php"> Rezerwacja </a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="add_teacher.php">Dodaj nauczyciela</a>
							<a class="dropdown-item" href="add_activities.php"> Dodaj przedmiot </a>
							<a class="dropdown-item" href="add_room.php"> Dodaj salę </a>
							<a class="dropdown-item" href="add_group.php"> Dodaj grupę </a>
						</div>
						
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"> Raport </a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="#"> Wyświetl </a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="submenu" aria-haspopup="true"> Linki </a>
						
						<div class="dropdown-menu" aria-labelledby="submenu">
						
							<a class="dropdown-item" href="http://www.pollub.pl/" target="_blank"> Politechnika Lubelska </a>
							<a class="dropdown-item" href="http://wpt.pollub.pl/" target="_blank">Wydział Podstaw Techniki</a>
							<a class="dropdown-item" href="http://www.kpt.pollub.pl/" target="_blank"> Katedra Podstaw Techniki</a>
						</div>
						
					</li>

					<li class="nav-item">
						<a class="nav-link" href="authors.html"> Autorzy </a>
					</li>
				
				</ul>


</nav>
<main>
<div class="container">
<div class="row">
<form action="add_reservation.php" method="POST" class="form">
    <div class="form-group">
<p class="h2">Rezerwacja sali</p>
<?php
require('get_data.php');
?>
</div>
<td><select name="duration" class="form-control">';
<option disabled selected value> -- Wybierz okres -- </option>
<option value = "0">Jednorazowo</option>
<option value = "1">Co tydzień</option>
<option value = "2">Co dwa tygodnie</option>
</select></td>
<td><input type="date" name="date" class="form-control"></td>
<td><input type="time" name="time_start" class="form-control"></td>
<td class="hidden"></td>
<p>Niestandardowa godzina zakończenia zajęć:
<input type="checkbox" class="form-check-input" id="checkbox" name="custom_date" onclick="check()"></p><br>
<td><input type="submit" name="submit" value="Zarezerwuj" class="btn btn-light"></td></br>
<?php
require('input_reservation.php');
$conn -> close();
?>
</form>
</div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Usuń</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <b class="text-dark"> Czy na pewno chcesz usunąć?</b>
      </div>
      <div class="modal-footer">
	  <form action="" method="POST">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
        <button name="delete" id="delete" class="btn btn-primary" type="submit" >Usuń</button>
		</form>
      </div>
    </div>
  </div>
</div>
</main>

<footer class="bg-light text-center">
	  <p class="text-dark text-center">© 2020 Copyright: ETI2019</p>
  </footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>

	$("button").click(function() {
		if($(this).prop("name") == "id_delete"){
			$("#delete").val($(this).prop("value"));
		}
	});
	
	</script>
	
</body>
</html>