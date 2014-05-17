<?php 
	//	ZUFALLSGENERATOR LIEFERT WERT ZWISCHEN min UND max
	function getRandomNumber ($min,$max) {
		return rand($min,$max);
	}
	//	DATEN DER NÄCHSTEN SIEBEN TAGE ERRECHNEN (VON AKTUELLEM DATUM BEGONNEN)
	$date = Array();
	for($i=0; $i<=6; $i++){
		$date[$i] = date('Y-m-d', mktime(0,0,0,date('n'), date('d')+$i, date('Y')));	
	}
	//	WINDRICHTUNGEN IN ARRAY SPEICHERN
	$wind = Array('NN','N','NO','O','SO','S','SW','W','NW');
	//	FÜR ALLE TAGE DIE WETTERDATEN AUSGEBEN
	foreach ($date as $i) {
		// F�R ALLE REGIONEN DIE WETTERDATEN AUSGEBEN
		for ($j = 1; $j <8; $j++) {
			// MINIMUM TEMPERATUR ZWISCHEN -25 UND PLUS 25 GENERIEREN
			$temp_min = getRandomNumber(-25,25);
			// MAXIMAL TEMPERATUR ERZEUGEN (ADDITION VON MINIMALTEMPRATUR PLUS ZUFALLSZAHL)
			$temp_max = $temp_min + getRandomNumber(5,10);
			// ZUFÄLLIGER WINDWERT ERZEUGEN
			$windrichtung = $wind[getRandomNumber(0,8)];
			//	WINDSTÄRKE AUF 0 SETZEN WENN RICHTUNG NN IST SONST ZUFALLSLWERT
			if ($windrichtung == 'NN') {
				$windstaerke = 0;
			} else {
				$windstaerke = getRandomNumber(5,120);
			}
			echo $i.';'.$j.';'.getRandomNumber(1,5).';'.$temp_min.'/'.$temp_max.';'.$windrichtung.'/'.$windstaerke.';'.getRandomNumber(0,3)."\n";
		}
	}
?>