<div>

<form action="{{ route('filament.akademik.auth.logout') }}" method="POST" id="logout-form" class="hidden">
    @csrf
</form>

<!-- SideNavBar (Shared Component) -->
<aside class="fixed left-0 top-0 h-full z-40 hidden md:flex flex-col rounded-xl m-4 h-[calc(100vh-32px)] w-72 bg-glass-fill backdrop-blur-xl border border-glass-stroke shadow-xl">
<div class="p-8 flex flex-col h-full">
<div class="flex items-center gap-3 mb-10">
<div class="w-10 h-10 teal-gradient rounded-xl flex items-center justify-center shadow-lg">
<span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">school</span>
</div>
<h1 class="font-headline-lg text-headline-lg text-staff-teal font-black">SIAKAD</h1>
</div>
<nav class="flex-1 space-y-2 overflow-y-auto custom-scrollbar pr-2">
<!-- Dashboard Active -->
<a class="bg-staff-teal text-on-primary rounded-xl flex items-center gap-3 px-4 py-3 scale-95 active:scale-90 transition-transform" href="/akademik">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-label-md text-label-md">Dashboard</span>
</a>
<a class="text-on-surface-variant hover:text-staff-teal hover:bg-staff-teal/10 transition-colors duration-200 flex items-center gap-3 px-4 py-3" href="/akademik/kelas">
<span class="material-symbols-outlined">school</span>
<span class="font-label-md text-label-md">Akademik</span>
</a>
<a class="text-on-surface-variant hover:text-staff-teal hover:bg-staff-teal/10 transition-colors duration-200 flex items-center gap-3 px-4 py-3" href="/akademik/monitoring">
<span class="material-symbols-outlined">monitoring</span>
<span class="font-label-md text-label-md">Monitoring</span>
</a>
<a class="text-on-surface-variant hover:text-staff-teal hover:bg-staff-teal/10 transition-colors duration-200 flex items-center gap-3 px-4 py-3" href="/akademik/pengumuman">
<span class="material-symbols-outlined">campaign</span>
<span class="font-label-md text-label-md">Informasi</span>
</a>
<div class="pt-4 pb-2">
<span class="text-outline text-[10px] font-bold tracking-widest px-4">PERSONAL</span>
</div>
<a class="text-on-surface-variant hover:text-staff-teal hover:bg-staff-teal/10 transition-colors duration-200 flex items-center gap-3 px-4 py-3" href="/akademik/profil">
<span class="material-symbols-outlined">person</span>
<span class="font-label-md text-label-md">Akun</span>
</a>
</nav>
<div class="mt-auto pt-6 border-t border-outline-variant/30">
<div class="flex items-center gap-3 p-2 bg-surface-container-low rounded-xl">
<img class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAWeVb2Uep0bmEs3uedlq3vVDgp__dwxL_zdI-FIjdGcjZPYCAZjjjpQlkeavWEkSwjL6lkYlPyyUtygO8yWG04AsAJgBf5_4O1AgqsWER8qHt1HH78mZfMpFMeRtAGJJLYYP85AjtfwKGxqkckjyMwTll0Xi1AIGu2O_PbiUylLXAIoEE8DyagPcU336wzwZTms4ZnOaPDfP0pYTgUgjZfnuaYsYxnVYz6EIln60a58ZRQwSMDHj44"/>
<div>
<p class="font-label-md text-label-md text-on-surface">{{ auth()->user()->name }}</p>
<p class="text-[10px] text-outline">Academic Portal Staff</p>
</div>
</div>
<button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-4 w-full flex items-center gap-2 px-4 py-2 text-error font-label-md hover:bg-error/5 rounded-lg transition-colors">
<span class="material-symbols-outlined">logout</span>
<span>Logout</span>
</button>
</div>
</div>
</aside>
<!-- Main Wrapper -->
<div class="md:ml-80">
<!-- TopNavBar (Shared Component) -->
<header class="fixed top-0 right-0 left-0 md:left-80 z-30 flex justify-between items-center px-8 h-20 glass-nav">
<div class="flex items-center flex-1 max-w-lg">
<div class="relative w-full group">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-staff-teal transition-colors">search</span>
<input class="w-full h-11 pl-12 pr-4 bg-surface-container-low border-none rounded-full font-body-md focus:ring-2 focus:ring-staff-teal focus:bg-white transition-all" placeholder="Search data, students, or reports..." type="text"/>
</div>
</div>
<div class="flex items-center gap-4">
<div class="hidden lg:flex px-4 py-1.5 bg-staff-teal/10 text-staff-teal rounded-full font-label-sm border border-staff-teal/20">
                    Academic Year 2024/2025
                </div>
<button class="w-10 h-10 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container-high transition-all relative">
<span class="material-symbols-outlined">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
</button>
</div>
</header>
<!-- Page Content -->
<main class="pt-24 px-8 pb-12 hero-mesh min-h-screen">
<!-- Hero Section -->
<section class="relative bento-card teal-gradient mb-8 overflow-hidden group">
<div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
<div class="absolute right-10 top-1/2 -translate-y-1/2 hidden lg:block w-72 h-72 z-10">
<img class="w-full h-full object-contain animate-bounce transition-all duration-[3000ms] ease-in-out" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDn3FoR5IsILQ827kOtO4BGewWMOk4E-ZF8Y8BFJIvWgyXAcUuC7f-XL7uSA3WAv6EWe6ww7CKnqH2rDpRaWpLGR9Ma_mndj5JvY2KsTSnPI0SJUZdglCtc31hZcicbf7r7fFsRLzXKh6Scg_EoL6qbTsUtnvfbcYmtersNevhiA5cnWKkgCKQrF3dMWi8TDCf434w1Qq-8Qe5jopIY8sp_WWoOEbFenphRnJThDnz33Wd9ncg7vIIP"/>
</div>
<div class="relative z-20 max-w-2xl text-white">
<h2 class="font-display-lg text-display-lg-mobile md:text-display-lg mb-4">Selamat Datang,<br/>{{ auth()->user()->name }}!</h2>
<p class="font-body-lg text-body-lg opacity-80 mb-8 max-w-md">Everything you need to manage academic performance and administrative efficiency is right here at your fingertips.</p>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
<div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
<p class="text-white/60 font-label-sm uppercase tracking-wider mb-1">Total Classes</p>
<p class="text-2xl font-bold">{{ $totalClasses }}</p>
</div>
<div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
<p class="text-white/60 font-label-sm uppercase tracking-wider mb-1">Subjects</p>
<p class="text-2xl font-bold">{{ $totalSubjects }}</p>
</div>
<div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
<p class="text-white/60 font-label-sm uppercase tracking-wider mb-1">Teachers</p>
<p class="text-2xl font-bold">{{ $totalTeachers }}</p>
</div>
<div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
<p class="text-white/60 font-label-sm uppercase tracking-wider mb-1">Students</p>
<p class="text-2xl font-bold">{{ $totalStudents }}</p>
</div>
</div>
</div>
</section>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
<!-- Left Column (Main Stats & Timeline) -->
<div class="lg:col-span-8 space-y-8">
<!-- Today's Academic Activities Timeline -->
<div class="bento-card">
<div class="flex justify-between items-center mb-8">
<div>
<h3 class="font-headline-md text-headline-md text-on-surface">Today's Academic Activities</h3>
<p class="text-outline font-label-sm">Monitoring real-time class sessions</p>
</div>
<a class="text-staff-teal font-label-md flex items-center gap-1 hover:underline" href="/akademik/jadwal">
                                View Full Schedule <span class="material-symbols-outlined text-sm">arrow_forward</span>
</a>
</div>
<div class="relative pt-12 pb-4 overflow-x-auto custom-scrollbar">
<!-- Timeline Axis -->
<div class="absolute top-10 left-0 w-full h-[1px] bg-outline-variant/30"></div>
<div class="flex gap-12 min-w-[800px] relative">
@forelse($todaySchedule as $sched)
<div class="flex-none w-64 relative">
<div class="absolute -top-10 left-0 w-3 h-3 rounded-full bg-staff-teal ring-4 ring-staff-teal/20"></div>
<div class="pt-4">
<p class="font-label-sm text-staff-teal">{{ substr($sched->jam_mulai, 0, 5) }} - {{ substr($sched->jam_selesai, 0, 5) }}</p>
<p class="font-bold text-on-surface mt-1">Kelas {{ $sched->kelas?->nama_kelas }}</p>
<p class="text-sm text-outline">{{ $sched->mataPelajaran?->nama_mata_pelajaran }}</p>
<div class="mt-2 flex items-center gap-2">
<div class="w-6 h-6 rounded-full bg-surface-container flex items-center justify-center font-bold text-xs text-staff-teal">
  {{ substr($sched->guru?->nama ?? 'G', 0, 2) }}
</div>
<span class="text-xs font-medium text-on-surface-variant">{{ $sched->guru?->nama }}</span>
</div>
</div>
</div>
@empty
<div class="text-outline text-sm py-4">No academic activities scheduled for today.</div>
@endforelse
</div>
</div>
</div>
<!-- Monitoring Widgets Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<!-- Attendance Today -->
<div class="bento-card relative overflow-hidden flex flex-col items-center text-center">
<h4 class="font-label-md text-outline uppercase self-start mb-6">Attendance Today</h4>
<div class="relative w-32 h-32 mb-4">
<svg class="w-full h-full transform -rotate-90">
<circle class="text-surface-container-high" cx="64" cy="64" fill="transparent" r="58" stroke="currentColor" stroke-width="8"></circle>
<circle class="text-staff-teal transition-all duration-1000" cx="64" cy="64" fill="transparent" r="58" stroke="currentColor" stroke-dasharray="364.4" stroke-dashoffset="{{ 364.4 - (364.4 * $absensiRate / 100) }}" stroke-width="8"></circle>
</svg>
<div class="absolute inset-0 flex items-center justify-center flex-col">
<span class="text-2xl font-black text-on-surface">{{ $absensiRate }}%</span>
<span class="text-[10px] font-bold text-success">HADIR</span>
</div>
</div>
<p class="text-xs text-outline">{{ $presentText }}</p>
</div>
<!-- Materials Uploaded -->
<div class="bento-card flex flex-col">
<h4 class="font-label-md text-outline uppercase mb-6">Materials Uploaded</h4>
<div class="flex-1 flex items-end gap-2 h-24">
<div class="w-full bg-staff-teal/20 rounded-t-md transition-all hover:bg-staff-teal" style="height: {{ $materiHeights['Mon'] ?? 20 }}%"></div>
<div class="w-full bg-staff-teal/20 rounded-t-md transition-all hover:bg-staff-teal" style="height: {{ $materiHeights['Tue'] ?? 20 }}%"></div>
<div class="w-full bg-staff-teal/20 rounded-t-md transition-all hover:bg-staff-teal" style="height: {{ $materiHeights['Wed'] ?? 20 }}%"></div>
<div class="w-full bg-staff-teal/20 rounded-t-md transition-all hover:bg-staff-teal" style="height: {{ $materiHeights['Thu'] ?? 20 }}%"></div>
<div class="w-full bg-staff-teal/20 rounded-t-md transition-all hover:bg-staff-teal" style="height: {{ $materiHeights['Fri'] ?? 20 }}%"></div>
</div>
<div class="mt-4 flex justify-between text-[10px] text-outline font-bold">
<span>MON</span><span>TUE</span><span>WED</span><span>THU</span><span>FRI</span>
</div>
</div>
<!-- Assignments Active -->
<div class="bento-card">
<h4 class="font-label-md text-outline uppercase mb-6">Assignments Active</h4>
<div class="space-y-4">
@forelse($activeTugas as $at)
<div>
<div class="flex justify-between text-xs mb-1">
<span class="font-bold">{{ $at['subject'] }}</span>
<span class="text-outline">{{ $at['submitted'] }}/{{ $at['total'] }} Submitted</span>
</div>
<div class="w-full h-2 bg-surface-container rounded-full overflow-hidden">
<div class="h-full bg-staff-teal" style="width: {{ $at['percentage'] }}%"></div>
</div>
</div>
@empty
<div class="text-xs text-outline">No active assignments.</div>
@endforelse
</div>
</div>
</div>
</div>
<!-- Right Column (Activities & Calendar) -->
<div class="lg:col-span-4 space-y-8">
<!-- Latest Academic Activities -->
<div class="bento-card h-[450px] flex flex-col">
<div class="flex justify-between items-center mb-6">
<h3 class="font-headline-md text-on-surface">Activities</h3>
<button class="w-8 h-8 flex items-center justify-center text-outline hover:bg-surface-container-high rounded-full">
<span class="material-symbols-outlined">more_horiz</span>
</button>
</div>
<div class="flex-1 overflow-y-auto custom-scrollbar pr-2 space-y-6">
@forelse($activities as $act)
<div class="flex gap-4">
<div class="w-10 h-10 rounded-full bg-surface-container-high flex-none overflow-hidden flex items-center justify-center font-bold text-staff-teal border border-staff-teal/10">
    {{ substr($act['title'], 0, 2) }}
</div>
<div class="space-y-1">
<p class="text-sm font-bold text-on-surface">{{ $act['title'] }}</p>
<p class="text-xs text-outline">{{ $act['desc'] }}</p>
<p class="text-[10px] text-outline font-medium">{{ $act['time'] }}</p>
</div>
</div>
@empty
<div class="text-outline text-sm py-4">No recent activities.</div>
@endforelse
</div>
</div>
<!-- Quick Actions -->
<div class="grid grid-cols-1 gap-3">
<a href="/akademik/jadwal" class="teal-gradient text-white h-14 rounded-xl font-label-md flex items-center justify-center gap-2 hover:opacity-90 transition-opacity shadow-lg">
<span class="material-symbols-outlined">event_note</span> Create Schedule
</a>
<a href="/akademik/pengumuman" class="bg-white border border-outline-variant text-on-surface h-14 rounded-xl font-label-md flex items-center justify-center gap-2 hover:bg-surface-container-low transition-colors">
<span class="material-symbols-outlined">campaign</span> Create Announcement
</a>
</div>
<!-- Academic Calendar -->
<div class="bento-card">
<div class="flex justify-between items-center mb-6">
<h4 class="font-label-md font-bold text-on-surface">{{ date('F Y') }}</h4>
<div class="flex gap-2">
<button class="p-1 hover:bg-surface-container rounded"><span class="material-symbols-outlined text-sm">chevron_left</span></button>
<button class="p-1 hover:bg-surface-container rounded"><span class="material-symbols-outlined text-sm">chevron_right</span></button>
</div>
</div>
<div class="grid grid-cols-7 text-center text-[10px] font-bold text-outline mb-4">
<span>MO</span><span>TU</span><span>WE</span><span>TH</span><span>FR</span><span>SA</span><span>SU</span>
</div>
<div class="grid grid-cols-7 text-center gap-y-3 font-label-sm">
<span class="text-outline-variant">28</span><span class="text-outline-variant">29</span><span class="text-outline-variant">30</span><span class="text-outline-variant">31</span>
<span class="hover:text-staff-teal cursor-pointer">1</span><span>2</span><span>3</span>
<span>4</span><span>5</span><span>6</span><span class="bg-staff-teal/10 text-staff-teal rounded-full w-8 h-8 flex items-center justify-center mx-auto">7</span>
<span>8</span><span>9</span><span>10</span><span>11</span>
<span>12</span><span>13</span><span>14</span><span>15</span>
</div>
<div class="mt-6 space-y-3">
<div class="flex items-center gap-3">
<div class="w-2 h-2 rounded-full bg-error"></div>
<span class="text-xs font-medium">Libur Nasional (Sept 16)</span>
</div>
<div class="flex items-center gap-3">
<div class="w-2 h-2 rounded-full bg-staff-teal"></div>
<span class="text-xs font-medium">Rapat Guru Bulanan</span>
</div>
</div>
</div>
</div>
</div>
</main>
</div>
<script>
        document.querySelectorAll('.bento-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
            });
        });
        const searchInput = document.querySelector('input[type="text"]');
        searchInput.addEventListener('focus', () => {
            searchInput.parentElement.classList.add('shadow-md');
        });
        searchInput.addEventListener('blur', () => {
            searchInput.parentElement.classList.remove('shadow-md');
        });
</script>
</div>
