<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="font-display text-2xl text-villa-gold">Acesso Restrito</h2>
        <p class="text-villa-cream/60 text-sm mt-2">Entre com suas credenciais</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-villa-cream/60 text-sm mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors"
                placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-villa-cream/60 text-sm mb-2">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full bg-villa-charcoal/50 border border-villa-coffee focus:border-villa-ember text-villa-cream px-4 py-3 outline-none transition-colors"
                placeholder="********" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                class="w-4 h-4 bg-villa-charcoal/50 border border-villa-coffee text-villa-ember focus:ring-villa-ember focus:ring-offset-0">
            <label for="remember_me" class="ms-3 text-sm text-villa-cream/60">Lembrar-me</label>
        </div>

        <!-- Actions -->
        <div class="space-y-4">
            <button type="submit" class="w-full inline-flex items-center justify-center gap-3 px-8 py-4 bg-villa-ember hover:bg-villa-flame text-white tracking-wider uppercase transition-all duration-300 ember-glow">
                <span>Entrar</span>
            </button>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="text-sm text-villa-cream/60 hover:text-villa-gold transition-colors" href="{{ route('password.request') }}">
                        Esqueceu a senha?
                    </a>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>
