<?php

	TBGContext::loadLibrary('ui');

?>
<div class="logindiv">

<h1><?php echo __('Welcome to'); ?> <?php echo(TBGSettings::getTBGname()); ?></h1>
	<?php echo __('Please fill in your username and password below, and press "Continue" to log in.'); ?>
	<br>
	<?php if (TBGSettings::get('allowreg') == true): ?> 
		<?php echo __('If you have not already registered, please use the "Register new account" link.'); ?>
	<?php else: ?>
		<?php echo __('It is not possible to register new accounts. To register a new account, please contact the administrator.'); ?>
	<?php endif; ?>
	<br><br>
</div>
<script>

	<?php
	 
		$params = array('key' => 'login', 'mandatory' => true);
		
		if(TBGEvent::isAnyoneListening('core', 'login_page_script'))
		{
			$event = TBGEvent::createNew('core', 'login_page_script');
			$event->triggerUntilProcessed();

			$options = ($event->isProcessed()) ? $event->getReturnValue() : null;
			
			if (is_array($options))
			{
				foreach ($options as $key_opt => $option)
				{
					if (isset($$option))
					{
						$params = array_merge($params, array($key_opt => $$option));
					}
				}	
			}
		}
	?>
	
	showFadedBackdrop('<?php echo make_url('get_partial_for_backdrop', $params); ?>');
</script>