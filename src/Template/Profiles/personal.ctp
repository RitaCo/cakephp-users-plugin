<?php

$this->extend('TabProfiles');

?>
<div class="tab-body active padding-none" id="<?= $this->request->param('action'); ?>">
	<?= $this->Form->create($user); ?>
		<div class="body-container padding-none">
				<?= $this->Form->input('first_name',['label' => 'نام' ]); ?>
				<?= $this->Form->input('last_name',['label' => 'نام خانوادگی' ]); ?>
       	
		
		</div>    
		<div class="body-footer">
			<?= $this->Form->submit('ایجاد'); ?>
		</div>
	<?= $this->Form->end() ?>
        