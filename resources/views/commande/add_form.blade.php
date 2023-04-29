<?php use App\Models\Commande; ?>
@extends('side')
@section('content')
<section class="section">
    <script type="text/javascript">

    function find_client()
    {
        //création de l'objet XMLHttpRequest
        var xhr;
        try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
        catch (e)
        {
            try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
            catch (e2)
            {
            try {  xhr = new XMLHttpRequest();  }
            catch (e3) {  xhr = false;   }
            }
        }

        //Définition des changements d'états
        xhr.onreadystatechange  = function()
        {
        if(xhr.readyState  == 4){
            if(xhr.status  == 200) {
                var retour = JSON.parse(xhr.responseText);
                var option = '';
                for( $i=0; $i<retour.length; $i++){
			        option = option + '<option value='+retour[$i].id+'>'+retour[$i].nom+'</option>';
                }
                document.getElementById('client_list').innerHTML = option;
            } else {
                document.dyn="Error code " + xhr.status;
            }
            }
        };
    //XMLHttpRequest.open(method, url, async)
    var mot = document.getElementById("client");
    xhr.open("GET", "/client/find?mot="+mot.value,  true);

    //XMLHttpRequest.send(body)
    xhr.send(null);
    }

    </script>
    <div class="row">
        <div class="pagetitle">
            <h1>Nouvelle commande</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Commande</a></li>
                    <li class="breadcrumb-item active">Nouveau</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <div class="col-md-12">
            <a href="/commande/list"><button style="width: 150px;" type="submit" class="btn btn-success">Retour sur la liste</button></a>
        </div>
        <div class="col-md-12" style="height: 50px;">

        </div>
        <div class="col-lg-6" style="margin-left: 250px;">

            <div class="card">
                <div class="card-body">
                    <center><h5 class="card-title">AJOUTER UNE NOUVELLE COMMANDE</h5></center>

                    <!-- Vertical Form -->
                    <form action="/commande/details" method="get" class="row g-3">
                        <div class="col-12">
                            <label for="inputNanme4" class="form-label">Date</label>
                            <input type="date" class="form-control" id="inputNanme4" name="date">
                        </div>
                        <div class="col-12">
                            <label for="inputEmail4" class="form-label">Client</label>
                            <input type="text" class="form-control" id="client" onkeyup="find_client()">
                        </div>
                        <div class="col-12">
                            <select name="client" id="client_list" class="form-control">

                            </select>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Valider">
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>



    </div>
</section>
@endsection
