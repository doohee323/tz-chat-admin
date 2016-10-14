
<span> Test ID 1: doohee323 / 123qwe
</span>
<a href='http://www.topzone.biz' target='_blank'> doosee323 / 123qwe </a>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<table>
				<tr>
					<td id="wrap1">
					</td>
					<td>&nbsp;&nbsp;</td>
					<td id="wrap2">
					</td>
				</tr>
			</table>
		</div>
	</div>
</section>

<script>
$(document).ready(
    function() {
      function createFrm(wrap, id) {
        var ifrm = document.createElement('iframe');
        ifrm.setAttribute('id', id);
        var el = document.getElementById(wrap);
        el.parentNode.insertBefore(ifrm, el);
        ifrm.setAttribute('src', 'http://www.topzone.biz');
        ifrm.setAttribute('frameborder', '0');
        ifrm.setAttribute('style', 'width: 550px; height: 550px;');
      }

      try {
        createFrm('wrap1', 'ifm1');
      } catch (e) {
        console.log(e);
      }
      try {
        createFrm('wrap2', 'ifm2');
      } catch (e) {
        console.log(e);
      }      
    });

</script>


