@extends('side')
@section('content')
<section class="section">
      <div class="row">
      <div class="col-lg-1"></div>
        
        <div class="col-lg-10">

            <div class="card">
                <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <div class="card-title">Etat d'analyse et statistique</div>

                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Produit</button>
                    </li>

                    <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Client</button>
                    </li>

                    <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Collecte/Vente</button>
                    </li>

                    <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Recette/Depense</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <h5 class="card-title">Saison de collecte des produits</h5>
                        <table class="table table-bordered" border="2" width="1100" height=<?php echo count($produit)*50; ?>>
                            <?php foreach ($produit as $row) { ?>
                                <tr>
                                    <td><?php echo $row['nom']; ?></td>
                                    <?php foreach ($mois as $key) { ?>
                                        <?php if($row['debutsaison'] <= $key['id'] && $row['finsaison'] >= $key['id']){ ?>
                                            <?php if($row['debutsaison'] <= $current_month && $row['finsaison'] >= $current_month){ ?>
                                                <td style="background: rgb(255, 99, 132)"></td>
                                            <?php }else{ ?>
                                                <td style="background: rgb(255, 205, 86)"></td>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <td></td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td></td>
                                <?php foreach ($mois as $key) { ?>
                                    <th><?php echo $key['abreviation'] ?></th>
                                <?php } ?>
                            </tr>
                        </table>
                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                        <h5 class="card-title">Top 3 des clients fideles</h5>
                        <table class="table table-borderless">
                            <tbody>
                            <?php foreach($client_fidele as $row){ ?>
                            <tr>
                                <th scope="row"><a href="#"><img width="200px;" src="assets/img/client1.svg" alt=""></a></th>
                                <td>
                                    <a href="#" class="text-primary fw-bold" style="font-size: 20px;"><?php echo $row['nom']; ?></a>
                                    <p><?php echo $row['adresse']; ?></p>
                                    <p><?php echo $row['email']; ?></p>
                                    <p><?php echo $row['telephone']; ?></p>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade pt-3" id="profile-settings">
                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <div id="verticalBarChart" style="min-height: 400px;" class="echart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#verticalBarChart")).setOption({
                                    title: {
                                    text: 'Collecte et vente des produits'
                                    },
                                    tooltip: {
                                    trigger: 'axis',
                                    axisPointer: {
                                        type: 'shadow'
                                    }
                                    },
                                    legend: {},
                                    grid: {
                                    left: '3%',
                                    right: '4%',
                                    bottom: '3%',
                                    containLabel: true
                                    },
                                    xAxis: {
                                    type: 'value',
                                    boundaryGap: [0, 0.01]
                                    },
                                    yAxis: {
                                    type: 'category',
                                    data: [
                                        @foreach ($produit as $row)
                                            '{{ $row->nom }}',
                                        @endforeach    ]
                                    },
                                    series: [{
                                        name: 'Collectés',
                                        type: 'bar',
                                        data: [
                                            @foreach ($collecte as $row)
                                                {{ $row->quantite }},
                                            @endforeach
                                        ]
                                    },
                                    {
                                        name: 'Vendus',
                                        type: 'bar',
                                        data: [
                                            @foreach ($vendu as $row)
                                                {{ $row->quantite }},
                                            @endforeach
                                        ]
                                    }
                                    ]
                                });
                                });
                            </script>
                            <!-- End Vertical Bar Chart -->

                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">

                        <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                            </div>

                            <div class="card-body">
                            <h5 class="card-title">Recette</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                <h6><?php echo $somme_recette; ?> Ar</h6>
                                {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                </div>
                            </div>
                            </div>

                        </div>
                        </div><!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                            </div>

                            <div class="card-body">
                            <h5 class="card-title">Dépense</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                <h6><?php echo $somme_depense; ?> Ar</h6>
                                {{-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                </div>
                            </div>
                            </div>

                        </div>
                        </div>

                        <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                            </ul>
                            </div>

                            <div class="card-body">
                            <h5 class="card-title">Bénéfice</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                <h6><?php echo $somme_benefice; ?> Ar</h6>
                                {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> --}}

                                </div>
                            </div>
                            </div>

                        </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Recette, dépense, bénéfice de l'année</h5>
                                    <!-- Line Chart -->
                                <div id="reportsChart"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#reportsChart"), {
                                        series: [{
                                        name: 'Recette',
                                        data: [
                                            @foreach ($recette as $row)
                                                {{ $row->montant }},
                                            @endforeach
                                        ]
                                        }, {
                                        name: 'Dépense',
                                        data: [
                                            @foreach ($depense as $row)
                                                {{ $row->montant }},
                                            @endforeach
                                        ]
                                        }, {
                                        name: 'Bénéfice',
                                        data: [
                                            @foreach ($benefice as $row)
                                                {{ $row->montant }},
                                            @endforeach
                                        ]
                                        }, {
                                        }],
                                        chart: {
                                        height: 350,
                                        type: 'area',
                                        toolbar: {
                                            show: false
                                        },
                                        },
                                        markers: {
                                        size: 4
                                        },
                                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                        fill: {
                                        type: "gradient",
                                        gradient: {
                                            shadeIntensity: 1,
                                            opacityFrom: 0.3,
                                            opacityTo: 0.4,
                                            stops: [0, 90, 100]
                                        }
                                        },
                                        dataLabels: {
                                        enabled: false
                                        },
                                        stroke: {
                                        curve: 'smooth',
                                        width: 2
                                        },
                                        xaxis: {
                                        type: 'text',
                                        categories: [
                                            @foreach ($mois as $row)
                                                '{{ $row->abreviation }}',
                                            @endforeach
                                        ]
                                        }
                                    }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                                </div>

                            </div>
                        </div>
                    </div>

                </div><!-- End Bordered Tabs -->

                </div>
            </div>
            <div class="col-lg-1"></div>

        {{-- </div> --}}

    </div>
</section>
@endsection
