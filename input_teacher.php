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
	
	//list
    $sql_select = "SELECT * FROM teacher";
    if($result = $conn -> query($sql_select)){
        echo '<table class="table table-dark">';
        echo '<tr class="row"><th class="col">Imię</th><th class="col">Nazwisko</th><th class="col">Akcja</th></tr>';
        while($row = $result -> fetch_assoc()){
			echo '<tr class="row">';
            echo '<td class="col" >'.$row['first_name'].'</td>';
			echo '<td class="col">'.$row['last_name'].'</td>';
			echo '<td class="col">
			<button name="id_delete" value="'.$row['id_teacher'].'"type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
Usuń
</button> <button type="button" class="btn btn-success">Edytuj</button></td>';
            echo '</tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "text-danger">Wystąpił błąd z pobraniem listy przedmiotów</div>';
		exit();
	}
?>