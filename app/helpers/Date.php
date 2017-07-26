<?php

class Date {
	public static $rus_months = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');

	public static function formatDate($date) {

	  $newDatetime = new Datetime($row_mysql['data']);
	  $month = $newDatetime->format('n');
	  $album_data = $newDatetime->format('j '.$rus_months[$month-1].'');
	  $album_data .= $newDatetime->format('Y г., H:m');
	  if (($newDatetime->format('H:i:s')) == '00:00:00')
	  {
	      $album_data = $newDatetime->format('j '.$rus_months[$month-1].'');
	      $album_data .= $newDatetime->format('Y г.');;
  	}

	}
}

 ?>