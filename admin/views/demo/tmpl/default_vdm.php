<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			26th February, 2016
	@created		5th August, 2015
	@package		Demo
	@subpackage		default_vdm.php
	@author			Llewellyn van der Merwe <https://www.vdm.io/>	
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
  ____  _____  _____  __  __  __      __       ___  _____  __  __  ____  _____  _  _  ____  _  _  ____ 
 (_  _)(  _  )(  _  )(  \/  )(  )    /__\     / __)(  _  )(  \/  )(  _ \(  _  )( \( )( ___)( \( )(_  _)
.-_)(   )(_)(  )(_)(  )    (  )(__  /(__)\   ( (__  )(_)(  )    (  )___/ )(_)(  )  (  )__)  )  (   )(  
\____) (_____)(_____)(_/\/\_)(____)(__)(__)   \___)(_____)(_/\/\_)(__)  (_____)(_)\_)(____)(_)\_) (__) 

/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$manifest = DemoHelper::manifest();
JHtml::_('bootstrap.loadCss');

?>
<img alt="<?php echo JText::_('COM_DEMO'); ?>" src="components/com_demo/assets/images/component-300.jpg">
<ul class="list-striped">
<li><b><?php echo JText::_('COM_DEMO_VERSION'); ?>:</b> <?php echo $manifest->version; ?></li>
<li><b><?php echo JText::_('COM_DEMO_DATE'); ?>:</b> <?php echo $manifest->creationDate; ?></li>
<li><b><?php echo JText::_('COM_DEMO_AUTHOR'); ?>:</b> <a href="mailto:<?php echo $manifest->authorEmail; ?>"><?php echo $manifest->author; ?></a></li>
<li><b><?php echo JText::_('COM_DEMO_WEBSITE'); ?>:</b> <a href="<?php echo $manifest->authorUrl; ?>" target="_blank"><?php echo $manifest->authorUrl; ?></a></li>
<li><b><?php echo JText::_('COM_DEMO_LICENSE'); ?>:</b> <?php echo $manifest->license; ?></li>
<li><b><?php echo $manifest->copyright; ?></b></li>
</ul>
<div class="clearfix"></div>
<?php if(DemoHelper::checkArray($this->contributors)): ?>
<?php if(count($this->contributors) > 1): ?>
<h3><?php echo JText::_('COM_DEMO_CONTRIBUTORS'); ?></h3>
<?php else: ?>
<h3><?php echo JText::_('COM_DEMO_CONTRIBUTOR'); ?></h3>
<?php endif; ?>
<ul class="list-striped">
	<?php foreach($this->contributors as $contributor): ?>
    <li><b><?php echo $contributor['title']; ?>:</b> <?php echo $contributor['name']; ?></li>
    <?php endforeach; ?>
</ul>
<div class="clearfix"></div>
<?php endif; ?>