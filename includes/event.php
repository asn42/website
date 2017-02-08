<?php
	// || Motif des events ||
	// ID => array(													**** ID -> a remplacer par un nombre unique et croissant par rapport aux autres (0,1,2,3,4,..)
	//		"type" => "[danger|warning|success|info|default]",		**** danger = rouge | warning = orange | success = vert | info = violet | default = sans fond.
	//		"title" => "[Atelier truc] 10/02 :",					**** "[Type de l'event] date/date :".
	//		"text" => 'TEXT',										**** Texte à afficher. Accepte le html a condition de bien mettre les simples quote ('').
	//	),
	$event = array(
	0 => array(
			"type" => "danger",
			"title" => "[Atelier Sécu] 10/02 :",
			"text" => 'Les failles du wifi par Xavier <a href="#" class="alert-link">+ d\'info</a>',
		),
	1 => array(
			"type" => "success",
			"title" => "[Atelier Sécu] 10/02 :",
			"text" => 'Les failles du wifi par Xavier <a href=# class="alert-link">+ d\'info</a>',
		),
	2 => array(
			"type" => "info",
			"title" => "[Atelier Sécu] 10/02 :",
			"text" => 'Les failles du wifi par Xavier <a href="#" class="alert-link">+ d\'info</a>',
		),
	);
?>