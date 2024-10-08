<?php declare(strict_types=1);

namespace Osumi\OsumiFramework\Routes;

use Osumi\OsumiFramework\Routing\ORoute;
use Osumi\OsumiFramework\App\Module\Api\DeleteCheckin\DeleteCheckinAction;
use Osumi\OsumiFramework\App\Module\Api\DeleteCheckinType\DeleteCheckinTypeAction;
use Osumi\OsumiFramework\App\Module\Api\GetCheckinTypes\GetCheckinTypesAction;
use Osumi\OsumiFramework\App\Module\Api\GetCheckins\GetCheckinsAction;
use Osumi\OsumiFramework\App\Module\Api\Login\LoginAction;
use Osumi\OsumiFramework\App\Module\Api\Register\RegisterAction;
use Osumi\OsumiFramework\App\Module\Api\SaveCheckin\SaveCheckinAction;
use Osumi\OsumiFramework\App\Module\Api\SaveCheckinType\SaveCheckinTypeAction;
use Osumi\OsumiFramework\App\Filter\LoginFilter;

ORoute::group('/api', 'json', function() {
  ORoute::post('/delete-checkin',      DeleteCheckinAction::class,     [LoginFilter::class]);
  ORoute::post('/delete-checkin-type', DeleteCheckinTypeAction::class, [LoginFilter::class]);
  ORoute::post('/get-checkins',        GetCheckinsAction::class,       [LoginFilter::class]);
  ORoute::post('/get-checkin-types',   GetCheckinTypesAction::class,   [LoginFilter::class]);
  ORoute::post('/login',               LoginAction::class);
  ORoute::post('/register',            RegisterAction::class,);
  ORoute::post('/save-checkin',        SaveCheckinAction::class,       [LoginFilter::class]);
  ORoute::post('/save-checkin-type',   SaveCheckinTypeAction::class,   [LoginFilter::class]);
});
