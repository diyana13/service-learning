<?php

namespace Database\Seeders;

use App\Models\Rubrics;
use App\Models\RubricsCriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RubricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rubrics = [
            [
                'rubric_name' => 'Adaptability and Resilience',
                'criteria' => [
                    [
                        'criteria_bi' => 'Struggles to adapt and resists change.',
                        'criteria_bm' => 'Sukar menyesuaikan diri dan menolak perubahan.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Adapts slowly and needs guidance.',
                        'criteria_bm' => 'Lambat menyesuaikan diri dan memerlukan bimbingan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Adapts to changes with some support.',
                        'criteria_bm' => 'Menyesuaikan diri dengan perubahan dengan sedikit sokongan.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Adapts effectively to most situations.',
                        'criteria_bm' => 'Beradaptasi secara berkesan dalam kebanyakan situasi.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Adapts quickly and handles challenges well.',
                        'criteria_bm' => 'Beradaptasi dengan cepat dan menangani cabaran dengan baik.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Cognitive Skills',
                'criteria' => [
                    [
                        'criteria_bi' => 'Shows limited understanding of problems.',
                        'criteria_bm' => 'Menunjukkan pemahaman yang terhad terhadap masalah.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Understands basic problems but needs help.',
                        'criteria_bm' => 'Memahami masalah asas tetapi memerlukan bantuan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Understands and solves problems independently.',
                        'criteria_bm' => 'Memahami dan menyelesaikan masalah secara berdikari.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Analyzes and applies concepts effectively.',
                        'criteria_bm' => 'Menganalisis dan mengaplikasikan konsep secara berkesan.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Excellent in solving complex problems.',
                        'criteria_bm' => 'Cemerlang dalam menyelesaikan masalah yang kompleks.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Communication Skills',
                'criteria' => [
                    [
                        'criteria_bi' => 'Communicates unclearly and lacks engagement.',
                        'criteria_bm' => 'Berkomunikasi secara tidak jelas dan kurang berinteraksi.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Communicates with basic clarity but lacks confidence.',
                        'criteria_bm' => 'Berkomunikasi dengan jelas tetapi kurang keyakinan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Communicates clearly with moderate engagement.',
                        'criteria_bm' => 'Berkomunikasi dengan jelas dengan penglibatan sederhana.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Communicates effectively and engages well.',
                        'criteria_bm' => 'Berkomunikasi secara berkesan dan berinteraksi dengan baik.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Communicates persuasively with exceptional clarity.',
                        'criteria_bm' => 'Berkomunikasi secara meyakinkan dengan kejelasan yang luar biasa.',
                        'score' => 5,
                    ]
                ],
            ],
            [
                'rubric_name' => 'Critical Thinking and Problem Solving',
                'criteria' => [
                    [
                        'criteria_bi' => 'Struggles to evaluate and solve problems.',
                        'criteria_bm' => 'Sukar menilai dan menyelesaikan masalah.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Solved basic problems with help.',
                        'criteria_bm' => 'Menyelesaikan masalah asas dengan bantuan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Analyses and solves complex problems moderately.',
                        'criteria_bm' => 'Menganalisis dan menyelesaikan masalah yang kompleks secara sederhana.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Consistently solves complex problems effectively.',
                        'criteria_bm' => 'Konsisten menyelesaikan masalah yang kompleks secara berkesan.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Demonstrates innovative and advanced problem-solving.',
                        'criteria_bm' => 'Mendemonstrasikan inovasi dan penyelesaian masalah yang canggih.',
                        'score' => 5,
                    ]
                ]
            ],
        ];

        foreach ($rubrics as $rubricData) {
            $rubric = Rubrics::create(['rubric_name' => $rubricData['rubric_name']]);

            foreach ($rubricData['criteria'] as $criteriaData) {
                RubricsCriteria::create([
                    'rubric_id' => $rubric->id,
                    'criteria_bi' => $criteriaData['criteria_bi'],
                    'criteria_bm' => $criteriaData['criteria_bm'],
                    'score' => $criteriaData['score'],
                ]);
            }
        }
    }
}
