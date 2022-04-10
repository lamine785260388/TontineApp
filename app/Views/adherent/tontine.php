<h1>Detail tontine  <?= $maTontine["nom"];?></h1>
<a class="btn btn-success" href="<?= base_url('adherent');?>" >Revenir à la liste</a><hr>
<div class="card mb-3">
    <div class="card-header"> Description  <?= $maTontine["nom"];?></div>
    <div class="card-body">
        <p class="card-title">Début: <?= date_format(date_create($maTontine["dateDeb"]),"d/m/y");?></p>
        <p>Nombre d'échéances prévues: <?= $maTontine["nbEcheance"]." échéances" ;?>  </p>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header"> Les participants</div>
    <div class="card-body">
    <?php if(!$participants): ?>
        <p>Aucun participant à cette tontine</p>
        <?php else: ?>
            <ul class="list-group">
                <?php foreach($participants as $participants) :?>
                <li class="list-group-item">
                    <h5><?= $participants["prenom"]." ".$participants["nom"];?></h5>
                    <p>Cotisation: <?= $participants["Montant"] ?> CFA</p>
                </li>
              <?php endforeach;?>
            </ul>
        <?php endif ;?>
    </div>
</div>