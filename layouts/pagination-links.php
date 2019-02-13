<?php
$pagLink = '<ul class="pagination ml-1">';
for ($i=1; $i<=$total_pages; $i++) {
	$activeClass = "";
	if(empty($_GET['page'])) {
		$_GET['page'] = 1;	
	}
	if($i == $_GET['page']) {
		$activeClass = " active";
	}
	$pagLink.= '<li class="page-item'.$activeClass.'">';
	$pagLink.= "<a class='page-link' href='?page=".$i."&filter_keyword=".$searchWith."'>".$i."</a>";
	$pagLink.= "</li>";
};  
echo $pagLink."</ul>";
?>