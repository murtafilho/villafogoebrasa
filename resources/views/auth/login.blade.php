<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-6">
        <h2 class="font-display text-2xl text-villa-gold">Acesso Restrito</h2>
        <p class="text-villa-cream/60 text-sm mt-1">Entre com suas credenciais</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-villa-cream/80">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="block mt-1 w-full rounded-lg border-villa-gold/30 bg-villa-charcoal/50 text-villa-cream placeholder-villa-cream/40 focus:border-villa-ember focus:ring-villa-ember" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-villa-cream/80">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block mt-1 w-full rounded-lg border-villa-gold/30 bg-villa-charcoal/50 text-villa-cream placeholder-villa-cream/40 focus:border-villa-ember focus:ring-villa-ember" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-villa-gold/30 bg-villa-charcoal/50 text-villa-ember focus:ring-villa-ember">
                <span class="ms-2 text-sm text-villa-cream/70">Lembrar-me</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-villa-cream/60 hover:text-villa-gold transition-colors" href="{{ route('password.request') }}">
                    Esqueceu a senha?
                </a>
            @endif

            <button type="submit" class="px-6 py-3 bg-villa-ember hover:bg-villa-flame text-white font-medium rounded-lg tracking-wider uppercase text-sm transition-all duration-300 shadow-lg hover:shadow-villa-ember/30">
                Entrar
            </button>
        </div>
    </form>
</x-guest-layout>
