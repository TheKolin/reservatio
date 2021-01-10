<?php
    require ('conn.php');
	
	//insert
	if(isset($_POST['submit'])){
		$profile = $conn -> real_escape_string($_POST['profile']);
		$semester = $conn -> real_escape_string($_POST['semester']);
		$type = $conn -> real_escape_string($_POST['type']);
		$number = $conn -> real_escape_string($_POST['number']);
		if(!empty($profile) && !empty($semester) && !empty($type) && !empty($number)){
			$sql = "INSERT INTO groups (id_group, profile, semester, type, number) VALUES (NULL, '$profile', '$semester', '$type', '$number')";
			if($conn -> query($sql)){
				echo '<div class="text-success">Poprawnie dodano grupę</div>';
			}else{
				echo '<div class="text-danger">Wystąpił błąd</div>';
			}
		}else{
			echo '<div class="text-danger">Wszystkie pola muszą być wypełnione!</div>';
		}
	}
    
	//delete 
	if(isset($_POST['delete'])){
		$id_delete = $_POST['delete'];
		if($conn -> query("DELETE FROM groups WHERE id_group='$id_delete'")){
			echo '<div class="text-success">Rekord został usunięty</div>';
		}else{
			echo '<div class="text-danger">Wystąpił błąd</div>';
		}
	}
	
	//edit
	if(isset($_POST['edit'])){
		$id_edit = $_POST['edit'];
		$profile = $_POST['new_profile'];
		$semester = $_POST['new_semester'];
		$type = $_POST['new_type'];
		$number = $_POST['new_number'];
		if($conn -> query("UPDATE groups SET profile = '$profile', semester = '$semester', type = '$type', number = '$number' WHERE id_group='$id_edit'")){
			echo '<div class="text-success">Rekord został zmieniony</div>';
		}else{
			echo '<div class="text-danger">Wystąpił błąd</div>';
		}
	}
	
	//list
    $sql_select = "SELECT * FROM groups";
    if($result = $conn -> query($sql_select)){
        echo '<table class="table table-dark">';
        echo '<tr class="row"><th class="col">Kierunek</th><th class="col">Semestr</th><th class="col">Grupa</th><th class="col">Numer</th><th class="col">Akcja</th></tr>';
        while($row = $result -> fetch_assoc()){
			echo '<tr class="row">
				  <td class="col">'.$row['profile'].'</td>
				  <td class="col">'.$row['semester'].'</td>
				  <td class="col">'.$row['type'].'</td>
				  <td class="col">'.$row['number'].'</td>
				  <td class="col">
				  <button name="id_delete" value="'.$row['id_group'].'"type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Usuń</button>
				  <button id="edit_btn" type="button" value="'.$row['id_group'].'" class="btn btn-success">Edytuj</button></td>
				  </tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "text-danger">Wystąpił błąd z pobraniem listy grup</div>';
		exit();
	}
?>