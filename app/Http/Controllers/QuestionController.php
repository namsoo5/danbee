<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\QUESTION;
use App\Model\ANSWER;

class QuestionController extends Controller
{
	const RESULT_SUCCESS = 777;
	const RESULT_ERR = 404;

	#all question
	public function allQuestion(){
		$db = QUESTION::get();
		if($db->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR,
				"data"=>array()
			);
		}


		return array(
			"result"=>self::RESULT_SUCCESS,
			"data"=>$db
		);


	}	

	#insert question
	public function newQuestion($userid, $title, $content){
		$question = new QUESTION;
		$question->userid = $userid;
		$question->title = $title;
		$question->content = $content;
		$question->save();

		return array(
			"result"=>self::RESULT_SUCCESS
		);
	}

	#post insert question
	public function newQuestionPost(){
		$userid = request('userid', null);
		$title = request('title', null);
		$content = request('content', null);

		$question = new QUESTION;
                $question->userid = $userid;
                $question->title = $title;
                $question->content = $content;
                $question->save();

                return array(
                        "result"=>self::RESULT_SUCCESS
		);
	}
	
	#delete
        public function deleteQuestionPost(){
                $id = request('id', null);
                $data = QUESTION::find($id);
                $data->delete();
                return array(
                        "result"=>self::RESULT_SUCCESS
                );
        }	


	#get answer
/*	public function getAnswer($qid){
		$db = ANSWER::where('question_id', $qid)->get();
		if($db->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR,
				"data"=>array()
			);
		}

		return array(
			"result"=>self::RESULT_SUCCESS,
			"data"=>$db
		);
	}

	#insert answer
	public function newAnswer($qid, $userid, $content){
		$answer = new ANSWER;
		$answer->question_id = $qid;
		$answer->userid = $userid;
		$answer->content = $content;
		$answer->save();
		return array(
			"result"=>self::RESULT_SUCCESS
		);

	}

	#all answer
	public function allAnswer(){
		$db = ANSWER::get();
		if($db->isEmpty()){
			return array(
				"result"=>self::RESULT_ERR,
				"data"=>array()
			);
		}

		return array(
			"result"=>self::RESULT_SUCCESS,
			"data"=>$db
		);
	}
 */
}
