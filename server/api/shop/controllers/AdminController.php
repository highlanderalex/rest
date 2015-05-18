<?php
    
    class AdminController 
	{
		private $auto;
		private $view;
		private $format;
		public function __construct()
		{
			$this->auto = new AutoModel();
			$this->view = new View();
			$this->format = RouteController::getFormat();
		}
		
		public function getInfoAction() 
		{
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
			{
				$request = $_SERVER['REQUEST_METHOD'];
				switch ($request)
				{
					case 'GET':
						$this->getAuto();
					break;
					case 'POST':
						$this->postAuto();
					break;
					case 'DELETE':
						$id = RouteController::getParams();
						$this->deleteAuto($id);
					break;
				}
			}
			else
			{
				$this->view->getError(404);
			}
			
		}
		private function getAuto()
        {
            $res = $this->auto->returnAllAuto();
			$this->view->getData($res, $this->format);
        }
		
		private function postAuto()
        {
            $form = new ValidForm($_POST);
			$data = $form->validData();
			if (is_array($data))
			{
				$this->auto->updateAuto($data);	
			}
			else
			{
				$msg['result'] = $data;
				$this->view->getData($msg, $this->format);
			}
        }
		
		private function deleteAuto($id)
        {
            if($this->auto->checkAutoOrder($id) > 0)
			{
				$res['result'] = 'Can not delete this auto';
				$this->view->getData($res, $this->format);
			}
			else
			{
				$this->auto->deleteAuto($id);
				$res['success'] = 'Auto success deleted';
				$this->view->getData($res, $this->format);
			}
        }
		
    }

