<?php

    require_once ('DB.php');

    class CategoryModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
        }

		public function returnCategories()
        {
            $res = $this->inst->Select('idCat, titleCat')
						      ->From('a_categories')
							  ->Execute();
			$res = $this->inst->dbResultToArray($res);
            return $res; 
        }
	}
