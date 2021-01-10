<?php 
    require ('conn.php');
	
	//insert
	if(isset($_POST['submit'])){
		$name = $conn -> real_escape_string($_POST['name']);
		if(!empty($name)){
			$sql_insert = "INSERT INTO activities (id_activities, name) VALUES (NULL, '$name')";
			if($conn -> query($sql_insert)){
				echo '<div class="text-success">Poprawnie dodano przedmiot</div>';
			}else{
				echo '<div class="text-danger">Wystąpił błąd</div>';
			}
		}else{
			echo '<div class="text-danger">Nazwa przedmiotu nie może być pusta!</div>';
		}
	}
	echo '</br>';
	
	//delete
	if(isset($_POST['delete'])){
		$id_delete = $_POST['delete'];
		if($conn -> query("DELETE FROM activities WHERE id_activities='$id_delete'")){
			echo '<div class="text-success">Rekord został usunięty</div>';
		}else{
			echo '<div class="text-danger">Wystąpił błąd</div>';
		}
	}
	
	//edit
	if(isset($_POST['edit'])){
		$id_edit = $_POST['edit'];
		$name = $_POST['new_name'];
		if($conn -> query("UPDATE activities SET name = '$name' WHERE id_activities='$id_edit'")){
			echo '<div class="text-success">Rekord został zmieniony</div>';
		}else{
			echo '<div class="text-danger">Wystąpił błąd</div>';
		}
	}
    
	//list
    $sql_select = "SELECT * FROM activities";
    if($result = $conn -> query($sql_select)){
        echo '<table class="table table-dark">
              <tr class="row"><th class="col">Numer przemiotu</th><th class="col">Nazwa przemiotu</th><th class="col">Akcja</th></tr>';
		while($row = $result -> fetch_assoc()){
			echo '<tr class="row">
				  <td class="col">'.$row['name'].'</td>
				  <td class="col">
				  <button name="id_delete" value="'.$row['id_activities'].'"type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Usuń</button>
				  <button id="edit_btn" type="button" value="'.$row['id_activities'].'" class="btn btn-success">Edytuj</button></td>
				  </tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "text-danger">Wystąpił błąd z pobraniem listy przedmiotów</div>';
		exit();
	}
?>