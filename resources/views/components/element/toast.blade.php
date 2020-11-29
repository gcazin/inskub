<div aria-live="polite" aria-atomic="true" data-autohide="true">
    <div id="{{ $name }}" class="toast bg-white border-{{ $type }} text-{{ $type }}" style="position: absolute; top: 20px; right: 150px; z-index: 10000; border-bottom: 3px solid transparent; border-top: 0; border-left: 0; border-right: 0" data-delay="4000">
        <div class="toast-body h6 mb-0">
            <span>{{ $slot }}</span>
            <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                <ion-icon name="close-outline" class="small super"></ion-icon>
            </button>
        </div>
    </div>
</div>
