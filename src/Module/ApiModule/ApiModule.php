<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\App\Module\ApiModule;

use Osumi\OsumiFramework\Routing\OModule;

#[OModule(
	type: 'json',
	prefix: '/api',
	actions: ['Register', 'Login', 'GetCheckins', 'GetCheckinTypes', 'SaveCheckinType', 'DeleteCheckinType', 'UpdateProfile', 'SaveCheckin', 'DeleteCheckin']
)]
class ApiModule {}
