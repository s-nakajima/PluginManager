<?php
/**
 * PluginManager plugins template
 *   - $pluginType: plugins.type
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->Form->create(null, array('novalidate' => true, 'url' => '/plugin_manager/plugin_manager/order/' . $pluginType)); ?>
	<div ng-hide="plugins.type<?php echo $pluginType; ?>.length">
		<p><?php echo __d('net_commons', 'Not found.'); ?></p>
	</div>

	<?php foreach ($pluginsMap['type' . $pluginType] as $key => $value) : ?>
		<?php echo $key; ?>
		<?php $this->Form->unlockField($value . '.Plugin.weight'); ?>
	<?php endforeach; ?>
	<table class="table table-condensed" ng-show="plugins.type<?php echo $pluginType; ?>.length">
		<thead>
			<tr>
				<th></th>
				<th>
					<?php echo __d('plugin_manager', 'Plugin name'); ?>
				</th>
				<th>
					<?php echo __d('plugin_manager', 'Package'); ?>
				</th>
				<th>
					<?php echo __d('plugin_manager', 'Version'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="plugin in plugins.type<?php echo $pluginType; ?> track by $index">
				<td>
					<button type="button" class="btn btn-default btn-sm"
							ng-click="move('type<?php echo $pluginType; ?>', 'up', $index)" ng-disabled="$first">
						<span class="glyphicon glyphicon-arrow-up"></span>
					</button>

					<button type="button" class="btn btn-default btn-sm"
							ng-click="move('type<?php echo $pluginType; ?>', 'down', $index)" ng-disabled="$last">
						<span class="glyphicon glyphicon-arrow-down"></span>
					</button>

					<input type="hidden" name="data[{{getIndex('type<?php echo $pluginType; ?>', plugin.plugin.key)}}][Plugin][id]" ng-value="plugin.plugin.id">
					<input type="hidden" name="data[{{getIndex('type<?php echo $pluginType; ?>', plugin.plugin.key)}}][Plugin][key]" ng-value="plugin.plugin.key">
					<input type="hidden" name="data[{{getIndex('type<?php echo $pluginType; ?>', plugin.plugin.key)}}][Plugin][weight]" ng-value="{{$index + 1}}">

				</td>
				<td>
					{{plugin.plugin.name}}
				</td>
				<td>
					{{plugin.plugin.namespace}}
				</td>
				<td>

				</td>
			</tr>
		</tbody>
	</table>

	<div class="text-center">
		<button type="button" class="btn btn-default btn-workflow" onclick="">
			<span class="glyphicon glyphicon-remove"></span>
			<?php echo __d('net_commons', 'Cancel'); ?>
		</button>

		<?php echo $this->Form->button(__d('net_commons', 'OK'), array(
				'class' => 'btn btn-primary btn-workflow',
				'name' => 'save',
			)); ?>
	</div>

<?php echo $this->Form->end();
