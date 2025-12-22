from flask import Flask, request, jsonify
from flask_cors import CORS
from ultralytics import YOLO
from PIL import Image
import os
import numpy as np
import io
import logging
import traceback
import torch
from ultralytics.nn.tasks import ClassificationModel 
from ultralytics.nn.modules import conv, block, head
from torch.nn import Sequential, Conv2d, Module, BatchNorm2d, SiLU, ModuleList, AdaptiveAvgPool2d, Dropout, Linear
from torchvision.transforms import transforms
from torchvision.transforms.functional import InterpolationMode
import warnings

# Ignore warnings
warnings.filterwarnings("ignore")

# Add safe globals for model loading
torch.serialization.add_safe_globals([
    ClassificationModel,
    Sequential,
    conv.Conv,
    Conv2d,
    block.C2f,
    block.Bottleneck,
    block.SPPF,
    Module,
    BatchNorm2d,
    SiLU,
    ModuleList,
    head.Classify,
    AdaptiveAvgPool2d,
    Dropout,
    Linear,
    transforms.Compose,
    transforms.Resize,
    transforms.CenterCrop,
    transforms.ToTensor,
    transforms.Normalize,
    InterpolationMode 
])

# Configure logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

# Load YOLO model with error handling
model = None
model_path = os.path.join(os.path.dirname(__file__), 'model', 'best.pt')

try:
    logger.info(f"Loading model from: {model_path}")
    if not os.path.exists(model_path):
        logger.error(f"Model file not found at: {model_path}")
    else:
        model = YOLO(model_path)
        logger.info("Model loaded successfully!")
except Exception as e:
    logger.error(f"Error loading model: {str(e)}")
    logger.error(traceback.format_exc())

# Pest information database (lengkap dengan semua jenis hama)
PEST_INFO = {
    'aphids': {
        'name': 'Kutu Daun (Aphids)',
        'description': 'Hama kecil berukuran 1-3 mm, berwarna hijau, hitam, atau cokelat yang menghisap cairan tanaman. Berkembang biak sangat cepat terutama di musim kering.',
        'symptoms': 'Daun mengkerut dan menguning, pertumbuhan terhambat, permukaan daun lengket karena embun madu, munculnya jamur jelaga berwarna hitam',
        'prevention': 'Tanam tanaman pengusir seperti bawang putih atau marigold, jaga kelembaban tidak terlalu kering, pangkas bagian terserang',
        'organic_solution': 'Semprot dengan larutan sabun cuci piring + air (1:10), gunakan minyak neem, lepaskan predator alami seperti kepik',
        'chemical_solution': 'Gunakan insektisida berbahan aktif imidakloprid atau thiamethoxam, semprot pada pagi/sore hari'
    },
    'armyworm': {
        'name': 'Ulat Grayak (Armyworm)',
        'description': 'Ulat berwarna hijau kecokelatan dengan garis-garis di punggung, aktif di malam hari dan bersembunyi di siang hari.',
        'symptoms': 'Daun berlubang-lubang, daun muda habis dimakan, ditemukan kotoran ulat di sekitar tanaman',
        'prevention': 'Rotasi tanaman, jaga kebersihan lahan dari gulma, periksa tanaman secara rutin terutama malam hari',
        'organic_solution': 'Petik ulat secara manual, gunakan Bacillus thuringiensis (Bt), semprot ekstrak daun mimba',
        'chemical_solution': 'Insektisida berbahan aktif klorpirifos, sipermetrin, atau profenofos'
    },
    'beetle': {
        'name': 'Kumbang (Beetle)',
        'description': 'Serangga keras dengan sayap pelindung (elytra), memakan daun, buah, dan batang tanaman. Beberapa jenis dapat terbang.',
        'symptoms': 'Daun berlubang tidak beraturan, bunga atau buah rusak, batang berlubang kecil',
        'prevention': 'Jaring pelindung pada tanaman muda, mulsa untuk menghalangi akses dari tanah, jebakan cahaya di malam hari',
        'organic_solution': 'Petik manual terutama pagi hari, gunakan perangkap feromon, semprot larutan bawang putih + cabai',
        'chemical_solution': 'Insektisida berbahan aktif deltametrin, lambda-cyhalothrin, atau fipronil'
    },
    'bollworm': {
        'name': 'Ulat Penggerek Buah (Bollworm)',
        'description': 'Ulat yang menyerang buah dan bunga, meninggalkan lubang masuk kecil. Larva berwarna hijau hingga cokelat.',
        'symptoms': 'Bunga gugur, buah berlubang dengan kotoran di dalamnya, buah busuk sebelum matang',
        'prevention': 'Pasang perangkap feromon, buang buah terserang, sanitasi kebun rutin',
        'organic_solution': 'Gunakan Bacillus thuringiensis (Bt), semprot virus NPV (Nuclear Polyhedrosis Virus), predator alami Trichogramma',
        'chemical_solution': 'Insektisida berbahan aktif indoxacarb, emamectin benzoate, atau spinosad'
    },
    'grasshopper': {
        'name': 'Belalang (Grasshopper)',
        'description': 'Serangga melompat dengan kaki belakang kuat, memakan daun dalam jumlah besar. Aktif di siang hari.',
        'symptoms': 'Daun robek tidak beraturan dimulai dari pinggir, tanaman muda habis dimakan, terlihat belalang di sekitar tanaman',
        'prevention': 'Pasang jaring pelindung, buang rumput liar tempat bersarang, olah tanah untuk merusak telur',
        'organic_solution': 'Tangkap manual menggunakan jaring, semprot larutan cabai + bawang putih, gunakan ayam/bebek sebagai predator',
        'chemical_solution': 'Insektisida berbahan aktif klorpirifos, malathion, atau diazinon'
    },
    'mites': {
        'name': 'Tungau (Mites)',
        'description': 'Hama sangat kecil (0.5 mm), hampir tidak terlihat mata telanjang. Menghisap cairan sel daun, berkembang cepat di kondisi panas kering.',
        'symptoms': 'Daun berbintik kuning/putih, permukaan daun kasar seperti berkarat, jaring halus di bawah daun, daun gugur prematur',
        'prevention': 'Jaga kelembaban dengan penyiraman rutin, hindari kekeringan, bersihkan debu dari daun',
        'organic_solution': 'Semprot air bertekanan kuat, gunakan minyak hortikultura, sabun insektisida, predator tungau Phytoseiulus',
        'chemical_solution': 'Akarisida berbahan aktif abamectin, spiromesifen, atau propargite'
    },
    'mosquito': {
        'name': 'Nyamuk (Mosquito)',
        'description': 'Serangga terbang kecil, umumnya tidak merusak tanaman tetapi mengganggu aktivitas berkebun.',
        'symptoms': 'Tidak ada kerusakan langsung pada tanaman, hanya mengganggu manusia',
        'prevention': 'Hilangkan genangan air tempat berkembang biak, pasang jaring atau kelambu',
        'organic_solution': 'Tanam tanaman pengusir nyamuk (lavender, serai wangi, rosemary), gunakan minyak esensial',
        'chemical_solution': 'Tidak diperlukan untuk tanaman, gunakan repelan untuk manusia'
    },
    'sawfly': {
        'name': 'Lalat Gergaji (Sawfly)',
        'description': 'Larvanya mirip ulat bulu, berwarna hijau dengan garis-garis. Dewasa mirip lebah kecil. Memakan daun secara berkelompok.',
        'symptoms': 'Daun tinggal tulang daun (kerangka), larva hijau berkelompok di bawah daun, daun menggulung',
        'prevention': 'Periksa bawah daun secara rutin, buang telur yang terlihat, jaga kebersihan kebun',
        'organic_solution': 'Buang larva secara manual, semprot dengan sabun insektisida, gunakan minyak neem, predator burung',
        'chemical_solution': 'Insektisida berbahan aktif azadirachtin, spinosad, atau pyrethrins'
    },
    'stem_borer': {
        'name': 'Penggerek Batang (Stem Borer)',
        'description': 'Larva yang menggerek masuk ke batang atau tongkol tanaman, merusak jaringan pengangkut. Sangat merusak pada tanaman padi dan jagung.',
        'symptoms': 'Batang berlubang dengan serbuk kayu di luar, tanaman layu tiba-tiba, pertumbuhan terhambat, patah batang',
        'prevention': 'Gunakan varietas tahan, tanam serempak untuk putus siklus hidup, sanitasi jerami/sisa tanaman',
        'organic_solution': 'Potong dan bakar bagian terserang, masukkan butiran Beauveria bassiana ke lubang, lepaskan parasitoid Trichogramma',
        'chemical_solution': 'Insektisida granul carbofuran atau fipronil diberikan pada tanah/pucuk, semprot klorpirifos'
    },
    'ants': {
        'name': 'Semut (Ants)',
        'description': 'Serangga sosial yang hidup berkoloni. Beberapa jenis memelihara kutu daun untuk embun madu, ada yang pemangsa serangga lain.',
        'symptoms': 'Munculnya kutu daun (dipelihara semut), gundukan tanah di sekitar akar, lubang di buah manis',
        'prevention': 'Oleskan getah pohon lengket di batang, pasang perangkap lem, hilangkan kutu daun',
        'organic_solution': 'Taburi kapur barus atau cengkeh bubuk, siram sarang dengan air panas, gunakan umpan boraks + gula',
        'chemical_solution': 'Insektisida semprot berbahan aktif fipronil atau imidakloprid untuk sarang'
    },
    'bees': {
        'name': 'Lebah (Bees)',
        'description': 'Serangga penyerbuk penting, BUKAN hama. Membantu penyerbukan bunga untuk pembentukan buah.',
        'symptoms': 'Tidak ada kerusakan, lebah mengunjungi bunga untuk nektar dan serbuk sari',
        'prevention': 'Tidak perlu pencegahan, justru harus dilindungi',
        'organic_solution': 'Tanam bunga penarik lebah untuk meningkatkan penyerbukan',
        'chemical_solution': 'JANGAN gunakan insektisida saat lebah aktif, lebah sangat bermanfaat'
    },
    'caterpillar': {
        'name': 'Ulat Bulu (Caterpillar)',
        'description': 'Larva kupu-kupu atau ngengat, berbulu atau halus. Memakan daun dalam jumlah besar untuk tumbuh.',
        'symptoms': 'Daun berlubang besar, daun habis dimakan, kotoran ulat di sekitar tanaman',
        'prevention': 'Pasang jaring anti serangga, periksa tanaman rutin terutama bawah daun',
        'organic_solution': 'Petik ulat manual, gunakan Bacillus thuringiensis (Bt), semprot ekstrak biji mahoni',
        'chemical_solution': 'Insektisida berbahan aktif sipermetrin, deltametrin, atau klorpirifos'
    },
    'earthworms': {
        'name': 'Cacing Tanah (Earthworms)',
        'description': 'Organisme menguntungkan yang menggemburkan tanah dan meningkatkan kesuburan. BUKAN hama!',
        'symptoms': 'Tidak ada gejala negatif, justru membuat tanah lebih gembur dan subur',
        'prevention': 'Tidak perlu pencegahan, cacing tanah sangat bermanfaat',
        'organic_solution': 'Perbanyak cacing tanah untuk komposting dan memperbaiki struktur tanah',
        'chemical_solution': 'JANGAN gunakan pestisida yang merusak cacing tanah'
    },
    'earwig': {
        'name': 'Gegat/Cocopet (Earwig)',
        'description': 'Serangga nokturnal dengan penjepit di ekor, berwarna cokelat kehitaman. Memakan daun muda, bunga, dan serangga kecil.',
        'symptoms': 'Lubang tidak beraturan pada daun muda, bunga rusak, aktif di malam hari',
        'prevention': 'Kurangi mulsa berlebihan tempat bersembunyi, pasang perangkap bambu berongga',
        'organic_solution': 'Perangkap menggunakan bambu/koran gulungan, semprotkan minyak nabati, bersihkan sisa tanaman',
        'chemical_solution': 'Insektisida semprot berbahan aktif piretrin atau spinosad di malam hari'
    },
    'moth': {
        'name': 'Ngengat (Moth)',
        'description': 'Dewasa umumnya tidak merusak, tetapi larvanya (ulat) adalah hama utama daun dan buah.',
        'symptoms': 'Ngengat dewasa terlihat di malam hari, telur di bawah daun, larva memakan daun',
        'prevention': 'Pasang perangkap cahaya UV untuk tangkap dewasa, perangkap feromon, jaring pelindung',
        'organic_solution': 'Gunakan Bacillus thuringiensis untuk larva, semprot minyak neem, predator burung nokturnal',
        'chemical_solution': 'Insektisida berbahan aktif klorpirifos, sipermetrin untuk larva'
    },
    'slug': {
        'name': 'Siput Telanjang (Slug)',
        'description': 'Moluska tanpa cangkang, aktif di malam hari atau kondisi lembab. Meninggalkan jejak lendir berkilau.',
        'symptoms': 'Lubang besar tidak beraturan pada daun, jejak lendir berkilau, tanaman muda habis dimakan',
        'prevention': 'Kurangi kelembaban berlebih, pasang penghalang kasar (cangkang telur, pasir kasar)',
        'organic_solution': 'Perangkap bir dalam mangkok dangkal, taburi garam atau kopi bubuk, kumpulkan manual malam hari',
        'chemical_solution': 'Molusisida berbahan aktif metaldehid dalam bentuk butiran'
    },
    'snail': {
        'name': 'Siput Bercangkang (Snail)',
        'description': 'Moluska dengan cangkang pelindung, aktif di kondisi lembab. Mirip slug tetapi bergerak lebih lambat.',
        'symptoms': 'Daun berlubang besar, jejak lendir, cangkang kosong di sekitar tanaman',
        'prevention': 'Kontrol kelembaban, singkirkan tempat persembunyian (batu, kayu lapuk)',
        'organic_solution': 'Kumpulkan manual, perangkap dengan kulit jeruk/melon, taburi abu kayu atau cangkang telur',
        'chemical_solution': 'Molusisida berbahan aktif metaldehid atau iron phosphate'
    },
    'wasp': {
        'name': 'Tawon (Wasp)',
        'description': 'Sebagian besar tawon adalah predator serangga hama dan penyerbuk. Beberapa jenis bermanfaat, bukan hama.',
        'symptoms': 'Tidak ada kerusakan tanaman, justru memangsa ulat dan hama lain',
        'prevention': 'Tidak perlu, tawon parasitoid sangat bermanfaat untuk kontrol biologis',
        'organic_solution': 'Tanam bunga untuk menarik tawon parasitoid yang memangsa hama',
        'chemical_solution': 'Hindari insektisida spektrum luas yang membunuh tawon bermanfaat'
    },
    'weevil': {
        'name': 'Kumbang Bubuk (Weevil)',
        'description': 'Kumbang kecil dengan moncong panjang, larva menggerek biji, batang, atau buah. Sangat merusak hasil panen.',
        'symptoms': 'Lubang kecil pada biji/batang, biji rusak berisi larva, tanaman layu dari dalam',
        'prevention': 'Simpan benih dalam wadah kedap, rotasi tanaman, sanitasi sisa panen',
        'organic_solution': 'Jemur biji di bawah sinar matahari, gunakan daun mimba kering dalam penyimpanan',
        'chemical_solution': 'Fumigasi dengan fosfin untuk gudang, semprot klorpirifos pada tanaman'
    },
    'unknown': {
        'name': 'Tidak Terdeteksi',
        'description': 'Hama tidak dapat diidentifikasi dari gambar',
        'symptoms': 'Silakan upload gambar yang lebih jelas atau konsultasikan dengan ahli',
        'prevention': 'Pastikan gambar fokus dan cukup terang',
        'organic_solution': 'Konsultasikan dengan penyuluh pertanian setempat',
        'chemical_solution': 'Identifikasi yang tepat diperlukan sebelum penanganan'
    }
}

@app.route("/")
def hello_world():
    return jsonify({
        'message': 'KawanHijau AI - Pest Detection API',
        'version': '1.0.0',
        'status': 'running'
    })

@app.route('/api/detect-pest', methods=['POST'])
def detect_pest():
    try:
        logger.info("Received pest detection request")
        
        # Check if model is loaded
        if model is None:
            logger.error("Model is not loaded")
            return jsonify({
                'success': False,
                'error': 'Model not loaded. Please check server logs.'
            }), 500
        
        if 'image' not in request.files:
            logger.warning("No image file in request")
            return jsonify({
                'success': False,
                'error': 'No image file provided'
            }), 400
        
        file = request.files['image']
        
        if file.filename == '':
            logger.warning("Empty filename")
            return jsonify({
                'success': False,
                'error': 'Empty filename'
            }), 400
        
        logger.info(f"Processing image: {file.filename}")
        
        # Read and preprocess image (same as Gradio code)
        image_bytes = file.read()
        image = Image.open(io.BytesIO(image_bytes))
        
        # Convert to RGB if needed
        if image.mode != 'RGB':
            image = image.convert('RGB')
        
        logger.info("Running YOLO classification...")
        # Run prediction (classification mode)
        results = model.predict(image, verbose=False)
        logger.info("YOLO classification completed")
        
        # Process results for CLASSIFICATION model (not detection)
        pest_type = 'unknown'
        confidence = 0.0
        
        if results and len(results) > 0:
            result = results[0]
            
            # For classification models, use probs instead of boxes
            if hasattr(result, 'probs') and result.probs is not None:
                probabilities = result.probs
                
                # Get top prediction
                class_id = probabilities.top1
                confidence = float(probabilities.top1conf)
                
                # Get class name
                if class_id in model.names:
                    pest_type = model.names[class_id]
                
                logger.info(f"Detected: {pest_type} with confidence: {confidence:.2%}")
            else:
                logger.warning("No probabilities found in results - might be wrong model type")
        else:
            logger.info("No results from YOLO model")
        
        # Get pest information
        pest_info = PEST_INFO.get(pest_type, PEST_INFO['unknown'])
        
        if pest_type != 'unknown' and confidence > 0.3:  # Minimum confidence threshold
            return jsonify({
                'success': True,
                'pest_type': pest_type,
                'confidence': round(confidence * 100, 2),
                'name': pest_info['name'],
                'description': pest_info['description'],
                'symptoms': pest_info['symptoms'],
                'prevention': pest_info['prevention'],
                'organic_solution': pest_info['organic_solution'],
                'chemical_solution': pest_info['chemical_solution']
            })
        else:
            # Low confidence or unknown
            logger.info(f"Low confidence ({confidence:.2%}) or unknown pest")
            return jsonify({
                'success': True,
                'pest_type': 'unknown',
                'confidence': round(confidence * 100, 2),
                'name': PEST_INFO['unknown']['name'],
                'description': PEST_INFO['unknown']['description'],
                'symptoms': PEST_INFO['unknown']['symptoms'],
                'prevention': PEST_INFO['unknown']['prevention'],
                'organic_solution': PEST_INFO['unknown']['organic_solution'],
                'chemical_solution': PEST_INFO['unknown']['chemical_solution']
            })
    
    except Exception as e:
        logger.error(f"Error in detect_pest: {str(e)}")
        logger.error(traceback.format_exc())
        return jsonify({
            'success': False,
            'error': str(e)
        }), 500

# Menjalankan aplikasi
if __name__ == "__main__":
    app.run(host='0.0.0.0', port=5000, debug=True)