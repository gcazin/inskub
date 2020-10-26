@extends('admin.layouts.admin')

@section('title')
    Signalement
@endsection

@section('content')
    <div class="py-3 bg-white rounded shadow-sm container-fluid mb-3">

        <ul class="list-group">
            @forelse($notifications as $notification)
                <li class="list-group-item">
                    <p>
                        <span class="badge badge-danger" style="font-size: 80%">{{ \App\Reason::find($notification->data['reason_id'])->title }}</span>
                        <span class="text-muted"> signalé par {{ \App\User::find($notification->data['informant_id'])->first_name }}</span>
                    </p>
                    <p>{{ \App\Post::find($notification->data['post_id'])->content }}</p>
                    <div class="text-right">
                        <div class="d-inline-block">
                            <x-form :action="route('post.destroy', $notification->data['post_id'])">
                                <button type="submit" class="btn btn-warning">Supprimer le post</button>
                            </x-form>
                        </div>
                        <div class="d-inline-block">
                            <x-form :action="route('post.destroy', $notification->data['post_id'])">
                                <button type="submit" class="btn btn-danger">Bannir l'utilisateur</button>
                            </x-form>
                        </div>
                    </div>
                </li>
            @empty
                <x-alert type="info">Aucun signalement à afficher</x-alert>
            @endforelse
        </ul>

    </div>
@endsection

@section('script')
    <script>
        $('.toast').toast('show')
    </script>
@endsection
