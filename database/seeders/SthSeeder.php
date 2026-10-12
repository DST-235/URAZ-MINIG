<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{User,Setting,Service,Project,TeamMember,Testimonial,Stat,BlogPost,Faq,Page,Slider};
use Illuminate\Support\Facades\Hash;

class SthSeeder extends Seeder {
    public function run(): void {

        // ── Admin user ───────────────────────────────────────────────────────
        User::updateOrCreate(['email' => 'admin@app.com'], [
            'name'              => 'Ayoub Oumar',
            'password'          => Hash::make('12345678'),
            'role'              => 'admin',
            'position'          => 'Chief Executive Officer',
            'phone'             => '+235 60 83 79 79',
            'email_verified_at' => now(),
            'is_active'         => true,
        ]);

        // ── Settings ─────────────────────────────────────────────────────────
        // updateOrCreate by key — always safe, preserves colour/logo overrides
        $settings = [
            ['key' => 'site_name',    'value' => 'STH',                                           'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'System Technologie Hanana',                     'group' => 'general'],
            ['key' => 'site_email',   'value' => 'contact@sth-tchad.com',                         'group' => 'general'],
            ['key' => 'site_phone',   'value' => '+235 60 83 79 79',                              'group' => 'general'],
            ['key' => 'site_phone2',  'value' => '+235 99 96 14 18',                              'group' => 'general'],
            ['key' => 'site_address', 'value' => 'Avenue Charles de Gaulle, Quartier Ambassatna', 'group' => 'general'],
            ['key' => 'site_city',    'value' => "N'Djamena",                                    'group' => 'general'],
            ['key' => 'site_country', 'value' => 'Tchad / Chad',                                  'group' => 'general'],
            ['key' => 'facebook',     'value' => 'https://facebook.com/sth-tchad',                'group' => 'social'],
            ['key' => 'linkedin',     'value' => 'https://linkedin.com/company/sth-tchad',        'group' => 'social'],
            ['key' => 'twitter',      'value' => 'https://twitter.com/sth_tchad',                 'group' => 'social'],
            ['key' => 'instagram',    'value' => 'https://instagram.com/sth_tchad',               'group' => 'social'],
            // Stored as PHP array — the `value => array` cast handles JSON encoding correctly
            ['key' => 'about_short', 'value' => [
                'en' => "Founded in 2025 in N'Djamena, STH is a Chadian technology company that builds any digital system a business needs — ERP, market platforms, cargo systems, school management, money transfer, mobile apps, websites, government systems and more. If you can describe it, we can build it.",
                'fr' => "Fondée en 2025 à N'Djamena, STH est une entreprise technologique tchadienne qui développe tout système numérique dont une organisation a besoin — ERP, plateformes de marché, gestion cargo, systèmes scolaires, transfert d'argent, applications mobiles, sites web, systèmes gouvernementaux et bien plus encore. Si vous pouvez le décrire, nous pouvons le construire.",
                'ar' => "تأسست شركة STH عام 2025 في إنجامينا، وهي شركة تكنولوجية تشادية تبني أي نظام رقمي تحتاجه المؤسسات — من أنظمة ERP ومنصات الأسواق وإدارة الشحن والمدارس، إلى تحويل الأموال وتطبيقات الهاتف والمواقع الإلكترونية والأنظمة الحكومية. إذا استطعت وصفه، نستطيع بناءه.",
            ], 'group' => 'general'],
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], ['value' => $s['value'], 'group' => $s['group']]);
        }

        // ── Services ──────────────────────────────────────────────────────────
        // updateOrCreate by slug — safe, no image fields
        $servicesData = [
            [
                'slug'  => 'erp',
                'icon'  => 'fas fa-cogs',
                'name'  => ['en' => 'ERP Systems', 'fr' => 'Systèmes ERP', 'ar' => 'أنظمة تخطيط موارد المؤسسات'],
                'short' => [
                    'en' => 'Complete enterprise resource planning solutions for businesses of all sizes.',
                    'fr' => 'Des solutions ERP sur mesure pour les entreprises de toute envergure.',
                    'ar' => 'حلول متكاملة لتخطيط موارد المؤسسات بمختلف أحجامها.',
                ],
                'desc' => [
                    'en' => 'Our ERP solutions bring all your business processes — finance, HR, supply chain, operations — into one unified digital platform. We design, deploy and maintain ERP systems tailored precisely to your industry and workflow.',
                    'fr' => "Nos solutions ERP centralisent l'ensemble de vos processus métier — finances, ressources humaines, chaîne d'approvisionnement, opérations — au sein d'une plateforme numérique unifiée. Nous concevons, déployons et assurons la maintenance de systèmes ERP entièrement adaptés à votre secteur d'activité.",
                    'ar' => 'تجمع حلول ERP لدينا جميع عمليات مؤسستك — المالية والموارد البشرية وسلسلة التوريد والتشغيل — في منصة رقمية موحدة. نُصمِّم وننشر ونُشغِّل أنظمة ERP مخصصة تلائم قطاعك ومتطلبات عملك تحديداً.',
                ],
                'features' => [
                    'en' => ['Custom ERP Development', 'Financial Management Module', 'Human Resources Module', 'Supply Chain Management', 'Real-time Analytics Dashboard', 'Mobile Access'],
                    'fr' => ['Développement ERP personnalisé', 'Module de gestion financière', 'Module ressources humaines', 'Gestion de la chaîne logistique', 'Tableau de bord analytique en temps réel', 'Accès mobile'],
                    'ar' => ['تطوير ERP مخصص', 'وحدة الإدارة المالية', 'وحدة الموارد البشرية', 'إدارة سلسلة التوريد', 'لوحة تحليلات آنية', 'وصول عبر الهاتف'],
                ],
            ],
            [
                'slug'  => 'public-sector',
                'icon'  => 'fas fa-landmark',
                'name'  => ['en' => 'Public Sector', 'fr' => 'Secteur Public', 'ar' => 'القطاع الحكومي'],
                'short' => [
                    'en' => 'Digital transformation solutions for government institutions and public administrations.',
                    'fr' => 'Solutions de transformation numérique pour les institutions gouvernementales et les administrations publiques.',
                    'ar' => 'حلول التحول الرقمي للمؤسسات الحكومية والإدارات العامة.',
                ],
                'desc' => [
                    'en' => 'We help governments and public institutions modernize their services through technology. Our solutions include e-government platforms, citizen portals, document management systems, and administrative software built to meet the regulatory and operational needs of public organizations in Chad.',
                    'fr' => "Nous accompagnons les gouvernements et les institutions publiques dans la modernisation de leurs services par le numérique. Nos solutions comprennent des plateformes d'administration électronique, des portails citoyens, des systèmes de gestion documentaire et des logiciels administratifs conçus pour répondre aux exigences réglementaires et opérationnelles des organisations publiques au Tchad.",
                    'ar' => 'نساعد الحكومات والمؤسسات العامة على تحديث خدماتها بالتقنيات الرقمية. تشمل حلولنا منصات الحكومة الإلكترونية وبوابات خدمة المواطنين وأنظمة إدارة الوثائق والبرامج الإدارية المصممة لتلبية الاحتياجات التشغيلية والتنظيمية للجهات الحكومية في تشاد.',
                ],
                'features' => [
                    'en' => ['e-Government Platforms', 'Citizen Service Portals', 'Document Management', 'Digital Records', 'Tax & Revenue Systems', 'Public Transparency Tools'],
                    'fr' => ['Plateformes de gouvernance électronique', 'Portails de service aux citoyens', 'Gestion documentaire', 'Archives numériques', 'Systèmes fiscaux et de recettes', "Outils de transparence publique"],
                    'ar' => ['منصات الحكومة الإلكترونية', 'بوابات خدمة المواطنين', 'إدارة الوثائق', 'الأرشفة الرقمية', 'أنظمة الضرائب والإيرادات', 'أدوات الشفافية'],
                ],
            ],
            [
                'slug'  => 'markets',
                'icon'  => 'fas fa-store',
                'name'  => ['en' => 'Market Systems', 'fr' => 'Systèmes de Marché', 'ar' => 'أنظمة إدارة الأسواق'],
                'short' => [
                    'en' => 'Smart management platforms for markets, shops and retail businesses.',
                    'fr' => 'Plateformes de gestion intelligentes pour les marchés, boutiques et commerces.',
                    'ar' => 'منصات إدارة ذكية للأسواق والمحلات التجارية.',
                ],
                'desc' => [
                    'en' => 'Our market management systems digitize the operations of traditional markets and modern retail businesses. From inventory control and vendor management to point-of-sale systems and daily sales reports, we give market owners complete visibility and control over their business.',
                    'fr' => "Nos systèmes de gestion de marchés numérisent le fonctionnement des marchés traditionnels et des commerces modernes. De la gestion des stocks et des vendeurs aux systèmes de caisse et aux rapports de ventes quotidiens, nous offrons aux commerçants une visibilité et un contrôle complets sur leur activité.",
                    'ar' => 'تُرقِّم أنظمة إدارة الأسواق لدينا عمليات الأسواق التقليدية والمحلات التجارية الحديثة. من إدارة المخزون والموردين إلى نقاط البيع وتقارير المبيعات اليومية، نمنح أصحاب الأسواق رؤية كاملة وسيطرة تامة على نشاطهم.',
                ],
                'features' => [
                    'en' => ['Inventory Management', 'Point of Sale (POS)', 'Vendor Management', 'Daily Sales Reports', 'Low-stock Alerts', 'Mobile-friendly Interface'],
                    'fr' => ['Gestion des stocks', 'Caisse et point de vente', 'Gestion des vendeurs', 'Rapports de ventes quotidiens', 'Alertes de rupture de stock', 'Interface adaptée au mobile'],
                    'ar' => ['إدارة المخزون', 'نقطة البيع', 'إدارة الموردين', 'تقارير المبيعات اليومية', 'تنبيهات نفاد المخزون', 'واجهة متوافقة مع الهاتف'],
                ],
            ],
            [
                'slug'  => 'schools',
                'icon'  => 'fas fa-graduation-cap',
                'name'  => ['en' => 'School Management', 'fr' => 'Gestion Scolaire', 'ar' => 'إدارة المدارس'],
                'short' => [
                    'en' => 'Complete digital management platforms for schools and educational institutions.',
                    'fr' => 'Plateformes de gestion numérique complètes pour les écoles et les établissements éducatifs.',
                    'ar' => 'منصات إدارة رقمية متكاملة للمدارس والمؤسسات التعليمية.',
                ],
                'desc' => [
                    'en' => 'Our school management systems cover the full educational lifecycle — student enrollment, attendance tracking, grade management, parent communication and financial administration. We deliver intuitive platforms that empower teachers, keep parents informed and give administrators full control.',
                    'fr' => "Nos systèmes de gestion scolaire couvrent l'intégralité du cycle éducatif — inscription des élèves, suivi des présences, gestion des notes, communication avec les parents et administration financière. Nous livrons des plateformes intuitives qui facilitent le travail des enseignants, informent les parents et offrent aux directeurs une maîtrise totale de leur établissement.",
                    'ar' => 'تغطي أنظمة إدارة المدارس لدينا الدورة التعليمية بأكملها — تسجيل الطلاب وتتبع الحضور وإدارة الدرجات والتواصل مع أولياء الأمور والإدارة المالية. نقدم منصات سهلة الاستخدام تُمكِّن المعلمين وتُبقي الأهل على اطلاع وتمنح المديرين سيطرة كاملة.',
                ],
                'features' => [
                    'en' => ['Student Information System', 'Attendance Tracking', 'Grades & Report Cards', 'Parent Communication Portal', 'Fee Management', 'Library Management'],
                    'fr' => ['Système d\'information élèves', 'Suivi des présences et absences', 'Notes et bulletins scolaires', 'Portail de communication parents', 'Gestion des frais de scolarité', 'Gestion de bibliothèque'],
                    'ar' => ['نظام معلومات الطلاب', 'تتبع الحضور والغياب', 'الدرجات والتقارير المدرسية', 'بوابة التواصل مع الأهل', 'إدارة الرسوم الدراسية', 'إدارة المكتبة'],
                ],
            ],
            [
                'slug'  => 'construction',
                'icon'  => 'fas fa-hard-hat',
                'name'  => ['en' => 'Construction Management', 'fr' => 'Gestion de Chantier', 'ar' => 'إدارة المشاريع الإنشائية'],
                'short' => [
                    'en' => 'Project and resource management systems for construction and contracting companies.',
                    'fr' => 'Systèmes de gestion de projets et de ressources pour les entreprises de construction et de travaux.',
                    'ar' => 'أنظمة إدارة المشاريع والموارد لشركات البناء والمقاولات.',
                ],
                'desc' => [
                    'en' => 'We build end-to-end construction management software that helps contracting companies plan projects, track budgets, manage materials and coordinate teams. Our solutions reduce costly overruns and delays while keeping every stakeholder informed in real time.',
                    'fr' => "Nous développons des logiciels de gestion de chantier qui aident les entreprises de travaux à planifier leurs projets, suivre leurs budgets, gérer les matériaux et coordonner leurs équipes. Nos solutions réduisent les dépassements et les retards coûteux tout en tenant toutes les parties prenantes informées en temps réel.",
                    'ar' => 'نبني برامج إدارة إنشائية شاملة تساعد شركات المقاولات على تخطيط المشاريع ومتابعة الميزانيات وإدارة المواد وتنسيق الفرق. تُقلِّص حلولنا التجاوزات والتأخيرات المكلفة مع إبقاء جميع الأطراف على اطلاع دائم.',
                ],
                'features' => [
                    'en' => ['Project Planning & Scheduling', 'Budget & Cost Tracking', 'Material Management', 'Workforce Coordination', 'Safety & Compliance', 'Progress Reporting'],
                    'fr' => ['Planification et ordonnancement', 'Suivi budgétaire et des coûts', 'Gestion des matériaux', 'Coordination des équipes', 'Sécurité et conformité', "Rapports d'avancement"],
                    'ar' => ['تخطيط المشاريع وجدولتها', 'متابعة الميزانيات والتكاليف', 'إدارة مواد البناء', 'تنسيق فرق العمل', 'السلامة والامتثال', 'تقارير التقدم'],
                ],
            ],
            [
                'slug'  => 'farming',
                'icon'  => 'fas fa-seedling',
                'name'  => ['en' => 'Agriculture & Farming', 'fr' => 'Agriculture et Agri-business', 'ar' => 'الزراعة والأعمال الزراعية'],
                'short' => [
                    'en' => 'Technology platforms for farmers, cooperatives and agribusinesses.',
                    'fr' => 'Plateformes technologiques pour les agriculteurs, coopératives et agro-entreprises.',
                    'ar' => 'منصات تقنية للمزارعين والتعاونيات والشركات الزراعية.',
                ],
                'desc' => [
                    'en' => 'Our agricultural technology solutions help farmers, cooperatives and agribusinesses manage their operations more efficiently. From crop monitoring and supply chain traceability to market price alerts and cooperative management, we bring practical digital tools to the agricultural sector.',
                    'fr' => "Nos solutions technologiques agricoles aident les agriculteurs, coopératives et agro-entreprises à gérer leurs activités avec plus d'efficacité. Du suivi des cultures à la traçabilité de la chaîne logistique, en passant par les alertes de prix et la gestion coopérative, nous apportons des outils numériques concrets au secteur agricole.",
                    'ar' => 'تساعد حلولنا التقنية الزراعية المزارعين والتعاونيات والشركات الزراعية على إدارة أنشطتهم بكفاءة أعلى. من مراقبة المحاصيل وتتبع سلسلة التوريد إلى تنبيهات أسعار السوق وإدارة التعاونيات، نوفر أدوات رقمية عملية للقطاع الزراعي.',
                ],
                'features' => [
                    'en' => ['Crop Monitoring', 'Supply Chain Traceability', 'Market Price Alerts', 'Cooperative Management', 'Weather & Soil Integration', 'Mobile Farmer App'],
                    'fr' => ['Suivi des cultures', 'Traçabilité de la chaîne logistique', 'Alertes de prix de marché', 'Gestion des coopératives', 'Intégration météo et sol', 'Application mobile agriculteur'],
                    'ar' => ['مراقبة المحاصيل', 'تتبع سلسلة التوريد', 'تنبيهات أسعار السوق', 'إدارة التعاونيات', 'تكامل بيانات الطقس والتربة', 'تطبيق جوال للمزارع'],
                ],
            ],
            [
                'slug'  => 'donation',
                'icon'  => 'fas fa-hand-holding-heart',
                'name'  => ['en' => 'Donation Platforms', 'fr' => 'Plateformes de Collecte de Dons', 'ar' => 'منصات جمع التبرعات'],
                'short' => [
                    'en' => 'Secure, transparent donation and fundraising platforms for NGOs and charities.',
                    'fr' => 'Plateformes de collecte de dons sécurisées et transparentes pour les ONG et associations.',
                    'ar' => 'منصات جمع تبرعات آمنة وشفافة للمنظمات غير الحكومية والجمعيات الخيرية.',
                ],
                'desc' => [
                    'en' => 'We build trusted donation platforms for NGOs, charities, mosques, churches and community organizations. Our systems provide transparent fund tracking, donor management, campaign tools and mobile payment integration — all designed for accountability and ease of use.',
                    'fr' => "Nous développons des plateformes de collecte de dons fiables pour les ONG, associations caritatives, mosquées, églises et organisations communautaires. Nos systèmes intègrent un suivi transparent des fonds, la gestion des donateurs, des outils de campagne et le paiement mobile — le tout conçu pour la transparence et la facilité d'utilisation.",
                    'ar' => 'نبني منصات تبرع موثوقة للمنظمات غير الحكومية والجمعيات الخيرية والمساجد والكنائس والمنظمات المجتمعية. توفر أنظمتنا تتبعاً شفافاً للأموال وإدارة للمتبرعين وأدوات للحملات وتكاملاً مع الدفع المحمول.',
                ],
                'features' => [
                    'en' => ['Online Donation Portal', 'Campaign Management', 'Donor Database', 'Transparent Fund Tracking', 'Mobile Payment Integration', 'Reports & Analytics'],
                    'fr' => ['Portail de dons en ligne', 'Gestion des campagnes', 'Base de données donateurs', 'Suivi transparent des fonds', 'Intégration paiement mobile', 'Rapports et statistiques'],
                    'ar' => ['بوابة التبرع الإلكتروني', 'إدارة الحملات', 'قاعدة بيانات المتبرعين', 'تتبع الأموال بشفافية', 'تكامل الدفع المحمول', 'التقارير والإحصاءات'],
                ],
            ],
            [
                'slug'  => 'web-development',
                'icon'  => 'fas fa-laptop-code',
                'name'  => ['en' => 'Website Development', 'fr' => 'Développement Web', 'ar' => 'تطوير المواقع الإلكترونية'],
                'short' => [
                    'en' => 'Modern, responsive websites and web applications for businesses of all kinds.',
                    'fr' => 'Sites web et applications web modernes et responsives pour tout type d\'activité.',
                    'ar' => 'مواقع ويب وتطبيقات إلكترونية حديثة ومتجاوبة لجميع أنواع الأعمال.',
                ],
                'desc' => [
                    'en' => 'We design and develop high-performance websites and web applications that represent your business professionally online. From institutional websites to e-commerce platforms and fully custom web applications, our team delivers multilingual, mobile-first solutions built with modern technology.',
                    'fr' => "Nous concevons et développons des sites web et des applications web performants qui représentent votre activité de façon professionnelle. Des sites institutionnels aux plateformes e-commerce et aux applications web entièrement sur mesure, notre équipe livre des solutions multilingues, pensées pour le mobile en priorité.",
                    'ar' => 'نصمم وننشئ مواقع ويب وتطبيقات إلكترونية عالية الأداء تُقدِّم عملك بصورة احترافية على الإنترنت. من المواقع المؤسسية إلى منصات التجارة الإلكترونية والتطبيقات المخصصة، يُسلِّم فريقنا حلولاً متعددة اللغات مُحسَّنة للهاتف.',
                ],
                'features' => [
                    'en' => ['Institutional Website Design', 'E-commerce Development', 'Custom Web Applications', 'CMS & Content Portals', 'SEO Optimization', 'Multilingual Support (AR/FR/EN)'],
                    'fr' => ['Conception de sites institutionnels', 'Développement e-commerce', 'Applications web sur mesure', 'CMS et portails de contenu', 'Optimisation SEO', 'Support multilingue (AR/FR/EN)'],
                    'ar' => ['تصميم المواقع المؤسسية', 'تطوير التجارة الإلكترونية', 'تطبيقات ويب مخصصة', 'أنظمة إدارة المحتوى', 'تحسين محركات البحث', 'دعم متعدد اللغات (عربي/فرنسي/إنجليزي)'],
                ],
            ],
            [
                'slug'  => 'mobile-apps',
                'icon'  => 'fas fa-mobile-alt',
                'name'  => ['en' => 'Mobile Applications', 'fr' => 'Applications Mobiles', 'ar' => 'تطبيقات الهاتف'],
                'short' => [
                    'en' => 'Native and cross-platform mobile apps for Android and iOS.',
                    'fr' => 'Applications mobiles natives et multi-plateformes pour Android et iOS.',
                    'ar' => 'تطبيقات جوال أصيلة ومتعددة المنصات لأندرويد وiOS.',
                ],
                'desc' => [
                    'en' => 'We build mobile applications that put your business in your customers\' pockets. From simple utility apps to full-featured platforms connected to your existing systems, our mobile apps are built for performance, offline use, and the realities of mobile connectivity in Chad.',
                    'fr' => "Nous développons des applications mobiles qui mettent votre activité dans la poche de vos clients. Des applications utilitaires simples aux plateformes complètes connectées à vos systèmes existants, nos applications sont conçues pour la performance, l'utilisation hors ligne et les réalités de la connectivité mobile au Tchad.",
                    'ar' => 'نبني تطبيقات هاتف تضع عملك في متناول عملائك في أي مكان. من التطبيقات البسيطة إلى المنصات الكاملة المتصلة بأنظمتك القائمة، تتميز تطبيقاتنا بالأداء والعمل دون اتصال وملاءمة واقع الاتصالات في تشاد.',
                ],
                'features' => [
                    'en' => ['Android App Development', 'iOS App Development', 'Cross-platform Apps', 'Offline-first Architecture', 'Push Notifications', 'Integration with Existing Systems'],
                    'fr' => ['Développement Android', 'Développement iOS', 'Applications multi-plateformes', 'Fonctionnement hors ligne', 'Notifications push', 'Intégration aux systèmes existants'],
                    'ar' => ['تطوير تطبيقات أندرويد', 'تطوير تطبيقات iOS', 'تطبيقات متعددة المنصات', 'عمل بدون اتصال بالإنترنت', 'إشعارات فورية', 'التكامل مع الأنظمة الحالية'],
                ],
            ],
            [
                'slug'  => 'fintech',
                'icon'  => 'fas fa-money-bill-wave',
                'name'  => ['en' => 'Fintech & Money Transfer', 'fr' => "Fintech et Transfert d'Argent", 'ar' => 'التقنية المالية وتحويل الأموال'],
                'short' => [
                    'en' => 'Secure digital payment and money transfer systems.',
                    'fr' => 'Systèmes sécurisés de paiement numérique et de transfert de fonds.',
                    'ar' => 'أنظمة آمنة للدفع الرقمي وتحويل الأموال.',
                ],
                'desc' => [
                    'en' => 'We build secure, reliable fintech platforms including money transfer systems, digital wallets, payment gateways and financial tracking tools. Every solution comes with full transaction audit trails, multi-level access control and integration with mobile money operators — built to handle real money with the reliability it demands.',
                    'fr' => "Nous développons des plateformes fintech sécurisées et fiables : systèmes de transfert d'argent, portefeuilles numériques, passerelles de paiement et outils de suivi financier. Chaque solution intègre une piste d'audit complète des transactions, un contrôle d'accès multiniveau et une intégration avec les opérateurs de mobile money.",
                    'ar' => 'نبني منصات تقنية مالية آمنة وموثوقة تشمل أنظمة تحويل الأموال والمحافظ الرقمية وبوابات الدفع وأدوات المتابعة المالية. تأتي كل حل مزوداً بسجلات تدقيق كاملة للمعاملات وتحكم متعدد المستويات في الصلاحيات وتكامل مع مشغّلي المال المحمول.',
                ],
                'features' => [
                    'en' => ['Money Transfer System', 'Digital Wallet Platform', 'Payment Gateway Integration', 'Transaction Audit Trails', 'Multi-level Access & Roles', 'Mobile Money Integration'],
                    'fr' => ["Système de transfert d'argent", 'Plateforme de portefeuille numérique', 'Intégration passerelle de paiement', 'Piste d\'audit des transactions', 'Accès et rôles multiniveaux', 'Intégration mobile money'],
                    'ar' => ['نظام تحويل الأموال', 'منصة المحفظة الرقمية', 'تكامل بوابة الدفع', 'سجلات تدقيق المعاملات', 'صلاحيات متعددة المستويات', 'تكامل مع المال المحمول'],
                ],
            ],
            [
                'slug'  => 'custom-systems',
                'icon'  => 'fas fa-cubes',
                'name'  => ['en' => 'Custom Systems', 'fr' => 'Systèmes Sur Mesure', 'ar' => 'الأنظمة المخصصة'],
                'short' => [
                    'en' => 'Any system, any idea — we build it from scratch, tailored to your exact requirements.',
                    'fr' => "Tout système, toute idée — nous le développons de zéro, adapté à vos besoins exacts.",
                    'ar' => 'أي نظام، أي فكرة — نبنيه من الصفر وفق متطلباتك بالضبط.',
                ],
                'desc' => [
                    'en' => "Have a specific need that doesn't fit a standard category? We build it. HR platforms, inventory systems, ticketing systems, booking platforms, company intranets, administrative software, government portals, reporting tools — if your business or institution needs it, STH can build it. Every custom system is fully adapted to your workflow, your team and your language.",
                    'fr' => "Vous avez un besoin spécifique qui ne correspond à aucune catégorie standard ? Nous le développons. Plateformes RH, systèmes d'inventaire, billetteries, plateformes de réservation, intranets d'entreprise, logiciels administratifs, portails gouvernementaux, outils de reporting — si votre organisation en a besoin, STH peut le construire. Chaque système sur mesure est entièrement adapté à votre flux de travail, votre équipe et votre langue.",
                    'ar' => 'هل لديك احتياج محدد لا ينتمي إلى أي فئة قياسية؟ نحن نبنيه. منصات الموارد البشرية وأنظمة المخزون وأنظمة التذاكر ومنصات الحجز وشبكات الإنترانت والبرامج الإدارية والبوابات الحكومية وأدوات إعداد التقارير — إذا احتاجته مؤسستك، تستطيع STH بناؤه. كل نظام مخصص يُكيَّف بالكامل لسير عملك وفريقك ولغتك.',
                ],
                'features' => [
                    'en' => ['Requirements Analysis & Design', 'Custom Architecture', 'Agile Development', 'Staff Training & Handover', 'Full Source Code Ownership', 'Ongoing Support & Updates'],
                    'fr' => ['Analyse des besoins et conception', 'Architecture sur mesure', 'Développement agile', 'Formation du personnel et passation', 'Propriété complète du code source', 'Support et mises à jour continus'],
                    'ar' => ['تحليل المتطلبات والتصميم', 'هيكلية مخصصة', 'تطوير مرن', 'تدريب الفريق والتسليم', 'ملكية كاملة للكود المصدر', 'دعم وتحديثات مستمرة'],
                ],
            ],
        ];

        foreach ($servicesData as $sd) {
            Service::updateOrCreate(['slug' => $sd['slug']], [
                'parent_id'         => null,
                'order'             => array_search($sd['slug'], array_column($servicesData, 'slug')),
                'icon'              => $sd['icon'],
                'is_active'         => true,
                'show_in_nav'       => true,
                'name'              => $sd['name'],
                'description'       => $sd['desc'],
                'short_description' => $sd['short'],
                'features'          => [
                    'en' => implode('|', $sd['features']['en']),
                    'fr' => implode('|', $sd['features']['fr']),
                    'ar' => implode('|', $sd['features']['ar']),
                ],
            ]);
        }

        // ── Stats ──────────────────────────────────────────────────────────────
        // No image fields — safe to truncate and recreate
        Stat::truncate();
        $statsData = [
            ['icon' => 'fas fa-project-diagram', 'value' => '5+',   'label' => ['en' => 'Projects Delivered',   'fr' => 'Projets Livrés',          'ar' => 'مشاريع مُنجزة']],
            ['icon' => 'fas fa-handshake',        'value' => '3+',   'label' => ['en' => 'Satisfied Clients',    'fr' => 'Clients Satisfaits',       'ar' => 'عملاء راضون']],
            ['icon' => 'fas fa-th-large',         'value' => '11',   'label' => ['en' => 'Service Areas',        'fr' => 'Domaines de Service',      'ar' => 'مجالات خدمة']],
            ['icon' => 'fas fa-users',            'value' => '4+',   'label' => ['en' => 'Team Members',         'fr' => 'Membres de l\'Équipe',     'ar' => 'أعضاء الفريق']],
            ['icon' => 'fas fa-headset',          'value' => '24/7', 'label' => ['en' => 'Support Available',   'fr' => 'Support Disponible',       'ar' => 'دعم متواصل']],
            ['icon' => 'fas fa-calendar-check',   'value' => '2025', 'label' => ['en' => 'Year Founded',        'fr' => 'Année de Fondation',       'ar' => 'سنة التأسيس']],
        ];
        foreach ($statsData as $i => $st) {
            Stat::create(['icon' => $st['icon'], 'value' => $st['value'], 'label' => $st['label'], 'description' => ['en' => '', 'fr' => '', 'ar' => ''], 'order' => $i, 'is_active' => true]);
        }

        // ── Team Members ───────────────────────────────────────────────────────
        // Smart upsert by order — preserves uploaded photo if it exists
        $teamData = [
            [
                'name'     => ['en' => 'Ayoub Oumar',    'fr' => 'Ayoub Oumar',    'ar' => 'أيوب عمر'],
                'position' => ['en' => 'Chief Executive Officer',      'fr' => 'Directeur Général',             'ar' => 'المدير التنفيذي'],
                'bio'      => [
                    'en' => "Founder and CEO of STH. Ayoub defines the company's strategic vision and drives its growth, with the conviction that technology — when built right — can meaningfully transform how businesses operate in Chad.",
                    'fr' => "Fondateur et Directeur Général de STH, Ayoub définit la vision stratégique de l'entreprise et en pilote la croissance, avec la conviction que la technologie — bien conçue — peut véritablement transformer le fonctionnement des entreprises au Tchad.",
                    'ar' => 'مؤسس ومدير تنفيذي لشركة STH، يرسم أيوب التوجه الاستراتيجي للشركة ويقود مسيرة نموها، مؤمناً بأن التكنولوجيا — إذا أُحسن بناؤها — قادرة على تحويل طريقة عمل الشركات في تشاد تحويلاً حقيقياً.',
                ],
            ],
            [
                'name'     => ['en' => 'Mohamed Oumar',  'fr' => 'Mohamed Oumar',  'ar' => 'محمد عمر'],
                'position' => ['en' => 'Vice Chief Executive Officer', 'fr' => 'Directeur Général Adjoint',    'ar' => 'نائب المدير التنفيذي'],
                'bio'      => [
                    'en' => "Vice CEO at STH and the CEO's right hand. Mohamed oversees daily company operations and project delivery, ensuring every client receives the quality and results they were promised.",
                    'fr' => "Directeur Général Adjoint de STH et bras droit du PDG, Mohamed supervise les opérations quotidiennes de l'entreprise et la livraison des projets, veillant à ce que chaque client obtienne la qualité et les résultats qui lui ont été promis.",
                    'ar' => 'نائب المدير التنفيذي في STH والذراع اليمنى للمدير التنفيذي، يُشرف محمد على العمليات اليومية للشركة وتسليم المشاريع، حارصاً على أن يحصل كل عميل على الجودة والنتائج التي وُعد بها.',
                ],
            ],
            [
                'name'     => ['en' => 'Mohamed Issa',   'fr' => 'Mohamed Issa',   'ar' => 'محمد عيسى'],
                'position' => ['en' => 'Operations Manager',           'fr' => 'Responsable des Opérations',  'ar' => 'مدير العمليات'],
                'bio'      => [
                    'en' => "Operations Manager at STH. Mohamed coordinates development teams and manages client relationships, making sure every project moves forward on time and to specification from kickoff to delivery.",
                    'fr' => "Responsable des Opérations chez STH, Mohamed coordonne les équipes de développement et gère les relations clients, veillant à ce que chaque projet avance dans les délais et selon les spécifications convenues, du lancement à la livraison.",
                    'ar' => 'مدير العمليات في STH، ينسّق محمد فرق التطوير ويدير علاقات العملاء، حارصاً على تقدم كل مشروع وفق الجدول الزمني والمواصفات المتفق عليها من الانطلاق حتى التسليم.',
                ],
            ],
            [
                'name'     => ['en' => 'Haroun Mohamed', 'fr' => 'Haroun Mohamed', 'ar' => 'هارون محمد'],
                'position' => ['en' => 'General Secretary',            'fr' => 'Secrétaire Général',           'ar' => 'الأمين العام'],
                'bio'      => [
                    'en' => "General Secretary of STH. Haroun manages all administrative operations, documentation, institutional communication and the organizational functions that keep the company running smoothly every day.",
                    'fr' => "Secrétaire Général de STH, Haroun prend en charge l'ensemble des opérations administratives, la gestion documentaire, la communication institutionnelle et les fonctions organisationnelles qui assurent le bon fonctionnement de l'entreprise au quotidien.",
                    'ar' => 'الأمين العام لشركة STH، يتولى هارون إدارة جميع العمليات الإدارية والوثائق والتواصل المؤسسي والوظائف التنظيمية التي تضمن سير الشركة بسلاسة كل يوم.',
                ],
            ],
        ];
        foreach ($teamData as $i => $t) {
            $existing = TeamMember::where('order', $i)->first();
            if ($existing) {
                $existing->name     = $t['name'];
                $existing->position = $t['position'];
                $existing->bio      = $t['bio'];
                $existing->is_active = true;
                $existing->save();  // photo left untouched
            } else {
                TeamMember::create(['name' => $t['name'], 'position' => $t['position'], 'bio' => $t['bio'], 'order' => $i, 'is_active' => true, 'photo' => null]);
            }
        }
        // Remove any extra team members from old seeder runs
        TeamMember::where('order', '>=', count($teamData))->delete();

        // ── Testimonials ───────────────────────────────────────────────────────
        // Client names kept confidential — no company names exposed
        // Smart upsert by order — preserves uploaded author_photo
        $testData = [
            [
                'quote' => [
                    'en' => "STH delivered two systems for us — a cargo management platform and a retail management system. Both are fast, easy to use, and have completely changed how we run our daily operations. A serious, professional team that delivers what it promises.",
                    'fr' => "STH nous a livré deux systèmes : une plateforme de gestion cargo et un système de gestion commerciale. Les deux sont rapides, intuitifs, et ont radicalement transformé notre façon de gérer nos activités au quotidien. Une équipe sérieuse et professionnelle qui tient ses engagements.",
                    'ar' => 'أنجزت STH لنا نظامَين: منصة لإدارة الشحن ونظاماً لإدارة المبيعات. كلاهما سريع وسهل الاستخدام، وقد غيّرا طريقة تسيير أعمالنا اليومية تغييراً جذرياً. فريق جادّ ومحترف يفي بما يَعِد.',
                ],
                'author_name'     => ['en' => 'Djibrine M.', 'fr' => 'Djibrine M.', 'ar' => 'جبرين م.'],
                'author_position' => ['en' => 'Company Owner, N\'Djamena', 'fr' => "Chef d'entreprise, N'Djaména", 'ar' => 'صاحب شركة، إنجامينا'],
                'company' => '',
                'rating'  => 5,
            ],
            [
                'quote' => [
                    'en' => "I needed a proper system to organize my business, and STH delivered exactly what I was looking for. Sales, inventory, daily records — everything is now clear and well-structured. I am very satisfied and would not hesitate to recommend them.",
                    'fr' => "J'avais besoin d'un système adapté pour organiser mon activité, et STH m'a livré exactement ce que je cherchais. Les ventes, l'inventaire, les enregistrements quotidiens — tout est désormais clair et bien structuré. Je suis très satisfait et je les recommande sans la moindre hésitation.",
                    'ar' => 'كنت بحاجة إلى نظام مناسب لتنظيم نشاطي التجاري، فأعطتني STH تماماً ما كنت أبحث عنه. المبيعات والمخزون والسجلات اليومية أصبحت كلها واضحة ومنظمة. أنا راضٍ تمام الرضا ولن أتردد في التوصية بهم.',
                ],
                'author_name'     => ['en' => 'A. D.', 'fr' => 'A. D.', 'ar' => 'أ. د.'],
                'author_position' => ['en' => 'Market Owner, N\'Djamena', 'fr' => "Commerçant, N'Djaména", 'ar' => 'صاحب سوق، إنجامينا'],
                'company' => '',
                'rating'  => 5,
            ],
            [
                'quote' => [
                    'en' => "The market management system STH built for us is excellent. Tracking stock, monitoring daily sales and managing vendors has become simple and precise. It saved us a lot of time and gave us full visibility over our activity. Great work.",
                    'fr' => "Le système de gestion de marché développé par STH est excellent. Le suivi des stocks, la surveillance des ventes quotidiennes et la gestion des vendeurs sont devenus simples et précis. Il nous a fait gagner énormément de temps et nous offre une visibilité totale sur notre activité. Très bon travail.",
                    'ar' => 'نظام إدارة السوق الذي طوّرته STH لنا ممتاز. تتبّع المخزون ورصد المبيعات اليومية وإدارة الموردين أصبحت جميعها بسيطة ودقيقة. وفّر لنا النظام الكثير من الوقت ومنحنا رؤية كاملة على نشاطنا. عمل رائع.',
                ],
                'author_name'     => ['en' => 'M. O.', 'fr' => 'M. O.', 'ar' => 'م. ع.'],
                'author_position' => ['en' => 'Market Owner, N\'Djamena', 'fr' => "Propriétaire de marché, N'Djaména", 'ar' => 'صاحب سوق، إنجامينا'],
                'company' => '',
                'rating'  => 5,
            ],
        ];
        foreach ($testData as $i => $t) {
            $existing = Testimonial::where('order', $i)->first();
            if ($existing) {
                $existing->quote           = $t['quote'];
                $existing->author_name     = $t['author_name'];
                $existing->author_position = $t['author_position'];
                $existing->author_company  = $t['company'];
                $existing->rating          = $t['rating'];
                $existing->is_active       = true;
                $existing->save();  // author_photo left untouched
            } else {
                Testimonial::create(['quote' => $t['quote'], 'author_name' => $t['author_name'], 'author_position' => $t['author_position'], 'author_company' => $t['company'], 'rating' => $t['rating'], 'order' => $i, 'is_active' => true]);
            }
        }
        Testimonial::where('order', '>=', count($testData))->delete();

        // ── Projects ───────────────────────────────────────────────────────────
        // Client names/company names kept confidential
        // Smart upsert by order — preserves uploaded image
        $projectsData = [
            [
                'title'    => ['en' => 'Cargo & Logistics Management System',          'fr' => 'Système de Gestion Cargo et Logistique',      'ar' => 'نظام إدارة الشحن والخدمات اللوجستية'],
                'desc'     => ['en' => 'A complete cargo and logistics management system covering shipment tracking, client records, billing, delivery management and full reporting. Built to give the owner real-time visibility over all operations and eliminate manual record-keeping.', 'fr' => "Un système complet de gestion cargo et logistique couvrant le suivi des expéditions, les dossiers clients, la facturation, la gestion des livraisons et des rapports complets. Conçu pour offrir au propriétaire une visibilité en temps réel sur toutes les opérations.", 'ar' => 'نظام متكامل لإدارة الشحن والخدمات اللوجستية يشمل تتبع الشحنات وسجلات العملاء والفوترة وإدارة التسليم والتقارير الشاملة. مبني لمنح المالك رؤية آنية على جميع العمليات والتخلص من التسجيل اليدوي.'],
                'client'   => ['en' => 'Private client — N\'Djamena', 'fr' => "Client privé — N'Djaména", 'ar' => 'عميل خاص — إنجامينا'],
                'category' => ['en' => 'Cargo & Logistics', 'fr' => 'Cargo et Logistique', 'ar' => 'الشحن والخدمات اللوجستية'],
                'tech' => 'Laravel, MySQL, Bootstrap', 'featured' => true,
            ],
            [
                'title'    => ['en' => 'Retail Store Management System',               'fr' => 'Système de Gestion de Boutique',               'ar' => 'نظام إدارة محل التجزئة'],
                'desc'     => ['en' => 'A retail management system handling inventory, product catalogue, sales tracking, supplier management and daily financial reports. Designed to be intuitive enough for daily use by non-technical staff while giving the owner complete control over stock and revenue.', 'fr' => "Un système de gestion pour boutique couvrant l'inventaire, le catalogue produits, le suivi des ventes, la gestion des fournisseurs et les rapports financiers quotidiens. Conçu pour être suffisamment intuitif pour un usage quotidien par du personnel non technique.", 'ar' => 'نظام إدارة تجزئة يتولى المخزون وكتالوج المنتجات وتتبع المبيعات وإدارة الموردين والتقارير المالية اليومية. مصمم ليكون سهل الاستخدام للموظفين غير التقنيين مع منح المالك سيطرة كاملة على المخزون والإيرادات.'],
                'client'   => ['en' => 'Private client — N\'Djamena', 'fr' => "Client privé — N'Djaména", 'ar' => 'عميل خاص — إنجامينا'],
                'category' => ['en' => 'Retail Management', 'fr' => 'Gestion Commerciale', 'ar' => 'إدارة التجزئة'],
                'tech' => 'Laravel, MySQL, Bootstrap', 'featured' => true,
            ],
            [
                'title'    => ['en' => 'Market Management System',                     'fr' => 'Système de Gestion de Marché',                'ar' => 'نظام إدارة السوق'],
                'desc'     => ['en' => 'A market management system covering product inventory, vendor management, daily sales recording and automatic stock alerts. The owner now has a clear, organized view of all market activity at all times.', 'fr' => "Un système de gestion de marché couvrant l'inventaire des produits, la gestion des vendeurs, l'enregistrement des ventes quotidiennes et les alertes de stock automatiques. Le propriétaire dispose désormais d'une vue claire et organisée sur toute l'activité du marché.", 'ar' => 'نظام إدارة سوق يغطي مخزون المنتجات وإدارة الموردين وتسجيل المبيعات اليومية وتنبيهات المخزون التلقائية. أصبح لدى المالك نظرة واضحة ومنظمة على كل نشاط السوق في أي وقت.'],
                'client'   => ['en' => 'Private client — N\'Djamena', 'fr' => "Client privé — N'Djaména", 'ar' => 'عميل خاص — إنجامينا'],
                'category' => ['en' => 'Market Management', 'fr' => 'Gestion de Marché', 'ar' => 'إدارة السوق'],
                'tech' => 'Laravel, MySQL, Bootstrap', 'featured' => true,
            ],
            [
                'title'    => ['en' => 'Digital Market Platform',                      'fr' => 'Plateforme Numérique de Marché',               'ar' => 'منصة السوق الرقمية'],
                'desc'     => ['en' => 'A comprehensive digital market platform featuring vendor management, real-time inventory tracking, sales reporting and an intuitive dashboard. The platform gives the owner full, organized visibility over all market operations and transactions.', 'fr' => "Une plateforme de marché numérique complète avec gestion des vendeurs, suivi des stocks en temps réel, rapports de ventes et tableau de bord intuitif. La plateforme offre au propriétaire une visibilité totale et organisée sur toutes les opérations et transactions.", 'ar' => 'منصة رقمية متكاملة لإدارة السوق تتضمن إدارة الموردين وتتبع المخزون الآني وتقارير المبيعات ولوحة تحكم سهلة الاستخدام. تمنح المنصة المالك رؤية كاملة ومنظمة على جميع العمليات والمعاملات.'],
                'client'   => ['en' => 'Private client — N\'Djamena', 'fr' => "Client privé — N'Djaména", 'ar' => 'عميل خاص — إنجامينا'],
                'category' => ['en' => 'Market Management', 'fr' => 'Gestion de Marché', 'ar' => 'إدارة السوق'],
                'tech' => 'Laravel, MySQL, Bootstrap', 'featured' => true,
            ],
            [
                'title'    => ['en' => 'STH Corporate Website',                        'fr' => 'Site Web Officiel STH',                       'ar' => 'الموقع الرسمي لشركة STH'],
                'desc'     => ['en' => 'A multilingual corporate website for STH built with Laravel 11, featuring a full admin panel, dynamic content management, service pages, portfolio, blog, team management, testimonials, contact forms, dynamic colour theming and a PWA for mobile installation.', 'fr' => "Le site web officiel multilingue de STH développé avec Laravel 11. Il comprend un panneau d'administration complet, une gestion de contenu dynamique, des pages de services, un portfolio, un blog, une gestion d'équipe, des témoignages, des formulaires de contact, un thème de couleurs dynamique et une PWA.", 'ar' => 'الموقع الرسمي متعدد اللغات لشركة STH، مبني بـLaravel 11. يتضمن لوحة إدارة كاملة وإدارة محتوى ديناميكية وصفحات الخدمات والمحفظة والمدونة وإدارة الفريق والشهادات ونماذج التواصل وألوان ديناميكية وتطبيق PWA.'],
                'client'   => ['en' => 'System Technologie Hanana', 'fr' => 'System Technologie Hanana', 'ar' => 'نظام تكنولوجيا حنانا'],
                'category' => ['en' => 'Web Development', 'fr' => 'Développement Web', 'ar' => 'تطوير الويب'],
                'tech' => 'Laravel 11, Blade, MySQL, Bootstrap 5, PWA', 'featured' => false,
            ],
        ];
        foreach ($projectsData as $i => $p) {
            $existing = Project::where('order', $i)->first();
            if ($existing) {
                $existing->title        = $p['title'];
                $existing->description  = $p['desc'];
                $existing->client       = $p['client'];
                $existing->category     = $p['category'];
                $existing->technologies = $p['tech'];
                $existing->is_featured  = $p['featured'];
                $existing->is_active    = true;
                $existing->save();  // image left untouched
            } else {
                Project::create(['title' => $p['title'], 'description' => $p['desc'], 'client' => $p['client'], 'category' => $p['category'], 'technologies' => $p['tech'], 'is_featured' => $p['featured'], 'is_active' => true, 'order' => $i, 'completed_at' => now()->subMonths(rand(1,8)), 'image' => null]);
            }
        }
        Project::where('order', '>=', count($projectsData))->delete();

        // ── Blog Posts ─────────────────────────────────────────────────────────
        // Smart upsert by slug — preserves uploaded image
        $adminUser = User::where('email', 'admin@app.com')->first();
        $postsData = [
            [
                'slug'    => 'digital-transformation-chad',
                'title'   => ['en' => 'Digital Transformation in Chad: Opportunities and Challenges', 'fr' => 'Transformation Numérique au Tchad : Opportunités et Défis', 'ar' => 'التحول الرقمي في تشاد: الفرص والتحديات'],
                'excerpt' => [
                    'en' => "Chad is at the beginning of its digital journey. Here's what businesses and entrepreneurs need to understand about adopting technology today.",
                    'fr' => "Le Tchad est au début de sa transformation numérique. Voici ce que les entreprises et les entrepreneurs doivent comprendre sur l'adoption de la technologie aujourd'hui.",
                    'ar' => 'تقف تشاد عند مفترق طرق رقمي مهم. إليك ما ينبغي على الشركات ورجال الأعمال فهمه حول تبني التكنولوجيا اليوم.',
                ],
                'content' => [
                    'en' => "<p>The digital transformation wave is reshaping economies across Africa, and Chad is no exception. As mobile connectivity improves and smartphone use rises, businesses and entrepreneurs are increasingly looking to technology to solve everyday challenges.</p><p>At STH, we see this firsthand. Whether it's a market owner who wants to know exactly what stock he has left, or a logistics company that needs to track shipments accurately, the demand for simple, reliable digital tools is real and growing.</p><p>The opportunities are significant: better organization, fewer errors, faster decisions and greater visibility over your business. The challenges are also real — reliable internet is not everywhere, staff need training, and solutions must be adapted to local realities.</p><p>This is precisely why STH focuses on building systems that work in the Chadian context: available in Arabic, French and English, designed for simplicity, and capable of functioning even with limited connectivity. Technology must serve people — not the other way around.</p>",
                    'fr'  => "<p>La vague de transformation numérique remodèle les économies africaines, et le Tchad n'y fait pas exception. À mesure que la connectivité mobile s'améliore et que l'usage des smartphones progresse, entreprises et entrepreneurs se tournent de plus en plus vers la technologie pour résoudre leurs défis quotidiens.</p><p>Chez STH, nous le constatons directement sur le terrain. Qu'il s'agisse d'un commerçant qui souhaite connaître précisément l'état de son stock, ou d'une entreprise de transport qui a besoin de suivre ses expéditions avec rigueur, la demande d'outils numériques simples et fiables est bien réelle et en pleine croissance.</p><p>Les opportunités sont significatives : meilleure organisation, moins d'erreurs, décisions plus rapides et visibilité accrue sur votre activité. Les défis existent aussi — internet n'est pas partout, le personnel a besoin de formation, et les solutions doivent s'adapter aux réalités locales.</p><p>C'est précisément pour cela que STH se concentre sur des systèmes qui fonctionnent dans le contexte tchadien : disponibles en arabe, français et anglais, conçus pour la simplicité et capables de fonctionner même avec une connectivité limitée.</p>",
                    'ar'  => "<p>تُعيد موجة التحول الرقمي رسم ملامح الاقتصادات الأفريقية، ولا يُستثنى من ذلك تشاد. مع تحسّن الاتصال بالإنترنت وتصاعد استخدام الهواتف الذكية، باتت الشركات ورجال الأعمال يلجؤون بصورة متزايدة إلى التكنولوجيا لمعالجة تحديات يومية.</p><p>في STH نشهد هذا مباشرة على أرض الواقع. سواء كان صاحب سوق يريد معرفة ما تبقى من مخزونه بدقة، أو شركة شحن تحتاج إلى تتبع شحناتها بانتظام — الطلب على أدوات رقمية بسيطة وموثوقة حقيقي ومتنامٍ.</p><p>الفرص كبيرة: تنظيم أفضل وأخطاء أقل وقرارات أسرع ورؤية أوسع على نشاطك التجاري. لكن التحديات قائمة أيضاً — الإنترنت ليس متاحاً في كل مكان، والموظفون يحتاجون إلى تدريب، والحلول يجب أن تتكيف مع الواقع المحلي.</p><p>هذا بالضبط ما تركّز عليه STH: بناء أنظمة تعمل في السياق التشادي، متوفرة بالعربية والفرنسية والإنجليزية، مصممة للبساطة وقادرة على العمل حتى مع اتصال محدود.</p>",
                ],
                'category' => ['en' => 'Technology', 'fr' => 'Technologie', 'ar' => 'التكنولوجيا'],
                'featured' => true,
            ],
            [
                'slug'    => 'market-management-system-chad',
                'title'   => ['en' => 'Why Every Market Owner in Chad Needs a Management System', 'fr' => "Pourquoi Chaque Commerçant au Tchad a Besoin d'un Système de Gestion", 'ar' => 'لماذا يحتاج كل صاحب سوق في تشاد إلى نظام إدارة'],
                'excerpt' => [
                    'en' => "Managing a business with notebooks and memory works — until it doesn't. Here's what changes when you switch to a digital management system.",
                    'fr' => "Gérer son activité avec des cahiers et sa mémoire, ça marche — jusqu'au jour où ça ne marche plus. Voici ce qui change quand on passe à un système de gestion numérique.",
                    'ar' => 'إدارة الأعمال بالدفاتر والذاكرة تنجح — إلى حين لا تنجح. إليك ما يتغير عند الانتقال إلى نظام إدارة رقمي.',
                ],
                'content' => [
                    'en' => "<p>Most market owners and traders in Chad manage their operations the way they always have: a notebook for sales, another for stock, and a lot of mental arithmetic. This approach works when the business is small — but as it grows, the gaps start to show.</p><p>Stock goes missing without explanation. Sales figures are hard to reconcile at the end of the day. You can't easily tell which products are profitable and which aren't. And at the end of the month, the numbers rarely add up cleanly.</p><p>A digital management system changes this entirely. With the right platform, a market owner gets a real-time dashboard showing current inventory levels, daily sales, supplier records and automatic alerts when stock is running low. Every transaction is recorded. Nothing gets lost.</p><p>The transition doesn't require technical expertise. STH builds systems specifically designed for non-technical users — in Arabic, French and English — so that staff can start using them from day one without difficulty.</p><p>If you run a market, a shop or any trading business and are still managing everything manually, a digital system may be the single biggest improvement you can make. Contact STH to discuss what the right solution looks like for your business.</p>",
                    'fr'  => "<p>La plupart des commerçants et propriétaires de marchés au Tchad gèrent leurs activités comme ils l'ont toujours fait : un cahier pour les ventes, un autre pour les stocks, et beaucoup de calcul mental. Cette approche fonctionne quand l'activité est modeste — mais à mesure qu'elle grandit, les lacunes commencent à apparaître.</p><p>Des stocks disparaissent sans explication. Les chiffres de ventes sont difficiles à réconcilier en fin de journée. Il est impossible de savoir facilement quels produits sont rentables. Et en fin de mois, les comptes ne tombent jamais vraiment juste.</p><p>Un système de gestion numérique change tout cela. Avec la bonne plateforme, un propriétaire dispose d'un tableau de bord en temps réel affichant les niveaux de stock actuels, les ventes du jour, les dossiers fournisseurs et des alertes automatiques en cas de stock bas. Chaque transaction est enregistrée. Rien ne se perd.</p><p>La transition ne nécessite pas de compétences techniques. STH développe des systèmes conçus spécifiquement pour des utilisateurs non techniques — en arabe, français et anglais — afin que le personnel puisse les utiliser dès le premier jour sans difficulté.</p>",
                    'ar'  => "<p>يدير معظم أصحاب الأسواق والتجار في تشاد أعمالهم بالطريقة التقليدية: دفتر للمبيعات وآخر للمخزون والكثير من الحسابات الذهنية. ينجح هذا الأسلوب حين يكون النشاط محدوداً، لكن مع النمو تبدأ الثغرات في الظهور.</p><p>يختفي المخزون دون تفسير. يصعب مطابقة أرقام المبيعات في نهاية اليوم. لا يمكن معرفة المنتجات المربحة من غيرها بسهولة. وفي نهاية الشهر نادراً ما تتطابق الأرقام بوضوح.</p><p>يغيّر نظام الإدارة الرقمي هذا كله. تمنح المنصة المناسبة صاحب السوق لوحة تحكم آنية تُظهر مستويات المخزون الحالية والمبيعات اليومية وسجلات الموردين وتنبيهات تلقائية عند انخفاض المخزون. كل معاملة مُسجَّلة. لا شيء يضيع.</p><p>الانتقال لا يتطلب خبرة تقنية. تبني STH أنظمة مصممة خصيصاً للمستخدمين غير التقنيين بالعربية والفرنسية والإنجليزية، ليتمكن الفريق من استخدامها منذ اليوم الأول دون صعوبة.</p>",
                ],
                'category' => ['en' => 'Business', 'fr' => 'Business', 'ar' => 'الأعمال'],
                'featured' => false,
            ],
            [
                'slug'    => 'choosing-it-partner-chad',
                'title'   => ['en' => 'What Makes a Good Technology Partner for a Business in Chad', 'fr' => "Ce qui fait un bon partenaire technologique pour une entreprise au Tchad", 'ar' => 'ما الذي يجعل شريكاً تقنياً جيداً للشركات في تشاد'],
                'excerpt' => [
                    'en' => "Choosing a technology partner is one of the most important decisions a growing business makes. Here are the qualities that actually matter.",
                    'fr' => "Choisir un partenaire technologique est l'une des décisions les plus importantes pour une entreprise en croissance. Voici les qualités qui comptent vraiment.",
                    'ar' => 'اختيار شريك تقني هو من أهم القرارات التي تتخذها أي شركة ناشئة. إليك الصفات التي تهم فعلاً.',
                ],
                'content' => [
                    'en' => "<p>When a business in Chad decides to invest in a digital system, one of the biggest risks is choosing the wrong technology partner. A polished demo doesn't guarantee a working product. A low price rarely means good value. And a company based elsewhere often doesn't understand local realities.</p><p>So what should you actually look for?</p><p><strong>Local presence.</strong> A partner physically in Chad understands the context — the connectivity constraints, the language needs, the way business is done here. When something needs fixing after delivery, you want someone reachable.</p><p><strong>Clear communication.</strong> The best technical team is useless if they can't explain what they're building in terms you understand. Good partners listen carefully first, then build.</p><p><strong>Simplicity as a priority.</strong> Systems that are too complex simply don't get used. The best systems solve the real problem with as little friction as possible.</p><p><strong>Genuine after-sales support.</strong> A system delivered and then abandoned is worse than no system at all. Make sure your partner will stand behind what they build — long after the project is closed.</p><p>These principles guide how STH works. We are a Chadian team, building for Chadian businesses, and we back everything we deliver.</p>",
                    'fr'  => "<p>Quand une entreprise au Tchad décide d'investir dans un système numérique, l'un des risques les plus importants est de choisir le mauvais partenaire technologique. Une belle démonstration ne garantit pas un produit fonctionnel. Un prix bas ne signifie pas forcément une bonne valeur. Et une entreprise installée ailleurs ne comprend souvent pas les réalités locales.</p><p>Que faut-il réellement rechercher ?</p><p><strong>La présence locale.</strong> Un partenaire physiquement présent au Tchad comprend le contexte — les contraintes de connectivité, les besoins linguistiques, la façon dont les affaires se font ici.</p><p><strong>Une communication claire.</strong> La meilleure équipe technique ne sert à rien si elle ne sait pas expliquer ce qu'elle construit en termes compréhensibles. Les bons partenaires écoutent d'abord, puis construisent.</p><p><strong>La simplicité comme priorité.</strong> Les systèmes trop complexes ne sont tout simplement pas utilisés. Les meilleurs systèmes résolvent le vrai problème avec le moins de friction possible.</p><p><strong>Un vrai support après livraison.</strong> Un système livré puis abandonné est pire qu'aucun système. Assurez-vous que votre partenaire assumera ce qu'il a construit, longtemps après la clôture du projet.</p><p>Ces principes guident la façon de travailler de STH.</p>",
                    'ar'  => "<p>حين تقرر شركة في تشاد الاستثمار في نظام رقمي، يكمن أحد أكبر المخاطر في اختيار الشريك التقني الخطأ. عرض تجريبي أنيق لا يضمن منتجاً يعمل. وسعر منخفض نادراً ما يعني قيمة جيدة. وشركة مقرّها في مكان آخر غالباً لا تفهم الواقع المحلي.</p><p>إذن ماذا ينبغي أن تبحث عنه فعلاً؟</p><p><strong>الحضور المحلي.</strong> شريك موجود في تشاد يفهم السياق — قيود الاتصال، والاحتياجات اللغوية، وطريقة سير الأعمال هنا. حين يحتاج شيء ما إلى إصلاح بعد التسليم، تريد شخصاً يمكن الوصول إليه.</p><p><strong>التواصل الواضح.</strong> أفضل فريق تقني لا قيمة له إن لم يستطع شرح ما يبنيه بمصطلحات تفهمها. الشركاء الجيدون يستمعون أولاً، ثم يبنون.</p><p><strong>البساطة أولوية.</strong> الأنظمة شديدة التعقيد لا يستخدمها أحد ببساطة. أفضل الأنظمة هي تلك التي تحل المشكلة الحقيقية بأقل احتكاك ممكن.</p><p><strong>دعم حقيقي بعد التسليم.</strong> نظام يُسلَّم ثم يُهجر أسوأ من لا نظام على الإطلاق. تأكد أن شريكك سيقف وراء ما بنى — طويلاً بعد إغلاق المشروع.</p><p>هذه المبادئ هي التي تحكم طريقة عمل STH.</p>",
                ],
                'category' => ['en' => 'Business', 'fr' => 'Business', 'ar' => 'الأعمال'],
                'featured' => true,
            ],
        ];
        foreach ($postsData as $pd) {
            $existing = BlogPost::where('slug', $pd['slug'])->first();
            if ($existing) {
                $existing->title        = $pd['title'];
                $existing->excerpt      = $pd['excerpt'];
                $existing->content      = $pd['content'];
                $existing->category     = $pd['category'];
                $existing->is_featured  = $pd['featured'];
                $existing->is_published = true;
                $existing->save();  // image left untouched
            } else {
                BlogPost::create(['title' => $pd['title'], 'excerpt' => $pd['excerpt'], 'content' => $pd['content'], 'category' => $pd['category'], 'slug' => $pd['slug'], 'author_id' => $adminUser?->id, 'is_published' => true, 'published_at' => now()->subDays(rand(1,60)), 'is_featured' => $pd['featured'], 'image' => null]);
            }
        }

        // ── FAQs ───────────────────────────────────────────────────────────────
        // No image fields — safe to truncate
        Faq::truncate();
        $faqsData = [
            ['page_key' => 'home',
                'question' => ['en' => 'Where is STH located?', 'fr' => 'Où est située STH ?', 'ar' => 'أين يقع مقر STH؟'],
                'answer'   => ['en' => "STH is based in N'Djamena, the capital of Chad. We work with clients across the country.", 'fr' => "STH est basée à N'Djamena, la capitale du Tchad. Nous travaillons avec des clients à travers tout le pays.", 'ar' => 'يقع مقر STH في إنجامينا، عاصمة تشاد. نعمل مع عملاء في مختلف أنحاء البلاد.']],
            ['page_key' => 'home',
                'question' => ['en' => 'What kinds of systems do you build?', 'fr' => 'Quels types de systèmes développez-vous ?', 'ar' => 'ما أنواع الأنظمة التي تبنونها؟'],
                'answer'   => ['en' => 'We build any digital system a business or institution needs — market management systems, cargo and logistics platforms, retail management tools, school management systems, ERP solutions, money transfer platforms, mobile applications, websites and fully custom systems. If you can describe it, we can build it.', 'fr' => "Nous développons tout système numérique dont une entreprise ou une institution a besoin — systèmes de gestion de marchés, plateformes cargo et logistique, outils de gestion commerciale, systèmes scolaires, solutions ERP, plateformes de transfert d'argent, applications mobiles, sites web et systèmes entièrement sur mesure. Si vous pouvez le décrire, nous pouvons le construire.", 'ar' => 'نبني أي نظام رقمي تحتاجه شركة أو مؤسسة — أنظمة إدارة الأسواق ومنصات الشحن واللوجستيات وأدوات إدارة التجزئة وأنظمة إدارة المدارس وحلول ERP ومنصات تحويل الأموال وتطبيقات الهاتف والمواقع الإلكترونية والأنظمة المخصصة. إذا استطعت وصفه، نستطيع بناءه.']],
            ['page_key' => 'home',
                'question' => ['en' => 'Do you provide support after the system is delivered?', 'fr' => 'Assurez-vous un support après la livraison du système ?', 'ar' => 'هل تقدمون دعماً بعد تسليم النظام؟'],
                'answer'   => ['en' => 'Yes. We provide full technical support, staff training and maintenance for every system we deliver. We remain available to fix issues, add features and ensure the system continues to serve you well over time.', 'fr' => 'Oui. Nous assurons un support technique complet, une formation du personnel et la maintenance pour chaque système livré. Nous restons disponibles pour résoudre les problèmes, ajouter des fonctionnalités et garantir que le système vous serve bien sur la durée.', 'ar' => 'نعم. نقدم دعماً تقنياً كاملاً وتدريباً للموظفين وصيانة لكل نظام نُسلِّمه. نبقى متاحين لإصلاح المشكلات وإضافة الميزات وضمان أن يواصل النظام خدمتك على المدى الطويل.']],
            ['page_key' => 'home',
                'question' => ['en' => 'How long does it take to build a system?', 'fr' => 'Combien de temps faut-il pour développer un système ?', 'ar' => 'كم يستغرق بناء نظام؟'],
                'answer'   => ['en' => 'It depends on the scope. A market or retail management system typically takes two to six weeks. A more complex system such as a full ERP can take two to four months. We always provide a clear timeline before we begin.', 'fr' => "Cela dépend de la portée. Un système de gestion de marché ou commercial prend généralement deux à six semaines. Un système plus complexe comme un ERP complet peut nécessiter deux à quatre mois. Nous fournissons toujours un calendrier précis avant de démarrer.", 'ar' => 'يعتمد على النطاق. يستغرق نظام إدارة السوق أو التجزئة عادةً من أسبوعين إلى ستة أسابيع. أما نظام أكثر تعقيداً كـERP الكامل فقد يتطلب من شهرين إلى أربعة أشهر. نقدم دائماً جدولاً زمنياً واضحاً قبل البدء.']],
            ['page_key' => 'home',
                'question' => ['en' => 'Can you build systems in Arabic?', 'fr' => 'Pouvez-vous développer des systèmes en arabe ?', 'ar' => 'هل يمكنكم بناء أنظمة باللغة العربية؟'],
                'answer'   => ['en' => 'Yes. All our systems support Arabic, French and English, including full right-to-left layouts for Arabic. We know that most of our clients work primarily in Arabic, so multilingual support — done properly — is a priority in every project we undertake.', 'fr' => "Oui. Tous nos systèmes prennent en charge l'arabe, le français et l'anglais, y compris les mises en page complètes de droite à gauche pour l'arabe. Nous savons que la plupart de nos clients travaillent principalement en arabe, c'est pourquoi le support multilingue — correctement réalisé — est une priorité dans chaque projet.", 'ar' => 'نعم. جميع أنظمتنا تدعم العربية والفرنسية والإنجليزية، بما في ذلك تخطيطات كاملة من اليمين إلى اليسار للعربية. ندرك أن معظم عملائنا يعملون أساساً باللغة العربية، لذا يُعدّ الدعم متعدد اللغات — المُنجز بشكل صحيح — أولوية في كل مشروع نتولاه.']],
        ];
        foreach ($faqsData as $i => $f) {
            Faq::create(['page_key' => $f['page_key'], 'question' => $f['question'], 'answer' => $f['answer'], 'order' => $i, 'is_active' => true]);
        }

        // ── Pages ──────────────────────────────────────────────────────────────
        // No image fields — safe to truncate
        Page::truncate();
        $pagesData = [
            ['slug' => 'about', 'title' => ['en' => 'About STH', 'fr' => 'À Propos de STH', 'ar' => 'عن STH'],
                'content' => [
                    'en' => "<p>System Technologie Hanana (STH) was founded in 2025 in N'Djamena, Chad, with one clear mission: to build any digital system a Chadian business or institution needs.</p><p>Whether it's a cargo management platform, a market system, a school management solution, a money transfer application, a government portal, a website or something entirely custom — STH builds it. We don't limit ourselves to predefined categories. If you can describe the problem, we can build the solution.</p><p>We are a focused team of four — a CEO, a Vice CEO, an Operations Manager and a General Secretary — supported by additional collaborators as needed. Each of us is committed to delivering systems that genuinely work for the people who use them.</p><p>In our first year, we have already delivered integrated systems for several businesses in N'Djamena across logistics, retail and market management. Our approach is guided by three principles: <strong>simplicity</strong> — systems must be usable by everyone, not only technical staff; <strong>reliability</strong> — they must work correctly every single day; and <strong>local fit</strong> — built in Arabic, French and English, adapted to the realities of business in Chad.</p><p>We believe Chad is at the start of a genuine digital transformation. STH is here to play its part in building that future — one system at a time.</p>",
                    'fr'  => "<p>System Technologie Hanana (STH) a été fondée en 2025 à N'Djamena, au Tchad, avec une mission précise : développer tout système numérique dont une entreprise ou une institution tchadienne a besoin.</p><p>Qu'il s'agisse d'une plateforme de gestion cargo, d'un système de marché, d'une solution de gestion scolaire, d'une application de transfert d'argent, d'un portail gouvernemental, d'un site web ou de quelque chose d'entièrement sur mesure — STH le développe. Nous ne nous enfermons pas dans des catégories prédéfinies. Si vous pouvez décrire le problème, nous pouvons construire la solution.</p><p>Nous sommes une équipe de quatre personnes — un Directeur Général, un Directeur Général Adjoint, un Responsable des Opérations et un Secrétaire Général — appuyée par des collaborateurs supplémentaires selon les besoins. Chacun d'entre nous s'engage à livrer des systèmes qui fonctionnent vraiment pour ceux qui les utilisent.</p><p>Dès notre première année, nous avons déjà livré des systèmes intégrés pour plusieurs entreprises à N'Djamena dans les domaines de la logistique, du commerce et de la gestion de marchés. Notre approche repose sur trois principes : <strong>la simplicité</strong>, <strong>la fiabilité</strong> et <strong>l'adaptation locale</strong> — développés en arabe, français et anglais.</p>",
                    'ar'  => "<p>تأسست شركة نظام تكنولوجيا حنانا (STH) عام 2025 في إنجامينا، تشاد، بمهمة محددة: بناء أي نظام رقمي تحتاجه شركة أو مؤسسة تشادية.</p><p>سواء كانت منصة إدارة شحن، أو نظام سوق، أو حل لإدارة المدارس، أو تطبيق لتحويل الأموال، أو بوابة حكومية، أو موقع إلكتروني، أو أي شيء مخصص تماماً — STH تبنيه. لا نقيّد أنفسنا بفئات محددة مسبقاً. إذا استطعت وصف المشكلة، نستطيع بناء الحل.</p><p>نحن فريق متماسك من أربعة أشخاص — مدير تنفيذي ونائب مدير تنفيذي ومدير عمليات وأمين عام — يدعمنا متعاونون إضافيون حسب الحاجة. كل واحد منا ملتزم بتسليم أنظمة تعمل بصدق للأشخاص الذين يستخدمونها.</p><p>في عامنا الأول، أنجزنا أنظمة متكاملة لعدة شركات في إنجامينا في مجالات اللوجستيات والتجزئة وإدارة الأسواق. يقوم نهجنا على ثلاثة مبادئ: <strong>البساطة</strong> — يجب أن تكون الأنظمة قابلة للاستخدام للجميع لا للموظفين التقنيين فحسب؛ و<strong>الموثوقية</strong> — يجب أن تعمل بشكل صحيح كل يوم؛ و<strong>الملاءمة المحلية</strong> — مبنية بالعربية والفرنسية والإنجليزية، ومكيّفة لواقع الأعمال في تشاد.</p>",
                ]],
            ['slug' => 'privacy', 'title' => ['en' => 'Privacy Policy', 'fr' => 'Politique de Confidentialité', 'ar' => 'سياسة الخصوصية'],
                'content' => [
                    'en' => '<h4>Privacy Policy</h4><p>STH is committed to protecting your personal data. This policy explains how we collect, use and protect information when you use our website and services.</p><h5>Information We Collect</h5><p>We collect information you provide directly through contact forms and project enquiries, as well as anonymised usage data to improve our website.</p><h5>How We Use Your Information</h5><p>Your information is used solely to respond to your enquiry and deliver the requested service. We never sell or share your data with third parties.</p><h5>Contact</h5><p>For any privacy-related questions, contact us at contact@sth-tchad.com</p>',
                    'fr'  => "<h4>Politique de Confidentialité</h4><p>STH s'engage à protéger vos données personnelles. Cette politique explique comment nous collectons, utilisons et protégeons les informations lorsque vous utilisez notre site et nos services.</p><h5>Informations collectées</h5><p>Nous collectons les informations que vous nous transmettez via les formulaires de contact et les demandes de projets, ainsi que des données d'utilisation anonymisées pour améliorer notre site.</p><h5>Utilisation de vos données</h5><p>Vos informations sont utilisées uniquement pour répondre à votre demande et fournir le service sollicité. Nous ne vendons ni ne partageons jamais vos données avec des tiers.</p><h5>Contact</h5><p>Pour toute question relative à la confidentialité, contactez-nous à contact@sth-tchad.com</p>",
                    'ar'  => "<h4>سياسة الخصوصية</h4><p>تلتزم STH بحماية بياناتك الشخصية. توضح هذه السياسة كيفية جمع المعلومات واستخدامها وحمايتها عند استخدامك موقعنا وخدماتنا.</p><h5>المعلومات التي نجمعها</h5><p>نجمع المعلومات التي تُزوِّدنا بها مباشرةً عبر نماذج التواصل وطلبات المشاريع، فضلاً عن بيانات استخدام مجهولة الهوية لتحسين موقعنا.</p><h5>كيف نستخدم معلوماتك</h5><p>تُستخدم معلوماتك فقط للردّ على استفساراتك وتقديم الخدمة المطلوبة. لا نبيع بياناتك ولا نشاركها مع أي طرف ثالث.</p><h5>التواصل</h5><p>لأي استفسارات تتعلق بالخصوصية، تواصل معنا على contact@sth-tchad.com</p>",
                ]],
            ['slug' => 'terms', 'title' => ['en' => 'Terms of Service', 'fr' => "Conditions d'Utilisation", 'ar' => 'شروط الخدمة'],
                'content' => [
                    'en' => "<h4>Terms of Service</h4><p>By using the STH website, you agree to these terms. Our services are provided as described in individual service agreements. STH reserves the right to modify its services with reasonable prior notice.</p>",
                    'fr' => "<h4>Conditions d'Utilisation</h4><p>En utilisant le site de STH, vous acceptez les présentes conditions. Nos services sont fournis conformément aux accords de service individuels. STH se réserve le droit de modifier ses services avec un préavis raisonnable.</p>",
                    'ar' => "<h4>شروط الخدمة</h4><p>باستخدام موقع STH، فإنك توافق على هذه الشروط. تُقدَّم خدماتنا وفقاً لاتفاقيات الخدمة الفردية. تحتفظ STH بحق تعديل خدماتها مع إشعار مسبق معقول.</p>",
                ]],
        ];
        foreach ($pagesData as $pd) {
            Page::create(['slug' => $pd['slug'], 'title' => $pd['title'], 'content' => $pd['content'], 'is_active' => true]);
        }

        // ── Sliders ────────────────────────────────────────────────────────────
        // Smart upsert by page_key + order — preserves uploaded image
        $sliderData = [
            ['page_key' => 'home',      'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(10,27,60,0.70)',
                'title'       => ['en' => 'Any System. Any Business. Built in Chad.',        'fr' => 'Tout Système. Toute Entreprise. Développé au Tchad.',   'ar' => 'أي نظام. أي مشروع. صُنع في تشاد.'],
                'subtitle'    => ['en' => 'ERP, market platforms, cargo systems, money transfer, mobile apps, websites, government systems — if you need it, STH builds it.', 'fr' => "ERP, plateformes de marché, systèmes cargo, transfert d'argent, applications mobiles, sites web, systèmes gouvernementaux — si vous en avez besoin, STH le développe.", 'ar' => 'ERP ومنصات الأسواق وأنظمة الشحن وتحويل الأموال وتطبيقات الهاتف والمواقع والأنظمة الحكومية — إذا كنت تحتاجه، STH تبنيه.'],
                'button_text' => ['en' => 'Explore Our Services', 'fr' => 'Nos Services', 'ar' => 'استكشف خدماتنا'], 'button_link' => '/services'],
            ['page_key' => 'home',      'order' => 1, 'text_align' => 'left',   'overlay' => 'rgba(10,27,60,0.65)',
                'title'       => ['en' => 'Trusted by Businesses in N\'Djamena',             'fr' => "Des Entreprises de N'Djaména Nous Font Confiance",       'ar' => 'موثوق به من شركات في إنجامينا'],
                'subtitle'    => ['en' => 'From logistics companies to market owners and retailers — we build systems that make daily operations simpler, faster and more accurate.', 'fr' => "Des entreprises de logistique aux propriétaires de marchés et commerçants — nous développons des systèmes qui rendent les opérations quotidiennes plus simples, plus rapides et plus précises.", 'ar' => 'من شركات اللوجستيات إلى أصحاب الأسواق والتجار — نبني أنظمة تجعل العمليات اليومية أبسط وأسرع وأدق.'],
                'button_text' => ['en' => 'See Our Work', 'fr' => 'Nos Réalisations', 'ar' => 'اطلع على أعمالنا'], 'button_link' => '/portfolio'],
            ['page_key' => 'home',      'order' => 2, 'text_align' => 'right',  'overlay' => 'rgba(10,27,60,0.70)',
                'title'       => ['en' => 'Arabic, French and English — Built for Chad',     'fr' => 'Arabe, Français et Anglais — Conçu pour le Tchad',     'ar' => 'عربي وفرنسي وإنجليزي — مصنوع لتشاد'],
                'subtitle'    => ['en' => 'Every system we build works fully in all three languages, with proper Arabic right-to-left support — because your team deserves tools that speak their language.', 'fr' => "Chaque système que nous développons fonctionne intégralement dans les trois langues, avec un support arabe de droite à gauche correct — parce que votre équipe mérite des outils qui parlent sa langue.", 'ar' => 'كل نظام نبنيه يعمل بالكامل بالعربية والفرنسية والإنجليزية مع دعم صحيح للكتابة من اليمين إلى اليسار — لأن فريقك يستحق أدوات تتحدث لغته.'],
                'button_text' => ['en' => 'Contact Us', 'fr' => 'Contactez-Nous', 'ar' => 'تواصل معنا'], 'button_link' => '/contact'],
            ['page_key' => 'about',     'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(10,27,60,0.70)',
                'title'       => ['en' => 'About System Technologie Hanana',                 'fr' => 'À Propos de System Technologie Hanana',               'ar' => 'عن نظام تكنولوجيا حنانا'],
                'subtitle'    => ['en' => "Founded in 2025 in N'Djamena — building technology that solves real problems for real businesses in Chad.", 'fr' => "Fondée en 2025 à N'Djamena — nous développons des technologies qui résolvent de vrais problèmes pour de vraies entreprises au Tchad.", 'ar' => 'تأسست عام 2025 في إنجامينا — نبني تكنولوجيا تحلّ مشاكل حقيقية لشركات حقيقية في تشاد.'],
                'button_text' => ['en' => 'Meet Our Team', 'fr' => 'Notre Équipe', 'ar' => 'تعرّف على فريقنا'], 'button_link' => '/about#team'],
            ['page_key' => 'services',  'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(10,27,60,0.70)',
                'title'       => ['en' => 'Our Services',                                    'fr' => 'Nos Services',                                        'ar' => 'خدماتنا'],
                'subtitle'    => ['en' => 'From market systems to ERP, fintech, mobile apps and custom platforms — any system your business needs, STH builds it.', 'fr' => "Des systèmes de marché à l'ERP, la fintech, les applications mobiles et les plateformes sur mesure — tout système dont votre entreprise a besoin, STH le développe.", 'ar' => 'من أنظمة الأسواق إلى ERP والتقنية المالية وتطبيقات الهاتف والمنصات المخصصة — أي نظام تحتاجه شركتك، STH تبنيه.'],
                'button_text' => ['en' => 'Request a Quote', 'fr' => 'Demander un Devis', 'ar' => 'اطلب عرض سعر'], 'button_link' => '/contact'],
            ['page_key' => 'portfolio', 'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(10,27,60,0.70)',
                'title'       => ['en' => 'Our Portfolio',                                   'fr' => 'Nos Réalisations',                                    'ar' => 'أعمالنا'],
                'subtitle'    => ['en' => 'Real systems. Real clients. Real results — delivered in N\'Djamena.', 'fr' => "De vrais systèmes. De vrais clients. De vrais résultats — livrés à N'Djaména.", 'ar' => 'أنظمة حقيقية. عملاء حقيقيون. نتائج حقيقية — مُسلَّمة في إنجامينا.'],
                'button_text' => ['en' => '', 'fr' => '', 'ar' => ''], 'button_link' => ''],
            ['page_key' => 'contact',   'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(10,27,60,0.70)',
                'title'       => ['en' => 'Get In Touch',                                    'fr' => 'Contactez-Nous',                                      'ar' => 'تواصل معنا'],
                'subtitle'    => ['en' => 'Tell us about your project and we will get back to you promptly.', 'fr' => 'Parlez-nous de votre projet, nous vous répondrons rapidement.', 'ar' => 'أخبرنا عن مشروعك وسنعود إليك في أقرب وقت.'],
                'button_text' => ['en' => '', 'fr' => '', 'ar' => ''], 'button_link' => ''],
            ['page_key' => 'blog',      'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(10,27,60,0.70)',
                'title'       => ['en' => 'STH Blog & Insights',                             'fr' => 'Blog et Actualités STH',                              'ar' => 'مدونة وأفكار STH'],
                'subtitle'    => ['en' => 'Technology, digital transformation and business insights for Chad and Central Africa.', 'fr' => "Technologie, transformation numérique et actualités business pour le Tchad et l'Afrique centrale.", 'ar' => 'تكنولوجيا وتحول رقمي ورؤى أعمال لتشاد وأفريقيا الوسطى.'],
                'button_text' => ['en' => '', 'fr' => '', 'ar' => ''], 'button_link' => ''],
        ];
        foreach ($sliderData as $sd) {
            $existing = Slider::where('page_key', $sd['page_key'])->where('order', $sd['order'])->first();
            if ($existing) {
                $existing->title         = $sd['title'];
                $existing->subtitle      = $sd['subtitle'];
                $existing->button_text   = $sd['button_text'];
                $existing->button_link   = $sd['button_link'];
                $existing->text_align    = $sd['text_align'];
                $existing->overlay_color = $sd['overlay'];
                $existing->is_active     = true;
                $existing->save();  // image left untouched
            } else {
                Slider::create(['page_key' => $sd['page_key'], 'title' => $sd['title'], 'subtitle' => $sd['subtitle'], 'button_text' => $sd['button_text'], 'button_link' => $sd['button_link'], 'text_align' => $sd['text_align'], 'order' => $sd['order'], 'is_active' => true, 'overlay_color' => $sd['overlay'], 'image' => null]);
            }
        }

        echo "STH database seeded successfully!\n";
    }
}
