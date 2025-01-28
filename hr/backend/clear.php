<?php
session_start();


if (isset($_SESSION['filtered_jobpostings'])){
  unset($_SESSION['filtered_jobpostings']);
}

else if (isset($_SESSION['filterjoinedData'])){
	unset($_SESSION['filterjoinedData']);
}

else if (isset($_SESSION['filterinterviewData'])){
	unset($_SESSION['filterinterviewData']);
}


?>