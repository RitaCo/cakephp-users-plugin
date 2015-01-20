<!DOCTYPE html>
<html dir="rtl">
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		نیازمندی‌های استان همدان
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>



	
		<?= $this->Rita->loadingCSS() ?>
		<?= $this->Rita->loadingJS() ?>
		
		
				
		
		
	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
    <?= $this->Html->css('front.css') ?>
</head>
<body>
<div class="grid-container">
 
    <div class="grid-row isfluid" >
        <div style=" vertical-align: middle; display: table-cell;">
        <br />
        <br />
        	<div class="container">
            <?= $this->Flash->render('auth') ?>
            
            <?= $this->Flash->render() ?>
            </div>
             <br />  
    		<?= $this->fetch('content') ?>
            <br />
            <br />
        </div>
    </div>
    <div class="grid-row">
        <footer class="main-footer">
            <span>تمامی محتوای این وب سایت متعلق  است به</span>
        	<img  src="/img/logo.svg"/>
        	
        </footer>
    </div>
</div>    
</body>
</html>

