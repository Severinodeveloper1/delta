<footer class="mt-auto bg-slate-900 border-t-4 border-accent text-slate-300">
    <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Brand Column -->
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    @if (isset($company) && $company->logo)
                        <img class="h-10 w-auto object-contain brightness-0 invert"
                            src="{{ asset('storage/' . $company->logo) }}" alt="Delta Logo">
                    @else
                        <span class="text-2xl font-extrabold tracking-tight text-white">
                            IMPORTACIONES <span class="text-accent">DELTA</span>
                        </span>
                    @endif
                </a>
                <p class="text-slate-400 text-sm leading-relaxed">
                    {!! $company->descripcion ?? 'Soluciones tecnológicas avanzadas de envasado, dosificación y sellado de alta velocidad para la industria alimenticia, química y cosmética.' !!}
                </p>
                <!-- Social Links -->
                <div class="flex space-x-3 pt-2">
                    @if (isset($company) && $company->link_facebook)
                        <a href="{{ $company->link_facebook }}" target="_blank"
                            class="w-8 h-8 rounded-full border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:border-white transition-all">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                    @endif
                    @if (isset($company) && $company->link_instagram)
                        <a href="{{ $company->link_instagram }}" target="_blank"
                            class="w-8 h-8 rounded-full border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:border-white transition-all">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </a>
                    @endif
                    @if (isset($company) && $company->link_tiktok)
                        <a href="{{ $company->link_tiktok }}" target="_blank"
                            class="w-8 h-8 rounded-full border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:border-white transition-all">
                            <i class="fa-brands fa-tiktok text-sm"></i>
                        </a>
                    @endif
                    @if (isset($company) && $company->link_youtube)
                        <a href="{{ $company->link_youtube }}" target="_blank"
                            class="w-8 h-8 rounded-full border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:border-white transition-all">
                            <i class="fa-brands fa-youtube text-sm"></i>
                        </a>
                    @endif
                    @if (isset($company) && $company->link_linkedin)
                        <a href="{{ $company->link_linkedin }}" target="_blank"
                            class="w-8 h-8 rounded-full border border-slate-700 flex items-center justify-center text-slate-400 hover:text-white hover:border-white transition-all">
                            <i class="fa-brands fa-linkedin-in text-sm"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-mono text-xs uppercase tracking-widest text-white font-bold mb-4">ENLACES RÁPIDOS</h4>
                <ul class="space-y-3 font-mono text-sm">
                    <li><a href="{{ route('contacto') }}"
                            class="text-slate-400 hover:text-white transition-colors">Contacto Directo</a></li>
                    <li><a href="{{ route('politicas') }}"
                            class="text-slate-400 hover:text-white transition-colors">Políticas de Privacidad</a></li>
                    <li><a href="{{ route('terminos') }}"
                            class="text-slate-400 hover:text-white transition-colors">Términos y Condiciones</a></li>
                </ul>
            </div>

            <!-- Contact info -->
            <div>
                <h4 class="font-mono text-xs uppercase tracking-widest text-white font-bold mb-4">CONTACTO</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-2 text-slate-400">
                        <i class="fa-solid fa-location-dot text-accent mt-1"></i>
                        <span>{{ $company->direccion ?? 'Dirección no especificada' }}</span>
                    </li>
                    <li class="flex items-center gap-2 text-slate-400">
                        <i class="fa-solid fa-phone text-accent"></i>
                        <span>{{ $company->telefono ?? 'Teléfono no especificado' }}</span>
                    </li>
                    <li class="flex items-center gap-2 text-slate-400">
                        <i class="fa-solid fa-envelope text-accent"></i>
                        <span>{{ $company->correo ?? 'Correo no especificado' }}</span>
                    </li>
                    <li class="flex items-center gap-2 text-slate-400">
                        <i class="fa-solid fa-clock text-accent"></i>
                        <span>{{ $company->horario ?? 'Horario no especificado' }}</span>
                    </li>
                </ul>
            </div>

            <!-- Reclamations -->
            <div>
                <h4 class="font-mono text-xs uppercase tracking-widest text-white font-bold mb-4">RECLAMACIONES</h4>
                <p class="text-slate-400 text-sm mb-4">
                    Registre cualquier disconformidad con respecto a nuestros productos o servicios mediante el libro
                    virtual.
                </p>
                <a href="{{ route('libro-reclamaciones') }}"
                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-accent text-white font-bold text-sm tracking-wider uppercase hover:bg-accent-dark transition-all rounded">
                    <i class="fa-solid fa-book-open"></i>
                    Libro de Reclamaciones
                </a>
            </div>
        </div>

        <div
            class="mt-12 pt-6 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center text-xs text-slate-500 gap-4">
            <p>© {{ date('Y') }} IMPORTACIONES DELTA PERU S.A.C. @if (isset($company) && $company->ruc)
                    - RUC: {{ $company->ruc }}
                @endif. Todos los derechos reservados.</p>
            <p>Hecho por: <a href="https://vesergenperu.com/" target="_blank"
                    class="text-slate-400 hover:text-white transition-colors">Grupo VesergenPerú</a></p>
        </div>
    </div>
</footer>
