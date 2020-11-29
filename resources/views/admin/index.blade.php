<x-page>
    <x-header>
        <x-slot name="title">Administration</x-slot>
        @include('admin.partials.menu')
    </x-header>

    <x-container>
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col">
                <x-section>
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Utilisateurs inscrit</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\User::all()->count() }}</div>
                </x-section>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col">
                <x-section>
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Publications publiées</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Post::all()->count() }}</div>
                </x-section>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col">
                <x-section>
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Abonnements achetés</div>
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ \Laravel\Cashier\Subscription::all()->count() }}</div>
                </x-section>
            </div>



            <!-- Pending Requests Card Example -->
            <div class="col">
                <x-section>
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Requête en cours</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \Illuminate\Support\Facades\Queue::size() }}</div>
                </x-section>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

            <!-- Area Chart -->
            <div class="col">
                <x-section>
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="card-body">
                        <div class="chart-area position-relative">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </x-section>
            </div>

            <!-- Pie Chart -->
            <div class="col">
                <x-section>
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                            <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                            <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                        </div>
                    </div>
                </x-section>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-6">
                <x-section>
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                    </div>
                </x-section>
            </div>
        </div>
    </x-container>
</x-page>
