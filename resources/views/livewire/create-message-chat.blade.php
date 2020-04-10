<div class="w-full relative">
    <form wire:submit.prevent="submit">
        @csrf
        <div class="form-group">
            <input type="hidden" wire:model="conversation" value="{{ @request()->route('id') }}">
            <input wire:model="message" id="message" class="input" placeholder="Écrivez votre message" style="height: 70px">
        </div>
        <button type="submit" class="absolute mr-4 mt-3 text-blue-500 text-xl" style="top: 39%;right: 1%;transform: translate(-50%, -50%)">
            <i class="far fa-paper-plane"></i>
        </button>
    </form>
</div>
