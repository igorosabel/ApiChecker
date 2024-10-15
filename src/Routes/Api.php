<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\Routes;

use Osumi\OsumiFramework\Routing\ORoute;
use Osumi\OsumiFramework\App\Module\Api\DeleteCheckin\DeleteCheckinComponent;
use Osumi\OsumiFramework\App\Module\Api\DeleteCheckinType\DeleteCheckinTypeComponent;
use Osumi\OsumiFramework\App\Module\Api\GetCheckinTypes\GetCheckinTypesComponent;
use Osumi\OsumiFramework\App\Module\Api\GetCheckins\GetCheckinsComponent;
use Osumi\OsumiFramework\App\Module\Api\Login\LoginComponent;
use Osumi\OsumiFramework\App\Module\Api\Register\RegisterComponent;
use Osumi\OsumiFramework\App\Module\Api\SaveCheckin\SaveCheckinComponent;
use Osumi\OsumiFramework\App\Module\Api\SaveCheckinType\SaveCheckinTypeComponent;
use Osumi\OsumiFramework\App\Filter\LoginFilter;

ORoute::prefix('/api', function() {
  ORoute::post('/delete-checkin',      DeleteCheckinComponent::class,     [LoginFilter::class]);
  ORoute::post('/delete-checkin-type', DeleteCheckinTypeComponent::class, [LoginFilter::class]);
  ORoute::post('/get-checkins',        GetCheckinsComponent::class,       [LoginFilter::class]);
  ORoute::post('/get-checkin-types',   GetCheckinTypesComponent::class,   [LoginFilter::class]);
  ORoute::post('/login',               LoginComponent::class);
  ORoute::post('/register',            RegisterComponent::class,);
  ORoute::post('/save-checkin',        SaveCheckinComponent::class,       [LoginFilter::class]);
  ORoute::post('/save-checkin-type',   SaveCheckinTypeComponent::class,   [LoginFilter::class]);
});
