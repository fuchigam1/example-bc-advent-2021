<?php
/**
 * [Model] ExamplePlugin
 */
class ExamplePlugin extends AppModel {

	public $useTable = false;

	public $validate = [
		'title' => [
			['rule' => ['notBlank'], 'message' => '必須入力です。'],
			['rule' => ['maxLength', 230], 'message' => 'タイトルは230文字以内で入力してください。'],
		],
	];

}
