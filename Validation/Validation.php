<?php



class Validation{

	protected $_params;
	protected $_validate;
	private   $__errors;

	public function validate()
	{
		$result = [];
		$params = $this->_params;
		$validates = $this->_validate;
		
		foreach($validates as $column => $validate){//①のチェック

			if(!empty($validate['rule'])){//ruleが存在する
				$rule = $validate['rule'];
				if($this->__isString($rule)){//ruleが検証値だけのとき
					$func = '__' . $rule;
					$result[$column] = $this->$func($params[$column]);
				}else{
					$func = '__' . array_shift($rule);
					$result[$column] = $this->$func($params[$column],$rule);
				}
			}else{
				foreach($validate as $array){
					$rule = $array['rule'];
					$validate['message'] = $array['message'];
					if($this->__isString($rule)){//ruleが検証値だけのとき
						$func = '__' . $rule;
						$result[$column] = $this->$func($params[$column]);
					}else{
						$func =  '__' . array_shift($rule);
						$result[$column] = $this->$func($params[$column],$rule);
					}

					if(!$result[$column]){
						break;
					}
				}

			}//②③のチェック

			if($result[$column] !== true){
				$this->__setErrors($column,$validate['message']);
			}
		}

		return $this->__hasErrors();
	}

	//関数で値以外の引数をとるものは、値以外のものは全て配列に(params)に入る
	
	public function set($params)
	{
		$this->_params = $params;
	}

	public function getErrors()
	{
		return $this->__errors;
	}

	protected function _setValidate($validate)
	{
		$this->_validate = $validate;

	}

	private function __notEmpty($value)
	{
		return !empty($value)? true :false;
	}

	private function __maxLength($value, $params)
	{
		return (mb_strlen($value,'UTF8') <= $params[0])? true :false;
	}

	private function __minLength($value, $params)
	{
		return (mb_strlen($value,'UTF8') >= $params[0])? true : false;
	}

	private function __isString($val)
	{
		return is_string($val)? true : false;
	}

	private function __isNumeric($val)
	{
		return (is_numeric($val))? true : false;
	}

	private function __setErrors($column,$message)
	{
		$this->__errors[$column] = $message;
	}

	private function __hasErrors()
	{
		return empty($this->__errors)? true : false;
	}


}
