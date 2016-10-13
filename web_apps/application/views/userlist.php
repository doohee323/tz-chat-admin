
<form name="userListFrm"
	<!-- 컨텐츠 -->
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>회원List</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<!-- 			  <div class="box-header"> -->
					<!-- 			    <h3 class="box-title"></h3> -->
					<!-- 			  </div> -->
					<div class="box-body">
						<div class="col-md-6">
							<div class="form-group">
								<label>조회 기간:</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="form-control pull-right"
										id="daterange">
								</div>
							</div>
						</div>
						<div class="col-md-6" style='text-align: right;'>
							<a id='queryBtn' class="btn btn-danger" style='margin-top: 20px;'>조회</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<table id="userlist" class="table table-bordered table-hover" style='width:1500px'>
						<thead>
							<tr>
								<th class='text-center'>번호</th>
								<th class='text-center'>아이디</th>
								<th class='text-center'>닉네임</th>
								<th class='text-center'>성별</th>
								<th class='text-center'>실명인증여부</th>
								<th class='text-center'>핸드폰번호</th>
								<th class='text-center'>지역</th>
								<th class='text-center'>세부지역</th>
								<th class='text-center'>보유포인트</th>
								<th class='text-center'>뱃지</th>
								<th class='text-center'>가입시간</th>
								<th class='text-center'>최근접속일</th>
								<th class='text-center'>최종접속IP</th>
								<th class='text-center'>가입IP</th>
								<th class='text-center'>파트너누락</th>
								<th class='text-center'>파트너</th>
								<th class='text-center'>수정</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<table id='template' style='display: none'>
						<tr>
							<td class='text-center' style='width:80px'>{sn}</td>
							<td class='text-center' style='width:150px'>{userid}</td>
							<td class='text-center' style='width:150px'>{nickname}</td>
							<td class='text-center' style='width:80px'>{gender}</td>
							<td class='text-center' style='width:80px'>{phone_confirm}</td>
							<td class='text-center' style='width:100px'>{phone_no}</td>
							<td class='text-center' style='width:100px'>{region1}</td>
							<td class='text-center' style='width:100px'>{region2}</td>
							<td class='text-right' style='width:100px'>{point}</td>
							<td class='text-center' style='width:80px'>{ticket_type}</td>
							<td class='text-center' style='width:100px'>{created_at}</td>
							<td class='text-center' style='width:100px'>{updated_at}</td>
							<td class='text-center' style='width:100px'>{updated_ip}</td>
							<td class='text-center' style='width:100px'>{created_ip}</td>
							<td class='text-center' style='width:100px'>{partner_yn}</td>
							<td class='text-center' style='width:100px'>{partner_id}</td>
							<td class='text-center' style='width:100px'><a href='usera/detail?userid={userid}'>수정</a></td>
						</tr>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content --> </form>

<script>
$(document).ready(
    function() {

      var startDate = moment().subtract(30, 'days');
      var endDate = moment();
      
      $('#daterange').daterangepicker({
            startDate: startDate,
            endDate: endDate
          },
          function (start, end) {
            startDate = start;
            endDate = end;             
          }
      );
      
      userlist();
      
      $("#queryBtn").click(function(event) {
				userlist();
      });

			function userlist() {
				var input = {
						from_at: startDate.format('YYYY/MM/DD'),
						to_at: endDate.format('YYYY/MM/DD')
				}

				if ( $.fn.DataTable.isDataTable('#userlist') ) {
				  $('#userlist').DataTable().destroy();
				}
				$('#userlist tbody').empty();
			
			  $.ajax({
			    url : config.domain + '/usera/userlist?params=' + JSON.stringify(input),
			    type : 'POST',
			    success : function(res, textStatus, jqXHR) {
              if (res) {
                res = JSON.parse(res);
                var template = $('#template').find('tr').html();
                for (var i = 0; i < res.length; i++) {
                  var tmp = template;
                  for ( var key in res[i]) {
                    var val = res[i][key];
                    if (key.startsWith('gender')) {
                      if (val === 'man') {
                        val = '남';
                      } else {
                        val = '여';
                      }
                    }
                    if (key === 'point') {
                      val = val.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    }
                    tmp = tmp.replaceAll('{' + key + '}', val);
                  }
                  tmp = tmp.replace('{sn}', i + 1);
                  tmp = tmp.replace('{' + key + '}', val);
                  $("#userlist").find('tbody').append(
                      '<tr>' + tmp + '</tr>');
                }
                
                $('#userlist').DataTable({
                  "paging" : true,
                  "lengthChange" : false,
                  "searching" : false,
                  "ordering" : true,
                  "info" : true,
                  "scrollX": true,
                  "autoWidth" : false
                });
                $('thead > tr > th').css('vertical-align', 'middle');
//                 $('thead > tr > th').addClass('text-center');
                $('tbody > tr > td').css('vertical-align', 'middle');
              } else {
                sweetAlert('', '조회를 실패하였습니다.', 'error');
              }
			    },
			    error : function(jqXHR, textStatus, errorThrown) {
			      sweetAlert('', '조회를 실패하였습니다.', 'error');
			    }
			  });
			}
    });

</script>