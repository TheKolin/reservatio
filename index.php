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
	<link rel="stylesheet" href="style.css">
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
<div clas="row">
<?php
	require('calendar.php');
?>
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
		$(document).ready(function(){
			var table = $('table');
			var currentRow;
			var buff;
			var max = 0;
			var array = [];
			var day = ['Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek'];
			for(var i=0; i<5; i++){
				currentRow = table.find('tr').eq(i);
				if(currentRow.find('th').html() != day[i]){
					currentRow = table.find('tr').eq(i-1);
					currentRow.after('<tr class="col-sm-12 col-md-2"><th class="col">' + day[i] + '</th></tr>')
				}
				
			}
			for(var i=0; i<5; i++){
				currentRow = table.find('tr').eq(i);
				buff = currentRow.find('td').length;
				array[i] = buff;
				if(buff > max){
					max = buff
				}
			}
			for(var i=0; i<5; i++){
				for(var j=0; j<max-array[i]; j++){
					currentRow = table.find('tr').eq(i).append('<td></td>');
				}
			}
		});
	</script>
	
</body>
</html>