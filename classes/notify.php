<?php
require_once('connection.php');
require_once('userf.php');
require_once('project.php');
require_once('PHPMailer/email.php');


class notify
{
	public function AddNotify($projectid, $from, $to, $status, $description)
	{
		$mail = new email;
		$connect = new connection;
		$user = new user;
		$project = new projects;
		
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "INSERT INTO TAB_notify(id_projeto, id_from_user, id_to_user, status_notify, description_notify) 
			VALUES(:project, :from, :to, :status, :description)";
			$query = $connector->prepare($sql);
			$query->bindParam(':project', $projectid, PDO::PARAM_STR);
			$query->bindParam(':from', $from, PDO::PARAM_STR);
			$query->bindParam(':to', $to, PDO::PARAM_STR);
			$query->bindParam(':status', $status, PDO::PARAM_STR);
			$query->bindParam(':description', $description, PDO::PARAM_STR);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				$text = 'Um novo projeto com o nome "'.$project->getProjectField($projectid, 'nmp_prj').'" foi atribuído a você pelo usuário <strong>'.$user->getUserField($from, 'nome_user').' </strong>';
				$link = "<a href='project.php?p=".$projectid."'><strong>Clique aqui!</strong></a>";
				$text2 = " para visualizar esse projeto.";
				
				$message = $text."<br/><br/>".$link.$text2;
				
				$subject = "Novo projeto!";
				$link2 = "project.php?p=".$projectid;
				
				$mail->sendEmail($user->getUserField($to, 'email_in_user'), $user->getUserField($to, 'nome_user'), $subject, utf8_decode($message), false, '', $link2);
			}
		}
	}
	
	public function DeleteNotify($id)
	{
		$connect = new connection;
		if($connect->tryconnect())
		{
			$connector = $connect->getConnector();
			$sql = "DELETE FROM tab_notify WHERE id_notify = :notify";
			$query = $connector->prepare($sql);
			$query->bindParam(':notify', $id, PDO::PARAM_INT);
			$query->execute();
			$rowC = $query->rowCount();
			if($rowC>0)
			{
				return true;
			}
			else{
				return false;
			}
		}
	}
}
?>