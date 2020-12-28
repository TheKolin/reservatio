<?php 
    require ('conn.php');
	if(isset($_POST['submit'])){
		$firstname = $conn -> real_escape_string($_POST['firstname']);
		$lastname = $conn -> real_escape_string($_POST['lastname']);
		if(!empty($firstname) && !empty($lastname)){
			$sql = "INSERT INTO teacher (id_teacher, first_name, last_name) VALUES (NULL, '$firstname', '$lastname')";
			if($conn -> query($sql)){
				echo '<div class="pass">Poprawnie dodano nauczyciela</div>';
			}else{
				echo '<div class="error">Wystąpił błąd</div>';
			}
		}else{
			echo '<div class="error">Imię lub nazwisko nie może być puste!</div>';
		}
	}
    
    $sql_select = "SELECT * FROM teacher";
    if($result = $conn -> query($sql_select)){
        echo '<table>';
        echo '<tr><th>Imię</th><th>Nazwisko</th></tr>';
        while($row = $result -> fetch_assoc()){
			echo '<tr>';
            echo '<td>'.$row['first_name'].'</td>';
            echo '<td>'.$row['last_name'].'</td>';
            echo '</tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "error">Wystąpił błąd z pobraniem listy przedmiotów</div>';
		exit();
	}
?>