<div class="py-2 relative overflow-y-auto" id="conversation">
    @foreach($messages as $message)
        <div class="flex @if($message['is_sender'] === auth()->user()->id) justify-end @endif" id="message-{{$message['id']}}">
            <div class="bull py-3 w-8/12">
                <div class="flex @if($message['is_sender'] === auth()->user()->id) justify-end @endif">
                    <div class="w-11/12 @if($message['is_sender'] === auth()->user()->id) {{'bg-blue-300'}} @else {{'bg-gray-100'}} @endif rounded-lg px-5 py-2">
                        <p>{{$message['body']}}</p>
                        <div class="text-right">
                            <small class="text-sm text-gray-600">{{--$message->humans_time--}}</small>
                            <a href="#" class="talkDeleteMessage" data-message-id="{{$message['id']}}" title="Delete Message"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
