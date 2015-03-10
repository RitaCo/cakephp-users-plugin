<?php

$this->extend('TabProfiles');
 $this->assign('title','پروفایل > مشخصات شخصی');
?>
<div class="tab-body active padding-none" id="<?= $this->request->param('action'); ?>">
    <?= $this->Form->create($user); ?>
		<div class="body-container ">
            <div class="group-inputs">
				<?= $this->Form->input('profile.first_name', ['label' => 'نام' ]); ?>
                <?= $this->Form->input('id'); ?>    
				<?= $this->Form->input('profile.last_name', ['label' => 'نام خانوادگی' ]); ?>
                   
    
       
				<?= $this->Form->input('role_id', [
                    'label' => 'نقش کاربر',
                     'options' => $roles,
                    
                    'empty' => '[انتخاب کنید]',
                ]); ?>
			     <?= $this->Form->input('profile.sex', [
                    'label' => 'جنسیت',
                    'options' => ['male' => 'مرد', 'female' => 'زن'],
                    'empty' => '[انتخاب کنید]',
                ]); ?>               
                
              

            </div>
             <div class="group-inputs">
              <?= $this->Form->input('profile.brith', ['label' => 'تاریخ تولد' ]); ?>
               <?= $this->Form->input('profile.phone', ['label' => 'تلفن ثابت' ]); ?>                       	
                <?= $this->Form->input('profile.websiteUrl', ['label' => 'وبسایت شخصی', 'empty' => 'http://', 'dir' => 'ltr' ]); ?>       	
                <?= $this->Form->input('profile.twitterUrl', ['label' => 'توییتر', 'empty' => 'http://', 'dir' => 'ltr'  ]); ?>       	
                <?= $this->Form->input('profile.facebookUrl', ['label' => 'فیسبوک', 'empty' => 'http://' , 'dir' => 'ltr' ]); ?>       	
            </div>                       	
		
		</div>    
		<div class="body-footer">
    <a class="btn" href="<?= $this->Url->build(['controller' => 'users', 'action' => 'index'])?>">	
						<i class="  icon-pageforward"></i>
						<span>بازگشت</span>
					</a>

    <?= $this->Form->submit('ذخیره'); ?>
		</div>
    <?= $this->Form->end();?>
