<?php 
	include_once("classes/Db.class.php");

	class Project {
		private $m_sTitle;
		private $m_sDescription;
		private $m_sId;

		public function __set($p_sProperty, $p_sValue) {
			switch ($p_sProperty) {
				case 'Title':
					$this->m_sTitle = $p_sValue;
					break;

				case 'Description':
					$this->m_sDescription = $p_sValue;
					break;

				case 'Id':
					$this->m_sId = $p_sValue;
					break;
			}
		}

		public function __get($p_sProperty) {
			switch ($p_sProperty) {
				case 'Title':
					return $this->m_sTitle;
					break;

				case 'Description':
					return $this->m_sDescription;
					break;

				case 'Id':
					return $this->m_sId;
					break;
			}
		}

		public function SaveProject() {
			$conn = Db::getInstance();
			$statement = $conn->prepare("INSERT INTO tblprojects
				(title, description) 
				VALUES 
				(:title, :description)");
			$statement->bindValue(':title', $this->Title );
			$statement->bindValue(':description', $this->Description );
			$statement->execute();		
		}

		public function UpdateProject() {
			$conn = Db::getInstance();
			$statement = $conn->prepare("UPDATE tblprojects SET title = :title,
																description = :description
															    WHERE id = :id
										");
			$statement->bindValue(':title', $this->Title);
			$statement->bindValue(':description', $this->Description);
			$statement->bindValue(':id', $this->Id );
			$statement->execute();
		}

		public function DeleteProject(){
			$conn = Db::getInstance();
			$statement = $conn->prepare("DELETE FROM tblprojects WHERE id = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->execute();

			header('Location: adminboard.php');
		}

		public function ShowProjects() {
			$conn = Db::getInstance();
			$allProjects = $conn->query("SELECT * FROM tblprojects ORDER BY up DESC");
			return $allProjects;
		}

		public function ShowRecentProjects() {
			$conn = Db::getInstance();
			$allProjects = $conn->query("SELECT * FROM tblprojects  ORDER BY up DESC LIMIT 3");
			return $allProjects;
		}
	}
?>