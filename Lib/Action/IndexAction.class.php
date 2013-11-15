<?php
class IndexAction extends Action 
{
	private function xuanranbianlan($th)//渲染侧栏及标题栏
	{
		include('MyConfigINI.php');
		$th->assign('Vsoftname',$_SOFTNAME);
		$th->assign('Vversion',$_VERSION);
		if (session('?userPower'))//判断是否存在
		{
			$power = session('?userPower');//存在
			$th->assign('VuserPower',$Vpower);
			$th->assign('VuserName',session('userName').'&nbsp&nbsp&nbsp&nbsp<a href="__URL__/logout" class="navbar-link">安全退出</a>');
		}
		else
		{
			$power = 0;
			$th->assign('VuserName','游客');
		}
		/*
		$Vpower = "";
		for ($i =0; $i < strlen($power); $i++)
		{
		if ($power[$i])
			$Vpower = $Vpower.$_POWERCHINESE[$i].'|';
		}//TODO: delete last "|"
		*/
		
		$th->display();
	}
	
	private function powerCheck($th)//渲染侧栏及标题栏
	{
		if (!session('?userName'))
		{
			$this->error('非法登录','index');
		}
	}
	
    public function index()
    {
    
    	//渲染标题栏
    	IndexAction::xuanranbianlan($this);
    }
    
    public function login()//登陆页面
    {
    	//渲染标题栏
    	IndexAction::xuanranbianlan($this);
    }
    
    public function islogin()//判断是否登录成功
    {
    	//$this->assign('waitSecond',135);
    	 
    	$dbuser = M("User");
    	$condition['userName'] = $this->_post('userName');
    	$condition['userPassword'] = $this->_post('userPassword');
    	$result = $dbuser->where($condition)->select();
    	 
    	if($result)
    	{
    		session('userName',$result[0]['userName']);
    		session('userPower',$result[0]['userPower']);
    		$this->success('登陆成功','index');/////////////////////////////////////////////////////////
    	}
    	else
    	{
    		$this->error('登录失败');
    	}
    }
    
    public function logout()//安全退出
    {
    	if (!session('?userName'))
    	{
    		$this->error('非法登录','index');
    	}
    	//$this->assign('waitSecond',135);
    	session('userName',null);
    	session('userPower',null);
    	if ( (session('?userName')) || (session('?userPower')) )
    		$this->error('退出失败');
    	else
    		$this->success('退出成功','index');////////////////////////////////////////////////////////
    }
    
}