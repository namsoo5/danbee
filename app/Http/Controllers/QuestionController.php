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

		$count = count($db);
		$i = 0;

		$arr = [];
		while($i < $count){
			$q_id = $db[$i]->id;
			$answer = ANSWER::where('question_id', $q_id)->get();

			$a = array(
				"userid"=>$db[$i]->userid,
				"title"=>$db[$i]->title,
				"question_id"=>$q_id,
				"question_content"=>$db[$i]->content,
				"answer_content"=>$answer[0]->content
			);
			array_push($arr, $a);

			$i++;
		}

		return array(
			"result"=>self::RESULT_SUCCESS,
			"data"=>$arr
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

	#get answer
	public function getAnswer($qid){
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
}
