<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<a href="#"><b>Tz-Chat</b> Admin</a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">로그인 Page</p>

		<form name="loginFrm">
			<div class="form-group has-feedback">
				<input id="userid" name="userid" type="text"
					placeholder="ID를 입력하세요." class="form-control"
					onkeypress="event.key === 'Enter' ? $('#passwd').focus():0"
					required> <span
					class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input id="passwd" name="passwd" class="form-control"
					type="password" placeholder="비밀No.를 입력하세요." required> <span
					class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<!--        loginFrm.$valid = {{loginFrm.$valid}}<br> -->
			<!--        loginFrm.$error = {{loginFrm.$error}}<br> -->
			<div class="row">
				<div class="col-xs-8" style="margin-left: 20px;">
					<div class="checkbox icheck">
						<label> <input id="saveId" name="saveId" type="checkbox"> ID 저장
						</label>
					</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-3">
					<div>
						<a id="login"
							class="btn btn-primary btn-block btn-flat">로그인</a>
					</div>
				</div>
				<!-- /.col -->
			</div>
		</form>
		<a name="findId">ID 찾기</a><br> <a name="findPasswd">비밀No. 찾기</a><br> <a
			name="register" class="text-center">가입하기</a>
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
$(document).ready(
    function() {
      $("#login").click(function(event) {
            var data = {
              userid : $("#userid").val(),
              passwd : $("#passwd").val()
            }
            $.ajax({
              url : config.domain + '/usera/get?params=' + JSON.stringify(data),
              type : 'POST',
              success : function(res, textStatus, jqXHR) {
                if (res) {
                  res = JSON.parse(res);
                  if (res.userid) {
                    setCache('session', res, 10000);
                    if ($("#saveId").val()) {
                      setCache('saveId', 'true', 10000);
                    } else {
                      initCache('saveId');
                    }
                    location.href="/main";
                  } else {
                    sweetAlert('', 'Failed to find your data.', 'warning');
                  }
                } else {
                  sweetAlert('Error', 'Failed to sign in.', 'error');
                }
              },
              error : function(jqXHR, textStatus, errorThrown) {
                sweetAlert('Error', 'Failed to sign in.', 'error');
              }
            });
          });
    });

</script>
</body>
</html>
