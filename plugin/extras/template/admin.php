<?php
defined('ROOT') OR exit('No direct script access allowed');
include_once(ROOT.'admin/header.php');
?>

<form method="post" action="index.php?p=extras&action=save">
  <?php show::adminTokenField(); ?>
  
  <p>
      <label><?php echo $core->lang("Breakpoint for displaying the mobile menu"); ?> (px)</label><br>
      <input placeholder="768" type="number" name="breakpointMenu" value="<?php echo $runPlugin->getConfigVal('breakpointMenu'); ?>" />
  </p>
	
	<p>
      <button type="submit" class="button"><?php echo $core->lang("Save"); ?></button>
  </p>
</form>

<?php include_once(ROOT.'admin/footer.php'); ?>