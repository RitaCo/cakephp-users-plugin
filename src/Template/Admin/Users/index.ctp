<?php

use \Cake\Routing\Router;

   $this->assign('title', 'مدیریت / کاربران');
   $this->assign('note', 'فهرست تمامی کاربران عضو در سیستم');
?>



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
                            <div class="role"><?= $user->role->name; ?></div>
                            <div><i class="icon-user"></i></div>
                            <div><i class="icon-user"></i></div>
                        
                        </div>
                        
                        <div class="actions">
                            <div class="btn-group">
                                <?= $this->Html->link('پروفایل',['action' => 'index','controller' => 'Profiles',$user->id],['class' => 'btn btn-red btn-flat']); ?>
                            </div>
                        
                        </div>
                        
                </div>
            </div>
        </div>

<?php endforeach; ?>

    
</section> 
