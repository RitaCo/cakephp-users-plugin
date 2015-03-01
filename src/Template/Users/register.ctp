<?php

$this->layout = 'login';
 $this->assign('title','تبت کاربر جدید');

?>

<div class="com-gridTable ">

    <div class=" " >
            <section id="login-box" class="ui-panel-framed">
                <div class="panel-header bg-flat">
                    <span class="header-caption">فرم ثبت کاربر جدید</span>
                </div>
                <div class="panel-body padding-none">
                    <?= $this->Form->create($User); ?>
                    <div class="body-container padding-none ">

				<?= $this->Form->input('email', ['label' => 'ایمیل', 'dir' => 'ltr' ]); ?>
				<?= $this->Form->input('user_password', ['type' => 'password','label' => 'رمزعبور', 'dir' => 'ltr' ]); ?>
				<?= $this->Form->input('confirm_password', ['type' => 'password','label' => 'تکرار رمزعبور', 'dir' => 'ltr' ]); ?>

                    
                    </div>
            
            		<div class="body-footer">
                <?= $this->Form->submit('ایجاد شود'); ?>
            		</div>
                <?= $this->Form->end() ?>
                    </div>
            </section>
        </div> 
        
</div>
