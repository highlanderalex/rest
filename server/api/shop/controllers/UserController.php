<?php
    
    class UserController 
	{
		private $model;
		private $view;
		private $format;
		public function __construct()
		{
			$this->model = new UserModel();
			$this->view = new View();
			$this->format = RouteController::getFormat();
			
		}
		
		public function userAuthAction()
        {
            if (isset($_POST['email']) && isset($_POST['password']))
            {
                $form = new ValidForm($_POST);
				$data = $form->validData();
				if (is_array($data))
				{
					if($this->checkAuth($data))
					{
						$datauser = $this->dataUser($data);
						$this->view->getData($datauser, $this->format);
					}
					else
					{
						$msg['result'] = "Correct email or password<br />";
						$this->view->getData($msg, $this->format);
					}	
				}
				else
				{
					$msg['result'] = $data;
					$this->view->getData($msg, $this->format);
				}
			}
			else
			{
				$this->view->getError(404);
			}
        }
		
		public function userRegAction()
		{
			if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']))
			{
                $form = new ValidForm($_POST);
				$data = $form->validData();
                if (is_array($data))
				{
					if($this->checkEmail($data['email']))
					{
						$msg['result'] = 'This email exist yet<br />';
						$this->view->getData($msg, $this->format);
					}
					else
					{
						if($this->insertDb($data))
						{
                            $msg['success'] = 'New user success add';
							$this->view->getData($msg, $this->format);
						}
						else
						{
							$msg['result'] = 'Error add new user<br />';
							$this->view->getData($msg, $this->format);
						}
					}
				}
				else
				{
					$msg['result'] = $data;
					$this->view->getData($msg, $this->format);
				}
			}
			else
			{
				$this->view->getError(404);
			}
		}
		
		private function checkEmail($email)
        {
            $res = $this->model->returnEmail($email);
            return $res;
        }
		
		private function insertDb($data)
        {
            $res = $this->model->insertDb($data);
            return $res;
        }
		
		private function checkAuth($data)
        {
            $res = $this->model->returnAuth($data);
            return $res;
        }
		
		private function dataUser($data)
        {
            $res = $this->model->returnDataUser($data);
            return $res;
        }
    }

