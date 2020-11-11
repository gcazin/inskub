<x-slot name="content">
    <div class="container mx-auto text-center">
        <div class="row">
            @role('super-admin')
            <div class="col">
                <a class="h5" href="{{ route('admin.user.index') }}">
                    Utilisateurs
                </a>
            </div>
            @endrole
            <div class="col">
                <a class="h5" href="{{ route('admin.report.index') }}">Signalements</a>
            </div>
            <div class="col">
                <a class="h5" href="{{ route('admin.faq.index') }}">FAQ</a>
            </div>
        </div>
    </div>
</x-slot>
