<x-page title="Gestion des signalements">
    <x-header>
        <x-slot name="title">Gestion des signalements</x-slot>
        @include('admin.partials.menu')
    </x-header>

    <x-container>
        <x-section>
            <ul class="list-group">
                @forelse($notifications as $notification)
                    <li class="list-group-item">
                        <p>
                            <span class="badge badge-danger" style="font-size: 80%">{{ \App\Models\Reason::find($notification->data['reason_id'])->title }}</span>
                            <span class="text-muted"> signalé par {{ \App\Models\User::find($notification->data['informant_id'])->email }}</span>
                        </p>
                        <p>{{ \App\Models\Post::find($notification->data['post_id'])->content }}</p>
                        <div class="text-right">
                            <div class="d-inline-block">
                                <x-form.item :action="route('post.destroy', $notification->data['post_id'])">
                                    <button type="submit" class="btn btn-outline-info">Supprimer le post</button>
                                </x-form.item>
                            </div>
                            <div class="d-inline-block">
                                <x-form.item :action="route('post.destroy', $notification->data['post_id'])">
                                    <button type="submit" class="btn btn-outline-danger">Bannir l'utilisateur</button>
                                </x-form.item>
                            </div>
                        </div>
                    </li>
                @empty
                    <x-element.alert type="info">
                        <x-slot name="title">Aucun signalement à afficher</x-slot>
                    </x-element.alert>
                @endforelse
            </ul>

        </x-section>
    </x-container>
    <x-slot name="script">
        <script>
            $('.toast').toast('show')
        </script>
    </x-slot>
</x-page>
