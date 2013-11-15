<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($Vsoftname); ?></title>
<!-- Bootstrap -->   <link href="__TMPL__css/bootstrap.min.css" rel="stylesheet" media="screen">

   <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
</head>

<body>

    <div class="container">

      <form class="form-signin" id="sign" name="sign" method="post" action="__URL__/toSign" >
        <h2 class="form-signin-heading">注册</h2>
        	用户名<input type="text" class="input-block-level"  name="userName">
        	密码<input type="password" class="input-block-level" name="userPassword">
        	再次输入密码<input type="password" class="input-block-level" name="userPassword2">
        <button class="btn btn-large btn-primary" type="submit">注册</button>
        <!-- TODO:返回首页功能 -->
      </form>

    </div> <!-- /container --> 

    <!-- Bootstrap -->    <script src="__TMPL__js/bootstrap.min.js"></script>

</body>
</html>