<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        if (!$this->session->has('user_id') && !$this->session->has('email')) {
            return $this->response->redirect('login');
        }
        foreach (Categories::find() as $category) {
            $arr_categories[$category->id] = $category->name;
        }
        $this->view->categories = $arr_categories;
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

}

