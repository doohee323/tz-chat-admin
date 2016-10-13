
<?php 
$status_name = '';
if($status == 'request') {
	$status_name = 'Request ';
}

?>

<form name="chatListFrm"> <!-- 컨텐츠 --> <!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Chatting <?php echo $status_name?>List</h1>
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
								<label>Query period:</label>
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
							<a id='queryBtn' class="btn btn-danger" style='margin-top: 20px;'>Search</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<table id="chatlist" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class='text-center' rowspan="2">No.</th>
								<th class='text-center' colspan="3">Sender</th>
								<th class='text-center' rowspan="2">Send Time</th>
								<th class='text-center' rowspan="2">Chatting Content</th>
								<th class='text-center' colspan="3">Receiver</th>
								<th class='text-center' rowspan="2">Status</th>
								<th class='text-center' rowspan="2">Sender IP</th>
							</tr>
							<tr>
								<th class='text-center'>Nickname</th>
								<th class='text-center'>Gender</th>
								<th class='text-center'>Age</th>
								<th class='text-center'>Nickname</th>
								<th class='text-center'>Gender</th>
								<th class='text-center'>Age</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<table id='template' style='display: none'>
						<tr>
							<td class='text-center'>{sn}</td>
							<td class='text-center'>{nickname}</td>
							<td class='text-center'>{age}</td>
							<td class='text-center'>{gender}</td>
							<td class='text-center' style='width: 20%'>{created_at}</td>
							<td class='text-left'>{detail}</td>
							<td class='text-center'>{nickname_t}</td>
							<td class='text-center'>{age_t}</td>
							<td class='text-center'>{gender_t}</td>
							<td class='text-center'>{status}</td>
							<td class='text-center'>{sender_ip}</td>
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

      var startDate = moment().subtract(7, 'days');
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
      
      chatlist('<?php echo $status?>');
      
      $("#queryBtn").click(function(event) {
				chatlist('<?php echo $status?>');
      });


			function chatlist(status) {
			
				if ( $.fn.DataTable.isDataTable('#chatlist') ) {
				  $('#chatlist').DataTable().destroy();
				}
				$('#chatlist tbody').empty();

				if(status === 'all') {
				  status = '';
				}
				var input = {
						from_at: startDate.format('YYYY/MM/DD'),
						to_at: endDate.format('YYYY/MM/DD'),
						status: status
				}
			  $.ajax({
			    url : config.domain + '/chata/chatlist?params=' + JSON.stringify(input),
			    type : 'POST',
			    success : function(res, textStatus, jqXHR) {
			      if (res) {
		              res = JSON.parse(res);
			        var template = $('#template').find('tr').html();
			        for (var i = 0; i < res.length; i++) {
			          var tmp = template;
			          var sender_ip;
			          for ( var key in res[i]) {
			            var val = res[i][key];
			            if (key.startsWith('gender')) {
			              if (key === 'gender' && val === 'man') { // sender
			                // is
			                // man
			                sender_ip = 'man_ip';
			              } else if (key === 'gender' && val === 'woman') { // sender is
			                                                                // woman
			                sender_ip = 'woman_ip';
			              }
			              if (val === 'man') {
			                val = 'Man';
			              } else {
			                val = 'Woman';
			              }
			            } else if (key === 'status') {
			              if (val === 'request') {
			                val = '요청중';
			              } else if (val === 'closed') {
			                val = '종료';
			              } else if (val === 'accepted') {
			                val = '승인';
			              } else if (val === 'reject') {
			                val = '거절';
			              }
			            }
			            tmp = tmp.replace('{' + key + '}', val);
			          }
			          tmp = tmp.replace('{sn}', i + 1);
			          sender_ip = res[i][sender_ip];
			          tmp = tmp.replace('{sender_ip}', sender_ip);
			          tmp = tmp.replace('{' + key + '}', val);
			          $("#chatlist").find('tbody').append('<tr>' + tmp + '</tr>');
			        }
			
			        var cdf = [];
			        if (status === '') {
			          cdf = [ {
			            targets : [ 9 ],
			            visible : false
			          } ];
			        }
			        $('#chatlist').DataTable({
			          columnDefs : cdf,
			          "paging" : true,
			          "lengthChange" : false,
			          "searching" : false,
			          "ordering" : true,
			          "info" : true,
			          "autoWidth" : true
			        });
			        $('thead > tr > th').css('vertical-align', 'middle');
			        $('tbody > tr > td').css('vertical-align', 'middle');
			      } else {
			        sweetAlert('', 'Failed to retrieve.', 'error');
			      }
			
			    },
			    error : function(jqXHR, textStatus, errorThrown) {
			      sweetAlert('', 'Failed to retrieve.', 'error');
			    }
			  });
			}
    });

</script>

