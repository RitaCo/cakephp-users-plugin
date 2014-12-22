<?php

$this->layout = 'login';


?>


<section id="login-box" class="ui-panel-framed">
    <div class="panel-header bg-flat">
        <span class="header-caption">ورود به سیستم.</span>
    </div>
    <div class="panel-body padding-none">
    	<?= $this->Form->create(); ?>
        <div class="body-container padding-none ">
            	<?= $this->Form->input('email',['label' => 'ایمیل', 'dir' => 'ltr' ]); ?>
				<?= $this->Form->input('password',['label' => 'رمزعبور' ,'dir'=>'ltr']); ?>
        
        </div>

		<div class="body-footer">
			<?= $this->Form->submit('ایجاد'); ?>
		</div>
		<?= $this->Form->end() ?>
        </div>
</section>