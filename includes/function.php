<?php

function print_event($event)
{
	foreach ($event as $key => $value) {
		echo '<div class="alert alert-dismissible alert-'.$value["type"].'">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<b>'.$value["title"].'</b> '.$value["text"].'</div>';
	}
}
?>