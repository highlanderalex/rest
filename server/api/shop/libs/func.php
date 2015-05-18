<?php
		/* __autoload function
            * *
            * *
            * * @param string: param string name of class
            * * @return: Retutn void
            * */
			
		function __autoload($class)
		{
			if (file_exists('controllers/'.$class.'.php') ) 
			{
				require_once ('controllers/'.$class.'.php');
			}
			
			if (file_exists('models/'.$class.'.php') ) 
			{
				require_once ('models/'.$class.'.php');
			}
			
			if (file_exists('views/'.$class.'.php') ) 
			{
				require_once ('views/'.$class.'.php');
			}
		}
		
		
	
	
	
	
	
