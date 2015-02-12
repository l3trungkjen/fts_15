<?php

use Phalcon\Forms\Element\Select;

class CategoriesController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if ($this->session->has('user_id') && ($this->session->get('status') != Users::STATUS_ADMIN)) {
            return $this->response->redirect('index');
        }
        $this->view->categories = Categories::find();
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function newAction()
    {
        if ($this->session->has('user_id') && ($this->session->get('status') != Users::STATUS_ADMIN)) {
            return $this->response->redirect('index');
        }
        $select_status = new Select('status');
        $select_status->setOptions(
            [
                '0' => 'Inactive',
                '1' => 'Active'
            ]
        );
        $this->view->select_status = $select_status->render(['class' => 'span6']);
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function createAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $categories = new Categories();
            $categories->created = date('Y-m-d H:i:s');
            if (!$categories->save($request)) {
                foreach ($categories->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $this->flash->success('Category was created success.');
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'categories',
                'action' => 'new'
            ]
        );
    }

    public function editAction($id = '')
    {
        if ($this->session->has('user_id') && ($this->session->get('status') != Users::STATUS_ADMIN)) {
            return $this->response->redirect('index');
        }
        if (!empty($id)) {
            $category = Categories::findFirst($id);
            $this->tag->setDefault('id', $category->id);
            $this->tag->setDefault('name', $category->name);
            $select_status = new Select('status');
            $select_status->setOptions(
                [
                    '0' => 'Inactive',
                    '1' => 'Active'
                ]
            );
            $select_status->setDefault($category->status);
        } else {
            return $this->dispatcher->forward(
                [
                    'controller' => 'categories',
                    'action' => 'index'
                ]
            );
        }
        $this->view->select_status = $select_status->render(['class' => 'span6']);
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $category = Categories::findFirst($request['id']);
            if (!$category->save($request)) {
                foreach ($category->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {
                $this->flash->success('Category was edit success.');
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'categories',
                    'action' => 'edit',
                    'params' => [$request['id']]
                ]
            );
        }
        return $this->response->redirect('categories');
    }

    public function deleteAction($id = '')
    {
        if (!empty($id)) {
            $category = Categories::findFirst($id);
            if (!$category->delete()) {
                $this->flash->error('Category deleted failure.');
            } else {
                $this->flash->success('Category was delete success.');
            }
            return $this->dispatcher->forward(
                [
                    'controller' => 'categories',
                    'action' => 'index'
                ]
            );
        }
        return $this->response->redirect('categories');
    }

}

