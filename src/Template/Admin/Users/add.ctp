<?php

use \Cake\Routing\Router;

   $this->assign('title', 'مدیریت / ایجاد کاربر');
   $this->assign('note', 'شما می‌توانید یک کاربر جدید ایجاد نمایید.');
?>

<div class="ui-panel-framed ">
	<div class="panel-header bg-flat">
		<div class="header-caption">فهرست</div>
	</div>
	<div class="panel-body padding-none ">
    <?= $this->Form->create($user); ?>
		<div class="body-header padding-none">
			<div class="ui-toolbar">
				<div class="toolbar-band ">
					<a class="btn" href="<?= Router::url(['action' => 'index'])?>">	
						<i class=" icon-pageforward"></i>
						<span>بازگشت</span>
					</a>
					
				</div>
			</div>
		</div>
		<div class="body-splitter"></div>
		<div class="body-container padding-none">

                <?= $this->Form->input('role_id', ['label' => 'نقش کاربر', 'empty' => 'انتخاب کنید.' ]); ?>
				<?= $this->Form->input('email', ['label' => 'ایمیل', 'dir' => 'ltr' ]); ?>
				<?= $this->Form->input('password', ['label' => 'رمزعبور', 'dir' => 'ltr' ]); ?>
				<?= $this->Form->input('first_name', ['label' => 'نام' ]); ?>
				<?= $this->Form->input('last_name', ['label' => 'نام خانوادگی' ]); ?>


		
		
		
		</div>
		<div class="body-footer">
    <?= $this->Form->submit('ایجاد'); ?>
		</div>
    <?= $this->Form->end() ?>
	</div>
</div>
