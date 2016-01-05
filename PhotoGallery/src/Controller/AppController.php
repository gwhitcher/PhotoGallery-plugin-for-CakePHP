<?php

namespace PhotoGallery\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    /* CUSTOM SECURITY FOR PHOTOGALLERY
    public function initialize()
    {
        $ip = getenv('HTTP_CLIENT_IP') ?:
            getenv('HTTP_X_FORWARDED_FOR') ?:
                getenv('HTTP_X_FORWARDED') ?:
                    getenv('HTTP_FORWARDED_FOR') ?:
                        getenv('HTTP_FORWARDED') ?:
                            getenv('REMOTE_ADDR');
        //echo $ip; //Gets your IP address for the below
        if ($ip != '127.0.0.1') {
            $action = $this->request->params['action'];
            if ($action === 'delete' OR $action === 'edit' OR $action === 'add') {
                $this->Flash->error('You are not authorized to view that page.');
                return $this->redirect(['action' => 'index']);
            }
        }
    }
    */
}
