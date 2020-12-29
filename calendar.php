<?php
	require('conn.php');
	
	//groups
	$sql_group = "SELECT profile, semester FROM groups";
	echo '<form action="" method = "GET" class="form form-control-sm">';
	if($result = $conn -> query($sql_group)){
		echo '<select name = "group" onchange="this.form.submit()" class="form-control">';
        echo '<option disabled selected value> -- Wybierz grupę -- </option>';
		while($row = $result -> fetch_assoc()){
			echo '<option value = '.$row['profile'].'/'.$row['semester'].'>'.$row['profile'].'/'.$row['semester'].' '.$row['type'].$row['number'].'</option>';
		}
		echo '</select>';
	}else{
		echo '<div class = "bg-danger">Wystąpił błąd z pobraniem listy grup</div>';
		exit();
	}
	echo '</form>';
	
	//date
	if(isset($_POST['date'])){
		$date = $_POST['date'];
	}else{
		$date = date('Y-m-d H:i:s', mktime(0,0,0));
		if(date('N', time()) == 6 || date('N', time()) == 7){
			$date = date('Y-m-d H:i:s', strtotime('previous monday', strtotime($date)));
		}
		
	}
	
	if(isset($_POST['submit'])){
		if($_POST['submit']){
			$date = date("Y-m-d H:i:s", strtotime("+7 days", strtotime($date)));
		}else{
			$date = date("Y-m-d H:i:s", strtotime("-7 days", strtotime($date)));
		}
	}
	
	if(date('N', strtotime($date)) == 1){
		$mon = date('Y-m-d H:i:s', strtotime($date));
	}else{
		$mon = date('Y-m-d H:i:s', strtotime('previous monday', strtotime($date)));
	}
	
	if(date('N', strtotime($date)) == 5){
		$fri = date('Y-m-d H:i:s', strtotime($date));
	}else{
		$fri = date('Y-m-d H:i:s', strtotime('next friday', strtotime($date)));
	}
	echo '</br>';
	echo '<p class="h4">Tydzień</p>';
	echo '<form action="" method="POST">';
	echo '<button name="submit" type="submit" value="0" class="btn btn-light">Poprzedni</button>';
	echo date('Y-m-d', strtotime($mon)).' / '.date('Y-m-d', strtotime($fri));
	echo '<button name="submit" type="submit" value="1" class="btn btn-light">Następny</button>';
	echo '<input type="hidden" name="date" value="'.$date.'">';
	echo '</form></br>';
	
	//table
	if( isset($_GET['group']) ){
    $group = $_GET['group'];
    $group_exp = explode('/', $group);
    $dayofweek = array('Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek');
    
    
    $sql_activities = "
        SELECT 
            teacher.first_name, teacher.last_name,
            activities.name,
            room.no_room,
            reservation.date,   reservation.date_end,
            groups.profile,     groups.semester,      groups.type, groups.number,
            WEEKDAY(reservation.date) AS dayofweek
        FROM reservation 
            JOIN room       ON room.id_room              = reservation.id_room 
            JOIN teacher    ON reservation.id_teacher    = teacher.id_teacher 
            JOIN activities ON reservation.id_activities = activities.id_activities 
            JOIN groups     ON groups.id_group           = reservation.id_group 
        WHERE ( WEEKDAY(reservation.date) BETWEEN 0 AND 5 )
            AND ( groups.profile     = ? 
                AND groups.semester  = ? ) 
            AND ( reservation.date   > ? 
                AND reservation.date < ? ) 
        ORDER BY reservation.date
    ";
    $result = $conn->prepare($sql_activities);
    $result->bind_param("ssss", $group_exp[0], $group_exp[1], $mon, $fri);
    $result->execute();
    $result = $result->get_result();
    
	$last_day = FALSE;
	echo '<div id="tablemain">';
    echo '<table class="table table-dark offset-md-1">';

    while( $row = $result->fetch_assoc() ){
		if($row['dayofweek']>0 && $last_day === FALSE){
			for($i=0; $i<$row['dayofweek']; $i++){
				echo "<tr class='col-sm-12 col-md-2'><th class='col'>{$dayofweek[$i]}</th></tr>";
			}
		}
        if( $last_day == FALSE || $last_day <> $row['dayofweek'] ){
            echo ( $last_day ) ? '</tr><tr class="col-sm-12 col-md-2">' : '<tr class="col-sm-12 col-md-2">';
            $last_day = $row['dayofweek'];
            echo '<th class="col">'.$dayofweek[$last_day].'</th>';
        }
        echo "<td>
            {$row['name']}<br>
			{$row['type']}{$row['number']}<br>
            {$row['first_name']} {$row['last_name']}<br>
            Sala {$row['no_room']}<br>
            od godz ".
            date("H:i", strtotime($row['date'])).'-'.
            date("H:i", strtotime($row['date_end']))
            .'</td>';
    }
	if($last_day < 5){
		for($i=$last_day+1; $i<5; $i++){
			echo "<tr class='col-sm-12 col-md-2'><th class='col'>{$dayofweek[$i]}</th></tr>";
		}
	}
    echo '</tr></table></div>';
}
?>