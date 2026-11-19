@props([
    'context' => 'catalog', // 'catalog' or 'details'
])

<div class="space-y-12 sm:space-y-16">
    {{-- Section 1: Where Interactive Flat Panels Are Used --}}
    <section class="bg-white rounded-2xl border border-border-hairline p-6 sm:p-8 lg:p-10 shadow-(--shadow-card)">
        <div class="max-w-3xl mb-8 sm:mb-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-wider mb-3">
                <x-icon name="monitor" class="w-3.5 h-3.5 text-brand-accent" />
                <span>Enterprise & Education Solutions</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-ink-primary">
                Where Interactive Flat Panels Are Used
            </h2>
            <p class="mt-2 text-sm sm:text-base text-ink-secondary leading-relaxed">
                An interactive flat panel is not a normal TV or projector replacement only. It works as an all-in-one collaborative touchscreen display where teams and educators can write, draw, open enterprise files, share multiple screens wirelessly, and run digital whiteboard workflows with zero delay.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
            {{-- Use Case 1 --}}
            <div class="p-5 sm:p-6 rounded-xl border border-border-hairline bg-surface-canvas hover:border-brand-primary/40 hover:bg-white hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-primary text-brand-accent group-hover:scale-105 transition-transform">
                        <x-icon name="briefcase" class="w-5 h-5" />
                    </span>
                    <span class="text-[11px] font-semibold text-brand-primary bg-brand-primary-soft px-2.5 py-1 rounded-full">
                        Commercial Display
                    </span>
                </div>
                <h3 class="text-base font-bold text-ink-primary group-hover:text-brand-primary transition-colors">
                    Corporate Meeting Room
                </h3>
                <p class="mt-2 text-xs sm:text-sm text-ink-secondary leading-relaxed">
                    Designed for executive boardrooms and conference rooms. Supports wireless 4-screen casting, instant document review, real-time PDF markups, and seamless Microsoft Teams &amp; Zoom integration.
                </p>
            </div>

            {{-- Use Case 2 --}}
            <div class="p-5 sm:p-6 rounded-xl border border-border-hairline bg-surface-canvas hover:border-brand-primary/40 hover:bg-white hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-primary text-brand-accent group-hover:scale-105 transition-transform">
                        <x-icon name="graduation-cap" class="w-5 h-5" />
                    </span>
                    <span class="text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                        Interactive Whiteboard
                    </span>
                </div>
                <h3 class="text-base font-bold text-ink-primary group-hover:text-brand-primary transition-colors">
                    Small Classroom &amp; Coaching Room
                </h3>
                <p class="mt-2 text-xs sm:text-sm text-ink-secondary leading-relaxed">
                    For coaching centers and tuition rooms, a 65-inch panel fits standard wall mounts easily. Teachers write lesson notes, open syllabus PDFs, explain interactive diagrams, and save notes for students without whiteboard markers.
                </p>
            </div>

            {{-- Use Case 3 --}}
            <div class="p-5 sm:p-6 rounded-xl border border-border-hairline bg-surface-canvas hover:border-brand-primary/40 hover:bg-white hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-primary text-brand-accent group-hover:scale-105 transition-transform">
                        <x-icon name="school" class="w-5 h-5" />
                    </span>
                    <span class="text-[11px] font-semibold text-brand-primary bg-brand-primary-soft px-2.5 py-1 rounded-full">
                        Smart Education
                    </span>
                </div>
                <h3 class="text-base font-bold text-ink-primary group-hover:text-brand-primary transition-colors">
                    Smart Classroom &amp; Education Setup
                </h3>
                <p class="mt-2 text-xs sm:text-sm text-ink-secondary leading-relaxed">
                    Built for schools and colleges with high daily use. Anti-glare toughened glass, 4K text readability, dual-stylus handwriting recognition, built-in stereo audio, and high RAM/ROM for smooth offline curriculum teaching.
                </p>
            </div>

            {{-- Use Case 4 --}}
            <div class="p-5 sm:p-6 rounded-xl border border-border-hairline bg-surface-canvas hover:border-brand-primary/40 hover:bg-white hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-primary text-brand-accent group-hover:scale-105 transition-transform">
                        <x-icon name="video" class="w-5 h-5" />
                    </span>
                    <span class="text-[11px] font-semibold text-purple-700 bg-purple-50 px-2.5 py-1 rounded-full">
                        Built-in AI Camera
                    </span>
                </div>
                <h3 class="text-base font-bold text-ink-primary group-hover:text-brand-primary transition-colors">
                    Hybrid Class &amp; Video Meeting
                </h3>
                <p class="mt-2 text-xs sm:text-sm text-ink-secondary leading-relaxed">
                    Ideal for hybrid academies and online multi-branch meetings. Integrated 48MP tracking cameras and 8-array beamforming microphones capture crisp speaker voices across the room without setting up external webcams.
                </p>
            </div>

            {{-- Use Case 5 --}}
            <div class="p-5 sm:p-6 rounded-xl border border-border-hairline bg-surface-canvas hover:border-brand-primary/40 hover:bg-white hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-primary text-brand-accent group-hover:scale-105 transition-transform">
                        <x-icon name="presentation" class="w-5 h-5" />
                    </span>
                    <span class="text-[11px] font-semibold text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full">
                        75" &amp; 86" Recommended
                    </span>
                </div>
                <h3 class="text-base font-bold text-ink-primary group-hover:text-brand-primary transition-colors">
                    Training Center &amp; Seminar Room
                </h3>
                <p class="mt-2 text-xs sm:text-sm text-ink-secondary leading-relaxed">
                    Training centers require larger screen real estate because participants sit farther away. A 75-inch or 86-inch display ensures every spreadsheet, slide, and live simulation remains crisp and legible from every row.
                </p>
            </div>

            {{-- Use Case 6 --}}
            <div class="p-5 sm:p-6 rounded-xl border border-border-hairline bg-surface-canvas hover:border-brand-primary/40 hover:bg-white hover:shadow-md transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-primary text-brand-accent group-hover:scale-105 transition-transform">
                        <x-icon name="building-2" class="w-5 h-5" />
                    </span>
                    <span class="text-[11px] font-semibold text-brand-primary bg-brand-primary-soft px-2.5 py-1 rounded-full">
                        86" &amp; 98" Large Scale
                    </span>
                </div>
                <h3 class="text-base font-bold text-ink-primary group-hover:text-brand-primary transition-colors">
                    University Lecture Hall &amp; Large Institution
                </h3>
                <p class="mt-2 text-xs sm:text-sm text-ink-secondary leading-relaxed">
                    For tiered lecture halls, medical colleges, and auditoriums. An 86-inch or 98-inch interactive screen provides massive viewing angles, high optical clarity, powerful sound projection, and 3-year warranty reliability.
                </p>
            </div>
        </div>
    </section>

    {{-- Section 2: Choose Interactive Flat Panel by Room Size --}}
    <section class="bg-white rounded-2xl border border-border-hairline p-6 sm:p-8 lg:p-10 shadow-(--shadow-card)">
        <div class="max-w-3xl mb-8 sm:mb-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-wider mb-3">
                <x-icon name="sliders-horizontal" class="w-3.5 h-3.5 text-brand-accent" />
                <span>Dimension &amp; Room Planning</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-ink-primary">
                Choose Interactive Flat Panel by Room Size
            </h2>
            <p class="mt-2 text-sm sm:text-base text-ink-secondary leading-relaxed">
                Display size should match room dimensions, viewing distance, and audience headcount so every participant can read formulas, slides, and notes comfortably. Proud Rock Ltd. supplies 65″, 75″, 86″, and 98″ sizes nationwide.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            {{-- 65 Inch --}}
            <div class="rounded-xl border border-border-hairline bg-surface-canvas p-5 flex flex-col justify-between hover:border-brand-primary/50 hover:bg-white hover:shadow-md transition-all">
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-border-hairline">
                        <span class="text-2xl font-black text-brand-primary">65″</span>
                        <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full">Small Rooms</span>
                    </div>
                    <div class="mt-4 space-y-2 text-xs text-ink-secondary">
                        <div class="flex items-center justify-between">
                            <span class="text-ink-muted">Room Capacity:</span>
                            <span class="font-semibold text-ink-primary">5 – 15 Persons</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-ink-muted">Viewing Distance:</span>
                            <span class="font-semibold text-ink-primary">2.0m – 4.5m</span>
                        </div>
                        <div class="pt-2">
                            <span class="text-ink-muted block mb-1">Recommended Deployment:</span>
                            <p class="text-ink-primary font-medium leading-snug">
                                Coaching classrooms, huddle rooms, personal executive offices, compact meeting suites.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 pt-3 border-t border-border-hairline/80 text-[11px] text-ink-muted">
                    <span class="font-semibold text-brand-primary">Available Models:</span> METZ 65HD1, Hikvision DS-D5C65, Dahua LPH65
                </div>
            </div>

            {{-- 75 Inch --}}
            <div class="rounded-xl border border-border-hairline bg-surface-canvas p-5 flex flex-col justify-between hover:border-brand-primary/50 hover:bg-white hover:shadow-md transition-all">
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-border-hairline">
                        <span class="text-2xl font-black text-brand-primary">75″</span>
                        <span class="text-xs font-semibold text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-full">Medium Rooms</span>
                    </div>
                    <div class="mt-4 space-y-2 text-xs text-ink-secondary">
                        <div class="flex items-center justify-between">
                            <span class="text-ink-muted">Room Capacity:</span>
                            <span class="font-semibold text-ink-primary">15 – 30 Persons</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-ink-muted">Viewing Distance:</span>
                            <span class="font-semibold text-ink-primary">3.5m – 6.5m</span>
                        </div>
                        <div class="pt-2">
                            <span class="text-ink-muted block mb-1">Recommended Deployment:</span>
                            <p class="text-ink-primary font-medium leading-snug">
                                Standard school classrooms, corporate conference rooms, departmental workshop labs.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 pt-3 border-t border-border-hairline/80 text-[11px] text-ink-muted">
                    <span class="font-semibold text-brand-primary">Available Models:</span> Custom OEM &amp; Corporate Supply on Request
                </div>
            </div>

            {{-- 86 Inch (Featured) --}}
            <div class="rounded-xl border-2 border-brand-primary bg-brand-primary/[0.02] p-5 flex flex-col justify-between shadow-sm relative">
                <span class="absolute -top-3 right-4 px-2.5 py-0.5 rounded-full bg-brand-accent text-ink-primary text-[10px] font-bold tracking-wider uppercase shadow-xs">
                    Most Popular
                </span>
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-brand-primary/20">
                        <span class="text-2xl font-black text-brand-primary">86″</span>
                        <span class="text-xs font-semibold text-brand-primary bg-brand-primary-soft px-2.5 py-0.5 rounded-full">Large Halls</span>
                    </div>
                    <div class="mt-4 space-y-2 text-xs text-ink-secondary">
                        <div class="flex items-center justify-between">
                            <span class="text-ink-muted">Room Capacity:</span>
                            <span class="font-semibold text-ink-primary">30 – 60 Persons</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-ink-muted">Viewing Distance:</span>
                            <span class="font-semibold text-ink-primary">5.0m – 9.0m</span>
                        </div>
                        <div class="pt-2">
                            <span class="text-ink-muted block mb-1">Recommended Deployment:</span>
                            <p class="text-ink-primary font-medium leading-snug">
                                Corporate boardrooms, seminar training centers, university colleges, large lecture rooms.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 pt-3 border-t border-brand-primary/20 text-[11px] text-ink-muted">
                    <span class="font-semibold text-brand-primary">Available Models:</span> BenQ RE8604, Hikvision DS-D5A86RB/A3
                </div>
            </div>

            {{-- 98 Inch --}}
            <div class="rounded-xl border border-border-hairline bg-surface-canvas p-5 flex flex-col justify-between hover:border-brand-primary/50 hover:bg-white hover:shadow-md transition-all">
                <div>
                    <div class="flex items-center justify-between pb-3 border-b border-border-hairline">
                        <span class="text-2xl font-black text-brand-primary">98″</span>
                        <span class="text-xs font-semibold text-purple-700 bg-purple-50 px-2.5 py-0.5 rounded-full">Auditorium</span>
                    </div>
                    <div class="mt-4 space-y-2 text-xs text-ink-secondary">
                        <div class="flex items-center justify-between">
                            <span class="text-ink-muted">Room Capacity:</span>
                            <span class="font-semibold text-ink-primary">60 – 120+ Persons</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-ink-muted">Viewing Distance:</span>
                            <span class="font-semibold text-ink-primary">7.0m – 15.0m+</span>
                        </div>
                        <div class="pt-2">
                            <span class="text-ink-muted block mb-1">Recommended Deployment:</span>
                            <p class="text-ink-primary font-medium leading-snug">
                                University auditoriums, convention centers, institutional keynotes, hospital amphitheaters.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 pt-3 border-t border-border-hairline/80 text-[11px] text-ink-muted">
                    <span class="font-semibold text-brand-primary">Available Models:</span> Project &amp; Tender Basis Supply
                </div>
            </div>
        </div>
    </section>

    {{-- Section 3: Interactive Panel vs Projector vs TV --}}
    <section class="bg-white rounded-2xl border border-border-hairline p-6 sm:p-8 lg:p-10 shadow-(--shadow-card)">
        <div class="max-w-3xl mb-8 sm:mb-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-primary-soft text-brand-primary text-xs font-semibold uppercase tracking-wider mb-3">
                <x-icon name="check-circle-2" class="w-3.5 h-3.5 text-brand-accent" />
                <span>Buyer's Comparison Guide</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-ink-primary">
                Interactive Panel vs Projector vs TV
            </h2>
            <p class="mt-2 text-sm sm:text-base text-ink-secondary leading-relaxed">
                An interactive flat panel is the premier direction when writing, touch control, smart whiteboard tools, screen sharing, and real-time collaboration are needed. Projectors and TVs can display content, but they cannot replace a complete interactive workflow.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Interactive Flat Panel (Winner) --}}
            <div class="rounded-2xl border-2 border-brand-primary bg-brand-primary/[0.02] p-6 sm:p-7 shadow-md relative flex flex-col justify-between">
                <span class="absolute -top-3.5 left-6 px-3 py-1 rounded-full bg-brand-primary text-white text-[11px] font-bold tracking-wider uppercase shadow-xs flex items-center gap-1.5">
                    <x-icon name="award" class="w-3.5 h-3.5 text-brand-accent" />
                    <span>Recommended Standard</span>
                </span>

                <div>
                    <div class="pt-2 pb-4 border-b border-brand-primary/20">
                        <h3 class="text-xl font-bold text-brand-primary">Interactive Flat Panel</h3>
                        <p class="text-xs text-ink-secondary mt-1">4K UHD Touch Display · Whiteboard · Meeting Hub</p>
                    </div>

                    <div class="mt-5 space-y-3.5 text-xs sm:text-sm">
                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-emerald-600">
                                <x-icon name="check" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Writing &amp; Multi-Touch:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">20 to 50-point precision multi-touch with zero-gap pen-on-paper response and dual-stylus writing.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-emerald-600">
                                <x-icon name="check" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Daylight Clarity:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">400–450 nits anti-glare toughened glass; crystal clear 4K text under bright office or classroom lighting with no window blinds needed.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-emerald-600">
                                <x-icon name="check" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Smart Collaboration:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">Android 14 (Google EDLA) + optional Windows OPS. Built-in digital whiteboard, 4-screen wireless casting, and cloud storage sync.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-emerald-600">
                                <x-icon name="check" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Integrated Audio &amp; Camera:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">48MP auto-framing AI camera, 8-array beamforming microphone, and 40W+ front stereo sound built into the chassis.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-emerald-600">
                                <x-icon name="check" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Lifespan &amp; Maintenance:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">50,000 hours lamp-free industrial grade lifespan. Zero consumable costs and 3 years warranty support.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-brand-primary/20">
                    <span class="text-xs font-semibold text-brand-primary">Verdict:</span>
                    <p class="text-xs text-ink-secondary mt-0.5">The complete modern solution for interactive classrooms, modern meeting spaces, and hybrid corporate presentations.</p>
                </div>
            </div>

            {{-- Projector --}}
            <div class="rounded-2xl border border-border-hairline bg-surface-canvas p-6 sm:p-7 flex flex-col justify-between">
                <div>
                    <div class="pb-4 border-b border-border-hairline">
                        <h3 class="text-xl font-bold text-ink-primary">Traditional Projector</h3>
                        <p class="text-xs text-ink-secondary mt-1">Optical Projection Screen Setup</p>
                    </div>

                    <div class="mt-5 space-y-3.5 text-xs sm:text-sm">
                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-amber-500">
                                <x-icon name="alert-circle" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Writing &amp; Touch:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">No touch interaction. Requires expensive external sensor bars with noticeable lag and frequent recalibration.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-amber-500">
                                <x-icon name="alert-circle" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Ambient Light:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">Washes out easily in daylight. Requires dark rooms, closed curtains, and casts body shadows over the screen when speaking.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-amber-500">
                                <x-icon name="alert-circle" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Smart Features:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">No native operating system. Always requires a connected laptop or desktop PC via messy VGA or HDMI cables.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-amber-500">
                                <x-icon name="alert-circle" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Audio &amp; Mic:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">Weak or absent internal speakers. Requires separate external sound system and standalone webcam for video meetings.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-amber-500">
                                <x-icon name="alert-circle" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Maintenance:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">High ongoing cost: projector bulbs must be replaced every 2,000–4,000 hours; noisy cooling fan and dust filters.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-border-hairline">
                    <span class="text-xs font-semibold text-ink-muted">Verdict:</span>
                    <p class="text-xs text-ink-secondary mt-0.5">Good only for basic large-screen passive projection where budget is the only constraint and touch is not needed.</p>
                </div>
            </div>

            {{-- TV --}}
            <div class="rounded-2xl border border-border-hairline bg-surface-canvas p-6 sm:p-7 flex flex-col justify-between">
                <div>
                    <div class="pb-4 border-b border-border-hairline">
                        <h3 class="text-xl font-bold text-ink-primary">Standard TV / Smart TV</h3>
                        <p class="text-xs text-ink-secondary mt-1">Consumer Living Room &amp; Signage Display</p>
                    </div>

                    <div class="mt-5 space-y-3.5 text-xs sm:text-sm">
                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-red-500">
                                <x-icon name="x" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Writing &amp; Touch:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">Zero touch support. Fragile consumer glass is not built for pen or finger writing and will damage under pressure.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-amber-500">
                                <x-icon name="alert-circle" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Reflective Glare:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">High-gloss reflective panel produces disturbing reflections from ceiling tube lights and window sunlight.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-red-500">
                                <x-icon name="x" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Collaboration Software:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">Consumer smart TV software (Netflix, YouTube) lacks enterprise whiteboards, PDF annotation, or multi-screen casting.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-amber-500">
                                <x-icon name="alert-circle" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Audio &amp; Mic:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">Standard down-firing speakers; no built-in conferencing camera or microphone array for hybrid classrooms.</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5">
                            <span class="shrink-0 mt-0.5 text-amber-500">
                                <x-icon name="alert-circle" class="w-4 h-4" />
                            </span>
                            <div>
                                <span class="font-bold text-ink-primary">Duty Cycle:</span>
                                <span class="text-ink-secondary block text-xs mt-0.5">Designed for 6–8 hours/day home use. Prone to backlight degradation when operated continuously in commercial venues.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-border-hairline">
                    <span class="text-xs font-semibold text-ink-muted">Verdict:</span>
                    <p class="text-xs text-ink-secondary mt-0.5">Suitable for reception lobbies and passive video playback, but completely ineffective for classroom writing or interactive meetings.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 4: Engineering Consultation & Project Quotation CTA --}}
    <section class="rounded-2xl bg-brand-primary text-white p-6 sm:p-8 lg:p-10 relative overflow-hidden shadow-xl">
        <div class="absolute -right-12 -bottom-12 w-64 h-64 rounded-full bg-brand-accent/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-brand-accent text-xs font-semibold uppercase tracking-wider mb-3">
                    <x-icon name="shield-check" class="w-3.5 h-3.5" />
                    <span>Nationwide Supply &amp; Professional Installation</span>
                </span>
                <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold tracking-tight text-white">
                    Planning an Interactive Flat Panel Deployment?
                </h3>
                <p class="mt-2 text-xs sm:text-sm text-white/80 leading-relaxed">
                    Proud Rock Limited is your authorized system integration partner in Bangladesh. We provide genuine 65″, 75″, 86″, and 98″ interactive displays from trusted global brands like BenQ, Hikvision, Dahua, and METZ with on-site wall mounting, OPS Windows configuration, and 3-year warranty backing.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 shrink-0">
                <a
                    href="https://wa.me/8801712806237?text={{ urlencode('Hello Proud Rock, I am inquiring about Interactive Flat Panel Displays for our institution/office.') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white font-semibold text-xs sm:text-sm hover:bg-emerald-500 transition-colors shadow-lg"
                >
                    <x-icon name="whatsapp" class="w-4 h-4 fill-current" />
                    <span>WhatsApp Inquiry</span>
                </a>
                <x-ui.button :href="route('contact.index')" variant="accent" size="lg" class="text-xs sm:text-sm">
                    Request Corporate Quote
                </x-ui.button>
            </div>
        </div>
    </section>
</div>
