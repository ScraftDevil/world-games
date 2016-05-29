<?php
if (!isset($pathUploaderPHP)) {
  $pathUploaderPHP = "../../../view/sections/uploader/";
}
if (!isset($pathUpload)) {
  $pathUpload = "uploads";
}
if (!isset($uploadText)) {
  $uploadText['textUploadBtn'] = "Choose File";
  $uploadText['textUploadBtnRetry'] = "Choose Another File";
}
?>
<script src="<?php echo $pathUploaderPHP; ?>/js/simpleAjaxUploader.js"></script>
  <div class="row">
    <button id="uploadBtn" class="btn btn-large btn-primary"> <?php echo $uploadText['textUploadBtn'];?></button>
    <div class="col-xs-10">
      <div id="progressOuter" class="progress progress-striped active" style="display:none;">
        <div id="progressBar" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-10">
      <div id="msgBox">
      </div>
    </div>
  </div>
<script>
  function escapeTags( str ) {
    return String( str )
    .replace( /&/g, '&amp;' )
    .replace( /"/g, '&quot;' )
    .replace( /'/g, '&#39;' )
    .replace( /</g, '&lt;' )
    .replace( />/g, '&gt;' );
  }
  window.onload = function() {
    var btn = document.getElementById('uploadBtn'),
    progressBar = document.getElementById('progressBar'),
    progressOuter = document.getElementById('progressOuter'),
    msgBox = document.getElementById('msgBox');
    var uploader = new ss.SimpleUpload({
      button: btn,
      url: '<?php echo $pathUploaderPHP."file_upload.php?pathUpload=".$pathUpload; if (isset($filenameUpload)) { echo "&filename=".$filenameUpload; } ?>',
      name: 'uploadfile',
      multipart: true,
      hoverClass: 'hover',
      focusClass: 'focus',
      responseType: 'json',
      startXHR: function() {
            progressOuter.style.display = 'block'; // make progress bar visible
            this.setProgressBar( progressBar );
          },
          onSubmit: function() {
            msgBox.innerHTML = ''; // empty the message box
            btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
          },
          onComplete: function( filename, response ) {
            btn.innerHTML = '<?php echo $uploadText['textUploadBtnRetry']?>';
            progressOuter.style.display = 'none'; // hide progress bar when upload is completed
            if ( !response ) {
              msgBox.innerHTML = 'Unable to upload file';
              return;
            }
            if ( response.success === true ) {
              msgBox.innerHTML = '<strong>' + escapeTags( filename ) + '</strong>' + ' successfully uploaded.';
            } else {
              if ( response.msg )  {
                msgBox.innerHTML = escapeTags( response.msg );
              } else {
                msgBox.innerHTML = 'An error occurred and the upload failed.';
              }
            }
          },
          onError: function() {
            progressOuter.style.display = 'none';
            msgBox.innerHTML = 'Unable to upload file';
          }
        });
  };
</script>