<h1>Bonjour  <?= session()->get("prenom")." ".session()->get("nom");?></h1>
<p class="fs-5 col-md-8">
   Voici la liste des Utilisateur....
</p>

<?php if(session()->get('success')):?>
    <div class="alert-success alert" role="alert">
        <?= session()->get('success') ?>

    </div>
    <?php endif ;?>
<table class="table">
    <tr>
        <th> Nom</th><th>Prénom</th><th>login</th><th>profil</th><th>...</th>
    </tr>
    <?php //si aucune tontine
    if(!$listeUtilisateur): ?>
    <tr><td colspan="5" class="table-danger text-center">
        Aucune tontine géréee pour l'instant...
    </td></tr>
    <?php else :
    foreach($listeUtilisateur as $utilisateur):
         ?>
         <tr><td><?= $utilisateur['nom'] ?></td><td><?= $utilisateur["prenom"] ?></td>
         
         <td><?= $utilisateur["login"] ?></td>
         <td><?= $utilisateur["profil"] ;?> </td>
         <td> <a href="<?= base_url('administrateur/changeMotPasse/'.$utilisateur["id"]);?>" class="btn btn-warning"> mot de passe</a></td>
         </tr>
         <?php endforeach ;?>
       
        <?php endif ;?>
</table><hr>

<script>
    

   function confirmation(){
return confirm("voulez vous vraiment supprimer");
    }
   
</script>

