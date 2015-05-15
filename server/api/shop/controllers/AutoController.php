<?php
    
	require_once (dirname(__FILE__).'/../models/CategoryModel.php');
	require_once (dirname(__FILE__).'/../models/AutoModel.php');
	require_once (dirname(__FILE__).'/../models/OrderModel.php');
	require_once ('controllers/RouteController.php');

    class AutoController 
	{
		
		public function __construct()
		{
			
		}
		
		public function getCategories()
        {
			$model = new CategoryModel();
            $res = $model->returnCategories();
            return $res;
        }
		
		public function allAutoAction()
        {
			$model = new AutoModel();
            $res = $model->returnAllAuto();
            //return $res;
			echo json_encode($res);
        }
		
		public function getImage($id)
        {
			$model = new AutoModel();
            $res = $model->returnImage($id);
			if(!empty($res))
			{
				return $res;
			}
			else
			{
				throw new SoapFault('Server', 'ID auto do not exist');
			}
        }
		
		public function getGalary($id)
        {
			$model = new AutoModel();
            $res = $model->returnGalary($id);
			if(!empty($res))
			{
				return $res;
				//echo json_encode($res);
			}
			else
			{
				//throw new SoapFault('Server', 'ID auto do not exist');
				return false;
			}
        }
		
		public function detailInfoAction()
        {
            $id = RouteController::getParams();
			$model = new AutoModel();
            $res = $model->returnInfoAuto($id);
			if(!empty($res))
			{
				//return $res;
				echo json_encode($res);
			}
			else
			{
				return false;
			}
        }
		
		public function getSearchAction()
        {
            $data['model'] = $_POST['model'];
            $data['color'] = $_POST['color'];
            $data['speed'] = $_POST['speed'];
            $data['volume'] = $_POST['volume'];
            $data['price'] = $_POST['price'];
            $data['year'] = $_POST['year'];
			$model = new AutoModel();
            $res = $model->returnSearchResult($data);
			if(!empty($res))
			{
				//return $res;
				echo json_encode($res);
			}
			else
			{
				$res['error'] = 1;
				echo json_encode($res);
			}
        }
		
		public function insertOrder($data)
        {
			$model = new OrderModel();
            $res = $model->insertOrder($data);
			if($res)
			{
				return $res;
			}
			else
			{
				throw new SoapFault('Server', 'Order not insert');
			}
        }
		
		public function getCarsByCat($id)
        {
			$model = new AutoModel();
            $res = $model->returnAutoByCat($id);
			if(!empty($res))
			{
				return $res;
			}
			else
			{
				throw new SoapFault('Server', 'ID category do not exist');
			}
        }
    }

