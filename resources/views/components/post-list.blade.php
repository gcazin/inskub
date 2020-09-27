<!-- Post -->
<div class="w-100">
    @if(request()->is('project/*'))
        <div class="d-flex">
            <div class="col align-self-center">
                <span class="text-muted" id="count"></span>
            </div>
            <div class="col text-right">
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filtrer par
                    </button>
                    <div class="dropdown-menu filters" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" style="cursor: pointer" onclick="filterSelection('all')">Voir tout</a>
                        <a class="dropdown-item" style="cursor: pointer" onclick="filterSelection('images')">Images</a>
                        <a class="dropdown-item" style="cursor: pointer" onclick="filterSelection('documents')">Documents</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @forelse($model as $post)
        @if(request()->is('project/*'))
            <x-post :post="$post" :link="route('project.post.show', ['id' => $post->project_id, 'post_id' => $post->id])"></x-post>
        @else
            <x-post :post="$post"></x-post>
        @endif
    @empty
        <x-alert type="info" icon="information-circle-outline">
            Personne n'a encore publier dans votre espace projet
        </x-alert>
    @endforelse
</div>

<script>
    let shareButton = document.querySelectorAll('.share-button');

    let i;

    document.querySelectorAll('.share-button').forEach(item => {
        item.addEventListener('click', e => {
            e.target.innerText = "Lien copié"

            setTimeout(function() {
                e.target.innerHTML = "<ion-icon class=\"align-text-bottom\" name=\"share-social-outline\"></ion-icon> Partager"
            }, 2500);
        })
    })

    function changeText(e) {
        e.target.innerText = "Lien copié"
    }
</script>
<script>
        filterSelection("all")

        function filterSelection(c) {
            let x, i;

            let count = document.getElementById('count')

            x = document.getElementsByClassName("post");

            if (c === "all") c = "";
            // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
            for (i = 0; i < x.length; i++) {
                //Element qui disparaissent
                w3AddClass(x[i], "d-none");

                //Elements qui doivent apparaitre
                if (x[i].className.indexOf(c) > -1) w3RemoveClass(x[i], "d-none");
            }

            const divsArray = [].slice.call(x);
            //and all divs that are not display none
            const displayShow = divsArray.filter(function (el) {
                return getComputedStyle(el).display !== "none"
            });

            count.innerText = displayShow.length + ' résultats affichés'
        }

        // Show filtered elements
        function w3AddClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                if (arr1.indexOf(arr2[i]) == -1) {
                    element.className += " " + arr2[i];
                }
            }
        }

        // Hide elements that are not selected
        function w3RemoveClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                while (arr1.indexOf(arr2[i]) > -1) {
                    arr1.splice(arr1.indexOf(arr2[i]), 1);
                }
            }
            element.className = arr1.join(" ");
        }

        // Add active class to the current control button (highlight it)
        var btnContainer = document.getElementById("filters");
        var btns = btnContainer.getElementsByClassName("dropdown-item");
        for (let i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                const current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
</script>
