<?php 
	class Pages extends Controller {
		public function __construct() {
		}

		public function index() {

			if(!isAcknowledged()) {
				redirect('pages/warning');
			}

			$this->view('pages/index');
		}

		public function about() {
			$this->view('pages/about');
		}

		public function warning() {

			if(isAcknowledged()) {
				redirect('index');
			}

			$data = [
				'Error' => ''
			];

			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				if(empty($_POST['acknowledge'])) {
					$data['Error'] = 'You must acknowledge before proceeding!';
				}

				if(empty($data['Error'])) {
					$_SESSION['acknowledged'] = true;
					redirect('index');
				} else {
					$this->view('pages/warning', $data);
				}

			} else {

				$this->view('pages/warning', $data);

			}
		}
	}