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
	
	
	//list
    $sql_select = "SELECT * FROM room";
    if($result = $conn -> query($sql_select)){
        echo '<table class="table table-dark">';
        echo '<tr class="row"><th class="col">Numer sali</th><th class="col">Opis</th><th class="col">Akcja</th></tr>';
    	while($row = $result -> fetch_assoc()){
			echo '<tr class="row">';
            echo '<td class="col">'.$row['no_room'].'</td>';
			echo '<td class="col">'.$row['description'].'</td>';
			echo '<td class="col">
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
Usuń
</button>
<button type="button" class="btn btn-success">Edytuj</button></td>';
            echo '</tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "error">Wystąpił błąd z pobraniem listy przedmiotów</div>';
		exit();
	}
?>