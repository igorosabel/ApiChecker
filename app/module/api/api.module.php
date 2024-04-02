<?php declare(strict_types=1);

namespace OsumiFramework\App\Module;

use OsumiFramework\OFW\Routing\OModule;

#[OModule(
	actions: ['register'],
	type: 'json',
	prefix: '/api'
)]
class apiModule {}
