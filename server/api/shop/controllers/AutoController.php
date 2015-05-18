<?php
    
    class AutoController 
	{
		private $model;
		private $view;
		private $format;
		public function __construct()
		{
			$this->model = new AutoModel();
			$this->view = new View();
			$this->format = RouteController::getFormat();
		}
		
		public function allAutoAction()
        {
            $res = $this->model->returnAllAuto();
			$this->view->getData($res, $this->format);
        }
		
		public function detailInfoAction()
        {
            $id = RouteController::getParams();
            $res = $this->model->returnInfoAuto($id);
			if(empty($res))
			{
				$res['result'] = 0;
			}
			$this->view->getData($res, $this->format);
        }
		
		public function getSearchAction()
        {
            $data['model'] = $_POST['model'];
            $data['color'] = $_POST['color'];
            $data['speed'] = $_POST['speed'];
            $data['volume'] = $_POST['volume'];
            $data['price'] = $_POST['price'];
            $data['year'] = $_POST['year'];
            $res = $this->model->returnSearchResult($data);
			if(empty($res))
			{
				$res['result'] = 0;
			}
			$this->view->getData($res, $this->format);
        }
		
    }

