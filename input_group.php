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
	
	
	//list
    $sql_select = "SELECT * FROM groups";
    if($result = $conn -> query($sql_select)){
        echo '<table class="table table-dark">';
        echo '<tr class="row"><th class="col">Kierunek</th><th class="col">Semestr</th><th class="col">Grupa</th><th class="col">Akcja</th></tr>';
        while($row = $result -> fetch_assoc()){
			echo '<tr class="row">
				  <td class="col">'.$row['profile'].'</td>
				  <td class="col">'.$row['semester'].'</td>
				  <td class="col">'.$row['type'].$row['number'].'</td>
				  <td class="col">
				  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
  Usuń
</button>
<button type="button" class="btn btn-success">Edytuj</button></td>
				  </tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "text-danger">Wystąpił błąd z pobraniem listy grup</div>';
		exit();
	}
?>