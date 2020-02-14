<title>Un seul Enregistrement</title>
 <div class="center" align="center"> 
 <h1>Signature: <input type="text" value="" name="imagessss" id="imagessss" /></h1> 
</div>

 <section>
    <div class="container">
      <div class="boxarea" style="margin:-54px">
        <h1>Pointer le vehicule Ici !</h1>
        <div class="signature-pad" id="signature-pad">
          <div class="m-signature-pad">
            <div class="m-signature-pad-body">
              <canvas style="background-image:url('<?php echo base_url();?>/images/voiture.png'); background-size: 625px 318px;"  width="625" height="318"></canvas>
            </div>
          </div>
          <div class="m-signature-pad-footer">
            <button type="button"  id="save2" data-action="save" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
            <button type="button" data-action="clear"  class="btn btn-danger"><i class="fa fa-trash-o"></i> Clear</button>
           <a href="<?php echo base_url();?>welcome/multiple" class="btn btn-primary">Multiple</a>
          </div>
        </div>
      </div>
    </div>
    
  </section>

<!-- random id generated here  -->
  <input type="hidden" value="<?php echo rand();?>" id="rowno">

  <section>
    <div class="container">
      <div class="boxarea">
  
<div id="previewsign1" class="previewsign">
<br>
  <h1>Regarder le resultat par ici !</h1>
</div>
</div>
</div>
</section>





  <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Attention!</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
           Vous devez signer avant de l'envoyer
        </div>
      </div>
    </div>
  </div>
</div>





  <script>

   
    var wrapper = document.getElementById("signature-pad"),
    clearButton = wrapper.querySelector("[data-action=clear]"),
    saveButton = wrapper.querySelector("[data-action=save]"),
    canvas = wrapper.querySelector("canvas"),
    signaturePad;


    function resizeCanvas() {

      var ratio =  window.devicePixelRatio || 1;
      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = canvas.offsetHeight * ratio;
      canvas.getContext("2d").scale(ratio, ratio);
    }

     ctx = canvas.getContext("2d");

    var background = new Image();
    // The image needs to be in your domain.
    background.src = "images/voiture.png";

    // Make sure the image is loaded first otherwise nothing will draw.
    

    

    signaturePad = new SignaturePad(canvas);

    clearButton.addEventListener("click", function (event) {
      signaturePad.clear();
    });
    saveButton.addEventListener("click", function (event) {
      
      if (signaturePad.isEmpty()) {
        $('#myModal').modal('show');
      }

      else {
        ctx.drawImage(background, 0, 0, 625, 318);  
        var photo = signaturePad.toDataURL();
        $('#imagessss').val(photo);
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>welcome/insert_single_signature",
          data: {'image': $('#imagessss').val(),'rowno':$('#rowno').val()},
          success: function(datas1)
          {            
            signaturePad.clear();
            $('.previewsign').html(datas1);
          }
        });
      }
    }); 

  </script>
    <style type="text/css">
    
    .previewsign
    {   
    border: 1px dashed #ccc;
    border-radius: 5px;
    color: #bbbabb;
    height: 253px;
    width: 46%;
    text-align: center;
    float: right;
    vertical-align: middle;
    top: 73px;
    position: fixed;
    right: 35px;
  }
  .m-signature-pad-body
  {
    border: 1px dashed #ccc;
    border-radius: 5px;
    color: #bbbabb;
    height: 253px;
    width: 46%;
    text-align: center;
    float: right;
    vertical-align: middle;
    top: 73px;
    position: fixed;
    left: 33px;
  }
  .m-signature-pad-footer
  {
    bottom: 250px;
    left: 218px;
    position: fixed;
  }
    .img
  {
        right: 0;
    position: absolute;
  }
</style>
</body>
</html>