 <footer class="footer text-center">
       <p> រក្សាសិទ្ធិ <span style="font-family:courier">&copy;</span> <?php echo numberKH(date('Y',time())); ?>-អគ្គនាយកដ្ឋានគយនិងរដ្ឋាករកម្ពុជា<br> ក្រុមការងារគម្រោងជាតិប្រព័ន្ធស្វ័យប្រវត្តិកម្មទិន្នន័យគយ</p>
</footer>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="<?php echo base_url('assets/theme/plugins/bootstrap'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/theme/plugins/bootstrap'); ?>/js/ie10-viewport-bug-workaround.js"></script>
	<script src="<?php echo js('Scripts/jquery.battatech.excelexport.js');?>"></script>
	<script src="<?php echo base_url('assets/theme/plugins/datepicker/moment.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/datatable/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/pikaday/pikaday.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/dialog/js/bootstrap-dialog.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/floatThead/jquery.floatThead.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/theme/plugins/inputmask/jquery.inputmask.bundle.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/datepicker/bootstrap-datetimepicker.js'); ?>"></script>
  
	<script>
			//Number format
			Number.prototype.format = function(n, x, s, c) {
			var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
				num = this.toFixed(Math.max(0, ~~n));
			
			return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
		};
	$(document).ready(function(){
		$('#example').DataTable({
			"lengthMenu": [ [ -1, 10, 25, 50, 100, 250, 500], [ "ទាំងអស់", 10, 25, 50, 100, 250, 500] ]
		});
		moment().format();
	});
	function replaceAll(find, replace, str) {
		return str.replace(new RegExp(find, 'g'), replace);
	}
	function removeMask(str){
		return replaceAll(',','',str);
	}
	$(":input").inputmask();
	// $(function () {
		// $('#datetimepicker').datetimepicker({
			// format: 'YYYY-MMM-DD'
		// }).on('changeDate', function(ev){});
	// });
	// function dateChanged(){
		// alert($('#datepicker').val());
	// }
	

    var picker = new Pikaday(
    {
        field: document.getElementById('datepicker'),
		
		onSelect: function() {
           // console.log(this.getMoment().format('Do MMMM YYYY'));
		   //alert($('#datepicker').val());
		   <?php
		   $b_url = '';
		   if(strpos(uri_string(),'revenue_history')>0){
		   	$b_url = 'admin/revenue_history';
		   }
		   else if(strpos(uri_string(),'monthly_item_revenues')>0){
		   	$b_url = 'admin/monthly_item_revenues';
		   }
		   else{
		   	$b_url = 'admin';
		   }
		   ?>
		   var url='<?php echo base_url($b_url); ?>?date='+$('#datepicker').val();
		   window.location=url;
        }
    });
	
	    var picker2 = new Pikaday(
    {
        field: document.getElementById('REP_DAT_1_INP')//,
		//format: 'YYYY-mm-DD'//,
		//onSelect: function() {
           // console.log(this.getMoment().format('Do MMMM YYYY'));
		   //alert($('#datepicker').val());
		   //var url='<?php echo base_url('admin') ?>?date='+$('#datepicker').val();
		   //window.location=url;
       // }
    });
	
	    var picker3 = new Pikaday(
    {
        field: document.getElementById('REP_DAT_2_INP')//,
		//format: 'YYYY-mm'//,
		//onSelect: function() {
           // console.log(this.getMoment().format('Do MMMM YYYY'));
		   //alert($('#datepicker').val());
		   //var url='<?php echo base_url('admin') ?>?date='+$('#datepicker').val();
		   //window.location=url;
       // }
    });
    
	</script>
	<style>
		#example tr.odd{background-color:#f9f9f9;}
		#example td.amt{text-align:right;}
		#example td.bname{text-align:left;}
		#example tr.bg_red.even {background-color:#FFA07A;}
		#example tr.bg_red.odd {background-color:#FFA07A;}
	</style>
  </body>
</html>