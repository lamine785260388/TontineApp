
<h2>Adhérer à une Tontine</h2>
<p class="fs-5 col-md-8">
vous pouvez adhérer aux tontines suivantes
</p>

    <div class="row g-5">
      
      <div class="col-12">
        <h1 class="mb-3">Ajout Adhésion</h1>
        <?php if(isset($validation))  : ?>
        <div class="row alert alert-danger">
            <?= $validation->listErrors();?>
            
        </div> 
    <?php endif;?>

        <form method="post" class="needs-validation" novalidate>
        <?= form_hidden('idTontine',isset($idTontine)?$idTontine:set_value("idTontine")) ?>
          <div class="row g-3">
            <div class="col-sm-12">
              <label for="Montant" class="form-label">Montant</label>
             <?= form_input(['name'=>'Montant','class'=>'form-control','placeholder'=>'saisir le montant','value'=>set_value("montant")]) ?>
             
            </div>
          </div>

            
            
         

          <hr class="my-4">

    <?= form_submit(['name'=>'adherer','class'=>'w-100 btn btn-primary','value'=>'adhérer']) ?>
        </form>
      </div>
    </div>
    <script type="text/javascript">// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation1')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()</script>