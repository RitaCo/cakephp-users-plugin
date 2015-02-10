<?php

$this->assign('title','مدیریت / سرویس کاربران و اعضا');
$this->assign('note','در این بخش شما میتوانید به تمامی بخش‌های زیر سیستم مدیریت کاربران دسترسی داشته باشید.');

?>



<div id="ActionInDashBoard">

    <?= $this->Html->linkIcon('اعضا','  fa fa-users',['controller' => 'users']); ?>
    <?= $this->Html->linkIcon('نقش‌ها','  icon-list-alt',['controller' => 'roles']); ?>
    <?= $this->Html->linkIcon('تنظیمات','  icon-list-alt',['controller' => 'settings']); ?>

</div>


<div class="com-layout-columns col2">
    <div class="layout-cell">
        <div class="ui-box">
            <div class="box-caption">گزارش سریع</div>
            
            <div class="box-body">
            
               گزارشی ارايه نشده است
            </div>
        </div>
    
    </div>
    <div class="layout-cell">
        <div class="ui-box">
            <div class="box-caption">آمار و ارقام</div>
            
            <div class="box-body">
            
            گزارشی ارايه نشده است
            </div>
        </div>
    </div>

</div>