<?php 
	session_start();
    require ('conn.php');
	if(isset($_POST['submit'])){
		$profile = $conn -> real_escape_string($_POST['profile']);
		$semester = $conn -> real_escape_string($_POST['semester']);
		$type = $conn -> real_escape_string($_POST['type']);
		$number = $conn -> real_escape_string($_POST['number']);
		if(!empty($profile) && !empty($semester) && !empty($type) && !empty($number)){
			$sql = "INSERT INTO groups (id_group, profile, semester, type, number) VALUES (NULL, '$profile', '$semester', '$type', '$number')";
			if($conn -> query($sql)){
				echo '<div class="pass">Poprawnie dodano grupę</div>';
			}else{
				echo '<div class="error">Wystąpił błąd</div>';
			}
		}else{
			echo '<div class="error">Wszystkie pola muszą być wypełnione!</div>';
		}
	}
    
    $sql_select = "SELECT * FROM groups";
    if($result = $conn -> query($sql_select)){
        echo '<table>';
        echo '<tr><th>Kierunek</th><th>Semestr</th><th>Grupa</th></tr>';
        while($row = $result -> fetch_assoc()){
			echo '<tr>
				  <td>'.$row['profile'].'</td>
				  <td>'.$row['semester'].'</td>
				  <td>'.$row['type'].$row['number'].'</td>
				  <td><button type="submit" name="delete" value="'.$row['id_group'].'">Usuń</button>
				  </tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "error">Wystąpił błąd z pobraniem listy grup</div>';
		exit();
	}
	
	//delete
	if(isset($_POST['delete'])){
		$_SESSION['delete'] = $_POST['delete'];
		echo '<div class="popup">
			  Czy na pewno chcesz usunąć ten rekord?
			  <form action="" method="POST">
			  <button type="submit" name="del" value="1">Tak</button>
			  <button type="submit" name="delete" value="">Nie</button>
			  </form>
			  </div>';
	}
	
	if(isset($_POST['del'])){
		echo $_SESSION['delete'];
	}
?>