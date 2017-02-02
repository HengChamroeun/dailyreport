	<!-- jQuery -->
	<?php
		//$name='ReportInExcel';
		$name = 'CustomsDailyRevenue_'.date("d-m-y", strtotime($DATE));
	?>
	<script src="<?php echo js('jquery.min.js');?>"></script>
	<!-- Excel Export-->
	<script src="<?php echo js('Scripts/jquery.battatech.excelexport.js');?>"></script>
	<script type="text/javascript">
    $(document).ready(function () {
        $("#btnExport").on('click', function () {
			//var tmp = $(this).find('#print_logo').parent().html();
			var tmp_parent = $('#print_logo').parent();
			//var tmp = tmp_parent.html();
			$('#print_logo').remove();
            var uri = $("#ReportTable").btechco_excelexport({
                containerid: "ReportTable"
                , datatype: $datatype.Table
                , returnUri: true
            });
            $(this).attr('download', '<?php echo $name; ?>.xls');
			$(this).attr('href', uri).attr('target', '_blank');
			tmp_parent.append("<img id='print_logo' style='max-height:100px;top:-40px;margin-left:50px;position:absolute' src='<?php echo base_url('assets/files/customs_logo.jpg') ?>'/>");
			//return false;
			
        });
    });
</script>
</body>
</html>