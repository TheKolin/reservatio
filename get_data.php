<?php 
	require('conn.php');
	$sql_teacher = "SELECT * FROM teacher ORDER BY last_name, first_name";
	$sql_room = "SELECT * FROM room ORDER BY no_room";
	$sql_activities = "SELECT * FROM activities ORDER BY name";
	$sql_group = "SELECT * FROM groups ORDER BY profile, semester, type, number";

	//start row
    echo '<tr>';
    
	//Teacher
    echo '<td>';
	if($result = $conn -> query($sql_teacher)){
		echo '<select name = "teacher">';
        echo '<option disabled selected value> -- Wybierz prowadzącego -- </option>';
		while($row = $result -> fetch_assoc()){
			echo '<option value = '.$row['id_teacher'].'>'.$row['last_name'].' '.$row['first_name'].'</option>';
		}
		echo '</select>';
	}else{
		echo '<div class = "error">Wystąpił błąd z pobraniem listy nauczycieli</div>';
		exit();
	}
    echo '</td>';
	
	//Room
    echo '<td>';
	if($result = $conn -> query($sql_room)){
		echo '<select name = "room">';
        echo '<option disabled selected value> -- Wybierz salę -- </option>';
		while($row = $result -> fetch_assoc()){
			echo '<option value = '.$row['id_room'].'>'.$row['no_room'].' '.$row['description'].'</option>';
		}
		echo '</select>';
	}else{
		echo '<div class = "error">Wystąpił błąd z pobraniem listy sal</div>';
		exit();
	}
    echo '</td>';
	
	//Activities
    echo '<td>';
	if($result = $conn -> query($sql_activities)){
		echo '<select name = "activities">';
        echo '<option disabled selected value> -- Wybierz przedmiot -- </option>';
		while($row = $result -> fetch_assoc()){
			echo '<option value = '.$row['id_activities'].'>'.$row['name'].'</option>';
		}
		echo '</select>';
	}else{
		echo '<div class = "error">Wystąpił błąd z pobraniem listy przemiotów</div>';
		exit();
	}
    echo '</td>';
	
	//Group
    echo '<td>';
	if($result = $conn -> query($sql_group)){
		$last_group = FALSE;
		echo '<select name = "group">';
        echo '<option disabled selected value> -- Wybierz grupę -- </option>';
		while($row = $result -> fetch_assoc()){
			if($last_group == FALSE || $last_group <> $row['profile'].'/'.$row['semester']){
				$last_group = $row['profile'].'/'.$row['semester'];
				echo '<optgroup label="'.$last_group.'">';
			}
			echo '<option value = '.$row['id_group'].'>'.$row['type'].$row['number'].'</option>';
		}
		echo '</select>';
	}else{
		echo '<div class = "error">Wystąpił błąd z pobraniem listy grup</div>';
		exit();
	}
    echo '</td>';
    
    //other inputs
	echo '<td><select name="duration">';
	echo '<option disabled selected value> -- Wybierz okres -- </option>';
	echo '<option value = "0">Jednorazowo</option>';
	echo '<option value = "1">Co tydzień</option>';
	echo '<option value = "2">Co dwa tygodnie</option>';
	echo '</select></td>';
	echo '<td><input type="date" name="date"></td>';
    echo '<td><input type="time" name="time_start"></td>';
    echo '<td class="hidden"></td>';
    echo '<td><input type="submit" name="submit" value="Zarezerwuj"></td>';
    
    //end row
    echo '</tr>';
?>