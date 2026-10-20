<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Setting,Product,Operation,TeamMember,Testimonial,Stat,BlogPost,Faq,Page,Slider};

class UrazSeeder extends Seeder {
    public function run(): void {

        // ── Settings ─────────────────────────────────────────────────────────
        $settings = [
            ['key' => 'site_name',    'value' => 'Uraz Mining & Trading LTD', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => "Connecting Africa's Minerals to Global Markets.", 'group' => 'general'],
            ['key' => 'site_email',   'value' => 'info@urazminingtrading.com', 'group' => 'general'],
            ['key' => 'site_phone',   'value' => '', 'group' => 'general'],
            ['key' => 'site_phone2',  'value' => '', 'group' => 'general'],
            ['key' => 'site_address', 'value' => '', 'group' => 'general'],
            ['key' => 'site_city',    'value' => '', 'group' => 'general'],
            ['key' => 'site_country', 'value' => '', 'group' => 'general'],
            ['key' => 'facebook',     'value' => '', 'group' => 'social'],
            ['key' => 'linkedin',     'value' => '', 'group' => 'social'],
            ['key' => 'twitter',      'value' => '', 'group' => 'social'],
            ['key' => 'instagram',    'value' => '', 'group' => 'social'],
            ['key' => 'about_short', 'value' => [
                'en' => 'Uraz Mining & Trading LTD sources, certifies and exports Antimony, Gold, Petroleum, Copper, Tungsten and Charcoal from across Africa to buyers worldwide — connecting producers, logistics partners and international markets through reliable, transparent trade.',
                'fr' => "Uraz Mining & Trading LTD source, certifie et exporte l'Antimoine, l'Or, le Pétrole, le Cuivre, le Tungstène et le Charbon de Bois depuis l'Afrique vers des acheteurs du monde entier — reliant producteurs, partenaires logistiques et marchés internationaux grâce à un commerce fiable et transparent.",
                'ar' => 'توفر شركة أوراز للتعدين والتجارة المحدودة وتصادق وتصدّر الأنتيمون والذهب والنفط والنحاس والتنغستن والفحم الخشبي من أفريقيا إلى مشترين حول العالم — لتربط المنتجين وشركاء اللوجستيات والأسواق الدولية من خلال تجارة موثوقة وشفافة.',
                'tr' => 'Uraz Mining & Trading LTD, Afrika genelinden Antimon, Altın, Petrol, Bakır, Tungsten ve Odun Kömürünü tedarik eder, sertifikalandırır ve dünya çapındaki alıcılara ihraç eder — üreticileri, lojistik ortaklarını ve uluslararası pazarları güvenilir ve şeffaf ticaretle birbirine bağlar.',
                'zh' => 'Uraz Mining & Trading LTD 在非洲各地采购、认证并出口锑、黄金、石油、铜、钨和木炭，销往全球买家 —— 通过可靠、透明的贸易将生产商、物流伙伴与国际市场连接起来。',
            ], 'group' => 'general'],
            // Theme defaults — earth/gold/charcoal palette (kept in sync with layouts/*.blade.php hardcoded fallbacks)
            ['key' => 'public_bg',         'value' => '#1A140F', 'group' => 'appearance'],
            ['key' => 'public_primary',    'value' => '#C9A227', 'group' => 'appearance'],
            ['key' => 'public_accent',     'value' => '#B56A3C', 'group' => 'appearance'],
            ['key' => 'admin_bg',          'value' => '#15120F', 'group' => 'appearance'],
            ['key' => 'admin_surface_bg',  'value' => '#201B16', 'group' => 'appearance'],
            ['key' => 'admin_primary',     'value' => '#C9A227', 'group' => 'appearance'],
        ];
        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], ['value' => $s['value'], 'group' => $s['group']]);
        }

        // ── Products ─────────────────────────────────────────────────────────
        $productsData = [
            [
                'slug' => 'antimony', 'icon' => 'fas fa-flask', 'category' => 'Metals',
                'name'  => ['en' => 'Antimony', 'fr' => 'Antimoine', 'ar' => 'الأنتيمون', 'tr' => 'Antimon', 'zh' => '锑'],
                'short' => [
                    'en' => 'High-grade antimony ore and concentrate for flame retardants, batteries and alloys.',
                    'fr' => "Minerai et concentré d'antimoine de haute qualité pour retardateurs de flamme, batteries et alliages.",
                    'ar' => 'خام ومركّز أنتيمون عالي الجودة لمثبطات اللهب والبطاريات والسبائك.',
                    'tr' => 'Alev geciktiriciler, piller ve alaşımlar için yüksek kaliteli antimon cevheri ve konsantresi.',
                    'zh' => '用于阻燃剂、电池和合金的高品位锑矿石及精矿。',
                ],
                'desc' => [
                    'en' => "We supply antimony ore, concentrate and ingot sourced from vetted African producers. Every shipment is independently assayed and accompanied by full certification, serving industries from flame retardants to lead-acid batteries and specialty alloys.",
                    'fr' => "Nous fournissons du minerai, du concentré et des lingots d'antimoine provenant de producteurs africains sélectionnés. Chaque expédition fait l'objet d'une analyse indépendante et d'une certification complète, au service des industries des retardateurs de flamme, des batteries au plomb-acide et des alliages spéciaux.",
                    'ar' => 'نورّد خام ومركّز وسبائك الأنتيمون من منتجين أفريقيين موثوقين. تخضع كل شحنة لتحليل مستقل مستقل ومرفقة بشهادات كاملة، لخدمة صناعات مثبطات اللهب وبطاريات الرصاص الحمضية والسبائك المتخصصة.',
                    'tr' => 'Denetlenmiş Afrikalı üreticilerden temin edilen antimon cevheri, konsantresi ve külçesi tedarik ediyoruz. Her sevkiyat bağımsız olarak analiz edilir ve eksiksiz sertifikalandırılır; alev geciktiricilerden kurşun-asit pillere ve özel alaşımlara kadar çeşitli sektörlere hizmet verir.',
                    'zh' => '我们从经过审核的非洲生产商处供应锑矿石、精矿和锭。每批货物均经过独立化验并配备完整认证，服务于阻燃剂、铅酸电池和特种合金等行业。',
                ],
                'features' => [
                    'en' => 'Purity up to 99.65% Sb|Available as ore, concentrate or ingot|Independent lab-certified assay reports|Flexible bulk packaging|Full export documentation',
                    'fr' => "Pureté jusqu'à 99,65% Sb|Disponible en minerai, concentré ou lingot|Rapports d'analyse certifiés par laboratoire indépendant|Emballage en vrac flexible|Documentation d'exportation complète",
                    'ar' => 'نقاء يصل إلى 99.65% أنتيمون|متوفر كخام أو مركّز أو سبيكة|تقارير تحليل معتمدة من مختبر مستقل|تعبئة بالجملة مرنة|وثائق تصدير كاملة',
                    'tr' => '%99,65 Sb\'ye kadar saflık|Cevher, konsantre veya külçe olarak mevcut|Bağımsız laboratuvar sertifikalı analiz raporları|Esnek toplu ambalaj|Eksiksiz ihracat belgeleri',
                    'zh' => '纯度高达99.65% Sb|提供矿石、精矿或锭等形式|独立实验室认证化验报告|灵活的大宗包装|完整的出口文件',
                ],
            ],
            [
                'slug' => 'gold', 'icon' => 'fas fa-coins', 'category' => 'Metals',
                'name'  => ['en' => 'Gold', 'fr' => 'Or', 'ar' => 'الذهب', 'tr' => 'Altın', 'zh' => '黄金'],
                'short' => [
                    'en' => 'Responsibly sourced gold bullion and bars, certified and ready for export.',
                    'fr' => 'Or en lingots et barres sourcé de manière responsable, certifié et prêt à l\'exportation.',
                    'ar' => 'سبائك وقضبان ذهب مصدرها مسؤول، معتمدة وجاهزة للتصدير.',
                    'tr' => 'Sorumlu kaynaklardan temin edilmiş, sertifikalı ve ihracata hazır altın külçe ve barları.',
                    'zh' => '来源负责任、经认证并可随时出口的金条与金块。',
                ],
                'desc' => [
                    'en' => "Uraz sources gold bullion and bars through a vetted chain of custody, from responsible producers across Africa. Each lot is independently assayed, fully documented and handled under secure, insured logistics from mine to port.",
                    'fr' => "Uraz source l'or en lingots et barres via une chaîne de traçabilité vérifiée, auprès de producteurs responsables à travers l'Afrique. Chaque lot est analysé de manière indépendante, entièrement documenté et transporté via une logistique sécurisée et assurée, de la mine au port.",
                    'ar' => 'تورّد أوراز سبائك وقضبان الذهب عبر سلسلة توثيق موثوقة من منتجين مسؤولين في أفريقيا. تخضع كل دفعة لتحليل مستقل وتوثيق كامل ونقل مؤمَّن وآمن من المنجم إلى الميناء.',
                    'tr' => 'Uraz, Afrika genelindeki sorumlu üreticilerden denetlenmiş bir gözetim zinciri yoluyla altın külçe ve bar tedarik eder. Her parti bağımsız olarak analiz edilir, tam olarak belgelenir ve madenden limana kadar güvenli, sigortalı lojistikle taşınır.',
                    'zh' => 'Uraz 通过经审核的监管链，从非洲各地负责任的生产商处采购金条与金块。每批货物均经过独立化验、完整记录，并从矿山到港口采用安全有保险的物流运输。',
                ],
                'features' => [
                    'en' => '99.9% fine gold (24K) available|Supplied as bars, ingots or bullion|Full chain-of-custody documentation|Independent assay certification|Secure, insured logistics',
                    'fr' => "Or fin 99,9% (24K) disponible|Fourni en barres, lingots ou bullion|Documentation complète de la chaîne de traçabilité|Certification d'analyse indépendante|Logistique sécurisée et assurée",
                    'ar' => 'ذهب نقي 99.9% (24 قيراط) متوفر|يُورَّد كقضبان أو سبائك أو كتل|وثائق سلسلة توثيق كاملة|شهادة تحليل مستقلة|لوجستيات آمنة ومؤمَّنة',
                    'tr' => '%99,9 saf altın (24K) mevcut|Bar, külçe veya bullion olarak tedarik edilir|Eksiksiz gözetim zinciri belgeleri|Bağımsız analiz sertifikası|Güvenli, sigortalı lojistik',
                    'zh' => '提供99.9%纯金（24K）|以金条、金锭或金块形式供应|完整的监管链文件|独立化验认证|安全有保险的物流',
                ],
            ],
            [
                'slug' => 'petroleum', 'icon' => 'fas fa-oil-can', 'category' => 'Energy',
                'name'  => ['en' => 'Petroleum', 'fr' => 'Pétrole', 'ar' => 'النفط', 'tr' => 'Petrol', 'zh' => '石油'],
                'short' => [
                    'en' => 'Crude oil and refined petroleum products sourced from established African fields.',
                    'fr' => 'Pétrole brut et produits pétroliers raffinés provenant de champs africains établis.',
                    'ar' => 'نفط خام ومنتجات نفطية مكرَّرة من حقول أفريقية قائمة.',
                    'tr' => 'Köklü Afrika sahalarından temin edilen ham petrol ve rafine petrol ürünleri.',
                    'zh' => '来自成熟非洲油田的原油及精炼石油产品。',
                ],
                'desc' => [
                    'en' => "We trade crude oil and refined petroleum products, working with established African producers and certified terminals. Our team coordinates assay, documentation and loading schedules to ensure smooth, compliant transactions for buyers worldwide.",
                    'fr' => "Nous négocions le pétrole brut et les produits pétroliers raffinés, en collaboration avec des producteurs africains établis et des terminaux certifiés. Notre équipe coordonne l'analyse, la documentation et les calendriers de chargement pour garantir des transactions fluides et conformes.",
                    'ar' => 'نتاجر في النفط الخام والمنتجات النفطية المكرَّرة، بالتعاون مع منتجين أفريقيين قائمين ومحطات معتمدة. ينسّق فريقنا التحليل والتوثيق وجداول التحميل لضمان معاملات سلسة ومتوافقة للمشترين حول العالم.',
                    'tr' => 'Köklü Afrikalı üreticiler ve sertifikalı terminallerle çalışarak ham petrol ve rafine petrol ürünleri ticareti yapıyoruz. Ekibimiz, dünya çapındaki alıcılar için sorunsuz ve uyumlu işlemler sağlamak amacıyla analiz, belgelendirme ve yükleme programlarını koordine eder.',
                    'zh' => '我们与成熟的非洲生产商及认证码头合作，进行原油和精炼石油产品贸易。我们的团队统筹化验、文件和装船计划，确保与全球买家的交易顺畅合规。',
                ],
                'features' => [
                    'en' => 'Crude and refined grades available|Full laboratory assay on request|Flexible shipment volumes|Comprehensive export documentation|Reliable loading schedules',
                    'fr' => "Qualités brutes et raffinées disponibles|Analyse complète en laboratoire sur demande|Volumes d'expédition flexibles|Documentation d'exportation complète|Calendriers de chargement fiables",
                    'ar' => 'درجات خام ومكرَّرة متوفرة|تحليل مخبري كامل عند الطلب|أحجام شحن مرنة|وثائق تصدير شاملة|جداول تحميل موثوقة',
                    'tr' => 'Ham ve rafine kaliteler mevcut|İstek üzerine tam laboratuvar analizi|Esnek sevkiyat hacimleri|Kapsamlı ihracat belgeleri|Güvenilir yükleme programları',
                    'zh' => '提供原油及精炼等级|可应要求提供全面实验室化验|灵活的装运量|全面的出口文件|可靠的装船计划',
                ],
            ],
            [
                'slug' => 'copper', 'icon' => 'fas fa-bolt', 'category' => 'Metals',
                'name'  => ['en' => 'Copper', 'fr' => 'Cuivre', 'ar' => 'النحاس', 'tr' => 'Bakır', 'zh' => '铜'],
                'short' => [
                    'en' => 'High-purity copper cathodes, concentrate and ore for industrial and electrical use.',
                    'fr' => 'Cathodes, concentré et minerai de cuivre de haute pureté pour usage industriel et électrique.',
                    'ar' => 'كاثودات ومركّز وخام نحاس عالي النقاء للاستخدام الصناعي والكهربائي.',
                    'tr' => 'Endüstriyel ve elektrik kullanımı için yüksek saflıkta bakır katotları, konsantresi ve cevheri.',
                    'zh' => '用于工业和电气用途的高纯度铜阴极板、精矿及矿石。',
                ],
                'desc' => [
                    'en' => "Our copper supply spans ore, concentrate and LME-grade cathodes, sourced from established African mining regions. We provide certified lab analysis and consistent supply volumes for electrical, industrial and construction buyers.",
                    'fr' => "Notre approvisionnement en cuivre couvre le minerai, le concentré et les cathodes de qualité LME, provenant de régions minières africaines établies. Nous fournissons une analyse de laboratoire certifiée et des volumes d'approvisionnement constants pour les acheteurs des secteurs électrique, industriel et de la construction.",
                    'ar' => 'يشمل توريدنا للنحاس الخام والمركّز وكاثودات بجودة LME، من مناطق تعدين أفريقية قائمة. نوفر تحليلاً مخبرياً معتمداً وأحجام توريد ثابتة للمشترين في القطاعات الكهربائية والصناعية والإنشائية.',
                    'tr' => 'Bakır tedarikimiz, köklü Afrika maden bölgelerinden temin edilen cevher, konsantre ve LME kalitesinde katotları kapsar. Elektrik, endüstri ve inşaat alıcıları için sertifikalı laboratuvar analizi ve tutarlı tedarik hacimleri sağlıyoruz.',
                    'zh' => '我们的铜供应涵盖矿石、精矿及LME级阴极板，来源于成熟的非洲矿区。我们为电气、工业及建筑类买家提供认证实验室分析和稳定的供应量。',
                ],
                'features' => [
                    'en' => 'Cathodes up to 99.99% Cu|Also available as concentrate and ore|LME-grade quality standards|Certified lab analysis|Consistent supply volumes',
                    'fr' => "Cathodes jusqu'à 99,99% Cu|Également disponible en concentré et minerai|Normes de qualité LME|Analyse de laboratoire certifiée|Volumes d'approvisionnement constants",
                    'ar' => 'كاثودات تصل إلى 99.99% نحاس|متوفر أيضاً كمركّز وخام|معايير جودة بمستوى LME|تحليل مخبري معتمد|أحجام توريد ثابتة',
                    'tr' => "%99,99 Cu'ya kadar katotlar|Konsantre ve cevher olarak da mevcut|LME kalite standartları|Sertifikalı laboratuvar analizi|Tutarlı tedarik hacimleri",
                    'zh' => '阴极板纯度高达99.99%铜|亦提供精矿及矿石形式|符合LME质量标准|认证实验室分析|稳定的供应量',
                ],
            ],
            [
                'slug' => 'tungsten', 'icon' => 'fas fa-industry', 'category' => 'Metals',
                'name'  => ['en' => 'Tungsten', 'fr' => 'Tungstène', 'ar' => 'التنغستن', 'tr' => 'Tungsten', 'zh' => '钨'],
                'short' => [
                    'en' => 'Tungsten ore and concentrate for industrial, defense and electronics applications.',
                    'fr' => "Minerai et concentré de tungstène pour applications industrielles, de défense et électroniques.",
                    'ar' => 'خام ومركّز تنغستن للتطبيقات الصناعية والدفاعية والإلكترونية.',
                    'tr' => 'Endüstriyel, savunma ve elektronik uygulamalar için tungsten cevheri ve konsantresi.',
                    'zh' => '适用于工业、国防和电子应用的钨矿石及精矿。',
                ],
                'desc' => [
                    'en' => "We supply tungsten ore and concentrate from vetted African sources, serving the tooling, electronics and defense-related supply chains. Every lot is assayed for WO3 content and shipped with complete compliance documentation.",
                    'fr' => "Nous fournissons du minerai et du concentré de tungstène provenant de sources africaines vérifiées, au service des chaînes d'approvisionnement de l'outillage, de l'électronique et de la défense. Chaque lot est analysé pour sa teneur en WO3 et expédié avec une documentation de conformité complète.",
                    'ar' => 'نورّد خام ومركّز التنغستن من مصادر أفريقية موثوقة، لخدمة سلاسل توريد الأدوات والإلكترونيات والقطاعات المرتبطة بالدفاع. تخضع كل دفعة لتحليل محتوى WO3 وتُشحن مع وثائق امتثال كاملة.',
                    'tr' => 'Takım, elektronik ve savunmayla ilgili tedarik zincirlerine hizmet vermek üzere denetlenmiş Afrika kaynaklarından tungsten cevheri ve konsantresi tedarik ediyoruz. Her parti WO3 içeriği için analiz edilir ve eksiksiz uyumluluk belgeleriyle sevk edilir.',
                    'zh' => '我们从经过审核的非洲来源供应钨矿石及精矿，服务于工具、电子及国防相关供应链。每批货物均经过WO3含量化验，并随附完整的合规文件。',
                ],
                'features' => [
                    'en' => 'High WO3 concentrate grades|Available as ore and concentrate|Certified assay documentation|Scalable supply contracts|Reliable export logistics',
                    'fr' => "Teneurs élevées en concentré WO3|Disponible en minerai et concentré|Documentation d'analyse certifiée|Contrats d'approvisionnement évolutifs|Logistique d'exportation fiable",
                    'ar' => 'درجات مركّز WO3 عالية|متوفر كخام ومركّز|وثائق تحليل معتمدة|عقود توريد قابلة للتوسع|لوجستيات تصدير موثوقة',
                    'tr' => 'Yüksek WO3 konsantre dereceleri|Cevher ve konsantre olarak mevcut|Sertifikalı analiz belgeleri|Ölçeklenebilir tedarik sözleşmeleri|Güvenilir ihracat lojistiği',
                    'zh' => '高WO3精矿品级|提供矿石及精矿形式|认证化验文件|可扩展的供应合同|可靠的出口物流',
                ],
            ],
            [
                'slug' => 'charcoal', 'icon' => 'fas fa-fire', 'category' => 'Energy',
                'name'  => ['en' => 'Charcoal', 'fr' => 'Charbon de Bois', 'ar' => 'الفحم الخشبي', 'tr' => 'Odun Kömürü', 'zh' => '木炭'],
                'short' => [
                    'en' => 'High-quality lump and briquette charcoal sourced from sustainably managed African wood resources.',
                    'fr' => "Charbon de bois en morceaux et briquettes de haute qualité provenant de ressources forestières africaines gérées de manière durable.",
                    'ar' => 'فحم خشبي كتلي وبريكيت عالي الجودة من موارد خشبية أفريقية تُدار بشكل مستدام.',
                    'tr' => 'Sürdürülebilir şekilde yönetilen Afrika ahşap kaynaklarından temin edilen yüksek kaliteli parça ve briket odun kömürü.',
                    'zh' => '来自可持续管理的非洲木材资源的优质块状和压块木炭。',
                ],
                'desc' => [
                    'en' => "We supply lump charcoal and briquettes sourced from sustainably managed forests and agricultural by-products across Africa. Each batch meets moisture and calorific value specifications, with full export documentation for industrial, residential and barbecue markets worldwide.",
                    'fr' => "Nous fournissons du charbon de bois en morceaux et des briquettes provenant de forêts gérées de manière durable et de sous-produits agricoles à travers l'Afrique. Chaque lot respecte les spécifications d'humidité et de valeur calorifique, avec une documentation d'exportation complète pour les marchés industriels, résidentiels et de barbecue dans le monde entier.",
                    'ar' => 'نورّد الفحم الخشبي الكتلي والبريكيت المصنّع من غابات تُدار بشكل مستدام ومن المخلفات الزراعية في أفريقيا. تلتزم كل دفعة بمواصفات الرطوبة والقيمة الحرارية، مع وثائق تصدير كاملة للأسواق الصناعية والمنزلية وأسواق الشواء حول العالم.',
                    'tr' => 'Afrika genelinde sürdürülebilir şekilde yönetilen ormanlardan ve tarımsal yan ürünlerden temin edilen parça odun kömürü ve briket tedarik ediyoruz. Her parti nem ve kalori değeri spesifikasyonlarını karşılar; dünya çapındaki endüstriyel, konut ve barbekü pazarları için eksiksiz ihracat belgeleriyle sunulur.',
                    'zh' => '我们供应来自非洲可持续管理森林及农业副产品的块状木炭和压块木炭。每批货物均符合水分和热值规格，并配备完整的出口文件，服务于全球工业、民用及烧烤市场。',
                ],
                'features' => [
                    'en' => 'Low moisture content and high calorific value|Available as lump charcoal or briquettes|Sourced from sustainably managed wood|Consistent sizing and packaging|Full export documentation',
                    'fr' => "Faible teneur en humidité et haute valeur calorifique|Disponible en morceaux ou en briquettes|Provenant de bois géré de manière durable|Calibrage et emballage constants|Documentation d'exportation complète",
                    'ar' => 'محتوى رطوبة منخفض وقيمة حرارية عالية|متوفر كفحم كتلي أو بريكيت|مصدره أخشاب تُدار بشكل مستدام|تحجيم وتعبئة ثابتة|وثائق تصدير كاملة',
                    'tr' => 'Düşük nem içeriği ve yüksek kalori değeri|Parça kömür veya briket olarak mevcut|Sürdürülebilir şekilde yönetilen ahşaptan temin edilir|Tutarlı boyutlandırma ve ambalaj|Eksiksiz ihracat belgeleri',
                    'zh' => '水分含量低、热值高|提供块状或压块形式|来源于可持续管理的木材|尺寸与包装规格统一|完整的出口文件',
                ],
            ],
        ];

        foreach ($productsData as $i => $pd) {
            Product::updateOrCreate(['slug' => $pd['slug']], [
                'order'             => $i,
                'icon'              => $pd['icon'],
                'category'          => $pd['category'],
                'is_active'         => true,
                'show_in_nav'       => true,
                'name'              => $pd['name'],
                'description'       => $pd['desc'],
                'short_description' => $pd['short'],
                'features'          => $pd['features'],
            ]);
        }

        // ── Operations ───────────────────────────────────────────────────────
        $operationsData = [
            [
                'category' => 'sourcing', 'tags' => 'Artisanal & Industrial Mines, Field Assay, Quality Vetting', 'since' => '2021-01-01', 'featured' => true,
                'title' => ['en' => 'West & Central Africa Sourcing Network', 'fr' => "Réseau de Sourcing en Afrique de l'Ouest et Centrale", 'ar' => 'شبكة التوريد في غرب ووسط أفريقيا', 'tr' => 'Batı ve Orta Afrika Tedarik Ağı', 'zh' => '西非与中非采购网络'],
                'location' => ['en' => 'West & Central Africa', 'fr' => "Afrique de l'Ouest et Centrale", 'ar' => 'غرب ووسط أفريقيا', 'tr' => 'Batı ve Orta Afrika', 'zh' => '西非与中非'],
                'desc' => [
                    'en' => "Our sourcing team works directly with vetted mining operations across West and Central Africa, covering Antimony, Gold, Copper and Tungsten. Every source undergoes field assay and quality vetting before being added to our supply network.",
                    'fr' => "Notre équipe de sourcing travaille directement avec des exploitations minières vérifiées à travers l'Afrique de l'Ouest et Centrale, couvrant l'Antimoine, l'Or, le Cuivre et le Tungstène. Chaque source fait l'objet d'une analyse de terrain et d'une vérification qualité avant d'intégrer notre réseau d'approvisionnement.",
                    'ar' => 'يعمل فريق التوريد لدينا مباشرة مع عمليات تعدين موثوقة في غرب ووسط أفريقيا، تشمل الأنتيمون والذهب والنحاس والتنغستن. يخضع كل مصدر لتحليل ميداني وفحص جودة قبل إضافته إلى شبكة التوريد لدينا.',
                    'tr' => 'Tedarik ekibimiz, Antimon, Altın, Bakır ve Tungsteni kapsayan Batı ve Orta Afrika genelindeki denetlenmiş madencilik operasyonlarıyla doğrudan çalışır. Her kaynak, tedarik ağımıza eklenmeden önce saha analizi ve kalite denetiminden geçer.',
                    'zh' => '我们的采购团队直接与西非和中非经过审核的采矿作业合作，涵盖锑、黄金、铜和钨。每个来源在加入我们的供应网络之前都要经过现场化验和质量审核。',
                ],
            ],
            [
                'category' => 'logistics', 'tags' => 'Rail, Road Haulage, Bonded Warehousing', 'since' => '2022-03-01', 'featured' => true,
                'title' => ['en' => 'Inland Logistics & Transport Corridor', 'fr' => 'Corridor Logistique et de Transport Terrestre', 'ar' => 'ممر النقل واللوجستيات الداخلية', 'tr' => 'Kara İçi Lojistik ve Taşıma Koridoru', 'zh' => '内陆物流与运输走廊'],
                'location' => ['en' => 'Regional Transport Corridor', 'fr' => 'Corridor de Transport Régional', 'ar' => 'ممر النقل الإقليمي', 'tr' => 'Bölgesel Taşıma Koridoru', 'zh' => '区域运输走廊'],
                'desc' => [
                    'en' => "We coordinate inland transport from mine sites to port via rail and road haulage, with bonded warehousing available along the route. This network keeps shipments moving reliably and on schedule across long overland distances.",
                    'fr' => "Nous coordonnons le transport terrestre des sites miniers vers le port par rail et par route, avec des entrepôts sous douane disponibles le long du trajet. Ce réseau assure un acheminement fiable et ponctuel des expéditions sur de longues distances terrestres.",
                    'ar' => 'ننسّق النقل الداخلي من مواقع التعدين إلى الميناء عبر السكك الحديدية والطرق البرية، مع توفر مستودعات جمركية على طول الطريق. تضمن هذه الشبكة تحرك الشحنات بموثوقية وفي الوقت المحدد عبر مسافات برية طويلة.',
                    'tr' => 'Maden sahalarından limana demiryolu ve karayolu taşımacılığıyla iç nakliyeyi koordine ediyoruz; rota boyunca gümrüklü antrepo hizmeti de mevcuttur. Bu ağ, sevkiyatların uzun kara mesafelerinde güvenilir ve zamanında ilerlemesini sağlar.',
                    'zh' => '我们通过铁路和公路运输协调从矿site到港口的内陆运输，沿途提供保税仓储服务。该网络确保货物在长途陆路运输中可靠、按时地运转。',
                ],
            ],
            [
                'category' => 'export', 'tags' => 'Bulk Carriers, Container Freight, Customs Clearance', 'since' => '2021-06-01', 'featured' => true,
                'title' => ['en' => 'Export Hub — Bulk Mineral Shipping', 'fr' => "Hub d'Exportation — Expédition de Minéraux en Vrac", 'ar' => 'مركز التصدير — شحن المعادن بالجملة', 'tr' => 'İhracat Merkezi — Toplu Maden Nakliyesi', 'zh' => '出口枢纽——大宗矿产运输'],
                'location' => ['en' => 'Major African Export Port', 'fr' => "Port d'Exportation Majeur en Afrique", 'ar' => 'ميناء تصدير أفريقي رئيسي', 'tr' => 'Büyük Afrika İhracat Limanı', 'zh' => '非洲主要出口港'],
                'desc' => [
                    'en' => "Our export operations handle bulk carrier and container freight bookings, customs clearance and shipping documentation for all six of our traded commodities, ensuring smooth handoff to buyers' designated carriers worldwide.",
                    'fr' => "Nos opérations d'exportation gèrent les réservations de fret en vrac et en conteneurs, le dédouanement et la documentation d'expédition pour l'ensemble de nos six matières premières, garantissant une transmission fluide aux transporteurs désignés par les acheteurs.",
                    'ar' => 'تتولى عمليات التصدير لدينا حجوزات الشحن بالجملة والحاويات والتخليص الجمركي ووثائق الشحن لجميع السلع الست التي نتاجر بها، لضمان تسليم سلس لناقلي المشترين المعينين حول العالم.',
                    'tr' => 'İhracat operasyonlarımız, ticaretini yaptığımız altı emtianın tümü için toplu taşıyıcı ve konteyner navlun rezervasyonlarını, gümrük işlemlerini ve sevkiyat belgelerini yönetir; alıcıların belirlediği taşıyıcılara dünya çapında sorunsuz teslimat sağlar.',
                    'zh' => '我们的出口业务负责为我们交易的全部六种商品办理散货船及集装箱货运预订、海关清关和装运文件，确保顺利交接给全球买家指定的承运人。',
                ],
            ],
            [
                'category' => 'warehousing', 'tags' => 'Climate-Controlled Storage, Blending, Inventory Management', 'since' => '2022-09-01', 'featured' => false,
                'title' => ['en' => 'Certified Storage & Blending Facility', 'fr' => 'Installation de Stockage et de Mélange Certifiée', 'ar' => 'منشأة تخزين وخلط معتمدة', 'tr' => 'Sertifikalı Depolama ve Harmanlama Tesisi', 'zh' => '认证仓储与混配设施'],
                'location' => ['en' => 'Regional Storage Hub', 'fr' => 'Hub de Stockage Régional', 'ar' => 'مركز تخزين إقليمي', 'tr' => 'Bölgesel Depolama Merkezi', 'zh' => '区域仓储中心'],
                'desc' => [
                    'en' => "Our storage facility provides climate-controlled warehousing, blending and inventory management for ore, concentrate and bullion awaiting export. Stock levels and quality are monitored continuously to keep every order ready on time.",
                    'fr' => "Notre installation de stockage offre un entreposage à climat contrôlé, un mélange et une gestion des stocks pour le minerai, le concentré et les lingots en attente d'exportation. Les niveaux de stock et la qualité sont surveillés en continu.",
                    'ar' => 'توفر منشأة التخزين لدينا تخزيناً مناخياً متحكماً فيه وخلطاً وإدارة مخزون للخام والمركّز والسبائك في انتظار التصدير. تُراقب مستويات المخزون والجودة باستمرار لضمان جاهزية كل طلب في الوقت المحدد.',
                    'tr' => 'Depolama tesisimiz, ihracatı beklerken cevher, konsantre ve bullion için iklim kontrollü depolama, harmanlama ve envanter yönetimi sunar. Stok seviyeleri ve kalite, her siparişin zamanında hazır olmasını sağlamak için sürekli izlenir.',
                    'zh' => '我们的仓储设施为等待出口的矿石、精矿和金条提供恒温仓储、混配和库存管理服务。库存水平和质量均持续监控，确保每笔订单按时备妥。',
                ],
            ],
        ];

        foreach ($operationsData as $i => $od) {
            $existing = Operation::where('order', $i)->first();
            $payload = [
                'order' => $i, 'category' => $od['category'], 'tags' => $od['tags'],
                'active_since' => $od['since'], 'is_featured' => $od['featured'], 'is_active' => true,
                'title' => $od['title'], 'description' => $od['desc'], 'location' => $od['location'],
            ];
            if ($existing) {
                $existing->fill($payload);
                $existing->save(); // image left untouched
            } else {
                Operation::create($payload + ['image' => null]);
            }
        }
        Operation::where('order', '>=', count($operationsData))->delete();

        // ── Stats ────────────────────────────────────────────────────────────
        Stat::truncate();
        $statsData = [
            ['icon' => 'fas fa-gem',        'value' => '6',    'label' => ['en' => 'Commodities Traded',   'fr' => 'Matières Premières Négociées', 'ar' => 'سلع متداولة',        'tr' => 'Ticareti Yapılan Emtia',  'zh' => '交易商品']],
            ['icon' => 'fas fa-globe',      'value' => '10+',  'label' => ['en' => 'Export Markets Served','fr' => "Marchés d'Exportation Desservis", 'ar' => 'أسواق تصدير مخدومة', 'tr' => 'Hizmet Verilen İhracat Pazarları', 'zh' => '服务出口市场']],
            ['icon' => 'fas fa-route',      'value' => '4',    'label' => ['en' => 'Active Operations',    'fr' => 'Opérations Actives',           'ar' => 'عمليات نشطة',        'tr' => 'Aktif Operasyonlar',      'zh' => '活跃业务']],
            ['icon' => 'fas fa-users',      'value' => '4',    'label' => ['en' => 'Team Members',         'fr' => "Membres de l'Équipe",          'ar' => 'أعضاء الفريق',       'tr' => 'Ekip Üyeleri',            'zh' => '团队成员']],
            ['icon' => 'fas fa-headset',    'value' => '24/7', 'label' => ['en' => 'Trading Desk Support', 'fr' => 'Support du Bureau Commercial', 'ar' => 'دعم مكتب التداول',   'tr' => 'Ticaret Masası Desteği',  'zh' => '交易台支持']],
            ['icon' => 'fas fa-shield-alt', 'value' => '100%', 'label' => ['en' => 'Certified Quality',    'fr' => 'Qualité Certifiée',            'ar' => 'جودة معتمدة',        'tr' => 'Sertifikalı Kalite',      'zh' => '认证品质']],
        ];
        foreach ($statsData as $i => $st) {
            Stat::create(['icon' => $st['icon'], 'value' => $st['value'], 'label' => $st['label'], 'description' => ['en'=>'','fr'=>'','ar'=>'','tr'=>'','zh'=>''], 'order' => $i, 'is_active' => true]);
        }

        // ── Team Members (fixed names/titles, hierarchy order) ────────────────
        $teamData = [
            [
                'name' => ['en' => 'Uysal Seher', 'fr' => 'Uysal Seher', 'ar' => 'أويسال سيهر', 'tr' => 'Uysal Seher', 'zh' => 'Uysal Seher'],
                'position' => ['en' => 'Director', 'fr' => 'Directrice', 'ar' => 'المديرة', 'tr' => 'Direktör', 'zh' => '董事'],
                'bio' => [
                    'en' => 'Director of Uraz Mining & Trading LTD. Uysal sets the company\'s strategic direction and oversees its overall growth across sourcing, trading and international partnerships.',
                    'fr' => "Directrice d'Uraz Mining & Trading LTD, Uysal définit l'orientation stratégique de l'entreprise et supervise sa croissance globale dans les domaines du sourcing, du commerce et des partenariats internationaux.",
                    'ar' => 'مديرة شركة أوراز للتعدين والتجارة المحدودة. تحدد أويسال التوجه الاستراتيجي للشركة وتُشرف على نموها الشامل في مجالات التوريد والتجارة والشراكات الدولية.',
                    'tr' => 'Uraz Mining & Trading LTD Direktörü. Uysal, şirketin stratejik yönünü belirler ve tedarik, ticaret ve uluslararası ortaklıklar alanlarındaki genel büyümesini denetler.',
                    'zh' => 'Uraz Mining & Trading LTD 董事。Uysal 制定公司的战略方向，并监督公司在采购、贸易和国际合作伙伴关系方面的整体发展。',
                ],
            ],
            [
                'name' => ['en' => 'Kocayigit Nail', 'fr' => 'Kocayigit Nail', 'ar' => 'قوجايغيت نايل', 'tr' => 'Kocayiğit Nail', 'zh' => 'Kocayigit Nail'],
                'position' => ['en' => 'Vice Director', 'fr' => 'Directeur Adjoint', 'ar' => 'نائب المدير', 'tr' => 'Direktör Yardımcısı', 'zh' => '副董事'],
                'bio' => [
                    'en' => 'Vice Director of Uraz Mining & Trading LTD. Nail supports the company\'s strategic leadership and works closely with the Director to coordinate operations across sourcing regions and trading partners.',
                    'fr' => "Directeur Adjoint d'Uraz Mining & Trading LTD, Nail appuie la direction stratégique de l'entreprise et collabore étroitement avec la Directrice pour coordonner les opérations à travers les régions de sourcing et les partenaires commerciaux.",
                    'ar' => 'نائب مدير شركة أوراز للتعدين والتجارة المحدودة. يدعم نايل القيادة الاستراتيجية للشركة ويعمل عن كثب مع المديرة لتنسيق العمليات عبر مناطق التوريد والشركاء التجاريين.',
                    'tr' => 'Uraz Mining & Trading LTD Direktör Yardımcısı. Nail, şirketin stratejik liderliğini destekler ve tedarik bölgeleri ile ticaret ortakları arasındaki operasyonları koordine etmek için Direktörle yakın çalışır.',
                    'zh' => 'Uraz Mining & Trading LTD 副董事。Nail 支持公司的战略领导工作，并与董事密切合作，协调各采购地区与贸易伙伴之间的业务。',
                ],
            ],
            [
                'name' => ['en' => 'Ayoub Oumar', 'fr' => 'Ayoub Oumar', 'ar' => 'أيوب عمر', 'tr' => 'Ayoub Oumar', 'zh' => 'Ayoub Oumar'],
                'position' => ['en' => 'Manager', 'fr' => 'Directeur', 'ar' => 'المدير', 'tr' => 'Müdür', 'zh' => '经理'],
                'bio' => [
                    'en' => 'Manager at Uraz Mining & Trading LTD. Ayoub oversees day-to-day trading operations, coordinating between sourcing teams, logistics partners and buyers to ensure every order is fulfilled reliably.',
                    'fr' => "Directeur chez Uraz Mining & Trading LTD, Ayoub supervise les opérations commerciales quotidiennes, assurant la coordination entre les équipes de sourcing, les partenaires logistiques et les acheteurs.",
                    'ar' => 'مدير في شركة أوراز للتعدين والتجارة المحدودة. يُشرف أيوب على العمليات التجارية اليومية، وينسّق بين فرق التوريد وشركاء اللوجستيات والمشترين لضمان تنفيذ كل طلب بموثوقية.',
                    'tr' => 'Uraz Mining & Trading LTD Müdürü. Ayoub, her siparişin güvenilir şekilde yerine getirilmesini sağlamak için tedarik ekipleri, lojistik ortakları ve alıcılar arasında koordinasyon sağlayarak günlük ticaret operasyonlarını yönetir.',
                    'zh' => 'Uraz Mining & Trading LTD 经理。Ayoub 负责日常贸易运营，协调采购团队、物流伙伴与买家之间的工作，确保每一笔订单都能可靠完成。',
                ],
            ],
            [
                'name' => ['en' => 'Ibrahim Abakar', 'fr' => 'Ibrahim Abakar', 'ar' => 'إبراهيم أباكر', 'tr' => 'İbrahim Abakar', 'zh' => 'Ibrahim Abakar'],
                'position' => ['en' => 'Vice Manager', 'fr' => 'Directeur Adjoint', 'ar' => 'نائب المدير', 'tr' => 'Müdür Yardımcısı', 'zh' => '副经理'],
                'bio' => [
                    'en' => 'Vice Manager at Uraz Mining & Trading LTD. Ibrahim supports daily trading operations and client communication, helping ensure a smooth experience for partners and buyers from enquiry through to delivery.',
                    'fr' => "Directeur Adjoint chez Uraz Mining & Trading LTD, Ibrahim appuie les opérations commerciales quotidiennes et la communication avec les clients, de la demande initiale jusqu'à la livraison.",
                    'ar' => 'نائب مدير في شركة أوراز للتعدين والتجارة المحدودة. يدعم إبراهيم العمليات التجارية اليومية والتواصل مع العملاء، مما يساهم في تجربة سلسة للشركاء والمشترين من الاستعلام وحتى التسليم.',
                    'tr' => 'Uraz Mining & Trading LTD Müdür Yardımcısı. İbrahim, talepten teslimata kadar ortaklar ve alıcılar için sorunsuz bir deneyim sağlamaya yardımcı olarak günlük ticaret operasyonlarını ve müşteri iletişimini destekler.',
                    'zh' => 'Uraz Mining & Trading LTD 副经理。Ibrahim 协助日常贸易运营及客户沟通，帮助确保合作伙伴与买家从咨询到交付的整个过程顺畅无阻。',
                ],
            ],
        ];
        foreach ($teamData as $i => $t) {
            $existing = TeamMember::where('order', $i)->first();
            if ($existing) {
                $existing->name = $t['name']; $existing->position = $t['position']; $existing->bio = $t['bio'];
                $existing->is_active = true;
                $existing->save(); // photo left untouched
            } else {
                TeamMember::create(['name' => $t['name'], 'position' => $t['position'], 'bio' => $t['bio'], 'order' => $i, 'is_active' => true, 'photo' => null]);
            }
        }
        TeamMember::where('order', '>=', count($teamData))->delete();

        // ── Testimonials (generic, placeholder partners — no fabricated company names) ──
        $testData = [
            [
                'quote' => [
                    'en' => "Uraz has been a dependable sourcing partner for our antimony requirements. Shipments arrive on schedule and every lot matches the certified assay. A trading partner we can rely on.",
                    'fr' => "Uraz a été un partenaire de sourcing fiable pour nos besoins en antimoine. Les expéditions arrivent dans les délais et chaque lot correspond à l'analyse certifiée. Un partenaire commercial sur lequel nous pouvons compter.",
                    'ar' => 'كانت أوراز شريكاً موثوقاً في توريد احتياجاتنا من الأنتيمون. تصل الشحنات في الوقت المحدد وتتطابق كل دفعة مع التحليل المعتمد. شريك تجاري يمكننا الاعتماد عليه.',
                    'tr' => 'Uraz, antimon ihtiyaçlarımız için güvenilir bir tedarik ortağı oldu. Sevkiyatlar zamanında geliyor ve her parti sertifikalı analizle eşleşiyor. Güvenebileceğimiz bir ticaret ortağı.',
                    'zh' => 'Uraz 一直是我们锑产品采购的可靠合作伙伴。货物按期到达，每批货物均与认证化验相符。一个值得信赖的贸易伙伴。',
                ],
                'author_name' => ['en' => 'J. M.', 'fr' => 'J. M.', 'ar' => 'ج. م.', 'tr' => 'J. M.', 'zh' => 'J. M.'],
                'author_position' => ['en' => 'Procurement Manager, International Trading Partner', 'fr' => "Responsable des Achats, Partenaire Commercial International", 'ar' => 'مدير المشتريات، شريك تجاري دولي', 'tr' => 'Satın Alma Müdürü, Uluslararası Ticaret Ortağı', 'zh' => '采购经理，国际贸易合作伙伴'],
                'company' => '', 'rating' => 5,
            ],
            [
                'quote' => [
                    'en' => "We have sourced gold through Uraz for several shipments now. The documentation is always complete and the communication throughout the process is clear and professional.",
                    'fr' => "Nous avons sourcé de l'or via Uraz pour plusieurs expéditions désormais. La documentation est toujours complète et la communication tout au long du processus est claire et professionnelle.",
                    'ar' => 'قمنا بتوريد الذهب عبر أوراز لعدة شحنات حتى الآن. الوثائق دائماً كاملة والتواصل خلال العملية واضح ومحترف.',
                    'tr' => 'Şimdiye kadar birkaç sevkiyat için Uraz üzerinden altın tedarik ettik. Belgeler her zaman eksiksiz ve süreç boyunca iletişim açık ve profesyonel.',
                    'zh' => '我们已通过 Uraz 多次采购黄金。文件始终齐全，整个过程中的沟通清晰专业。',
                ],
                'author_name' => ['en' => 'R. K.', 'fr' => 'R. K.', 'ar' => 'ر. ك.', 'tr' => 'R. K.', 'zh' => 'R. K.'],
                'author_position' => ['en' => 'Supply Chain Director, Overseas Buyer', 'fr' => "Directeur de la Chaîne d'Approvisionnement, Acheteur International", 'ar' => 'مدير سلسلة التوريد، مشترٍ دولي', 'tr' => 'Tedarik Zinciri Direktörü, Yurt Dışı Alıcı', 'zh' => '供应链总监，海外买家'],
                'company' => '', 'rating' => 5,
            ],
            [
                'quote' => [
                    'en' => "Copper cathode quality has been consistent across every order, and the Uraz team is responsive whenever we need updated certification or logistics information.",
                    'fr' => "La qualité des cathodes de cuivre est restée constante à chaque commande, et l'équipe Uraz est réactive chaque fois que nous avons besoin d'une certification ou d'informations logistiques mises à jour.",
                    'ar' => 'كانت جودة كاثودات النحاس ثابتة في كل طلب، وفريق أوراز سريع الاستجابة كلما احتجنا شهادات محدثة أو معلومات لوجستية.',
                    'tr' => 'Bakır katot kalitesi her siparişte tutarlı oldu ve güncel sertifika veya lojistik bilgisine ihtiyaç duyduğumuzda Uraz ekibi hızlı yanıt veriyor.',
                    'zh' => '每次订单的铜阴极板质量都保持稳定，每当我们需要更新的认证或物流信息时，Uraz 团队都能迅速响应。',
                ],
                'author_name' => ['en' => 'L. T.', 'fr' => 'L. T.', 'ar' => 'ل. ت.', 'tr' => 'L. T.', 'zh' => 'L. T.'],
                'author_position' => ['en' => 'Purchasing Lead, Industrial Buyer', 'fr' => "Responsable des Achats, Acheteur Industriel", 'ar' => 'رئيس المشتريات، مشترٍ صناعي', 'tr' => 'Satın Alma Lideri, Endüstriyel Alıcı', 'zh' => '采购负责人，工业买家'],
                'company' => '', 'rating' => 5,
            ],
        ];
        foreach ($testData as $i => $t) {
            $existing = Testimonial::where('order', $i)->first();
            $payload = ['quote' => $t['quote'], 'author_name' => $t['author_name'], 'author_position' => $t['author_position'], 'author_company' => $t['company'], 'rating' => $t['rating'], 'is_active' => true];
            if ($existing) {
                $existing->fill($payload);
                $existing->save(); // author_photo left untouched
            } else {
                Testimonial::create($payload + ['order' => $i]);
            }
        }
        Testimonial::where('order', '>=', count($testData))->delete();

        // ── News / Blog Posts ──────────────────────────────────────────────────
        $postsData = [
            [
                'slug' => 'rising-global-demand-african-minerals',
                'title' => ['en' => 'Why Global Demand for African Minerals Is Rising', 'fr' => 'Pourquoi la Demande Mondiale pour les Minéraux Africains Augmente', 'ar' => 'لماذا يتزايد الطلب العالمي على المعادن الأفريقية', 'tr' => 'Afrika Madenlerine Küresel Talep Neden Artıyor', 'zh' => '全球对非洲矿产的需求为何上升'],
                'excerpt' => [
                    'en' => 'From electronics to energy, global industries increasingly depend on minerals Africa is well positioned to supply. Here is what is driving that demand.',
                    'fr' => "De l'électronique à l'énergie, les industries mondiales dépendent de plus en plus de minéraux que l'Afrique est bien placée pour fournir. Voici ce qui alimente cette demande.",
                    'ar' => 'من الإلكترونيات إلى الطاقة، تعتمد الصناعات العالمية بشكل متزايد على المعادن التي تتمتع أفريقيا بموقع جيد لتوريدها. هذا ما يقف وراء هذا الطلب.',
                    'tr' => 'Elektronikten enerjiye, küresel endüstriler Afrika\'nın tedarik etmeye uygun konumda olduğu madenlere giderek daha fazla bağımlı hale geliyor. Bu talebi tetikleyen etkenler.',
                    'zh' => '从电子产品到能源，全球产业日益依赖非洲具备优势供应的矿产。以下是推动这一需求的因素。',
                ],
                'content' => [
                    'en' => "<p>Across electronics, energy, construction and defense, global industry's appetite for raw minerals continues to grow. Antimony and tungsten are key inputs for flame retardants, alloys and electronics; copper underpins the electrification of transport and infrastructure; and gold remains a core store of value for investors and central banks alike.</p><p>Africa holds some of the world's most significant reserves of these commodities, and Uraz Mining & Trading works at the intersection of that supply and the buyers who need it — connecting producers across the continent with international markets through transparent, well-documented trade.</p><p>As demand grows, the value of a reliable sourcing and export partner grows with it. Consistent quality, clear certification and dependable logistics matter more than ever to buyers managing their own supply chains.</p>",
                    'fr' => "<p>Dans l'électronique, l'énergie, la construction et la défense, l'appétit de l'industrie mondiale pour les minéraux bruts continue de croître. L'antimoine et le tungstène sont des intrants clés pour les retardateurs de flamme, les alliages et l'électronique ; le cuivre soutient l'électrification des transports et des infrastructures ; et l'or reste une réserve de valeur essentielle pour les investisseurs et les banques centrales.</p><p>L'Afrique détient certaines des réserves les plus importantes au monde de ces matières premières, et Uraz Mining & Trading se positionne à l'intersection de cette offre et des acheteurs qui en ont besoin — reliant les producteurs du continent aux marchés internationaux grâce à un commerce transparent et bien documenté.</p>",
                    'ar' => "<p>في مجالات الإلكترونيات والطاقة والإنشاءات والدفاع، يستمر نهم الصناعة العالمية للمعادن الخام في النمو. يُعدّ الأنتيمون والتنغستن مدخلات أساسية لمثبطات اللهب والسبائك والإلكترونيات؛ ويدعم النحاس كهربة النقل والبنية التحتية؛ ويبقى الذهب مخزناً أساسياً للقيمة للمستثمرين والبنوك المركزية على حد سواء.</p><p>تمتلك أفريقيا بعض أهم احتياطيات العالم من هذه السلع، وتعمل أوراز للتعدين والتجارة عند تقاطع هذا التوريد مع المشترين الذين يحتاجونه — لتربط المنتجين في القارة بالأسواق الدولية من خلال تجارة شفافة وموثقة جيداً.</p>",
                    'tr' => "<p>Elektronik, enerji, inşaat ve savunma alanlarında küresel endüstrinin ham madenlere olan iştahı artmaya devam ediyor. Antimon ve tungsten; alev geciktiriciler, alaşımlar ve elektronik için temel girdilerdir; bakır, ulaşım ve altyapının elektrifikasyonunu destekler; altın ise yatırımcılar ve merkez bankaları için temel bir değer saklama aracı olmayı sürdürür.</p><p>Afrika, bu emtiaların dünyadaki en önemli rezervlerinden bazılarına sahiptir ve Uraz Mining & Trading, bu arzın ihtiyaç duyan alıcılarla kesiştiği noktada çalışır — kıta genelindeki üreticileri şeffaf ve iyi belgelenmiş ticaretle uluslararası pazarlara bağlar.</p>",
                    'zh' => "<p>在电子、能源、建筑和国防领域，全球产业对原材料矿产的需求持续增长。锑和钨是阻燃剂、合金和电子产品的关键原料；铜支撑着交通和基础设施的电气化；黄金则始终是投资者和各国央行的核心价值储藏手段。</p><p>非洲拥有这些商品中一些世界上最重要的储量，Uraz Mining & Trading 正处于这种供应与需求买家的交汇点——通过透明、文件齐全的贸易将整个大陆的生产商与国际市场连接起来。</p>",
                ],
                'category' => ['en' => 'Market Insights', 'fr' => 'Analyses de Marché', 'ar' => 'تحليلات السوق', 'tr' => 'Piyasa Analizleri', 'zh' => '市场洞察'],
                'featured' => true,
            ],
            [
                'slug' => 'what-makes-reliable-minerals-trading-partner',
                'title' => ['en' => 'What Makes a Reliable Minerals Trading Partner', 'fr' => 'Ce Qui Fait un Partenaire Commercial de Minéraux Fiable', 'ar' => 'ما الذي يجعل شريك تجارة المعادن موثوقاً', 'tr' => 'Güvenilir Bir Maden Ticaret Ortağını Ne Yapar', 'zh' => '什么造就了可靠的矿产贸易伙伴'],
                'excerpt' => [
                    'en' => 'Sourcing minerals internationally carries real risk. Here are the qualities buyers should look for in a trading partner.',
                    'fr' => "Le sourcing international de minéraux comporte de réels risques. Voici les qualités que les acheteurs doivent rechercher chez un partenaire commercial.",
                    'ar' => 'ينطوي توريد المعادن دولياً على مخاطر حقيقية. إليك الصفات التي ينبغي على المشترين البحث عنها في الشريك التجاري.',
                    'tr' => 'Uluslararası maden tedariki gerçek riskler taşır. Alıcıların bir ticaret ortağında araması gereken özellikler.',
                    'zh' => '跨国采购矿产存在实际风险。以下是买家在贸易伙伴身上应关注的特质。',
                ],
                'content' => [
                    'en' => "<p>For any buyer sourcing commodities internationally, the trading partner matters as much as the commodity itself. A few qualities consistently separate reliable partners from the rest.</p><p><strong>Verified quality.</strong> Every shipment should come with independent assay certification — not just a seller's own claims.</p><p><strong>Transparent documentation.</strong> Clear chain-of-custody records, export paperwork and compliance documents protect both sides of a transaction.</p><p><strong>Logistics you can plan around.</strong> Dependable loading schedules and shipping coordination reduce costly delays.</p><p><strong>Responsive communication.</strong> Questions about a shipment should get clear answers quickly, not silence.</p><p>At Uraz, these principles guide every transaction — because a trading relationship only works when both sides can trust what they're agreeing to.</p>",
                    'fr' => "<p>Pour tout acheteur sourçant des matières premières à l'international, le partenaire commercial compte autant que la matière première elle-même. Quelques qualités distinguent systématiquement les partenaires fiables des autres.</p><p><strong>Qualité vérifiée.</strong> Chaque expédition doit être accompagnée d'une certification d'analyse indépendante.</p><p><strong>Documentation transparente.</strong> Des registres de traçabilité clairs protègent les deux parties d'une transaction.</p><p><strong>Une logistique prévisible.</strong> Des calendriers de chargement fiables réduisent les retards coûteux.</p><p><strong>Une communication réactive.</strong> Les questions concernant une expédition doivent obtenir des réponses claires et rapides.</p>",
                    'ar' => "<p>لأي مشتر يورّد السلع دولياً، يهم الشريك التجاري بقدر ما تهم السلعة نفسها. تميّز بعض الصفات باستمرار الشركاء الموثوقين عن غيرهم.</p><p><strong>جودة موثقة.</strong> يجب أن تأتي كل شحنة بشهادة تحليل مستقلة — لا مجرد تصريحات البائع.</p><p><strong>وثائق شفافة.</strong> سجلات واضحة لسلسلة التوثيق تحمي كلا طرفي المعاملة.</p><p><strong>لوجستيات يمكن التخطيط لها.</strong> جداول تحميل موثوقة تقلّل التأخيرات المكلفة.</p><p><strong>تواصل سريع الاستجابة.</strong> يجب أن تحصل الأسئلة حول الشحنة على إجابات واضحة وسريعة.</p>",
                    'tr' => "<p>Uluslararası olarak emtia tedarik eden her alıcı için ticaret ortağı, emtianın kendisi kadar önemlidir. Bazı özellikler güvenilir ortakları diğerlerinden sürekli olarak ayırır.</p><p><strong>Doğrulanmış kalite.</strong> Her sevkiyat bağımsız analiz sertifikasıyla gelmelidir.</p><p><strong>Şeffaf belgeler.</strong> Açık gözetim zinciri kayıtları işlemin her iki tarafını da korur.</p><p><strong>Planlanabilir lojistik.</strong> Güvenilir yükleme programları maliyetli gecikmeleri azaltır.</p><p><strong>Duyarlı iletişim.</strong> Bir sevkiyatla ilgili sorular hızlı ve açık yanıtlar almalıdır.</p>",
                    'zh' => "<p>对于任何跨国采购大宗商品的买家而言，贸易伙伴与商品本身同样重要。以下几项特质始终将可靠的伙伴与其他人区分开来。</p><p><strong>经核实的质量。</strong>每批货物都应附有独立化验认证，而不仅仅是卖方自己的说法。</p><p><strong>透明的文件。</strong>清晰的监管链记录可保护交易双方。</p><p><strong>可预期的物流。</strong>可靠的装船计划可减少高成本的延误。</p><p><strong>及时的沟通。</strong>关于货物的问题应迅速获得清晰的答复。</p>",
                ],
                'category' => ['en' => 'Trading', 'fr' => 'Commerce', 'ar' => 'التجارة', 'tr' => 'Ticaret', 'zh' => '贸易'],
                'featured' => false,
            ],
            [
                'slug' => 'understanding-incoterms-minerals-trade',
                'title' => ['en' => 'Understanding Incoterms in the Minerals Trade', 'fr' => 'Comprendre les Incoterms dans le Commerce des Minéraux', 'ar' => 'فهم مصطلحات التجارة الدولية Incoterms في تجارة المعادن', 'tr' => 'Maden Ticaretinde Incoterms\'i Anlamak', 'zh' => '了解矿产贸易中的国际贸易术语（Incoterms）'],
                'excerpt' => [
                    'en' => 'FOB, CIF, CFR — Incoterms define who is responsible for what, and when. Here is a short primer for buyers new to commodity trade.',
                    'fr' => "FOB, CIF, CFR — les Incoterms définissent qui est responsable de quoi, et quand. Voici un bref aperçu pour les acheteurs nouveaux au commerce des matières premières.",
                    'ar' => 'FOB وCIF وCFR — تحدد مصطلحات Incoterms من المسؤول عن ماذا، ومتى. إليك مقدمة مختصرة للمشترين الجدد في تجارة السلع.',
                    'tr' => 'FOB, CIF, CFR — Incoterms kimin neden ve ne zaman sorumlu olduğunu tanımlar. Emtia ticaretine yeni başlayan alıcılar için kısa bir giriş.',
                    'zh' => 'FOB、CIF、CFR——国际贸易术语界定了谁在何时对什么负责。以下是为大宗商品贸易新手买家准备的简要介绍。',
                ],
                'content' => [
                    'en' => "<p>Incoterms are standardized trade terms that define exactly where risk, cost and responsibility transfer from seller to buyer during a shipment. Getting them right avoids costly misunderstandings.</p><p><strong>FOB (Free On Board):</strong> the seller delivers the goods on board the vessel at the port of shipment; risk transfers to the buyer once goods are loaded.</p><p><strong>CFR (Cost and Freight):</strong> the seller arranges and pays for carriage to the destination port, but risk still transfers at the port of shipment.</p><p><strong>CIF (Cost, Insurance and Freight):</strong> similar to CFR, with the seller also arranging insurance for the goods in transit.</p><p>Uraz supports standard Incoterms across our commodity lines and works with each buyer to agree the terms that fit their logistics setup before any contract is finalized.</p>",
                    'fr' => "<p>Les Incoterms sont des termes commerciaux standardisés qui définissent précisément où le risque, le coût et la responsabilité passent du vendeur à l'acheteur durant une expédition.</p><p><strong>FOB (Franco à Bord) :</strong> le vendeur livre les marchandises à bord du navire au port d'expédition.</p><p><strong>CFR (Coût et Fret) :</strong> le vendeur organise et paie le transport jusqu'au port de destination, mais le risque est toujours transféré au port d'expédition.</p><p><strong>CIF (Coût, Assurance et Fret) :</strong> similaire au CFR, le vendeur organisant également l'assurance des marchandises en transit.</p>",
                    'ar' => "<p>مصطلحات Incoterms هي شروط تجارية موحَّدة تحدد بدقة أين تنتقل المخاطر والتكلفة والمسؤولية من البائع إلى المشتري خلال الشحن.</p><p><strong>FOB (التسليم على ظهر السفينة):</strong> يسلّم البائع البضائع على ظهر السفينة في ميناء الشحن.</p><p><strong>CFR (التكلفة والشحن):</strong> يرتب البائع النقل ويدفع تكاليفه حتى ميناء الوجهة، لكن تنتقل المخاطر في ميناء الشحن.</p><p><strong>CIF (التكلفة والتأمين والشحن):</strong> مشابه لـCFR، مع ترتيب البائع أيضاً للتأمين على البضائع أثناء النقل.</p>",
                    'tr' => "<p>Incoterms, bir sevkiyat sırasında riskin, maliyetin ve sorumluluğun satıcıdan alıcıya tam olarak nerede geçtiğini tanımlayan standartlaştırılmış ticaret terimleridir.</p><p><strong>FOB (Gemide Teslim):</strong> satıcı malları yükleme limanında gemiye teslim eder.</p><p><strong>CFR (Navlun Dahil):</strong> satıcı varış limanına kadar taşımayı düzenler ve öder, ancak risk yine yükleme limanında geçer.</p><p><strong>CIF (Sigorta ve Navlun Dahil):</strong> CFR'ye benzer, satıcı ayrıca transit sırasındaki mallar için sigorta da düzenler.</p>",
                    'zh' => "<p>国际贸易术语是标准化的贸易条款，精确界定了在装运过程中风险、成本和责任从卖方转移至买方的具体节点。</p><p><strong>FOB（船上交货）：</strong>卖方在装运港将货物交至船上，货物装船后风险转移至买方。</p><p><strong>CFR（运费在内）：</strong>卖方安排并支付至目的港的运费，但风险仍在装运港转移。</p><p><strong>CIF（成本、保险加运费）：</strong>与CFR类似，卖方还需为运输中的货物安排保险。</p>",
                ],
                'category' => ['en' => 'Trading', 'fr' => 'Commerce', 'ar' => 'التجارة', 'tr' => 'Ticaret', 'zh' => '贸易'],
                'featured' => false,
            ],
        ];
        $adminUser = \App\Models\User::where('role', 'admin')->first();
        foreach ($postsData as $pd) {
            $existing = BlogPost::where('slug', $pd['slug'])->first();
            $payload = ['title' => $pd['title'], 'excerpt' => $pd['excerpt'], 'content' => $pd['content'], 'category' => $pd['category'], 'is_featured' => $pd['featured'], 'is_published' => true];
            if ($existing) {
                $existing->fill($payload);
                $existing->save(); // image left untouched
            } else {
                BlogPost::create($payload + ['slug' => $pd['slug'], 'author_id' => $adminUser?->id, 'published_at' => now()->subDays(rand(1,45)), 'image' => null]);
            }
        }

        // ── FAQs ─────────────────────────────────────────────────────────────
        Faq::truncate();
        $faqsData = [
            ['page_key' => 'home',
                'question' => ['en' => 'What are your payment terms?', 'fr' => 'Quelles sont vos modalités de paiement ?', 'ar' => 'ما هي شروط الدفع لديكم؟', 'tr' => 'Ödeme koşullarınız nedir?', 'zh' => '你们的付款条款是什么？'],
                'answer' => ['en' => 'We work with standard trade finance instruments such as Letters of Credit (L/C) and bank transfer (T/T), agreed on a per-contract basis depending on volume and destination.', 'fr' => "Nous travaillons avec des instruments de financement commercial standards tels que les lettres de crédit (L/C) et le virement bancaire (T/T), convenus par contrat selon le volume et la destination.", 'ar' => 'نتعامل بأدوات تمويل تجاري معيارية مثل خطابات الاعتماد (L/C) والتحويل المصرفي (T/T)، يتم الاتفاق عليها لكل عقد حسب الحجم والوجهة.', 'tr' => 'Hacme ve varış noktasına bağlı olarak sözleşme bazında kararlaştırılan Akreditif (L/C) ve banka havalesi (T/T) gibi standart ticaret finansmanı araçlarıyla çalışıyoruz.', 'zh' => '我们采用标准的贸易融资方式，如信用证（L/C）和银行转账（T/T），具体以每笔合同为准，视货量和目的地而定。']],
            ['page_key' => 'home',
                'question' => ['en' => 'Which Incoterms do you support?', 'fr' => 'Quels Incoterms prenez-vous en charge ?', 'ar' => 'ما هي مصطلحات Incoterms التي تدعمونها؟', 'tr' => 'Hangi Incoterms\'leri destekliyorsunuz?', 'zh' => '你们支持哪些国际贸易术语？'],
                'answer' => ['en' => 'We support standard Incoterms including FOB, CFR and CIF, depending on the agreed delivery point and the buyer\'s logistics arrangement.', 'fr' => "Nous prenons en charge les Incoterms standards, notamment FOB, CFR et CIF, selon le point de livraison convenu et les arrangements logistiques de l'acheteur.", 'ar' => 'ندعم مصطلحات Incoterms المعيارية بما فيها FOB وCFR وCIF، حسب نقطة التسليم المتفق عليها وترتيبات اللوجستيات لدى المشتري.', 'tr' => 'Kararlaştırılan teslimat noktasına ve alıcının lojistik düzenlemesine bağlı olarak FOB, CFR ve CIF dahil standart Incoterms\'leri destekliyoruz.', 'zh' => '我们支持标准国际贸易术语，包括FOB、CFR和CIF，具体取决于约定的交货地点及买家的物流安排。']],
            ['page_key' => 'home',
                'question' => ['en' => 'Do you provide quality certification?', 'fr' => 'Fournissez-vous une certification de qualité ?', 'ar' => 'هل تقدمون شهادة جودة؟', 'tr' => 'Kalite sertifikası sağlıyor musunuz?', 'zh' => '你们提供质量认证吗？'],
                'answer' => ['en' => 'Yes. Every shipment is accompanied by independent laboratory assay certificates and the relevant compliance documentation for that commodity.', 'fr' => "Oui. Chaque expédition est accompagnée de certificats d'analyse de laboratoire indépendants et de la documentation de conformité pertinente pour cette matière première.", 'ar' => 'نعم. تُرفق كل شحنة بشهادات تحليل من مختبر مستقل والوثائق التنظيمية ذات الصلة بتلك السلعة.', 'tr' => 'Evet. Her sevkiyata bağımsız laboratuvar analiz sertifikaları ve o emtia için ilgili uyumluluk belgeleri eşlik eder.', 'zh' => '是的。每批货物均配有独立实验室化验证书及该商品相关的合规文件。']],
            ['page_key' => 'home',
                'question' => ['en' => 'What is the minimum order quantity (MOQ)?', 'fr' => 'Quelle est la quantité minimale de commande (MOQ) ?', 'ar' => 'ما هو الحد الأدنى لكمية الطلب؟', 'tr' => 'Minimum sipariş miktarı (MOQ) nedir?', 'zh' => '最小订购量（MOQ）是多少？'],
                'answer' => ['en' => 'MOQ varies by commodity and shipment method. Contact our trading desk with your requirements and we will confirm availability and volumes.', 'fr' => "La MOQ varie selon la matière première et le mode d'expédition. Contactez notre bureau commercial avec vos besoins et nous confirmerons la disponibilité et les volumes.", 'ar' => 'يختلف الحد الأدنى للطلب حسب السلعة وطريقة الشحن. تواصل مع مكتب التداول لدينا بمتطلباتك وسنؤكد التوافر والكميات.', 'tr' => 'MOQ, emtiaya ve sevkiyat yöntemine göre değişir. İhtiyaçlarınızla ticaret masamızla iletişime geçin, müsaitlik ve hacimleri teyit edelim.', 'zh' => '最小订购量因商品和运输方式而异。请将您的需求告知我们的贸易台，我们将确认供货情况及数量。']],
            ['page_key' => 'home',
                'question' => ['en' => 'How do you handle shipping and logistics?', 'fr' => 'Comment gérez-vous le transport et la logistique ?', 'ar' => 'كيف تتعاملون مع الشحن واللوجستيات؟', 'tr' => 'Sevkiyat ve lojistiği nasıl yönetiyorsunuz?', 'zh' => '你们如何处理运输与物流？'],
                'answer' => ['en' => 'We coordinate end-to-end logistics including inland transport, port handling, customs clearance and ocean freight through vetted logistics partners.', 'fr' => "Nous coordonnons une logistique de bout en bout incluant le transport terrestre, la manutention portuaire, le dédouanement et le fret maritime via des partenaires logistiques vérifiés.", 'ar' => 'ننسّق لوجستيات شاملة من البداية إلى النهاية تشمل النقل الداخلي والمعالجة في الميناء والتخليص الجمركي والشحن البحري عبر شركاء لوجستيين موثوقين.', 'tr' => 'Denetlenmiş lojistik ortaklar aracılığıyla iç nakliye, liman işlemleri, gümrükleme ve deniz navlunu dahil uçtan uca lojistiği koordine ediyoruz.', 'zh' => '我们通过经审核的物流伙伴统筹端到端物流，包括内陆运输、港口操作、清关和海运。']],
        ];
        foreach ($faqsData as $i => $f) {
            Faq::create(['page_key' => $f['page_key'], 'question' => $f['question'], 'answer' => $f['answer'], 'order' => $i, 'is_active' => true]);
        }

        // ── Pages ────────────────────────────────────────────────────────────
        Page::truncate();
        $pagesData = [
            ['slug' => 'about', 'title' => ['en' => 'About Uraz Mining & Trading LTD', 'fr' => 'À Propos d\'Uraz Mining & Trading LTD', 'ar' => 'عن شركة أوراز للتعدين والتجارة المحدودة', 'tr' => 'Uraz Mining & Trading LTD Hakkında', 'zh' => '关于 Uraz Mining & Trading LTD'],
                'content' => [
                    'en' => "<p>Uraz Mining & Trading LTD was founded with a clear mission: to connect Africa's rich mineral resources with global markets through reliable sourcing, strict quality control and efficient logistics.</p><p>We trade in six strategic commodities — Antimony, Gold, Petroleum, Copper, Tungsten and Charcoal — working closely with producers, logistics partners and international buyers across the supply chain. Every shipment we handle is independently assayed, fully documented and tracked from source to destination.</p><p>Our team is led by a focused leadership group overseeing strategy, operations and trading relationships, supported by a growing network of sourcing and logistics partners across Africa.</p><p>As global demand for these commodities continues to grow, Uraz is committed to being a dependable bridge between African producers and the markets that need what Africa has to offer.</p>",
                    'fr' => "<p>Uraz Mining & Trading LTD a été fondée avec une mission claire : relier les riches ressources minérales de l'Afrique aux marchés mondiaux grâce à un sourcing fiable, un contrôle qualité rigoureux et une logistique efficace.</p><p>Nous négocions six matières premières stratégiques — l'Antimoine, l'Or, le Pétrole, le Cuivre, le Tungstène et le Charbon de Bois — en collaborant étroitement avec des producteurs, des partenaires logistiques et des acheteurs internationaux à travers la chaîne d'approvisionnement.</p><p>Notre équipe est dirigée par un groupe de direction concentré supervisant la stratégie, les opérations et les relations commerciales, appuyé par un réseau croissant de partenaires de sourcing et de logistique à travers l'Afrique.</p>",
                    'ar' => "<p>تأسست شركة أوراز للتعدين والتجارة المحدودة برسالة واضحة: ربط الموارد المعدنية الغنية في أفريقيا بالأسواق العالمية من خلال توريد موثوق ورقابة صارمة على الجودة ولوجستيات فعّالة.</p><p>نتاجر في ست سلع استراتيجية — الأنتيمون والذهب والنفط والنحاس والتنغستن والفحم الخشبي — بالعمل الوثيق مع المنتجين وشركاء اللوجستيات والمشترين الدوليين عبر سلسلة التوريد. تخضع كل شحنة نتعامل معها لتحليل مستقل وتوثيق كامل وتتبع من المصدر إلى الوجهة.</p><p>يقود فريقنا مجموعة قيادية مركّزة تُشرف على الاستراتيجية والعمليات والعلاقات التجارية، تدعمها شبكة متنامية من شركاء التوريد واللوجستيات في أفريقيا.</p>",
                    'tr' => "<p>Uraz Mining & Trading LTD, açık bir misyonla kuruldu: güvenilir tedarik, sıkı kalite kontrolü ve verimli lojistik yoluyla Afrika'nın zengin maden kaynaklarını küresel pazarlara bağlamak.</p><p>Altı stratejik emtiada ticaret yapıyoruz — Antimon, Altın, Petrol, Bakır, Tungsten ve Odun Kömürü — tedarik zinciri boyunca üreticiler, lojistik ortakları ve uluslararası alıcılarla yakın çalışarak. Ele aldığımız her sevkiyat bağımsız olarak analiz edilir, tam olarak belgelenir ve kaynağından varış noktasına kadar takip edilir.</p>",
                    'zh' => "<p>Uraz Mining & Trading LTD 成立的使命明确：通过可靠的采购、严格的质量控制和高效的物流，将非洲丰富的矿产资源连接到全球市场。</p><p>我们从事六种具有战略意义商品的贸易——锑、黄金、石油、铜、钨和木炭——在整个供应链中与生产商、物流伙伴和国际买家密切合作。我们处理的每一批货物均经过独立化验、完整记录，并从源头到目的地全程追踪。</p><p>我们的团队由专注的领导团队带领，负责监督战略、运营和贸易关系，并得到非洲日益壮大的采购与物流合作伙伴网络的支持。</p>",
                ]],
            ['slug' => 'privacy', 'title' => ['en' => 'Privacy Policy', 'fr' => 'Politique de Confidentialité', 'ar' => 'سياسة الخصوصية', 'tr' => 'Gizlilik Politikası', 'zh' => '隐私政策'],
                'content' => [
                    'en' => '<h4>Privacy Policy</h4><p>Uraz Mining & Trading LTD is committed to protecting your personal data. This policy explains how we collect, use and protect information when you use our website and services.</p><h5>Information We Collect</h5><p>We collect information you provide directly through contact and enquiry forms, as well as anonymised usage data to improve our website.</p><h5>How We Use Your Information</h5><p>Your information is used solely to respond to your enquiry and process your request. We never sell or share your data with third parties.</p><h5>Contact</h5><p>For any privacy-related questions, please use the contact form on this website.</p>',
                    'fr' => "<h4>Politique de Confidentialité</h4><p>Uraz Mining & Trading LTD s'engage à protéger vos données personnelles. Cette politique explique comment nous collectons, utilisons et protégeons les informations lorsque vous utilisez notre site et nos services.</p><h5>Informations Collectées</h5><p>Nous collectons les informations que vous nous transmettez directement via les formulaires de contact et de demande, ainsi que des données d'utilisation anonymisées.</p><h5>Utilisation de Vos Informations</h5><p>Vos informations sont utilisées uniquement pour répondre à votre demande. Nous ne vendons ni ne partageons jamais vos données avec des tiers.</p>",
                    'ar' => "<h4>سياسة الخصوصية</h4><p>تلتزم شركة أوراز للتعدين والتجارة المحدودة بحماية بياناتك الشخصية. توضح هذه السياسة كيفية جمع المعلومات واستخدامها وحمايتها عند استخدامك موقعنا وخدماتنا.</p><h5>المعلومات التي نجمعها</h5><p>نجمع المعلومات التي تُزوِّدنا بها مباشرةً عبر نماذج التواصل والاستعلام، فضلاً عن بيانات استخدام مجهولة الهوية.</p><h5>كيف نستخدم معلوماتك</h5><p>تُستخدم معلوماتك فقط للرد على استفسارك ومعالجة طلبك. لا نبيع بياناتك ولا نشاركها مع أي طرف ثالث.</p>",
                    'tr' => "<h4>Gizlilik Politikası</h4><p>Uraz Mining & Trading LTD, kişisel verilerinizi korumaya kararlıdır. Bu politika, web sitemizi ve hizmetlerimizi kullandığınızda bilgileri nasıl topladığımızı, kullandığımızı ve koruduğumuzu açıklar.</p><h5>Topladığımız Bilgiler</h5><p>İletişim ve talep formları aracılığıyla doğrudan sağladığınız bilgileri ve web sitemizi geliştirmek için anonim kullanım verilerini topluyoruz.</p><h5>Bilgilerinizi Nasıl Kullanıyoruz</h5><p>Bilgileriniz yalnızca talebinize yanıt vermek ve isteğinizi işleme almak için kullanılır. Verilerinizi asla üçüncü taraflarla satmıyor veya paylaşmıyoruz.</p>",
                    'zh' => "<h4>隐私政策</h4><p>Uraz Mining & Trading LTD 致力于保护您的个人数据。本政策说明我们在您使用本网站及服务时如何收集、使用和保护信息。</p><h5>我们收集的信息</h5><p>我们收集您通过联系表单和咨询表单直接提供的信息，以及用于改进网站的匿名使用数据。</p><h5>我们如何使用您的信息</h5><p>您的信息仅用于回复您的咨询并处理您的请求。我们绝不会向第三方出售或共享您的数据。</p>",
                ]],
            ['slug' => 'terms', 'title' => ['en' => 'Terms of Service', 'fr' => "Conditions d'Utilisation", 'ar' => 'شروط الخدمة', 'tr' => 'Kullanım Şartları', 'zh' => '服务条款'],
                'content' => [
                    'en' => "<h4>Terms of Service</h4><p>By using the Uraz Mining & Trading website, you agree to these terms. Commercial trading terms for any specific transaction are governed by individually negotiated supply agreements, not by this website. Uraz Mining & Trading LTD reserves the right to update these terms with reasonable notice.</p>",
                    'fr' => "<h4>Conditions d'Utilisation</h4><p>En utilisant le site d'Uraz Mining & Trading, vous acceptez les présentes conditions. Les modalités commerciales de toute transaction spécifique sont régies par des accords de fourniture négociés individuellement, et non par ce site web.</p>",
                    'ar' => "<h4>شروط الخدمة</h4><p>باستخدام موقع أوراز للتعدين والتجارة، فإنك توافق على هذه الشروط. تخضع شروط التداول التجاري لأي معاملة محددة لاتفاقيات توريد يتم التفاوض عليها بشكل فردي، وليس هذا الموقع.</p>",
                    'tr' => "<h4>Kullanım Şartları</h4><p>Uraz Mining & Trading web sitesini kullanarak bu şartları kabul edersiniz. Herhangi bir spesifik işlem için ticari koşullar, bu web sitesi tarafından değil, bireysel olarak müzakere edilen tedarik sözleşmeleri tarafından yönetilir.</p>",
                    'zh' => "<h4>服务条款</h4><p>使用 Uraz Mining & Trading 网站即表示您同意这些条款。任何具体交易的商业条款受单独协商的供应协议约束，而非本网站。</p>",
                ]],
        ];
        foreach ($pagesData as $pd) {
            Page::create(['slug' => $pd['slug'], 'title' => $pd['title'], 'content' => $pd['content'], 'is_active' => true]);
        }

        // ── Sliders ──────────────────────────────────────────────────────────
        $sliderData = [
            ['page_key' => 'home', 'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(26,20,15,0.70)',
                'title' => ['en' => "Connecting Africa's Minerals to Global Markets", 'fr' => "Relier les Minéraux d'Afrique aux Marchés Mondiaux", 'ar' => 'نربط معادن أفريقيا بالأسواق العالمية', 'tr' => "Afrika'nın Madenlerini Küresel Pazarlara Bağlıyoruz", 'zh' => '连接非洲矿产与全球市场'],
                'subtitle' => ['en' => 'Antimony, Gold, Petroleum, Copper, Tungsten and Charcoal — sourced responsibly, delivered reliably.', 'fr' => "Antimoine, Or, Pétrole, Cuivre, Tungstène et Charbon de Bois — sourcés de manière responsable, livrés de façon fiable.", 'ar' => 'الأنتيمون والذهب والنفط والنحاس والتنغستن والفحم الخشبي — يتم توريدها بمسؤولية وتسليمها بموثوقية.', 'tr' => 'Antimon, Altın, Petrol, Bakır, Tungsten ve Odun Kömürü — sorumlu şekilde tedarik edilir, güvenilir şekilde teslim edilir.', 'zh' => '锑、黄金、石油、铜、钨和木炭——负责任地采购，可靠地交付。'],
                'button_text' => ['en' => 'Explore Our Products', 'fr' => 'Nos Produits', 'ar' => 'استكشف منتجاتنا', 'tr' => 'Ürünlerimizi İnceleyin', 'zh' => '探索我们的产品'], 'button_link' => '/products'],
            ['page_key' => 'home', 'order' => 1, 'text_align' => 'left', 'overlay' => 'rgba(26,20,15,0.65)',
                'title' => ['en' => 'Trusted by Partners Worldwide', 'fr' => 'La Confiance de Partenaires du Monde Entier', 'ar' => 'موثوق به من شركاء حول العالم', 'tr' => 'Dünya Çapında Ortaklar Tarafından Güvenilir', 'zh' => '赢得全球合作伙伴的信赖'],
                'subtitle' => ['en' => 'From sourcing to export, we deliver consistent quality and dependable logistics for buyers around the world.', 'fr' => "Du sourcing à l'exportation, nous assurons une qualité constante et une logistique fiable pour les acheteurs du monde entier.", 'ar' => 'من التوريد إلى التصدير، نقدم جودة ثابتة ولوجستيات موثوقة للمشترين حول العالم.', 'tr' => 'Tedarikten ihracata, dünya çapındaki alıcılar için tutarlı kalite ve güvenilir lojistik sağlıyoruz.', 'zh' => '从采购到出口，我们为全球买家提供稳定的质量和可靠的物流。'],
                'button_text' => ['en' => 'See Our Operations', 'fr' => 'Nos Opérations', 'ar' => 'اطلع على عملياتنا', 'tr' => 'Operasyonlarımızı Görün', 'zh' => '了解我们的业务'], 'button_link' => '/operations'],
            ['page_key' => 'home', 'order' => 2, 'text_align' => 'right', 'overlay' => 'rgba(26,20,15,0.70)',
                'title' => ['en' => 'Transparent, Certified, Reliable', 'fr' => 'Transparent, Certifié, Fiable', 'ar' => 'شفافية وشهادات وموثوقية', 'tr' => 'Şeffaf, Sertifikalı, Güvenilir', 'zh' => '透明、认证、可靠'],
                'subtitle' => ['en' => 'Every shipment is independently assayed and fully documented — because trust is the foundation of good trade.', 'fr' => "Chaque expédition est analysée de manière indépendante et entièrement documentée — car la confiance est le fondement d'un bon commerce.", 'ar' => 'تخضع كل شحنة لتحليل مستقل وتوثيق كامل — لأن الثقة هي أساس التجارة الجيدة.', 'tr' => 'Her sevkiyat bağımsız olarak analiz edilir ve tam olarak belgelenir — çünkü güven, iyi ticaretin temelidir.', 'zh' => '每批货物均经过独立化验并完整记录——因为信任是良好贸易的基石。'],
                'button_text' => ['en' => 'Contact Us', 'fr' => 'Contactez-Nous', 'ar' => 'تواصل معنا', 'tr' => 'Bize Ulaşın', 'zh' => '联系我们'], 'button_link' => '/contact'],
            ['page_key' => 'about', 'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(26,20,15,0.70)',
                'title' => ['en' => 'About Uraz Mining & Trading', 'fr' => "À Propos d'Uraz Mining & Trading", 'ar' => 'عن أوراز للتعدين والتجارة', 'tr' => 'Uraz Mining & Trading Hakkında', 'zh' => '关于 Uraz Mining & Trading'],
                'subtitle' => ['en' => 'A trusted link between African mineral producers and global buyers.', 'fr' => 'Un lien de confiance entre les producteurs de minéraux africains et les acheteurs mondiaux.', 'ar' => 'حلقة وصل موثوقة بين منتجي المعادن الأفريقيين والمشترين العالميين.', 'tr' => 'Afrikalı maden üreticileri ile küresel alıcılar arasında güvenilir bir bağlantı.', 'zh' => '非洲矿产生产商与全球买家之间值得信赖的桥梁。'],
                'button_text' => ['en' => '', 'fr' => '', 'ar' => '', 'tr' => '', 'zh' => ''], 'button_link' => ''],
            ['page_key' => 'products', 'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(26,20,15,0.70)',
                'title' => ['en' => 'Our Products', 'fr' => 'Nos Produits', 'ar' => 'منتجاتنا', 'tr' => 'Ürünlerimiz', 'zh' => '我们的产品'],
                'subtitle' => ['en' => 'Antimony, Gold, Petroleum, Copper, Tungsten and Charcoal — sourced across Africa, delivered worldwide.', 'fr' => "Antimoine, Or, Pétrole, Cuivre, Tungstène et Charbon de Bois — sourcés en Afrique, livrés dans le monde entier.", 'ar' => 'الأنتيمون والذهب والنفط والنحاس والتنغستن والفحم الخشبي — يتم توريدها من أفريقيا وتسليمها حول العالم.', 'tr' => 'Antimon, Altın, Petrol, Bakır, Tungsten ve Odun Kömürü — Afrika\'dan tedarik edilir, dünya çapında teslim edilir.', 'zh' => '锑、黄金、石油、铜、钨和木炭——采购自非洲，交付至全球。'],
                'button_text' => ['en' => '', 'fr' => '', 'ar' => '', 'tr' => '', 'zh' => ''], 'button_link' => ''],
            ['page_key' => 'operations', 'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(26,20,15,0.70)',
                'title' => ['en' => 'Our Operations', 'fr' => 'Nos Opérations', 'ar' => 'عملياتنا', 'tr' => 'Operasyonlarımız', 'zh' => '我们的业务'],
                'subtitle' => ['en' => 'Sourcing regions, logistics corridors and export hubs across Africa.', 'fr' => 'Régions de sourcing, corridors logistiques et hubs d\'exportation à travers l\'Afrique.', 'ar' => 'مناطق التوريد وممرات اللوجستيات ومراكز التصدير في أفريقيا.', 'tr' => 'Afrika genelinde tedarik bölgeleri, lojistik koridorları ve ihracat merkezleri.', 'zh' => '遍布非洲的采购区域、物流走廊和出口枢纽。'],
                'button_text' => ['en' => '', 'fr' => '', 'ar' => '', 'tr' => '', 'zh' => ''], 'button_link' => ''],
            ['page_key' => 'contact', 'order' => 0, 'text_align' => 'center', 'overlay' => 'rgba(26,20,15,0.70)',
                'title' => ['en' => 'Get In Touch', 'fr' => 'Contactez-Nous', 'ar' => 'تواصل معنا', 'tr' => 'İletişime Geçin', 'zh' => '联系我们'],
                'subtitle' => ['en' => 'Tell us about your requirements and we will get back to you promptly.', 'fr' => 'Parlez-nous de vos besoins, nous vous répondrons rapidement.', 'ar' => 'أخبرنا عن متطلباتك وسنعود إليك في أقرب وقت.', 'tr' => 'İhtiyaçlarınızı bize anlatın, size hızlıca geri döneceğiz.', 'zh' => '请告诉我们您的需求，我们将尽快回复您。'],
                'button_text' => ['en' => '', 'fr' => '', 'ar' => '', 'tr' => '', 'zh' => ''], 'button_link' => ''],
        ];
        foreach ($sliderData as $sd) {
            $existing = Slider::where('page_key', $sd['page_key'])->where('order', $sd['order'])->first();
            $payload = ['title' => $sd['title'], 'subtitle' => $sd['subtitle'], 'button_text' => $sd['button_text'], 'button_link' => $sd['button_link'], 'text_align' => $sd['text_align'], 'overlay_color' => $sd['overlay'], 'is_active' => true];
            if ($existing) {
                $existing->fill($payload);
                $existing->save(); // image left untouched
            } else {
                Slider::create($payload + ['page_key' => $sd['page_key'], 'order' => $sd['order'], 'image' => null]);
            }
        }

        echo "Uraz database seeded successfully!\n";
    }
}
