//  var uploadCrop,
//      tempFilename,
//      rawImg,
//      imageId;

//  function readFile(input) {

//      if (input.files && input.files[0]) {
//          var reader = new FileReader();
//          reader.onload = function(e) {
//              $('.upload-demo').addClass('ready');
//              $('#cropImagePop').modal('show');
//              rawImg = e.target.result;
//          }
//          reader.readAsDataURL(input.files[0]);
//      } else {
//          swal("Sorry - you're browser doesn't support the FileReader API");
//      }
//  }

//  var uploadCrop = $('#upload-demo').croppie({
//      viewport: {
//          width: 150,
//          height: 200,
//      },
//      enforceBoundary: false,
//      enableExif: true
//  });
//  $('#cropImagePop').on('shown.bs.modal', function() {
//      // alert('Shown pop');
//      uploadCrop.croppie('bind', {
//          url: rawImg
//      }).then(function() {
//          console.log('jQuery bind complete');
//      });
//  });

//  $('.item-img').on('change', function() {

//      let imageId = $(this).data('id');
//      let tempFilename = $(this).val();
//      $('#cancelCropBtn').data('id', imageId);
//      readFile(this);
//  });
//  $('#cropImageBtn').on('click', function(ev) {
//      uploadCrop.croppie('result', {
//          type: 'base64',
//          format: 'jpeg',
//          backgroundColor: "#ffffff",
//          size: { width: 300, height: 300 }
//      }).then(function(resp) {
//          //  $('#preview').attr('src', resp);


//          //  var imageData = canvas.toDataURL('image/jpg');
//          //  document.getElementsByName("foto_crop")[0].setAttribute("value", resp);

//          //  $('#cropImagePop').modal('hide');
//      });
//  });