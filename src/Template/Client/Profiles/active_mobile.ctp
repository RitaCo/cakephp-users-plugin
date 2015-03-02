<?php

$this->extend('TabProfiles');
$this->assign('title','پروفایل > تایید شماره موبایل');
?>

<div class="tab-body active " id="<?= $this->request->param('action'); ?>">

<div class="ui-box">    
    <div class="box-caption">شماره فعلی و تایید شده</div>
    <div class="box-body">
      <i class="icon-phonealt"></i> 
      <div style="display: inline-block; margin-right: 10px; font-size: 20px;">  <?= (empty($Profile['mobile']))? 'شماره ایی ثبت نشده است.': p($Profile['mobile']); ?></div>
      
    </div>

</div>
<?php if(!$this->Session->check('sms')): ?>
<div class="ui-box">    
    <div class="box-caption">معرفی شماره موبایل .</div>
    <div class="box-body padding-none">
        <?= $this->Form->create($Profile); ?>
        <div class="body-container padding-none">

        <?= $this->Form->input('mobile', ['label' => 'شماره جدید', 'dir' => 'ltr']); ?>
       
       
       </div>
       <div class="body-footer">
       <?= $this->Form->submit('ثبت گردد'); ?>
       </div>
       <?= $this->Form->end(); ?>
    </div>
</div>
<?php else: ?>
<div class="ui-box">    
    <div class="box-caption">فرم فعال سازی.</div>
    <div class="box-body padding-none">
        <?= $this->Form->create(); ?>
        <div class="body-container padding-none">

        <?= $this->Form->input('active', ['label' => 'عدد فعال سازی', 'dir' => 'ltr']); ?>
       
       
       </div>
       <div class="body-footer">
       <?= $this->Form->submit('ثبت گردد'); ?>
       </div>
       <?= $this->Form->end(); ?>
    </div>
</div>

<?php endif ?>
</div>
