<?php

namespace Database\Seeders;

use App\Features\Post\Enums\PostCategory;
use App\Features\Post\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /** Akun demo: admin / admin dan member / member. Aman dijalankan berulang. */
    public function run(): void
    {
        $admin = User::updateOrCreate(['username' => 'admin'], [
            'name' => 'Administrator', 'role' => User::ROLE_ADMIN, 'password' => 'admin',
        ]);
        $member = User::updateOrCreate(['username' => 'member'], [
            'name' => 'Penulis Demo', 'role' => User::ROLE_MEMBER, 'password' => 'member',
        ]);

        $demoPosts = [
            [
                'title' => 'Memulai Perjalanan Pemrograman Web Modern dengan Laravel dan React',
                'category' => PostCategory::Teknologi->value,
                'excerpt' => 'Panduan komprehensif mengintegrasikan Laravel Inertia dan React untuk menciptakan pengalaman pengguna yang reaktif dan cepat.',
                'content' => "## Pengenalan\n\nPengembangan web modern menuntut perpaduan sempurna antara performa backend yang andal dan antarmuka frontend yang responsif.\n\n### Keunggulan Inertia.js\n\nInertia menghubungkan Laravel dan React tanpa perlu membangun REST API secara terpisah, memungkinkan perutean monolitik dengan pengalaman SPA modern.\n\n1. Routing terpusat di Laravel.\n2. State management sederhana.\n3. DX yang sangat produktif.",
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Tips Meningkatkan Produktivitas Kerja Remote bagi Pengembang Perangkat Lunak',
                'category' => PostCategory::GayaHidup->value,
                'excerpt' => 'Strategi praktis mengatur waktu, ruang kerja, dan komunikasi asinkron demi menjaga fokus serta keseimbangan hidup.',
                'content' => "## Bekerja Fleksibel tapi Terarah\n\nBekerja secara remote memberikan keleluasaan luar biasa, namun menuntut disiplin tingkat tinggi.\n\n### Praktik Terbaik\n\n- Tentukan jam fokus tanpa interupsi.\n- Manfaatkan teknik Pomodoro.\n- Lakukan dokumentasi tertulis secara rapi.",
                'is_published' => true,
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Strategi Mengembangkan Karir di Industri Teknologi Masa Depan',
                'category' => PostCategory::Bisnis->value,
                'excerpt' => 'Langkah nyata membangun portofolio, jejaring profesional, dan penguasaan fondasi rekayasa perangkat lunak.',
                'content' => "## Berinvestasi pada Kemampuan Inti\n\nIndustri teknologi terus bertransformasi dengan cepat seiring perkembangan kecerdasan buatan dan komputasi awan.\n\nKembangkan rasa ingin tahu, bangun proyek nyata, dan komunikasikan dampak karya Anda dengan jelas kepada para pemangku kepentingan.",
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Panduan Praktis Belajar Git dan Kolaborasi Tim yang Efektif',
                'category' => PostCategory::Pendidikan->value,
                'excerpt' => 'Memahami branching model, merge conflicts, dan praktik commit pesan yang bermakna dalam pengembangan perangkat lunak.',
                'content' => "## Menguasai Git dari Dasar\n\nVersion control system adalah keterampilan wajib bagi setiap pengembang.\n\nDengan alur kerja Git yang bersih, integrasi berkelanjutan (CI/CD) dapat berjalan lancar tanpa hambatan.",
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Masa Depan AI dan Tantangan Etika dalam Dunia Digital',
                'category' => PostCategory::Opini->value,
                'excerpt' => 'Refleksi mendalam seputar pemanfaatan model bahasa besar dan dampaknya terhadap privasi serta orisinalitas karya.',
                'content' => "## AI sebagai Akselerator, Bukan Pengganti Nurani\n\nKemajuan kecerdasan buatan membuka peluang efisiensi yang belum pernah ada sebelumnya.\n\nNamun, tanggung jawab etis dan verifikasi fakta tetap menjadi domain krusial manusia.",
                'is_published' => true,
                'published_at' => now()->subDay(),
            ],
            [
                'title' => 'Eksplorasi Fitur Terkini Inertia.js 2.0',
                'category' => PostCategory::Teknologi->value,
                'excerpt' => 'Mengenal prefetching, polling, deferred props, dan perbaikan performa signifikan di versi terbaru.',
                'content' => "## Lompatan Besar Inertia.js 2.0\n\nVersi 2.0 membawa fitur performa modern seperti deferred props dan prefetching bawaan yang membuat navigasi terasa seketika.",
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Draf Rencana Belajar Docker dan Containerization',
                'category' => PostCategory::Pendidikan->value,
                'excerpt' => 'Catatan draf kurikulum internal untuk penguasaan container.',
                'content' => "## Rencana Kurikulum\n\n1. Dockerfile basics\n2. Multi-stage build\n3. Docker compose orchestration",
                'is_published' => false,
                'published_at' => null,
            ],
            [
                'title' => 'Draf Catatan Evaluasi Kinerja dan Roadmap Tim Q4',
                'category' => PostCategory::Bisnis->value,
                'excerpt' => 'Draf internal evaluasi capaian kuartal.',
                'content' => "## Evaluasi Sasaran\n\n- Capaian SLA\n- Reduksi insiden deployment\n- Sasaran kuartal mendatang",
                'is_published' => false,
                'published_at' => null,
            ],
        ];

        if ($member->posts()->count() === 0) {
            foreach ($demoPosts as $item) {
                Post::create([
                    'user_id' => $member->id,
                    'title' => $item['title'],
                    'slug' => Str::slug($item['title']).'-'.Str::lower(Str::random(6)),
                    'category' => $item['category'],
                    'excerpt' => $item['excerpt'],
                    'content' => $item['content'],
                    'is_published' => $item['is_published'],
                    'published_at' => $item['published_at'],
                ]);
            }
        }

        if ($admin->posts()->count() === 0) {
            Post::create([
                'user_id' => $admin->id,
                'title' => 'Selamat Datang di BlogVerse Pro — Panduan Komunitas',
                'slug' => 'selamat-datang-di-blogverse-pro-'.Str::lower(Str::random(6)),
                'category' => PostCategory::Umum->value,
                'excerpt' => 'Panduan pengantar untuk seluruh penulis dan pembaca di platform BlogVerse Pro.',
                'content' => "## Selamat Datang!\n\nBlogVerse Pro adalah ruang publikasi artikel bersama. Silakan jelajahi tulisan menarik atau daftarkan diri sebagai penulis.",
                'is_published' => true,
                'published_at' => now()->subDays(6),
            ]);
        }
    }
}
