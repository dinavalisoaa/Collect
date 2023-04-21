<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transport</title>
</head>
<style>
    /* Style du modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    /* Style du contenu du modal */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* Style du bouton de fermeture */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .error {
        border: 2px solid red;
    }

    .error-message {
        color: red;
        font-size: 12px;
        margin-left: 10px;
    }
</style>

<body>
    <h1> Transport</h1>
    <h3>Ajout Societe:</h3>
    <label for="">Nom</label>
    <input type="text" name="nom" id="nom">
    <button id="ajout">Ajouter</button>
    <table border="1">
        <thead>
            <tr>
                <td>Transport</td>
                <td>Contact</td>
                <td>Societe</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($transports as $transport)
                    <td hidden data-value="{{ $transport->idtransport }}"> {{ $transport->idtransport }}</td>
                    <td>{{ $transport->transport }}</td>
                    <td>{{ $transport->contact }}</td>
                    <td data-value="{{ $transport->idsociete }}">{{ $transport->societe }}</td>
                    <td>
                        <button type="submit" id="change">Modifier</button>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h1>Contract</h1>
    <form action="/readContract" method="GET">
        @csrf
        <label for="">Transport</label>
        <select name="idTransport">
            @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->immatriculation }}</option>
            @endforeach
        </select>
        <input type="submit" value="Consulter">
    </form>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Modifier le transport</h2>
            <label for="transport">Transport :</label>
            <input type="text" id="transport" name="transport" readonly><br><br>
            <label for="contact">Contact :</label>
            <input type="text" id="contact" name="contact"><br><br>
            <label  id='telerror' class='error-message'></label>
            <label for="contact">Societe :</label>
            <input type="text" id="societe" name="societe" readonly><br><br>
            <button id="modify">Modifier</button>
            <button id="delete">N'est plus en service</button>
        </div>
    </div>

    <script>
        // Societe:
        var ajout = document.getElementById("ajout");
        ajout.addEventListener("click", function() {
            var nom = document.getElementById("nom").value;
            const name = document.getElementById("nom");
            name.value = "";
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {}
            };
            xhr.open("GET", "http://127.0.0.1:8000/saveCompany/" + nom, true);
            xhr.send();
            name.textContent = "";
        });

        const modal = document.getElementById("myModal");
        const buttons = document.querySelectorAll('#change');
        const closeBtn = document.getElementsByClassName("close")[0];
        closeBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });
        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                modal.style.display = "block";
                const transport = button.parentNode.previousElementSibling.previousElementSibling
                    .previousElementSibling.textContent;
                const idTransport = button.parentNode.previousElementSibling.previousElementSibling
                    .previousElementSibling.previousElementSibling.getAttribute('data-value');
                const contact = button.parentNode.previousElementSibling.previousElementSibling.textContent;
                const societe = button.parentNode.previousElementSibling.textContent;
                const idSociete = button.parentNode.previousElementSibling.getAttribute('data-value');
                const modify = document.getElementById("modify");
                const deletee = document.getElementById("delete");
                document.getElementById("transport").value = transport;
                document.getElementById("contact").value = contact;
                document.getElementById("societe").value = societe;
                const contactLabel = document.getElementById("telerror");

                document.getElementById("contact").addEventListener("click", function() {
                    contactLabel.textContent = "";
                });
                modify.addEventListener("click", function() {
                    if (document.getElementById("contact").value.length > 10) {
                        document.getElementById("contact").classList.add("error");
                        contactLabel.textContent = "Le contact ne doit contenir que 10 chiffres";
                        document.getElementById("contact").value = contact;
                    } else {
                        var xrt = new XMLHttpRequest();
                        xrt.onreadystatechange = function() {
                            if (this.readyState === XMLHttpRequest.DONE && this.status ===
                                200) {
                                console.log('Contact=>' + document.getElementById("contact")
                                    .value);
                            }
                        };
                        console.log("http://127.0.0.1:8000/modifyTransport/" + idSociete + "/" +
                            contact);
                        xrt.open("GET", "http://127.0.0.1:8000/modifyTransport/" + idSociete + "/" +
                            document.getElementById("contact").value, true);
                        xrt.send();
                        window.location.replace("http://127.0.0.1:8000/");
                        modal.style.display = "none";
                    }

                });
                deletee.addEventListener("click", function() {
                    console.log('Delete');
                    var xr = new XMLHttpRequest();
                    xr.onreadystatechange = function() {
                        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                            console.log('idSociete=>' + idSociete);
                        }
                    };
                    xr.open("GET", "http://127.0.0.1:8000/disableTransport/" + idTransport, true);
                    xr.send();
                    window.location.replace("http://127.0.0.1:8000/");
                    modal.style.display = "none";
                });
            });
        });
    </script>
</body>

</html>
