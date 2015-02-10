<?php

class SessionsController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if ($this->session->has('user_id') && $this->session->has('email')) {
            return $this->response->redirect('index');
        }
    }

    public function createAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $user = Users::fetchByEmailPassword($this->request->getPost());
            if ($user) {
                $this->session->set('user_id', $user->id);
                $this->session->set('email', $user->email);
                $this->session->set('status', $user->status);
                return $this->dispatcher->forward(
                    [
                        'controller' => 'index',
                        'action' => 'index'
                    ]
                );
            } else {
                $this->flash->error('Email or Password incorrect.');
                return $this->dispatcher->forward(
                    [
                        'controller' => 'sessions',
                        'action' => 'index'
                    ]
                );
            }
        }
    }

    public function logoutAction()
    {
        $this->session->destroy();
        $this->response->redirect('index');
    }
}

