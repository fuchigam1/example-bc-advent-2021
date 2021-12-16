<?php
/**
 * [Lib] ExamplePlugin
 */
class ExamplePluginUtil {

	public static function jsonEncode($arrayValue) {
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

	public static function jsonDecode($jsonValue) {
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
