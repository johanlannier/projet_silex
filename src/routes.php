<?php

$app->get('/users/list', 'App\Users\Controller\IndexController::listAction')->bind('users.list');
$app->get('/users/edit/{id}', 'App\Users\Controller\IndexController::editAction')->bind('users.edit');
$app->get('/users/new', 'App\Users\Controller\IndexController::newAction')->bind('users.new');
$app->post('/users/delete/{id}', 'App\Users\Controller\IndexController::deleteAction')->bind('users.delete');
$app->post('/users/save', 'App\Users\Controller\IndexController::saveAction')->bind('users.save');

$app->get('/pc/list', 'App\pc\Controller\IndexController::listAction')->bind('pc.list');
$app->get('/pc/edit/{id}', 'App\pc\Controller\IndexController::editAction')->bind('pc.edit');
$app->get('/pc/new', 'App\pc\Controller\IndexController::newAction')->bind('pc.new');
$app->post('/pc/delete/{id}', 'App\pc\Controller\IndexController::deleteAction')->bind('pc.delete');
$app->post('/pc/save', 'App\pc\Controller\IndexController::saveAction')->bind('pc.save');
$app->get('/pc/list/{id}', 'App\pc\Controller\IndexController::listUserAction')->bind('pcs.listUserPcs');
