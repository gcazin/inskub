<x-slot name="content">
    <div class="container mx-auto text-center">
        <div class="row">
            <div class="col">
                <a class="h5" href="{{ route('school.index') }}">
                    Vue d'ensemble
                </a>
            </div>
            <div class="col">
                <a class="h5" href="{{ route('school.classroom.index') }}">
                    Salle de classe
                </a>
            </div>
            <div class="col">
                <a class="h5" href="{{ route('school.professor.index') }}">
                    Professeurs
                </a>
            </div>
            <div class="col">
                <a class="h5" href="{{ route('school.student.index') }}">
                    Eleves
                </a>
            </div>
        </div>
    </div>
</x-slot>
