<?php
/**
 * PluginManager Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('PluginManagerAppController', 'PluginManager.Controller');

/**
 * PluginManager Controller
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\PluginManager\Controller
 */
class PluginManagerController extends PluginManagerAppController {

/**
 * constant value for not yet
 */
	const TAB_FOR_NOT_YET = 'not_yet_installed';

/**
 * constant value for frame
 */
	const TAB_FOR_FRAME = 'installed';

/**
 * constant value for control panel
 */
	const TAB_FOR_CONTROL_PANEL = 'system_plugins';

/**
 * constant value for control panel
 */
	const TAB_FOR_EXTERNAL = 'external_plugins';

/**
 * Called before the controller action. You can use this method to configure and customize components
 * or perform logic that needs to happen before each controller action.
 *
 * @return void
 * @link http://book.cakephp.org/2.0/en/controllers.html#request-life-cycle-callbacks
 */
	public function beforeFilter() {
		parent::beforeFilter();

		$Plugin = $this->Plugin;

		if (isset($this->params['pass'][0])) {
			$pluginType = $this->params['pass'][0];
		} else {
			$pluginType =  $Plugin::PLUGIN_TYPE_FOR_FRAME;
		}

		switch ($pluginType) {
			case $Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL:
				$this->set('active', self::TAB_FOR_CONTROL_PANEL);
				break;
			case $Plugin::PLUGIN_TYPE_FOR_NOT_YET:
				$this->set('active', self::TAB_FOR_CONTROL_PANEL);
				break;
			case $Plugin::PLUGIN_TYPE_FOR_EXTERNAL:
				$this->set('active', self::TAB_FOR_EXTERNAL);
				break;
			default:
				$this->set('active', self::TAB_FOR_FRAME);
		}
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$Plugin = $this->Plugin;

		$plugins['type' . $Plugin::PLUGIN_TYPE_FOR_FRAME] = $this->Plugin->getPlugins(
			$Plugin::PLUGIN_TYPE_FOR_FRAME,
			Configure::read('Config.languageId')
		);

		$plugins['type' . $Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL] = $this->Plugin->getPlugins(
			$Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL,
			Configure::read('Config.languageId')
		);

		$pluginsMap['type' . $Plugin::PLUGIN_TYPE_FOR_FRAME] =
				array_flip(array_keys(Hash::combine($plugins['type' . $Plugin::PLUGIN_TYPE_FOR_FRAME], '{n}.Plugin.key')));

		$pluginsMap['type' . $Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL] =
				array_flip(array_keys(Hash::combine($plugins['type' . $Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL], '{n}.Plugin.key')));

		$this->ControlPanelLayout->plugins = $plugins['type' . $Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL];

		$this->set('plugins', $plugins);
		$this->set('pluginsMap', $pluginsMap);
	}

/**
 * view method
 *
 * @param int $pluginType Plugin type
 * @param string $pluginKey Plugin key
 * @return void
 */
	public function view($pluginType = null, $pluginKey = null) {
		$plugins = $this->Plugin->getPlugins($pluginType, Configure::read('Config.languageId'), $pluginKey);
		if ($plugins) {
			$this->set('plugin', $plugins[0]);
		}

		$this->set('pluginType', $pluginType);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		//	if ($this->request->is('post')) {
		//		$this->PluginManager->create();
		//		if ($this->PluginManager->save($this->request->data)) {
		//			$this->Session->setFlash(__('The plugin manager has been saved.'));
		//			return $this->redirect(array('action' => 'index'));
		//		} else {
		//			$this->Session->setFlash(__('The plugin manager could not be saved. Please, try again.'));
		//		}
		//	}
		//	$languages = $this->PluginManager->Language->find('list');
		//	$trackableCreators = $this->PluginManager->TrackableCreator->find('list');
		//	$trackableUpdaters = $this->PluginManager->TrackableUpdater->find('list');
		//	$this->set(compact('languages', 'trackableCreators', 'trackableUpdaters'));
	}

/**
 * update method
 *
 * @return void
 */
	public function update() {
		if (! $this->request->isPost()) {
			$this->throwBadRequest();
			return;
		}

		//	if ($this->request->is('post')) {
		//		$this->PluginManager->create();
		//		if ($this->PluginManager->save($this->request->data)) {
		//			$this->Session->setFlash(__('The plugin manager has been saved.'));
		//			return $this->redirect(array('action' => 'index'));
		//		} else {
		//			$this->Session->setFlash(__('The plugin manager could not be saved. Please, try again.'));
		//		}
		//	}
		//	$languages = $this->PluginManager->Language->find('list');
		//	$trackableCreators = $this->PluginManager->TrackableCreator->find('list');
		//	$trackableUpdaters = $this->PluginManager->TrackableUpdater->find('list');
		//	$this->set(compact('languages', 'trackableCreators', 'trackableUpdaters'));
	}

/**
 * edit method
 *
 * @param int $pluginType Plugin type
 * @throws NotFoundException
 * @return void
 */
	public function order($pluginType = null) {
		if (! $this->request->isPost()) {
			$this->throwBadRequest();
			return;
		}

		$data = $this->data;
		unset($data['save']);
		if (! $this->Plugin->saveWeight($data)) {
			$this->throwBadRequest();
			return;
		}

		$this->setFlashNotification(__d('net_commons', 'Successfully saved.'), array('class' => 'success'));
		$this->redirect('/plugin_manager/plugin_manager/index/' . $pluginType . '/');
	}

/**
 * delete method
 *
 * @param string $id id
 * @throws NotFoundException
 * @return void
 */
	public function delete($id = null) {
		//	$this->PluginManager->id = $id;
		//	if (!$this->PluginManager->exists()) {
		//		throw new NotFoundException(__('Invalid plugin manager'));
		//	}
		//	$this->request->onlyAllow('post', 'delete');
		//	if ($this->PluginManager->delete()) {
		//		$this->Session->setFlash(__('The plugin manager has been deleted.'));
		//	} else {
		//		$this->Session->setFlash(__('The plugin manager could not be deleted. Please, try again.'));
		//	}
		//	return $this->redirect(array('action' => 'index'));
	}
}
