<?php

use \Cake\Routing\Router;

   $this->assign('title', 'مدیریت / کاربران');
   $this->assign('note', 'فهرست تمامی کاربران عضو در سیستم');
?>


<div class="ui-panel-framed ">
	<div class="panel-header bg-flat">
		<div class="header-caption">فهرست</div>
	</div>
	<div class="panel-body padding-none ">
		<div class="body-header padding-none">
			<div class="ui-toolbar">
				<div class="toolbar-band ">
					<a class="btn" href="<?= Router::url(['action' => 'add'])?>">	
						<i class="  icon-createfolder"></i>
						<span>جدید</span>
					</a>
					
				</div>
			</div>
		</div>
		<div class="body-splitter"></div>
		<div class="body-container padding-none">
            <div class="ui-dataGrid">
                <table >
                    <thead class="">
                        <?php
                        
                        echo $this->Html->tableHeaders([
                        'نام و نام خانوادگی',
                        'ایمیل' ,
                        ['نقش' => ['width' => '100px']],
                        ['وضعیت' => ['width' => '100px']],
                        ['آگهی ها' => ['width' => '140px']],
                        ['عملیات' => ['width' => '100px']],
                        
                        ]);
                        
                        ?>
                    </thead>
                    <tbody class="">
                        <?php
                        foreach ($users as $user) {
                            echo $this->Html->tableCells([
                            p($user->first_name.' '.$user->last_name),
                            $user->email,
                            $user->role->name,
                            ($user->status)? "فعال" : "غیر فعال",
                            p($user->notices_count).' عدد ',
                            $this->Html->link('پروفایل', ['action' => 'view',$user->id], ['class' => 'btn btn-main'])
                            ]);
                        }

?>
                    </tbody>
                </table>
            </div>
		
		
		</div>
	</div>
</div>

