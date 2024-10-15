<?php
use Osumi\OsumiFramework\App\Component\Model\CheckinType\CheckinTypeComponent;

foreach ($list as $i => $checkintype) {
  $component = new CheckinTypeComponent([ 'checkintype' => $checkintype ]);
	echo strval($component);
	if ($i < count($list) - 1) {
		echo ",\n";
	}
}
