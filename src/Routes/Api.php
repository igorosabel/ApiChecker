<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\Routes;

use Osumi\OsumiFramework\Routing\ORoute;
use Osumi\OsumiFramework\App\Middleware\LoginMiddleware;
use Osumi\OsumiFramework\App\Module\Api\DeleteCheckin\DeleteCheckinComponent;
use Osumi\OsumiFramework\App\Module\Api\DeleteCheckinType\DeleteCheckinTypeComponent;
use Osumi\OsumiFramework\App\Module\Api\GetCheckinTypes\GetCheckinTypesComponent;
use Osumi\OsumiFramework\App\Module\Api\GetCheckins\GetCheckinsComponent;
use Osumi\OsumiFramework\App\Module\Api\Login\LoginComponent;
use Osumi\OsumiFramework\App\Module\Api\Register\RegisterComponent;
use Osumi\OsumiFramework\App\Module\Api\SaveCheckin\SaveCheckinComponent;
use Osumi\OsumiFramework\App\Module\Api\SaveCheckinType\SaveCheckinTypeComponent;

ORoute::prefix('/api', function() {
  ORoute::post('/delete-checkin',      DeleteCheckinComponent::class,     ['before' => [LoginMiddleware::class]]);
  ORoute::post('/delete-checkin-type', DeleteCheckinTypeComponent::class, ['before' => [LoginMiddleware::class]]);
  ORoute::post('/get-checkins',        GetCheckinsComponent::class,       ['before' => [LoginMiddleware::class]]);
  ORoute::post('/get-checkin-types',   GetCheckinTypesComponent::class,   ['before' => [LoginMiddleware::class]]);
  ORoute::post('/login',               LoginComponent::class);
  ORoute::post('/register',            RegisterComponent::class,);
  ORoute::post('/save-checkin',        SaveCheckinComponent::class,       ['before' => [LoginMiddleware::class]]);
  ORoute::post('/save-checkin-type',   SaveCheckinTypeComponent::class,   ['before' => [LoginMiddleware::class]]);
});
