<?php 
	session_start();
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
		if($_POST['delete']){
			$_SESSION['delete'] = $_POST['delete'];
			echo '<div class="text-warning">
				  Czy na pewno chcesz usunąć ten rekord?
				  <form action="" method="POST">
				  <button type="submit" name="del" value="1" class="btn btn-primary">Tak</button>
				  <button type="submit" name="delete" value="" class="btn btn-secondary">Nie</button>
				  </form>
				  </div>
				  ';
		}
	}
	
	if(isset($_POST['del'])){
		$conn -> query('DELETE FROM activities WHERE id_activities = '.$_SESSION['delete']);
	}
    
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