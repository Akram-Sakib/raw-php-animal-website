<?php
require 'config/init.php';
if(isset($_SESSION['adminId'])){
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Green Tech IT Soft | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="javascript:void(0)"><b>Green Tech </b>IT Soft</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form method="post" name="admin_login" id="admin_login">
                <div class="body">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="User name"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                </div>
                <div class="footer">
					<div id="login_error" style="display:none">
						<div class="alert alert-danger alert-dismissable">
							<i class="fa fa-ban"></i>
							<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
							<b>Error!</b> User name or password is not correct!
						</div>
					</div>
                    <button type="button" id="login_button" class="btn bg-olive btn-block">Sign me in</button>

                    <p><a data-toggle="modal" href="#myModal">I forgot my password</a></p>
                </div>
            </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
	  <div class="modal-dialog">
	   <form name="forget_pass" id="forget_pass" method="post" action="">
		  <div class="modal-content">
			  <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h4 class="modal-title">Forgot Password ?</h4>
			  </div>
			 
			  <div class="modal-body">
				  <p>Enter your e-mail address below to reset your password.</p>
				  <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
				  <br/>
				   <div class="msgst"></div>
			  </div>
			  <div class="modal-footer">
				  <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
				  <button class="btn btn-success" type="button" id="forgot_pass">Submit</button>
			  </div>
		  </div>
		  </form>
	  </div>
  </div>
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
		
		$("#login_button").click(function(){
			//alert('clicked');
		});
      });
	  
  $('#forgot_pass').click(function(){ 
  $.ajax
	({       
		type: "POST",  
		url: "_ajax_user_authentication.php?action=forgot",
		data: $("#forget_pass").serialize(),
		beforeSend:function() {
		},
		success: function(msg)
		{  
			//alert(msg);
			if(msg === '1')
			{
				//window.location.href='dashboard.php';
				$(".msgst").html('<div class="alert alert-success fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Well done!</strong> Your password has been changed succesfully.</div>');
			setTimeout(function() {
			 // Do something after 5 seconds
			 $("#myModal").modal('hide');
			  }, 3000);
			
			
			}
			else
			{
				$(".msgst").html('<div class="alert alert-denger fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button><strong>Well done!</strong> Your password has been changed succesfully.</div>');
				
			}
		} 
	});
});
				 
	 $('#login_button').click(function(){ 
		$.ajax
		({       
			type: "POST",  
			url: "_ajax_user_authentication.php?action=login",
			data: $("#admin_login").serialize(),
			beforeSend:function() {
			},
			success: function(msg)
			{  
			//alert(msg); 
				if(msg === '1')
				{
					window.location.href='index.php';
				
				}
				else
				{
					$("#login_error").show();
					
				}
			} 
		});
	});	
    </script>
  </body>
</html>
