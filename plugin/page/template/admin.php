<?php include_once(ROOT.'admin/header.php'); ?>

<?php if($mode == 'list'){ ?>
<ul class="tabs_style">
  <li><a class="button" href="index.php?p=page&amp;action=edit"><?php echo $core->lang("Add a page"); ?></a></li>
  <li><a class="button" href="index.php?p=page&amp;action=edit&parent=1"><?php echo $core->lang("Add a parent item"); ?></a></li>
  <li><a class="button" href="index.php?p=page&amp;action=edit&link=1"><?php echo $core->lang("Add an external link"); ?></a></li>
</ul>
<table>
  <thead>
	<tr>
		<th></th>
		<th><?php echo $core->lang("Name"); ?></th>
		<th><?php echo $core->lang('Url'); ?></th>
		<th><?php echo $core->lang("Position"); ?></th>
		<th><?php echo $core->lang("Actions"); ?></th>
	</tr>
  </thead>
  <tbody>
	<?php foreach($page->getItems() as $k=>$pageItem) if($pageItem->getParent() == 0 && ($pageItem->targetIs() != 'plugin' || ($pageItem->targetIs() == 'plugin' && $pluginsManager->isActivePlugin($pageItem->getTarget())))){ ?>
	<tr>
		<td><?php if($pageItem->getIsHomepage()){ ?><img title="<?php echo $core->lang("Homepage"); ?>" src="<?php echo PLUGINS; ?>page/other/house.png" alt="icon" /><?php } ?> 
		    <?php if($pageItem->getIsHidden()){ ?><img title="<?php echo $core->lang("Does not appear in the menu"); ?>" src="<?php echo PLUGINS; ?>page/other/ghost.png" alt="icon" /><?php } ?>
			<?php if($pageItem->targetIs() == 'url'){ ?><img title="<?php echo $core->lang("Target : URL"); ?>" src="<?php echo PLUGINS; ?>page/other/link.png" alt="icon" /><?php } ?>
			<?php if($pageItem->targetIs() == 'plugin'){ ?><img title="<?php echo $core->lang("Target : plugin"); ?>" src="<?php echo PLUGINS; ?>page/other/plugin.png" alt="icon" /><?php } ?>
			<?php if($pageItem->targetIs() == 'parent'){ ?><img title="<?php echo $core->lang("Parent item"); ?>" src="<?php echo PLUGINS; ?>page/other/star.png" alt="icon" /><?php } ?>
		</td>
		<td><?php echo $pageItem->getName(); ?></td>
		<td><?php if($pageItem->targetIs() != 'parent'){ ?><input readonly="readonly" type="text" value="<?php echo $page->makeUrl($pageItem); ?>" /><?php } ?></td>
		<td>
		  <a class="up" href="index.php?p=page&action=up&id=<?php echo $pageItem->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="<?php echo PLUGINS; ?>page/other/up.png" alt="icon" /></a>&nbsp;&nbsp;
		  <a class="down" href="index.php?p=page&action=down&id=<?php echo $pageItem->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="<?php echo PLUGINS; ?>page/other/down.png" alt="icon" /></a>
		</td>
		<td>
		  <a class="button" href="index.php?p=page&amp;action=edit&amp;id=<?php echo $pageItem->getId(); ?>"><?php echo $core->lang("Edit"); ?></a> 
          <?php if(!$pageItem->getIsHomepage() && $pageItem->targetIs() != 'plugin'){ ?><a class="button alert" href="index.php?p=page&amp;action=del&amp;id=<?php echo $pageItem->getId(). '&amp;token=' .administrator::getToken(); ?>" onclick = "if(!confirm('<?php echo $core->lang("Delete this page ?"); ?>')) return false;"><?php echo $core->lang("Delete"); ?></a><?php } ?>	
		</td>
	</tr>
	<?php foreach($page->getItems() as $k=>$pageItemChild) if($pageItemChild->getParent() == $pageItem->getId() && ($pageItemChild->targetIs() != 'plugin' || ($pageItemChild->targetIs() == 'plugin' && $pluginsManager->isActivePlugin($pageItemChild->getTarget())))){ ?>
	<tr>
		<td><?php if($pageItemChild->getIsHomepage()){ ?><img title="<?php echo $core->lang("Homepage"); ?>" src="<?php echo PLUGINS; ?>page/other/house.png" alt="icon" /><?php } ?> 
			<?php if($pageItemChild->getIsHidden()){ ?><img title="<?php echo $core->lang("Does not appear in the menu"); ?>" src="<?php echo PLUGINS; ?>page/other/ghost.png" alt="icon" /><?php } ?>
			<?php if($pageItemChild->targetIs() == 'url'){ ?><img title="<?php echo $core->lang("Target : URL"); ?>" src="<?php echo PLUGINS; ?>page/other/link.png" alt="icon" /><?php } ?>
			<?php if($pageItemChild->targetIs() == 'plugin'){ ?><img title="<?php echo $core->lang("Target : plugin"); ?>" src="<?php echo PLUGINS; ?>page/other/plugin.png" alt="icon" /><?php } ?>
			<?php if($pageItemChild->targetIs() == 'parent'){ ?><img title="<?php echo $core->lang("Parent item"); ?>" src="<?php echo PLUGINS; ?>page/other/star.png" alt="icon" /><?php } ?>
		</td>
		<td>▸ <?php echo $pageItemChild->getName(); ?></td>
		<td><input readonly="readonly" type="text" value="<?php echo $page->makeUrl($pageItemChild); ?>" /></td>
		<td>
		  <a class="up" href="index.php?p=page&action=up&id=<?php echo $pageItemChild->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="<?php echo PLUGINS; ?>page/other/up.png" alt="icon" /></a>&nbsp;&nbsp;
		  <a class="down" href="index.php?p=page&action=down&id=<?php echo $pageItemChild->getId(); ?>&token=<?php echo administrator::getToken(); ?>"><img src="<?php echo PLUGINS; ?>page/other/down.png" alt="icon" /></a>
		</td>
		<td>
		  <a class="button" href="index.php?p=page&amp;action=edit&amp;id=<?php echo $pageItemChild->getId(); ?>"><?php echo $core->lang("Edit"); ?></a> 
		  <?php if(!$pageItemChild->getIsHomepage() && $pageItemChild->targetIs() != 'plugin'){ ?><a class="button alert" href="index.php?p=page&amp;action=del&amp;id=<?php echo $pageItemChild->getId(). '&amp;token=' .administrator::getToken(); ?>" onclick = "if(!confirm('<?php echo $core->lang("Delete this page ?"); ?>')) return false;"><?php echo $core->lang("Delete"); ?></a><?php } ?>	
		</td>
	</tr>
	<?php } } ?>
  </tbody>
</table>
<?php } ?>

<?php if($mode == 'edit' && !$isLink && !$isParent && $pageItem->targetIs() != 'plugin'){ ?>
<form method="post" action="index.php?p=page&amp;action=save">
  <?php show::adminTokenField(); ?>
  <input type="hidden" name="id" value="<?php echo $pageItem->getId(); ?>" />
  <input type="hidden" name="position" value="<?php echo $pageItem->getPosition(); ?>" />
  
  <p>
      <label><?php echo $core->lang("Parent item"); ?></label><br>
	  <select name="parent">
	  <option value=""><?php echo $core->lang("None"); ?></option>
	  <?php foreach($page->getItems() as $k=>$v) if($v->targetIs() == 'parent'){ ?>
	  <option <?php if($v->getId() == $pageItem->getParent()){ ?>selected<?php } ?> value="<?php echo $v->getId(); ?>"><?php echo $v->getName(); ?></option>
	  <?php } ?>
	  </select>
  </p>
  <p>
      <label><?php echo $core->lang("Name"); ?></label><br>
      <input type="text" name="name" value="<?php echo $pageItem->getName(); ?>" required="required" />
  </p>
  <p>
      <label><?php echo $core->lang("Page title (optional)"); ?></label><br>
      <input type="text" name="mainTitle" value="<?php echo $pageItem->getMainTitle(); ?>" />
  </p>
  <p>
      <label><?php echo $core->lang("Meta title tag (optional)"); ?></label>
      <input type="text" name="metaTitleTag" value="<?php echo $pageItem->getMetaTitleTag(); ?>" />
  </p>
  <p>
      <label><?php echo $core->lang("Meta description tag (optional)"); ?></label>
      <input type="text" name="metaDescriptionTag" value="<?php echo $pageItem->getMetaDescriptionTag(); ?>" />
  </p>
  <p>
      <label><?php echo $core->lang('Include a .php file in your theme instead of the content'); ?></label>
	  <select name="file" class="large-3 columns">
		  <option value="">--</option>
		  <?php foreach($page->listTemplates() as $file){ ?>
		  <option <?php if($file == $pageItem->getFile()){ ?>selected<?php } ?> value="<?php echo $file; ?>"><?php echo $file; ?></option>
		  <?php } ?>
	  </select>
  </p>
  <p>
      <input <?php if($pageItem->getIsHomepage()){ ?>checked<?php } ?> type="checkbox" name="isHomepage" /> <?php echo $core->lang("Use as homepage"); ?>
	  <br>
      <input <?php if($pageItem->getIsHidden()){ ?>checked<?php } ?> type="checkbox" name="isHidden" /> <?php echo $core->lang("Don't display in the menu"); ?>
	  <br>
      <input <?php if($pageItem->getNoIndex()){ ?>checked<?php } ?> type="checkbox" name="noIndex" /> <?php echo $core->lang("Prevent indexing by search engines"); ?>
  </p>
  <p>
      <label><?php echo $core->lang("Content"); ?></label>
      <?php show::adminEditor('content', $pageItem->getContent()); ?>
  </p>
  <p>
	<button type="submit" class="button success radius"><?php echo $core->lang("Save"); ?></button>
  </p>
</form>
<?php } ?>

<?php if($mode == 'edit' && ($isLink || $pageItem->targetIs() == 'plugin')){ ?>
<form method="post" action="index.php?p=page&amp;action=save">
  <?php show::adminTokenField(); ?>
  <input type="hidden" name="id" value="<?php echo $pageItem->getId(); ?>" />
  <input type="hidden" name="position" value="<?php echo $pageItem->getPosition(); ?>" />
  
  <p>
      <label><?php echo $core->lang("Parent item"); ?></label><br>
	  <select name="parent">
	  <option value=""><?php echo $core->lang("None"); ?></option>
	  <?php foreach($page->getItems() as $k=>$v) if($v->targetIs() == 'parent'){ ?>
	  <option <?php if($v->getId() == $pageItem->getParent()){ ?>selected<?php } ?> value="<?php echo $v->getId(); ?>"><?php echo $v->getName(); ?></option>
	  <?php } ?>
	  </select>
  </p>
  <p>
      <label><?php echo $core->lang("Name"); ?></label><br>
      <input type="text" name="name" value="<?php echo $pageItem->getName(); ?>" required="required" />
  </p>
  <?php if($pageItem->targetIs() == 'plugin'){ ?>
  <p>
      <label><?php echo $core->lang("Target"); ?> : <?php echo $pageItem->getTarget(); ?></label>
      <input style="display:none;" type="text" name="target" value="<?php echo $pageItem->getTarget(); ?>" />
  </p>
  <?php } else{ ?>
  <p>
      <label><?php echo $core->lang("Target"); ?></label><br>
      <input placeholder="http://www.google.com" <?php if($pageItem->targetIs() == 'plugin'){ ?>readonly<?php } ?> type="url" name="target" value="<?php echo $pageItem->getTarget(); ?>" required="required" />
  </p>
  <?php } ?>
  <p>
      <label><?php echo $core->lang("Open"); ?></label><br>
	  <select name="targetAttr">
		<option value="_self" <?php if($pageItem->getTargetAttr() == '_self'){ ?>selected<?php } ?>><?php echo $core->lang("Same window"); ?></option>
		<option value="_blank" <?php if($pageItem->getTargetAttr() == '_blank'){ ?>selected<?php } ?>><?php echo $core->lang("New window"); ?></option>
	  </select>
  </p>
  <p>
      <input <?php if($pageItem->getIsHidden()){ ?>checked<?php } ?> type="checkbox" name="isHidden" /> <label for="isHidden"><?php echo $core->lang("Don't display in the menu"); ?></label>
  </p>
  <p>
	<button type="submit" class="button success radius"><?php echo $core->lang("Save"); ?></button>
  </p>
</form>
<?php } ?>

<?php if($mode == 'edit' && $isParent){ ?>
<form method="post" action="index.php?p=page&amp;action=save">
  <?php show::adminTokenField(); ?>
  <input type="hidden" name="id" value="<?php echo $pageItem->getId(); ?>" />
  <input type="hidden" name="position" value="<?php echo $pageItem->getPosition(); ?>" />
  <input type="hidden" name="target" value="javascript:" />
  
  <p>
      <label><?php echo $core->lang("Name"); ?></label><br>
      <input type="text" name="name" value="<?php echo $pageItem->getName(); ?>" required="required" />
  </p>
  <p>
      <input <?php if($pageItem->getIsHidden()){ ?>checked<?php } ?> type="checkbox" name="isHidden" /> <label for="isHidden"><?php echo $core->lang("Don't display in the menu"); ?></label>
  </p>
  <p>
	<button type="submit" class="button success radius"><?php echo $core->lang("Save"); ?></button>
  </p>
</form>
<?php } ?>

<?php include_once(ROOT.'admin/footer.php'); ?>