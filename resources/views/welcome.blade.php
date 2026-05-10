<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aura Pricing AI</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (via CDN for guaranteed availability in all environments) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    animation: {
                        'gradient-x': 'gradient-x 15s ease infinite',
                    },
                    keyframes: {
                        'gradient-x': {
                            '0%, 100%': {
                                'background-size': '200% 200%',
                                'background-position': 'left center'
                            },
                            '50%': {
                                'background-size': '200% 200%',
                                'background-position': 'right center'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .input-glass {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .input-glass:focus {
            background: rgba(0, 0, 0, 0.4);
            border-color: rgba(99, 102, 241, 0.5);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
            outline: none;
        }
        
        /* Custom date picker icon color */
        ::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.7;
            cursor: pointer;
        }
    </style>
</head>
<body class="antialiased min-h-screen bg-slate-950 text-slate-100 flex items-center justify-center p-4 sm:p-8 relative overflow-hidden">
    
    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
        <div class="absolute -top-[40%] -left-[10%] w-[70%] h-[70%] rounded-full bg-indigo-900/30 blur-[120px]"></div>
        <div class="absolute -bottom-[40%] -right-[10%] w-[70%] h-[70%] rounded-full bg-fuchsia-900/20 blur-[120px]"></div>
    </div>

    <div class="w-full max-w-5xl grid grid-cols-1 lg:grid-cols-12 gap-8 relative z-10">
        
        <!-- Left Column: Form -->
        <div class="lg:col-span-5 flex flex-col justify-center">
            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-bold mb-3 bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 via-purple-400 to-fuchsia-400">
                    AI Pricing
                </h1>
                <p class="text-slate-400 text-lg">Optimalkan harga sewa properti Anda menggunakan kecerdasan buatan dan data pasar real-time.</p>
            </div>

            <form id="pricing-form" class="glass-panel rounded-2xl p-6 sm:p-8 shadow-2xl">
                <div class="space-y-5">
                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5" for="location">Lokasi Properti</label>
                        <select id="location" name="location" class="w-full input-glass rounded-xl px-4 py-3 appearance-none cursor-pointer">
                            <option value="Bali">Bali</option>
                            <option value="Jakarta">Jakarta</option>
                            <option value="Yogyakarta">Yogyakarta</option>
                            <option value="Bandung">Bandung</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5" for="date">Tanggal Sewa</label>
                        <input type="date" id="date" name="date" class="w-full input-glass rounded-xl px-4 py-3" required>
                    </div>

                    <!-- Rating -->
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-1.5" for="rating">Rating Saat Ini (1.0 - 5.0)</label>
                        <div class="flex items-center space-x-4">
                            <input type="range" id="rating-slider" name="rating" min="1.0" max="5.0" step="0.1" value="4.5" class="w-full h-2 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-indigo-500">
                            <span id="rating-display" class="font-mono font-bold text-indigo-400 text-lg w-10 text-center">4.5</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submit-btn" class="w-full mt-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold py-3.5 px-4 rounded-xl shadow-lg shadow-indigo-900/50 transform transition-all active:scale-[0.98] flex justify-center items-center group">
                        <span id="btn-text">Dapatkan Rekomendasi Harga</span>
                        <svg id="btn-spinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <svg id="btn-icon" class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Column: Results -->
        <div class="lg:col-span-7 flex flex-col justify-center">
            
            <!-- Empty State -->
            <div id="empty-state" class="glass-panel rounded-3xl p-10 flex flex-col items-center justify-center text-center h-full min-h-[400px] transition-all duration-500">
                <div class="w-20 h-20 bg-indigo-900/50 rounded-full flex items-center justify-center mb-6 shadow-inner">
                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-xl font-medium text-slate-200 mb-2">Belum Ada Data</h3>
                <p class="text-slate-400 max-w-sm">Masukkan lokasi, tanggal, dan rating di panel kiri untuk melihat analisis harga yang didukung AI.</p>
            </div>

            <!-- Result State -->
            <div id="result-state" class="hidden opacity-0 transform translate-y-8 transition-all duration-700 h-full">
                
                <!-- Main Price Card -->
                <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-t-3xl p-8 relative overflow-hidden shadow-2xl">
                    <!-- Decor -->
                    <div class="absolute top-0 right-0 p-4 opacity-20">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.31-8.86c-1.77-.45-2.34-.94-2.34-1.67 0-.84.79-1.43 2.1-1.43 1.38 0 1.9.66 1.94 1.64h1.71c-.05-1.34-.87-2.57-2.49-2.97V5H10.9v1.69c-1.51.32-2.72 1.3-2.72 2.81 0 1.79 1.49 2.69 3.66 3.21 1.95.46 2.34 1.15 2.34 1.87 0 .53-.39 1.64-2.25 1.64-1.74 0-2.1-.96-2.17-1.92H8.01c.09 1.96 1.28 2.87 2.89 3.22V19h2.4v-1.66c1.64-.32 2.74-1.45 2.74-2.99 0-2.05-1.54-2.78-3.73-3.21z"/></svg>
                    </div>
                    
                    <div class="relative z-10">
                        <p class="text-indigo-200 font-medium tracking-wide uppercase text-sm mb-1">Rekomendasi AI</p>
                        <div class="flex items-baseline space-x-2">
                            <span class="text-3xl font-light text-indigo-100">Rp</span>
                            <h2 id="res-recommended" class="text-5xl md:text-6xl font-bold text-white tracking-tight">0</h2>
                        </div>
                        
                        <div class="mt-6 flex items-center space-x-3 bg-white/10 w-max px-4 py-2 rounded-full backdrop-blur-md">
                            <div id="trend-icon" class="w-6 h-6 rounded-full bg-emerald-400/20 text-emerald-400 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                            </div>
                            <span id="res-difference" class="text-sm font-medium text-emerald-300">+0% dari rata-rata pasar</span>
                        </div>
                    </div>
                </div>

                <!-- Details Panel -->
                <div class="glass-panel rounded-b-3xl p-8 border-t-0 shadow-xl">
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div>
                            <p class="text-slate-400 text-sm mb-1">Rata-rata Pasar</p>
                            <p id="res-average" class="text-2xl font-semibold text-slate-200">Rp 0</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-sm mb-1">Kondisi Tanggal</p>
                            <p id="res-condition" class="text-2xl font-semibold text-slate-200 capitalize">Weekday</p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex items-center space-x-2 mb-3">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h4 class="font-medium text-indigo-300">Analisis AI</h4>
                        </div>
                        <p id="res-reason" class="text-slate-300 leading-relaxed bg-slate-900/50 p-5 rounded-2xl border border-slate-800">
                            Memuat analisis...
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        // Set default date to today
        document.getElementById('date').valueAsDate = new Date();

        // Sync rating slider with display
        const ratingSlider = document.getElementById('rating-slider');
        const ratingDisplay = document.getElementById('rating-display');
        ratingSlider.addEventListener('input', (e) => {
            ratingDisplay.textContent = parseFloat(e.target.value).toFixed(1);
        });

        // Format Currency
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID').format(number);
        };

        // Form Submit Handler
        document.getElementById('pricing-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const btn = document.getElementById('submit-btn');
            const btnText = document.getElementById('btn-text');
            const btnSpinner = document.getElementById('btn-spinner');
            const btnIcon = document.getElementById('btn-icon');
            
            const emptyState = document.getElementById('empty-state');
            const resultState = document.getElementById('result-state');

            // Set Loading State
            btn.disabled = true;
            btnText.textContent = "Menganalisis...";
            btnSpinner.classList.remove('hidden');
            btnIcon.classList.add('hidden');
            
            if (!resultState.classList.contains('hidden')) {
                resultState.classList.add('opacity-50');
            }

            try {
                // Prepare Payload
                const payload = {
                    location: document.getElementById('location').value,
                    date: document.getElementById('date').value,
                    rating: parseFloat(document.getElementById('rating-slider').value)
                };

                // Fetch API
                const response = await fetch('/api/price-recommendation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                if (!response.ok) throw new Error('Terjadi kesalahan pada server');
                const data = await response.json();

                // Populate Results
                document.getElementById('res-recommended').textContent = formatRupiah(data.recommended_price);
                document.getElementById('res-average').textContent = 'Rp ' + formatRupiah(data.market_average);
                document.getElementById('res-condition').textContent = data.condition;
                document.getElementById('res-reason').textContent = data.reason;

                // Calculate Difference
                const diff = data.recommended_price - data.market_average;
                const pct = Math.round(Math.abs(diff) / data.market_average * 100);
                const trendIcon = document.getElementById('trend-icon');
                const resDiff = document.getElementById('res-difference');

                if (diff >= 0) {
                    trendIcon.className = "w-6 h-6 rounded-full bg-emerald-400/20 text-emerald-400 flex items-center justify-center";
                    trendIcon.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>`;
                    resDiff.textContent = `+${pct}% di atas pasar`;
                    resDiff.className = "text-sm font-medium text-emerald-300";
                } else {
                    trendIcon.className = "w-6 h-6 rounded-full bg-rose-400/20 text-rose-400 flex items-center justify-center";
                    trendIcon.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>`;
                    resDiff.textContent = `-${pct}% di bawah pasar`;
                    resDiff.className = "text-sm font-medium text-rose-300";
                }

                // Show Results with Animation
                emptyState.classList.add('hidden');
                resultState.classList.remove('hidden');
                
                // Trigger reflow for animation
                void resultState.offsetWidth;
                
                resultState.classList.remove('opacity-0', 'translate-y-8', 'opacity-50');

            } catch (error) {
                alert('Gagal mengambil data dari server. Pastikan API berjalan normal.');
                console.error(error);
                resultState.classList.remove('opacity-50');
            } finally {
                // Reset Loading State
                btn.disabled = false;
                btnText.textContent = "Dapatkan Rekomendasi Harga";
                btnSpinner.classList.add('hidden');
                btnIcon.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
