<?php
	/* Class View
       * *
       * *
       * * @method construct: empty
       * * @method render: Include base template
       * */
	   
	class View 
	{
		public function __construct() 
		{
		
		}
		
		/* render method
            * *
            * *
            * * @param string: param string name of template
            * * @return: Return void
            * */
			
		public function render($name) 
		{
			$view = $name;
			require_once ('resources/templates/shop.php');
			
		}
	}
?>