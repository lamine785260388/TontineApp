

    <h3 class="text-center">Changer mot de passe</h3>
    <?php if(isset($validation))  : ?>
        <div class="row alert alert-danger">
          <?= $validation->listErrors();?>
            
        </div> 
    <?php endif;?>
   
    <?php if(session()->get('success')): ?>
    <div class="alert-success alert" role="alert">
        <?= session()->get('success') ?>
        
    </div>
<?php endif;?>
<?php if(session()->get('nonAutorise')): ?>
    <div class="alert-danger alert" role="alert">
        <?= session()->get('nonAutorise') ?>
        
    </div>
<?php endif;?>
 <form method="post" class="form-floating form-signin text-center">

    
   
<input type="hidden" name="id" value="<?= isset($iduser)?$iduser:set_value('id');?>"/>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingInput" name="motPasse" value="<?= set_value('motPasse');?>">
      <label for="floatingInput">Nouveau Mot de passe</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe" name="confirmation" >
      <label for="floatingPassword">confirmation de Mot de passe</label>
    </div>

   
    <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>

  </form>

    
 