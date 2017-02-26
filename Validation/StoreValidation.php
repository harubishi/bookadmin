<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/Validation/Validation.php");

class StoreValidation extends Validation{

	/*
		配列とか連想配列は[キー名 => 値]
		[name => 配列]という連想配列
		[name => array() ]という連想配列
	*/	
	public $validate = [
		'name' =>[
			'notEmpty' =>[
				'rule' => 'notEmpty',
				'message' => '店舗名を入力してください'
			],
			'maxLength' =>[
				'rule' => ['maxLength',20],
				'message' => '店舗名は20文字以内で入力してください'
			]
		],
		'address' =>[
			'rule' => 'notEmpty',
			'message' => '住所を入力してください'
		],
		'telephone' =>[
			'notEmpty' =>[
				'rule' => 'notEmpty',
				'message' => '電話番号を入力してください'
			],
			'isNumeric' =>[
				'rule' => 'isNumeric',
				'message' => '半角数字を入力してください'
			]
		]
	];


	public function __construct()
	{
		$this->_setValidate($this->validate);
	}
}