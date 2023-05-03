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
                                <h5 class="card-title">Liste des commandes</h5>
                            </div>
                            <div class="col-md-7">

                            </div>
                            <div class="col-md-2">
                                <br />
                                <div class="col-md-12">
                                    <a href="/commande/new_detail?commandeid={{ $id }}"><button
                                            style="width: 150px;" type="button"
                                            class="btn btn-success">Nouveau</button></a>
                                </div>
                            </div>
                        </div>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Qte</th>
                                    <th scope="col">PU </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($detail as $row){ ?>
                                <tr>
                                    <td><a href="#" class="text-primary"><?php echo $row->getProduit()->nom; ?></a></td>
                                    <td>{{ $row->quantite }}</td>
                                    <td>
>>>{{ $row->getProduit()->epuise($row->quantite)['etat'] }}<<<<
>>>{{ $row->getProduit()->epuise($row->quantite)['message'] }}<<<<
                                    </td>
                                    <td>{{ Util::format($row->prixunitaire) }}Ar</td>
                                    <td><a href="#" class="text-primary"></a></td>

                                    <td>
                                        <div class="progress mt-3">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: <?php echo Commande::progression($row['id']); ?>%" aria-valuenow="<?php echo Commande::progression($row['id']); ?>"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="/commande/voir_detail?id={{ $row['id'] }}"><button
                                                class="btn btn-danger"> Voir+ </button></a>
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
