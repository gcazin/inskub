<x-page title="Publier une formation">
    <x-header>
        <x-slot name="title">Publier une formation</x-slot>
        <x-slot name="content">
            <x-form.item :action="route('formation.create')">
                <x-form.input label="Titre de votre formation" name="title" placeholder="Chef de projet..." required></x-form.input>


                <x-form.textarea label="Description" name="description" placeholder="..." required></x-form.textarea>

                <x-form.input label="Localisation" name="location" placeholder="Paris"></x-form.input>

                <x-form.input type="number" label="Prix d'entrée" name="entry_price" placeholder="1300" required></x-form.input>

                <x-form.submit>Publier</x-form.submit>
            </x-form.item>
        </x-slot>
    </x-header>
</x-page>
