<?php declare(strict_types=1);

use Osumi\OsumiFramework\App\Module\Api\DeleteCheckin\DeleteCheckinAction;
use Osumi\OsumiFramework\App\Module\Api\DeleteCheckinType\DeleteCheckinTypeAction;
use Osumi\OsumiFramework\App\Module\Api\GetCheckinTypes\GetCheckinTypesAction;
use Osumi\OsumiFramework\App\Module\Api\GetCheckins\GetCheckinsAction;
use Osumi\OsumiFramework\App\Module\Api\Login\LoginAction;
use Osumi\OsumiFramework\App\Module\Api\Register\RegisterAction;
use Osumi\OsumiFramework\App\Module\Api\SaveCheckin\SaveCheckinAction;
use Osumi\OsumiFramework\App\Module\Api\SaveCheckinType\SaveCheckinTypeAction;

use Osumi\OsumiFramework\App\Filter\LoginFilter;
use Osumi\OsumiFramework\App\Service\WebService;

$urls = [
  [
    'url' => '/api/delete-checkin',
    'action' => DeleteCheckinAction::class,
    'filters' => [LoginFilter::class],
    'type' => 'json'
  ],
  [
    'url' => '/api/delete-checkin-type',
    'action' => DeleteCheckinTypeAction::class,
    'filters' => [LoginFilter::class],
    'type' => 'json'
  ],
  [
    'url' => '/api/get-checkin-types',
    'action' => GetCheckinTypesAction::class,
    'filters' => [LoginFilter::class],
    'services' => [WebService::class],
    'type' => 'json'
  ],
  [
    'url' => '/api/get-checkins',
    'action' => GetCheckinsAction::class,
    'filters' => [LoginFilter::class],
    'services' => [WebService::class],
    'type' => 'json'
  ],
  [
    'url' => '/api/login',
    'action' => LoginAction::class,
    'services' => [WebService::class],
    'type' => 'json'
  ],
  [
    'url' => '/api/register',
    'action' => RegisterAction::class,
    'type' => 'json'
  ],
  [
    'url' => '/api/save-checkin',
    'action' => SaveCheckinAction::class,
    'filters' => [LoginFilter::class],
    'services' => [WebService::class],
    'type' => 'json'
  ],
  [
    'url' => '/api/save-checkin-type',
    'action' => SaveCheckinTypeAction::class,
    'filters' => [LoginFilter::class],
    'type' => 'json'
  ],
];

return $urls;
