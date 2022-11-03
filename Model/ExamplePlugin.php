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

	public function jsonEncode($arrayValue) {
		$json = json_encode($arrayValue, JSON_UNESCAPED_UNICODE);
		if (JSON_ERROR_NONE !== json_last_error()) {
			try {
				throw new InvalidArgumentException('json_encode error: ' . json_last_error_msg());
			} catch (Exception $e) {
				$errorList['exception'] = $e;
				$errorList['json_error'] = json_last_error_msg();
				return $errorList;
			}
		}
		return $json;
	}

	public function jsonDecode($jsonValue) {
		$arrayData = json_decode($jsonValue, true);
		if (JSON_ERROR_NONE !== json_last_error()) {
			try {
				throw new InvalidArgumentException('json_decode error: ' . json_last_error_msg());
			} catch (Exception $e) {
				$errorList['exception'] = $e;
				$errorList['json_error'] = json_last_error_msg();
				return $errorList;
			}
		}
		return $arrayData;
	}

}
