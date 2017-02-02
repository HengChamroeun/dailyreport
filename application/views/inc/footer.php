 <footer class="footer text-center">
        <p > រក្សាសិទ្ធិ <span style="font-family:courier">&copy;</span> <?php echo numberKH(date('Y',time())); ?><br> ក្រុមការងារគម្រោងជាតិប្រព័ន្ធស្វ័យប្រវត្តិកម្មទិន្នន័យគយ</p>
 </footer>
	<!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url('assets/theme/plugins/bootstrap'); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/theme/plugins/bootstrap'); ?>/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo base_url('assets/theme/plugins/floatThead/jquery.floatThead.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/datatable/js/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/datatable/js/dataTables.fixedColumns.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/datatable/js/dataTables.bootstrap.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/pikaday/pikaday.js'); ?>"></script>
    <script src="<?php echo base_url('assets/theme/plugins/bootbox/bootbox.js'); ?>"></script>
	<script src="<?php echo base_url('assets/theme/plugins/dialog/js/bootstrap-dialog.js'); ?>"></script>
	<script src="<?php echo base_url('assets/theme/plugins/inputmask/jquery.inputmask.bundle.js'); ?>"></script>
	<script>
				//Number format
		Number.prototype.format = function(n, x, s, c) {
			var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
				num = this.toFixed(Math.max(0, ~~n));

			return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
		};
		function replaceAll(find, replace, str) {
			return str.replace(new RegExp(find, 'g'), replace);
		}
		function removeMask(str){
			return replaceAll(',','',str);
		}
		$(":input").inputmask();
			/*===========CLEARING CONSOLE============*/
		// setInterval(function(){clearLog();},5000);
		// function clearLog(){
			// console.clear();
			// console.log('%cSTOP!!!! All your illegal actions are tracked in an Automated System, please close this console or you are going to face the legal actions from the Cyber Crime Law of Cambodia.', 'background: #fefefe; font-weight:bold; font-size:30px; color: red');
		// }


		//TO IMPLEMENT
		//data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true"
		</script>

  </body>
</html>
