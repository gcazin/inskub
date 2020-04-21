@extends('layouts.base')


@section('content')
    <!--Console Content-->
    <div class="flex flex-wrap mt-5">
        <div class="w-full md:w-1/2 xl:w-1/3 pr-3">
            <!--Metric Card-->
            <div class="bg-white dark:bg-gray-800 rounded shadow-md p-2">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-orange-dark"><i class="fas fa-users fa-2x fa-fw fa-inverse"></i></div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="uppercase text-grey">Nombres d'utilisateurs inscrits</h5>
                        <h3 class="text-3xl">{{ count(App\User::all()) }}</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3 pr-3">
            <!--Metric Card-->
            <div class="bg-white dark:bg-gray-800 rounded shadow-md p-2">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-blue-dark"><i class="fas fa-server fa-2x fa-fw fa-inverse"></i></div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="uppercase text-grey">Nombres d'articles publiées</h5>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
        <div class="w-full md:w-1/2 xl:w-1/3">
            <!--Metric Card-->
            <div class="bg-white dark:bg-gray-800 rounded shadow-md p-2">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3 bg-blue-dark"><i class="fas fa-server fa-2x fa-fw fa-inverse"></i></div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="uppercase text-grey">Version PHP du serveur</h5>
                        <h3 class="text-3xl">{{ phpversion() }}</h3>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
    </div>

@endsection
