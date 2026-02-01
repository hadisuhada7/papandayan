<?php

return [
    'search' => [
        'per_section_limit' => 5,
        'quick_terms' => [
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
        ],
    ],
];
