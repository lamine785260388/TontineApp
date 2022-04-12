<h1>Detail tontine  <?= $maTontine["nom"];?></h1>
<a class="btn btn-success" href="<?= base_url('adherent');?>" >Revenir à la liste</a><hr>
<div class="card mb-3">
    <div class="card-header"> Description  <?= $maTontine["nom"];?></div>
    <div class="card-body">
        <p class="card-title">Début: <?= date_format(date_create($maTontine["dateDeb"]),"d/m/y");?></p>
        <p>Nombre d'échéances prévues: <?= $maTontine["nbEcheance"]." échéances" ;?>  </p>
        <?php if(!$echeances): ?>
            <tr><td colspan="5" class="table-danger text-center">
       Les dates d'échéances ne sont pas encore fixées...
    </td></tr>
            
            <?php endif;?>
        <p>
      <?php foreach($echeances as $echeance): ?>
        <span class="badge rounded-pill bg-primary">
        <?= date_format(date_create($echeance["date"]),"d/m/Y");?>
        </span>
      <?php endforeach;?>
        </p>
        <?php if(session()->get("successajEcheance")): ?>
    <div class="row alert alert-success">
    <?= session()->get("successajEcheance");?>
    </div>
<?php endif;?>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header"> Cotisation faite</div>
    <div class="card-body">
        <p class="card-title">Début: <?= date_format(date_create($maTontine["dateDeb"]),"d/m/y");?></p>
        <p>Echéances payées:</p>
       

        <p>
      <?php foreach($cotisationsfaite as $echeance): ?>
        <span class="badge rounded-pill bg-success">
        <?= date_format(date_create($echeance["date"]),"d/m/Y");?>
        </span>
      <?php endforeach;?>
        </p>
        <?php if(session()->get("successajEcheance")): ?>
    <div class="row alert alert-success">
    <?= session()->get("successajEcheance");?>
    </div>
<?php endif;?>
    </div>
</div>
