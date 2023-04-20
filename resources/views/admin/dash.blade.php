@extends('side')
@section('content')
<section class="section">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Calendrier</title>
  </head>

  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <style>
    #ppl {
      width: 70px;
    }

    .box {
      display: grid;
      color: #fff;
      background-color: #99D9EA;
      border-color: #99D8E2;
      display: grid;
      font-weight: 400;
      line-height: 1.5;
      color: #212529;
      width: 180px;
      text-align: center;
      text-decoration: none;
      vertical-align: middle;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
      /* background-color: transparent; */
      /* border: 1px solid transparent; */
      /* padding: .375rem .75rem; */
      font-size: 1rem;
      border-radius: .25rem;
      transition: color .15s
    }
  </style>

  <body>
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
          <div class="card">
            <div class="card-body">
              <h1 class="card-title">Planning</h1>
              <?php
              // On récupère le mois et l'année à afficher
              if (isset($mois) && isset($annee)) {
                $mois_affiche = intval($mois);
                $annee_affiche = intval($annee);
              } else {
                // Si les paramètres mois et année ne sont pas définis, on affiche le calendrier du mois et de l'année actuelle
                $date = new DateTime();
                $mois_affiche = $date->format('n');
                $annee_affiche = $date->format('Y');
              }
              // print_r(;
              // echo ;

              // On calcule le nombre de jours dans le mois à afficher
              $nb_jours = cal_days_in_month(CAL_GREGORIAN, $mois_affiche, $annee_affiche);

              // On affiche le calendrier
              ?>
              <table class="table table-bordered">
                <?php
                echo '<tr>';
                echo '<td><a class="btn btn-primary"href="/admin/dash?mois=' . ($mois_affiche - 1) . '&annee=' . $annee_affiche . '">&lt; Précédent</a></td>';
                echo '<td colspan="5" style="text-align: center;">' . date('F Y', strtotime($annee_affiche . '-' . $mois_affiche . '-01')) . '</td>';
                echo '<td><a class="btn btn-primary" href="/admin/dash?mois=' . ($mois_affiche + 1) . '&annee=' . $annee_affiche . '">Suivant &gt;</a></td>';
                echo '</tr>';
                ?>
              </table><?php
                      echo '<table class="table table-bordered">';

                      // Affichage des boutons "Précédent" et "Suivant"


                      // Affichage des jours de la semaine
                      echo '<tr>';
                      echo '<th>Lun</th><th>Mar</th><th>Mer</th><th>Jeu</th><th>Ven</th><th>Sam</th><th>Dim</th>';
                      echo '</tr>';


                      // On initialise le compteur de jours à 1
                      $compteur_jours = 1;

                      // On boucle sur les semaines
                      for ($semaine = 1; $semaine <= 6; $semaine++) {
                        echo '<tr>';
                        // On boucle sur les jours de la semaine
                        for ($jour = 1; $jour <= 7; $jour++) {
                          if ($compteur_jours > $nb_jours) {
                            // Si on a affiché tous les jours du mois, on sort de la boucle
                            break;
                          }
                          if ($semaine == 1 && $jour < date('N', strtotime($annee_affiche . '-' . $mois_affiche . '-01'))) {
                            // Si on est sur la première semaine et que le jour n'est pas dans le mois à afficher, on affiche une case vide
                            echo '<td></td>';
                          } else {
                            $da = $annee_affiche . '-' . $mois_affiche . '-' . $compteur_jours;
                            // Sinon, on affiche le numéro du jour
                            // var_dump();
                            $arr = App\Models\PlanningCollect::check($da);
                            // var_dump($arr);
                            // if()
                            if (count($arr) > 0) {
                              echo '<td id="ppl"  style="width:110px;height:100px">' .  '<a href="/admin/detail?date=' . $da . '">' . $compteur_jours . '</a>';
                              $o = 0;
                              foreach ($arr as $key) {
                                // # code...
                                echo '<div class="box">' . $key->getPointCollecte()->nom . ":" . $key->budget . 'Ar' . '</div>';
                                // if()
                                $o++;
                                if ($o >= 1) {
                                  if (count($arr) > 1) {
                                    echo '<div class="box">+' . (count($arr) - 1) . '</div>';
                                  }
                                  break;
                                }
                              }
                              echo  '</td>';
                            } else {
                              echo '<td>' . '<a href="/admin/detail?date=' . $da . '">' . $compteur_jours . '</a></td>';
                            }
                            $compteur_jours++;
                          }
                        }

                        echo '</tr>';

                        if ($compteur_jours > $nb_jours) {
                          // Si on a affiché tous les jours du mois, on sort de la boucle
                          break;
                        }
                      }


                      ?>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-md-2">
    </div>
</section>
@endsection