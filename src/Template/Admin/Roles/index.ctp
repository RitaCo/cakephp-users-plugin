<?php

use \Cake\Routing\Router;

   $this->assign('title', 'مدیریت / نقش‌ها');
   $this->assign('note', 'فهرست نقش‌ها.');
?>


<div class="ui-panel-framed ">
	<div class="panel-header bg-flat">
		<div class="header-caption">فهرست</div>
	</div>
	<div class="panel-body padding-none ">
		<div class="body-header padding-none">
			<div class="ui-toolbar">
				<div class="toolbar-band ">
					<a class="btn" href="<?= Router::url(['action' => '#'])?>">	
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
                    <thead class="table-header">
                        <?php
                        
                        echo $this->Html->tableHeaders([
                        'نام',
                        'اعضا' ,
                        'وضعیت' ,
                        'عملیات'
                        ]);
                        
                        ?>
                    </thead>
                    <tbody class="table-body">
                        <?php
                        foreach ($roles as $role) {
                            echo $this->Html->tableCells([$role->name,$role->user_count,$role->active,'']);
                        }

?>
                    </tbody>
                </table>
            </div>
		
		
		</div>
	</div>
</div>

