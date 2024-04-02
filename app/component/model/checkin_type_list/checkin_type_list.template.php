<?php
use OsumiFramework\App\Component\Model\CheckinTypeComponent;

foreach ($values['list'] as $i => $checkintype) {
  $component = new CheckinTypeComponent([ 'checkintype' => $checkintype ]);
	echo strval($component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
