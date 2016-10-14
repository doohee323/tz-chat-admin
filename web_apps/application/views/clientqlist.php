
<form name="clientqListFrm"> <!-- Content --> <!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Client Q&AList</h1>
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
					<table id="clientqList" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class='text-center'>No.</th>
								<th class='text-center'>ID</th>
								<th class='text-center'>Nickname</th>
								<th class='text-center'>Gender</th>
								<th class='text-center'>Created Time</th>
								<th class='text-center'>email</th>
								<th class='text-center'>Title</th>
								<th class='text-center'>Content</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<table id='template' style='display: none'>
						<tr>
							<td class='text-center' style='width: 80px'>{sn}</td>
							<td class='text-center' style='width: 150px'>{userid}</td>
							<td class='text-center' style='width: 150px'>{nickname}</td>
							<td class='text-center' style='width: 80px'>{gender}</td>
							<td class='text-center' style='width: 20%'>{created_at}</td>
							<td class='text-center' style='width: 20%'>{email}</td>
							<td class='text-left'>{title}</td>
							<td class='text-left'>{detail}</td>
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

      var startDate = moment().subtract(27, 'days');
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
      
      clientqList();
      
      $("#queryBtn").click(function(event) {
				clientqList();
      });

			function clientqList() {
				if ( $.fn.DataTable.isDataTable('#clientqList') ) {
				  $('#clientqList').DataTable().destroy();
				}
				$('#clientqList tbody').empty();

				var input = {
						from_at: startDate.format('YYYY/MM/DD'),
						to_at: endDate.format('YYYY/MM/DD')
				}
			  $.ajax({
			    url : config.domain + '/clientq/clientqList?params=' + JSON.stringify(input),
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
			            }
			            tmp = tmp.replace('{' + key + '}', val);
			          }
			          tmp = tmp.replace('{sn}', i + 1);
			          sender_ip = res[i][sender_ip];
			          tmp = tmp.replace('{sender_ip}', sender_ip);
			          tmp = tmp.replace('{' + key + '}', val);
			          $("#clientqList").find('tbody').append('<tr>' + tmp + '</tr>');
			        }
			
			        $('#clientqList').DataTable({
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

