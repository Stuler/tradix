<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;

class Bootstrap {

	const FILES_DIR = __DIR__ . '/../files';
	const WWW_DIR = __DIR__ . '/../www';

	public static function boot(): Configurator {
		$configurator = new Configurator;
		$appDir = dirname(__DIR__);

		$configurator->addParameters([
			'filesDir' => self::FILES_DIR,
			'wwwDir'   => self::WWW_DIR,
		]);
		//		$configurator->setDebugMode(true); // enable for your remote IP
		$configurator->enableTracy($appDir . '/log');

		$configurator->setTimeZone('Europe/Prague');
		$configurator->setTempDirectory($appDir . '/temp');

		$configurator->addDynamicParameters([
			"cookieDomain" => $_SERVER['HTTP_HOST'] ?? null,
		]);
		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$configurator->addConfig($appDir . '/config/common.neon');
		$configurator->addConfig($appDir . '/config/local.neon');

		return $configurator;
	}
}
