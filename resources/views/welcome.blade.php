<x-page>
    <x-slot name="head">
        <style>
            .banner__blob, .banner__blob {
                position: absolute;
                left: calc(50% + 120px);
                top: -660px;
                z-index: -3;
            }
            .custom-shape-divider-top-1603422860 {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                overflow: hidden;
                line-height: 0;
            }

            .custom-shape-divider-top-1603422860 svg {
                position: relative;
                display: block;
                width: calc(177% + 1.3px);
                height: 67px;
            }

            .custom-shape-divider-top-1603422860 .shape-fill {
                fill: white;
            }
        </style>
    </x-slot>

        <div class="overflow-hidden">
            <svg class="banner__blob hide-mobile" width="1153px" height="1358px" preserveAspectRatio="xMinYMin meet"
                 viewBox="0 0 1053 1318" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient x1="100%" y1="50%" x2="0%" y2="150%" id="linearGradient-1">
                        <stop stop-color="#4299e1" offset="0%"></stop>
                        <stop stop-color="#4299e1b3" offset="30%"></stop> <stop stop-color="#769AED" offset="100%"></stop>
                    </linearGradient>
                </defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path d="M578.670575,12.9878155 C828.22298,95.5039444 617.609816,389.483628 849.088089,383.175434 C1080.56636,376.86724 1206.24151,748.14952 919.347778,872.961646 C632.454048,997.773771 898.234672,1085.1667 674.799049,1228.68575 C451.363425,1372.2048 168.466418,1221.94953 26.9392134,903.985228 C-114.587991,586.020921 156.061349,-95.4194305 578.670575,12.9878155 Z" id="Path-9-Copy-2" fill="url(#linearGradient-1)" transform="translate(537.183327, 642.347519) rotate(-195.000000) translate(-537.183327, -642.347519) "></path>
                </g>
            </svg>
        </div>


        <section style="padding: 150px 40px">
            <div class="container-lg">
                <div class="row">
                    <div class="col flex-1">
                        <h1 style="font-size: 60px">La plateforme des acteurs de l'assurance.</h1>
                        <p class="h1 text-muted py-4">Lorem ipsum dolor sit amet</p>
                        <div class="py-4">
                            <a class="btn btn-outline-primary btn-lg" href="#">Découvrir</a>
                            <a class="btn btn-primary btn-lg ml-2" href="{{ route('login') }}">Commencer</a>
                        </div>
                    </div>
                    <div class="col flex-1"></div>
                </div>
            </div>
        </section>

        <div class="custom-shape-divider-top-1603422860 position-relative">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
            </svg>
        </div>

        <section style="padding: 150px 40px" class="bg-white">
            <div class="container-lg">
                <div class="row">
                    <div class="col flex-1">
                        <h1 style="font-size: 60px">Un réseau d'expert à portée de main</h1>
                        <p class="h1 text-muted py-4">Lorem ipsum dolor sit amet</p>
                        <div class="py-4">
                            <a class="btn btn-outline-primary btn-lg" href="#">Découvrir</a>
                            <a class="btn btn-primary btn-lg ml-2" href="{{ route('login') }}">Commencer</a>
                        </div>
                    </div>
                    <div class="col flex-1"></div>
                </div>
            </div>
        </section>
</x-page>
