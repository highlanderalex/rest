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
            $arr['idAuto'] = $data['id'];
            $arr['name'] = $data['name'];
            $arr['email'] = $data['email'];
            $arr['pay'] = $data['pay'];
			$res = $this->inst->Insert('a_orders')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
            return $res;
        }
    }
