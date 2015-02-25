<?php

use Phalcon\Forms\Element\Select;

class QuestionsController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        if ($this->session->has('user_id') && ($this->session->get('status') != Users::STATUS_ADMIN)) {
            return $this->response->redirect('index');
        }
        $this->view->questions = Questions::find();
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function newAction()
    {
        if ($this->session->has('user_id') && ($this->session->get('status') != Users::STATUS_ADMIN)) {
            return $this->response->redirect('index');
        }
        $categories = Categories::find();
        $select_categories = new Select('category_id');
        $arr_categories[''] = 'Please, Choose categories...';
        foreach ($categories as $category) {
            $arr_categories[$category->id] = $category->name;
        }
        $select_categories->setOptions($arr_categories);
        $this->view->categories = $select_categories->render(['class' => 'span6']);
        $this->view->user = Users::findFirst($this->session->get('user_id'));
    }

    public function createAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $questions = new Questions();
            $questions->category_id = $request['category_id'];
            $questions->name = $request['name'];
            if (!$questions->validation()) {
                $this->flash->error($questions->getMessages()[0]);
            } else {
                if (!$questions->save()) {
                    foreach ($questions->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    foreach ($request['answer_name'] as $key => $answer) {
                        $answers = new Answers();
                        $answers->question_id = $questions->id;
                        $answers->name = $answer;
                        $answers->correct = $request['correct'][$key];
                        if (!$answers->save()) {
                            continue;
                        }
                    }
                    $this->flash->success('Question was created successfully.');
                }
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'questions',
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
            $question = Questions::findFirst($id);
            $categories = Categories::find();
            $answers = new Answers();
            foreach ($question->answers as $key => $answer) {
                $this->tag->setDefault("correct[". $answer->id ."]", $answer->correct);
            }
            $select_categories = new Select('category_id');
            $arr_categories[''] = 'Please, Choose categories...';
            foreach ($categories as $category) {
                if ($category->id === $question->category_id) {
                    $select_categories->setDefault($category->id);
                }
                $arr_categories[$category->id] = $category->name;
            }
            $select_categories->setOptions($arr_categories);
            $this->view->categories = $select_categories->render(['class' => 'span6']);
            $this->view->question = $question;
            $this->view->answers = $question->answers;
            $this->view->user = Users::findFirst($this->session->get('user_id'));
        } else {
            return $this->dispatcher->forward(
                [
                    'controller' => 'questions',
                    'action' => 'index'
                ]
            );
        }
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $questions = new Questions();
            $questions->id = $request['id'];
            $questions->category_id = $request['category_id'];
            $questions->name = $request['name'];
            if (!$questions->validation()) {
                $this->flash->error($questions->getMessages()[0]);
            } else {
                if (!$questions->save()) {
                    foreach ($questions->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {
                    foreach($request['answer_name'] as $key => $answer) {
                        $answer_by_question_id = Answers::fetchByIdAndQuestionId($key, $request['id']);
                        if ($answer_by_question_id) {
                            $answer_by_question_id->name = $answer;
                            $answer_by_question_id->correct = $request['correct'][$key];
                            if (!$answer_by_question_id->save()) {
                                continue;
                            }
                        } else {
                            $answers = new Answers();
                            $answers->question_id = $request['id'];
                            $answers->name = $answer;
                            $answers->correct = $request['correct'][$key];
                            if (!$answers->save()) {
                                continue;
                            }
                        }
                    }
                    $this->flash->success('Question was edit successfully.');
                }
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'questions',
                'action' => 'index'
            ]
        );
    }

    public function deleteAction($id = '')
    {
        if (!empty($id)) {
            $question = Questions::findFirst($id);
            if (empty($question) || !$question->delete()) {
                $this->flash->error('Question deleted failure.');
            } else {
                $this->flash->success('Question was delete successfully.');
            }
        }
        return $this->dispatcher->forward(
            [
                'controller' => 'questions',
                'action' => 'index'
            ]
        );
    }

}

