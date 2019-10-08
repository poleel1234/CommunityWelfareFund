<?php
session_start();
include "connect_db.php";
?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label class="col-md-4 control-label" style="text-align:left;"></label>
            <div class="col-md-3">             
                <a class='senddatamodal btn btn-success'>
                    เพิ่มรายชื่อผู้กู้ร่วม
                </a>
            </div>
        </div>
    </div>
</div><br>

<script>
        $(".senddatamodal").click(function () {
            $('#myModal').modal('show');
//            $('#myModal').modal('hide');            
            $.ajax({
                url: 'petition_view.php',
                type: "GET",
                success: function (data) { //Complete
                    $(".modal-body-view").empty();
                    $(".modal-body-view").html(data);
                }
            });
        });
        $(document).on("click","#add-list",function() {
            var mem_id = $("#mem_id-vv").val();
            var mode = 'add';
            $.ajax({
              url: 'petition_add.php',
              type: "GET",
              data:{mem_id,mode},
              success: function (data) { //Complete
                  $.ajax({
                    url: 'petition_view.php',
                    type: "GET",
                    success: function (data) { //Complete
                        $(".modal-body-view").empty();
                        $(".modal-body-view").html(data);
                    }
                });
              }
            });
      });  
      $(document).on("click",".del-list",function() {
            var mem_id = $(this).attr('data-id');
            var mode = 'del';
            $.ajax({
              url: 'petition_add.php',
              type: "GET",
              data:{mem_id,mode},
              success: function (data) { //Complete
                  $.ajax({
                    url: 'petition_view.php',
                    type: "GET",
                    success: function (data) { //Complete
                        $(".modal-body-view").empty();
                        $(".modal-body-view").html(data);
                    }
                });
              }
            });
      });  
</script>
<?php
//include 'footer.php';
?>