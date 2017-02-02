<?php
$items = $this->m_global->select_data(TBLITEMS,NULL,array('id'=>'ASC'),0);
$month = date('m');
$month = $month - 1;
$itm_3 = array();
if($month<10){
	$month = '0'.$month;
	}
if($this->input->get('m')){
	$month = $this->input->get('m');
	}
$year = date('Y');
if($this->input->get('y')){
	$year = $this->input->get('y');
	}
?>
<div class="jumbotron" style="min-height:500px;">
<h2 class="title"><?php echo($this->m_global->select_record(TBLOFFICES,array('code'=>$this->input->get('office')),'name')); ?></h2>
<h3>ចំណូលពន្ធតាមមុខទំនិញសរុបប្រចាំខែ <?php selectMonth($month); ?> ឆ្នាំ <?php selectYear($year); ?></h3>
<br/>
<?php
$attr=array('id'=>'frmRevenue','class'=>'form-horizontal','role'=>'form');
echo form_open(base_url('item_38/add_item'),$attr);
?>

    <div class=''>
        <div id="div_input">
            <h3>១.១ ទំនិញនាំចូលជាប់ពន្ធនិងអាករ</h3>
            <table class='table table-striped table-bordered table-hover' style="width:100%;" id="table_input">
                <thead>
                    <tr>
                        <th rowspan=2 style="width:180px;" class="fixed-col">ទំនិញនាំចូល</th>
                        <th rowspan=2 style="width:50px;" class="fixed-col">ឯកតា</th>
                        <th colspan=7 >ទំនិញនាំចូលជាប់ពន្ធនិងអាករ</th>
                        <th rowspan=2 style="width:50px;">លុប</th>
                    </tr>
                    <tr>

                        <th style="width:130px;">បរិមាណ</th>
                        <th style="width:145px;">តម្លៃគិតពន្ធគយ</th>
                        <th style="width:145px;">ពន្ធនាំចូល(CD)</th>
                        <th style="width:145px;">អាករបន្ថែម(ATCD)</th>
                        <th style="width:145px;">អាករពិសេស (ST)</th>
                        <th style="width:145px;">អ.ត.ប (VAT)</th>
                        <th style="width:145px;">សរុបពន្ធ-​អាករ</th>

                    </tr>
                </thead>
                <tfoot class="f_table_input">
                    <tr>
                        <td class="fixed-col">សរុប</td>
                        <td class="fixed-col"></td>
                        <td id="count-qty"></td>
                        <td id="count-tax-base"></td>
                        <td id="count-cd"></td>
                        <td id="count-atcd"></td>
                        <td id="count-st"></td>
                        <td id="count-vat"></td>
                        <td id="count-tax-amount"></td>
                        <td></td>
                    </tr>
                </tfoot>
                <tbody>
                <?php
                $date = date("Y-m-d");
                if($this->input->get("date")){
                    $date = $this->input->get("date");
                }
                $total_oth =  $this->m_global->select_data(TBLITEM_REVENUES,array("office_code"=>$this->input->get("office"),"year"=>$year,"month"=>$month,"isbur"=>2));


                $item_revenues =  $this->m_global->select_data(TBLITEM_REVENUES,array("office_code"=>$this->input->get("office"),"year"=>$year,"month"=>$month,"isbur"=>0, 'status'=>0));
                $i = 0;
                foreach($item_revenues as $itm){
                    $unit_name_kh = $this->m_revenues->getUnitNameKHByItemID($itm->item_id);
                ?>
                    <tr class="table_input">
                        <td class="td_item fixed-col"><span class="disp"></span><?php echo selectBox($items,'id','name_kh',$itm->item_id); ?><input type="hidden" id="item_hidden" value="<?php echo($itm->item_id); ?>"></td>
                        <td class="td_i fixed-col"><span class="enum"><?php echo($unit_name_kh); ?></span><input type="hidden" name="record_id" id="record_id" value="<?php echo($itm->id); ?>"></td>
                        <td class="td_qty"><span class="disp"><?php echo num_format($itm->qty); ?></span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->qty); ?>"></td>
                        <td class="td_tax_base"><span class="disp"><?php echo num_format($itm->tax_base); ?></span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_base); ?>"></td>
                        <td class="td_cd"><span class="disp"><?php echo num_format($itm->cd); ?></span><input type="text" id="cd" name="cd" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->cd); ?>"></td>
                        <td class="td_atcd"><span class="disp"><?php echo num_format($itm->atcd); ?></span><input type="text" id="atcd" name="atcd" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->atcd); ?>"></td>
                        <td class="td_st"><span class="disp"><?php echo num_format($itm->st); ?></span><input type="text" id="st" name="st" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->st); ?>"></td>
                        <td class="td_vat"><span class="disp"><?php echo num_format($itm->vat); ?></span><input type="text" id="vat" name="vat" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->vat); ?>"></td>
                        <td class="td_tax_amount"><span class="disp"><?php echo num_format($itm->tax_amount); ?></span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_amount); ?>" ></td>

                        <td  class="td_delete"><a href="#delete" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                <?php
                    }
                ?>
                    <tr class="current table_input">
                        <td class="td_item fixed-col"><span class="disp"></span><?php echo selectBox($items,'id','name_kh'); ?><input type="hidden" id="item_hidden"></td>
                        <td class="td_i fixed-col"><span class="enum"></span><input type="hidden" name="record_id" id="record_id" value="0"></td>
                        <td class="td_qty"><span class="disp"></span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                        <td class="td_tax_base"><span class="disp"></span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                        <td class="td_cd"><span class="disp"></span><input type="text" id="tax_cd" name="tax_cd" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                        <td class="td_atcd"><span class="disp"></span><input type="text" id="tax_atcd" name="tax_atcd" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                        <td class="td_st"><span class="disp"></span><input type="text" id="tax_st" name="tax_st" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                        <td class="td_vat"><span class="disp"></span><input type="text" id="tax_vat" name="tax_vat" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                        <td class="td_tax_amount"><span class="disp"></span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0" ></td>

                        <td  class="td_save"><a href="#save" class="btn btn-xs btn-success"><i class="fa fa-save"></i></a></td>
                    </tr>
                </tbody>

            </table>
        </div>

        <div id="div_input_bur">
            <h3>១.២ ទំនិញនាំចូលពន្ធនិងអាករ ជាបន្ទុករដ្ឋ</h3>
            <table class='table table-striped table-bordered table-hover' style="width:100%;" id="table_input_bur" >
                <thead>
                <tr>
                    <th rowspan=2 style="width:180px;" class="fixed-col">ទំនិញនាំចូល</th>
                    <th rowspan=2 style="width:50px;" class="fixed-col">ឯកតា</th>
                    <th colspan=7 >ទំនិញនាំចូលពន្ធនិងអាករ ជាបន្ទុករដ្ឋ</th>
                    <th rowspan=2 style="width:50px;">លុប</th>
                </tr>
                <tr>

                    <th style="width:145px;">បរិមាណ</th>
                    <th style="width:145px;">តម្លៃគិតពន្ធគយ</th>
                    <th style="width:145px;">ពន្ធនាំចូល(CD)</th>
                    <th style="width:145px;">អាករបន្ថែម(ATCD)</th>
                    <th style="width:145px;">អាករពិសេស (ST)</th>
                    <th style="width:145px;">អ.ត.ប (VAT)</th>
                    <th style="width:145px;">សរុបពន្ធ-​អាករ</th>

                </tr>
                </thead>
                <tfoot>
                <tr class="f_table_input_bur">
                    <td class="fixed-col">សរុប</td>
                    <td class="fixed-col"></td>
                    <td id="count-qty"></td>
                    <td id="count-tax-base"></td>
                    <td id="count-cd"></td>
                    <td id="count-atcd"></td>
                    <td id="count-st"></td>
                    <td id="count-vat"></td>
                    <td id="count-tax-amount"></td>
                    <td></td>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $date = date("Y-m-d");
                if($this->input->get("date")){
                    $date = $this->input->get("date");
                }
                $item_revenues =  $this->m_global->select_data(TBLITEM_REVENUES,array("office_code"=>$this->input->get("office"),"year"=>$year,"month"=>$month,"isbur"=>1, 'status'=>0));
                foreach($item_revenues as $itm){
                    $unit_name_kh = $this->m_revenues->getUnitNameKHByItemID($itm->item_id);
                    ?>
                    <tr class="table_input_bur">
                        <td class="td_item fixed-col"><span class="disp"></span><?php echo selectBox($items,'id','name_kh',$itm->item_id); ?><input type="hidden" id="item_hidden" value="<?php echo($itm->item_id); ?>"></td>
                        <td class="td_i fixed-col"><span class="enum"><?php echo($unit_name_kh); ?></span><input type="hidden" name="record_id" id="record_id" value="<?php echo($itm->id); ?>"></td>
                        <td class="td_qty"><span class="disp"><?php echo num_format($itm->qty); ?></span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->qty); ?>"></td>
                        <td class="td_tax_base"><span class="disp"><?php echo num_format($itm->tax_base); ?></span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_base); ?>"></td>
                        <td class="td_cd"><span class="disp"><?php echo num_format($itm->cd); ?></span><input type="text" id="cd" name="cd" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->cd); ?>"></td>
                        <td class="td_atcd"><span class="disp"><?php echo num_format($itm->atcd); ?></span><input type="text" id="atcd" name="atcd" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->atcd); ?>"></td>
                        <td class="td_st"><span class="disp"><?php echo num_format($itm->st); ?></span><input type="text" id="st" name="st" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->st); ?>"></td>
                        <td class="td_vat"><span class="disp"><?php echo num_format($itm->vat); ?></span><input type="text" id="vat" name="vat" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->vat); ?>"></td>
                        <td class="td_tax_amount"><span class="disp"><?php echo num_format($itm->tax_amount); ?></span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php echo($itm->tax_amount); ?>" ></td>

                        <td  class="td_delete"><a href="#delete" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                <?php
                }
                ?>
                <tr class="current table_input_bur">
                    <td class="td_item fixed-col"><span class="disp"></span><?php echo selectBox($items,'id','name_kh'); ?><input type="hidden" id="item_hidden"></td>
                    <td class="td_i fixed-col"><span class="enum"></span><input type="hidden" name="record_id" id="record_id" value="0"></td>
                    <td class="td_qty"><span class="disp"></span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                    <td class="td_tax_base"><span class="disp"></span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                    <td class="td_cd"><span class="disp"></span><input type="text" id="tax_cd" name="tax_cd" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                    <td class="td_atcd"><span class="disp"></span><input type="text" id="tax_atcd" name="tax_atcd" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                    <td class="td_st"><span class="disp"></span><input type="text" id="tax_st" name="tax_st" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                    <td class="td_vat"><span class="disp"></span><input type="text" id="tax_vat" name="tax_vat" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0"></td>
                    <td class="td_tax_amount"><span class="disp"></span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="0" ></td>

                    <td  class="td_save"><a href="#save" class="btn btn-xs btn-success"><i class="fa fa-save"></i></a></td>
                </tr>
                </tbody>

            </table>
        </div>
        <h3>១.៣ សរុប​កម្រៃផ្សេងៗ (ទាំង​ទំនិញ​ជាប់​ពន្ធ​អាករនិង​ទំនិញពន្ធ​អាករ​ជា​បន្ទុករដ្ឋ): </h3>
    </div>
    <div  style="padding-top: 20px"></div>
    <div class="col-sm-12 col-md-12" style="padding-bottom: 20px; padding-left: 20%; padding-right: 20%">
        <input type="text" id="oth_tax" name="oth_tax" class="form-control" data-inputmask="'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true" value="<?php if($total_oth != null) {echo $total_oth[0]->tax_amount;} else echo '0'?>">
    </div>
    <input type="submit" name="submit" id="submit" class="btn btn-sm btn-success" value="បញ្ចូលទិន្នន័យ"">
    <a href="<?php echo base_url('/revenue_by_item') ?>" class="btn btn-cancel" style="background-color:#E2E2E2; margin-bottom: 20px">ចាកចេញ</a>
</form>
<div class='clear'></div>
</div>
<style>

    /*@media(min-width:768px) {*/
        /*.table-responsive>.fixed-column {*/
            /*display: none;*/
        /*}*/
    /*}*/
    .jumbotron .btn-xs {
        padding: 1px 5px;
        font-size: 14px;
        line-height: 1.5;
        border-radius: 3px;
    }
    #submit{
        margin-bottom:20px;
        }
    div.table-responsive table th, div.table-responsive table td.td_i{
        text-align:center;
        }
    div.table-responsive table td{
        vertical-align:middle;
        text-align:right;
        }
    div.table-responsive table td.td_delete{
        text-align:center;
        }
    div.table-responsive table td.td_item{
        text-align:left;
        }
    span.disp{
        display:block;
        }
    td.td_item span.disp{
        display:none;
        }
    #table_input input, #table_input select{
        display:none;
        }
    #table_input .current input, #table_input .current select, #table_input td.td_item select{
        display:block;
        }
    #table_input .current span.disp{
        display:none;
        }

    #table_input_bur input, #table_input_bur select{
        display:none;
    }
    #table_input_bur .current input, #table_input_bur .current select, #table_input_bur td.td_item select{
        display:block;
    }
    #table_input_bur .current span.disp{
        display:none;
    }
    .table-responsive{
        border-bottom:0px !important;
        }
    table{
        border:1px solid #DDD !important;
        margin-bottom:20px !important;
        }
    tfoot td{
        font-weight: bold;
        }

    @media (min-width: 768px) {
        .container {
            max-width: 1170px;
        }

    }
</style>
<script>
$(document).ready(function(e) {
    var table = $('#table_input').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging: false,
        bLengthChange: false,
        bFilter: false,
        bSort: false,
        bInfo: false,
        bAutoWidth: true,
        pageLength: 15
    });
    new $.fn.dataTable.FixedColumns(table, {
        leftColumns: 1,
      //  rightColumns: 1
    });

    var table_bur = $('#table_input_bur').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging: false,
        bLengthChange: false,
        bFilter: false,
        bSort: false,
        bInfo: false,
        bAutoWidth: true,
        pageLength: 15
    });
    new $.fn.dataTable.FixedColumns( table_bur, {
        leftColumns: 1,
       // rightColumns: 1
    });

	countRevenue('table_input');
	countRevenue('table_input_bur');

	//event
    $("#submit").click(function(e) {
        e.preventDefault();
        bootbox.dialog({
            message: "កុំពុងរក្សាទុកទិន្នន័យ ...",
            title: "សូមរង់ចាំ",
            closeButton: false
        });
        $('#table_input tr.current').each(function(){
            if($(this).find('#select-item').val()!=0){
                addItem($(this), table, table_bur);
            }
            return;
        });
        $('#table_input_bur tr.current').each(function(){
            if($(this).find('#select-item').val()!=0){
                addItem($(this), table, table_bur);
            }
            return;
        });

        $.ajax({
            type: "POST",
            url: '<?php echo base_url('input_38/addOtherTax') ?>',
            dataType: 'text',
            data: {
                itm:0,
                qty:0,
                cd:0,
                atcd:0,
                st:0,
                vat:0,
                tax_base:parseFloat(removeMask($('#oth_tax').val())),
                tax_amount:parseFloat(removeMask($('#oth_tax').val())),
                year:'<?php echo($year); ?>',
                month:'<?php echo($month); ?>',
                office_code:'<?php echo $this->input->get('office'); ?>',
                isbur:2
            },
            success: function(data){
                if(data !=''){
                    bootbox.hideAll();
                }
                else{
                    alert('Error saving data, please contact your admin!');
                }
            },
            error: function(data){
                alert('error:' + data);
            }
        });
    });

	$(document).on('keypress','#table_input td input',function(e) {
        if($(this).parent().parent().hasClass('current')==false){
            if(e.which == 13){
                e.preventDefault();
                if($(this).val()==''){
                $(this).val($(this).parent().find('span.disp').html());
                }else{
                    $(this).parent().find('span.disp').html($(this).val());
                    }

                updateItem($(this).parent().parent());
                hideElement($(this));
                showElement($(this).parent().find('span.disp'));
                countRevenue('table_input');
            }
        }
    });

    $(document).on('keypress','#table_input_bur td input',function(e) {
        if($(this).parent().parent().hasClass('current')==false){
            if(e.which == 13){
                e.preventDefault();
                if($(this).val()==''){
                    $(this).val($(this).parent().find('span.disp').html());
                }else{
                    $(this).parent().find('span.disp').html($(this).val());
                }
                bootbox.dialog({
                    message: "កុំពុងរក្សាទុកទិន្នន័យ ...",
                    title: "សូមរង់ចាំ",
                    closeButton: false
                });
                updateItem($(this).parent().parent());
                hideElement($(this));
                showElement($(this).parent().find('span.disp'));
                countRevenue('table_input_bur');
            }
        }
    });

	$(document).on( "click",'#table_input td',function(e) {
        input = $(this).find('input');
        if($(this).find('select').val()){
            input = $(this).find('select');
        }
        if(input.css('display')=='none'){
           hideElement($(this).find('span.disp'));
           showElement($(this).find('input'));
           showElement($(this).find('select'));
           input.focus();
        }
    });

    $(document).on( "click",'#table_input_bur td',function(e) {
        input = $(this).find('input');
        if($(this).find('select').val()){
            input = $(this).find('select');
        }
        if(input.css('display')=='none'){
            hideElement($(this).find('span.disp'));
            showElement($(this).find('input'));
            showElement($(this).find('select'));
            input.focus();
        }
    });

	$(document).on('focusout','#table_input td input',function(e) {
        input = $(this);

        if(input.css('display')=='block' && $(this).parent().parent().hasClass('current') == false){
           hideElement(input);
           input.val($(input).parent().find('span.disp').html());
           showElement($(input).parent().find('span.disp'));
       }
    });

    $(document).on('focusout','#table_input_bur td input',function(e) {
        input = $(this);

        if(input.css('display')=='block' && $(this).parent().parent().hasClass('current') == false){
            hideElement(input);
            input.val($(input).parent().find('span.disp').html());
            showElement($(input).parent().find('span.disp'));
        }
    });

	$(document).on('change','.DTFC_LeftBodyLiner table #select-item',function(e) {
		selects = $(this).parent().parent().parent().find('select');
		this_select = $(this);
		hidden_input = $(this).parent().find('input');
		count = 0;
		$(selects).each(function(index, element) {
            if($(this_select).val()==$(element).val()){
				count=count+1;
            }
        });
		if(count>=2){
			$(this).val('0');
            $(this).parent().parent().parent().parent().parent().parent().parent().parent().find('.dataTables_scroll .current #select-item option[value='+0+']').attr('selected','selected');
//            alert('មិនអាចបញ្ចូលទំនិញដែលបានបញ្ចូលរួចហើយម្តងទៀតទេ!');
            bootbox.dialog({
                message: "មិនអាចបញ្ចូលទំនិញដែលបានបញ្ចូលរួចហើយម្តងទៀតទេ!",
                title: "ការព្រមាន",
                buttons: {
                    success: {
                        label: "OK",
                        className: "btn-success",
                        callback: function () {
                        }
                    }
                }
            });
        }else{
            $(this).parent().parent().parent().parent().parent().parent().parent().parent().find('.dataTables_scroll .current #select-item option[value='+$(this).val()+']').attr('selected','selected');
            $(this).parent().parent().parent().parent().parent().parent().parent().parent().find('.dataTables_scroll .current #item_hidden').val($(this).val());
            setUnitName(this_select);
        }
    });

	$(document).on('click','td.td_delete a',function(e){
		e.preventDefault();
		if(!$(this).parent().parent().hasClass('current')){
            var cur_tr = $(this).parent().parent();
            bootbox.dialog({
                message: "កុំពុងលុបទិន្នន័យ ...",
                title: "សូមរង់ចាំ",
                closeButton: false
            });
            if(cur_tr.hasClass('table_input')){
                table.row(cur_tr).remove().draw();
                deleteItem($(this).parent().parent());
                countRevenue('table_input');
            }else if(cur_tr.hasClass('table_input_bur')){
                table_bur.row(cur_tr).remove().draw();
                deleteItem($(this).parent().parent());
                countRevenue('table_input_bur');
            }

        }
    });

    $(document).on('click','td.td_save a',function(e){
        e.preventDefault();
        if($(this).parent().parent().find('#select-item').val() == 0){
//            alert('សូមជ្រើសរើសទំនិញមុននិងធ្វើការចុះឈ្មោះ');
            bootbox.dialog({
                message: "សូមជ្រើសរើសទំនិញមុននិងធ្វើការចុះឈ្មោះ",
                title: "ការព្រមាន",
                buttons: {
                    success: {
                        label: "OK",
                        className: "btn-success",
                        callback: function () {
                        }
                    }
                }
            });
        }else{
            bootbox.dialog({
                message: "កុំពុងរក្សាទុកទិន្នន័យ ...",
                title: "សូមរង់ចាំ",
                closeButton: false
            });
            addItem($(this).parent().parent(), table, table_bur);
        }
    });

	$(document).on('change','#select-month',function(e){
		if($(this).val()!='0' && $('select-year').val()!='0'){
			window.location = '<?php echo base_url('input_38') ?>'+'?office=<?php echo $this->input->get('office'); ?>'+'&m=' + $(this).val()+'&y='+$('#select-year').val();
			}
		});
	$(document).on('change','#select-year',function(e){
		if($(this).val()!='0' && $('select-month').val()!='0'){
			window.location = '<?php echo base_url('input_38') ?>'+'?office=<?php echo $this->input->get('office'); ?>'+'&y=' + $(this).val()+'&m='+$('#select-month').val();
			}
		});
});
function hideIputCurrentRow(c){
    $(c).find('input').css('display','none');
    $(c).find('select').css('display','none');
}
function showElement(c){
	$(c).css('display','block');
	}
function hideElement(c){
	$(c).css('display','none');
}
function setFloatValue(element,val){
	$(element).val(parseFloat(val).format(0,3,',','.'))
}
function FromInputToDisplay(row){
    location.reload();
}
function newRow(isBur){
    var r = '';
    if(isBur == 0){
        r += '<tr class="current table_input">';
    }else{
        r += '<tr class="current table_input_bur">';
    }
    r += '<td class="td_item"><span class="disp"></span><?php echo selectBox($items,'id','name_kh'); ?><input type="hidden" id="item_hidden"></td>';
    r += '<td class="td_i"><span class="enum"></span><input type="hidden" name="record_id" id="record_id" value="0"></td>';
    r += '<td class="td_qty"><span class="disp"></span><input type="text" id="qty" name="qty" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
    r += '<td class="td_tax_base"><span class="disp"></span><input type="text" id="tax_base" name="tax_base" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
    r += '<td class="td_cd"><span class="disp"></span><input type="text" id="cd" name="cd" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
    r += '<td class="td_atcd"><span class="disp"></span><input type="text" id="atcd" name="atcd" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
    r += '<td class="td_st"><span class="disp"></span><input type="text" id="st" name="st" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
    r += '<td class="td_vat"><span class="disp"></span><input type="text" id="vat" name="vat" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
    r += '<td class="td_tax_amount"><span class="disp"></span><input type="text" id="tax_amount" name="tax_amount" class="form-control" data-inputmask="\'alias\': \'decimal\', \'groupSeparator\': \',\', \'autoGroup\': true" value="0"></td>';
    r += '<td  class="td_save"><a href="#save" class="btn btn-xs btn-success"><i class="fa fa-save"></i></a></td>';
    r += '</tr>';
	return r;
}

function addItem(c, table, table_bur){
    var isbur = 0;
    if(c.hasClass('table_input')){
        isbur = 0;
    }else if(c.hasClass('table_input_bur')){
        isbur = 1;
    }
	if(c.length>0){
        var url='<?php echo base_url('input_38/addItem') ?>';
        $.ajax({
                type: "POST",
                url: url,
                dataType: 'text',
                data: {
                    itm:c.find('#item_hidden').val(),
                    qty:parseFloat(removeMask(c.find('td.td_qty').find('input').val())),
                    cd:parseFloat(removeMask(c.find('td.td_cd').find('input').val())),
                    atcd:parseFloat(removeMask(c.find('td.td_atcd').find('input').val())),
                    st:parseFloat(removeMask(c.find('td.td_st').find('input').val())),
                    vat:parseFloat(removeMask(c.find('td.td_vat').find('input').val())),
                    tax_base:parseFloat(removeMask(c.find('td.td_tax_base').find('input').val())),
                    tax_amount:parseFloat(removeMask(c.find('td.td_tax_amount').find('input').val())),
                    year:'<?php echo($year); ?>',
                    month:'<?php echo($month); ?>',
                    office_code:'<?php echo $this->input->get('office'); ?>',
                    isbur:isbur
                },
                success: function(data){
                    if(data !='error'){
                        var row = newRow(isbur);
                        if(isbur == 0){
                            table.row(c).remove().draw();
                            table.row.add($(data)).draw();
                            table.row.add($(row)).draw();
                            countRevenue('table_input');
                        }else{
                            table_bur.row(c).remove().draw();
                            table_bur.row.add($(data)).draw();
                            table_bur.row.add($(row)).draw();
                            countRevenue('table_input_bur');
                        }
                        $(":input").inputmask();
                        bootbox.hideAll();
                    }
                    else{
                        //alert('Error saving data, please contact your admin!');
                    }
                },
                error: function(data){
                    alert('error:' + data);
                }
            });
		}
	}
function updateItem(c){
    var isbur = 0;
    if(c.hasClass('table_input')){
        isbur = 0;
    }else if(c.hasClass('table_input_bur')){
        isbur = 1;
    }
	if(c.length>0){
	var url='<?php echo base_url('input_38/updateItem') ?>';
	$.ajax({
			type: "POST",
			url: url,
			dataType: 'text',
			data: {
                id:c.find('td.td_i').find('input#record_id').val(),
                qty:parseFloat(removeMask(c.find('td.td_qty').find('input').val())),
                cd:parseFloat(removeMask(c.find('td.td_cd').find('input').val())),
                atcd:parseFloat(removeMask(c.find('td.td_atcd').find('input').val())),
                st:parseFloat(removeMask(c.find('td.td_st').find('input').val())),
                vat:parseFloat(removeMask(c.find('td.td_vat').find('input').val())),
                tax_base:parseFloat(removeMask(c.find('td.td_tax_base').find('input').val())),
                tax_amount:parseFloat(removeMask(c.find('td.td_tax_amount').find('input').val())),
            },
			success: function(data){
				if(data !=''){
                    bootbox.hideAll();
                }
			},
			error: function(data){
				alert('error:' + data);
				location.reload();
            }
		});
    }
}
function deleteItem(row){
	c = $(row);
	if(c.length>0){
        id = c.find('td.td_i').find('input#record_id').val();
        var url='<?php echo base_url('input_38/deleteItem') ?>';
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'text',
            data: {id:id},
            success: function(data){
                if(data !=''){
                    //location.reload();
                    //alert(data);
                    bootbox.hideAll();
                }
            },
            error: function(data){
                alert('error:' + data);
            //	location.reload();
            }
		});
    }
}
function setUnitName(item_box){
	ic = $(item_box);
    ib = item_box.parent().parent().parent().parent().parent().parent().parent().parent().parent().find('.dataTables_scrollBody .current');
//    ib = $('.dataTables_scrollBody .current');
	if(ic.val()>0){
        item_id = ic.val();
        var url='<?php echo base_url('input_38/getUnitName') ?>';
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'text',
            data: {item_id:item_id},
            success: function(data){
                if(data !=''){
                    $(ib).find('td.td_i span.enum').html(data);
                }
            },
            error: function(data){
                alert('error:' + data);
            }
        });
    }else{
        $(ib).find('td.td_i span.enum').html('');
    }
}
function countRevenue(table){
	$('.dataTables_scrollFootInner .f_'+table+' #count-qty').html(countEach('#'+table+' td.td_qty','input#qty'));
	$('.dataTables_scrollFootInner .f_'+table+' #count-tax-base').html(countEach('#'+table+' td.td_tax_base','input#tax_base'));
	$('.dataTables_scrollFootInner .f_'+table+' #count-cd').html(countEach('#'+table+' td.td_cd','input#cd'));
	$('.dataTables_scrollFootInner .f_'+table+' #count-atcd').html(countEach('#'+table+' td.td_atcd','input#atcd'));
	$('.dataTables_scrollFootInner .f_'+table+' #count-st').html(countEach('#'+table+' td.td_st','input#st'));
    $('.dataTables_scrollFootInner .f_'+table+' #count-vat').html(countEach('#'+table+' td.td_vat','input#vat'));
	$('.dataTables_scrollFootInner .f_'+table+' #count-tax-amount').html(countEach('#'+table+' td.td_tax_amount','input#tax_amount'));
}
function toFloat(text){
	t = text.replace(/,/g, "");
	return parseFloat(t);
}
function countEach(c,input){
	count = 0;
	$(c).each(function(index) {
	  if(!$(this).parent().hasClass('current')){
	  	//alert(toFloat($(this).find('input#qty').val()));
	  	count = count + toFloat($(this).find(input).val())
	  }
	});
	return num_format(count);
}
function num_format(num){
		var n = num.toString();
		if(n.indexOf('.')===-1){
			return num.format(0,3,',','.');
		}else{
			return num.format(2,3,',','.');
		}
	}

</script>
