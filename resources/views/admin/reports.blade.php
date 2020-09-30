@extends('admin.layouts.admin')

@section('title')
    Signalement
@endsection

@section('content')
    <div class="py-3 bg-white rounded shadow-sm container-fluid mb-3">

        <ul class="list-group">

            <div class="toast" data-autohide="false">
                <div class="toast-header">
                    <svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect fill="#007aff" width="100%" height="100%" /></svg>
                    <strong class="mr-auto">Bootstrap</strong>
                    <small class="text-muted">11 mins ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>

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
