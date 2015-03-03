<div id="loginIn-box">
    <div class="avator-block"><?= $this->Html->image($this->Session->read('Auth.User.avator')); ?></div>
    <div class="info-block">
        <span><?= $this->Session->read('Auth.User.profile.full_name'); ?></span>
    </div>
    <div class="logout-block">
        
        <?= $this->Html->linkIcon('','icon-off','/logout'); ?>
    </div>
</div>