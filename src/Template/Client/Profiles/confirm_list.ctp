<?php

$this->extend('TabProfiles');

?>

<div class="tab-body active " id="<?= $this->request->param('action'); ?>">

                  
                    <?= $this->Form->input('mobile', ['label' => 'همراه' ]); ?>
    <?php if (empty($lists)) :
?>    
       <div class="well">
       
            ss
       </div>
    <?php
endif; ?>
</div>
