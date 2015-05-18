<?php
    
    class OrderController 
	{
		private $model;
		private $view;
		private $format;
		public function __construct()
		{
			$this->model = new OrderModel();
			$this->view = new View();
			$this->format = RouteController::getFormat();
			
		}
		
		public function userOrderAction()
        {
            if (isset($_POST['id']))
			{
				$id = $_POST['id'];
				$res = $this->model->returnUserOrder($id);
				if(empty($res))
				{
					$res['result'] = 0;
				}
				$this->view->getData($res, $this->format);
			}
			else
			{
				$this->view->getError(401);
			}
        }
		
		public function addOrderAction()
        {
			if (isset($_POST['idUser']) && isset($_POST['idAuto']))
			{
				$data['idUser'] = $_POST['idUser'];
				$data['idAuto'] = $_POST['idAuto'];
				$data['pay'] = $_POST['pay'];
				$res = $this->model->insertOrder($data);
				if($res > 0)
				{
					$msg['result'] = 1;
				}
				$this->view->getData($msg, $this->format);
			}
			else
			{
				$this->view->getError(401);
			}
        }
    }

