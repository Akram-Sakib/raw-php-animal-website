<?php  
class Interview{
 	
	private $db;

	public function __construct($database) {
	    $this->db = $database;
	}	
	
	public function add_Questions($uId, $subject, $proficiency, $question, $answer, $example){
		$date = date('Y-m-d H:i:s');
		$status = 1;
		$query = $this->db->prepare("INSERT INTO interview_questions(userId, subject, proficiency, question, answer, example, date, status)VALUES(?,?,?,?,?,?,?,?)");

		$query->bindValue(1, $uId);
		$query->bindValue(2, $subject);
		$query->bindValue(3, $proficiency);
		$query->bindValue(4, $question);
		$query->bindValue(5, $answer);
		$query->bindValue(6, $example);
		$query->bindValue(7, $date);
		$query->bindValue(8, $status);
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function Update_Question($quesId, $subject, $proficiency, $question, $answer, $example){
		$query = $this->db->prepare("UPDATE interview_questions SET subject = ?, proficiency =?, question=?, answer=?, example=? WHERE id = ? LIMIT 1");

		$query->bindValue(1, $subject);
		$query->bindValue(2, $proficiency);
		$query->bindValue(3, $question);
		$query->bindValue(4, $answer);
		$query->bindValue(5, $example);
		$query->bindValue(6, $quesId);
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function add_Questions_from_excel($dataArr, $uId, $sub, $prof){
		$date = date('Y-m-d H:i:s');
		$status = 1;
		$query = $this->db->prepare('INSERT INTO interview_questions(userId, subject, proficiency, question, answer, example, date, status) VALUES(:userId, :subject, :proficiency, :question, :answer, :example, :date, :status)');
		
		//$stmt = $pdo->prepare('INSERT INTO foo VALUES(:a, :b, :c)');
		//print_r($dataArr);
		foreach($dataArr as $item)
		{
			$query->bindValue(':userId', $uId);
			$query->bindValue(':subject', $sub);
			$query->bindValue(':proficiency', $prof);
			$query->bindValue(':question', $item[0]);
			$query->bindValue(':answer', $item[1]);
			$query->bindValue(':example', $item[2]);
			$query->bindValue(':date', $date);
			$query->bindValue(':status', $status);
			$query->execute();
		}
		try{
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function GetQuestionByUser($uId, $sub) {
	
		$query = $this->db->prepare("SELECT * FROM interview_questions WHERE userId = ? AND subject = ? order by id ASC");
		$query->bindValue(1, $uId);
		$query->bindValue(2, $sub);
		try{
			$query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function GetQuestionBySubject($sub) {
	
		$query = $this->db->prepare("SELECT * FROM interview_questions WHERE subject = ? order by id DESC");
		$query->bindValue(1, $sub);
		try{
			$query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function GetQuestionById($id) {
	
		$query = $this->db->prepare("SELECT * FROM interview_questions WHERE id = ?");
		$query->bindValue(1, $id);
		try{
			$query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function GetTutorialBySubject($sub) {
	
		$query = $this->db->prepare("SELECT * FROM tutorials WHERE subject_Id = ? order by id DESC");
		$query->bindValue(1, $sub);
		try{
			$query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function GetTutorialById($tid) {
		
		$query = $this->db->prepare("SELECT * FROM tutorials WHERE id = ? order by id ASC");
		$query->bindValue(1, $tid);
		try{
			$query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function GetQuestionByproficiency($prof) {
	
		$query = $this->db->prepare("SELECT * FROM interview_questions WHERE proficiency = ? order by id ASC");
		$query->bindValue(1, $prof);
		try{
			$query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function delete_Questions($qId) {
	
		$query = $this->db->prepare("DELETE FROM interview_questions WHERE id = ? LIMIT 1");
		$query->bindValue(1, $qId);
		try{
			$query->execute();
            return true;
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function delete_totorials($tId) {
	
		$query = $this->db->prepare("DELETE FROM tutorials WHERE id = ? LIMIT 1");
		$query->bindValue(1, $tId);
		try{
			$query->execute();
            return true;
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function GetQuestionBySubProf($sub, $prof) {
		$query = $this->db->prepare("SELECT * FROM interview_questions WHERE subject = ? AND proficiency = ? order by id ASC");
		$query->bindValue(1, $sub);
		$query->bindValue(2, $prof);
		try{
			$query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function GetQuestionBySub_pagig($sub, $prof, $start, $limit) {

		$query = $this->db->prepare("SELECT * FROM interview_questions WHERE subject = ? AND proficiency = ? order by id ASC LIMIT $start, $limit");
		$query->bindValue(1, $sub);
		$query->bindValue(2, $prof);
		try{
			$query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function GetSubjects() {

		$query = $this->db->prepare("SELECT * FROM subjects WHERE status = 1");
		$query->bindValue(1, $sub);
		$query->bindValue(2, $prof);
		try{
			$query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function GetContent($sub) {
		$sub = strtolower($sub);
		$query = $this->db->prepare("SELECT subId FROM subjects WHERE lower(subjectName) = ?");
		$query->bindValue(1, $sub);
		try{
			$query->execute();
            $subId = $query->fetchColumn();
				if($subId)
				{
					$query1 = $this->db->prepare("SELECT * FROM tutorials WHERE subject_Id = ? AND status = 1");
					$query1->bindValue(1, $subId);
					$query1->execute();
					return $subId = $query1->fetchAll();
				}	
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function GetContentbyId($id) {
		$query = $this->db->prepare("SELECT topic, content FROM tutorials WHERE id = ?");
		$query->bindValue(1, $id);
		try{
			$query->execute();
				return $query->fetchAll();	
		    } 
			catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function add_totorials($uId, $subId, $topic, $content){
		$date = date('Y-m-d H:i:s');
		$status = 1;
		$query = $this->db->prepare("INSERT INTO tutorials(uId, subject_Id, topic, content, status)VALUES(?,?,?,?,?)");

		$query->bindValue(1, $uId);
		$query->bindValue(2, $subId);
		$query->bindValue(3, $topic);
		$query->bindValue(4, $content);
		$query->bindValue(5, $status);
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function Update_totorials($tid, $topic, $content){
		//echo 'UPDATE tutorials SET topic = "'.$topic.'", content = "'.$content.'" WHERE id = '.$tid.' limit 1';
		$query = $this->db->prepare("UPDATE tutorials SET topic = ?, content = ? WHERE id = ? limit 1");

		$query->bindValue(1, $topic);
		$query->bindValue(2, $content);
		$query->bindValue(3, $tid);
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}

	public function GetAllSubject() {
	
		$query = $this->db->prepare("SELECT * FROM subjects ORDER BY subId DESC");
		try{
			$query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function checkDuplicateSubject($sub) {
		$query = $this->db->prepare("SELECT count(*) FROM subjects WHERE LOWER(subjectName) = ?");
		$query->bindValue(1, $sub);
		try{
			$query->execute();
            return $query->fetchColumn();
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function GetSubjectId($sub) {
		$query = $this->db->prepare("SELECT subId FROM subjects WHERE LOWER(subjectName) = ?");
		$query->bindValue(1, $sub);
		try{
			$query->execute();
            return $query->fetchColumn();
		    } catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	public function add_subject($subname){
		$date = date('Y-m-d H:i:s');
		$status = 0;
		$query = $this->db->prepare("INSERT INTO subjects(subjectName, createdDate, status)VALUES(?,?,?)");

		$query->bindValue(1, $subname);
		$query->bindValue(2, $date);
		$query->bindValue(3, $status);
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function delete_subject($sid, $act){
		//echo "UPDATE subjects SET status = 0 WHERE subId = $sid limit 1";
		if($act == 'enable')
		{
			$act = 1;
		}	
		else
		{
			$act = 0;
		}	
		$query = $this->db->prepare("UPDATE subjects SET status = ? WHERE subId = ? limit 1");

		$query->bindValue(1, $act);
		$query->bindValue(2, $sid);
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function Upd_subject($sid, $subject){
		$query = $this->db->prepare("UPDATE subjects SET subjectName = ? WHERE subId = ? limit 1");

		$query->bindValue(1, $subject);
		$query->bindValue(2, $sid);
		
		try{
			$query->execute();
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}
	
	public function countAllTutorials() {
		
		$query = $this->db->prepare("SELECT count(*) total FROM tutorials");
		try{
			$query->execute();
            $data = $query->fetch();
			return $data['total'];
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
}
?>