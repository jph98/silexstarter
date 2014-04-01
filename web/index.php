<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();

$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load('services.yml');

$app = new Silex\Application();
//$app['debug'] = true;
$app['container'] = $container;

$app->get('/', function() {

	$content = "";

	if ($container->hasParameter('mailer.transport')) {
		$content .= "Transport: " . $container->getParameter('mailer.transport');
	} else {
		$content .= "No Transport found";
	}
    return $content;
});

$app->run();