<?php 
	$rec_limit = RECORDS_PER_PAGE;
	if( isset($_GET['page'] ) ) {
	    $page = $_GET['page'] - 1;
	    $offset = $rec_limit * $page ;
	}else {
	    $page = 0;
	    $offset = 0;
	}
	$left_rec = $rec_count - ($page * $rec_limit);
    $total_pages = ceil($rec_count / $rec_limit);
?>