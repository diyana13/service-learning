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
                        'criteria_bm' => 'Menganalisis dan mengaplikasikan konsep yang berkesan.',
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
                        'criteria_bm' => 'Berkomunikasi dengan sangat jelas dan persuasif.',
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
                        'criteria_bm' => 'Menganalisis dan menyelesaikan masalah yang sederhana',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Consistently solves complex problems effectively.',
                        'criteria_bm' => 'Menyelesaikan masalah yang kompleks dengan berkesan secara konsisten.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Demonstrates innovative and advanced problem-solving.',
                        'criteria_bm' => 'Menunjukkan penyelesaian masalah yang inovatif.',
                        'score' => 5,
                    ]
                ]
            ],
            [
                'rubric_name' => 'Empathy',
                'criteria' => [
                    [
                        'criteria_bi' => 'Shows minimal concern for others.',
                        'criteria_bm' => 'Menunjukkan keprihatinan yang sangat sedikit terhadap orang lain',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Recognises others feelings but struggles to act.',
                        'criteria_bm' => 'Memahami perasaan orang lain tetapi sukar bertindak.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Understands and respects others’ perspectives.',
                        'criteria_bm' => 'Memahami dan menghormati pandangan orang lain.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Consistently shows empathy and supports others.',
                        'criteria_bm' => 'Menunjukkan empati dan memberi sokongan secara konsisten.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Demonstrates a great deal of empathy and comprehension.',
                        'criteria_bm' => 'Menunjukkan belas kasihan dan pemahaman yang mendalam.',
                        'score' => 5,
                    ]
                ]
            ],
            [
                'rubric_name' => 'Innovative Thinking',
                'criteria' => [
                    [
                        'criteria_bi' => 'Rarely comes up with new ideas.',
                        'criteria_bm' => 'Jarang mencadangkan idea baru.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Generates basic ideas with guidance.',
                        'criteria_bm' => 'Menghasilkan idea asas dengan bimbingan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Generates concepts that are moderately innovative.',
                        'criteria_bm' => 'Mencipta idea yang agak kreatif',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Regularly contributes innovative ideas',
                        'criteria_bm' => 'Menyumbang idea yang inovatif secara konsisten.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Consistently demonstrates exceptional creativity',
                        'criteria_bm' => 'Menunjukkan kreativiti yang luar biasa secara konsisten.',
                        'score' => 5,
                    ],
                ]
             ],
             [
                'rubric_name' => 'Learning Agility',
                'criteria' => [
                    [
                        'criteria_bi' => 'Resists to learn new things.',
                        'criteria_bm' => 'Sukar untuk mempelajari perkara baru.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Learns slowly and struggles to adapt.',
                        'criteria_bm' => 'Belajar dengan perlahan dan sukar untuk menyesuaikan diri.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Learns and applies new concepts with some help.',
                        'criteria_bm' => 'Belajar dan mengaplikasikan konsep baru dengan sedikit bantuan.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Learns and adapts quickly to new concepts.',
                        'criteria_bm' => 'Belajar dan menyesuaikan diri dengan cepat kepada konsep baharu.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Proficient in understanding and utilizing complex ideas.',
                        'criteria_bm' => 'Mahir memahami dan menggunakan idea yang kompleks.',
                        'score' => 5,
                    ],
                ],
             ],
             [
                'rubric_name' => 'Sustainability Awareness',
                'criteria' => [
                    [
                        'criteria_bi' => 'Demonstrates little understanding of sustainability.',
                        'criteria_bm' => 'Menunjukkan pemahaman yang sedikit tentang pemampanan.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Has basic awareness but struggles to apply it.',
                        'criteria_bm' => 'Mempunyai kesedaran asas tetapi sukar untuk mengaplikasikannya.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Understands and applies sustainable practices.',
                        'criteria_bm' => 'Memahami dan mengaplikasikan amalan yang mampan.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Actively promotes sustainability practices.',
                        'criteria_bm' => 'Mempromosikan amalan yang mampan secara aktif.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Demonstrates leadership in sustainable actions.',
                        'criteria_bm' => 'Menunjukkan kepimpinan dalam tindakan yang mampan.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Teamwork and Collaboration',
                'criteria' => [
                    [
                        'criteria_bi' => 'Rarely participates in group work.',
                        'criteria_bm' => 'Jarang mengambil bahagian dalam kerja berkumpulan.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Contributes minimally to team efforts.',
                        'criteria_bm' => 'Memberi sumbangan yang minima kepada usaha berpasukan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Actively works with others and collaborates well.',
                        'criteria_bm' => 'Bekerjasama dengan orang lain dan berkolaborasi dengan baik.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Consistently contributes to team success.',
                        'criteria_bm' => 'Menyumbang kepada kejayaan kumpulan dengan kosisten.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Leads and inspires effective teamwork.',
                        'criteria_bm' => 'Memimpin dan memberi inspirasi kepada kerja berpasukan yang berkesan.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Digital and AI Fluency',
                'criteria' => [
                    [
                        'criteria_bi' => 'Shows limited understanding of digital tools and AI technologies.',
                        'criteria_bm' => 'Menunjukkan pemahaman yang terhad terhadap alat digital dan teknologi AI.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Understands basic digital tools and AI technologies.',
                        'criteria_bm' => 'Memahami alat digital asas dan teknologi AI.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Uses digital tools and AI technologies effectively.',
                        'criteria_bm' => 'Menggunakan alat digital dan teknologi AI dengan berkesan.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Applies digital tools and AI technologies innovatively.',
                        'criteria_bm' => 'Mengaplikasikan alat digital dan teknologi AI secara inovatif.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Demonstrates advanced digital and AI skills.',
                        'criteria_bm' => 'Menunjukkan kemahiran digital dan AI yang canggih.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Lifelong Learning',
                'criteria' => [
                    [
                        'criteria_bi' => 'Shows limited interest in lifelong learning',
                        'criteria_bm' => 'Menunjukkan minat yang terhad dalam pembelajaran sepanjang hayat.',  
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Participates in learning only when encouraged',
                        'criteria_bm' => 'Hanya mengambil bahagian dalam pembelajaran apabila digalakkan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Actively seeks opportunities for learning',
                        'criteria_bm' => 'Mencari peluang untuk pembelajaran secara aktif.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Consistently improves through learning.',
                        'criteria_bm' => 'Meningkatkan diri melalui pembelajaran secara konsisten.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Demonstrates a strong passion for lifelong learning.',
                        'criteria_bm' => 'Menunjukkan semangat yang kuat untuk pembelajaran sepanjang hayat.',
                        'score' => 5,
                    ],  
                ],
            ],
            [
                'rubric_name' => 'Psychomotor Skills',
                'criteria' => [
                    [
                        'criteria_bi' => 'Struggles to perform basic motor skills.',
                        'criteria_bm' => 'Sukar untuk melakukan kemahiran motor asas.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Performs basic motor skills with guidance.',
                        'criteria_bm' => 'Melakukan kemahiran motor asas dengan bimbingan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Performs motor skills accurately.',
                        'criteria_bm' => 'Melaksanakan kemahiran motor dengan tepat.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Performs complex skills smoothly and effectively.',
                        'criteria_bm' => 'Melaksanakan kemahiran kompleks dengan lancar dan berkesan.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Leads in executing excellent motor skills.',
                        'criteria_bm' => 'Memimpin dalam melaksanakan kemahiran motor yang cemerlang.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Leadership Skills',
                'criteria' => [
                    [
                        'criteria_bi' => 'Does not demonstrate leadership qualities.',
                        'criteria_bm' => 'Tidak menunjukkan sifat kepimpinan.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Leads with limited confidence and needs guidance',
                        'criteria_bm' => 'Memimpin dengan keyakinan yang terhad dan memerlukan bimbingan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Leads confidently in certain situations.',
                        'criteria_bm' => 'Memimpin secara yakin dalam situasi tertentu.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Consistently leads effectively in most situations.',
                        'criteria_bm' => 'Memimpin secara berkesan dalam kebanyakan situasi.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Inspires and motivates others as a leader.',
                        'criteria_bm' => 'Menginspirasi dan memotivasi orang lain sebagai pemimpin.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Ethical Management',
                'criteria' => [
                    [
                        'criteria_bi' => 'Does not adhere to or understand ethical principles',
                        'criteria_bm' => 'Tidak mematuhi atau memahami prinsip etika.', 
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Adheres to basic ethical principles with supervision.',
                        'criteria_bm' => 'Mematuhi prinsip etika asas dengan pengawasan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Makes ethical decisions in most situations.',
                        'criteria_bm' => 'Membuat keputusan beretika dalam kebanyakan situasi.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Consistently practices high ethical management.',
                        'criteria_bm' => 'Mengamalkan pengurusan etika yang tinggi secara konsisten',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Leads a deeply ethical work culture.',
                        'criteria_bm' => 'Menerajui budaya kerja yang mematuhi prinsip etika secara mendalam.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Entrepreneurship Skills',
                'criteria' => [
                    [
                        'criteria_bi' => 'Shows little creativity or initiative in business ideas.',
                        'criteria_bm' => 'Tidak menunjukkan kreativiti atau inisiatif dalam idea perniagaan.',  
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Forms basic business ideas but needs support.',
                        'criteria_bm' => 'Membentuk idea perniagaan asas tetapi memerlukan sokongan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Develops business ideas with adequate planning skills.',
                        'criteria_bm' => 'Mengembangkan idea perniagaan dengan kemahiran perancangan yang mencukupi.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Consistently generates innovative business ideas.',
                        'criteria_bm' => 'Menghasilkan idea perniagaan yang inovatif secara konsisten.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Leads successful and innovative entrepreneurial projects.',
                        'criteria_bm' => 'Menerajui projek keusahawanan yang berjaya dan inovatif.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Affective Skills',
                'criteria' => [
                    [
                        'criteria_bi' => 'Struggles to identify and manage own emotions.',
                        'criteria_bm' => 'Sukar mengenal pasti dan menguruskan emosi sendiri.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Sometimes manages emotions but needs guidance.',
                        'criteria_bm' => 'Kadang-kala menguruskan emosi tetapi memerlukan bimbingan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Manages own emotions effectively',
                        'criteria_bm' => 'Menguruskan emosi sendiri dengan berkesan.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Interacts empathetically and with self-control.',
                        'criteria_bm' => 'Berinteraksi dengan orang lain secara empati dan terkawal',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Leads healthy relationships with high emotional intelligence.',
                        'criteria_bm' => 'Menerajui hubungan yang sihat dengan kecekapan emosi yang tinggi.',  
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Numerical Skills',
                'criteria' => [
                    [
                        'criteria_bi' => 'Struggles to understand and use numerical data.',
                        'criteria_bm' => 'Sukar memahami dan menggunakan data berangka.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Understands basic math concepts with help.',
                        'criteria_bm' => 'Memahami konsep matematik asas dengan bantuan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Applies numerical data effectively.',
                        'criteria_bm' => 'Mengaplikasikan data berangka dengan berkesan.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Analyzes numerical data and makes informed decisions.',
                        'criteria_bm' => 'Menganalisis data berangka dan membuat keputusan yang berinformasi.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Demonstrates advanced numerical skills.',
                        'criteria_bm' => 'Menunjukkan kemahiran berangka yang canggih.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Time Management',
                'criteria' => [
                    [
                        'criteria_bi' => 'Fails to complete tasks on time',
                        'criteria_bm' => 'Gagal menyelesaikan tugas pada masanya.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Occasionally meets deadlines but needs reminders.',
                        'criteria_bm' => 'Kadang-kadang menepati masa tetapi memerlukan peringatan',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Manages time effectively in most situations',
                        'criteria_bm' => 'Menguruskan masa dengan berkesan dalam kebanyakan situasi.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Consistently meets deadlines and prioritizes tasks well.',
                        'criteria_bm' => 'Menepati masa dengan konsisten dan mengutamakan tugas dengan baik.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Inspires others with exceptional time management.',
                        'criteria_bm' => 'Menginspirasi orang lain dengan pengurusan masa yang luar biasa.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Work Quality',
                'criteria' => [
                    [
                        'criteria_bi' => 'Work quality is often unsatisfactory.',
                        'criteria_bm' => 'Kualiti kerja sering tidak memuaskan.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Delivers satisfactory work with guidance.',
                        'criteria_bm' => 'Menyediakan kerja yang memuaskan dengan bimbingan.',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Produces consistently good-quality work.',
                        'criteria_bm' => 'Menghasilkan kerja berkualiti yang baik secara konsisten.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Frequently delivers high-quality work.',
                        'criteria_bm' => 'Kerap menghasilkan kerja yang berkualiti tinggi.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Consistently delivers outstanding and professional work.',
                        'criteria_bm' => 'Sentiasa menghasilkan kerja yang luar biasa dan profesional.',
                        'score' => 5,
                    ],
                ],
            ],
            [
                'rubric_name' => 'Performance',
                'criteria' => [
                    [
                        'criteria_bi' => 'Performance often falls below expectations.',
                        'criteria_bm' => 'Prestasi sering tidak memenuhi jangkaan.',
                        'score' => 1,
                    ],
                    [
                        'criteria_bi' => 'Performs satisfactorily but inconsistently',
                        'criteria_bm' => 'Prestasi yang memuaskan tetapi tidak konsisten',
                        'score' => 2,
                    ],
                    [
                        'criteria_bi' => 'Consistently meets performance expectations.',
                        'criteria_bm' => 'Memenuhi jangkaan prestasi secara konsisten.',
                        'score' => 3,
                    ],
                    [
                        'criteria_bi' => 'Exceeds expectations in most tasks.',
                        'criteria_bm' => 'Melebihi jangkaan dalam kebanyakan tugas.',
                        'score' => 4,
                    ],
                    [
                        'criteria_bi' => 'Consistently demonstrates outstanding performance.',
                        'criteria_bm' => 'Sentiasa menunjukkan prestasi yang cemerlang.',
                        'score' => 5,
                    ],
                ],
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
