<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.3
	@build			8th February, 2021
	@created		18th October, 2016
	@package		Demo
	@subpackage		default.php
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


?>
<div class="uk-clearfix"><div class="uk-float-right"><?php echo $this->toolbar->render(); ?></div></div>
<article class="uk-comment">
    <header class="uk-comment-header">
        <img class="uk-comment-avatar" src="{imageurl}" alt="">
        <h4 class="uk-comment-title"><?php echo $this->escape($this->item->name); ?></h4>
        <div class="uk-comment-meta"><?php echo JText::_('COM_DEMO_HITS'); ?>: <?php echo $this->item->hits; ?></div>
    </header>
    <div class="uk-comment-body">
        <?php echo $this->item->description; ?>
        <?php if ($this->item->add): ?>
            <br />
            <!-- This is a button toggling the modal -->
            <button class="uk-button" data-uk-modal="{target:'#more-details-090'}"><?php echo JText::_('COM_DEMO_MORE_DETAILS'); ?></button>
        <?php endif; ?>
    </div>
</article>
<?php if ($this->item->add): ?>
<!-- This is the modal -->
<div id="more-details-090" class="uk-modal">
    <div class="uk-modal-dialog">
        <a class="uk-modal-close uk-close"></a>
        <dl class="uk-description-list-horizontal">
        <?php if (DemoHelper::checkString($this->item->dateofbirth)): ?>
            <dt><?php echo JText::_('COM_DEMO_BIRTH_DAY'); ?></dt><dd><?php echo DemoHelper::fancyDate($this->escape($this->item->dateofbirth)); ?></dd>
        <?php endif; ?>
        <?php if (DemoHelper::checkString($this->item->email)): ?>
            <dt><?php echo JText::_('COM_DEMO_EMAIL'); ?></dt><dd><?php echo $this->escape($this->item->email); ?></dd>
        <?php endif; ?>
        <?php if (DemoHelper::checkString($this->item->mobile_phone)): ?>
            <dt><?php echo JText::_('COM_DEMO_MOBILE'); ?></dt><dd><?php echo $this->escape($this->item->mobile_phone); ?></dd>
        <?php endif; ?>
        <?php if (DemoHelper::checkString($this->item->website)): ?>
            <dt><?php echo JText::_('COM_DEMO_WEBSITE'); ?></dt><dd><?php echo $this->escape($this->item->website); ?></dd>
        <?php endif; ?>
        </dl>
    </div>
</div>
<?php endif; ?>
