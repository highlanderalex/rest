<?php

	require_once ('DB.php');
    
    class UserModel 
	{
		private $inst;
		
		public function __construct()
		{
			$this->inst = DB::run();
		}
		
		public function returnEmail($email)
        {
			$arr['where'] = $email;
            $res = $this->inst->Select('COUNT(email) as val')
						      ->From('a_users')
							  ->Where('email=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function returnCheckData($idUser, $email)
        {
			$arr['where'] = $email;
			$arr['and'] = $idUser;
            $res = $this->inst->Select('COUNT(email) as val')
						      ->From('a_users')
							  ->Where('email=')
							  ->I('id!=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function returnAuth($data)
        {
			$arr['where'] = $data['email'];
			$arr['and'] = $data['password'];
            $res = $this->inst->Select('COUNT(id)')
						      ->From('a_users')
							  ->Where('email=')
							  ->I('password=')
							  ->Execute($arr);
			$res = $this->inst->dbCount($res);
            return $res; 
        }
		
		public function returnDataUser($data)
        {
			$arr['where'] = $data['email'];
			$arr['and'] = $data['password'];
            $res = $this->inst->Select('id, name, code')
						      ->From('a_users')
							  ->Where('email=')
							  ->I('password=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function returnUser($id)
        {
            $arr['where'] = $id;
			$res = $this->inst->Select('name')
						      ->From('a_users')
							  ->Where('id=')
							  ->Execute($arr);
			$res = $this->inst->dbLineArray($res);
            return $res; 
        }
		
		public function insertDb($data)
        {
			$arr['name'] = $data['name'];
			$arr['email'] = $data['email'];
			$arr['password'] = $data['password'];
			$arr['code'] = md5('anithing_string');
			$res = $this->inst->Insert('a_users')
						      ->Fields($arr)
							  ->Values($arr)
							  ->Execute();
            return $res;
        }
		
	}
