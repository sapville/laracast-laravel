<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Register!</h1>
            <form class="mt-10"
                  method="POST" action="/register">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="name">Name</label>
                    <input class="border border-gray-400 p-2 w-full"
                           value="{{ old('name') }}"
                           type="text" name="name" id="name" required>
                    @error('name')
                    <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="username">Username</label>
                    <input class="border border-gray-400 p-2 w-full"
                           value="{{ old('username') }}"
                           type="text" name="username" id="username" required>
                    @error('username')
                    <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="email">Email</label>
                    <input class="border border-gray-400 p-2 w-full"
                           value="{{ old('email') }}"
                           type="email" name="email" id="email" required>
                    @error('email')
                        <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="password">Password</label>
                    <input class="border border-gray-400 p-2 w-full"
                           type="password" name="password" id="password" required>
                    @error('password')
                        <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="confirmPassword">Confirm Password</label>
                    <input class="border border-gray-400 p-2 w-full"
                           type="password" name="confirmPassword" id="confirmPassword" required>
                    @error('confirmPassword')
                        <x-error-text>{{ $message }}</x-error-text>
                    @enderror
                </div>
                <div>
                    <button class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                            type="submit">Submit
                    </button>
                </div>
            </form>
        </main>
    </section>
</x-layout>
