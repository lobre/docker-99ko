<?php defined('ROOT') OR exit('No direct script access allowed'); ?>

<br />
<form method="post" action="index.php?p=pluginsmanager&action=save" id="pluginsmanagerForm">
	<?php show::adminTokenField(); ?>
	<table>
	  <thead>
		<tr>
			<th><?php echo $core->lang("Name"); ?></th>
			<th><?php echo $core->lang("Priority"); ?></th>
			<th><?php echo $core->lang("Enable"); ?></th>
		</tr>
	  </thead>
	  <tbody>			  	
		<?php foreach($pluginsManager->getPlugins() as $plugin){ ?>
		<tr>
			<td>
				<a href="<?php echo $plugin->getInfoVal('authorWebsite'); ?>" target="_blank"><?php echo $core->lang($plugin->getInfoVal('name')); ?>&nbsp;&nbsp;&nbsp;(<?php echo $plugin->getInfoVal('version'); ?>)</a>
				<?php if($plugin->getConfigVal('activate') && !$plugin->isInstalled()){ ?>&nbsp;&nbsp;<a class="button" href="index.php?p=pluginsmanager&action=maintenance&plugin=<?php echo $plugin->getName(); ?>&token=<?php echo administrator::getToken(); ?>"><?php echo $core->lang("Maintenance required"); ?></a><?php } ?>
				<div class="description">
					<?php echo $core->lang($plugin->getInfoVal('description')); ?>
				</div>
			</td>
			<td><?php echo util::htmlSelect($priority, $plugin->getconfigVal('priority'), 'name="priority['.$plugin->getName().']" onchange="document.getElementById(\'pluginsmanagerForm\').submit();"'); ?></td>
			<td>
				<?php if(!$plugin->isRequired()){ ?>
				<input onchange="document.getElementById('pluginsmanagerForm').submit();" id="activate[<?php echo $plugin->getName(); ?>]" type="checkbox" name="activate[<?php echo $plugin->getName(); ?>]" <?php if($plugin->getConfigVal('activate')){ ?>checked<?php } ?> />
				<?php } else{ ?>
				<input style="display:none;" id="activate[<?php echo $plugin->getName(); ?>]" type="checkbox" name="activate[<?php echo $plugin->getName(); ?>]" checked />
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	  </tbody>					
	</table>