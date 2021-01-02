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
	
    
	//list
    $sql_select = "SELECT * FROM activities";
    if($result = $conn -> query($sql_select)){
        echo '<table class="table table-dark">
              <tr class="row"><th class="col">Numer przemiotu</th><th class="col">Nazwa przemiotu</th><th class="col">Akcja</th></tr>';
		while($row = $result -> fetch_assoc()){
			echo '<tr class="row">
				  <td class="col">'.$row['id_activities'].'</td>
				  <td class="col">'.$row['name'].'</td>
				  <td class="col">
				  <button class="btn btn-danger" type="submit" name="delete" value="'.$row['id_activities'].'">Usuń</button>
				  </tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "text-danger">Wystąpił błąd z pobraniem listy przedmiotów</div>';
		exit();
	}
?>