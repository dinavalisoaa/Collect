@extends('side')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="card-title">Liste des clients</h5>
                        </div>
                        <div class="col-md-7">

                        </div>
                        <div class="col-md-2">
                            <br/>
                            <div class="col-md-12">
                                <button style="width: 150px;" type="button"
                                        class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addService">Nouveau</button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="addService" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Nouveau client</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                        <form action="/client/add" method="get" class="row g-3">
                                            <div>
                                                <center><input style="width: 400px;" type="text" class="form-control" id="inputPassword4" name="nom"
                                                        placeholder="Nom"></center>
                                                <br>
                                                <center><input style="width: 400px;" type="text" name="adresse" class="form-control" id="inputPassword4" name="nom"
                                                        placeholder="Adresse"></center>
                                                <br>
                                                <center><input style="width: 400px;" type="text" name="email" class="form-control" id="inputPassword4" name="nom"
                                                        placeholder="Email"></center>
                                                <br>
                                                <center><input style="width: 400px;" type="text" name="telephone" class="form-control" id="inputPassword4" name="adresse"
                                                        placeholder="Telephone">
                                                </center>
                                            </div>
                                            <center><input style="width: 100px;" type="submit" class="btn btn-primary" value="Ajouter"></center>
                                        </form>
                                        <div class="col-md-12" style="height: 20px;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telephone</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach($client as $row){ ?>
                      <tr>
                        <th scope="row"><a href="#"><?php echo $row['nom'] ?></a></th>
                        <td><?php echo $row['adresse'] ?></td>
                        <td><a href="#" class="text-primary"><?php echo $row['email'] ?></a></td>
                        <td><?php echo $row['telephone'] ?></td>
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
