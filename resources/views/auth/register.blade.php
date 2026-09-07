<x-auth-layout>
    <div
        x-data="{
            showPassword: false,
            showPasswordConfirmation: false,
            password: '',
            passwordConfirmation: '',
            acceptedTerms: {{ old('terms') ? 'true' : 'false' }},
            normalizeName(event) {
                const cleaned = event.target.value.replace(/[^\p{L}\s'’]/gu, '').replace(/\s+/g, ' ').trimStart();
                event.target.value = cleaned.replace(/\b\p{L}/gu, (char) => char.toLocaleUpperCase());
            },
            strengthScore() {
                let score = 0;
                if (this.password.length >= 8) score++;
                if (/[a-z]/.test(this.password)) score++;
                if (/[A-Z]/.test(this.password)) score++;
                if (/[0-9]/.test(this.password)) score++;
                if (/[^A-Za-z0-9]/.test(this.password)) score++;

                return score;
            },
            strengthLabel() {
                const labels = ['Muy débil', 'Débil', 'Media', 'Buena', 'Fuerte', 'Excelente'];
                return labels[this.strengthScore()];
            },
            strengthColor() {
                const colors = ['#dc2626', '#ea580c', '#d97706', '#16a34a', '#059669', '#047857'];
                return colors[this.strengthScore()];
            },
            strengthWidth() {
                return `${(this.strengthScore() / 5) * 100}%`;
            },
            passwordsMatch() {
                return this.passwordConfirmation.length === 0 || this.password === this.passwordConfirmation;
            }
        }"
    >
        <!-- Session Error -->
        @if (session('error'))
            <div class="mb-4 flex items-center gap-2 rounded-xl bg-red-50 border border-red-200 p-3 text-xs font-medium text-red-700">
                <i class="ri-error-warning-line text-base text-red-500 shrink-0"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="mb-5">
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-800 border border-emerald-200 text-[11px] font-bold uppercase tracking-wider mb-1.5">
                <i class="ri-user-add-line text-emerald-700"></i> Registro de Cuenta
            </div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Crea tu cuenta en Eat-Cost</h2>
            <p class="text-xs text-gray-600 mt-0.5 font-medium leading-relaxed">
                Comienza a costear tus platillos y optimizar mermas hoy mismo.
            </p>
        </div>

        

        <!-- Divider -->
        <div class="relative my-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="bg-white px-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">o completa el formulario</span>
            </div>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-3.5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1">
                    Nombre completo <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-700">
                        <i class="ri-user-line text-sm"></i>
                    </div>
                    <input
                        id="name"
                        class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-xl text-xs text-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 shadow-2xs transition-colors"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Chef Juan Pérez"
                        required
                        autofocus
                        autocomplete="name"
                        x-on:input="normalizeName($event)"
                        pattern="^[\p{L}]+(?:[\s'’][\p{L}]+)*$"
                    />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1">
                    Correo electrónico <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-700">
                        <i class="ri-mail-line text-sm"></i>
                    </div>
                    <input
                        id="email"
                        class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-xl text-xs text-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 shadow-2xs transition-colors"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="chef@ejemplo.com"
                        required
                        autocomplete="username"
                    />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
            </div>

            <!-- Institution & Faculty Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="institution_name" class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1">
                        Institución
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="ri-building-line text-sm"></i>
                        </div>
                        <input
                            id="institution_name"
                            class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-xl text-xs text-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 shadow-2xs transition-colors"
                            type="text"
                            name="institution_name"
                            value="{{ old('institution_name') }}"
                            placeholder="Universidad / Restaurante"
                            autocomplete="organization"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('institution_name')" class="mt-1 text-xs" />
                </div>

                <div>
                    <label for="faculty_name" class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1">
                        Área / Facultad
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="ri-graduation-cap-line text-sm"></i>
                        </div>
                        <input
                            id="faculty_name"
                            class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-xl text-xs text-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 shadow-2xs transition-colors"
                            type="text"
                            name="faculty_name"
                            value="{{ old('faculty_name') }}"
                            placeholder="Gastronomía / Cocina"
                            autocomplete="organization"
                        />
                    </div>
                    <x-input-error :messages="$errors->get('faculty_name')" class="mt-1 text-xs" />
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1">
                    Contraseña <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-700">
                        <i class="ri-lock-line text-sm"></i>
                    </div>
                    <input
                        id="password"
                        class="w-full pl-9 pr-10 py-2 border border-gray-300 rounded-xl text-xs text-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 shadow-2xs transition-colors"
                        x-bind:type="showPassword ? 'text' : 'password'"
                        name="password"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                        x-model="password"
                    />
                    <button 
                        type="button" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-700 cursor-pointer" 
                        x-on:click="showPassword = !showPassword"
                        tabindex="-1"
                    >
                        <i class="text-sm" x-bind:class="showPassword ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                    </button>
                </div>

                <!-- Password Strength Indicator -->
                <div class="mt-2 rounded-xl border border-gray-200 bg-gray-50/80 p-2.5" x-show="password.length > 0" x-cloak>
                    <div class="h-1.5 w-full rounded-full bg-gray-200 overflow-hidden">
                        <div class="h-1.5 rounded-full transition-all duration-300" x-bind:style="`width: ${strengthWidth()}; background-color: ${strengthColor()}`"></div>
                    </div>
                    <div class="flex justify-between items-center mt-1.5">
                        <p class="text-[11px] font-bold" x-bind:style="`color: ${strengthColor()}`" x-text="`Seguridad: ${strengthLabel()}`"></p>
                        <span class="text-[10px] text-gray-500">Mínimo 8 caracteres</span>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-xs font-bold text-gray-800 uppercase tracking-wider mb-1">
                    Confirmar contraseña <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-700">
                        <i class="ri-lock-check-line text-sm"></i>
                    </div>
                    <input
                        id="password_confirmation"
                        class="w-full pl-9 pr-10 py-2 border border-gray-300 rounded-xl text-xs text-gray-900 placeholder:text-gray-400 focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 shadow-2xs transition-colors"
                        x-bind:type="showPasswordConfirmation ? 'text' : 'password'"
                        name="password_confirmation"
                        placeholder="••••••••"
                        required
                        autocomplete="new-password"
                        x-model="passwordConfirmation"
                    />
                    <button 
                        type="button" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-700 cursor-pointer" 
                        x-on:click="showPasswordConfirmation = !showPasswordConfirmation"
                        tabindex="-1"
                    >
                        <i class="text-sm" x-bind:class="showPasswordConfirmation ? 'ri-eye-off-line' : 'ri-eye-line'"></i>
                    </button>
                </div>
                <p class="mt-1 text-[11px] font-semibold text-red-600" x-show="!passwordsMatch()" x-cloak>
                    <i class="ri-error-warning-line"></i> Las contraseñas no coinciden.
                </p>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
            </div>

            <!-- Terms & Privacy -->
            <div class="flex items-start pt-1">
                <input
                    type="checkbox"
                    id="terms"
                    name="terms"
                    value="1"
                    x-model="acceptedTerms"
                    required
                    class="mt-0.5 rounded border-gray-300 text-emerald-600 shadow-xs focus:ring-emerald-500 h-4 w-4 cursor-pointer"
                >
                <label for="terms" class="ms-2 text-xs text-gray-600 leading-normal">
                    Acepto los
                    <button
                        type="button"
                        class="text-emerald-700 hover:text-emerald-800 font-bold underline hover:underline cursor-pointer"
                        x-on:click.prevent="$dispatch('open-modal', 'terms-modal')"
                    >
                        términos de uso
                    </button>
                    y la
                    <button
                        type="button"
                        class="text-emerald-700 hover:text-emerald-800 font-bold underline hover:underline cursor-pointer"
                        x-on:click.prevent="$dispatch('open-modal', 'privacy-modal')"
                    >
                        política de privacidad
                    </button>.
                </label>
            </div>
            <x-input-error :messages="$errors->get('terms')" class="mt-1 text-xs" />

            <!-- Submit Button -->
            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full text-white text-xs font-bold py-3 rounded-xl transition-all shadow-md flex items-center justify-center gap-2 cursor-pointer"
                    x-bind:disabled="!acceptedTerms"
                    x-bind:class="acceptedTerms ? 'bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 shadow-emerald-600/20' : 'bg-gray-300 cursor-not-allowed shadow-none'"
                >
                    <i class="ri-user-add-line text-sm"></i>
                    <span>Crear mi Cuenta Gratis</span>
                </button>
            </div>

            <!-- Login Link -->
            <div class="pt-3 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-600">
                    ¿Ya tienes una cuenta?
                    <a href="{{ route('login') }}" class="text-emerald-700 hover:text-emerald-800 font-bold hover:underline">
                        Inicia sesión
                    </a>
                </p>
            </div>
        </form>

        <!-- Terms Modal -->
        <x-modal name="terms-modal" :show="false" maxWidth="2xl">
            <div class="p-6 sm:p-7">
                <div class="flex items-center gap-2.5 pb-3 border-b border-gray-100 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                        <i class="ri-file-text-line"></i>
                    </div>
                    <h3 class="text-base font-bold text-gray-900">Términos y Condiciones de Eat-Cost</h3>
                </div>
                
                <div class="space-y-3 text-xs text-gray-600 leading-relaxed max-h-80 overflow-y-auto pr-2">
                    <p>
                        Bienvenido a <strong>Eat-Cost</strong>. Al registrarte y utilizar nuestra plataforma de costeo culinario, aceptas los siguientes términos de servicio.
                    </p>
                    <p>
                        <strong>1. Uso de la plataforma:</strong> Eat-Cost proporciona herramientas para el cálculo de recetas, gestión de mermas y estandarización de costos gastronómicos con fines profesionales y educativos.
                    </p>
                    <p>
                        <strong>2. Privacidad y Seguridad:</strong> No comercializamos ni compartimos tus recetas ni datos financieros con terceros. Toda tu información culinaria es confidencial.
                    </p>
                    <p>
                        <strong>3. Responsabilidad:</strong> Los cálculos y precios sugeridos se basan en los insumos y factores de merma ingresados por el usuario.
                    </p>
                </div>

                <div class="mt-6 pt-3 border-t border-gray-100 flex justify-end">
                    <button
                        type="button"
                        class="rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white hover:bg-emerald-700 transition-colors"
                        x-on:click="$dispatch('close-modal', 'terms-modal')"
                    >
                        Entendido
                    </button>
                </div>
            </div>
        </x-modal>

        <!-- Privacy Modal -->
        <x-modal name="privacy-modal" :show="false" maxWidth="2xl">
            <div class="p-6 sm:p-7">
                <div class="flex items-center gap-2.5 pb-3 border-b border-gray-100 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center text-base">
                        <i class="ri-shield-user-line"></i>
                    </div>
                    <h3 class="text-base font-bold text-gray-900">Política de Privacidad</h3>
                </div>

                <div class="space-y-3 text-xs text-gray-600 leading-relaxed max-h-80 overflow-y-auto pr-2">
                    <p>
                        En <strong>Eat-Cost</strong>, la seguridad y confidencialidad de tus datos culinarios y personales es una prioridad.
                    </p>
                    <p>
                        <strong>Información recopilada:</strong> Tu nombre, correo electrónico, recetas registradas y costos de materia prima.
                    </p>
                    <p>
                        <strong>Uso de datos:</strong> La información se utiliza exclusivamente para el funcionamiento de tus cálculos, generación de reportes y mejora de la experiencia en la aplicación.
                    </p>
                </div>

                <div class="mt-6 pt-3 border-t border-gray-100 flex justify-end">
                    <button
                        type="button"
                        class="rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white hover:bg-emerald-700 transition-colors"
                        x-on:click="$dispatch('close-modal', 'privacy-modal')"
                    >
                        Entendido
                    </button>
                </div>
            </div>
        </x-modal>
    </div>
</x-auth-layout>
