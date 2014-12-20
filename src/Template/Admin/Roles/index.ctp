<?php

    $this->DataGrid->addColumn('Id', 'User.id');
$this->DataGrid->addColumn('dd', 'User.name', array('sort' => true));


echo $this->DataGrid->generate($roles);

?>