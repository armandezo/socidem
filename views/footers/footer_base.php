    <script src="views/assets/js/popper.min.js"></script>
    <script src="views/assets/js/bootstrap.min.js"></script>
    <!-- <script src="views/assets/js/scripts/crop.js"></script> -->
    <script src="views/assets/js/slick.js"></script>
    <script src="views/assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="views/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
    <script src="views/assets/js/circle-progress.min.js"></script>
    <script src="views/assets/plugins/select1/js/select2.min.js"></script>
    <script src="views/assets/plugins/fancybox/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script src="views/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
    <script src="views/assets/js/profile-settings.js"></script>
    <script src="views/assets/js/jplist/jplist.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.0.0/cropper.min.js"></script> -->
    <script src="views/assets/js/scripts/ajax.js"></script>
    <script src="views/assets/js/scripts/init.js"></script>
    <script src="views/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="views/assets/plugins/datatables/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/es.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
    <script src="views/assets/plugins/timepicker/js/timepicker.js"></script>
    <script src="views/assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="views/assets/js/scripts/scripts.js"></script>
<script src="views/assets/js/scripts/dash.js"></script>

    <script>

    </script>

    <?php 
  
  switch ($rol_) {
    case 1:
        if($estado_ == 0){
          echo '
          <script>
            $(document).ready(function(){
             $("#perfilMed").modal("show");
            });
          </script>
          ';
           
        }else {
            
        }
    break; 
  } 
  ?>