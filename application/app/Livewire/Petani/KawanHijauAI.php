<?php

namespace App\Livewire\Petani;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

#[Title('KawanHijau AI | Deteksi Hama')]
#[Layout('layouts.sidebar')]
class KawanHijauAI extends Component
{
    use WithFileUploads;

    public $image;
    public $capturedImage = null;
    public $isProcessing = false;
    public $latestDetection = null;
    public $activeTab = 'upload'; // 'upload' or 'camera'

    public function detectPest()
    {
        // Validate based on active tab
        if ($this->activeTab === 'upload') {
            $this->validate([
                'image' => 'required|image|max:5120', // 5MB Max
            ], [
                'image.required' => 'Silakan pilih gambar untuk dideteksi',
                'image.image' => 'File harus berupa gambar',
                'image.max' => 'Ukuran gambar maksimal 5MB',
            ]);
        } else {
            if (!$this->capturedImage) {
                $this->dispatch('detection-error', message: 'Silakan ambil gambar terlebih dahulu');
                return;
            }
        }

        $this->isProcessing = true;

        try {
            // Save image temporarily for display
            if ($this->activeTab === 'upload') {
                $imagePath = $this->image->store('temp-detections', 'public');
            } else {
                // Handle base64 captured image
                $imagePath = $this->saveCapturedImage();
            }

            // Send to Flask API
            $response = Http::attach(
                'image',
                file_get_contents(storage_path('app/public/' . $imagePath)),
                $this->activeTab === 'upload' ? $this->image->getClientOriginalName() : 'captured.png'
            )->post('http://localhost:5000/api/detect-pest');

            if ($response->successful()) {
                $result = $response->json();

                if ($result['success']) {
                    // Store result in memory only (not in database)
                    $this->latestDetection = [
                        'image_path' => $imagePath,
                        'detected_disease_name' => $result['name'],
                        'confidence_score' => $result['confidence'],
                        'pest_type' => $result['pest_type'],
                        'description' => $result['description'],
                        'symptoms' => $result['symptoms'] ?? $result['description'],
                        'prevention' => $result['prevention'] ?? '-',
                        'organic_solution' => $result['organic_solution'] ?? '-',
                        'chemical_solution' => $result['chemical_solution'] ?? '-',
                        'detected_at' => now(),
                    ];

                    $this->dispatch('detection-success', message: 'Deteksi berhasil! Hama teridentifikasi: ' . $result['name'] . ' (' . $result['confidence'] . '%)');
                } else {
                    // Delete uploaded image if detection failed
                    Storage::disk('public')->delete($imagePath);
                    $this->dispatch('detection-error', message: 'Deteksi gagal: ' . ($result['error'] ?? 'Unknown error'));
                }
            } else {
                // Delete uploaded image if API call failed
                Storage::disk('public')->delete($imagePath);
                $this->dispatch('detection-error', message: 'Gagal terhubung ke server AI');
            }
        } catch (\Exception $e) {
            $this->dispatch('detection-error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        } finally {
            $this->isProcessing = false;
            $this->reset('image');
        }
    }

    protected function saveCapturedImage()
    {
        // Decode base64 image
        $imageData = $this->capturedImage;
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $decodedImage = base64_decode($imageData);
        
        // Generate unique filename
        $filename = 'temp-detections/' . uniqid() . '.png';
        
        // Save to storage
        Storage::disk('public')->put($filename, $decodedImage);
        
        return $filename;
    }

    public function clearResult()
    {
        // Delete temporary image
        if ($this->latestDetection && isset($this->latestDetection['image_path'])) {
            if (Storage::disk('public')->exists($this->latestDetection['image_path'])) {
                Storage::disk('public')->delete($this->latestDetection['image_path']);
            }
        }
        
        $this->latestDetection = null;
        $this->capturedImage = null;
    }

    public function clearCapture()
    {
        $this->capturedImage = null;
    }

    public function render()
    {
        return view('livewire.petani.kawan-hijau-a-i');
    }
}
