<?php 
	session_start();

	include('Classes/connection_pdo.php');

	$_SESSION['ro10app'] = "puwadon.sa@jasmine.com";



	if(isset($_GET["id"])){
	   	$id = $_GET["id"];
   	}
    $db = new DB();

	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Bootstrap 101 Template</title>
	<!-- Datatable CSS -->
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.2/css/bootstrap.css">  
	  	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap4.min.css">  
	  	<link rel="stylesheet" charset="utf8" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">  
	  	<link rel="stylesheet" charset="utf8" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">  
	  	<link rel="stylesheet" charset="utf8" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">  

	  <!-- Bootstrap Theme -->  
	  	<link href="lumen/bootstrap.css" rel="stylesheet">  
	  	<link href="2/css/font-awesome.min.css" rel="stylesheet">  
	  	<link href="2/css/bootswatch.css" rel="stylesheet">  

	  <!-- JQUERY -->  
	  	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.3.js"></script>
	  <!--JQUERY Bootstrap theme -->  
	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	  <!-- DataTable -->  
	  	<script type="text/javascript" charset="utf8"  src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	  	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap4.min.js"></script>
	  	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
	  	<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
	  	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
	  	<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>

	  <!--Button Datatable-->  
	  	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.flash.min.js"></script>
	  	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
	  	<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
	  	<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
	  	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
	  	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
      <script type="text/javascript" src="js/jquery.checkAll.js"></script>
		<script>
      
      /* checkbox #1 */
      function check_all(){
        var check_all = document.getElementById("check_all");
        var row_list = document.getElementsByClassName("checkboxlist");

        if(check_all.checked){
          for(var i = 0;i < row_list.length; i++){
            row_list[i] = checked = true;
          }
        }else {
          for(var i = 0;i < row_list.length; i++){
            row_list[i] = checked = false;
          }
        }
      }

      /* After scroll (Optional)*/
      // function update() {
      //   if ($(window).scrollTop() > 200) {
      //       $('.signup_scroll').animate({
      //           "bottom": '0px'
      //       }, 200);
      //   } else {
      //         $('.signup_scroll').animate({
      //             "bottom": '-45px'
      //         }, 500);
      //   }
      // }
      // setInterval(update, 500);

			$(document).ready(function(){

        // Array holding selected row IDs
        var rows_selected = [];
				// English menu --> Thai menu เพิ่มส่วนนี้เข้าไปจะถือว่าเป็นการตั้งค่าให้ Datatable เป็น Default ใหม่เลย
        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
              "sProcessing": "กำลังดำเนินการ...",
              "sLengthMenu": "แสดง_MENU_ แถว",
              "sZeroRecords": "ไม่พบข้อมูล",
              "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
              "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
              "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
              "sInfoPostFix": "",
              "sSearch": "ค้นหา:",
              "sUrl": "",
              "oPaginate": {
                            "sFirst": "เิริ่มต้น",
                            "sPrevious": "ก่อนหน้า",
                            "sNext": "ถัดไป",
                            "sLast": "สุดท้าย"
              }
            }
        });

        // Datatable Function
        var table = $('#example').DataTable({
          "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
          scrollY:   '50vh',
          scrollCollapse: true,
          paging: false,
          'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'orderable': false,
            'width': '1%'
          }],
          'order': [[1, 'asc']],
        });
      });

      //Button Function disable submit button before tik checkbox
      $(function() {
        var chk = $('.check');
        var btn = $('#btncheck');

        chk.on('change', function() {
          btn.prop("disabled", !this.checked);//true: disabled, false: enabled
        }).trigger('change'); //page load trigger event
      });
      //Button Function go back to previous page
      function goBack() {
        window.history.back();
      }
   
	</script>
	<style>
      .bg-white{
        background-color: #FFFFFF;
      }
      .logo-box{
        height: 27px;

      }
      .search-button{
        padding-top: 23px;
      }
      .margin-side{
        margin: 0px 15px;
      }
      thead{
        background-color:white;
      }
      .navbar-fixed {
        top: 0;
        z-index: 100;
      position: fixed;
        width: 100%;
      }
      #nav_bar {
        border: 0;
        background-color: #ffffff;
        border-radius: 0px;
        margin-bottom: 0;
      }
      td.details-control {
          background: url('images/resources/open.png') no-repeat center center;
          cursor: pointer;
      }
      tr.shown td.details-control {
          background: url('images/resources/close.png') no-repeat center center;
      }
      .padding-small{
        padding: 15px;
      }
      tfoot input {
          width: 100%;
          padding: 3px;
          box-sizing: border-box;
      }
      table.dataTable.select tbody tr,
      table.dataTable thead th:first-child {
        cursor: pointer;
      }
      #footer {
       position: fixed;
      left: 0px;
      bottom: 0px;
      height: 45px;
      width: 100%;
      margin-bottom: -1px;
      background-color: #E5E8E8;
      z-index: 1000;
      color:gray;
      }

      /* IE 6 */
      * html #footer {
         position:absolute;
         top:expression((0-(footer.offsetHeight)+(document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight)+(ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop))+'px');
      }

  </style>
</head>
<body>
	<?php 

    include_once('header.php');

    $sql = "SELECT * FROM project where status = '0' ";
    $query = $db->query($sql);
    $query = $db->bind(":status","0");
    $query = $db->execute();
    $query = $db->fetch();
  ?>
  <form action="manageproject_1.php" method="post" role="form" autocomplete="off"  accept-charset="utf-8">
  <div class="container-fluid" style="margin-bottom:40px;display:block;">
    <div class="row">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-warning margin-side" >
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title"> <strong>รายการจัดสรรข้อมูลโครงการ</strong>
            </h4>
          </div>
          <div class="panel-body" role="tab" id="panel-body">
            <table id="example" class="display table table-striped table-bordered" width="100%" cellspacing="0">
             <thead>
                <tr>
                  <th class="no-sort" style="text-align: center">
                    <input class="check check-all" type="checkbox"  name="check_all" id="check_list" ></th>
                  <th align='center' style="max-width:90px;">Location code</th>
                  <th align='center' style="max-width:120px;">Location</th>
                  <th align='center' >ชื่อโครงการ</th>
                  <th align='center' style="max-width:90px;">จังหวัด</th>
                  <th align='center' style="max-width:90px;">เขต/อำเภอ</th>
                  <th align='center' style="max-width:90px;">แขวง/ตำบล</th>
                  <th align='center' >ที่อยู่</th>
                  <th align='center' style="max-width:75px;">ประเภท</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    foreach ($query as $key=> $result) {
                      
                      $id = $result["id"];
                      $location_code = $result["location_code"];
                      $project_name = $result["project_name"];
                      $province = $result["province"];
                      $district =$result["district"];
                      $address = $result["address"];
                      $builder = $result["builder"];
                      $sub_district =  $result["sub_district"];
                      $location_lat_long = $result["location_lat_long"];
                      $location_name = $result["location_name"];
                      $node_nearby = $result["node_nearby"];
                      $remark =  $result["remark"];
                      $type = $result["type"];
                      $status = $result["status"] ;
                    
                    ?>
                <tr>
                  <td style="width: 20px;" align="center">
                    <input type="checkbox" name="checkboxlist[]" class="check" value="<?php echo $id; ?>"></td>
                  <td>
                    <?php echo $location_code;?></td>
                  <td>
                    <?php echo $location_lat_long; ?></td>
                  <td>
                    <?php echo $project_name; ?></td>
                  <td>
                    <?php echo $province; ?></td>
                  <td>
                    <?php echo $district; ?></td>
                  <td>
                    <?php echo $sub_district; ?></td>
                  <td>
                    <?php echo $address; ?></td>
                  <td>
                    <?php echo $type;?></td>
                </tr>

                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th align='center' style="max-width:90px;">Location code</th>
                  <th align='center' style="max-width:120px;">Location</th>
                  <th align='center' >ชื่อโครงการ</th>
                  <th align='center' style="max-width:90px;">จังหวัด</th>
                  <th align='center' style="max-width:90px;">เขต/อำเภอ</th>
                  <th align='center' style="max-width:90px;">แขวง/ตำบล</th>
                  <th align='center' >ที่อยู่</th>
                  <th align='center' style="max-width:75px;">ประเภท</th>
                </tr>
              </tfoot>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer id="footer" class="navbar navbar-default signup_scroll" style="margin-bottom:0px;">
    <div class="container-fluid">
      <div style="width:100%;float:left;display:block;">
        <div class="form-group form-inline">
          <div class="" style="float:left;">
            <label style="margin-right:15px;">
              ผู้รับผิดชอบโครงการ
              <input type="text" class="form-control input-md" value="นายณรงค์ศักดิ์ วงเดช" placeholder="ชื่อผู้รับผิดชอบ" readonly />        
            </label>
          </div>
          <div class="" style="float:left;">
            <div class="form-group">
              <label style="margin-right:15px;">รหัสพนักงาน</label>
              <input type="text" class="form-control input-md" value="11233" placeholder="ชื่อผู้รับผิดชอบ" readonly />        
            </div>
          </div>
          &nbsp;&nbsp;
          <ul class="nav navbar-nav navbar-right">
            <li>
              <input type="submit" id="btncheck" class="btn btn-success" style="width:120px;" value="เลือก" />        
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  </form>

  <?php
    //Old condition checkbox (Don't use it)
    // if(isset($_POST["submit"])){
    //   if(!empty($_POST["checkboxlist"])){
    //     echo "selected!!";
    //     foreach ($_POST["checkboxlist"] as $checkbox) {
    //       echo "<h1>".$checkboxlist."</h1>" ;
    //     }
    //   }else{
    //     echo "please select";
    //   }
    // }

  ?>  
</body>
</html>
