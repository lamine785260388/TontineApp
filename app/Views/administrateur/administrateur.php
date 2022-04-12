<div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Statistique adherents</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title"><?= $nombreadherent." ";?></h1>
            
           
            <button type="button" class="w-100 btn btn-lg btn-outline-primary">Adherents</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Statistique participants</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title"><?= $nombreParticipant;?><small class="text-muted fw-light"></small></h1>
       
            <button type="button" class="w-100 btn btn-lg btn-primary">Participants</button>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header py-3 text-white bg-primary border-primary">
            <h4 class="my-0 fw-normal">Statistique tontines</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title"><?= $nombreTontine." ";?><small class="text-muted fw-light"></small></h1>
          
            <button type="button" class="w-100 btn btn-lg btn-primary">Tontines</button>
          </div>
        </div>
      </div>
    </div>

  
        </tbody>
      </table>
    </div>