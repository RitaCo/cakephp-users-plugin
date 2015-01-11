<?php

$this->extend('TabProfiles');

?>
<div class="tab-body active padding-none" id="<?= $this->request->param('action'); ?>">
    <?= $this->Form->create($user); ?>
		<div class="body-container padding-none">
				<?= $this->Form->input('first_name', ['label' => 'نام' ]); ?>
				<?= $this->Form->input('last_name', ['label' => 'نام خانوادگی' ]); ?>
				<?= $this->Form->input('profile.sex', [
                    'label' => 'جنسیت',
                    'options' => [0 => 'مرد', 1 => 'زن', 2 => 'همجنسگرا'],
                    'empty' => '[انتخاب کنید]',
                ]); ?>
                <?= $this->Form->input('profile.brith', ['label' => 'تاریخ تولد' ]); ?>       	
                <?= $this->Form->input('profile.websiteUrl', ['label' => 'وبسایت شخصی', 'value' => 'http://', 'dir' => 'ltr' ]); ?>       	
                <?= $this->Form->input('profile.twitterUrl', ['label' => 'توییتر', 'value' => 'http://', 'dir' => 'ltr'  ]); ?>       	
                <?= $this->Form->input('profile.facebookUrl', ['label' => 'فیسبوک', 'value' => 'http://' , 'dir' => 'ltr' ]); ?>       	
                       	
		
		</div>    
		<div class="body-footer">
    <?= $this->Form->submit('ذخیره'); ?>
		</div>
    <?= $this->Form->end()
