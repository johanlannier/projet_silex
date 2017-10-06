<?php

namespace App\pc\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function listAction(Request $request, Application $app)
    {
        $pc = $app['repository.pcs']->getAll();

        return $app['twig']->render('pc.list.html.twig', array('pc' => $pc));
    }

    public function listUserAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $pc = $app['repository.pcs']->getUserPcs($parameters['id']);

       return $app['twig']->render('pc.list.html.twig', array('pc' => $pc));
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.pcs']->delete($parameters['id']);

        return $app->redirect($app['url_generator']->generate('pc.list'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $pcs = $app['repository.pcs']->getById($parameters['id']);

        return $app['twig']->render('pc.form.html.twig', array('pcs' => $pcs));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $pcs = $app['repository.pcs']->update($parameters);
        } else {
            $pcs = $app['repository.pcs']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('pc.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('pc.form.html.twig');
    }
}
