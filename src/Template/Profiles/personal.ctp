<?php

$this->extend('TabProfiles');

?>
	<?= $this->Form->create($user); ?>
		<div class="body-container padding-none">
				<?= $this->Form->input('first_name',['label' => 'نام' ]); ?>
				<?= $this->Form->input('last_name',['label' => 'نام خانوادگی' ]); ?>
                
				<?= $this->Form->input('email',['label' => 'ایمیل', 'dir' => 'ltr' ]); ?>


		
		
		
		</div>    
		<div class="body-footer">
			<?= $this->Form->submit('ایجاد'); ?>
		</div>
	<?= $this->Form->end() ?>        