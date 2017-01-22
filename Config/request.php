<?php

class Request{
	public function isPost()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			return true;
		}
		else{
			return false;
		}
	}

	public function isGet()
	{
		if($_SERVER['REQUEST_METHOD'] == 'GET'){
			return true;
		}
		else{
			return false;
		}	
	}
}