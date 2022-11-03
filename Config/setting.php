<?php
/**
 * [Config] 設定ファイル
 */

/**
 * 専用ログ
 */
if (!defined('LOG_EXAMPLE_PLUGIN')) {
	define('LOG_EXAMPLE_PLUGIN', 'log_example_plugin');
	CakeLog::config('log_example_plugin', [
		'engine' => 'FileLog',
		'types' => ['log_example_plugin'],
		'file' => 'log_example_plugin',
		'size' => '5MB',
		'rotate' => 5,
	]);
}
