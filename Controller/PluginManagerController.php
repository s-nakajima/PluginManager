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

		if (isset($this->params['named']['active'])) {
			$this->set('active', $this->params['named']['active']);
		} else {
			$this->set('active', 'installed');
		}
	}

/**
 * view method
 *
 * @param string $id id
 * @throws NotFoundException
 * @return void
 */
	public function view($id = null) {
		//if (!$this->PluginManager->exists($id)) {
		//	throw new NotFoundException(__('Invalid plugin manager'));
		//}
		//$options = array('conditions' => array('PluginManager.' . $this->PluginManager->primaryKey => $id));
		//$this->set('pluginManager', $this->PluginManager->find('first', $options));
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
		$Plugin = $this->Plugin;
		if ($pluginType === $Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL) {
			$active = PluginManagerController::TAB_FOR_CONTROL_PANEL;
		} else {
			$active = PluginManagerController::TAB_FOR_FRAME;
		}
		$this->redirect('/plugin_manager/plugin_manager/index/active:' . $active);
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