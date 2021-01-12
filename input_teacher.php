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
    
	//delete
	if(isset($_POST['delete'])){
		$id_delete = $_POST['delete'];
		if($conn -> query("DELETE FROM teacher WHERE id_teacher='$id_delete'")){
			echo '<div class="text-success">Rekord został usunięty</div>';
		}else{
			echo '<div class="text-danger">Wystąpił błąd</div>';
		}
	}
	
	//edit
	if(isset($_POST['edit'])){
		$id_edit = $_POST['edit'];
		$first_name = $_POST['new_first_name'];
		$last_name = $_POST['new_last_name'];
		if($conn -> query("UPDATE teacher SET first_name = '$first_name', last_name = '$last_name' WHERE id_teacher='$id_edit'")){
			echo '<div class="text-success">Rekord został zmieniony</div>';
		}else{
			echo '<div class="text-danger">Wystąpił błąd</div>';
		}
	}
	
	//list
    $sql_select = "SELECT * FROM teacher ORDER BY last_name, first_name";
    if($result = $conn -> query($sql_select)){
        echo '<table class="table table-dark">';
        echo '<tr class="row"><th class="col">Imię</th><th class="col">Nazwisko</th><th class="col">Akcja</th></tr>';
        while($row = $result -> fetch_assoc()){
			echo '<tr class="row">
				  <td class="col">'.$row['first_name'].'</td>
				  <td class="col">'.$row['last_name'].'</td>
				  <td class="col">
				  <button name="id_delete" value="'.$row['id_teacher'].'"type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Usuń</button>
				  <button id="edit_btn" type="button" value="'.$row['id_teacher'].'" class="btn btn-success">Edytuj</button></td>
				  </tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "text-danger">Wystąpił błąd z pobraniem listy przedmiotów</div>';
		exit();
	}
?>