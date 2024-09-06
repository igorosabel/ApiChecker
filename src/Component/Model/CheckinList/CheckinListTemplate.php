<?php
use Osumi\OsumiFramework\App\Component\Model\Checkin\CheckinComponent;

foreach ($values['list'] as $i => $Checkin) {
  $component = new CheckinComponent([ 'Checkin' => $Checkin ]);
	echo strval($component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
