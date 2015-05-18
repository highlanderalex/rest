<?php

	require_once ('DB.php');

    class AutoModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
      
        public function returnAllAuto()
        {
            $res = $this->inst->Select('a.id, a.description, a.price, a.model, a.image, c.titleCat, a.color, a.year')
                              ->From('a_auto a')
                              ->Left()
							  ->Join('a_categories c')
                              ->On('a.idCat=c.idCat')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnAutoByCat($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('a.id, a.description, a.price, a.model, a.image, c.titleCat')
                              ->From('a_auto a')
                              ->Left()
							  ->Join('a_categories c')
                              ->On('a.idCat=c.idCat')
							  ->Where('a.idCat=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnInfoAuto($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('color, year, price, model, speed, volume, image, id')
                              ->From('a_auto')
							  ->Where('id=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function checkAutoOrder($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('COUNT(idAuto) as val')
                              ->From('a_orders')
							  ->Where('idAuto=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function deleteAuto($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Delete()
                              ->From('a_auto')
							  ->Where('id=')
							  ->Limit(1)
							  ->Execute($arr);
            return $res; 
        }
		
		public function updateAuto($data)
        {
			$arr['where'] = $data['id'];
			$color = $data['color'];
			$year = $data['year'];
			$model = $data['model'];
			$price = $data['price'];
			$image = $data['image'];
            $res = $this->inst->Update('a_auto')
						      ->Set("color='" . $color . "', model='" . $model . "', image='" . $image . "', year='" . $year . "', price=" . $price)
							  ->Where('id=')
							  ->Limit(1)
							  ->Execute($arr);
            return $res;
        }
		
		public function returnSearchResult($data)
        {
			$arr['where'] = $data['model'];
            $res = $this->inst->Select('id')
                              ->From('a_auto')
							  ->Where('model=')
							  ->A('year=', $data['year'])
							  ->A("color='", $data['color']. "'")
							  ->A('volume=', $data['volume'])
							  ->A('price=', $data['price'])
							  ->A('speed=', $data['speed'])
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
    }
