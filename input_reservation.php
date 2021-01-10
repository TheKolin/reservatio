<?php
	//insert
	if(isset($_POST['submit'])){
		$teacher = $_POST['teacher'];
		$room = $_POST['room'];
		$activities = $_POST['activities'];
		$group = $_POST['group'];
		$duration = $_POST['duration'] * 7;
		$date = strtotime($_POST["date"]);
        $time_start = strtotime($_POST["time_start"])-strtotime("today");
        $date_start = date("Y-m-d H:i:s", $date+$time_start);
        if(isset($_POST['custom_date'])){
            $time_end = strtotime($_POST["time_stop"])-strtotime("today");
            $date_end = date("Y-m-d H:i:s", $date+$time_end);
        }else{
            $date_end = date("Y-m-d H:i:s", strtotime("+1 hour +30 minutes", strtotime($date_start)));
        }
		
		//room
		$sql_check = "SELECT * FROM reservation WHERE id_room = '$room' AND (date >= '$date_start' AND date <= '$date_end' OR date_end >= '$date_start' AND date_end <= '$date_end')";
		if($result = $conn -> query($sql_check)){
			if($result -> num_rows > 0){
				echo '<div class="text-danger">Podana sala jest już zarezerwowana na tą godzinę!</div>';
			}else{
				
				//teacher
				$sql_check = "SELECT * FROM reservation WHERE id_teacher = '$teacher' AND (date >= '$date_start' AND date <= '$date_end' OR date_end >= '$date_start' AND date_end <= '$date_end')";
				if($result = $conn -> query($sql_check)){
					if($result -> num_rows > 0){
						echo '<div class="text-danger">Podany prowadzący jest już zarezerwowana na tą godzinę!</div>';
					}else{
						
						//group
						$sql_check = "SELECT * FROM reservation WHERE id_group = '$group' AND (date >= '$date_start' AND date <= '$date_end' OR date_end >= '$date_start' AND date_end <= '$date_end')";
						if($result = $conn -> query($sql_check)){
							if($result -> num_rows > 0){
								echo '<div class="text-danger">Podana grupa jest już zarezerwowana na tą godzinę!</div>';
							}else{
								if($duration == 0){
									$conn -> query($sql_input);
								}else{
									for($i=0; $i<18/($duration/7); $i++){
										$sql_input = "INSERT INTO reservation (id_reservation, id_teacher, id_activities, id_room, id_group, date, date_end) VALUES (NULL, '$teacher', '$activities', '$room', '$group', '$date_start', '$date_end');";
										$conn -> query($sql_input);
										$date_start = date("Y-m-d H:i:s", strtotime("+{$duration} day", strtotime($date_start)));
										$date_end = date("Y-m-d H:i:s", strtotime("+{$duration} day", strtotime($date_end)));
									}
								}
							}
						}else{
							echo '<div class="text-danger">Wystąpił błąd</div>';
						}				
					}
				}else{
					echo '<div class="text-danger">Wystąpił błąd</div>';
				}		
			}
		}else{
			echo '<div class="text-danger">Wystąpił błąd</div>';
		}
	}
    
	//delete
	if(isset($_POST['delete'])){
		$id_delete = $_POST['delete'];
		if($conn -> query("DELETE FROM reservation WHERE id_reservation='$id_delete'")){
			echo '<div class="text-success">Rekord został usunięty</div>';
		}else{
			echo '<div class="text-danger">Wystąpił błąd</div>';
		}
	}
	
	//list
    $sql_select = "SELECT reservation.id_reservation, teacher.first_name, teacher.last_name, activities.name, room.no_room, reservation.date, reservation.date_end, groups.profile, groups.semester, groups.type, groups.number FROM reservation JOIN room ON room.id_room = reservation.id_room JOIN teacher ON reservation.id_teacher = teacher.id_teacher JOIN activities ON reservation.id_activities = activities.id_activities JOIN groups ON groups.id_group = reservation.id_group GROUP BY teacher.first_name, teacher.last_name, activities.name, room.no_room, groups.profile, groups.semester, groups.type, groups.number";
	$dayofweek = array('Poniedziałki', 'Wtorki', 'Środy', 'Czwartki', 'Piątki');
    if($result = $conn -> query($sql_select)){
        echo '<table class="table table-dark col-sm-12">';
		echo '<tr class="col"><th class="">Imię</th><th class="">Nazwisko</th><th class="">Przedmiot</th><th class="">Sala</th><th class="">Grupa</th><th class="">Data</th><th>Akcja</th></tr>';
        while($row = $result -> fetch_assoc()){
    		echo '<tr class="">
				  <td >'.$row['first_name'].'</td>
				  <td >'.$row['last_name'].'</td>
				  <td >'.$row['name'].'</td>
				  <td >'.$row['no_room'].'</td>
				  <td >'.$row['profile'].'/'.$row['semester'].' '.$row['type'].$row['number'].'</td>
				  <td >'.$dayofweek[date("N", strtotime($row['date']))-1].'<br>'.date("H:i", strtotime($row['date'])).' - '.date("H:i", strtotime($row['date_end'])).'</td>
				  <td class="col">
				  <button type="button" class="btn btn-success">Więcej</button></td>
				  </tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "text-danger">Wystąpił błąd z pobraniem listy rezerwacji</div>';
		exit();
	}
?>