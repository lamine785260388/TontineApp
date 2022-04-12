<h1>Detail tontine  <?= $maTontine["nom"];?></h1>
<a class="btn btn-success" href="<?= base_url('adherent');?>" >Revenir à la liste</a><hr>
<div class="card mb-3">
    <div class="card-header"> Description  <?= $maTontine["nom"];?></div>
    <div class="card-body">
        <p class="card-title">Début: <?= date_format(date_create($maTontine["dateDeb"]),"d/m/y");?></p>
        <p>Nombre d'échéances prévues: <?= $maTontine["nbEcheance"]." échéances" ;?>  </p>
        <?php if(!$echeances): ?>
            <a href="<?= base_url("adherent/genererEcheance/".$maTontine["id"])?>" class="btn btn-success">Générer</a>
            
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
    <div class="card-header"> Les participants</div>
    <div class="card-body">
    <?php if(!$participants): ?>
        <p>Aucun participant à cette tontine</p>
        <?php else: ?>
            <ul class="list-group">
                <?php foreach($participants as $participants) :?>
                <li class="list-group-item">
                    <h5><?= $participants["prenom"];?></h5>
                    <p>Cotisation: <?= $participants["Montant"] ?> CFA</p>
                    <?php if(session()->get("successajCotise")): ?>
    <div class="row alert alert-success">
    <?= session()->get("successajCotise");?>
    </div>
<?php endif;?>
                    <?php $i=0;
                    if (isset($cotisations[$participants["idAdherant"]])) : 
                        for($i=0;$i<$cotisations[$participants["idAdherant"]];$i++):
                            ?>
                            <span class="badge rounded-pill bg-success">
        <?= date_format(date_create($echeances[$i]["date"]),"d/m/Y");?>
        </span>
                     <?php endfor; endif;?>
   <p>
       <a class="mt-3 btn btn-warning" href="<?php $a=$i+1; echo base_url("adherent/payerEcheance/".$participants["idAdherant"]."/".$maTontine["id"])."/".$a; ?>">Payer</a>
   </p>
   
                </li>
              <?php endforeach;?>
            </ul>
        <?php endif ;?>
    </div>
</div>