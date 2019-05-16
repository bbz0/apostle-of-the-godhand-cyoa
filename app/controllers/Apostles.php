<?php
	class Apostles extends Controller {

		public function __construct() {

			$this->apostleModel = $this->model('Apostle');

		}

		public function index() {

			if(isLoggedIn()) {

				$apostle = $this->apostleModel->getApostleData($_SESSION['apostle_id']);

				$data = [
					'name' => $apostle->apostleName,
					'sacrifice' => $this->apostleModel->getContentData($apostle->sacrifice),
					'desire' => $this->apostleModel->getContentData($apostle->desire),
					'aspect' => $this->apostleModel->getContentData($apostle->aspect),
					'incarnation' => $this->apostleModel->getContentData($apostle->incarnation),
					'abilities' => $this->apostleModel->getAbilities($apostle->abilities),
					'abyssalAbilities' => $this->apostleModel->getAbilities($apostle->abyssalAbilities),
					'spawn' => $this->apostleModel->getContentData($apostle->spawn),
					'spawnForm' => $this->apostleModel->getSpawnForm($apostle->spawnForm),
					'shortcomings' => $this->apostleModel->getContentData($apostle->shortcomings)
				];

				$this->view('apostles/index', $data);

			} else {

				redirect('apostles/login');

			}

		}

		public function add() {

			if(!isAcknowledged()) {
				redirect('pages/warning');
			}

			if(isLoggedIn()) {

				redirect('apostles/index');

			}

			$formGroup = $this->apostleModel->getFormGroup();
			$formData = $this->apostleModel->getFormData();

			$abilityLimit = 6;

			$data = [
				'formGroup' => $formGroup,
				'formData' => $formData,
			];

			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$postData = [
					'sacrifice' => '',
					'desire' => '',
					'aspect' => '',
					'incarnation' => '',
					'abilities' => '',
					'abyssalAbilities' => '',
					'spawn' => '',
					'spawnForm' => '',
					'shortcomings' => '',
					'apostleName' => ''
				];

				foreach($data['formGroup'] as $formGroup) {
					if(empty($_POST[$formGroup->category])) {
						$postData[$formGroup->category] = '';
						if($formGroup->category == 'apostleName') {
							$formGroup->error = 'Please enter your name!';
						} else {
							if($formGroup->category !== 'abyssalAbilities') {
								$formGroup->error = 'Please choose your ' . $formGroup->title . '!';
							}
						}
					} else {
						if($formGroup->formType == 'checkbox') {
							$postData[$formGroup->category] = $_POST[$formGroup->category];
						} else if($formGroup->category == 'apostleName') {
							$postData[$formGroup->category] = substr(strip_tags($_POST[$formGroup->category]), 0, 255);
						} else {
							$postData[$formGroup->category] = trim($_POST[$formGroup->category]);
						}
					}
				}

				if(empty($_POST['spawnForm'])) {
					$postData['spawnForm'] = '';
					$spawnFormError = 'Choose a Spawn Form!';
					$data['spawnFormError'] = $spawnFormError;
				} else {
					$postData['spawnForm'] = trim($_POST['spawnForm']);
				}

				// if(!empty($postData['abilities']) && count($postData['abilities']) > 6) {
				// 	$data['formGroup'][4]->error = 'You cannot have more than six Apostolic Abilities!';
				// }

				// if(!empty($postData['abyssalAbilities']) && count($postData['abyssalAbilities']) > 3) {
				// 	$data['formGroup'][5]->error = 'You cannot have more than three Abyssal Abilities!';
				// }

				if(!empty($postData['abilities'])) {
					for($i = 0; $i < count($postData['abilities']); $i++) {
						$abilityLimit -= 1;
						if($abilityLimit < 0) {
							$data['formGroup'][4]->error = 'You cannot have more abilities!';
						}
					}
				}

				if(!empty($postData['abyssalAbilities'])) {
					if($abilityLimit < 0) {
						$data['formGroup'][5]->error = 'You cannot have more abilities!';
					} else {
						for($i = 0; $i < count($postData['abyssalAbilities']); $i++) {
							$abilityLimit -= 2;
							if($abilityLimit < 0) {
								$data['formGroup'][5]->error = 'You cannot have more abilities!';
							}
						}
					}
				}

				if($this->apostleModel->nameExists($postData['apostleName'])) {
					$data['formGroup'][8]->error = 'Name already exists, enter another name.';
				}

				if(empty($data['formGroup'][0]->error) && empty($data['formGroup'][1]->error) && empty($data['formGroup'][2]->error) && empty($data['formGroup'][3]->error) && empty($data['formGroup'][4]->error) && empty($data['formGroup'][5]->error) && empty($data['formGroup'][6]->error) && empty($data['formGroup'][7]->error) && empty($data['formGroup'][8]->error) && empty($spawnFormError)) {

					$postData['abilities'] = implode(', ', $postData['abilities']);
					if(!empty($postData['abyssalAbilities'])) {
						$postData['abyssalAbilities'] = implode(', ', $postData['abyssalAbilities']);
					}
					
					$data['name'] = $postData['apostleName'];
					$data['password'] = $this->generatePass();
					$postData['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					if($this->apostleModel->createApostle($postData)) {
						$this->view('apostles/confirmation', $data);
					} else {
						die('Something went wrong');
					}

				} else {
					$this->view('apostles/add', $data);
				}

			} else {

				$this->view('apostles/add', $data);

			}

		}

		public function login() {

			if(!isAcknowledged()) {
				redirect('pages/warning');
			}

			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				$data = [
					'name' => trim($_POST['name']),
					'password' => trim($_POST['password']),
				];

				if(empty($data['name'])) {
					$data['name_err'] = 'Please enter your name!';
				}

				if(empty($data['password'])) {
					$data['password_err'] = 'Please enter the password!';
				}

				if(empty($data['name_err']) && empty($data['password_err'])) {
					$apostle = $this->apostleModel->findApostle($data['name'], $data['password']);
					if($apostle) {
						$this->createSession($apostle);
					} else {
						$data['error'] = 'Name or password is incorrect';
						$this->view('apostles/login', $data);
					}
				}

			} else {

				$this->view('apostles/login');

			}

		}

		public function createSession($apostle) {
			$_SESSION['apostle_id'] = $apostle->ID;
			$_SESSION['apostle_name'] = $apostle->apostleName;
			redirect('apostles');
		}

		public function logout() {
			unset($_SESSION['apostle_ud']);
			unset($_SESSION['apostle_name']);
			session_destroy();
			redirect('apostles/login');
		}

		public function generatePass() {

			$alphabet = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789';
			$pass = array();
			$alphaLength = strlen($alphabet) - 1;
			for($i = 0; $i < 10; $i++) {
				$n = rand(0, $alphaLength);
				$pass[] = $alphabet[$n];
			}

			$password = implode($pass);

			return $password;
		}

	}