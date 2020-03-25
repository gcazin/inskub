<!-- Liste des gens à qui ont a envoyés un chat -->
{{--@if($threads->isNotEmpty())
    @foreach($threads as $inbox)
        @if(!is_null($inbox->thread))--}}
            <a class="flex hover:bg-blue-100 bg-white border-b border-gray-200 border-solid" href="{{--route('chat.chat', ['id'=>$inbox->withUser->id])--}}">
                <div class="flex flex-row px-2 pt-4 pb-5 relative w-full">
                    <div class="w-full lg:w-2/12 self-center">
                        <img src="{{-- \App\User::getAvatar($inbox->withUser->id) --}}" class="mx-auto h-16 rounded-full" alt="">
                    </div>
                    <div class="w-8/12 ml-2 hidden lg:block">
                        <div class="author text-gray-700 font-bold">{{--$inbox->withUser->name--}}</div>
                        <div class="author truncate text-gray-500 trcunate">{{--$inbox->thread->chat--}}</div>
                    </div>
                    <div class="w-2/12 text-sm text-gray-500 text-right hidden lg:block">
                        <div class="date">{{-- $inbox->thread->humans_time --}}</div>

                        {{--@if(auth()->user()->id == $inbox->thread->sender->id)
                            <div class="reply"><i class="fas fa-reply"></i></div>
                        @else
                            @if($inbox->thread->is_seen === 0)
                                <div class="w-2 h-2 bg-green-500 rounded-full ml-auto mt-3"></div>
                            @endif
                        @endif--}}
                    </div>

                </div>
            </a>
        {{--@endif
    @endforeach
@elseif($threads->isEmpty())

@endif--}}

<div>Aucune conversation</div>
