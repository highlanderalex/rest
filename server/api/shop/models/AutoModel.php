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
            $res = $this->inst->Select('a.id, a.description, a.price, a.model, a.image, c.titleCat')
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
            $res = $this->inst->Select('color, year, price, model, speed, volume')
                              ->From('a_auto')
							  ->Where('id=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function returnSearchResult($obj)
        {
			$arr['where'] = $obj->model;
            $res = $this->inst->Select('id')
                              ->From('a_auto')
							  ->Where('model=')
							  ->A('year=', $obj->year)
							  ->A("color='", $obj->color. "'")
							  ->A('volume=', $obj->volume)
							  ->A('price=', $obj->price)
							  ->A('speed=', $obj->speed)
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
		public function returnImage($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('image')
                              ->From('a_auto')
							  ->Where('id=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function returnGalary($id)
        {
			$arr['where'] = $id;
            $res = $this->inst->Select('image')
                              ->From('a_galary')
							  ->Where('idAuto=')
							  ->Execute($arr);
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
		
    }
