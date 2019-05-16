<?php
	class Apostle {

		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function getFormGroup() {

			$this->db->query('SELECT * FROM formText');
			$data = $this->db->resultSet();

			return $data;
		}

		public function getFormData() {

			$this->db->query('SELECT * FROM formContent');
			$data = $this->db->resultSet();

			return $data;
		}

		public function createApostle($postData) {

			$this->db->query('INSERT INTO apostle(sacrifice, desire, aspect, incarnation, abilities, abyssalAbilities, spawn, spawnForm, shortcomings, apostleName, password) VALUES(:sacrifice, :desire, :aspect, :incarnation, :abilities, :abyssalAbilities, :spawn, :spawnForm, :shortcomings, :apostleName, :password)');
			$this->db->bind(':sacrifice', $postData['sacrifice']);
			$this->db->bind(':desire', $postData['desire']);
			$this->db->bind(':aspect', $postData['aspect']);
			$this->db->bind(':incarnation', $postData['incarnation']);
			$this->db->bind(':abilities', $postData['abilities']);
			$this->db->bind(':abyssalAbilities', $postData['abyssalAbilities']);
			$this->db->bind(':spawn', $postData['spawn']);
			$this->db->bind(':spawnForm', $postData['spawnForm']);
			$this->db->bind(':shortcomings', $postData['shortcomings']);
			$this->db->bind(':apostleName', $postData['apostleName']);
			$this->db->bind(':password', $postData['password']);

			if($this->db->execute()) {
				return true;
			} else {
				return false;
			}
		}

		public function findApostle($name, $password) {
			$this->db->query('SELECT * FROM apostle WHERE apostleName = :apostleName');
			$this->db->bind(':apostleName', $name);
			$row = $this->db->single();

			if($this->db->rowCount() > 0) {
				$hashedPassword = $row->password;
				if(password_verify($password, $hashedPassword)) {
					return $row;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		public function nameExists($name) {
			$this->db->query('SELECT * FROM apostle WHERE apostleName = :apostleName');
			$this->db->bind(':apostleName', $name);
			$result = $this->db->resultSet();

			if($this->db->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		}

		public function getApostleData($ID) {
			$this->db->query('SELECT * FROM apostle WHERE ID = :ID');
			$this->db->bind(':ID', $ID);
			$row = $this->db->single();

			return $row;
		}

		public function getContentData($name) {
			$this->db->query('SELECT formContent.title, formContent.description, formContent.images,
							  formText.title AS catTitle
							  FROM formContent
    						  INNER JOIN formText
        					  ON formContent.category = formText.category
							  WHERE formContent.value = :value');
			$this->db->bind(':value', $name);
			$row = $this->db->single();

			return $row;
		}

		public function getSpawnForm($name) {
			$this->db->query('SELECT formContent.title, formContent.description, formContent.images FROM formContent WHERE formContent.value = :value');
			$this->db->bind(':value', $name);
			$row = $this->db->single();

			return $row;
		}

		public function getAbilities($name) {
			if(strpos($name, ', ')) {
				$abilities = [];
				$name = explode(', ', $name);

				foreach($name as $ability) {
					$row = $this->getContentData($ability);
					array_push($abilities, $row);
				}

				return $abilities;

			} else {
				$row = $this->getContentData($name);
				return $row;
			}
		}

	}