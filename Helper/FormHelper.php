<?php

class FormHelper
{
	public function getQuantity()
	{
		$option = [];
		for($i = 0 ; $i < 4 ; $i++){
			$option[] =  $i;
		}

		return $this->__converteHash($option);
	}

	public function getTest()
	{
		$option = [
			'a',
			'b',
			'c'
		];

		return $this->__converteHash($option);

	}

	private __converteHash($array)
	{
		$result = [];
		foreach($array as $value)
		{
			$result[$value] = $value;
		}

		return $value;
	}
}