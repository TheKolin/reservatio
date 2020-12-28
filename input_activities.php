<?php 
	session_start();
    require ('conn.php');
	
	//insert
	if(isset($_POST['submit'])){
		$name = $conn -> real_escape_string($_POST['name']);
		if(!empty($name)){
			$sql_insert = "INSERT INTO activities (id_activities, name) VALUES (NULL, '$name')";
			if($conn -> query($sql_insert)){
				echo '<div class="pass">Poprawnie dodano przedmiot</div>';
			}else{
				echo '<div class="error">Wystąpił błąd</div>';
			}
		}else{
			echo '<div class="error">Nazwa przedmiotu nie może być pusta!</div>';
		}
	}
	
	//delete
	if(isset($_POST['delete'])){
		if($_POST['delete']){
			$_SESSION['delete'] = $_POST['delete'];
			echo '<div class="popup">
				  Czy na pewno chcesz usunąć ten rekord?
				  <form action="" method="POST">
				  <button type="submit" name="del" value="1">Tak</button>
				  <button type="submit" name="delete" value="">Nie</button>
				  </form>
				  </div>';
		}
	}
	
	if(isset($_POST['del'])){
		$conn -> query('DELETE FROM activities WHERE id_activities = '.$_SESSION['delete']);
	}
    
	//list
    $sql_select = "SELECT * FROM activities";
    if($result = $conn -> query($sql_select)){
        echo '<table>
              <tr><th>Numer przemiotu</th><th>Nazwa przemiotu</th></tr>';
		while($row = $result -> fetch_assoc()){
			echo '<tr>
				  <td>'.$row['id_activities'].'</td>
				  <td>'.$row['name'].'</td>
				  <td><button type="submit" name="delete" value="'.$row['id_activities'].'">Usuń</button>
				  </tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "error">Wystąpił błąd z pobraniem listy przedmiotów</div>';
		exit();
	}
?>