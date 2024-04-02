<?php
use OsumiFramework\App\Component\Model\CheckinComponent;

foreach ($values['list'] as $i => $checkin) {
  $component = new CheckinComponent([ 'checkin' => $checkin ]);
	echo strval($component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
