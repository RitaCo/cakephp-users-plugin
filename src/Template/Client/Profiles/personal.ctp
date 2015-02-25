<?php

$this->extend('TabProfiles');

?>
<div class="tab-body active padding-none" id="<?= $this->request->param('action'); ?>">
    <?= $this->Form->create($Profile); ?>
		<div class="body-container ">
            <div class="group-inputs">
				<?= $this->Form->input('first_name', ['label' => 'نام' ]); ?>
                <?= $this->Form->input('id'); ?>    
				<?= $this->Form->input('last_name', ['label' => 'نام خانوادگی' ]); ?>
                   
    
       
				<?= $this->Form->input('sex', [
                    'label' => 'جنسیت',
                    'options' => ['male' => 'مرد', 'female' => 'زن'],
                    'empty' => '[انتخاب کنید]',
                ]); ?>
               
                
              

            </div>
             <div class="group-inputs">
              <?= $this->Form->input('brith', ['label' => 'تاریخ تولد' ]); ?>
               <?= $this->Form->input('phone', ['label' => 'تلفن ثابت' ]); ?>                       	
                <?= $this->Form->input('websiteUrl', ['label' => 'وبسایت شخصی', 'empty' => 'http://', 'dir' => 'ltr' ]); ?>       	
                <?= $this->Form->input('twitterUrl', ['label' => 'توییتر', 'empty' => 'http://', 'dir' => 'ltr'  ]); ?>       	
                <?= $this->Form->input('facebookUrl', ['label' => 'فیسبوک', 'empty' => 'http://' , 'dir' => 'ltr' ]); ?>       	
            </div>                       	
		
		</div>    
		<div class="body-footer">
    <?= $this->Form->submit('ذخیره'); ?>
		</div>
    <?= $this->Form->end();?>
