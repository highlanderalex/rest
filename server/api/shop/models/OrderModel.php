<?php

	require_once ('DB.php');
    
    class OrderModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
      
		public function insertOrder($data)
        {
            $arr['idAuto'] = $data['idAuto'];
            $arr['idUser'] = $data['idUser'];
            $arr['pay'] = $data['pay'];
			$res = $this->inst->Insert('a_orders')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
            return $res;
        }
		
		public function returnUserOrder($id)
        {
            $arr['where'] = $id;
			$res = $this->inst->Select('o.data, o.pay, a.model, a.color, a.price, a.image')
						      ->From('a_orders o')
							  ->Left()
							  ->Join('a_auto a')
                              ->On('a.id=o.idAuto')
							  ->Where('o.idUser=')
							  ->Order('data')
							  ->Desc()
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res;
        }
    }
