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
		</header>
		<main>
			<div class="container">
				<p class="h2">Dodaj salę</p>
				<form action="" method="POST">
					<div class="row">
						<div class="col">
							<input type="number" class="form-control" placeholder="Nr sali" name="no_room">
						</div>
						<div class="col">
							<input type="text" class="form-control" placeholder="Opis" name="description">
						</div>
						<div class="col">
							<input type="submit" name="submit" value="Dodaj" class="btn btn-light">
						</div>
						<div class="row">
							<p class="h4">Dodane sale</p>
							<?php
								require('input_room.php');
								$conn -> close();
							?>
						</div>
					</div>
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
		<script src="js/jq_scripts.js"></script>
		<script>
			$(document).ready(function(){
				var currentRow, no_room, description, id;
				$("table").on('click','#edit_btn',function(){
					if(currentRow){
						cancel();
					}
					//catch row
					currentRow = $(this).closest("tr");  
					no_room = currentRow.find("td:eq(0)").text();
					description = currentRow.find("td:eq(1)").text();
					
					//create input
					currentRow.find("td:eq(0)").html('<input class="form-control" type="text" name="new_no_room" value="">');
					currentRow.find('input[name="new_no_room"]').val(no_room);
					
					currentRow.find("td:eq(1)").html('<input class="form-control" type="text" name="new_description" value="">');
					currentRow.find('input[name="new_description"]').val(description);
					//edit to save
					id = currentRow.find("button:eq(1)").val();
					currentRow.find("button:eq(1)").remove();
					currentRow.find("td:last()").append('<button name="edit" type="submit" class="btn btn-success">Zapisz</button>');
					currentRow.find("button:eq(1)").val(id);
				});
				
				//back to default
				function cancel(){
					currentRow.find("td:eq(0)").html(''+no_room);
					currentRow.find("td:eq(1)").html(''+description);
					currentRow.find("button:eq(1)").remove();
					currentRow.find("td:last()").append('<button id="edit_btn" type="button" class="btn btn-success">Edytuj</button>');
				}
			});
		</script>
		
	</body>
</html>