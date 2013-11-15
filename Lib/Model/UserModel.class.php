<?php
class UserModel extends Model {

	// 自动验证设置
	protected $_validate = array(
			array('userName', 'require', '用户名不能为空！', Model:: MODEL_BOTH),
			array('userName', 'require', '用户名已经存在！', 0, 'unique',Model:: MODEL_BOTH),
			array('userPassword', 'require', '密码不能为空！', 0),
	);

}
?>