<?php

use \Cake\Routing\Router;

   $this->assign('title', 'مدیریت / کاربران / پروفایل کاربر');
   $this->assign('note', 'تمامی جزییات کاربر را در این بخش می توانید مشاهده نمایید');
?>


<div class="ui-panel-framed ">
	<div class="panel-header bg-flat">
        <div class="header-icon"></div>
		<div class="header-caption">پروفایل کاربر</div>
	</div>
	<div class="panel-body padding-none ">
		<div class="body-header padding-none">
			<div class="ui-toolbar">
				<div class="toolbar-band ">
					<a class="btn" href="<?= Router::url(['action' => 'index'])?>">	
						<i class="  icon-pageforward"></i>
						<span>بازگشت</span>
					</a>
					
				</div>
			</div>
		</div>
		<div class="body-splitter"></div>
		<div class="body-container ">
		  <p>پروفایل ندارد</p>
		
		</div>
	</div>
</div>

