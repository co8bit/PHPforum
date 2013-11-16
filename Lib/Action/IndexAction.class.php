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
	
	private function powerCheck()//渲染侧栏及标题栏
	{
		if (!session('?userName'))
		{
			$this->error('非法登录','index');
		}
	}
	
    public function index()
    {
    	$boardMap = M('board');
    	$boardMap = $boardMap -> order('id') -> select();
    	$this->assign('boardList',$boardMap);
    	
    	//渲染标题栏
    	IndexAction::xuanranbianlan($this);
    }
    
    public function aboutMe()//登陆页面
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
    	 
    	$dbuser = M("User");//NOTE:thinkphp是用参数名确定是哪个数据库的，比如M("User")的User
    	$condition['userName'] = $this->_post('userName');
    	$condition['userPassword'] = $this->_post('userPassword');
    	$result = $dbuser->where($condition)->select();
    	if($result)
    	{
    		session('userName',$result[0]['userName']);
    		session('userPower',$result[0]['userPower']);
    		$this->success('登陆成功','index');
    	}
    	else
    	{
    		$this->error('登录失败');
    	}
    }
    
    public function sign()//注册页面
    {
    	//渲染标题栏
    	IndexAction::xuanranbianlan($this);
    }
    
    public function toSign()//判断是否注册成功
    {
    	$dbUser = D("User");
    	$dbUser->create();
    	
    	$password1 = $dbUser->userPassword;
    	$password2 = $this->_post('userPassword2');
    	if ($password1 != $password2)
    		$this->error('两次输入的密码不一样');
    	else
    	{
    		$condition['userName'] = $this->_post('userName');
    		$condition['userPassword'] = $this->_post('userPassword');
    		$condition['userPower'] = 1;
    		$result = $dbUser->add($condition);
    		if($result)
    		{
    			session('userName',$condition['userName']);//////////////////这里进行了session
    			session('userPower',$condition['userPower']);
    			$this->success('注册成功','index');
    		}
    		else
    		{
    			if ( $dbUser->getError() == '非法数据对象！')//! 号后面有个空格
    				$this->error('注册失败：'.'有未填项');
    			else
    				$this->error('注册失败：'.$dbUser->getError());
    		}
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
    
    public function board()
    {
    	//IndexAction::powerCheck();
    	$boardID['boardID'] = $this->_get('id');
    	$dbUser = M("bbspost");//NOTE:thinkphp是用参数名确定是哪个数据库的，比如M("User")的User
    	$dbUser = $dbUser -> where($boardID) -> where('parentID=id' ) ->order('updateTime desc')-> select();
    	$this->assign('boardList',$dbUser);
    	$this->assign('boardID',$boardID['boardID']);
    	//dump($dbUser);
    	//渲染标题栏
    	IndexAction::xuanranbianlan($this);
    }
    
    public function bbspost()
    {
    	//IndexAction::powerCheck();
    	$condition['boardID'] = $this->_get('boardID');
    	$condition['parentID'] = $this->_get('id');
    	$dbUser = M("bbspost");//NOTE:thinkphp是用参数名确定是哪个数据库的，比如M("User")的User
    	$dbUser = $dbUser -> where($condition) ->order('createTime desc') -> select();
    	//dump($dbUser);
    	$title = $dbUser[0]['title'];
    	$this->assign('boardList',$dbUser);
    	$this->assign('title',$title);
    	$this->assign('boardID',$condition['boardID']);
    	$this->assign('id',$condition['parentID']);
    	//dump($dbUser);
    	//渲染标题栏
    	IndexAction::xuanranbianlan($this);
    }
    
    public function newPost()//发帖子页面
    {
    	$boardID = $this->_get('boardID');
    	$this->assign('boardID',$boardID);
    	//渲染标题栏
    	IndexAction::xuanranbianlan($this);
    }
    
    public function PullNewPost()
    {
    	//IndexAction::powerCheck();
    	$condition['boardID'] = $this->_post('boardID');
    	$condition['title'] = $this->_post('title');
    	$condition['content'] = $this->_post('content');
    	$condition['author'] = session('userName');
    	$condition['createTime'] = date("Y-m-d H:i:s");
    	$condition['updateTime'] = date("Y-m-d H:i:s");
    	
    	$dbUser = M("bbspost");//NOTE:thinkphp是用参数名确定是哪个数据库的，比如M("User")的User
    	$dbUser->add($condition);
    	
    	//$dbUser2 = M("bbspost");//NOTE:thinkphp是用参数名确定是哪个数据库的，比如M("User")的User
    	$condition2['boardID'] = $this->_post('boardID');
    	$condition2['title'] = $this->_post('title');
    	$condition2['content'] = $this->_post('content');
    	$condition2['author'] = session('userName');
    	$dbUser2 = $dbUser->where($condition2)->select();
    	trace($dbUser2,'sele信息','sql');
    	//dump($dbUser2);
    	$condition3['parentID'] = $dbUser2[0]['id'];
    	
    	$re = $dbUser -> where($condition2) ->save($condition3);
    	if($re)
    	{
    		$this->success('发帖成功','index');
    	}
    	else
    	{
    			$this->error('发帖失败');
    	}
    }
    
    public function newRePost()//回复帖子的页面
    {
    	$boardID = $this->_get('boardID');
    	$id = $this->_get('id');
    	$this->assign('boardID',$boardID);
    	$this->assign('id',$id);
    	//渲染标题栏
    	IndexAction::xuanranbianlan($this);
    }
    
    public function PullNewRePost()
    {
    	//IndexAction::powerCheck();
    	$condition['boardID'] = $this->_post('boardID');
    	$condition['parentID'] = $this->_post('id');
    	//$condition['title'] = $this->_post('title');
    	$condition['content'] = $this->_post('content');
    	$condition['author'] = session('userName');
    	$condition['createTime'] = date("Y-m-d H:i:s");
    	$condition['updateTime'] = date("Y-m-d H:i:s");
    	 
    	$dbUser = M("bbspost");//NOTE:thinkphp是用参数名确定是哪个数据库的，比如M("User")的User
    	$re = $dbUser->add($condition);
    	 
    	if($re)
    	{
    		$this->success('回帖成功','index');
    	}
    	else
    	{
    		$this->error('回帖失败');
    	}
    }
}