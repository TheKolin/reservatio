<html lang="pl">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="box">
<div id="banner">
<h1>Strona główna</h1><a href="index.html"><img src="logopollub.png"></a>
</div>
<div id="menu">
    <ol>
        <li><a href="#">Formularze</a>
          <ul>
          <li><a href="add_reservation.php">Rezerwacja</a></li>
            <li><a href="add_teacher.php">Dodawanie nauczyciela</a></li>
            <li><a href="add_room.php">Dodawanie sali</a></li>
            <li><a href="add_activities.php">Dodawanie przedmiotu</a></li>
            <li><a href="add_group.php">Dodawanie grupy</a></li>
          </ul>
        </li>
    
        <li><a href="#">Raporty</a>
          <ul>
            <li><a href="#">link - 1</a></li>
            <li><a href="#">link - 2</a></li>
            <li><a href="#">link - 3</a></li>
          </ul>
        </li>
    
        <li><a href="#">Wyświetlanie</a></li>
    
        <li><a href="#">Edycja</a>
          <ul>
            <li><a href="#">link - 1</a></li>
            <li><a href="#">link - 2</a></li>
            <li><a href="#">link - 3</a></li>
            <li><a href="#">link - 4</a></li>
          </ul>
        </li>
      </ol>

</div>

<div id="main">
				<h1>Dodaj salę</h1>
				<form action="add_room.php" method="POST">
					<p>Dodawanie sali</p>
					<?php
						require('conn.php');
                    ?>
                    Numer sali:
                    <input type="number" name="no_room"><br>
                    Opis:
                    <input type="text" name="description">
					<input type="submit" name="submit" value="Dodaj">
					<?php
						require('input_room.php');
						$conn -> close();
					?>
				</form>
			</div>
</div>
<div id="footer"><p align="center"><a href="http://www.pollub.pl/" target="_blank">Politechnika Lubelska</a></p>
<p>Created by ETI2019-2023</p>

</div>
</div>
</body>
</html>