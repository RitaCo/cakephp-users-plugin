<?php

$this->extend('TabProfiles');

?>

<div class="tab-body active padding-none" id="<?= $this->request->param('action'); ?>">
    <?= $this->Form->create($user); ?>
		<div class="body-container padding-none">
                <?= $this->Form->input('old_password', ['type' => 'password','label' => 'رمزعبور فعلی', 'dir' => 'ltr' ]); ?>
        <?= $this->Form->input('user_password', ['type' => 'password','label' => 'رمزعبور جدید', 'dir' => 'ltr' ]); ?>
				<?= $this->Form->input('confirm_password', ['type' => 'password','label' => 'تکرار رمزعبور جدید', 'dir' => 'ltr' ]); ?>

       	
		
		</div>    
		<div class="body-footer">
    <?= $this->Form->submit('ایجاد'); ?>
		</div>
    <?= $this->Form->end() ?>
