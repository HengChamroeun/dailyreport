<center>
<div id="table_preview">
<?php
$print=$this->input->get('print');
 if($print!="true"){ ?>
<div class="action_menu" style=" padding-top:9px;position:fixed;top:0px;width:930px;text-align:left;padding-left:40px;height:40px;background:#FFF;margin-top:0px auto;margin-bottom:70px;border-bottom:1px solid #ccc;">
<a class="btn btn-warning" href="<?php echo base_url() ?>" id="print_btn"><i class="icon-backward icon-white"></i>Back</a> 
&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success" href="#" id="print_btn" onClick="return PrintReport();"><i class="icon-print icon-white"></i>Print</a> 
 
</div>
<?php }else{ ?>
	<script>
		setTimeout(function(){window.print()}, 1000);
	</script>
<?php } ?>
<table class="tbl" id="ReportTable">
	<center><h2>PROFESSIONAL BACKGROUND</h2></center>
	<br/>
	<tr class="row_blank">
		<td rowspan=40 style="vertical-align:top;"><img src="<?php echo base_url('assets/files/sophannareth.jpg') ?>"></td>
		<td style="min-width:200px;">Full Name :</td>
		<td><b>NOY Sophannareth -<span class="row_simpleKH"> ណយ សុផាន់ណារិទ្ធ </span></b></td>
	</tr>
	<tr class="row_blank">
		<td>Gender :</td>
		<td>Male</td>
	</tr>
	<tr class="row_blank">
		<td>Year of Birth :</td>
		<td>1991</td>
	</tr>
	<tr class="row_blank">
		<td>Nationality :</td>
		<td>Cambodian</td>
	</tr>
	<tr class="row_blank">
		<td>Location of Residence :</td>
		<td>Kandal Provice</td>
	</tr>
	<tr class="row_blank">
		<td>Mobile :</td>
		<td>(+855-69)801848 / (+855-17)553288</td>
	</tr>
	<tr class="row_blank">
		<td>Address :</td>
		<td>#9E1, St. 161, Phumi 3, Sangkat VealVong, Khan 7 Makara, Phnom Penh City, Cambodia</td>
	</tr>
	<tr class="row_blank">
		<td>Email :</td>
		<td>sophannarethnoy@gmail.com</td>
	</tr>
	<tr class="row_blank">
		<td>Website :</td>
		<td><a href="http://www.jol70.com">www.Jol70.com</a>, <a href="http://www.camboevent.com">www.CamboEvent.com</a></td>
	</tr>
	<tr>
		<td colspan=2><b>QUALIFICATIONS</b></td>
	</tr>
	<tr class="row_blank">
		<td>Oct-01-2009 - Oct-01-2013</td>
		<td>Bachelor's Degree of Education in TEFL, National Institute of Business, Phnom Penh</td>
	</tr>
	<tr class="row_blank">
		<td>Oct-01-2009 - Oct-01-2013</td>
		<td>Bachelor's Degree of Computer Science majoring in Web Application Development, Norton University, Phnom Penh</td>
	</tr>
	<tr >
		<td colspan=2><b>LANGUAGES</b></td>
	</tr>
	<tr class="row_blank">
		<td>Khmer</td>
		<td>Mother Tongue</td>
	</tr>
	<tr class="row_blank">
		<td>English</td>
		<td>Excellent</td>
	</tr>
	<tr class="row_blank">
		<td>Japanese</td>
		<td>Beginner</td>
	</tr>
	<tr >
		<td colspan=2><b>TRAINING COURSES</b></td>
	</tr>
	<tr class="row_blank">
		<td>Feb-12-2012 - Apr-30-2012</td>
		<td>Primary Customs and Excise Training Course Batch 17, General Department of Customs and Excise of Cambodia, Phnom Penh</td>
	</tr>
	<tr class="row_blank">
		<td>Dec-2011 - May-2012</td>
		<td>TESOL Program Promotion 22 with successful certification, Sovannaphumi Training Center, Phnom Penh</td>
	</tr>
	
	<tr >
		<td colspan="2"><b>WORK EXPERIENCE</b></td>
	</tr>
	<tr class="row_blank">
		<td>Dec-01-2014 - Present</td>
		<td>National Project Team member(NPT), ASYCUDA team of GDCE, Phnom Penh</td>
	</tr>
	<tr class="row_blank">
		<td>Aug-21-2014 - Present</td>
		<td>Customs and Excise Trainee at International Airport Customs and Excise Branch, GDCE, Phnom Penh</td>
	</tr>
	<tr class="row_blank">
		<td>Nov-27-2013 - Jan-31-2014</td>
		<td>Intern as Web Application Developer at KhmerDEV, Phnom Penh</td>
	</tr>
	<tr class="row_blank">
		<td>Jan-01-2013 - Nov-23-2013</td>
		<td>Intern as Web Application Developer on project <b>Statistics Application and Website Development</b>, Ministry of Agriculture, Forestry and Fisheries, Phnom Penh</td>
	</tr>
	<tr class="row_blank">
		<td>Feb-27-2012 - Apr-10-2014</td>
		<td>Part-time Teacher of English, Advanced Level, ASEAN International School, Phnom Penh</td>
	</tr>
	<tr class="row_blank">
		<td>Apr-2010 - Sep-2011</td>
		<td>Part-time Teacher of English, Intermediate Level, CT. Mordok Language School, Phnom Penh</td>
	</tr>
	<tr class="row_blank">
		<td>Apr-01-2010 - Apr-01-2011</td>
		<td>IT Technician, Network and IT facility connections, YongFa Computer</td>
	</tr>
	<tr class="row_blank">
		<td>Apr-2007 - Apr-2008</td>
		<td>Part-time Teacher of English, Human Rights and Human Resources Development Institute, Kandal</td>
	</tr>
	<tr >
		<td colspan="2"><b>INTERNATIONAL EXPERIENCE</b></td>
	</tr>
	<tr class="row_blank">
		<td>Jul-7-2008 - Jul-17-2008</td>
		<td><b><a href="http://sv2.jice.org/jenesys/e/about-jenesys/about-program/" target="_blank">JENESYS Programme</a></b> batch 2,Tokyo-Gifu, Japan</td> 
	</tr>
	<tr>
		<td colspan="2"><b>SKILLS</b></td>
	</tr>
	<tr class="row_blank">
		<td>Web Development</td>
		<td>Languages: HTML, CSS, Javascript, Jquery, Ajax, PHP</td>
	</tr>
	<tr class="row_blank">
		<td></td>
		<td>CMS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Joomla, Wordpress</td>
	</tr>
	<tr class="row_blank">
		<td></td>
		<td>Framework: CodeIgniter</td>
	</tr>
	<tr class="row_blank">
		<td></td>
		<td>ASP.NET&nbsp;&nbsp;&nbsp;&nbsp;: using C#</td>
	</tr>
	<tr class="row_blank">
		<td>Desktop Application :</td>
		<td>C# , VB.Net</td>
	</tr>
	<tr class="row_blank">
		<td>Database :</td>
		<td>MySQL, SQL Server, Oracle 11g</td>
	</tr>
	<tr class="row_blank">
		<td>Leadership :</td>
		<td>Task assignment, meeting coordination, staff motivation</td>
	</tr>
	<tr>
		<td colspan=2><b>HOBBIES</b></td>
	</tr>
	<tr class="row_blank">
		<td></td>
		<td>Travel, listen to music, play football...</td>
	</tr>
	
		
	
	 

	

	
</table>
</div>
</center>
<style>
	body{background:#F0F0F0;font-family:Arial;text-shadow:none;padding:0px;}
	#table_preview{background:#FFF;width:970px;padding-top:70px;padding-bottom:40px;}
	.tbl{width:85%;text-align:left;}
	.tbl img{max-width:120px;}
	.tbl th,.tbl td{border-collapse:collapse;border:1px solid #A8A8A8 ; vertical-align:top;padding:4px;}
	.tbl .bold_title{font-family: Khmer OS Muol Light,Khmer OS Muol}
	.tbl .row_report_title{font-family: Khmer OS Muol Light,Khmer OS Muol;text-decoration:underline;}
	.tbl .row_blank td{border:0px;}
	.tbl .row_simpleKH{font-family:Khmer OS Metal Chrieng;}
	.tbl .row_column_title td{text-transform:uppercase;font-weight:bold;}
	.tbl td.right{text-align:right;}
	.hide{display:none;}
	.show{display:inline;}
</style>
<script>
//var i = 0;
// $( "div.action_menu" )
  // .mouseover(function() {
    // $('#export_btn').removeClass('hide');
    // $('#export_btn').addClass('show');
	// $('#print_btn').removeClass('hide');
    // $('#print_btn').addClass('show');
  // })
  // .mouseout(function() {
    // $('#export_btn').removeClass('show');
    // $('#export_btn').addClass('hide');
	// $('#print_btn').removeClass('show');
    // $('#print_btn').addClass('hide');
  // });
 // function PrintReport(){
	// $('#export_btn').removeClass('show');
    // $('#export_btn').addClass('hide');
	// $('#print_btn').removeClass('show');
    // $('#print_btn').addClass('hide');
	// if($( "#export_btn" ).hasClass( "hide" )==true && $( "#export_btn" ).hasClass( "hide" )==true){
		// window.print();
	// }
	// return false;
 // }
 function PrintReport(){
	//alert(document.URL);
	OpenInNewTab(document.URL+'?print=true');
 }
 function OpenInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}
</script>
<script language="VBScript">
// THIS VB SCRIP REMOVES THE PRINT DIALOG BOX AND PRINTS TO YOUR DEFAULT PRINTER
Sub window_onunload()
On Error Resume Next
Set WB = nothing
On Error Goto 0
End Sub

Sub Print()
OLECMDID_PRINT = 6
OLECMDEXECOPT_DONTPROMPTUSER = 2
OLECMDEXECOPT_PROMPTUSER = 1


On Error Resume Next

If DA Then
call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1)

Else
call WB.IOleCommandTarget.Exec(OLECMDID_PRINT ,OLECMDEXECOPT_DONTPROMPTUSER,"","","")

End If

If Err.Number <> 0 Then
If DA Then 
Alert("Nothing Printed :" & err.number & " : " & err.description)
Else
HandleError()
End if
End If
On Error Goto 0
End Sub

If DA Then
wbvers="8856F961-340A-11D0-A96B-00C04FD705A2"
Else
wbvers="EAB22AC3-30C1-11CF-A7EB-0000C05BAE0B"
End If

document.write "<object ID=""WB"" WIDTH=0 HEIGHT=0 CLASSID=""CLSID:"
document.write wbvers & """> </object>"
</script>
<script language='VBScript'>
Sub Print()
       OLECMDID_PRINT = 6
       OLECMDEXECOPT_DONTPROMPTUSER = 2
       OLECMDEXECOPT_PROMPTUSER = 1
       call WB.ExecWB(OLECMDID_PRINT, OLECMDEXECOPT_DONTPROMPTUSER,1)
End Sub
document.write "<object ID='WB' WIDTH=0 HEIGHT=0 CLASSID='CLSID:8856F961-340A-11D0-A96B-00C04FD705A2'></object>"
</script>