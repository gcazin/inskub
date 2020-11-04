<footer class="px-lg-10 px-4 py-10 mt-8 {{ request()->is('index*') ? 'd-none' : null }}" style="background: linear-gradient(180deg, rgba(22, 70, 188, 0.8) 0%, rgba(22, 70, 188, 0.8) 100%, #1646BC 100%, rgba(22, 70, 188, 0.6) 100%);">
    <div class="row">
        <div class="col-lg col-6">
            <p class="text-uppercase text-white-50">Contact</p>
            <ul class="list-unstyled">
                <li>
                    <a class="text-white" href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
                </li>
            </ul>
        </div>
        <div class="col-lg col-6">
            <p class="text-uppercase text-white-50">Menu</p>
        </div>
        <div class="col-lg col-6">
            <p class="text-uppercase text-white-50">Nous suivre</p>
            <ul class="list-unstyled">
                <li>
                    <a class="text-white" href="#">Facebook</a>
                </li>
                <li>
                    <a class="text-white" href="#">LinkedIn</a>
                </li>
                <li>
                    <a class="text-white" href="#">Twitter</a>
                </li>
            </ul>
        </div>
        <div class="col-lg col-6">
            <p class="text-uppercase text-white-50">A propos</p>
            <ul class="list-unstyled">
                <li>
                    <a class="text-white" href="{{ route('faq.index') }}">FAQ</a>
                </li>
            </ul>
        </div>
    </div>
</footer>
