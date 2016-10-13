
<form name="userListFrm"
	
	<!-- 컨텐츠 -->
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>User 정보수정</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<!-- Horizontal Form -->
				<div class="box box-info">
					<form class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label for="userid" class="col-sm-3 control-label">ID</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model model"
										name="userid" placeholder="userid">
								</div>
							</div>
							<div class="form-group">
								<label for="nickname" class="col-sm-3 control-label">Nickname</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="nickname"
										placeholder="nickname">
								</div>
							</div>
							<div class="form-group">
								<label for="gender" class="col-sm-3 control-label">Gender</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="gender"
										placeholder="gender">
								</div>
							</div>
							<div class="form-group">
								<label for="phone_confirm" class="col-sm-3 control-label">실명인증</label>
								<div class="col-sm-9">
									<label> 여 <input type="radio" name="phone_confirm"
										class="model minimal-red">
									</label> <label> 부 <input type="radio" name="phone_confirm"
										class="model minimal-red">
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="phone_no" class="col-sm-3 control-label">핸드폰No.</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="phone_no"
										placeholder="phone_no">
								</div>
							</div>
							<div class="form-group">
								<label for="region1" class="col-sm-3 control-label">지역</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="region1"
										placeholder="region1">
								</div>
							</div>
							<div class="form-group">
								<label for="region2" class="col-sm-3 control-label">세부지역</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="region2"
										placeholder="region2">
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer"></div>
					</form>
				</div>
			</div>

			<div class="col-md-6">
				<!-- Horizontal Form -->
				<div class="box box-info">
					<form class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label for="point" class="col-sm-3 control-label">포인트</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="point"
										placeholder="point">
								</div>
							</div>
							<div class="form-group">
								<label for="ticket_type" class="col-sm-3 control-label">뱃지</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model"
										name="ticket_type" placeholder="ticket_type">
								</div>
							</div>
							<div class="form-group">
								<label for="created_at" class="col-sm-3 control-label">가입시간</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="created_at"
										placeholder="created_at">
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer"></div>
					</form>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box-footer">
					<a id='queryBtn' class="btn btn-default">취소</a> 
					<a href="/usera" class="btn btn-default">List</a> 
					<a id='saveBtn'
						class="btn btn-info pull-right">저장</a>
				</div>
			</div>
		</div>
	</section>

	<script>
$(document).ready(
    function() {
      
      query();
      
      $("#queryBtn").click(function(event) {
				query();
      });

      $("#saveBtn").click(function(event) {
				save();
      });

			function query() {
				var url = window.location.href;
				var userid = url.split('?').pop().split('=').pop();
				var input = {
				    userid: userid
				}
			  $.ajax({
			    url : config.domain + '/usera/get?params=' + JSON.stringify(input),
			    type : 'POST',
			    success : function(res, textStatus, jqXHR) {
              if (res) {
                res = JSON.parse(res);
                for ( var key in res) {
                	var val = res[key];
                  if (key === 'point') {
                  	val = val.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                  } else if (key === 'phone_confirm' || key === 'partner_yn') {
                    if(val === 'y') {
                      document.getElementsByName(key)[0].checked = true;
                    } else {
                      document.getElementsByName(key)[1].checked = true;
                    }
                  }
                  $( "[name*='" + key + "']" ).val(val);
                }
              } else {
                sweetAlert('', 'Failed to retrieve.', 'error');
              }
			    },
			    error : function(jqXHR, textStatus, errorThrown) {
			      sweetAlert('', 'Failed to retrieve.', 'error');
			    }
			  });
			}

			function save() {
			  var cols = $('.model');
			  var input = {};
			  //$('#input-1, #input-3').iCheck('check');
			  for ( var i in cols) {
				  var key = cols[i].name;
				  if(key) {
				    var val = $( "[name*='" + key + "']" ).val();
	          if (key === 'point') {
	          	val = val.replace(/,/g, "");
	          } else if (key === 'phone_confirm' || key === 'partner_yn') {
	            var checked = document.getElementsByName(key)[0].checked;
	            if(checked) {
	              val = 'y';
	            } else {
	              val = 'n';
	            }
	          }
				    input[key] = val;
				  }
			  }
			  $.ajax({
			    url : config.domain + '/usera/update?params=' + JSON.stringify(input),
			    type : 'POST',
			    success : function(res, textStatus, jqXHR) {
              if (res) {
                sweetAlert('', 'Saved!', 'info');
              } else {
                sweetAlert('', 'Failed to save.', 'error');
              }
			    },
			    error : function(jqXHR, textStatus, errorThrown) {
			      sweetAlert('', 'Failed to save.', 'error');
			    }
			  });
			}
			
    });

</script>