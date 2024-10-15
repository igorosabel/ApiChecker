<?php
use Osumi\OsumiFramework\App\Component\Model\Checkin\CheckinComponent;

foreach ($list as $i => $checkin) {
  $component = new CheckinComponent([ 'checkin' => $checkin ]);
	echo strval($component);
	if ($i < count($list) - 1) {
		echo ",\n";
	}
}
