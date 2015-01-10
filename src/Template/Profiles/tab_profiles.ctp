<div id="UserProfile" class="ui-panel-framed">
    <header class="panel-header bg-3d">
        <div class="header-caption">مشخصات شما</div>
    </header>    
    <section class="panel-body padding-none">
        <div id="ProfileTab" class="ui-tab typ-top border-none">
            <ul class="tab-nav">
                <li data-tab="#tab1"><?= $this->Html->link('شخصی', ['action' => 'personal', 'section' => 'clients']) ?></li>
                <li data-tab="#tab2" ><?= $this->Html->link('رمز عبور',['action' => 'password', 'section' => 'clients'])?></li>
                <li data-tab="#tab2" ><?= $this->Html->link('فعال سازی',['action' => 'confirmList', 'section' => 'clients'])?></li>
                <li data-tab="#tab4"><?= $this->Html->link('تصویر نمایه',['action' => 'confirmList', 'section' => 'clients'],['onDisabled' => true])?></li>
            </ul>
        <div class="tab-container">
            
                <?= $this->fetch('content'); ?>
            			
        </div>
        </div>
    </section>
</div>