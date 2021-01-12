<?php
	session_start();
	require('conn.php');
	
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
	if(isset($_POST['id_day'])){
		$_SESSION['id_day'] = $_POST['id_day'];
	}
	$id_day = $_SESSION['id_day'];
    $sql_select = "SELECT reservation.id_day, reservation.id_reservation, teacher.first_name, teacher.last_name, activities.name, room.no_room, reservation.date, reservation.date_end, groups.profile, groups.semester, groups.type, groups.number FROM reservation JOIN room ON room.id_room = reservation.id_room JOIN teacher ON reservation.id_teacher = teacher.id_teacher JOIN activities ON reservation.id_activities = activities.id_activities JOIN groups ON groups.id_group = reservation.id_group WHERE id_day = '$id_day' ORDER BY reservation.date DESC";
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
				  <td >'.date("d-m-Y", strtotime($row['date'])).'<br>'.date("H:i", strtotime($row['date'])).' - '.date("H:i", strtotime($row['date_end'])).'</td>
				  <td class="col">
				  <button type="submit" name="delete" value="'.$row['id_reservation'].'" class="btn btn-danger">Usuń</button></td>
				  </tr>';
		}
        echo '</table>';
	}else{
		echo '<div class = "text-danger">Wystąpił błąd z pobraniem listy rezerwacji</div>';
		exit();
	}
?>