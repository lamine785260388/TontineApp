<h1>Bienvenue  <?= session()->get("prenom")." ".session()->get("nom");?></h1>
<p class="fs-5 col-md-8">
    Vous pouvez gérer vos tontines, adherer aux tontines disponibles, créer de nouvelles tontines,...
</p>
<h2>Les tontines gérées
    <a href="<?= base_url("adherent/ajouterTontine"); ?>" class="btn btn-success">Nouvelle tontine</a>
</h2>
<?php if(session()->get('successAjTontine')):?>
    <div class="alert-success alert" role="alert">
        <?= session()->get('successAjTontine') ?>

    </div>
    <?php endif ;?>
<table class="table">
    <tr>
        <th> Nom</th><th>Périodicité</th><th>Date début</th><th>Nb échéances</th><th>...</th>
    </tr>
    <?php //si aucune tontine
    if(!$listeTontineResp): ?>
    <tr><td colspan="5" class="table-danger text-center">
        Aucune tontine géréee pour l'instant...
    </td></tr>
    <?php else :
    foreach($listeTontineResp as $tontine):
         ?>
         <tr><td><?= $tontine['nom'] ?></td><td><?= $tontine["periodicite"] ?></td>
         <td><?= date_format(date_create($tontine['dateDeb']),"d M Y") ?></td>
         <td><?= $tontine["nbEcheance"] ?></td>
         <td> <a href="<?= base_url("adherent/modifierTontine/".$tontine["id"])?>" class="btn btn-warning">modifier</a>
        <a href="<?= base_url("adherent/supprimerTontine/".$tontine["id"])?>" class="btn btn-danger" onclick="return confirmation();">supprimer</a>
        <a href="<?= base_url("adherent/tontine/".$tontine["id"])?>" class="btn btn-info">Participant</a>
        </td>
         <?php endforeach ;?>
        </tr>
        <?php endif ;?>
</table><hr>
<h2>Les tontines participées
   
</h2>
<?php if(session()->get('successAjTontine')):?>
    <div class="alert-success alert" role="alert">
        <?= session()->get('successAjTontine') ?>

    </div>
    <?php endif ;?>
<table class="table">
    <tr>
        <th> Nom</th><th>Périodicité</th><th>Date début</th><th>Nb échéances</th><th>...</th>
    </tr>
    <?php //si aucune tontine
    if(!$tontinesParticiper): ?>
    <tr><td colspan="5" class="table-danger text-center">
        Aucune tontine géréee pour l'instant...
    </td></tr>
    <?php else :
    foreach($tontinesParticiper as $tontine):
         ?>
         <tr><td><?= $tontine['nom'] ?></td><td><?= $tontine["periodicite"] ?></td>
         <td><?= date_format(date_create($tontine['dateDeb']),"d M Y") ?></td>
         <td><?= $tontine["nbEcheance"] ?></td>
         <td> <a href="<?= base_url("adherent/echeanceTontine/".$tontine["idTontine"])?>" class="btn btn-warning">Voir les échéances</a>
        
        
        </td>
         <?php endforeach ;?>
        </tr>
        <?php endif ;?>
</table>
<script>
   function confirmation(){
return confirm("voulez vous vraiment supprimer");
    }
</script>