<?php use App\Models\Commande; ?>
@extends('side')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Liste des commandess</h5>
                        </div>
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            <div class="col-md-12">
                                <a href="/commande/add"><button style="width: 150px;" type="button"
                                        class="btn btn-success">Nouveau</button></a>
                            </div>
                        </div>
                    </div>
                    @if (isset($messages))
                    <div style="color: lightgreen">{{ $messages }}</div>
                @endif
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">ID Commande</th>
                        <th scope="col">Date</th>
                        <th scope="col">Client</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($commande as $row){ ?>
                      <tr>
                        <th scope="row"><a href="#"><?php echo $row->id ?>
                      </a></th>
                        <td><?php echo $row['date'] ?>  {{Util::getEtat($row->id)}}</td>
                        <td><a href="#" class="text-primary"><?php echo $row['nom'] ?></a></td>
                        <td>
                            <div class="progress mt-3">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo Commande::progression($row['id']); ?>%" aria-valuenow="<?php echo Commande::progression($row['id']); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </td>
                        <td>
                           <a href="/commande/voir_detail?id={{$row['id']}}"><button class="btn btn-danger"> Voir+ </button></a>
                        </td>
                        <td>
                        <a href="/commande/new_detail?commandeid={{$row['id']}}"><button class="btn btn-danger"> Voir+ </button></a>

                        
                        </td>
                        <td>
                          @if(Util::getEtat($row->id)==0)
                          <a href="/livraison/add_livraison?id={{$row->id}}">
                            <button class="btn btn-danger">
                              Livrer
                            </button>
                            </a>
                            @else
                            <button class="btn btn-success" disabled>
                              Livrer
                            </button>
                          @endif
                        
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
    </div>
</section>
@endsection
