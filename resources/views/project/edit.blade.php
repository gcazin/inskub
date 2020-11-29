<x-page>
    <x-container>
        <x-section>
            <x-form.item :action="route('project.update', $project->id)" method="put">
                <x-form.input label="Titre" name="title" :value="$project->title"></x-form.input>
                <x-form.textarea label="Description" name="description" :value="$project->description"></x-form.textarea>

                <x-form.submit>
                    Modifier le projet
                </x-form.submit>
            </x-form.item>
        </x-section>
    </x-container>
</x-page>
