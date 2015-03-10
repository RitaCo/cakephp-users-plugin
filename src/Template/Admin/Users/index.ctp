<?php

use \Cake\Routing\Router;

   $this->assign('title', 'مدیریت / کاربران');
   $this->assign('note', 'فهرست تمامی کاربران عضو در سیستم');
?>

<?= $this->element('Rita/Core.pagintor'); ?>

<section id="UsersListSection" class="com-layout-columns col3">
<?php  foreach ($users as $user) : ?>
        <div class="layout-cell">
            <div class="UserBlock" >
                <div class="header">
                    <div class="avator">
                       <?= $this->Html->image($user->avator.'?size=128'); ?> 
                    </div>
                </div>
                <div class="body">
                        <div class="detils">
                            <h3><?= $user->Profile->full_name; ?></h3>
                            <h4><?= $user->email; ?></h4>
                        </div>
                        
                        <div class="status">
                            <div class="row">
                                <div class="item" >نقش</div>
                                <div class="value"><?= $user->role->name; ?></div>
                            </div>
                            <div class="row">
                                <div class="item" >وضعیت</div>
                                <div class="value"><?= $user->getStatus(); ?></div>
                            </div>
                            <div class="row">
                                <div class="item" >عضویت</div>
                                <div class="value"><?= (new \Rita\Tools\I18n\Time($user->created))->i18nFormat("dd/MMMM/YYYY hh:mm",'Asia/Tehran','fa-IR@calendar=persian'); ?></div>
                            </div>
                            <div class="row">
                                <div class="item" >آخرین تغییرات</div>
                                <div class="value"><?= (new \Rita\Tools\I18n\Time($user->modified))->i18nFormat("dd/MMMM/YYYY hh:mm",'Asia/Tehran','fa-IR@calendar=persian'); ?></div>
                            </div>                            
                            <div class="row">
                                <div class="item" >آخرین فعالیت</div>
                                <div class="value">در دسترس نمی‌باشد</div>
                            </div>                            
                        </div>
                        
                        <div class="actions">
                            <div class="btn-group">
                                <?= $this->Html->link('مشخصات',['action' => 'index','controller' => 'Profiles',$user->id],['class' => 'btn btn-action btn-flat']); ?>
                                <?= $this->Html->link('دخل و خرج',['action' => 'index','controller' => 'Profiles',$user->id],['class' => 'btn btn-action btn-flat']); ?>
                                <?= $this->Html->link('عملیات سیستمی',['action' => 'index','controller' => 'Profiles',$user->id],['class' => 'btn btn-action btn-flat']); ?>
                            </div>
                        
                        </div>
                        
                </div>
            </div>
        </div>

<?php endforeach; ?>

    
</section> 
