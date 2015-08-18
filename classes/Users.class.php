<?php
	
	include_once("Db.class.php");
	
	class User {
		
		private $m_sFirstname;
		private $m_sLastname;
		private $m_sEmail;
		private $m_sPassword;
		private $m_sCPassword;
		private $m_sPicture;
		private $m_sId;

		public function __set($p_sProperty, $p_sValue) {
			switch ($p_sProperty) {
				case 'Firstname':
					if(empty($p_sValue)) {
						throw new Exception("Voornaam mag niet leeg zijn");
					} else {
						$this->m_sFirstname = $p_sValue;
					};
					break;

				case 'Lastname':
					if(empty($p_sValue)) {
						throw new Exception("Naam mag niet leeg zijn");
					} else {
						$this->m_sLastname = $p_sValue;
					};
					break;

				case 'Email':
					if(empty($p_sValue)) {
						throw new Exception("Email mag niet leeg zijn");
					} else {
						$this->m_sEmail = $p_sValue;
					};
					break;

				case 'Password':
					if(empty($p_sValue)) {
						throw new Exception("Wachtwoord mag niet leeg zijn");
					} else {
						$options = array('cost' => 11);
                		$this->m_sPassword = password_hash($p_sValue, PASSWORD_BCRYPT, $options);
					};
					break;
				case 'CPassword':
					if(empty($p_sValue)) {
						throw new Exception("Wachtwoord verificatie moet ingevuld zijn");
					} else {
						$options = array('cost' => 11);
                		$this->m_sPassword = password_hash($p_sValue, PASSWORD_BCRYPT, $options);
					};
					break;

				case 'Picture':
                    if ($p_sValue!="") {
	                    $this->m_sPicture = $p_sValue;
	                } else {
	                    $this->m_sPicture = null;
	                }
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

				case 'Lastname':
					return $this->m_sLastname;
					break;

				case 'Email':
					return $this->m_sEmail;
					break;

				case 'Password':
					return $this->m_sPassword;
					break;

				case 'CPassword':
					return $this->m_sCPassword;
					break;

				case 'Picture':
					return $this->m_sPicture;
					break;

				case 'Id':
					return $this->m_sId;
					break;

			}
		}


		public function checkPassword($value1, $value2) {
	        if ($value1 != $value2) {
	            throw new Exception("De wachtwoorden komen niet overeen.");
	        }
	    }

		public function Save() {
			$conn = Db::getInstance();
			$statement = $conn->prepare("INSERT INTO tblusers
				(firstname, lastname, email, password) 
				VALUES 
				(:firstname, :lastname, :email, :password)");
			$statement->bindValue(':firstname', $this->Firstname);
			$statement->bindValue(':lastname', $this->Lastname);
			$statement->bindValue(':email', $this->Email);
			$statement->bindValue(':password', $this->Password);
			$statement->execute();

			header("Location: login.php");

		}

		public function UpdateAccount(){
			$conn = Db::getInstance();
			$statement = $conn->prepare("UPDATE tblusers SET firstname = :firstname,
																lastname = :lastname,
																email = :email,
																password = :password
															    WHERE id = :id
										");
			$statement->bindValue(':firstname', $this->Firstname);
			$statement->bindValue(':lastname', $this->Lastname);
			$statement->bindValue(':email', $this->Email);
			$statement->bindValue(':password', $this->Password);
			$statement->bindValue(':id', $this->Id );
			$statement->execute();
		}

		public function UpdateImage() {
			$conn = Db::getInstance();
			$statement = $conn->prepare("UPDATE tblusers SET foto = :fileToUpload
															    WHERE id = :id
										");
			$statement->bindValue(':id', $this->Id );
			$statement->bindValue(':fileToUpload', $this->Picture);
			$statement->execute();
		}

		public function DeleteAccount() {
			$conn = Db::getInstance();
			$statement = $conn->prepare("DELETE FROM tblusers WHERE id = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->execute();

			header('Location:login.php');

		}
		
		public function DeleteImage() {
			$conn = Db::getInstance();
			$statement = $conn->prepare("UPDATE tblbuddies SET buddieFoto = :foto WHERE buddieID = :id");
			$statement->bindValue(':id', $this->Id );
			$statement->bindValue(':foto', $this->Foto );
			$statement->execute();
		}

		public function ShowAccount() {
			//informatie van account returnen
			$conn = Db::getInstance();
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$showAcc = $conn->query("SELECT * FROM tblusers WHERE email ='" . $_SESSION['email'] . "'");
			return $showAcc;
		}
	}
?>