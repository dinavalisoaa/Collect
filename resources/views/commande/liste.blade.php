<?php use App\Models\Commande; ?>

@extends('side')
@section('content')
    <link rel='stylesheet' href='/swal/sweet-alert.css'>
    <link rel="stylesheet" href="/swal/style.css">
    <script>
        function submitForm() {
            var xhr;
            try {
                xhr = new ActiveXObject('Msxml2.XMLHTTP');
            } catch (e) {
                try {
                    xhr = new ActiveXObject('Microsoft.XMLHTTP');
                } catch (e2) {
                    try {
                        xhr = new XMLHttpRequest();
                    } catch (e3) {
                        xhr = false;
                    }
                }
            }
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var retour = JSON.parse(xhr.responseText);
                        if(retour.message=='200'){
                            document.getElementById("montant").value="";
                            document.getElementById("reste").innerHTML=retour.montant;
                            swal({
                            title:"Paiement effectue",
                            type:'success',
                            input:'dina'
                            })
                        }
                      else{
                        swal({
                            title:"Paiement effectue",
                            type:'warning'
                            })
                      }
                        // var resultat = document.getElementById("dyn");
                        // resultat.value = retour[0].;
                    } else {
                        document.dyn = "Error code " + xhr.status;
                    }
                }
            };
            var livraison=document.getElementById("livraison").value;
            var montant=document.getElementById("montant").value;
            // swal({
            //     title:"
            // })
            console.log("/livraison/payer?montant="+montant+"&&id="+livraison);
            xhr.open("GET", "/livraison/payer?montant="+montant+"&&id="+livraison, false);
            xhr.send(null);
        }

        function getSwal() {
            swal({
                    title: "Paiement",
                    input: 'email',
                    inputLabel: 'Your email address',
                    inputPlaceholder: 'Enter your email address',
                    // text: "You will not be able to recover this imaginary file!",
                    // type: "warning",
                    imageUrl: '/assets/img/credit.svg',

                    // showCancelButton: true,
                    // confirmButtonColor: '#DD6B55',
                    // confirmButtonText: 'Yes, delete it!',
                    // cancelButtonText: "No, cancel plx!",
                    // closeOnConfirm: false,
                    // closeOnCancel: false,
                }
                // ,
                // function(isConfirm){
                // if (isConfirm){
                //   swal("Deleted!", "Your imaginary file has been deleted!", "success");
                // } else {
                //   swal("Cancelled", "Your imaginary file is safe :)", "error");
                // }
                // }
            );
        }
    </script>
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
                                <br />
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
                                    <th scope="row"><a href="#"><?php echo $row->id; ?>
                                        </a></th>
                                    <td><?php echo $row['date']; ?> {{ Util::getEtat($row->id) }}</td>
                                    <td><a href="#" class="text-primary"><?php echo $row['nom']; ?></a></td>
                                    <td>
                                        <div class="progress mt-3">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: <?php echo Commande::progression($row['id']); ?>%" aria-valuenow="<?php echo Commande::progression($row['id']); ?>"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>

                                    <td>
                                        @if (Util::getEtat($row->id) == 0 && $row->sortiePossible()['etat'] == 'true')
                                            <a href="/livraison/add_livraison?id={{ $row->id }}">
                                                <button class="btn btn-success">
                                                    Livrer
                                                </button>
                                            </a>
                                        @else
                                            @if ($row->sortiePossible()['etat'] == 'false')
                                                <button class="btn btn-danger" disabled>
                                                    {{ $row->sortiePossible()['message'] }}
                                                </button>
                                            @endif
                                            @if (Util::getEtat($row->id) == 1)
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#verticalycentered">
                                                    Livré/ Non Payer
                                                </button>

                                                <div class="modal fade" id="verticalycentered" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content" style="width:680px">
                                                            <div class="modal-header">

                                                                <h5 class="modal-title">Paiemet
                                                                </h5>

                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-md-12">
                                                                    {{-- <form> --}}

                                                                        <input type="hidden" id="livraison"
                                                                            value="{{ $row->getLivraison()->id }}" />
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <img src="/assets/img/credit.svg"
                                                                                    height="320px" />
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                {{-- <form action="/livraison/payer" method="get"> --}}
                                                                                <div class="col-12">
                                                                                    <label>
                                                                                        Reste a payer
                                                                                    </label>
                                                                                    <p id="reste">
                                                                                        {{$row->getLivraison()->getResteApayer()}}
                                                                                    </p>
                                                                                    <label for="inputNanme4"
                                                                                        class="form-label">Montant</label>
                                                                                    <input type="text" 
                                                                                        class="form-control"
                                                                                        id="montant" name="montant">
                                                                                </div>


                                                                                <div class="text-center">


                                                                                    <button onclick="submitForm()"
                                                                                        class="btn btn-primary"
                                                                                        value="Valider"  data-bs-dismiss="modal">PAYER</button>
                                                                                </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    </div>
                </div>
                @endif
                @endif
                <a href="/commande/voir_detail?id={{ $row['id'] }}">
                    <button class="btn btn-secondary">voir+</button></a>
                </td>
                <td>

                </td>
                </tr>
                <?php } ?>
                </tbody>
                </table>

            </div>

        </div>
        </div>
        {{-- <section class="section"> --}}

        </div>
    </section>
    <script src='/swal/sweet-alert.min.js'></script>
    <script src="/swal/script.js"></script>

@endsection
