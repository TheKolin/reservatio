<?php 
    require ('conn.php');
	if(isset($_POST['submit'])){
		$no_room = $conn -> real_escape_string($_POST['no_room']);
		$description = $conn -> real_escape_string($_POST['description']);
		if(!empty($no_room) && !empty($description)){
			$sql = "INSERT INTO room (id_room, no_room, description) VALUES (NULL, '$no_room', '$description')";
			if($conn -> query($sql)){
				echo '<div class="pass">Poprawnie dodano salę</div>';
			}else{
				echo '<div class="error">Wystąpił błąd</div>';
			}
		}else{
			echo '<div class="error">Numer sali oraz opis nie mogą być puste!</div>';
		}
	}
    
    $sql_select = "SELECT * FROM room";
    if($result = $conn -> query($sql_select)){
        echo '<table>';
        echo '<tr><th>Numer sali</th><th>Opis</th></tr>';
    	while($row = $result -> fetch_assoc()){
			echo '<tr>';
            echo '<td>'.$row['no_room'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            echo '</tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "error">Wystąpił błąd z pobraniem listy przedmiotów</div>';
		exit();
	}
?>