

    <h1>Connexion</h1>
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
 <form method="post">

    <h1 class="h3 mb-3 fw-normal">Enter vos login et mot de passe</h1>
   

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="login" value="<?= set_value('login');?>">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe" name="motPasse" value="<?= set_value('motPasse');?>">
      <label for="floatingPassword">Mot de passe</label>
    </div>

   
    <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>

  </form>

    
 