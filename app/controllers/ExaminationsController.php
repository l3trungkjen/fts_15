<?php

class ExaminationsController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if ($this->session->has('user_id') && ($this->session->get('status') != Users::STATUS_ADMIN)) {
            return $this->response->redirect('index');
        }
        $categories = Categories::find();
        foreach ($categories as $category) {
            $arr_categories[$category->id] = $category->name;
        }
        $this->view->categories = $arr_categories;
        $this->view->examinations = Examinations::fetchAll();
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function newAction()
    {
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function createAction()
    {
        $request = $this->request->getPost();
        $flag = false;
        if (!empty($request) && isset($request['categories']) && $this->session->has('user_id')) {
            foreach ($request['categories'] as $category) {
                $examinations = new Examinations();
                $examinations->user_id = $this->session->get('user_id');
                $examinations->category_id = $category;
                $examinations->created = date('Y-m-d H:i:s');
                $examinations->status = Examinations::STATUS_INACTIVE;
                if (!$examinations->save()) {
                    foreach ($users->getMessages() as $key => $message) {
                        $this->flash->error($message);
                    }
                    $flag = false;
                } else {
                    $flag = true;
                }
            }
        }
        $this->view->examinations = Examinations::fetchAll();
        $this->view->flag = $flag;
    }

    public function editAction($id)
    {
        if (!empty($id)) {
            $examination = Examinations::findFirst($id);
            $category = $examination->categories;
            $questions = $category->getQuestions(
                [
                    'order' => 'RAND()'
                ]
            );
        } else {
            return $this->dispatcher->forward(
                [
                    'controller' => 'examinations',
                    'action' => 'index'
                ]
            );
        }
        $this->view->category = $category;
        $this->view->questions = $questions;
        $this->view->examination = $examination;
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            if (isset($request['question_id'])) {
                foreach ($request['question_id'] as $question => $answer) {
                    $result = new Results();
                    $result->exam_id = $request['examination_id'];
                    $result->question_id = $question;
                    $result->answer_id = $answer;
                    if (!$result->save()) {
                        foreach ($result->getMessages() as $message) {
                            $this->flash->error('Result error!!!');
                        }
                    }
                }
            } else {
                $this->flash->error('Please. Pick answer of questions.');
                $examination = new Examinations();
                $examination->id = $request['examination_id'];
                $examination->datetime = $request['time_value_count_up'];
                $examination->status = Examinations::STATUS_INACTIVE;
                if (!$examination->save()) {
                    foreach ($examination->getMessages() as $key => $value) {
                        $this->flash->error($value);
                    }
                } else {
                    return $this->dispatcher->forward(
                        [
                            'controller' => 'examinations',
                            'action' => 'edit',
                            'params' => [$request['examination_id']]
                        ]
                    );
                }
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'examinations',
                'action' => 'index'
            ]
        );
    }
}

