-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2020 at 12:41 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

/* SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; */
AUTOCOMMIT := 0;
START TRANSACTION;
time_zone := "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: basketball
--

-- --------------------------------------------------------

--
-- Table structure for table administrators
--

CREATE TABLE administrators (
  admins_id bigint CHECK (admins_id > 0) NOT NULL,
  admin_username varchar(50) NOT NULL,
  admin_email varchar(50) DEFAULT NULL,
  admin_email_verified_at timestamp(0) NULL DEFAULT NULL,
  admin_password varchar(255) NOT NULL,
  admin_user_type int NOT NULL DEFAULT 0,
  admin_fullname varchar(255) NOT NULL,
  remember_token varchar(100) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table administrators
--

INSERT INTO administrators (admins_id, admin_username, admin_email, admin_email_verified_at, admin_password, admin_user_type, admin_fullname, remember_token, created_at, updated_at) VALUES
(1, 'hashcode', NULL, NULL, '$2y$10$331wQcKCkKgd6rTz6VLIGeqGVtnZLDvd49WxOZBF2GKQVywAvsNRa', 1, 'Hashcode Group', 'vkktQje0BdUNBGHnhkMrGIueS0n30KBPmVB7AZaDLndFIeFMT5P270XOfT3R', '2019-10-20 14:17:23', '2019-10-20 14:17:23');

-- --------------------------------------------------------

--
-- Table structure for table allowances
--

CREATE TABLE allowances (
  allowance_id bigint CHECK (allowance_id > 0) NOT NULL,
  league_id int NOT NULL,
  leage_matches_id int NOT NULL,
  referee_id int NOT NULL,
  allowances_values_id int NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table allowances
--

INSERT INTO allowances (allowance_id, league_id, leage_matches_id, referee_id, allowances_values_id, created_at, updated_at) VALUES
(1, 1, 1, 1, 1, '2020-09-16 02:29:25', '2020-09-16 02:29:25'),
(2, 1, 1, 2, 1, '2020-09-16 02:29:25', '2020-09-16 02:29:25'),
(3, 1, 1, 3, 1, '2020-09-16 02:29:26', '2020-09-16 02:29:26'),
(4, 1, 1, 4, 1, '2020-09-16 02:29:26', '2020-09-16 02:29:26'),
(5, 1, 2, 1, 1, '2020-09-16 02:30:45', '2020-09-16 02:30:45'),
(6, 1, 2, 2, 1, '2020-09-16 02:30:45', '2020-09-16 02:30:45'),
(7, 1, 2, 4, 1, '2020-09-16 02:30:45', '2020-09-16 02:30:45'),
(8, 1, 2, 7, 1, '2020-09-16 02:30:45', '2020-09-16 02:30:45');

-- --------------------------------------------------------

--
-- Table structure for table allowances_values
--

CREATE TABLE allowances_values (
  allowances_values_id bigint CHECK (allowances_values_id > 0) NOT NULL,
  allowance_name varchar(255) NOT NULL,
  allowance_type enum('association','cairo_area','mini_basket') NOT NULL,
  city_from cast(11 as int) DEFAULT NULL,
  city_to cast(11 as int) DEFAULT NULL,
  league_id cast(11 as int) NOT NULL,
  referee_place cast(11 as int) NOT NULL,
  referee_type enum('International','First Division','Second Division','Third Division','Mini Basket') COLLATE utf8mb4_unicode_ci NOT NULL,
  arbitration_allowance cast(11 as int) NOT NULL,
  transition_allowance cast(11 as int) NOT NULL DEFAULT 0,
  subsistance_allowance cast(11 as int) NOT NULL DEFAULT 0,
  tournament_allowance cast(11 as int) NOT NULL DEFAULT 0,
  nutrition_allowance cast(11 as int) NOT NULL DEFAULT 0,
  period_value cast(11 as int) NOT NULL DEFAULT 0,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table allowances_values
--

INSERT INTO allowances_values (allowances_values_id, allowance_name, allowance_type, city_from, city_to, league_id, referee_place, referee_type, arbitration_allowance, transition_allowance, subsistance_allowance, tournament_allowance, nutrition_allowance, period_value, created_at, updated_at) VALUES
(1, 'Mahmoyd 3', 'cairo_area', 1, 255, 1, 1, 'International', 120, 30, 0, 0, 0, 0, '2020-09-02 00:14:18', '2020-09-02 00:14:18'),
(2, 'Mahmoyd', 'cairo_area', 1, 251, 1, 1, 'First Division', 120, 36, 0, 0, 0, 0, '2020-09-02 01:41:35', '2020-09-02 01:41:35'),
(3, 'Mahmoyd 2', 'mini_basket', 1, 268, 1, 2, 'Second Division', 0, 20, 0, 0, 20, 30, '2020-09-02 01:43:02', '2020-09-02 01:43:02'),
(4, 'Mahmoyd 4', 'mini_basket', 1, 257, 1, 2, 'Third Division', 0, 120, 0, 0, 30, 35, '2020-09-02 12:49:43', '2020-09-02 12:49:43'),
(5, 'Mahmoyd 5', 'cairo_area', 1, 266, 1, 1, 'Mini Basket', 120, 30, 0, 0, 0, 0, '2020-09-02 12:56:45', '2020-09-02 12:56:45'),
(7, 'Mahmoyd 6', 'association', 288, 19, 1, 1, 'International', 42, 24, 30, 50, 0, 0, '2020-09-02 14:11:08', '2020-09-02 14:15:16'),
(8, 'Mahmoyd 7', 'cairo_area', 1, 265, 1, 1, 'First Division', 120, 30, 0, 0, 0, 0, '2020-09-04 11:55:55', '2020-09-04 11:55:55'),
(9, 'Cairo Area 1', 'cairo_area', 1, 253, 1, 1, 'International', 23, 25, 0, 0, 0, 0, '2020-09-05 08:07:26', '2020-09-05 08:07:26'),
(10, 'Assoication 1', 'association', 1, 3, 1, 1, 'International', 20, 30, 40, 50, 0, 0, '2020-09-05 08:09:32', '2020-09-05 08:09:32');

-- --------------------------------------------------------

--
-- Table structure for table association_reports
--

CREATE TABLE association_reports (
  association_report_id bigint CHECK (association_report_id > 0) NOT NULL,
  referee_fullname_ar varchar(255) NOT NULL,
  referee_card_number int NOT NULL,
  match_date varchar(255) NOT NULL,
  refereeing_allowance double precision NOT NULL,
  transition_allowance double precision NOT NULL,
  subsistance_allowance double precision NOT NULL,
  tournament_allowance double precision NOT NULL,
  total_refereeing_allowance double precision NOT NULL,
  total_transition_allowance double precision NOT NULL,
  total_subsistance_allowance double precision NOT NULL,
  total_tournament_allowance double precision NOT NULL,
  total_amount double precision NOT NULL,
  ten_percent_taxes double precision NOT NULL,
  net_amount double precision NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table cairo_area_reports
--

CREATE TABLE cairo_area_reports (
  cairo_area_report_id bigint CHECK (cairo_area_report_id > 0) NOT NULL,
  referee_fullname_ar varchar(255) NOT NULL,
  referee_card_number int NOT NULL,
  match_date varchar(255) NOT NULL,
  refereeing_allowance double precision NOT NULL,
  transition_allowance double precision NOT NULL,
  total_transition_allowance double precision NOT NULL,
  total_refereeing_allowance double precision NOT NULL,
  total_amount double precision NOT NULL,
  ten_percent_taxes double precision NOT NULL,
  net_amount double precision NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table cities
--

CREATE TABLE cities (
  city_id bigint NOT NULL,
  gov_id bigint NOT NULL,
  city_name varchar(200) NOT NULL,
  city_name_en varchar(200) NOT NULL
) ;

--
-- Dumping data for table cities
--

INSERT INTO cities (city_id, gov_id, city_name, city_name_en) VALUES
(1, 1, 'القاهره', 'Cairo'),
(2, 2, 'الجيزة', 'Giza'),
(3, 2, 'السادس من أكتوبر', 'Sixth of October'),
(4, 2, 'الشيخ زايد', 'Cheikh Zayed'),
(5, 2, 'الحوامدية', 'Hawamdiyah'),
(6, 2, 'البدرشين', 'Al Badrasheen'),
(7, 2, 'الصف', 'Saf'),
(8, 2, 'أطفيح', 'Atfih'),
(9, 2, 'العياط', 'Al Ayat'),
(10, 2, 'الباويطي', 'Al-Bawaiti'),
(11, 2, 'منشأة القناطر', 'ManshiyetAl Qanater'),
(12, 2, 'أوسيم', 'Oaseem'),
(13, 2, 'كرداسة', 'Kerdasa'),
(14, 2, 'أبو النمرس', 'Abu Nomros'),
(15, 2, 'كفر غطاطي', 'Kafr Ghati'),
(16, 2, 'منشأة البكاري', 'Manshiyet Al Bakari'),
(17, 3, 'الأسكندرية', 'Alexandria'),
(18, 3, 'برج العرب', 'Burj Al Arab'),
(19, 3, 'برج العرب الجديدة', 'New Burj Al Arab'),
(20, 12, 'بنها', 'Banha'),
(21, 12, 'قليوب', 'Qalyub'),
(22, 12, 'شبرا الخيمة', 'Shubra Al Khaimah'),
(23, 12, 'القناطر الخيرية', 'Al Qanater Charity'),
(24, 12, 'الخانكة', 'Khanka'),
(25, 12, 'كفر شكر', 'Kafr Shukr'),
(26, 12, 'طوخ', 'Tukh'),
(27, 12, 'قها', 'Qaha'),
(28, 12, 'العبور', 'Obour'),
(29, 12, 'الخصوص', 'Khosous'),
(30, 12, 'شبين القناطر', 'Shibin Al Qanater'),
(31, 6, 'دمنهور', 'Damanhour'),
(32, 6, 'كفر الدوار', 'Kafr El Dawar'),
(33, 6, 'رشيد', 'Rashid'),
(34, 6, 'إدكو', 'Edco'),
(35, 6, 'أبو المطامير', 'Abu al-Matamir'),
(36, 6, 'أبو حمص', 'Abu Homs'),
(37, 6, 'الدلنجات', 'Delengat'),
(38, 6, 'المحمودية', 'Mahmoudiyah'),
(39, 6, 'الرحمانية', 'Rahmaniyah'),
(40, 6, 'إيتاي البارود', 'Itai Baroud'),
(41, 6, 'حوش عيسى', 'Housh Eissa'),
(42, 6, 'شبراخيت', 'Shubrakhit'),
(43, 6, 'كوم حمادة', 'Kom Hamada'),
(44, 6, 'بدر', 'Badr'),
(45, 6, 'وادي النطرون', 'Wadi Natrun'),
(46, 6, 'النوبارية الجديدة', 'New Nubaria'),
(47, 23, 'مرسى مطروح', 'Marsa Matrouh'),
(48, 23, 'الحمام', 'El Hamam'),
(49, 23, 'العلمين', 'Alamein'),
(50, 23, 'الضبعة', 'Dabaa'),
(51, 23, 'النجيلة', 'Al-Nagila'),
(52, 23, 'سيدي براني', 'Sidi Brani'),
(53, 23, 'السلوم', 'Salloum'),
(54, 23, 'سيوة', 'Siwa'),
(55, 19, 'دمياط', 'Damietta'),
(56, 19, 'دمياط الجديدة', 'New Damietta'),
(57, 19, 'رأس البر', 'Ras El Bar'),
(58, 19, 'فارسكور', 'Faraskour'),
(59, 19, 'الزرقا', 'Zarqa'),
(60, 19, 'السرو', 'alsaru'),
(61, 19, 'الروضة', 'alruwda'),
(62, 19, 'كفر البطيخ', 'Kafr El-Batikh'),
(63, 19, 'عزبة البرج', 'Azbet Al Burg'),
(64, 19, 'ميت أبو غالب', 'Meet Abou Ghalib'),
(65, 19, 'كفر سعد', 'Kafr Saad'),
(66, 4, 'المنصورة', 'Mansoura'),
(67, 4, 'طلخا', 'Talkha'),
(68, 4, 'ميت غمر', 'Mitt Ghamr'),
(69, 4, 'دكرنس', 'Dekernes'),
(70, 4, 'أجا', 'Aga'),
(71, 4, 'منية النصر', 'Menia El Nasr'),
(72, 4, 'السنبلاوين', 'Sinbillawin'),
(73, 4, 'الكردي', 'El Kurdi'),
(74, 4, 'بني عبيد', 'Bani Ubaid'),
(75, 4, 'المنزلة', 'Al Manzala'),
(76, 4, 'تمي الأمديد', 'tami al'amdid'),
(77, 4, 'الجمالية', 'aljamalia'),
(78, 4, 'شربين', 'Sherbin'),
(79, 4, 'المطرية', 'Mataria'),
(80, 4, 'بلقاس', 'Belqas'),
(81, 4, 'ميت سلسيل', 'Meet Salsil'),
(82, 4, 'جمصة', 'Gamasa'),
(83, 4, 'محلة دمنة', 'Mahalat Damana'),
(84, 4, 'نبروه', 'Nabroh'),
(85, 22, 'كفر الشيخ', 'Kafr El Sheikh'),
(86, 22, 'دسوق', 'Desouq'),
(87, 22, 'فوه', 'Fooh'),
(88, 22, 'مطوبس', 'Metobas'),
(89, 22, 'برج البرلس', 'Burg Al Burullus'),
(90, 22, 'بلطيم', 'Baltim'),
(91, 22, 'مصيف بلطيم', 'Masief Baltim'),
(92, 22, 'الحامول', 'Hamol'),
(93, 22, 'بيلا', 'Bella'),
(94, 22, 'الرياض', 'Riyadh'),
(95, 22, 'سيدي سالم', 'Sidi Salm'),
(96, 22, 'قلين', 'Qellen'),
(97, 22, 'سيدي غازي', 'Sidi Ghazi'),
(98, 8, 'طنطا', 'Tanta'),
(99, 8, 'المحلة الكبرى', 'Al Mahalla Al Kobra'),
(100, 8, 'كفر الزيات', 'Kafr El Zayat'),
(101, 8, 'زفتى', 'Zefta'),
(102, 8, 'السنطة', 'El Santa'),
(103, 8, 'قطور', 'Qutour'),
(104, 8, 'بسيون', 'Basion'),
(105, 8, 'سمنود', 'Samannoud'),
(106, 10, 'شبين الكوم', 'Shbeen El Koom'),
(107, 10, 'مدينة السادات', 'Sadat City'),
(108, 10, 'منوف', 'Menouf'),
(109, 10, 'سرس الليان', 'Sars El-Layan'),
(110, 10, 'أشمون', 'Ashmon'),
(111, 10, 'الباجور', 'Al Bagor'),
(112, 10, 'قويسنا', 'Quesna'),
(113, 10, 'بركة السبع', 'Berkat El Saba'),
(114, 10, 'تلا', 'Tala'),
(115, 10, 'الشهداء', 'Al Shohada'),
(116, 20, 'الزقازيق', 'Zagazig'),
(117, 20, 'العاشر من رمضان', 'Al Ashr Men Ramadan'),
(118, 20, 'منيا القمح', 'Minya Al Qamh'),
(119, 20, 'بلبيس', 'Belbeis'),
(120, 20, 'مشتول السوق', 'Mashtoul El Souq'),
(121, 20, 'القنايات', 'Qenaiat'),
(122, 20, 'أبو حماد', 'Abu Hammad'),
(123, 20, 'القرين', 'El Qurain'),
(124, 20, 'ههيا', 'Hehia'),
(125, 20, 'أبو كبير', 'Abu Kabir'),
(126, 20, 'فاقوس', 'Faccus'),
(127, 20, 'الصالحية الجديدة', 'El Salihia El Gedida'),
(128, 20, 'الإبراهيمية', 'Al Ibrahimiyah'),
(129, 20, 'ديرب نجم', 'Deirb Negm'),
(130, 20, 'كفر صقر', 'Kafr Saqr'),
(131, 20, 'أولاد صقر', 'Awlad Saqr'),
(132, 20, 'الحسينية', 'Husseiniya'),
(133, 20, 'صان الحجر القبلية', 'san alhajar alqablia'),
(134, 20, 'منشأة أبو عمر', 'Manshayat Abu Omar'),
(135, 18, 'بورسعيد', 'PorSaid'),
(136, 18, 'بورفؤاد', 'PorFouad'),
(137, 9, 'الإسماعيلية', 'Ismailia'),
(138, 9, 'فايد', 'Fayed'),
(139, 9, 'القنطرة شرق', 'Qantara Sharq'),
(140, 9, 'القنطرة غرب', 'Qantara Gharb'),
(141, 9, 'التل الكبير', 'El Tal El Kabier'),
(142, 9, 'أبو صوير', 'Abu Sawir'),
(143, 9, 'القصاصين الجديدة', 'Kasasien El Gedida'),
(144, 14, 'السويس', 'Suez'),
(145, 26, 'العريش', 'Arish'),
(146, 26, 'الشيخ زويد', 'Sheikh Zowaid'),
(147, 26, 'نخل', 'Nakhl'),
(148, 26, 'رفح', 'Rafah'),
(149, 26, 'بئر العبد', 'Bir al-Abed'),
(150, 26, 'الحسنة', 'Al Hasana'),
(151, 21, 'الطور', 'Al Toor'),
(152, 21, 'شرم الشيخ', 'Sharm El-Shaikh'),
(153, 21, 'دهب', 'Dahab'),
(154, 21, 'نويبع', 'Nuweiba'),
(155, 21, 'طابا', 'Taba'),
(156, 21, 'سانت كاترين', 'Saint Catherine'),
(157, 21, 'أبو رديس', 'Abu Redis'),
(158, 21, 'أبو زنيمة', 'Abu Zenaima'),
(159, 21, 'رأس سدر', 'Ras Sidr'),
(160, 17, 'بني سويف', 'Bani Sweif'),
(161, 17, 'بني سويف الجديدة', 'Beni Suef El Gedida'),
(162, 17, 'الواسطى', 'Al Wasta'),
(163, 17, 'ناصر', 'Naser'),
(164, 17, 'إهناسيا', 'Ehnasia'),
(165, 17, 'ببا', 'beba'),
(166, 17, 'الفشن', 'Fashn'),
(167, 17, 'سمسطا', 'Somasta'),
(168, 7, 'الفيوم', 'Fayoum'),
(169, 7, 'الفيوم الجديدة', 'Fayoum El Gedida'),
(170, 7, 'طامية', 'Tamiya'),
(171, 7, 'سنورس', 'Snores'),
(172, 7, 'إطسا', 'Etsa'),
(173, 7, 'إبشواي', 'Epschway'),
(174, 7, 'يوسف الصديق', 'Yusuf El Sediaq'),
(175, 11, 'المنيا', 'Minya'),
(176, 11, 'المنيا الجديدة', 'Minya El Gedida'),
(177, 11, 'العدوة', 'El Adwa'),
(178, 11, 'مغاغة', 'Magagha'),
(179, 11, 'بني مزار', 'Bani Mazar'),
(180, 11, 'مطاي', 'Mattay'),
(181, 11, 'سمالوط', 'Samalut'),
(182, 11, 'المدينة الفكرية', 'Madinat El Fekria'),
(183, 11, 'ملوي', 'Meloy'),
(184, 11, 'دير مواس', 'Deir Mawas'),
(185, 16, 'أسيوط', 'Assiut'),
(186, 16, 'أسيوط الجديدة', 'Assiut El Gedida'),
(187, 16, 'ديروط', 'Dayrout'),
(188, 16, 'منفلوط', 'Manfalut'),
(189, 16, 'القوصية', 'Qusiya'),
(190, 16, 'أبنوب', 'Abnoub'),
(191, 16, 'أبو تيج', 'Abu Tig'),
(192, 16, 'الغنايم', 'El Ghanaim'),
(193, 16, 'ساحل سليم', 'Sahel Selim'),
(194, 16, 'البداري', 'El Badari'),
(195, 16, 'صدفا', 'Sidfa'),
(196, 13, 'الخارجة', 'El Kharga'),
(197, 13, 'باريس', 'Paris'),
(198, 13, 'موط', 'Mout'),
(199, 13, 'الفرافرة', 'Farafra'),
(200, 13, 'بلاط', 'Balat'),
(201, 5, 'الغردقة', 'Hurghada'),
(202, 5, 'رأس غارب', 'Ras Ghareb'),
(203, 5, 'سفاجا', 'Safaga'),
(204, 5, 'القصير', 'El Qusiar'),
(205, 5, 'مرسى علم', 'Marsa Alam'),
(206, 5, 'الشلاتين', 'Shalatin'),
(207, 5, 'حلايب', 'Halaib'),
(208, 27, 'سوهاج', 'Sohag'),
(209, 27, 'سوهاج الجديدة', 'Sohag El Gedida'),
(210, 27, 'أخميم', 'Akhmeem'),
(211, 27, 'أخميم الجديدة', 'Akhmim El Gedida'),
(212, 27, 'البلينا', 'Albalina'),
(213, 27, 'المراغة', 'El Maragha'),
(214, 27, 'المنشأة', 'almunsha'a'),
(215, 27, 'دار السلام', 'Dar AISalaam'),
(216, 27, 'جرجا', 'Gerga'),
(217, 27, 'جهينة الغربية', 'Jahina Al Gharbia'),
(218, 27, 'ساقلته', 'Saqilatuh'),
(219, 27, 'طما', 'Tama'),
(220, 27, 'طهطا', 'Tahta'),
(221, 25, 'قنا', 'Qena'),
(222, 25, 'قنا الجديدة', 'New Qena'),
(223, 25, 'أبو تشت', 'Abu Tesht'),
(224, 25, 'نجع حمادي', 'Nag Hammadi'),
(225, 25, 'دشنا', 'Deshna'),
(226, 25, 'الوقف', 'Alwaqf'),
(227, 25, 'قفط', 'Qaft'),
(228, 25, 'نقادة', 'Naqada'),
(229, 25, 'فرشوط', 'Farshout'),
(230, 25, 'قوص', 'Quos'),
(231, 24, 'الأقصر', 'Luxor'),
(232, 24, 'الأقصر الجديدة', 'New Luxor'),
(233, 24, 'إسنا', 'Esna'),
(234, 24, 'طيبة الجديدة', 'New Tiba'),
(235, 24, 'الزينية', 'Al ziynia'),
(236, 24, 'البياضية', 'Al Bayadieh'),
(237, 24, 'القرنة', 'Al Qarna'),
(238, 24, 'أرمنت', 'Armant'),
(239, 24, 'الطود', 'Al Tud'),
(240, 15, 'أسوان', 'Aswan'),
(241, 15, 'أسوان الجديدة', 'Aswan El Gedida'),
(242, 15, 'دراو', 'Drau'),
(243, 15, 'كوم أمبو', 'Kom Ombo'),
(244, 15, 'نصر النوبة', 'Nasr Al Nuba'),
(245, 15, 'كلابشة', 'Kalabsha'),
(246, 15, 'إدفو', 'Edfu'),
(247, 15, 'الرديسية', 'Al-Radisiyah'),
(248, 15, 'البصيلية', 'Al Basilia'),
(249, 15, 'السباعية', 'Al Sibaeia'),
(250, 15, 'ابوسمبل السياحية', 'Abo Simbl Al Siyahia'),
(251, 1, 'مدينة 15 مايو', '15th of May City'),
(252, 1, 'حي عابدين', 'Abidin'),
(253, 1, 'حي الدرب الأحمر', 'Al-Darb Al-Ahmar'),
(254, 1, 'حي عين شمس', 'Ain Schams'),
(255, 1, 'حي الاميريه', 'Al-Amiriah'),
(256, 1, 'حي الأزبكية', 'Al-Azbakiyah'),
(257, 1, 'حي البساتين', 'Al-Basatin'),
(258, 1, 'حي الجمالية', 'Al-Jamaliyah'),
(259, 1, 'حي الخليفة', 'Al-Khalifah'),
(260, 1, 'حي المعادي', 'Al-Maadi'),
(261, 1, 'حي المرج', 'Al-Marj'),
(262, 1, 'حي المعصره', 'Al-Ma'ṣarah'),
(263, 1, 'حي المطرية', 'Al-Maṭariyah'),
(264, 1, 'حي المقطم', 'Al-Muqaṭṭam'),
(265, 1, 'حي الموسكي', 'Al-Muski'),
(266, 1, 'حي التجمع الاول', 'The first settlement'),
(267, 1, 'حي التجمع الثالث', 'The third settlement'),
(268, 1, 'حي التجمع الخامس', 'The fifth settlement'),
(269, 1, 'حي الرحاب', 'Al-Rehab'),
(270, 1, 'حي جاردن سيتي', 'Garden City'),
(271, 1, 'حي الوايلي', 'Al-Wayli'),
(272, 1, 'حي النزهة', 'Al-Nuzhah'),
(273, 1, 'حي الشرابية', 'Al-Sharabiyah'),
(274, 1, 'حي الشروق', 'Al-Sherouk'),
(275, 1, 'حي شبرا', 'Shubra'),
(276, 1, 'حي السلام', 'Al-Salam'),
(277, 1, 'حي السيدة زينب', 'Al-Sayyidah Zaynab'),
(278, 1, 'حي التبين', 'Al-Tibbin'),
(279, 1, 'حي الظاهر', 'Al-Ẓahir'),
(280, 1, 'حي الزمالك', 'Al-Zamalek'),
(281, 1, 'حي الزاوية الحمراء', 'Al-Zawiyah Al-Ḥamra''),
(282, 1, 'حي الزيتون', 'Al-Zeitoun'),
(283, 1, 'حي باب الشعرية', 'Bab Al-Sha'riyah'),
(284, 1, 'حي بولاق', 'Bulaq'),
(285, 1, 'حي دار السلام', 'Dar Al-Salam'),
(286, 1, 'حي حدائق القبة', 'Hada'iq al-Qubbah'),
(287, 1, 'حي حلوان', 'Helwan'),
(288, 1, 'مدينة نصر', 'Nasr City'),
(289, 1, 'مدينة بدر', 'Badr City'),
(290, 1, 'حي مصر الجديدة', 'Miṣr Al-Jadidah'),
(291, 1, 'حي مصر القديمة', 'Misr Al-Qadimah'),
(292, 1, 'حي منشأة ناصر', 'Manshiyat Naser'),
(293, 1, 'حي روض الفرج', 'Rod El Farag'),
(294, 1, 'حي طره', 'Turah'),
(295, 1, 'حي المنيل', 'Manial'),
(296, 1, 'حي السكاكيني', 'El Sakkakini'),
(297, 1, 'مدينتي', 'Madinaty'),
(298, 1, 'حي الفجالة', 'Faggala'),
(299, 2, 'حي العجوزة', 'Agouza');

-- --------------------------------------------------------

--
-- Table structure for table exams
--

CREATE TABLE exams (
  exam_id bigint CHECK (exam_id > 0) NOT NULL,
  exam_title varchar(255) DEFAULT NULL,
  exam_slug varchar(255) DEFAULT NULL,
  exam_description longtext DEFAULT NULL,
  exam_time_min varchar(255) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table exams
--

INSERT INTO exams (exam_id, exam_title, exam_slug, exam_description, exam_time_min, created_at, updated_at) VALUES
(7, 'Test Exam', 'Test-Exam', '<p><em><strong>Test-Exam</strong></em></p>', '60', '2019-10-24 15:54:47', '2019-10-24 16:45:21');

-- --------------------------------------------------------

--
-- Table structure for table exam_answers
--

CREATE TABLE exam_answers (
  exam_answer_id bigint CHECK (exam_answer_id > 0) NOT NULL,
  referee_id int DEFAULT NULL,
  exam_id int DEFAULT NULL,
  question_id int DEFAULT NULL,
  text_option varchar(255) DEFAULT NULL,
  answer_score varchar(255) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table exam_answers
--

INSERT INTO exam_answers (exam_answer_id, referee_id, exam_id, question_id, text_option, answer_score, created_at, updated_at) VALUES
(13, 2, 7, 9, NULL, '0', '2019-10-24 15:55:30', '2019-10-24 15:55:30'),
(14, 2, 7, 10, NULL, '30', '2019-10-24 15:55:34', '2019-10-24 15:55:34'),
(15, 2, 7, 11, 'ytuytu', '0', '2019-10-24 16:10:34', '2019-10-24 16:20:51'),
(16, 2, 7, 12, 'afredsgsf', '0', '2019-10-24 16:37:59', '2019-10-24 16:41:13'),
(17, 2, 7, 13, 'dftgyhjuikl;', '0', '2019-10-24 16:40:08', '2019-10-24 16:40:08'),
(18, 1, 7, 9, NULL, '30', '2020-02-11 22:57:10', '2020-02-11 22:57:10'),
(19, 1, 7, 10, NULL, '0', '2020-02-11 22:57:14', '2020-02-11 22:57:14'),
(20, 1, 7, 11, 'hzhsh', '0', '2020-02-11 22:57:23', '2020-02-11 22:57:23');

-- --------------------------------------------------------

--
-- Table structure for table exam_answer_options
--

CREATE TABLE exam_answer_options (
  exam_answer_option_id bigint CHECK (exam_answer_option_id > 0) NOT NULL,
  exam_answer_id int DEFAULT NULL,
  option_id int DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table exam_answer_options
--

INSERT INTO exam_answer_options (exam_answer_option_id, exam_answer_id, option_id, created_at, updated_at) VALUES
(323, 13, 17, '2019-10-24 16:45:34', '2019-10-24 16:45:34'),
(324, 14, 18, '2019-10-24 16:45:35', '2019-10-24 16:45:35'),
(325, 14, 19, '2019-10-24 16:45:35', '2019-10-24 16:45:35'),
(326, 14, 20, '2019-10-24 16:45:35', '2019-10-24 16:45:35'),
(327, 18, 15, '2020-02-11 22:57:10', '2020-02-11 22:57:10'),
(328, 19, 18, '2020-02-11 22:57:14', '2020-02-11 22:57:14'),
(329, 19, 19, '2020-02-11 22:57:14', '2020-02-11 22:57:14');

-- --------------------------------------------------------

--
-- Table structure for table exam_questions
--

CREATE TABLE exam_questions (
  exam_question_id bigint CHECK (exam_question_id > 0) NOT NULL,
  exam_id int DEFAULT NULL,
  question_id int DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table exam_questions
--

INSERT INTO exam_questions (exam_question_id, exam_id, question_id, created_at, updated_at) VALUES
(34, 7, 9, '2019-10-24 15:55:15', '2019-10-24 15:55:15'),
(35, 7, 10, '2019-10-24 15:55:15', '2019-10-24 15:55:15'),
(36, 7, 11, '2019-10-24 15:55:15', '2019-10-24 15:55:15'),
(37, 7, 12, '2019-10-24 15:55:15', '2019-10-24 15:55:15'),
(38, 7, 13, '2019-10-24 15:55:15', '2019-10-24 15:55:15');

-- --------------------------------------------------------

--
-- Table structure for table exam_referees
--

CREATE TABLE exam_referees (
  exam_referee_id bigint CHECK (exam_referee_id > 0) NOT NULL,
  exam_id int DEFAULT NULL,
  referee_id int DEFAULT NULL,
  exam_status int DEFAULT 0,
  exam_started_at varchar(255) DEFAULT NULL,
  exam_ended_at varchar(255) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table exam_referees
--

INSERT INTO exam_referees (exam_referee_id, exam_id, referee_id, exam_status, exam_started_at, exam_ended_at, created_at, updated_at) VALUES
(44, 7, 1, 2, '1581440212883', '1581440269775', '2019-10-24 15:55:00', '2020-02-11 22:57:49'),
(45, 7, 2, 2, '1571914527361', '1571918128200', '2019-10-24 15:55:00', '2019-10-24 16:55:28'),
(46, 7, 3, 0, NULL, NULL, '2019-10-24 15:55:00', '2019-10-24 15:55:00');

-- --------------------------------------------------------

--
-- Table structure for table failed_jobs
--

CREATE TABLE failed_jobs (
  id bigint CHECK (id > 0) NOT NULL,
  connection text NOT NULL,
  queue text NOT NULL,
  payload longtext NOT NULL,
  exception longtext NOT NULL,
  failed_at timestamp(0) NOT NULL DEFAULT current_timestamp()
)  ;

-- --------------------------------------------------------

--
-- Table structure for table governorates
--

CREATE TABLE governorates (
  gov_id bigint NOT NULL,
  governorate_name varchar(50) NOT NULL,
  governorate_name_en varchar(50) NOT NULL
) ;

--
-- Dumping data for table governorates
--

INSERT INTO governorates (gov_id, governorate_name, governorate_name_en) VALUES
(1, 'القاهرة', 'Cairo'),
(2, 'الجيزة', 'Giza'),
(3, 'الأسكندرية', 'Alexandria'),
(4, 'الدقهلية', 'Dakahlia'),
(5, 'البحر الأحمر', 'Red Sea'),
(6, 'البحيرة', 'Beheira'),
(7, 'الفيوم', 'Fayoum'),
(8, 'الغربية', 'Gharbiya'),
(9, 'الإسماعلية', 'Ismailia'),
(10, 'المنوفية', 'Monofia'),
(11, 'المنيا', 'Minya'),
(12, 'القليوبية', 'Qaliubiya'),
(13, 'الوادي الجديد', 'New Valley'),
(14, 'السويس', 'Suez'),
(15, 'اسوان', 'Aswan'),
(16, 'اسيوط', 'Assiut'),
(17, 'بني سويف', 'Beni Suef'),
(18, 'بورسعيد', 'Port Said'),
(19, 'دمياط', 'Damietta'),
(20, 'الشرقية', 'Sharkia'),
(21, 'جنوب سيناء', 'South Sinai'),
(22, 'كفر الشيخ', 'Kafr Al sheikh'),
(23, 'مطروح', 'Matrouh'),
(24, 'الأقصر', 'Luxor'),
(25, 'قنا', 'Qena'),
(26, 'شمال سيناء', 'North Sinai'),
(27, 'سوهاج', 'Sohag');

-- --------------------------------------------------------

--
-- Table structure for table halls
--

CREATE TABLE halls (
  hall_id bigint CHECK (hall_id > 0) NOT NULL,
  hall_name varchar(255) NOT NULL,
  hall_place int DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table halls
--

INSERT INTO halls (hall_id, hall_name, hall_place, created_at, updated_at) VALUES
(1, 'Hall 1 Cairo Stadium', 1, '2020-08-21 14:56:54', '2020-08-21 15:40:53'),
(2, 'Hall 2 Cairo Stadium', 1, '2020-08-21 15:40:27', '2020-08-21 15:40:27'),
(3, 'Hall 1 6th October', 3, '2020-09-05 08:18:42', '2020-09-05 08:18:42');

-- --------------------------------------------------------

--
-- Table structure for table leage_matches
--

CREATE TABLE leage_matches (
  leage_matches_id bigint CHECK (leage_matches_id > 0) NOT NULL,
  league_id int DEFAULT NULL,
  home_team int DEFAULT NULL,
  away_team int DEFAULT NULL,
  match_hall int DEFAULT NULL,
  match_date varchar(255) DEFAULT NULL,
  score_sheet_image varchar(255) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table leage_matches
--

INSERT INTO leage_matches (leage_matches_id, league_id, home_team, away_team, match_hall, match_date, score_sheet_image, created_at, updated_at) VALUES
(1, 1, 3, 4, 1, '05 September 2020 - 23:40', NULL, '2020-09-16 02:29:25', '2020-09-16 02:29:25'),
(2, 1, 5, 6, 2, '29 October 2020 - 01:25', NULL, '2020-09-16 02:30:45', '2020-09-16 02:30:45');

-- --------------------------------------------------------

--
-- Table structure for table leagues
--

CREATE TABLE leagues (
  league_id bigint CHECK (league_id > 0) NOT NULL,
  league_name varchar(255) DEFAULT NULL,
  league_start_date varchar(255) DEFAULT NULL,
  league_end_date varchar(255) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table leagues
--

INSERT INTO leagues (league_id, league_name, league_start_date, league_end_date, created_at, updated_at) VALUES
(1, 'NBA', '01 December 2020 - 02:00', '01 December 2021 - 02:00', '2019-10-20 21:44:29', '2020-09-05 22:10:15');

-- --------------------------------------------------------

--
-- Table structure for table leagues_teams
--

CREATE TABLE leagues_teams (
  leagues_teams_id bigint CHECK (leagues_teams_id > 0) NOT NULL,
  team_id int NOT NULL,
  league_id int NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table leagues_teams
--

INSERT INTO leagues_teams (leagues_teams_id, team_id, league_id, created_at, updated_at) VALUES
(1, 3, 1, '2020-08-23 05:52:10', '2020-08-23 05:52:10'),
(2, 4, 1, '2020-08-23 05:52:35', '2020-08-23 05:52:35'),
(3, 5, 1, '2020-09-05 22:11:43', '2020-09-05 22:11:43'),
(4, 6, 1, '2020-09-05 22:11:51', '2020-09-05 22:11:51');

-- --------------------------------------------------------

--
-- Table structure for table matches_referees
--

CREATE TABLE matches_referees (
  matches_referee_id bigint CHECK (matches_referee_id > 0) NOT NULL,
  leage_matches_id int DEFAULT NULL,
  referee_id int DEFAULT NULL,
  referee_role_id int DEFAULT NULL,
  match_acceptance enum('pending','decline','accept') NOT NULL DEFAULT 'pending',
  match_decline_reason longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  match_confirmation tinyint(1) DEFAULT 0,
  match_verification tinyint(1) NOT NULL DEFAULT 0,
  num_of_periods double(8,2) NOT NULL DEFAULT 0.00,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table matches_referees
--

INSERT INTO matches_referees (matches_referee_id, leage_matches_id, referee_id, referee_role_id, match_acceptance, match_decline_reason, match_confirmation, match_verification, num_of_periods, created_at, updated_at) VALUES
(1, 1, 1, 1, 'pending', NULL, 0, 0, 0.00, '2020-09-16 02:29:25', '2020-09-16 02:29:25'),
(2, 1, 2, 2, 'pending', NULL, 0, 0, 0.00, '2020-09-16 02:29:25', '2020-09-16 02:29:25'),
(3, 1, 3, 4, 'pending', NULL, 0, 0, 0.00, '2020-09-16 02:29:25', '2020-09-16 02:29:25'),
(4, 1, 4, 6, 'pending', NULL, 0, 0, 0.00, '2020-09-16 02:29:25', '2020-09-16 02:29:25'),
(5, 2, 1, 1, 'pending', NULL, 0, 0, 0.00, '2020-09-16 02:30:45', '2020-09-16 02:30:45'),
(6, 2, 2, 2, 'pending', NULL, 0, 0, 0.00, '2020-09-16 02:30:45', '2020-09-16 02:30:45'),
(7, 2, 4, 4, 'pending', NULL, 0, 0, 0.00, '2020-09-16 02:30:45', '2020-09-16 02:30:45'),
(8, 2, 7, 6, 'pending', NULL, 0, 0, 0.00, '2020-09-16 02:30:45', '2020-09-16 02:30:45');

-- --------------------------------------------------------

--
-- Table structure for table migrations
--

CREATE TABLE migrations (
  id int CHECK (id > 0) NOT NULL,
  migration varchar(255) NOT NULL,
  batch int NOT NULL
)  ;

--
-- Dumping data for table migrations
--

INSERT INTO migrations (id, migration, batch) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_09_22_110612_create_admins_table', 1),
(5, '2019_09_23_103859_create_referees_table', 1),
(6, '2019_10_15_014911_create_teams_table', 1),
(7, '2019_10_15_014958_create_leagues_table', 1),
(8, '2019_10_15_095729_create_leagues_teams_table', 1),
(9, '2019_10_15_141853_create_halls_table', 1),
(10, '2019_10_15_153808_create_leage_matches_table', 1),
(11, '2019_10_16_091723_create_news_table', 1),
(12, '2019_10_16_103238_create_questions_table', 1),
(13, '2019_10_16_104041_create_questions_options_table', 1),
(14, '2019_10_17_153537_create_exams_table', 1),
(15, '2019_10_17_170054_create_exam_questions_table', 1),
(16, '2019_10_17_170343_create_exam_referees_table', 1),
(17, '2019_10_20_135513_create_exam_answers_table', 1),
(19, '2020_08_19_193301_create_allowances_value_table', 2),
(21, '2020_08_23_123029_create_allowances_table', 3),
(22, '2020_08_25_133253_create_notifications_table', 4),
(23, '2020_09_03_180301_create_referee_places_table', 5),
(24, '2020_09_03_180433_create_referee_roles_table', 6),
(25, '2020_08_21_155600_create_reports_table', 7),
(26, '2020_09_05_225636_create_mini_basket_reports_table', 8),
(27, '2020_09_06_013309_create_cairo_area_reports_table', 9),
(28, '2020_09_06_015817_create_association_reports_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table mini_basket_reports
--

CREATE TABLE mini_basket_reports (
  mini_basket_report_id bigint CHECK (mini_basket_report_id > 0) NOT NULL,
  referee_fullname_ar varchar(255) NOT NULL,
  referee_card_number int NOT NULL,
  match_date varchar(255) NOT NULL,
  period_value double precision NOT NULL,
  num_of_periods double precision NOT NULL,
  league_name varchar(255) NOT NULL,
  feeding_allowance double precision NOT NULL,
  transition_allowance double precision NOT NULL,
  total_number_of_periods double precision NOT NULL,
  total_value_of_the_periods double precision NOT NULL,
  total_transition_allowance double precision NOT NULL,
  total_feeding_allowance double precision NOT NULL,
  total_feeding_days double precision NOT NULL,
  total_amount double precision NOT NULL,
  ten_percent_taxes double precision NOT NULL,
  net_amount double precision NOT NULL,
  total double precision NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table news
--

CREATE TABLE news (
  new_id bigint CHECK (new_id > 0) NOT NULL,
  new_title varchar(255) DEFAULT NULL,
  new_description longtext DEFAULT NULL,
  new_image varchar(255) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table news
--

INSERT INTO news (new_id, new_title, new_description, new_image, created_at, updated_at) VALUES
(1, 'الاتحاد الدولي يختار علي خليفة للمشاركة في معسكر BWB', 'تلقى الإتحاد المصري لكرة السلة خطابًا من الرابطة الوطنية لكرة السلة الأمريكية NBA اليوم الثلاثاء يعلن فيه إختيار اللاعب علي خليفة للمشاركة في معسكر النسخة الخامسة من BWB تحت إشراف الرابطة والاتحاد الدولي لكرة السلة FIBA.rnrnويتم إختيار كل لاعب للمشاركة في هذا المعسكر بناءً على مهاراته المتميزة في اللعبة وقدراته القيادية داخل أرض الملعب.rnrnوأقامت الرابطة الوطنية لكرة السلة الأمريكية (NBA) و الاتحاد الدولى لكرة السلة (FIBA) معسكر BWB في 35 مدينة في 28 دولة في ست قارات منذ عام 2001 ، وتم تصعيد 53 من خريجي BWB للعب في الـ NBA', 'public/news_images/1571749741-الاتحاد الدولي يختار علي خليفة للمشاركة في معسكر BWB.png', '2019-10-22 18:06:40', '2019-10-22 18:09:01'),
(2, 'فوز النادي الأهلي بكأس بطولة الممتاز “أ” رجال والمرتبط', 'فاز اليوم 25 ديسمبر 2018 النادي الأهلي ببطولة الممتاز “أ” رجال والمرتبط بالمرحلة السنية 16 سنة بعد فوز فريق المرتبط للنادي الأهلي على نظيره نادي الاتحاد في مبارتين يومي 24 ، 25 ديسمبر 2018 أما فريق الرجال للنادي الأهلي فاز على نظيره نادي الاتحاد السكندري في مباراة واحدة يوم 24 ديسمبر 2018 ثم خسر في مباراة يوم 25 ديسمبر 2018 .rnوالجدير بالذكر فوز نادي الاتحاد السكندري بالمركز الثاني ، وحصل نادي الجزيرة على المركز الثالث .', 'public/news_images/1571749681-فوز النادي الأهلي بكأس بطولة الممتاز “أ” رجال والمرتبط.jpg', '2019-10-22 18:08:01', '2019-10-22 18:08:01'),
(3, 'دعوة أندية الممتاز لاجتماع مع قيادات الامن لبحث تنظيم دخول الجماهير', 'أرسل الاتحاد المصري لكرة السلة برئاسة الدكتور مجدي أبو فريخة خطابًا لأندية الممتاز من أجل دعوة ممثليهم لاجتماع بحضور مسئولي وزارة الداخلية لبحث ملف تنظيم دخول الجماهير في أقرب وقت خلال مسابقات الاتحاد .', 'public/news_images/1571749830-دعوة أندية الممتاز لاجتماع مع قيادات الامن لبحث تنظيم دخول الجماهير.jpg', '2019-10-22 18:10:30', '2019-10-22 18:10:30'),
(4, 'الاتحاد المصري يرفض اتهام اللاعب عاصم مرعي بالتهرب من الانضمام للمنتخب', 'أكد الدكتور مجدي أبو فريخة رئيس الاتحاد المصري لكرة السلة على ثقته في انتماء اللاعب عاصم مرعي المحترف بالدوري التركي ورغبته الدائمة في ارتداء قميص منتخب بلاده.rnورفض رئيس الاتحاد الاتهامات الموجهة إلى اللاعب بأنه تقاعس عن تمثيل المنتخب المصري في المرحلة الخامسة من التصفيات الأفريقية المؤهلة لكأس العالم 2019 بالصين والتي أقيمت في أنجولا.rnوشدد أبو فريخة ان مجلس الادارة بالكامل يثق في لاعبه الدولي وأن عاصم مرعي لم يتأخر يومًا عن تلبية نداء المنتخب الوطني في أي مباراة منذ أن بدأ ممارسة اللعبة وأن الإصابة كانت السبب وراء عدم انضمامه رفقة زملاءه في التصفيات الأخيرة متمنيًا له التوفيق مع ناديه التركي في الفترة المقبلة.', 'public/news_images/1571749887-الاتحاد المصري يرفض اتهام اللاعب عاصم مرعي بالتهرب من الانضمام للمنتخب.png', '2019-10-22 18:11:27', '2019-10-22 18:11:27'),
(5, 'انطلاق بطولة كأس مصر لكرة السلة نوفمبر المقبل', 'xyz', 'public/news_images/1571840576-انطلاق بطولة كأس مصر لكرة السلة نوفمبر المقبل.gif', '2019-10-23 19:20:22', '2020-06-23 17:07:49'),
(6, 'minibasket online', 'online session', 'public/news_images/1591187671-minibasket online.jpg', '2020-06-03 17:34:31', '2020-06-03 17:34:31');

-- --------------------------------------------------------

--
-- Table structure for table notifications
--

CREATE TABLE notifications (
  notification_id bigint CHECK (notification_id > 0) NOT NULL,
  referee_id int NOT NULL,
  message text NOT NULL,
  read_at timestamp(0) NULL DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table notifications
--

INSERT INTO notifications (notification_id, referee_id, message, read_at, created_at, updated_at) VALUES
(1, 5, ' Declines The Match...Please Look At Another Referee', '2020-09-03 13:21:00', '2020-08-29 13:31:22', '2020-09-03 13:21:00'),
(3, 5, ' Declines The Match...Please Look At Another Referee', '2020-09-03 13:21:00', '2020-09-03 13:01:59', '2020-09-03 13:21:00'),
(4, 5, ' Declines The Match...Please Look At Another Referee', '2020-09-03 13:21:00', '2020-09-03 13:14:00', '2020-09-03 13:21:00');

-- --------------------------------------------------------

--
-- Table structure for table password_resets
--

CREATE TABLE password_resets (
  email varchar(255) NOT NULL,
  token varchar(255) NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table questions
--

CREATE TABLE questions (
  question_id bigint CHECK (question_id > 0) NOT NULL,
  question_content varchar(255) DEFAULT NULL,
  question_file varchar(255) DEFAULT NULL,
  question_score varchar(255) DEFAULT NULL,
  question_type int DEFAULT NULL,
  file_type int DEFAULT NULL,
  file_extention varchar(255) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table questions
--

INSERT INTO questions (question_id, question_content, question_file, question_score, question_type, file_type, file_extention, created_at, updated_at) VALUES
(9, 'what is single Choice?', NULL, '30', 0, NULL, NULL, '2019-10-24 15:51:15', '2019-10-24 15:51:15'),
(10, 'what is multiple Choice?', NULL, '30', 1, NULL, NULL, '2019-10-24 15:52:04', '2019-10-24 15:52:04'),
(11, 'what is Text Question?', NULL, '30', 2, NULL, NULL, '2019-10-24 15:52:44', '2019-10-24 15:52:44'),
(12, 'what is Video question?', NULL, '30', 3, NULL, NULL, '2019-10-24 15:53:32', '2019-10-24 15:53:32'),
(13, 'what is Image Question?', 'public/question_file/1571914453.gif', '30', 4, 1, 'gif', '2019-10-24 15:54:13', '2019-10-24 15:54:13');

-- --------------------------------------------------------

--
-- Table structure for table questions_options
--

CREATE TABLE questions_options (
  option_id bigint CHECK (option_id > 0) NOT NULL,
  question_id int NOT NULL,
  option_text varchar(255) DEFAULT NULL,
  option_url varchar(255) DEFAULT NULL,
  option_correct int DEFAULT 0,
  option_type int DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table questions_options
--

INSERT INTO questions_options (option_id, question_id, option_text, option_url, option_correct, option_type, created_at, updated_at) VALUES
(15, 9, 'what is Option text 1?', NULL, 1, 0, '2019-10-24 15:51:15', '2019-10-24 15:51:15'),
(16, 9, 'what is Option text 2?', NULL, 0, 0, '2019-10-24 15:51:15', '2019-10-24 15:51:15'),
(17, 9, 'what is Option text 3?', NULL, 0, 0, '2019-10-24 15:51:15', '2019-10-24 15:51:15'),
(18, 10, 'what is Option multiple text 1?', NULL, 1, 1, '2019-10-24 15:52:04', '2019-10-24 15:52:04'),
(19, 10, 'what is Option multiple text 2?', NULL, 0, 1, '2019-10-24 15:52:04', '2019-10-24 15:52:04'),
(20, 10, 'what is Option multiple text 3?', NULL, 1, 1, '2019-10-24 15:52:04', '2019-10-24 15:52:04'),
(21, 11, 'what is Text question  text ?', NULL, 1, 2, '2019-10-24 15:52:44', '2019-10-24 15:52:44'),
(22, 12, 'what is Option text video?', 'https://www.youtube.com/watch?v=0g2Mc_WNXCM', 1, 3, '2019-10-24 15:53:32', '2019-10-24 15:53:32'),
(23, 13, 'what is Option text Image?', NULL, 1, 4, '2019-10-24 15:54:13', '2019-10-24 15:54:13');

-- --------------------------------------------------------

--
-- Table structure for table referees
--

CREATE TABLE referees (
  referee_id bigint CHECK (referee_id > 0) NOT NULL,
  referee_username varchar(50) NOT NULL,
  referee_mobile varchar(12) NOT NULL,
  referee_email varchar(50) DEFAULT NULL,
  refree_password varchar(255) NOT NULL,
  referee_fullname varchar(255) DEFAULT NULL,
  referee_fullname_ar varchar(255) CHARACTER SET utf8 NOT NULL,
  referee_address varchar(255) DEFAULT NULL,
  gov_id bigint NOT NULL,
  city_id bigint NOT NULL,
  device_token varchar(255) DEFAULT NULL,
  referee_birthday date DEFAULT NULL,
  referee_nationl_identity varchar(255) DEFAULT NULL,
  referee_identity varchar(255) DEFAULT NULL,
  referee_card_number bigint DEFAULT NULL,
  referee_image varchar(255) DEFAULT NULL,
  referee_type varchar(255) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table referees
--

INSERT INTO referees (referee_id, referee_username, referee_mobile, referee_email, refree_password, referee_fullname, referee_fullname_ar, referee_address, gov_id, city_id, device_token, referee_birthday, referee_nationl_identity, referee_identity, referee_card_number, referee_image, referee_type, created_at, updated_at) VALUES
(1, 'test', '01027910756', 'test@test.c', '$2y$10$o0u6SKiOpff19iB8szZKS.hB4jIxBsRMm/GhCqrtdrXa1AYIJ/nF6', 'ahmed mohamed', 'احمد محمد', 'asdfggewdf', 1, 1, 'dpyr4Gqe10gqgO7RERU0zN:APA91bFzgVCUWOiXa5ti7tdHHXK7r8E25L5poZExDDP1BminsxGO-Bh4ZYrPpkWRRT1c9ty0BO69z6l3rvadBXB1AITmMOYNWJzi9ZPAII7_fyF4vm75qDiN8o9M7gnXpthHyStcYd6i', '1970-01-20', '1234567898765', 'sdfgnhgfdf', 0, 'referee_image/1571589319moha_2.jpg', 'First Division', '2019-10-20 21:35:19', '2020-02-11 22:54:32'),
(2, 'demo', '01012345678', 'moh@hashcode.me', '$2y$10$nVDLsv4oh.0OITUKVgea/uD/p4qMVdlcL6NRT.8ska.m.CY3MB3BC', 'Hashcode Refree', 'هاش كود', 'fdgfdgfdgfd', 1, 1, 'jID0evAOZ8lr07IYgCvuBjRvIZf27vONDy98wf1YZqxSGv9hQYANYl5F4fwDqF4zntrUVeqw4bGeRv5eIKwYAc3eMp6HjSQEeOpxHtHe8qBNaekKt3wGmnpzi3u1Ux9dSZEfT6va0OqtbgRx47oqpC0xVhzKLsFyHg5YcM0boL4M3z0wUX0cjSGzPd3jauJo7y37ZSqnAK2GVD893wjuaunwdpadCJraxx0AH8UNJYIvJAtZmzVlgCzDAsqH0n5', '1981-07-08', '25482145236525', '123', 0, NULL, 'International', '2019-10-22 22:12:28', '2019-10-23 23:01:19'),
(3, 'asdf', '01234567891', 'moh@hashcode.mee', '$2y$10$ET4VmXlo1dNZYTyyzXgedOoKAAJzR1q7ARahhsjeziN1S36R7NJQm', 'asdf asdgfds', 'بيليبل', 'vcbcvbvcbvcb', 1, 1, 'CaHohwyX42bJsyRKXsM6WMc0xO1alkbW6aVxrGeDtn1ZwB2NNvaWyGh1vLuGSeEF6EUgOZEVJr3jjLEOagJlx3kJvMDUTyfVjauijbVRjtXeDK6Xg4yh2NYXrYtvV9qThtOtz1xlwkgRgZb3612x3Nr1Ibuatc3wdx12c0H8IUolKq8kQYX3jWhcmIcbcBkaRfaZKcesNbUetHH7oUQwIKX4uxDiX7M2SzmbsupaK7F1I94zu4mbbHvPBpDArgZ', '1980-08-14', '123456789', '111', 0, 'referee_image/1597675065asdf.jpg', 'International', '2019-10-22 22:31:40', '2020-08-17 12:37:45'),
(4, 'mahmoudelshall', '01285970246', 'mahmoudelshall@outlook.com', '$2y$10$k5H19nFsMKXfrH4RCYfsv.ThIu9zdr4m/6S5D3g80kgjBU3d5kBCu', 'Mahmoud Ahmed El-Shall', 'محمود احمد الشال', 'st hassan khattab', 8, 98, 'SGNB9TL4ekJZS3TOtH460I5pzdqMxlmEgQVUlOXMu0F1nddBssZYdI9FhgS7ujqgFqAs0f6QskRKeFlQiGPaOaCiOFY1oJhnSTTWmLVTLSAtjZsFqEg1kY5OduXkMsz0Vv9kJyPOSF398PHnFO8CYQL4dKvwlk0PyT3cZu5XxPO5XJhdliqq9466JuDHcKal8akStpHfEpdVrgebHWsOkvzPmL83QPTusz0a2KMKLbposNr41XlH76cZpytizAt', '1996-10-12', NULL, NULL, 0, 'referee_image/1597675359mahmoudelshall.jpg', 'International', '2020-08-17 12:32:05', '2020-08-17 12:42:39'),
(5, 'mohamedabdo', '01285970249', 'mohamedabdo@example.com', '$2y$10$0qbAzbc7hryqZ9xKt141zOmU8pciMMmPJZlkiaAaHKAPNRB0mFl0.', 'Mohamed Abd El-Hamid', 'محمد احمد عبد الحميد', 'trtrasdsa', 1, 265, 'fFXHlpDodRE:APA91bGF7WW_4OSA95h5Dct7-04GcV2tbRlTWmUfF7r0T13uwk2Cd8pZm0e5kSW-8nBPe5Xmn4rM7izWHFIXwWDcWlCQy5j081iogI6kcGurpn9VfhrE6FQbGTAu1WXQ7vAZwm_2TX6N', '1970-01-31', '1901541', '545', 0, 'referee_image/1598486707mohamedabdo.jpg', 'International', '2020-08-26 22:05:07', '2020-08-26 22:05:07'),
(6, 'mahmoud', '01285970241', 'mahmoudelshall10@outlook.com', '$2y$10$Bm2ES31T4FMZiwdB5ue0POTAbbq5v/pymVrPvdEU54vDP5I2/i/1W', 'Mahmoud Ahmed', 'محمود  احمد', 'sdfdsf', 8, 98, NULL, '1970-02-07', '15641531565465', '5345656456456', 1234567891234567, 'referee_image/1599170336mahmoud.jpg', 'Mini Basket', '2020-09-03 19:51:05', '2020-09-03 19:58:56'),
(7, 'ahmed', '01285970242', 'ahmed10@outlook.com', '$2y$10$hIpNpbe2D.BNPg7m4vRsQeS6ahVo330zee8NuOjuBspS13xr8ZOoa', 'Ahmed El-Shall', ' احمد الشال', 'sdasd', 19, 65, NULL, '1970-04-24', '15641531565469', '5345656456451', 4654564648684, 'referee_image/1599170692-ahmed.jpg', 'Mini Basket', '2020-09-03 20:04:52', '2020-09-03 20:04:52'),
(8, 'ahmedelsahll', '01285970250', 'ahmedelsahll@outlook.com', '$2y$10$C7EXBdABKLNfwHB1A2vLQOSLy1MzI.it8XrrFmRnPRM7PY/UiydL2', 'El-Shall Ahmed', 'الشال احمد', 'dfdsf', 4, 66, NULL, '1970-04-17', '15641531565461', '5345656456459', 4655415135531315, 'referee_image/1599171000-ahmedelsahll.jpg', 'International', '2020-09-03 20:10:00', '2020-09-03 20:10:00');

-- --------------------------------------------------------

--
-- Table structure for table referee_places
--

CREATE TABLE referee_places (
  referee_place_id bigint CHECK (referee_place_id > 0) NOT NULL,
  referee_position varchar(255) NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table referee_places
--

INSERT INTO referee_places (referee_place_id, referee_position, created_at, updated_at) VALUES
(1, 'playground', '2020-09-03 18:08:24', '2020-09-03 18:08:24'),
(2, 'table', '2020-09-03 18:08:24', '2020-09-03 18:08:24');

-- --------------------------------------------------------

--
-- Table structure for table referee_roles
--

CREATE TABLE referee_roles (
  referee_role_id bigint CHECK (referee_role_id > 0) NOT NULL,
  referee_place_id int NOT NULL,
  role_ar varchar(255) NOT NULL,
  role_en varchar(255) NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table referee_roles
--

INSERT INTO referee_roles (referee_role_id, referee_place_id, role_ar, role_en, created_at, updated_at) VALUES
(1, 1, 'حكم اول', 'First Referee', '2020-09-03 18:12:33', '2020-09-03 18:12:33'),
(2, 1, 'حكم ثاني', 'Second Referee', '2020-09-03 18:12:33', '2020-09-03 18:12:33'),
(3, 1, 'حكم ثالث', 'Third Referee', '2020-09-03 18:12:33', '2020-09-03 18:12:33'),
(4, 2, 'مسجل ', 'Scorer', '2020-09-03 18:12:33', '2020-09-03 18:12:33'),
(5, 2, 'مساعد مسجل', 'Assistant Scorer', '2020-09-03 18:12:33', '2020-09-03 18:12:33'),
(6, 2, 'ميقاتي', 'Time keeper', '2020-09-03 18:12:33', '2020-09-03 18:12:33'),
(7, 2, 'ميقاتي زمن الهجمة', 'Shoot clock keeper', '2020-09-03 18:12:33', '2020-09-03 18:12:33'),
(8, 2, 'مراقب', 'Commessioner', '2020-09-03 18:12:33', '2020-09-03 18:12:33');

-- --------------------------------------------------------

--
-- Table structure for table reports
--

CREATE TABLE reports (
  report_id bigint CHECK (report_id > 0) NOT NULL,
  league_match_id int NOT NULL,
  league_id int NOT NULL,
  referee_id int NOT NULL,
  allowances_values_id int NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

-- --------------------------------------------------------

--
-- Table structure for table teams
--

CREATE TABLE teams (
  team_id bigint CHECK (team_id > 0) NOT NULL,
  team_name varchar(255) DEFAULT NULL,
  team_logo longtext DEFAULT NULL,
  city_id int NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
)  ;

--
-- Dumping data for table teams
--

INSERT INTO teams (team_id, team_name, team_logo, city_id, created_at, updated_at) VALUES
(3, 'Team a', 'public/teams_logos/1598167736-Team a.jpg', 1, '2020-08-23 05:28:56', '2020-08-23 05:28:56'),
(4, 'Team b', 'public/teams_logos/1598167753-Team b.jpg', 1, '2020-08-23 05:29:13', '2020-08-23 05:29:13'),
(5, 'Team C', 'public/teams_logos/1599015472-Team C.jpg', 1, '2020-09-02 00:57:52', '2020-09-02 00:58:13'),
(6, 'Team D', 'public/teams_logos/1599167622-Team D.jpg', 1, '2020-09-03 19:13:42', '2020-09-03 19:13:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table administrators
--
ALTER TABLE administrators
  ADD PRIMARY KEY (admins_id),
  ADD UNIQUE KEY administrators_admin_username_unique (admin_username),
  ADD UNIQUE KEY administrators_admin_email_unique (admin_email);

--
-- Indexes for table allowances
--
ALTER TABLE allowances
  ADD PRIMARY KEY (allowance_id),
  ADD KEY allowances_league_match_id_index (leage_matches_id),
  ADD KEY allowances_allowances_values_id_index (allowances_values_id),
  ADD KEY referee_id (referee_id),
  ADD KEY league_id (league_id);

--
-- Indexes for table allowances_values
--
ALTER TABLE allowances_values
  ADD PRIMARY KEY (allowances_values_id),
  ADD KEY allowances_values_city_from_index (city_from),
  ADD KEY allowances_values_city_to_index (city_to),
  ADD KEY league_id (league_id),
  ADD KEY referee_place (referee_place);

--
-- Indexes for table association_reports
--
ALTER TABLE association_reports
  ADD PRIMARY KEY (association_report_id);

--
-- Indexes for table cairo_area_reports
--
ALTER TABLE cairo_area_reports
  ADD PRIMARY KEY (cairo_area_report_id);

--
-- Indexes for table cities
--
ALTER TABLE cities
  ADD PRIMARY KEY (city_id);

--
-- Indexes for table exams
--
ALTER TABLE exams
  ADD PRIMARY KEY (exam_id);

--
-- Indexes for table exam_answers
--
ALTER TABLE exam_answers
  ADD PRIMARY KEY (exam_answer_id),
  ADD KEY exam_answers_referee_id_index (referee_id),
  ADD KEY exam_answers_exam_id_index (exam_id),
  ADD KEY exam_answers_question_id_index (question_id);

--
-- Indexes for table exam_answer_options
--
ALTER TABLE exam_answer_options
  ADD PRIMARY KEY (exam_answer_option_id),
  ADD KEY exam_answer_options_exam_answer_id_index (exam_answer_id),
  ADD KEY exam_answer_options_option_id_index (option_id);

--
-- Indexes for table exam_questions
--
ALTER TABLE exam_questions
  ADD PRIMARY KEY (exam_question_id),
  ADD KEY exam_questions_exam_id_index (exam_id),
  ADD KEY exam_questions_question_id_index (question_id);

--
-- Indexes for table exam_referees
--
ALTER TABLE exam_referees
  ADD PRIMARY KEY (exam_referee_id),
  ADD KEY exam_referees_exam_id_index (exam_id),
  ADD KEY exam_referees_referee_id_index (referee_id);

--
-- Indexes for table failed_jobs
--
ALTER TABLE failed_jobs
  ADD PRIMARY KEY (id);

--
-- Indexes for table governorates
--
ALTER TABLE governorates
  ADD PRIMARY KEY (gov_id);

--
-- Indexes for table halls
--
ALTER TABLE halls
  ADD PRIMARY KEY (hall_id),
  ADD KEY hall_place (hall_place);

--
-- Indexes for table leage_matches
--
ALTER TABLE leage_matches
  ADD PRIMARY KEY (leage_matches_id),
  ADD KEY leage_matches_league_id_index (league_id),
  ADD KEY leage_matches_home_team_index (home_team),
  ADD KEY leage_matches_away_team_index (away_team),
  ADD KEY leage_matches_match_hall_index (match_hall);

--
-- Indexes for table leagues
--
ALTER TABLE leagues
  ADD PRIMARY KEY (league_id);

--
-- Indexes for table leagues_teams
--
ALTER TABLE leagues_teams
  ADD PRIMARY KEY (leagues_teams_id),
  ADD KEY leagues_teams_team_id_index (team_id),
  ADD KEY leagues_teams_league_id_index (league_id);

--
-- Indexes for table matches_referees
--
ALTER TABLE matches_referees
  ADD PRIMARY KEY (matches_referee_id),
  ADD KEY matches_referees_leage_matches_id_index (leage_matches_id),
  ADD KEY matches_referees_referee_id_index (referee_id),
  ADD KEY referee_role (referee_role_id);

--
-- Indexes for table migrations
--
ALTER TABLE migrations
  ADD PRIMARY KEY (id);

--
-- Indexes for table mini_basket_reports
--
ALTER TABLE mini_basket_reports
  ADD PRIMARY KEY (mini_basket_report_id);

--
-- Indexes for table news
--
ALTER TABLE news
  ADD PRIMARY KEY (new_id);

--
-- Indexes for table notifications
--
ALTER TABLE notifications
  ADD PRIMARY KEY (notification_id),
  ADD KEY notifications_referee_id_index (referee_id);

--
-- Indexes for table password_resets
--
ALTER TABLE password_resets
  ADD CREATE INDEX password_resets_email_index ON password_resets (email(191));

--
-- Indexes for table questions
--
ALTER TABLE questions
  ADD PRIMARY KEY (question_id);

--
-- Indexes for table questions_options
--
ALTER TABLE questions_options
  ADD PRIMARY KEY (option_id),
  ADD KEY questions_options_question_id_index (question_id);

--
-- Indexes for table referees
--
ALTER TABLE referees
  ADD PRIMARY KEY (referee_id),
  ADD UNIQUE KEY referees_referee_username_unique (referee_username),
  ADD UNIQUE KEY referees_referee_mobile_unique (referee_mobile),
  ADD UNIQUE KEY referees_referee_email_unique (referee_email),
  ADD UNIQUE KEY device_token (device_token);

--
-- Indexes for table referee_places
--
ALTER TABLE referee_places
  ADD PRIMARY KEY (referee_place_id);

--
-- Indexes for table referee_roles
--
ALTER TABLE referee_roles
  ADD PRIMARY KEY (referee_role_id),
  ADD KEY referee_roles_referee_place_id_index (referee_place_id);

--
-- Indexes for table reports
--
ALTER TABLE reports
  ADD PRIMARY KEY (report_id),
  ADD KEY reports_league_match_id_index (league_match_id),
  ADD KEY reports_league_id_index (league_id),
  ADD KEY reports_referee_id_index (referee_id),
  ADD KEY reports_allowances_values_id_index (allowances_values_id);

--
-- Indexes for table teams
--
ALTER TABLE teams
  ADD PRIMARY KEY (team_id),
  ADD KEY city_id (city_id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table administrators
--
ALTER TABLE administrators
  MODIFY admins_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table allowances
--
ALTER TABLE allowances
  MODIFY allowance_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table allowances_values
--
ALTER TABLE allowances_values
  MODIFY allowances_values_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table association_reports
--
ALTER TABLE association_reports
  MODIFY association_report_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table cairo_area_reports
--
ALTER TABLE cairo_area_reports
  MODIFY cairo_area_report_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table cities
--
ALTER TABLE cities
  MODIFY city_id bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table exams
--
ALTER TABLE exams
  MODIFY exam_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table exam_answers
--
ALTER TABLE exam_answers
  MODIFY exam_answer_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table exam_answer_options
--
ALTER TABLE exam_answer_options
  MODIFY exam_answer_option_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;

--
-- AUTO_INCREMENT for table exam_questions
--
ALTER TABLE exam_questions
  MODIFY exam_question_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table exam_referees
--
ALTER TABLE exam_referees
  MODIFY exam_referee_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table failed_jobs
--
ALTER TABLE failed_jobs
  MODIFY id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table governorates
--
ALTER TABLE governorates
  MODIFY gov_id bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table halls
--
ALTER TABLE halls
  MODIFY hall_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table leage_matches
--
ALTER TABLE leage_matches
  MODIFY leage_matches_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table leagues
--
ALTER TABLE leagues
  MODIFY league_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table leagues_teams
--
ALTER TABLE leagues_teams
  MODIFY leagues_teams_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table matches_referees
--
ALTER TABLE matches_referees
  MODIFY matches_referee_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table migrations
--
ALTER TABLE migrations
  MODIFY id cast(10 as int) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table mini_basket_reports
--
ALTER TABLE mini_basket_reports
  MODIFY mini_basket_report_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table news
--
ALTER TABLE news
  MODIFY new_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table notifications
--
ALTER TABLE notifications
  MODIFY notification_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table questions
--
ALTER TABLE questions
  MODIFY question_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table questions_options
--
ALTER TABLE questions_options
  MODIFY option_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table referees
--
ALTER TABLE referees
  MODIFY referee_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table referee_places
--
ALTER TABLE referee_places
  MODIFY referee_place_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table referee_roles
--
ALTER TABLE referee_roles
  MODIFY referee_role_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table reports
--
ALTER TABLE reports
  MODIFY report_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table teams
--
ALTER TABLE teams
  MODIFY team_id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
