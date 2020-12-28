<html lang="pl">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
<script>
function check(){
  var checkBox= document.getElementById("checkbox");
  var time = document.querySelector(".hidden");
  if(checkBox.checked==true){
    time.innerHTML = '<input type="time" id="dateend" name="time_stop">'
  }
  else{
    time.innerHTML = "";
  }
}
</script>
</head>
<body>
<div id="box">
<div id="banner">
<h1>Strona główna</h1><a href="index.php"><img src="logopollub.png"></a>
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
				<h1>Dodaj nauczyciela</h1>
				<form action="add_reservation.php" method="POST">
					<p>Rezerwacja sali</p>
                    Niestandardowa godzina zakończenia zajęć <input type="checkbox" id="checkbox" name="custom_date" onclick="check()">
                    <table>
					<?php
						require('get_data.php');
					?>
                    </table>
                    <br>
				</form>
                <?php
    					require('input_reservation.php');
						$conn -> close();
				?>
</div>
<div id="footer"><p align="center"><a href="http://www.pollub.pl/" target="_blank">Politechnika Lubelska</a></p>
<p>Created by ETI2019-2023</p>

</div>
</div>
</body>
</html>