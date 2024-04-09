<?php declare(strict_types=1);

namespace OsumiFramework\App\Module;

use OsumiFramework\OFW\Routing\OModule;

#[OModule(
	actions: ['register', 'login', 'getCheckins', 'getCheckinTypes', 'saveCheckinType', 'deleteCheckinType', 'updateProfile', 'saveCheckin', 'deleteCheckin'],
	type: 'json',
	prefix: '/api'
)]
class apiModule {}
