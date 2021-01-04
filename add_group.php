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
	<link rel="stylesheet" href="style2.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	
	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
	
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

    <p class="h2">Dodaj grupę</p>

    <form action="add_group.php" method="POST">
        <div class="row">
        <div class="col">
                    <input type="text" name="profile" class="form-control" placeholder="Profil">
        </div>
        <div class="col">
					<input type="text" name="semester" class="form-control" placeholder="Semestr">
        </div>
        <div class="col">
					<select name="type" class="form-control">
						<option value="GĆ">Grupa Ćwiczeniowa</option>
						<option value="GL">Grupa Laboratoryjna</option>
						<option value="GO">Grupa Ogólna</option>
						<option value="GP">Grupa Projektowa</option>
						<option value="GW">Grupa Wykładowa</option>
					</select>
        </div>
        <div class="col">
                    <input type="text" name="number" class="form-control" placeholder="Numer grupy" >
        </div>
        <div class="col">
					<input type="submit" name="submit" value="Dodaj" class="btn btn-light">
        </div>
        </div>
					<?php
						require('input_group.php');
						$conn -> close();
					?>
				</form>
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