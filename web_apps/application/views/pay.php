
<form name="payListFrm"
	
	<!-- 컨텐츠 -->
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>결재수정</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<!-- Horizontal Form -->
				<div class="box box-info">
					<form class="form-horizontal">
						<div class="box-body">
						
							<div class="form-group">
								<label for="pay_type" class="col-sm-3 control-label">지불유형</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model model"
										name="pay_type" placeholder="pay_type">
									<input type="hidden" class="form-control model model"
										name="id" placeholder="id">
								</div>
							</div>
							<div class="form-group">
								<label for="item_type" class="col-sm-3 control-label">상품명</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="item_type"
										placeholder="item_type">
								</div>
							</div>
							<div class="form-group">
								<label for="ticket_type" class="col-sm-3 control-label">뱃지</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="ticket_type"
										placeholder="ticket_type">
								</div>
							</div>
							<div class="form-group">
								<label for="point" class="col-sm-3 control-label">포인트</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="point"
										placeholder="point">
								</div>
							</div>
							<div class="form-group">
								<label for="status" class="col-sm-3 control-label">Status</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="status"
										placeholder="status">
								</div>
							</div>
							<div class="form-group">
								<label for="ticket_expired" class="col-sm-3 control-label">만료예정일</label>
								<div class="col-sm-9">
									<input type="text" class="form-control model" name="ticket_expired"
										placeholder="ticket_expired">
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
					<a href="/pay" class="btn btn-default">List</a> 
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
				var id = url.split('?').pop().split('=').pop();
				var input = {
				    id: id
				}
			  $.ajax({
			    url : config.domain + '/pay/get?params=' + JSON.stringify(input),
			    type : 'POST',
			    success : function(res, textStatus, jqXHR) {
              if (res) {
                res = JSON.parse(res);
                for ( var key in res) {
                	var val = res[key];
                  if (key === 'point') {
                  	val = val.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                  } else if (key === 'partner_yn') {
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
	          } else if (key === 'partner_yn') {
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
			    url : config.domain + '/pay/update?params=' + JSON.stringify(input),
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