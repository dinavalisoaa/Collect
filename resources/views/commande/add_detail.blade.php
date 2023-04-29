<?php use App\Models\Commande; ?>
@extends('side')
@section('content')
<section class="section">

    <div class="row">
        <div class="pagetitle">
            <h1>Nouvelle commande</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Commande</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <div class="col-md-12">
            <a href="/commande/list"><button style="width: 150px;" type="submit" class="btn btn-success">Retour sur la liste</button></a>
        </div>
        <div class="col-md-12" style="height: 50px;">

        </div>
        <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body" style="width: 1000px;">
                            <!--h5 class="card-title">Table with stripped rows</h5-->

                            <!-- Table with stripped rows -->
                            <table class="table table-striped">
                                <thead>
                                    <form action="/commande/add_details" method="get" class="row g-3">
                                        <input type="hidden" class="form-control" id="inputNanme4" value="<?php echo $commande; ?>" name="commandeid">
                                    <tr>
                                        <th scope="col">
                                            <select name="produit" class="form-control">
                                                <?php foreach($produit as $key){ ?>
                                                <option value="<?php echo $key['id']; ?>"><?php echo $key['nom']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </th>
                                        <th scope="col">
                                            <input type="text" class="form-control" id="inputNanme4" name="quantite">
                                        </th>
                                        <th scope="col">
                                            <input type="text" class="form-control" id="inputNanme4" name="prix">
                                        </th>
                                        <th>
                                            <input type="submit" class="btn btn-primary" value="Ajouter">
                                        </th>
                                    </tr>
                                    </form>
                                </thead>
                                <thead>
                                    <tr>
                                        <th scope="col">Produit</th>
                                        <th scope="col">Quantite</th>
                                        <th scope="col">Prix unitaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($detail as $row){ ?>
                                    <tr>
                                        <td><?php echo $row['nom']; ?></td>
                                        <td><?php echo $row['quantite']; ?></td>
                                        <td><?php echo $row['prixunitaire']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>
                </div>

    </div>
</section>
@endsection
