<?php

use App\Ebcms\Apps\Http\App as HttpApp;
use App\Ebcms\Apps\Http\Index;
use Ebcms\App;
use Ebcms\Router;
use Ebcms\Router\Collector;

App::getInstance()->execute(function (
    Router $router
) {
    $router->getCollector()->addGroup(App::getSite(), function (Collector $collector) {
        $collector->get('/store/app', HttpApp::class);
        $collector->get('/store', Index::class);
    });
});