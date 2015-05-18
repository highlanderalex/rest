<?php
	
	class View 
	{
		public function __construct() 
		{
			
		}
		
		public function getData($data, $format) 
		{
			switch ($format)
			{
				case 'txt':
					$this->getTxt($data);
				break;
				case 'json':
					$this->getJson($data);
				break;
				case 'xml':
					$this->getXml($data);
				break;
				case 'html':
					$this->getHtml($data);
				break;
				default:$this->getJson($data);
			}
			
		}
		
		public function getError($code) 
		{
			switch ($code)
			{
				case 404:
					header("HTTP/1.0 404 Not Found");
					echo '404 Page Not Found'; 
				break;
				case 401:
					header("HTTP/1.0 401 Unauthorized");
					echo '401 Unauthorized'; 
				break;
			}
			
		}
		
		private function getJson($data)
		{
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($data);
		}

		private final function getTxt($data)
		{
			header('Content-Type: text/javascript; charset=utf-8');
			print_r($data);
		}
		
		private final function getHtml($data)
		{
			header('Content-Type: text/html; charset=utf-8');
			$table = '<table border="1" cellspacing="0" cellpadding="0" width="800px">';
			if (array_key_exists('result', $data))
			{
				print_r($data);
			}
			else
			{
				foreach($data as $row)
				{
					$table .= '<tr>';
					if (is_array($row))
					{
						foreach($row as $key => $val)
						{
							$table .= '<td>' . $val . '</td>';
						}
						$table .= '</tr>';
					}
					else
					{
						$table .= '<td>' . $row . '</td>';
					}
					$table .= '</tr>';
				}
				$table .= '</table>';
				echo $table;
			}
			
		}

		private final function getXml($data)
		{
			header('Content-Type: application/xml; charset=utf-8');
			$converter = new Array2XML();
			$xmlStr = $converter->convert($data);
			echo $xmlStr;
		}
	}
?>