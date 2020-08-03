<form wire:submit.prevent="submit">
    @csrf
    <div class="form-row">
        <div class="col">
            <input type="hidden"  wire:model="conversation" value="{{ @request()->route('id') }}">
            <input wire:model="message" class="form-control" id="message" placeholder="Écrivez votre message" autocomplete="off">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                Envoyer
            </button>
        </div>
    </div>
</form>
