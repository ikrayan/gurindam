  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
     KMS Badan Kepegawaian Negara
    </div>
    <strong>Copyright &copy; <?php echo date('Y') ?></strong>
  </footer>

  
</div>
<script src="../assets/jquery-3.5.1.slim.min.js" ></script>
<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/datatables.min.js"></script>

<script src="../assets/bower_components/morris.js/morris.min.js"></script>
<script src="../assets/bower_components/raphael/raphael.min.js"></script>
<!-- 
<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../assets/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="../assets/dist/js/pages/dashboard.js"></script>

<script src="../assets/bower_components/ckeditor/ckeditor.js"></script>
<script src="../assets/dist/js/demo.js"></script>


<script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
-->

<script src="../assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="../assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<script src="../assets/bower_components/moment/min/moment.min.js"></script>
<script src="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="../assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/bower_components/fastclick/lib/fastclick.js"></script>

<script src="../assets/dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){

   // $(".edit").hide();
   //$.fn.dataTable.moment('MM-DD-YYYY');
		if($('#level').val() == 'verifikator') {
		  $('#divRoles').show(); 
		} else {
		  $('#divRoles').hide(); 
		}
	  
		$('#level').change(function(){
			if($('#level').val() == 'verifikator') {
				$('#divRoles').show(); 
			} else {
				$('#divRoles').hide(); 
			} 
		});
	  
   $('#table-datatable').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : true,
    'pageLength': 10,
	
  });
	  
  $('#table-posting-datatable').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    'pageLength': 10,
	'order'		: [[ 0, "desc" ]],
	'columnDefs': [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
		]
  });
	  
  $('#table-faq-datatable').DataTable({
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    'pageLength': 10,
	'order'		: [[ 0, "desc" ]],
	'columnDefs': [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
		]
  });
	  
	  // Javascript to enable link to tab
		var hash = location.hash.replace(/^#/, '');  // ^ means starting, meaning only match the first hash
		if (hash) {
			$('.nav-tabs a[href="#' + hash + '"]').tab('show');
		} 

		// Change hash for page-reload
		$('.nav-tabs a').on('shown.bs.tab', function (e) {
			window.location.hash = e.target.hash;
		})
	  
 });
  
  $('#datepicker').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy',
  }).datepicker("setDate", new Date());

  $('.datepicker2').datepicker({
    autoclose: true,
    format: 'yyyy/mm/dd',
  });

/*
  $(function () {

    CKEDITOR.replace('editor1')
    
  });

*/
</script>



</body>
</html>
