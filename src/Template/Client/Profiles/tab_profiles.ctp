<div id="UserProfile" class="ui-panel-framed">
    <header class="panel-header bg-3d">
        <div class="header-caption">مشخصات شما</div>
    </header>    
    <section class="panel-body padding-none">
        <div id="ProfileTab" class="ui-tab typ-right border-none">
            <ul class="tab-nav">
                <li data-tab="#tab1"><?= $this->Html->link('شخصی', ['action' => 'personal']) ?></li>
                <li data-tab="#tab2" ><?= $this->Html->link('رمز عبور', ['action' => 'password'])?></li>
                <li data-tab="#tab2" ><?= $this->Html->link('فعال سازی', ['action' => 'confirmList'])?></li>
                <li data-tab="#tab4"><?= $this->Html->link('تصویر نمایه', ['action' => 'confirmList'], ['onDisabled' => true])?></li>
            </ul>
        <div class="tab-container  " style="margin: 8px;">
            
                <?= $this->fetch('content'); ?>
            			
        </div>
        </div>
    </section>
</div>