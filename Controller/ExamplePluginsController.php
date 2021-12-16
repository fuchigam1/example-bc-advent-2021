<?php
/**
 * [Controller] ExamplePluginsController
 */
class ExamplePluginsController extends AppController {

	public $uses = ['SiteConfig'];

	public $components = ['BcAuth', 'Cookie', 'BcAuthConfigure'];

	public $crumbs = [
		[
			'name' => 'Example設定',
			'url' => ['plugin' => 'example_plugin', 'controller' => 'example_plugins', 'action' => 'form']
		],
	];

	public function __construct($request = null, $response = null) {
		parent::__construct($request, $response);
		// 利用設定値の追加・更新: uses に設定するとテーブルを探しに行くためこのタイミングでモデルを取る
		$this->ExamplePluginModel = ClassRegistry::init('ExamplePlugin.ExamplePlugin');
	}

	/**
	 * [ADMIN] 設定
	 */
	public function admin_form() {
		$this->pageTitle = '設定';

		if ($this->request->is(['post', 'put'])) {
			$this->ExamplePluginModel->set($this->request->data);
			if (!$this->ExamplePluginModel->validates()) {
				$this->BcMessage->setError('入力エラーです。内容を修正してください。');
				$this->render('form');
				return;
			} else {
				$requestData = [
					'ExamplePlugin' => $this->request->data['ExamplePlugin'],
				];
				$encoded = ExamplePluginUtil::jsonEncode($requestData);
				if (isset($encoded['exception'])) {
					if (is_object($encoded['exception'])) {
						$message = '保存できない文字列が含まれています。内容を修正してください。';
						$message .= $encoded['exception']->getMessage();
						$this->BcMessage->setError($message);

						CakeLog::write(LOG_EXAMPLE_PLUGIN, $encoded['json_error']);
						CakeLog::write(LOG_EXAMPLE_PLUGIN, print_r($this->request->data, true));

						$this->render('form');
						return;
					}
				}

				if ($this->SiteConfig->saveKeyValue(['example_plugin' => $encoded])) {
					$this->BcMessage->setSuccess('設定値を保存しました。');
					clearAllCache();
				}
				$this->redirect(['action' => 'form']);
			}
		} else {
			$data = $this->SiteConfig->findByName('example_plugin');
			if ($data) {
				$decoded = ExamplePluginUtil::jsonDecode($data['SiteConfig']['value']);
				if (isset($decoded['exception'])) {
					if (is_object($decoded['exception'])) {
						$message = 'フォーム用の文字列に変換できない文字列が含まれています。内容を修正してください。';
						$message .= $decoded['exception']->getMessage();
						$this->BcMessage->setError($message);

						CakeLog::write(LOG_EXAMPLE_PLUGIN, $decoded['json_error']);
						CakeLog::write(LOG_EXAMPLE_PLUGIN, print_r($this->request->data, true));
					}
				} else {
					$this->request->data = $decoded;
				}
			}
		}
	}

}
