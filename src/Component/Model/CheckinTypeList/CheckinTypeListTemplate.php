<?php
use Osumi\OsumiFramework\App\Component\Model\CheckinType\CheckinTypeComponent;

foreach ($values['list'] as $i => $CheckinType) {
  $component = new CheckinTypeComponent([ 'CheckinType' => $CheckinType ]);
	echo strval($component);
	if ($i<count($values['list'])-1) {
		echo ",\n";
	}
}
