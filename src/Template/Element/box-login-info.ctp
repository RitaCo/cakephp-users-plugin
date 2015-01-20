<div id="loginIn-box">
    <div class="avator-block"><?= $this->Html->image('avator1.png'); ?></div>
    <div class="info-block">
        <span><?= $this->Session->read('Auth.User.first_name'); ?></span>
    </div>
    <div class="logout-block">
        
        <?= $this->Html->linkIcon('','icon-off','/logout'); ?>
    </div>
</div>