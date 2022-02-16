<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 p-6 rounded-xl">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Register!</h1>
                <form class="mt-10"
                      method="POST" action="/register">
                    @csrf
                    <x-form.input-text name="name"/>
                    <x-form.input-text name="username"/>
                    <x-form.input-text name="email" type="email"/>
                    <x-form.input-text name="password" type="password"/>
                    <x-form.input-text name="password_confirmation" type="password"/>
                    <x-form.button>Submit</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
