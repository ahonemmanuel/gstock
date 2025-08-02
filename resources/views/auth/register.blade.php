<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Selection -->
        <div class="mt-4">
            <x-input-label :value="__('Role')" />

            <div class="flex items-center mb-2">
                <input type="radio" id="existingRole" name="role_type" value="existing" checked
                       class="mr-2" onclick="toggleRoleInput()">
                <label for="existingRole">Sélectionner un rôle existant</label>
            </div>

            <div class="flex items-center">
                <input type="radio" id="newRole" name="role_type" value="new"
                       class="mr-2" onclick="toggleRoleInput()">
                <label for="newRole">Créer un nouveau rôle</label>
            </div>

            <!-- Existing roles dropdown -->
            <div id="existingRoleContainer" class="mt-2">
                <select id="role" name="role" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Sélectionnez un rôle</option>
                    @foreach($existingRoles as $role)
                        <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                            {{ ucfirst($role) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- New role input (hidden by default) -->
            <div id="newRoleContainer" class="mt-2 hidden">
                <x-text-input id="new_role" class="block mt-1 w-full"
                              type="text" name="new_role"
                              placeholder="Entrez un nouveau rôle"
                              :value="old('new_role')" />
            </div>

            <x-input-error :messages="$errors->get('role')" class="mt-2" />
            <x-input-error :messages="$errors->get('new_role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function toggleRoleInput() {
            const existingRoleSelected = document.getElementById('existingRole').checked;
            document.getElementById('existingRoleContainer').style.display = existingRoleSelected ? 'block' : 'none';
            document.getElementById('newRoleContainer').style.display = existingRoleSelected ? 'none' : 'block';

            // Make fields required/not required based on selection
            document.getElementById('role').required = existingRoleSelected;
            document.getElementById('new_role').required = !existingRoleSelected;
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', toggleRoleInput);
    </script>
</x-guest-layout>
