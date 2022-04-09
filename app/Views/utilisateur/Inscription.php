

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
              <label for="prenom" class="form-label">prenom</label>
              <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Saisir le prenom" value="<?= set_value('prenom')?>" required>
              <div class="invalid-feedback">
               le prénom est obligatoire
              </div>
            </div>

            <div class="col-sm-6">
              <label for="nom" class="form-label">Nom</label>
              <input type="text" class="form-control" name="nom" id="lastName" placeholder="Saisir le nom" value="<?= set_value('nom');?>" required>
              <div class="invalid-feedback">
                le nom est obligatoire
              </div>
            </div>

            <div class="col-12">
              <label for="login" class="form-label">login</label>
              <div class="input-group has-validation">
               
                <input type="text" class="form-control" name="login" id="login" placeholder="login" value="<?= set_value('login');?>" required>
              <div class="invalid-feedback">
                  le login est obligatoire
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <label for="prenom" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" name="motPasse" id="motPasse" placeholder="Saisir le mot de passe" value="<?= set_value('motPasse');?>" required>
              <div class="invalid-feedback">
               le mot de passe est obligatoire
              </div>
            </div>

            <div class="col-sm-6">
              <label for="motPasseconf" class="form-label">Confirmation du mot de passe</label>
              <input type="password" class="form-control" name="motPasseConf" id="motPasseconf" placeholder="Confirmer le mot de passe" value="" required>
              <div class="invalid-feedback">
                la confirmation est obligatoire
              </div>
            </div>

            
         

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">s'inscrire</button>
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