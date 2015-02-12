						<li>
							<a href="<?= $this->Url->build(['plugin' => 'Rita/Users','controller' => 'DashBoard', 'action' => 'index'])?>">
								<div class="icon"><i class=" fa fa-users"></i></div>
								<div class="label"><span>کاربران</span></div>
							</a>
							<ul class="menu-submenu">
								<li>
									<a href="<?= $this->Url->build(['plugin' => 'Rita/Users','controller' => 'Users', 'action' => 'index'])?>">
										<div class="icon"><i class=" fa fa-user"></i></div>
										<div class="label"><span>مدیریت اعضا</span></div>
									</a>
								</li>
								<li>
									<a href="<?= $this->Url->build(['plugin' => 'Rita/Users','controller' => 'Roles', 'action' => 'index'])?>">
										<div class="icon"><i class=" icon-news"></i></div>
										<div class="label"><span>مدیریت نقش‌ها</span></div>
									</a>
								</li>
								<li>
									<a href="<?= $this->Url->build(['plugin' => 'Rita/Users','controller' => 'Settings', 'action' => 'index'])?>">
										<div class="icon"><i class=" icon-homealt"></i></div>
										<div class="label"><span>تنظیمات</span></div>
									</a>
								</li>
						
							</ul>								
						</li>