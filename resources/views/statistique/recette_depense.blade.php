@extends('side')
@section('content')
<section class="section">
      <div class="row">
        <div class="col-lg-12">

            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <div class="tab-content pt-2">


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

    </div>
</section>
@endsection
