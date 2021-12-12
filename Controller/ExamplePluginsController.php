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
			} else {
				$requestData = [
					'ExamplePlugin' => $this->request->data['ExamplePlugin'],
				];
				$data = [
					'example_plugin' => json_encode($requestData, JSON_UNESCAPED_UNICODE),
				];
				if ($this->SiteConfig->saveKeyValue($data)) {
					$this->BcMessage->setSuccess('設定値を保存しました。');
					clearAllCache();
				}
				$this->redirect(['action' => 'form']);
			}
		} else {
			$data = $this->SiteConfig->findByName('example_plugin');
			if ($data) {
				$this->request->data = json_decode($data['SiteConfig']['value'], true);
			}
		}
	}

}
