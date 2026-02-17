<?php

return [
    'search' => [
        'per_section_limit' => 5,
        'quick_terms' => [
            [
                'label' => 'Artikel',
                'query' => 'Artikel',
                'keywords' => ['artikel', 'article', 'berita', 'news'],
                'route' => 'front.articles',
                'description' => 'Baca artikel dan berita terbaru perusahaan.',
            ],
            [
                'label' => 'K3',
                'query' => 'K3',
                'keywords' => ['k3', 'keselamatan', 'safety'],
                'route' => 'front.safety',
                'description' => 'Pelajari komitmen K3 dan keselamatan kerja kami.',
            ],
            [
                'label' => 'CSR',
                'query' => 'CSR',
                'keywords' => ['csr', 'tanggung jawab', 'corporate social'],
                'route' => 'front.socials',
                'description' => 'Jelajahi kegiatan tanggung jawab sosial perusahaan.',
            ],
            [
                'label' => 'Inisiatif',
                'query' => 'Inisiatif',
                'keywords' => ['inisiatif', 'initiative'],
                'route' => 'front.initiatives',
                'description' => 'Temukan berbagai inisiatif strategis perusahaan.',
            ],
            [
                'label' => 'Laporan Dokumen',
                'query' => 'Laporan Dokumen',
                'keywords' => ['laporan', 'dokumen', 'document report'],
                'route' => 'front.documents',
                'description' => 'Akses kumpulan dokumen dan laporan perusahaan terbaru.',
            ],
            [
                'label' => 'Laporan Tahunan',
                'query' => 'Laporan Tahunan',
                'keywords' => ['laporan tahunan', 'annual report', 'tahunan'],
                'route' => 'front.report',
                'description' => 'Lihat laporan tahunan perusahaan.',
            ],
            [
                'label' => 'Laporan Keuangan',
                'query' => 'Laporan Keuangan',
                'keywords' => ['laporan keuangan', 'financial', 'keuangan', 'finansial'],
                'route' => 'front.financial',
                'description' => 'Akses laporan keuangan perusahaan.',
            ],
            [
                'label' => 'Presentasi Investor',
                'query' => 'Presentasi Investor',
                'keywords' => ['investor', 'presentasi investor', 'presentation'],
                'route' => 'front.investor',
                'description' => 'Lihat presentasi untuk investor.',
            ],
            [
                'label' => 'Informasi Saham',
                'query' => 'Saham',
                'keywords' => ['saham', 'obligasi', 'stock', 'bond'],
                'route' => 'front.stock',
                'description' => 'Informasi saham dan obligasi perusahaan.',
            ],
            [
                'label' => 'RUPS',
                'query' => 'RUPS',
                'keywords' => ['rups', 'pemegang saham', 'shareholder', 'rapat umum'],
                'route' => 'front.shareholder',
                'description' => 'Dokumen rapat umum pemegang saham.',
            ],
            [
                'label' => 'Karir',
                'query' => 'Karir',
                'keywords' => ['karir', 'career', 'lowongan', 'job', 'pekerjaan'],
                'route' => 'front.career',
                'description' => 'Cari lowongan pekerjaan yang tersedia.',
            ],
        ],
    ],
];
