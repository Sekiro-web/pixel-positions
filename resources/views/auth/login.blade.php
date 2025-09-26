<x-layout>
    <x-page-heading>Log In</x-page-heading>

    <x-forms.form action="/login" method="POST">
        <x-forms.input label="email" name="email" type="email" />
        <x-forms.input label="password" name="password" type="password" />

        <x-forms.button>Log In</x-forms.button>
    </x-forms.form>
</x-layout>
