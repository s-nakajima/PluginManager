<?php
/**
 * Setting tabs template
 *   - $active: Active tab key. Value is 'block_index or 'frame_settings' or 'role_permissions'.
 *   - $disabled: Disabled tab
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<ul class="nav nav-tabs" role="tablist">
	<li class="<?php echo ($active === Plugin::PLUGIN_TYPE_FOR_FRAME ? 'active' : ''); ?>">
		<a href="<?php echo $this->NetCommonsHtml->url(array('action' => 'index', Plugin::PLUGIN_TYPE_FOR_FRAME)); ?>">
			<?php echo __d('plugin_manager', 'Installed plugins'); ?>
		</a>
	</li>

	<li class="<?php echo ($active === Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL ? 'active' : ''); ?>">
		<a href="<?php echo $this->NetCommonsHtml->url(array('action' => 'index', Plugin::PLUGIN_TYPE_FOR_CONTROL_PANEL)); ?>">
			<?php echo __d('plugin_manager', 'System plugins'); ?>
		</a>
	</li>

	<li class="<?php echo ($active === Plugin::PLUGIN_TYPE_CORE ? 'active' : ''); ?>">
		<a href="<?php echo $this->NetCommonsHtml->url(array('action' => 'index', Plugin::PLUGIN_TYPE_CORE)); ?>">
			<?php echo __d('plugin_manager', 'Core plugins'); ?>
		</a>
	</li>

	<?php if ($hasNewPlugin) : ?>
		<li class="<?php echo ($active === Plugin::PLUGIN_TYPE_FOR_NOT_YET ? 'active' : ''); ?>">
			<a href="<?php echo $this->NetCommonsHtml->url(array('action' => 'index', Plugin::PLUGIN_TYPE_FOR_NOT_YET)); ?>">
				<?php echo __d('plugin_manager', 'Plugins not yet installed'); ?>
			</a>
		</li>
	<?php endif; ?>

	<li class="<?php echo ($active === Plugin::PLUGIN_TYPE_FOR_THEME ? 'active' : ''); ?>">
		<a href="<?php echo $this->NetCommonsHtml->url(array('action' => 'index', Plugin::PLUGIN_TYPE_FOR_THEME)); ?>">
			<?php echo __d('plugin_manager', 'Themes'); ?>
		</a>
	</li>

	<li class="<?php echo ($active === Plugin::PLUGIN_TYPE_FOR_EXT_COMPOSER ? 'active' : ''); ?>">
		<a href="<?php echo $this->NetCommonsHtml->url(array('action' => 'index', Plugin::PLUGIN_TYPE_FOR_EXT_COMPOSER)); ?>">
			<?php echo __d('plugin_manager', 'External libraries'); ?>
		</a>
	</li>

	<li class="<?php echo ($active === Plugin::PLUGIN_TYPE_FOR_EXT_BOWER ? 'active' : ''); ?>">
		<a href="<?php echo $this->NetCommonsHtml->url(array('action' => 'index', Plugin::PLUGIN_TYPE_FOR_EXT_BOWER)); ?>">
			<?php echo __d('plugin_manager', 'Js libraries'); ?>
		</a>
	</li>
</ul>
