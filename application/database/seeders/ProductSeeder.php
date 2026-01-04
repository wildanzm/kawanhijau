<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get petani user's profile
        $petani = User::where('email', 'petani@gmail.com')->first();
        
        if (!$petani || !$petani->petaniProfile) {
            $this->command->error('User petani atau petani profile tidak ditemukan. Jalankan UserRoleSeeder terlebih dahulu.');
            return;
        }

        $petaniProfileId = $petani->petaniProfile->id;

        // Get all categories
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->command->error('Kategori tidak ditemukan. Jalankan CategorySeeder terlebih dahulu.');
            return;
        }

        // Products data for each category
        $productsData = [
            'Sayuran Daun' => [
                [
                    'name' => 'Bayam Hijau',
                    'description' => 'Bayam hijau organik pilihan, kaya zat besi dan vitamin. Cocok untuk sayur bening, pecel, atau tumisan. Dipanen pagi hari untuk kesegaran maksimal.',
                    'price' => 8000,
                    'unit' => 'pcs',
                    'stock' => 50,
                    'image_path' => 'products/bayam.jpg',
                ]
            ],
            'Sayuran Buah' => [
                [
                    'name' => 'Tomat Merah',
                    'description' => 'Tomat merah matang sempurna, manis dan berair. Kaya likopen dan vitamin C. Ideal untuk sambal, salad, atau jus tomat. Ukuran besar dan seragam.',
                    'price' => 15000,
                    'unit' => 'kg',
                    'stock' => 40,
                    'image_path' => 'products/tomat.jpg',
                ],
            ],
            'Buah-buahan' => [
                [
                    'name' => 'Pisang Cavendish',
                    'description' => 'Pisang cavendish manis dan lembut. Kaya potasium dan energi. Cocok untuk buah meja, smoothie, atau banana bread. Tingkat kematangan dapat disesuaikan.',
                    'price' => 20000,
                    'unit' => 'kg',
                    'stock' => 30,
                    'image_path' => 'products/pisang.jpg',
                ],
                [
                    'name' => 'Jeruk Sunkist Manis',
                    'description' => 'Jeruk sunkist super manis dan berair. Tinggi vitamin C untuk daya tahan tubuh. Ukuran besar dengan kulit tipis. Sempurna untuk jus atau dimakan langsung.',
                    'price' => 35000,
                    'unit' => 'kg',
                    'stock' => 25,
                    'image_path' => 'products/jeruk.jpg',
                ],
            ],
            'Umbi-umbian' => [
                [
                    'name' => 'Kentang Granola',
                    'description' => 'Kentang granola kualitas super dengan daging kuning. Tekstur pulen dan rasa gurih. Cocok untuk kentang goreng, perkedel, atau sup. Sudah dicuci bersih.',
                    'price' => 18000,
                    'unit' => 'kg',
                    'stock' => 60,
                    'image_path' => 'products/kentang.jpg',
                ]
            ],
            'Rempah & Bumbu' => [
                [
                    'name' => 'Bawang Merah',
                    'description' => 'Bawang merah lokal berkualitas dengan aroma kuat dan rasa tajam. Umbi padat dan tahan lama. Ukuran sedang hingga besar. Bumbu dapur yang wajib ada di setiap masakan.',
                    'price' => 38000,
                    'unit' => 'kg',
                    'stock' => 55,
                    'image_path' => 'products/bawang merah.jpg',
                ],
            ],
            'Beras & Bijian' => [
                [
                    'name' => 'Beras Organik Premium',
                    'description' => 'Beras organik premium tanpa pestisida dan pupuk kimia. Butiran pulen, wangi, dan tidak mudah basi. Proses tanam hingga panen terjaga kualitasnya. Sehat untuk keluarga.',
                    'price' => 15000,
                    'unit' => 'kg',
                    'stock' => 100,
                    'image_path' => 'products/beras.jpg',
                ],
                [
                    'name' => 'Jagung Manis',
                    'description' => 'Jagung manis pilihan dengan biji penuh dan rasa super manis. Warna kuning cerah dan tekstur lembut. Cocok untuk rebus, bakar, atau jagung susu. Dipanen pagi hari.',
                    'price' => 8000,
                    'unit' => 'pcs',
                    'stock' => 70,
                    'image_path' => 'products/jagung.jpg',
                ],
            ],
        ];

        // Insert products for each category
        foreach ($categories as $category) {
            if (isset($productsData[$category->name])) {
                foreach ($productsData[$category->name] as $productData) {
                    Product::create([
                        'petani_profile_id' => $petaniProfileId,
                        'category_id' => $category->id,
                        'name' => $productData['name'],
                        'description' => $productData['description'],
                        'price' => $productData['price'],
                        'unit' => $productData['unit'],
                        'stock' => $productData['stock'],
                        'image_path' => $productData['image_path'],
                        'is_active' => true,
                    ]);
                }
            }
        }

        $this->command->info('Seeder produk berhasil dijalankan!');
    }
}
