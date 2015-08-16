<?php 

	include_once("Db.class.php");
	
	class Admin
	{
		
		private $m_sName;
		private $m_sFirstname;
		private $m_sEmail;
		private $m_sPassword;
		private $m_sId;

		public function __set($p_sProperty, $p_sValue) {
			switch ($p_sProperty) {
				case 'Password':
					if(empty($p_sValue)) {
						throw new Exception("Wachtwoord mag niet leeg zijn");
					} else {
						$options = array('cost' => 11);
                		$this->m_sPassword = password_hash($p_sValue, PASSWORD_BCRYPT, $options);
					};
					break;

				case 'Email':
					if(empty($p_sValue)) {
						throw new Exception("Email mag niet leeg zijn");
					} else {
						$this->m_sEmail = $p_sValue;
					};
					break;

				case 'Name':
					if(empty($p_sValue)) {
						throw new Exception("Naam mag niet leeg zijn");
					} else {
						$this->m_sName = $p_sValue;
					};
					break;

				case 'Firstname':
					if(empty($p_sValue)) {
						throw new Exception("Voornaam mag niet leeg zijn");
					} else {
						$this->m_sFirstname = $p_sValue;
					};
					break;

				case 'Id':
					$this->m_sId = $p_sValue;
					break;
			}
		}

		public function __get($p_sProperty) {
			switch ($p_sProperty) {
				case 'Firstname':
					return $this->m_sFirstname;
					break;

				case 'Name':
					return $this->m_sName;
					break;

				case 'Password':
					return $this->m_sPassword;
					break;

				case 'Email':
					return $this->m_sEmail;
					break;

				case 'Id':
					return $this->m_sId;
					break;

			}
		}

		public function CreateAccount() {
			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("INSERT INTO tbladmin
				(email, password) 
				VALUES 
				(:email, :password)");
			$statement->bindValue(':email', $this->Email );
			$statement->bindValue(':password', $this->Password );
			$statement->execute();

		}

		public function DeleteAccount(){
			$conn = Db::getInstance();
			//$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$statement = $conn->prepare("DELETE FROM tbladmin WHERE id = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->execute();

			header('Location:login.php');
		}

		public function UpdateAccount(){
			$conn = Db::getInstance();
			$statement = $conn->prepare("UPDATE tbladmin SET firstname = :firstname,
																name = :name,
																email = :email,
																password = :password
															    WHERE id = :id
										");
			$statement->bindValue(':firstname', $this->Firstname);
			$statement->bindValue(':name', $this->Name);
			$statement->bindValue(':email', $this->Email);
			$statement->bindValue(':password', $this->Password);
			$statement->bindValue(':id', $this->Id );
			$statement->execute();

			//header('Location:studentAccount.php');

		}

		public function ShowAccount() {
			//informatie van account returnen
			$conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$showAcc = $conn->query("SELECT * FROM tbladmin WHERE email ='" . $_SESSION['email'] . "'");
			return $showAcc;
		}

		public function ShowAccounts() {
			//alle accounts returnen
			$conn = Db::getInstance();
			$allAcc = $conn->query("SELECT id, email FROM tbladmin");
			return $allAcc;

			header('Location:adminaccounts.php');
		}
	}
?>