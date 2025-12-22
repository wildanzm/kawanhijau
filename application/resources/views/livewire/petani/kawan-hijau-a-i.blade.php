<div>
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">KawanHijau AI</h1>
                <p class="text-sm text-zinc-600 mt-1">Deteksi hama tanaman dengan teknologi AI</p>
            </div>
        </div>
    </div>

    <!-- Upload Section - Tokopedia Style -->
    <div class="bg-white rounded-xl shadow-sm border border-zinc-200 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-4">
            <h2 class="text-lg font-bold text-white flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                </svg>
                Upload Gambar untuk Deteksi Hama
            </h2>
            <p class="text-sm text-green-50 mt-1">Unggah foto tanaman yang terindikasi hama untuk dianalisis</p>
        </div>

        <div class="p-6">
            <form wire:submit.prevent="detectPest">
                <div class="space-y-4">
                    <!-- Image Upload Area -->
                    <div>
                        <label class="block text-sm font-semibold text-zinc-700 mb-2">Pilih Gambar</label>
                        <div class="relative">
                            <input type="file" wire:model="image" accept="image/*"
                                class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 cursor-pointer border border-zinc-300 rounded-lg"
                                {{ $isProcessing ? 'disabled' : '' }}>
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Image Preview -->
                        @if ($image)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-zinc-700 mb-2">Preview:</p>
                                <div class="relative inline-block">
                                    <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                        class="max-h-64 rounded-lg border-2 border-zinc-200 shadow-md">
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center space-x-3">
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-200 flex items-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ $isProcessing || !$image ? 'disabled' : '' }}>
                            @if ($isProcessing)
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                <span>Memproses...</span>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                                <span>Deteksi Sekarang</span>
                            @endif
                        </button>

                        @if ($image)
                            <button type="button" wire:click="$set('image', null)"
                                class="px-4 py-3 bg-zinc-100 text-zinc-700 font-medium rounded-lg hover:bg-zinc-200 transition-colors">
                                Batal
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Latest Detection Result -->
    @if ($latestDetection)
        <div class="bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 rounded-xl p-6 mb-6">
            <div class="flex flex-col lg:flex-row items-start space-y-4 lg:space-y-0 lg:space-x-6">
                <div class="flex-shrink-0 w-full lg:w-auto">
                    <img src="{{ Storage::url($latestDetection['image_path']) }}" alt="Detected Image"
                        class="w-full lg:w-48 h-48 rounded-lg object-cover border-2 border-white shadow-md">
                </div>
                <div class="flex-1 w-full">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-bold text-zinc-900">Hasil Deteksi</h3>
                        <div class="flex items-center space-x-2">
                            <span
                                class="px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full">{{ number_format($latestDetection['confidence_score'], 1) }}%</span>
                            <button wire:click="clearResult" type="button"
                                class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-full transition-colors">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <p class="text-2xl font-bold text-green-700 mb-4">
                        {{ $latestDetection['detected_disease_name'] }}</p>

                    <div class="space-y-3">
                        <div class="bg-white rounded-lg p-4">
                            <p class="text-sm font-semibold text-zinc-800 mb-2">Deskripsi:</p>
                            <p class="text-sm text-zinc-600">{{ $latestDetection['description'] ?? '-' }}</p>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <p class="text-sm font-semibold text-blue-900 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                Gejala:
                            </p>
                            <p class="text-sm text-blue-800">{{ $latestDetection['symptoms'] ?? '-' }}</p>
                        </div>

                        <!-- Treatment Sections -->
                        <div
                            class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-lg p-5">
                            <div class="flex items-start mb-3">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-green-900 mb-2">Pencegahan</h4>
                                    <div class="text-sm text-green-800 prose prose-sm max-w-none">
                                        {{ $latestDetection['prevention'] ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 border border-blue-200 rounded-lg p-5">
                            <div class="flex items-start mb-3">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-blue-900 mb-2">Penanganan Organik</h4>
                                    <div class="text-sm text-blue-800 prose prose-sm max-w-none">
                                        {{ $latestDetection['organic_solution'] ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-gradient-to-br from-amber-50 to-orange-50 border border-amber-200 rounded-lg p-5">
                            <div class="flex items-start mb-3">
                                <div
                                    class="flex-shrink-0 w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-amber-900 mb-2">Penanganan Kimiawi</h4>
                                    <div class="text-sm text-amber-800 prose prose-sm max-w-none">
                                        {{ $latestDetection['chemical_solution'] ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('detection-success', (event) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: event.message,
                    timer: 3000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                });
            });

            Livewire.on('detection-error', (event) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: event.message,
                    confirmButtonColor: '#10b981',
                });
            });
        });
    </script>
@endpush
