<?php

$this->layout = 'login';
 $this->assign('title','ورود به پنل کاربری');

?>

<div class="com-gridTable ">
         <div class="">
            <a href="/register" id="register-message" class="ui-panel">
                <div class="panel-body text-center ">
                        <h4>اگر شما هنوز عضو نشده‌اید؟</h4>
                        <p >کلیک کنید</p>
                </div>
            </a>
            
        </div> 
    <div class=" " >
            <section id="login-box" class="ui-panel-framed">
                <div class="panel-header bg-flat">
                    <span class="header-caption">ورود کاربران</span>
                </div>
                <div class="panel-body padding-none">
                    <?= $this->Form->create(); ?>
                    <div class="body-container padding-none ">
                            <?= $this->Form->input('email', ['label' => 'ایمیل', 'dir' => 'ltr' ]); ?>
            				<?= $this->Form->input('password', ['label' => 'رمزعبور' ,'dir'=>'ltr']); ?>
                    
                    </div>
            
            		<div class="body-footer">
                <?= $this->Form->submit('ورود'); ?>
            		</div>
                <?= $this->Form->end() ?>
                    </div>
            </section>
        </div> 
        
</div>
