
<form name="payListFrm">
	<!-- Content -->
	<!-- Content Header (Page header) -->
	<section class="content-header">
	<h1>Pay Stats</h1>
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
					<table id="paystats" class="table table-bordered table-hover" style='width:1500px'>
						<thead>
							<tr>
								<th class='text-center' style='height: 50px'>Date</th>
								<th class='text-center'>Credit Card</th>
								<th class='text-center'>Phone Pay</th>
								<th class='text-center'>Transfer Money</th>
								<th class='text-center'></th>
								<th class='text-center'></th>
								<th class='text-center'></th>
								<th class='text-center'></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<table id='template' style='display: none'>
						<tr>
							<td class='text-center' style='width:50px'>{created_at}</td>
							<td class='text-right' style='width:50px'>{card}</td>
							<td class='text-right' style='width:50px'>{phone}</td>
							<td class='text-right' style='width:50px'>{bank}</td>
							<td class='text-right' style='width:50px'>{partner_proceeds}</td>
							<td class='text-right' style='width:50px'>{partner_missing}</td>
							<td class='text-right' style='width:50px'>{total_payment}</td>
							<td class='text-right' style='width:80px'>{net_income}</td>
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
</form>

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
      
      paystats();
      
      $("#queryBtn").click(function(event) {
				paystats();
      });
      
			function paystats() {

				var input = {
						from_at: startDate.format('YYYY/MM/DD'),
						to_at: endDate.format('YYYY/MM/DD')
				}

				if ( $.fn.DataTable.isDataTable('#paystats') ) {
				  $('#paystats').DataTable().destroy();
				}
				$('#paystats tbody').empty();
				
			  $.ajax({
			    url : config.domain + '/pay/paystats?params=' + JSON.stringify(input),
			    type : 'POST',
			    success : function(res, textStatus, jqXHR) {
			      if (res) {
			        res = JSON.parse(res);
			        var template = $('#template').find('tr').html();
			        for (var i = 0; i < res.length; i++) {
			          var tmp = template;
			          for ( var key in res[i]) {
			            var val = res[i][key];
			            if (key != 'created_at') {
			              val = val.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			            }
			            tmp = tmp.replace('{' + key + '}', val);
			          }
			          tmp = tmp.replace('{' + key + '}', val);
			          $("#paystats").find('tbody').append(
			              '<tr>' + tmp + '</tr>');
			        }
			        
			        $('#paystats').DataTable({
			          "paging" : true,
			          "lengthChange" : false,
			          "searching" : false,
			          "ordering" : true,
			          "info" : true,
			          "scrollX": true,
			          "autoWidth" : false
			        });

			        $('.dataTables_scrollHead').css('height', '57px');
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
