<?php

class UsersController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if ($this->session->has('user_id') && ($this->session->get('status') != Users::admin)) {
            return $this->response->redirect('index');
        }
        $this->view->users = Users::find();
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function newAction()
    {
        if ($this->session->has('user_id') && $this->session->has('email')) {
            return $this->response->redirect('index');
        }
    }

    public function createAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $users = new Users();
            $users->created = date('Y-m-d H:i:s');
            $users->status = Users::user;
            if (!$users->save($request)) {
                foreach ($users->getMessages() as $key => $message) {
                    $this->flash->error($message);
                }
            } else {
                $this->session->set('user_id', $users->id);
                $this->session->set('email', $users->email);
                $this->session->set('status', $users->status);
                return $this->dispatcher->forward(
                    [
                        'controller' => 'index',
                        'action' => 'index'
                    ]
                );
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'users',
                'action' => 'new'
            ]
        );
    }

    public function editAction($id = '')
    {
        return !empty($id) ?
            $this->view->user = Users::findFirst($id) :
            $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $user = Users::findFirst($request['id']);
            if (!$user->save($request)) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error($message);
                }
                return $this->dispatcher->forward(
                    [
                        'controller' => 'users',
                        'action' => 'edit',
                        'params' => [$request['id']]
                    ]
                );
            } else {
                $this->flash->success('User was edit success!!!');
                return $this->dispatcher->forward(
                    [
                        'controller' => 'users',
                        'action' => 'edit',
                        'params' => [$user->id]
                    ]
                );
            }
        } else {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
    }

    public function deleteAction($id = '')
    {
        if (!empty($id)) {
            $user = Users::findFirst($id);
            if (!$user->delete()) {
                $this->flash->error('User deleted failure.');
            } else {
                $this->flash->success('User was delete success.');
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'users',
                'action' => 'index'
            ]
        );
    }

    public function profileAction($id = '')
    {
        if (!empty($id)) {
            $this->view->user = Users::findFirst($id);
        } else {
            return $this->dispatcher->forward(
                [
                    'controller' => 'index',
                    'action' => 'index'
                ]
            );
        }
    }
}

