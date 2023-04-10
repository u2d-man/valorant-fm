<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        PDO::class => function (ContainerInterface $c): PDO {
            $databaseSettings = $c->get(SettingsInterface::class)->get('database');

            $dsn = vsprintf('mysql:host=%s;dbname=%s;port=%d;charset=utf8mb4', [
                $databaseSettings['host'],
                $databaseSettings['database'],
                $databaseSettings['port']
            ]);

            $pdo = new PDO($dsn, $databaseSettings['user'], $databaseSettings['password'], [
                PDO::ATTR_PERSISTENT => true,
            ]);

            return $pdo;
        },
    ]);
};
