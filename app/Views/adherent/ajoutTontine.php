

    <div class="row g-5">
      
      <div class="col-12">
        <h1 class="mb-3">Créer un compte</h1>
        <?php if(isset($validation))  : ?>
        <div class="row alert alert-danger">
            <?= $validation->listErrors();?>
            
        </div> 
    <?php endif;?>

        <form method="post" class="needs-validation" novalidate>
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="prenom" class="form-label">nom</label>
             <?= form_input(['name'=>'nom','class'=>'form-control','placeholder'=>'saisir le nom','value'=>set_value("nom")]) ?>
             
            </div>

            <div class="col-sm-6">
              <label for="nom" class="form-label">Périodicité</label>
              <?= form_dropdown('periodicite',$periodicite,set_value("periodicite"),["class"=>"form-control"]);?>
            
            </div>

          
            <div class="col-sm-6">
              <label for="prenom" class="form-label">Date début</label>
              <?= form_input(['name'=>'dateDeb','class'=>'form-control','placeholder'=>'jj/mm/AAAA','value'=>set_value("dateDeb")]);?>
               </div>

            <div class="col-sm-6">
              <label for="nbEcheance" class="form-label">Nb écheances</label>
              <?= form_dropdown('nbEcheance',$nbEcheance,set_value("nbEcheance"),["class"=>"form-control"]);?>
            
            </div>

            
         

          <hr class="my-4">

    <?= form_submit(['name'=>'ajouter','class'=>'w-100 btn btn-primary','placeholder'=>'jj/mm/AAAA','value'=>'Ajouter']) ?>
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