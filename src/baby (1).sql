-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2025 at 08:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baby`
--

-- --------------------------------------------------------

--
-- Table structure for table `checklists`
--

CREATE TABLE `checklists` (
  `id` int(64) NOT NULL,
  `title` varchar(256) NOT NULL,
  `user_id` int(64) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklists`
--

INSERT INTO `checklists` (`id`, `title`, `user_id`, `created_timestamp`, `updated_timestamp`) VALUES
(8, 'Newborn Essentials Checklist', 6, '2025-06-02 09:40:21', '2025-06-02 09:40:21'),
(9, 'Hospital Bag Checklist for Mom & Baby', 6, '2025-06-02 09:41:38', '2025-06-02 09:41:38'),
(10, 'Postpartum Recovery Checklist', 6, '2025-06-02 09:42:43', '2025-06-02 09:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `checklists_parent`
--

CREATE TABLE `checklists_parent` (
  `id` int(11) NOT NULL,
  `checklist_id` int(11) DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `user_id` int(64) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklists_parent`
--

INSERT INTO `checklists_parent` (`id`, `checklist_id`, `title`, `user_id`, `created_timestamp`, `updated_timestamp`) VALUES
(29, 9, 'Hospital Bag Checklist for Mom & Baby', 8, '2025-06-03 02:42:21', '2025-06-03 02:42:21'),
(30, NULL, 'ni', 7, '2025-06-03 07:10:23', '2025-06-03 07:10:23'),
(31, 8, 'Newborn Essentials Checklist', 12, '2025-06-03 16:04:36', '2025-06-03 16:04:36'),
(32, NULL, 'Hospital   ', 12, '2025-06-03 16:04:46', '2025-06-03 16:04:46'),
(33, 9, 'Hospital Bag Checklist for Mom & Baby', 7, '2025-06-10 14:30:17', '2025-06-10 14:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `checklist_items`
--

CREATE TABLE `checklist_items` (
  `id` int(64) NOT NULL,
  `item` varchar(256) NOT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT 0,
  `checklist_id` int(64) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklist_items`
--

INSERT INTO `checklist_items` (`id`, `item`, `is_done`, `checklist_id`, `created_timestamp`, `updated_timestamp`) VALUES
(41, 'important documents (iD, insurance, birth plan)', 0, 9, '2025-06-10 14:25:24', '2025-06-10 14:25:24'),
(42, 'snacks and hydration bottles for energy', 0, 9, '2025-06-10 14:25:45', '2025-06-10 14:25:45'),
(43, 'toiletries, including lip balm & moisturizer', 0, 9, '2025-06-10 14:26:20', '2025-06-10 14:26:20'),
(44, 'baby wipes or cotton pads & warm water', 0, 8, '2025-06-10 14:26:48', '2025-06-10 14:26:48'),
(45, 'swaddle blankets & baby mittens', 0, 8, '2025-06-10 14:27:05', '2025-06-10 14:27:05'),
(46, 'diapers (disposable or cloth)', 0, 8, '2025-06-10 14:27:22', '2025-06-10 14:27:22'),
(47, 'onesies, bodysuits, & soft clothing', 0, 8, '2025-06-10 14:27:40', '2025-06-10 14:27:40'),
(48, 'breastfeeding support essentials (lanolin cream, nursing pillow)', 0, 10, '2025-06-10 14:28:29', '2025-06-10 14:28:29'),
(49, 'belly support band or incision care supplies (for c-section)', 0, 10, '2025-06-10 14:29:16', '2025-06-10 14:29:16'),
(50, 'perineal spray or ice packs (for normal delivery)', 0, 10, '2025-06-10 14:29:46', '2025-06-10 14:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `checklist_items_parent`
--

CREATE TABLE `checklist_items_parent` (
  `id` int(11) NOT NULL,
  `checklist_item_id` int(11) DEFAULT NULL,
  `item` varchar(256) DEFAULT NULL,
  `is_done` tinyint(1) NOT NULL DEFAULT 0,
  `checklist_id` int(64) NOT NULL,
  `user_id` int(64) NOT NULL,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checklist_items_parent`
--

INSERT INTO `checklist_items_parent` (`id`, `checklist_item_id`, `item`, `is_done`, `checklist_id`, `user_id`, `created_timestamp`, `updated_timestamp`) VALUES
(64, NULL, 'tidak nyenyak', 0, 20, 5, '2025-06-02 07:02:59', '2025-06-02 07:02:59'),
(93, 35, NULL, 1, 29, 8, '2025-06-03 02:42:21', '2025-06-03 03:07:50'),
(94, 34, NULL, 0, 29, 8, '2025-06-03 02:42:21', '2025-06-03 02:42:21'),
(95, 29, NULL, 0, 29, 8, '2025-06-03 02:42:21', '2025-06-03 02:42:21'),
(96, 27, NULL, 0, 29, 8, '2025-06-03 02:42:21', '2025-06-03 02:42:21'),
(100, NULL, 'sendiri', 1, 30, 7, '2025-06-03 07:10:29', '2025-06-10 14:30:37'),
(101, 37, NULL, 1, 31, 12, '2025-06-03 16:04:36', '2025-06-03 16:05:15'),
(102, 36, NULL, 0, 31, 12, '2025-06-03 16:04:36', '2025-06-03 16:04:36'),
(103, 24, NULL, 1, 31, 12, '2025-06-03 16:04:36', '2025-06-03 16:05:18'),
(104, 22, NULL, 0, 31, 12, '2025-06-03 16:04:36', '2025-06-03 16:04:36'),
(105, NULL, 'Shampoo', 1, 32, 12, '2025-06-03 16:04:53', '2025-06-03 16:05:12'),
(106, NULL, 'Towel', 0, 32, 12, '2025-06-03 16:05:00', '2025-06-03 16:05:00'),
(107, NULL, 'Socks', 0, 32, 12, '2025-06-03 16:05:09', '2025-06-03 16:05:09'),
(108, 43, NULL, 1, 33, 7, '2025-06-10 14:30:17', '2025-06-10 14:30:48'),
(109, 42, NULL, 0, 33, 7, '2025-06-10 14:30:17', '2025-06-10 14:30:17'),
(110, 41, NULL, 0, 33, 7, '2025-06-10 14:30:17', '2025-06-10 14:30:17'),
(114, NULL, '2', 0, 30, 7, '2025-06-10 14:30:44', '2025-06-10 14:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(64) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `filename` varchar(256) NOT NULL,
  `category` varchar(64) NOT NULL DEFAULT 'baby',
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `description`, `filename`, `category`, `created_timestamp`, `updated_timestamp`) VALUES
(1, 'Diapering', 'Keeping your baby clean and comfortable  \r\n\r\n- Newborns go through multiple diapers a day, so choosing between disposable and cloth diapers is important. \r\nExample: Disposable diapers offer convenience, while cloth diapers are reusable and eco-friendly—consider which suits your baby\'s needs and your lifestyle best.  \r\n\r\n- Always have baby wipes or warm water with cotton pads ready for gentle cleaning.\r\nExample: Fragrance-free wipes or cotton pads dipped in warm water are gentlest on delicate skin and help prevent irritation.  \r\n\r\n- Applying diaper rash cream can help protect your baby\'s sensitive skin from irritation.\r\nExample: A zinc oxide-based cream creates a barrier to keep moisture from causing discomfort, especially during long naps or overnight wear.  ', '1748877859_e42f1e867109524d38ad015a99798447.jpg', 'baby', '2025-06-02 09:24:02', '2025-06-10 14:57:36'),
(2, 'Bathing & Skincare', 'Gentle care for delicate skin\r\n  \r\n- A newborn’s skin is delicate, so bath time should be gentle and soothing.  \r\n- Using a small baby bathtub with warm water (about 37°C) is ideal for safe and comfortable bathing.  \r\n\r\n- Bathing your baby 2–3 times a week with mild baby soap and shampoo prevents skin irritation.\r\n Example: Choose a fragrance-free baby wash labeled for sensitive skin to minimize the risk of irritation.  \r\n\r\n- Moisturizing your baby\'s skin helps prevent dryness and keeps it soft. \r\nExample: Applying a hypoallergenic baby lotion right after bathing locks in moisture.  \r\n\r\n- Soft washcloths are great for gently cleaning their skin without causing discomfort. \r\nExample: A muslin cloth is a great option—it’s soft, breathable, and gentle enough for delicate skin.  ', '1748877821_9f88e2630ca34c2bcb72781ea593fd3f.jpg', 'baby', '2025-06-02 09:24:34', '2025-06-10 14:24:25'),
(3, 'Health & Safety', 'Protecting your baby’s well-being\r\n\r\n- Keeping a newborn healthy requires taking essential precautions.\r\nExample: Regular handwashing before handling your baby helps reduce exposure to germs and keeps them safe.  \r\n\r\n- A digital thermometer is useful for monitoring fevers.\r\nExample: A forehead or ear thermometer provides quick and gentle temperature readings without disturbing your baby too much.  \r\n\r\n- A nasal aspirator can help ease congestion and make breathing more comfortable.\r\nExample: A bulb syringe or an electric nasal aspirator can gently remove mucus, especially during colds or allergies.  \r\n\r\n- Having a baby-friendly first-aid kit ensures you\'re prepared for minor health concerns.\r\nExample: Stocking essentials like infant fever medicine, sterile gauze, and baby nail clippers helps you manage unexpected situations smoothly.  \r\n\r\n- When setting up a sleeping area, follow safe sleep guidelines by using a firm mattress and keeping the crib free of toys and blankets.\r\nExample: A breathable sleep sack is a great alternative to blankets—it keeps your baby warm while reducing the risk of suffocation.  ', '1748877876_de0891c916ccbe7a15ef89ba8ce6bc9d.jpg', 'baby', '2025-06-02 09:25:53', '2025-06-10 14:59:36'),
(4, 'Clothing & Swaddling', 'Keeping your baby snug and cozy  \r\n\r\n- Comfort is key when dressing a newborn, so soft, breathable fabrics like cotton or bamboo are the best choice. \r\nExample: Organic cotton onesies help regulate temperature while being gentle on sensitive skin.  \r\n\r\n- Avoid clothes with tight elastics or rough seams to prevent irritation. \r\nExample: Look for tagless designs and flat seams in baby clothing to reduce chafing.  \r\n\r\n- Onesies and bodysuits make diaper changes easier and keep the baby cozy. \r\nExample: Snap-button bodysuits allow for quick changes without disturbing your baby too much.  \r\n\r\n- Swaddling can help soothe your baby and improve their sleep quality. \r\nExample: A muslin swaddle blanket is lightweight, breathable, and provides a snug yet comfortable wrap for restful sleep.  ', '1748877840_fb9147662d58e9d8f9b5867e26a64b4c.jpg', 'baby', '2025-06-02 09:28:07', '2025-06-10 14:34:56'),
(5, 'Postpartum Recovery', 'Healing and adjusting after childbirth\r\n- Rest as much as possible to support your body\'s recovery.\r\n- Stay hydrated and eat a balanced diet rich in nutrients to promote healing.\r\n- Gentle movement and light walking can help improve circulation and prevent discomfort.\r\n- Take care of perineal healing by using warm water for cleaning and cold packs to reduce swelling.\r\n- Listen to your body and avoid heavy lifting or strenuous activities.\r\n', '1748877964_86e84225ea4694855d4c8dc81359c717.jpg', 'mom', '2025-06-02 09:28:46', '2025-06-02 15:26:04'),
(6, 'Emotional & Mental Well-being', 'Caring for your mental health postpartum  \r\n\r\n- Hormonal changes can cause mood swings—seek support from loved ones and professionals if needed. \r\nExample: Talking openly with your partner or a trusted friend can help you process emotions and feel less isolated.  \r\n\r\n- Take time for self-care, even small moments like a warm shower or a quiet break. \r\nExample: Listening to soothing music while resting or practicing deep breathing exercises can promote relaxation.  \r\n\r\n- Postpartum blues are common, but if feelings of sadness persist, speak to a doctor about postpartum depression.\r\nExample: Keeping a journal to track your emotions may help identify patterns and determine when professional support is needed.  \r\n\r\n- Connect with other new moms for support and shared experiences.\r\nExample: Joining a local or online motherhood support group provides a space to share struggles and receive encouragement from those who understand.  ', '1748877895_f4dfa07f5c91bf007f7b3e12118a7437.jpg', 'mom', '2025-06-02 09:29:13', '2025-06-10 15:04:12'),
(7, 'Physical Changes & Self-Care', 'Understanding and caring for your postpartum body\r\n- Your body undergoes many changes—give yourself time to heal and adjust.\r\n- Light stretching or gentle yoga can help ease muscle stiffness and improve flexibility.\r\n- Expect hair shedding postpartum—it’s temporary and will stabilize with time.\r\n- Prioritize sleep when possible, and don’t hesitate to ask for help to manage exhaustion.\r\n', '1748877923_fa0c2364520df3e7a2d3631a95dba6c9.jpg', 'mom', '2025-06-02 09:29:59', '2025-06-02 15:25:23'),
(8, 'Postpartum Check-ups', 'Ensuring your health after childbirth\r\n- Schedule regular postpartum check-ups to monitor your recovery and well-being.\r\n- Discuss any concerns, such as pelvic pain, excessive bleeding, or unusual symptoms, with your doctor.\r\n- Consider pelvic floor exercises to strengthen core muscles and prevent discomfort.\r\n- Follow up on vaccinations or supplements recommended after delivery.\r\n', '1748877939_755fbce1333fad8541646a891f6ca443.jpg', 'mom', '2025-06-02 09:30:32', '2025-06-02 15:25:39'),
(9, 'Nutrition', 'Eating well to restore energy and support postpartum health  \r\n\r\n- Prioritize protein-rich foods like eggs, lean meats, legumes, and dairy to aid tissue repair and recovery. \r\n- Include iron-rich foods such as spinach, red meat, and fortified cereals to replenish blood levels after delivery.\r\n- Eat fiber-rich foods including whole grains, fruits, and vegetables to prevent postpartum constipation.\r\n- Incorporate foods high in omega-3 fatty acids like salmon, chia seeds, and walnuts to support brain function and mood stability.\r\n\r\n- Consume healthy fats from sources like avocado, nuts, and olive oil for sustained energy and hormone balance.\r\nExample: A smoothie with avocado, almond butter, and banana offers a nutrient-dense energy boost.  \r\n\r\n- Stay hydrated with water, herbal teas, and soups to maintain milk production and prevent dehydration.\r\nExample: Warm chamomile tea can be soothing while helping maintain hydration levels.  \r\n\r\n- If needed, continue prenatal or postpartum vitamins as advised by your doctor to fill any nutritional gaps.\r\nExample: A doctor may recommend continuing folic acid or vitamin D supplements to support recovery and overall health.  ', '1748877907_dbec18586697712508f0c1850896e7cf.jpg', 'mom', '2025-06-02 09:31:46', '2025-06-10 15:11:08'),
(10, 'C-Section Recovery', 'Healing and managing post-surgery discomfort\r\n- Take prescribed pain medication as directed to manage discomfort.\r\n- Keep the incision site clean and dry to prevent infection.\r\n- Avoid heavy lifting and strenuous activity for several weeks.\r\n- Gently move around to improve circulation and reduce blood clot risks.\r\n- Support your abdomen with a pillow when coughing, sneezing, or laughing to minimize pain.\r\n- Monitor for signs of infection, such as redness, swelling, or unusual discharge, and contact your doctor if needed.\r\n', '1748878011_647a70f2b508813f3e50a70343a6da9d.jpg', 'caesar', '2025-06-02 09:32:20', '2025-06-02 15:26:51'),
(12, 'Postpartum Movement & Exercise', 'Safely regaining strength after surgery\r\n- Start with light movements such as short walks to improve circulation.\r\n- Avoid intense workouts until cleared by your doctor (typically after six weeks).\r\n- Gentle stretching can help relieve stiffness and reduce tension.\r\n- Focus on deep breathing exercises to strengthen core muscles gradually.\r\n- Use belly support bands or postpartum wraps for additional comfort during movement.\r\n', '1748878080_4ecbc89d8e654995e8789c45dead1f61.jpg', 'caesar', '2025-06-02 09:33:13', '2025-06-02 15:28:00'),
(13, 'Breastfeeding & Nutrition', 'Supporting healing through nourishment\r\n- Breastfeeding is still possible after a C-section, though some positions may be more comfortable (e.g., side-lying or football hold).\r\n- Eat protein-rich foods to promote tissue repair and faster healing.\r\n- Incorporate iron-rich foods to replenish blood levels after surgery.\r\n- Drink plenty of water to stay hydrated and maintain milk supply.\r\n- Increase fiber intake to help with digestion and reduce constipation caused by pain medications.\r\n', '1748877985_4ba2e0b2145e69bad9b792941515c269.jpg', 'caesar', '2025-06-02 09:33:54', '2025-06-02 15:26:25'),
(14, 'Emotional & Mental Well-being', 'Adjusting emotionally after a surgical birth\r\n- Give yourself time to emotionally process your birth experience.\r\n- If feelings of sadness or anxiety persist, reach out to a doctor for postpartum depression support.\r\n- Accept help from family and friends to ease recovery and reduce stress.\r\n- Connect with other moms who have had C-sections for shared support and encouragement.\r\n', '1748878036_f4dfa07f5c91bf007f7b3e12118a7437.jpg', 'caesar', '2025-06-02 09:34:22', '2025-06-02 15:27:16'),
(15, 'Postpartum Check-ups', 'Ensuring a smooth recovery\r\n- Attend regular follow-up appointments to monitor incision healing and recovery progress.\r\n- Discuss any pain, mobility issues, or concerns with your doctor.\r\n- Ask about safe exercises to gradually strengthen core muscles post-surgery.\r\n- Ensure all postpartum medications, including pain relievers, are taken as recommended.\r\n', '1748878061_755fbce1333fad8541646a891f6ca443.jpg', 'caesar', '2025-06-02 09:34:52', '2025-06-02 15:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(32) NOT NULL DEFAULT 'parent',
  `filename` varchar(128) DEFAULT NULL,
  `reset_code` varchar(256) DEFAULT NULL,
  `new_password` varchar(256) DEFAULT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `password`, `role`, `filename`, `reset_code`, `new_password`, `is_enabled`, `created_timestamp`, `updated_timestamp`) VALUES
(1, 'admin@gmail.com', 'ADMINISTRATOR', 'BABY', '$2y$10$HaKgwnl25MieHZN52ZTn6OMhFl1CiLs2ohoC/Vr4SOVPdJaWka1Ta', 'admin', NULL, NULL, NULL, 1, '2020-01-01 00:00:00', '2020-01-01 00:00:00'),
(3, 'syafiq@gmail.com', 'SYAFIQ', 'HADI', '$2y$10$qddk3fvMz3jByHgvA5qXsO/.27kcSALX2CWQZ6JlHd6A5Pk55I3jq', 'parent', NULL, NULL, NULL, 1, '2020-01-01 00:00:00', '2020-01-01 00:00:00'),
(4, 'admin1@gmail.com', 'ADMIN1', 'ADMIN1', '$2y$10$19ceRBOMV4frIUhzqahwpuv3iKttHdn1MNXPmvr84QDpSbph2cf1a', 'admin', NULL, NULL, NULL, 1, '2025-06-01 19:29:30', '2025-06-01 19:29:30'),
(5, 'ayah@gmail.com', 'AYAH', 'AYAH', '$2y$10$JpnrumaUjvzcTJkCQAggBefp0lSciNV6VUe87/yvjbdaSuL3jGFkO', 'parent', NULL, NULL, NULL, 1, '2025-06-01 20:32:53', '2025-06-01 20:32:53'),
(6, 'ad@gmail.com', 'ADMIN', '2', '$2y$10$auMbhgiz1Tq8.rmv/SNdd.boMX5YiA1Ybuy5b2OKIZ6FMsz88E4iu', 'admin', NULL, NULL, NULL, 1, '2025-06-02 08:47:35', '2025-06-02 08:47:35'),
(7, 'st@gmail.com', 'SITI', 'TAJUDIN', '$2y$10$bYhTVaJHWYRsl9T.7aZCp.FN.cB6xB4Oid3ej7ct6I7DgZiJLnuc2', 'parent', '1749014370_c93cd1c10adebb9204249611d4d06659.jpg', NULL, NULL, 1, '2025-06-02 08:56:02', '2025-06-04 05:19:30'),
(8, 'mai@mail.com', 'MAIZZATTUL', 'ABDULLAH', '$2y$10$r1Vq/o0SIKCuUfmDlQl18eRx4ffbZQy.7RrY.KLvI5yJRYMytL6SK', 'parent', '1748920105_ae85baa700401e4ddacb3013a8e6983e.jpg', '9e59db13', '$2y$10$ytEkT2nCJNOlrbKogB0Ve.lfKuLI9G.x5u/59zXxWrSpoaGrdIZ9.', 1, '2025-06-03 02:36:01', '2025-06-03 03:08:25'),
(9, 'maizzattul45@gmail.com', 'MAI', 'ABDULLAH', '$2y$10$L7RA6R4MVtW42TSPoXvXt.v/VIi5CiY.OIc2wxc94WgNTI4cmFyX.', 'parent', NULL, 'cc65a97f', '$2y$10$Dz3of8b0aU7LbMwywNtyt..qcqZK0GlEKoJ1bM7M4Bfyq.9IkE3D2', 0, '2025-06-03 03:03:57', '2025-06-04 07:53:23'),
(11, 'maizzattul@gmail.com', 'MAI', 'ABDULLAH', '$2y$10$P20vRZDFfLDHesWgrU4fzuz4Wg8zzcXAHGET525f09avKNM7HnDNu', 'admin', NULL, NULL, NULL, 1, '2025-06-03 03:10:32', '2025-06-03 03:10:32'),
(12, 'sm@gmail.com', 'SARA', 'MAHMUD', '$2y$10$2PQ2BYmgvfCId1fQnLWdqe9K/81PrnfYt9VgLnXy491d0fklcTg/O', 'parent', '1748966894_c93cd1c10adebb9204249611d4d06659.jpg', 'd8b52c5e', '$2y$10$YV1cCBzApXdiZt5CnSgw6uIql0uLNNDcjrDr1aXb5YJiBvsSxK0c6', 0, '2025-06-03 15:39:51', '2025-06-04 07:53:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklists_ibfk_1` (`user_id`);

--
-- Indexes for table `checklists_parent`
--
ALTER TABLE `checklists_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklist_items`
--
ALTER TABLE `checklist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_id` (`checklist_id`);

--
-- Indexes for table `checklist_items_parent`
--
ALTER TABLE `checklist_items_parent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `checklists_parent`
--
ALTER TABLE `checklists_parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `checklist_items`
--
ALTER TABLE `checklist_items`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `checklist_items_parent`
--
ALTER TABLE `checklist_items_parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checklists`
--
ALTER TABLE `checklists`
  ADD CONSTRAINT `checklists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `checklist_items`
--
ALTER TABLE `checklist_items`
  ADD CONSTRAINT `checklist_items_ibfk_1` FOREIGN KEY (`checklist_id`) REFERENCES `checklists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
