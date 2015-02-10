<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        if (!$this->session->has('user_id') && !$this->session->has('email')) {
            return $this->response->redirect('login');
        }
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

}

