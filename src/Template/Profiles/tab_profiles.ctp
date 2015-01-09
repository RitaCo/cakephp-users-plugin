<div id="UserProfile" class="ui-panel-framed">
    <header class="panel-header bg-3d">
        <div class="header-caption">مشخصات شما</div>
    </header>    
    <section class="panel-body padding-none">
        <div id="ProfileTab" class="ui-tab typ-top border-none">
            <ul class="tab-nav">
                <li data-tab="#tab1">
                    <a href="<?= $this->Url->build(['action' => 'personal', 'section' => 'clients'])?>">شخصی</a>
                </li>
                <li data-tab="#tab2" class="active"><a href="<?= $this->Url->build(['action' => 'password', 'section' => 'clients'])?>">رمز عبور</a></li>
                <li data-tab="#tab3"><a>فعال سازی</a></li>
                <li data-tab="#tab4"><a>آواتار</a></li>
            </ul>
        <div class="tab-container">
            <div class="tab-body active padding-none" id="<?= $this->request->param('action'); ?>">
                <?= $this->fetch('content'); ?>
            </div>			
        </div>
        </div>
    </section>
</div>