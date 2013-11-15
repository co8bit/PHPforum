<?php

class IndexAction extends Action 
{
    public function index()
    {
    	include('MyConfigINI.php');
    	$this->assign('Vsoftname',$_SOFTNAME);
		$this->display();
    }
}