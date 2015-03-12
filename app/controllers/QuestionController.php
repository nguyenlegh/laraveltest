<?php

/**
 * Question input controller
 * @author nguyenle
 */
class QuestionController extends BaseController
{
    
    public function indexAction() {
        return View::make('question/index');
    }
    
    public function getAllQuestionTemplatesAction() {
        try {
            $qts = QuestionTemplates::all();
            return Response::json(array('status' => 'success', 
                'message' => '', 'data' => $qts));
        }
        catch(Exception $ex) {
            return Response::json(array('status' => 'error', 
                'message' => $ex->getMessage()));
        }
    }

    public function getAllCategoryAction() {
        try {
            $categories = Categories::all();
            return Response::json(array('status' => 'success', 
                'message' => '', 'data' => $categories));
        }
        catch(Exception $ex) {
            return Response::json(array('status' => 'error', 
                'message' => $ex->getMessage()));
        }
    }

    public function saveQuestionAction() {
        try {
            $jsonQuestion = Input::get('data');
            return Response::json(array('status' => 'success', 
                'message' => 'Save success', 'data' => $jsonQuestion));
            //$categories = Categories::all();
            //return Response::json(array('status' => 'success', 
            //    'message' => '', 'data' => $categories));
        }
        catch(Exception $ex) {
            return Response::json(array('status' => 'error', 
                'message' => $ex->getMessage()));
        }
    }
}
