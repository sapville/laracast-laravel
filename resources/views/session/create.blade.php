<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 p-6 rounded-xl">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Log In!</h1>
                <form class="mt-5"
                      method="POST" action="/login">
                    @csrf
                    <x-form.input-text name="email" type="email" autocomplete="username"/>
                    <x-form.input-text name="password" type="password" autocomplete="current-password"/>
                    <input
                        class="checked:bg-blue-500 mr-2"
                        type="checkbox" name="keep" id="keep"><label for="keep" class="text-sm">Keep Me Logged In</label>
                    <x-form.button>Log In</x-form.button>
                </form>
            </x-panel>
         </main>
    </section>
</x-layout>
