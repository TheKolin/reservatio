<?php 
    require ('conn.php');
	
	//insert
	if(isset($_POST['submit'])){
		$no_room = $conn -> real_escape_string($_POST['no_room']);
		$description = $conn -> real_escape_string($_POST['description']);
		if(!empty($no_room) && !empty($description)){
			$sql = "INSERT INTO room (id_room, no_room, description) VALUES (NULL, '$no_room', '$description')";
			if($conn -> query($sql)){
				echo '<div class="text-success">Poprawnie dodano salę</div>';
			}else{
				echo '<div class="text-danger">Wystąpił błąd</div>';
			}
		}else{
			echo '<div class="text-danger">Numer sali oraz opis nie mogą być puste!</div>';
		}
	}
    
	//delete
	if(isset($_POST['delete'])){
		$id_delete = $_POST['delete'];
		if($conn -> query("DELETE FROM room WHERE id_room='$id_delete'")){
			echo '<div class="text-success">Rekord został usunięty</div>';
		}else{
			echo '<div class="text-danger">Wystąpił błąd</div>';
		}
	}
	
	//edit
	if(isset($_POST['edit'])){
		$id_edit = $_POST['edit'];
		$no_room = $_POST['new_no_room'];
		$description = $_POST['new_description'];
		if($conn -> query("UPDATE room SET no_room = '$no_room', description = '$description' WHERE id_room='$id_edit'")){
			echo '<div class="text-success">Rekord został zmieniony</div>';
		}else{
			echo '<div class="text-danger">Wystąpił błąd</div>';
		}
	}
	
	//list
    $sql_select = "SELECT * FROM room";
    if($result = $conn -> query($sql_select)){
        echo '<table class="table table-dark">';
        echo '<tr class="row"><th class="col">Numer sali</th><th class="col">Opis</th><th class="col">Akcja</th></tr>';
    	while($row = $result -> fetch_assoc()){
			echo '<tr class="row">
				  <td class="col">'.$row['no_room'].'</td>
				  <td class="col">'.$row['description'].'</td>
				  <td class="col">
				  <button name="id_delete" value="'.$row['id_room'].'"type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Usuń</button>
				  <button id="edit_btn" type="button" value="'.$row['id_room'].'" class="btn btn-success">Edytuj</button></td>;
				  </tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "error">Wystąpił błąd z pobraniem listy przedmiotów</div>';
		exit();
	}
?>