<?php 
    require ('conn.php');
	if(isset($_POST['submit'])){
		$firstname = $conn -> real_escape_string($_POST['firstname']);
		$lastname = $conn -> real_escape_string($_POST['lastname']);
		if(!empty($firstname) && !empty($lastname)){
			$sql = "INSERT INTO teacher (id_teacher, first_name, last_name) VALUES (NULL, '$firstname', '$lastname')";
			if($conn -> query($sql)){
				echo '<div class="text-success">Poprawnie dodano nauczyciela</div>';
			}else{
				echo '<div class="text-danger">Wystąpił błąd</div>';
			}
		}else{
			echo '<div class="text-danger">Imię lub nazwisko nie może być puste!</div>';
		}
	}
    
    $sql_select = "SELECT * FROM teacher";
    if($result = $conn -> query($sql_select)){
        echo '<table class="table table-dark">';
        echo '<tr class="row"><th class="col">Imię</th><th class="col">Nazwisko</th></tr>';
        while($row = $result -> fetch_assoc()){
			echo '<tr class="row">';
            echo '<td class="col" >'.$row['first_name'].'</td>';
            echo '<td class="col">'.$row['last_name'].'</td>';
            echo '</tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "text-danger">Wystąpił błąd z pobraniem listy przedmiotów</div>';
		exit();
	}
?>