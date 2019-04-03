<?php
// echo "<pre>";


$current_month = date('m');
$current_year = date('Y');

//echo "<br/>";

$month_1 = date('m', strtotime('+1 month'));
$year_1  = date('Y', strtotime('+1 month'));


$month_2 = date('m', strtotime('+2 month'));
$year_2  = date('Y', strtotime('+2 month'));




//print_r($dates);
//print_r($dates_1);


$data['date_from_databse'] = array('2019-04-01','2019-04-08','2019-05-04');





function getDates($month,$year,$data=NULL){
	if($data == NULL){
		$data['date_from_databse'] = '';
	}



	$start_date = "01-".$month."-".$year;
	$start_time = strtotime($start_date);

	$end_time = strtotime("+1 month", $start_time);

	$p=0;
	for($i=$start_time; $i<$end_time; $i+=86400)
	{
	   $list[$p]['original_date'] = date('Y-m-d', $i);
	   $list[$p]['day'] = date('D', $i);
	   $list[$p]['date'] = date('d', $i);
	   $p++;
	}

	//return $list;
	//print_r($list);
	$dates = $list;
	if($dates != NULL){

		$display_month = date("F", strtotime(date("Y") ."-". $month ."-01"));

	$calendar_string = "
	<h3 class='card-header' id='monthAndYear'>".$display_month." ".$year."</h3>
	<table class='table table-bordered table-responsive-sm' id='calendar'>
	<thead>
	<th>SUN</th>
	<th>MON</th>
	<th>TUE</th>
	<th>WED</th>
	<th>THU</th>
	<th>FRI</th>
	<th>SAT</th>
	</thead>
	<tr>";

	if($dates[0]['day'] == 'Sun'){

	} else if($dates[0]['day'] == 'Mon') {
		$calendar_string .= "<td>&nbsp;</td>";
	}else if($dates[0]['day'] == 'Tue') {
		$calendar_string .= "<td>&nbsp;</td><td>&nbsp;</td>";
	}else if($dates[0]['day'] == 'Wed') {
		$calendar_string .= "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}else if($dates[0]['day'] == 'Thu') {
		$calendar_string .= "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}else if($dates[0]['day'] == 'Fri') {
		$calendar_string .= "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}else if($dates[0]['day'] == 'Sat') {
		$calendar_string .= "<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>";
	}


	for($i=0;$i<count($dates);$i++){

		//check database dates with calendar dates

		if(in_array($dates[$i]['original_date'], $data['date_from_databse'])) {
			$calendar_string .= "<td class='blocked_dates'> ".$dates[$i]['date']."</td>";
		} else {
			$calendar_string .= "<td class='available_dates'> <a href='#' > ".$dates[$i]['date']." </a> </td>";
		}

		

		if($dates[$i]['day'] == 'Sat'){
			$calendar_string .= "</tr><tr>";
		}
	}

	$calendar_string .= "</tr></table>";

	

	}

	return $calendar_string;
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PHP Calendar</title>

    <style type="text/css">
    	.blocked_dates {
    		background-color: #ccc;
    	}

    	.available_dates a {
    		display: block;
    	}

    	.selected_dates {
    		background-color: #32CD32;
    	}
    </style>


  </head>
  <body>
  	<div class="container">
  		

   
    	<?php

				// call functions
				echo $dates = "<p>".getDates($current_month,$current_year,$data)."</p>";
				echo "<br/>";
				echo $dates_1 = "<p>".getDates($month_1,$year_1,$data)."</p>";
				echo "<br/>";
				echo $dates_2 = "<p>".getDates($month_2,$year_2,$data)."</p>";
    	?>
    
    	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <script type="text/javascript">
    	
    	$(document).ready(function() {

    		var minimum_day_selection = 1;

    		$(".available_dates").click(function() {
    			
    			$('#calendar td').removeClass('selected_dates');

    			 $(this).addClass('selected_dates');

    			 $(this).nextAll('.available_dates').slice(0, minimum_day_selection).addClass('selected_dates');
    			 // if(minimum_day_selection == 2) {

    			 // }
    		});


    	});

    </script>


  </body>
</html>