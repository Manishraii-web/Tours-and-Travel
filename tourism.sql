-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2026 at 02:45 PM
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
-- Database: `tourism`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`admin_id`, `admin_name`, `admin_password`) VALUES
(2, 'Villain', 'villain');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `travel_date` date NOT NULL,
  `num_persons` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `package_id`, `name`, `email`, `travel_date`, `num_persons`, `total_amount`, `status`, `booking_date`, `phone`) VALUES
(1, 8, 25, 'Manish', 'raimanish489@gmail.com', '2025-03-27', 1, 2005.00, 'Pending', '2025-03-08 20:19:33', ''),
(2, 8, 25, 'Manish', 'raimanish489@gmail.com', '2025-03-28', 1, 2005.00, 'Pending', '2025-03-08 20:21:49', ''),
(3, 8, 25, 'Manish', 'raimanish489@gmail.com', '2025-03-22', 12, 2005.00, '', '2025-03-08 20:42:41', ''),
(4, 8, 25, 'Manish', 'raimanish489@gmail.com', '2025-03-22', 12, 2005.00, '', '2025-03-08 20:42:46', ''),
(5, 8, 25, 'Manish', 'raimanish489@gmail.com', '2025-03-20', 1, 2005.00, '', '2025-03-08 20:46:48', '9825829944'),
(6, 8, 25, 'Manish', 'raimanish489@gmail.com', '2025-03-20', 1, 2005.00, '', '2025-03-08 20:47:11', '9825829944'),
(7, 8, 25, 'Manish', 'raimanish489@gmail.com', '2025-03-20', 1, 2005.00, '', '2025-03-08 20:48:25', '9825829944'),
(8, 8, 25, 'Manish', 'raimanish489@gmail.com', '2025-03-20', 1, 2005.00, '', '2025-03-08 20:51:06', '9825829944');

-- --------------------------------------------------------

--
-- Table structure for table `contactmessages`
--

CREATE TABLE `contactmessages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactmessages`
--

INSERT INTO `contactmessages` (`id`, `name`, `email`, `message`, `timestamp`, `created_at`) VALUES
(1, 'Manish Rai', 'raimanish489@gmail.com', 'hehe', '2025-02-20 07:59:19', '2025-02-23 18:39:43'),
(2, 'Manish Rai', 'raimanish489@gmail.com', 'hehe kei xaina', '2025-02-20 07:59:27', '2025-02-23 18:39:43'),
(3, ' vnhfhgg', 'itsvillain234@gmail.com', 'hello baby', '2025-02-23 18:20:56', '2025-02-23 18:39:43'),
(4, 'Manish Rai', 'raimanish489@gmail.com', 'kei xaina', '2025-03-09 00:47:02', '2025-03-09 00:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `hotel_url` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `hotel_name`, `location`, `price`, `hotel_url`, `image_path`, `created_at`) VALUES
(15, 'Pokhara Grande', 'Pokhara', 0.00, 'https://www.booking.com/hotel/np/pokhara-grande.en-gb.html?aid=311984&label=pokhara-grande-i9P2StX4u3wx14w_qeTpUgS393002794993%3Apl%3Ata%3Ap1%3Ap2%3Aac%3Aap%3Aneg%3Afi%3Atikwd-26300554490%3Alp9070016%3Ali%3Adec%3Adm%3Appccp%3DUmFuZG9tSVYkc2RlIyh9YXORK0YJi', 'pokhara grande.jpg', '2025-03-05 09:27:34'),
(16, 'Hotel Mithila Yatri', 'Janakpur, Nepal', 0.00, 'https://mithilayatriniwas.com/', 'mithila_yatri.jpg', '2025-03-05 09:30:56'),
(17, 'Hotel Eath-Light', 'Sauraha , Chitwan', 0.00, 'https://hotelearthlight.com/', 'earth_light.jpg', '2025-03-05 09:32:41'),
(18, 'Gautam Hotel', 'Bardibas', 0.00, 'https://gautamhotel.com.np/', 'gautam.jpg', '2025-03-05 09:35:06'),
(21, 'sumit hotel', 'lalitpur', 0.00, 'https://www.hotelthekingsbury.com/', 'Screenshot 2025-03-07 142459.png', '2025-03-07 09:46:24'),
(22, 'Hotel Google', 'Nasa ,USA', 0.00, 'https://www.google.com', 'ilam hotel.jpg', '2025-03-07 14:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE `package_details` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `cost_include` text NOT NULL,
  `cost_exclude` text NOT NULL,
  `overview` text NOT NULL,
  `itinerary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`id`, `package_id`, `cost_include`, `cost_exclude`, `overview`, `itinerary`) VALUES
(2, 15, 'q', 'q', 'q', 'q'),
(5, 23, 'Pick up and drop off from Chitwan Bus Park.\r\nTourist Bus Ticket to Chitwan from Kathmandu or Pokhara and vice versa\r\n3 Days Full Board Jungle Safari Activities in Chitwan national park\r\nEscorted English-speaking tour guide\r\nAll activities (Jeep safari, Bird watching, Jungle walking, Cannoning, Tharu culture dance) are included as per the itinerary\r\n2-night accommodation with breakfast, lunch, and dinner during your tour\r\nNational Park entrance and park fee\r\nOur service charges and taxes \r\nUse of Swimming Pool, Wi-Fi', 'Accommodation and food in Kathmandu or Pokhara\r\nAirfare international flights, Nepal entry visa fee, Visa issuance is easy upon the arrival\r\nAlcoholic beverages, Mineral water, laundry, phone calls, internet\r\nTips, gifts, souvenirs.', 'One of the most popular tourist destinations in the world is Nepal. Nepal is well-known across the world not just for its mountains and trekking, but also for its spectacular wildlife, lush vegetation, and vibrant culture and traditions. You should choose the 3-day Chitwan National Park Tour Package from among the many treks and tours available in Nepal because it combines the exploration of flora and wildlife with a rich cultural and traditional experience. You will be more in touch with nature, and there is nothing more enjoyable than discovering what it is like to live in Nepal at a specific moment.\r\n\r\nThe Inner Terai Plain in south-central Nepal is where Chitwan National Park is located. This vast conservation area, which is 932 square kilometers in size, is home to some of the most endangered flora and creatures, including one-horned rhinoceroses, crocodiles, and other wild species. Two nights and three days in Chitwan include a Jeep safari, bird viewing, a cultural and historical tour of the hamlet of the Tharu, a dance tour, a jungle nature walk, and a vehicle safari trip. A vast wilderness to explore and take in the scenery, with vibrant fauna. This area of Nepal is renowned for its many ethnic cultures and friendliness in addition to its beautiful natural surroundings. Not everyone has the chance to discover oneself in the forest, listening to birds chirping and tigers roaring.', 'Day 1:Drive from Kathmandu or Pokhara to Chitwan\r\n\r\nDay 2:Full day Jungle activities in Chitwan National Park\r\n\r\nDay 3:Drive Back to Kathmandu or Pokhara'),
(6, 24, 'Hotel pickup and drop-off\r\nEnglish-speaking driver\r\nGuaranteed window seat\r\n1-hour Everest Scenic Flight\r\nFlight tickets\r\nAdventure certificate\r\nPacked breakfast/lunch (Croissant, Muffin, Danish, Cookies, Banana, and Juice)\r\nAnything that is not mentioned in the itinerary', 'Nepal entry visa fees\r\nAirport Boarding Pass\r\nNational Park Permit\r\nLocal Government Permits\r\nExtra Drinks and Beverages\r\nPersonal Health Insurance\r\nBreakfast at Hotel Everest View\r\nFood and extra nights at Hotel in Kathmandu\r\nAny kinds of drinks (tea, coffee, hot water, etc) \r\nAll the other expenses not mentioned in the cost include a list.\r\nAvailability & Private Trip', 'See Mount Everest from the sky as you depart from Kathmandu on a scenic tour by plane. Gaze down at the vast glaciers of the Himalayas and benefit from a return hotel transfer.\r\n\r\nAbout this activity\r\nFree cancellation\r\nCancel up to 24 hours in advance for a full refund\r\nReserve now & pay later\r\nKeep your travel plans flexible — book your spot and pay nothing today.\r\nDuration 2 hours\r\nCheck availability to see starting times.\r\nHost or greeter\r\nEnglish\r\nPickup optional\r\nThe driver will come to pick you up at your hotel at specified time. Kindly wait for the driver at hotel\'s lobby 10 mins prior to the given time.\r\nWheelchair accessible', 'Itinerary\r\n\r\nDay 1:\r\nDetailed Itinerary of Everest Base Camp Helicopter Tour From Kathmandu to Kathmandu\r\nDuration\r\n6 Hours\r\nHighest Altitude\r\n5644 m (Kala Patthar)\r\nAccommodation\r\nAvailable up on your request with an extra cost\r\nOur Luxury Everest Base Camp helicopter trip provides an unforgettable aerial adventure to Everest Base Camp and Mount Everest without the need for trekking. \r\n\r\n05:40 AM: Transfer to Kathmandu Airport Helipad for Everest Base Camp Helicopter Tour\r\nStart your Everest Base Camp Helicopter Tour with a timely transfer to Kathmandu Airport Helipad. Departing at 05:40 AM, this transfer sets the stage for your aerial journey through the Himalayan region. Kathmandu, located at 1,300 meters, serves as the perfect starting point for your adventure. With NTA overseeing the logistics, rest assured that your journey begins smoothly as you prepare for the Everest Base Camp Helicopter Tour of a lifetime.\r\n\r\n06:20 AM: Helicopter Check-In at Kathmandu Domestic Airport\r\nBy 06:20 AM, check-in for your Everest Helicopter Tour will be completed at the Kathmandu Domestic Airport counter. Make sure to bring a copy of your passport for verification. The check-in process ensures all safety procedures are followed before your helicopter flight to Everest Base Camp. With NTA managing every step of the way, your adventure begins with excitement and anticipation.\r\n\r\n06:40 AM: Helicopter Flight to Lukla Airport - Gateway to Everest\r\nAt 06:40 AM, your helicopter flight to Lukla Airport will begin. Lukla, often called the Gateway to Everest, is the starting point for many trekkers and mountaineers. The flight from Kathmandu to Lukla takes approximately 25-30 minutes and offers stunning aerial views of the Himalayas, including lush valleys and distant snow-capped peaks. This flight is the perfect introduction to the beauty of Nepal and the Everest region.\r\n\r\n07:45 AM: Unloading Return Fuel at Lukla Airport\r\nAfter landing at Lukla, the helicopter will make a short stop to unload return fuel before continuing the journey towards Everest Base Camp. This routine stop takes about 10–12 minutes and is an important part of the tour logistics. During this time, passengers can take in the bustling atmosphere of Lukla, the center of adventure for many Everest trekkers and mountain climbers.\r\n\r\n08:00 AM: Flight Toward Everest Base Camp and the Khumbu Region\r\nAt 08:00 AM, the helicopter will resume flight towards Everest Base Camp, passing over the Khumbu Glacier and Sherpa villages nestled in the lower Himalayas. This portion of the Everest helicopter tour provides stunning aerial views of Mount Everest, Lhotse, Ama Dablam, and other towering peaks. As you soar through the Khumbu Valley, you’ll see the dramatic shift in landscapes from lush greenery to rocky, snow-covered terrain. This is the heart of the Himalayan region, offering unparalleled beauty.\r\n\r\n08:30 AM: Overfly of Everest Base Camp and Kala Patthar\r\nThe highlight of your Nepal Everest Helicopter Tour arrives at 08:30 AM as the helicopter overflies Everest Base Camp and Kala Patthar, at an altitude of 5,250 meters (17,225 feet). This aerial view of Mount Everest and the surrounding peaks is a once-in-a-lifetime experience. As you hover above Kala Patthar, the most famous viewpoint for Mount Everest, you will witness panoramic views of the Everest massif. The colorful tents of Everest Base Camp and the striking Khumbu Glacier will be visible, allowing for incredible photo opportunities.\r\n\r\n08:50 AM: Flight to Syangboche Hill and Hotel Everest View \r\nThe next part of your Everest Base Camp Helicopter Tour takes you to Syangboche Hill, home to the Hotel  Everest View at an elevation of 3,880 meters (12,000 feet). This location offers a peaceful break with some of the best views of the Everest massif. After landing at the Everest View Hotel, enjoy a refreshing breakfast or beverage while soaking in the majestic panoramic mountain views of Mount Everest, Lhotse, and Ama Dablam. The Mt. Everest View Hotel is one of the highest hotels in the world, providing a luxurious touch to your Himalayan helicopter adventure.\r\n\r\n09:50 AM: Return Flight to Kathmandu (Likely Lukla Stop)\r\nAt 09:50 AM, the return flight to Kathmandu begins. The helicopter will descend through the Khumbu Valley, passing over remote Sherpa villages and terraced farmland. If needed, the helicopter may make a brief stop at Lukla for refueling before continuing to Kathmandu. This stop provides an opportunity to briefly experience the vibrant town of Lukla, often bustling with trekkers and climbers. The return flight provides a final opportunity to witness the grandeur of the Himalayan peaks before heading back to Kathmandu.\r\n\r\n11:40 AM: Arrival at Kathmandu Domestic Airport\r\nBy 11:40 AM, the helicopter will touch down at Kathmandu Domestic Airport, marking the conclusion of your Everest Base Camp Helicopter Tour. The contrast between the peaceful serenity of the Himalayas and the energetic hustle of Kathmandu is striking. Your helicopter journey to Everest has allowed you to experience the world’s highest peaks in a way that few ever will.\r\n\r\n12:00 PM: Drive to Hotel Post Adventure\r\nAfter landing in Kathmandu, your adventure continues with a smooth transfer to your hotel. As you drive through the bustling streets of Kathmandu, you can reflect on the Everest helicopter tour experience, the incredible views, and the unforgettable memories made during the day. This final leg of the journey offers a chance to relax and unwind after your helicopter flight to Everest Base Camp.\r\n\r\nImportant Note For: \r\nEverest Helicopter Tour Timing (Due to Weather/Air Traffic)\r\nThe timing of flights during the Everest Base Camp Helicopter Tour can be subject to change due to weather conditions and air traffic in the Himalayan region. Weather in the mountains can be unpredictable, and safety is always the top priority. As a result, flights may be delayed or rescheduled.\r\n\r\nNTA (Nepal Trek Adventure) takes every measure to ensure that your tour proceeds safely and smoothly, but please be prepared for flexibility regarding flight timings. NTA will keep you informed about any changes to ensure your Everest Base Camp Helicopter Tour remains safe and enjoyable.'),
(7, 25, 'This Manakamana Darshan package cost 1850 (Non- Ac Hiace) or 1850(Hiace) covers the cost of the Hiace from Kathmandu to Kurintar and back to Kathmandu. Likewise, the Manakamana Cable Car Cost price is also included in this package. Likewise, you can book this package with Hike on Travels with online booking service with esewa.', 'Doesn\'t Includes\r\n\r\nHowever, the cost of the Manakamana tour Package does not include the cost of lunch and snacks during the tour.', 'Manakamana is one of the most popular religious places in Nepal. Millions of people from different places come to visit the Manakamana temple every year. People believe that their wish will be fulfilled after Manakamana Mandir Darsan so they visit there with a pure heart. Hike on Travel is making your tour more comfortable by providing a Manakamana Tour Package from Kathmandu and Pokhara so that you can enjoy your trip with your family. You can also visit Bandipur after Manakamana Mandir Darsan. You can book the Kathmandu Manakamana Bandipur Tour Package on Hike on Trek. So enjoy your tour with us.', '1day return-\r\n\r\nEarly morning drive to Kurintar by Hiace\r\nKurintar to Manakamana by Cable car\r\nManakamana Darshan\r\nBack to Kurintar and Lunch\r\nBack to Kathmandu\r\n2-day Manakamana Mandir Darshan tour\r\n\r\nDrive to Kurintar\r\nStay at the hotel at Kurintar\r\nEarly morning cable car to Manakamana\r\nBack to Kurintar and Lunch\r\nBack to Kathmandu');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `pidx` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `status` enum('Completed','Expired','User canceled','Pending') NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `pidx`, `transaction_id`, `amount`, `status`, `payment_method`, `user_id`, `user_email`, `package_name`, `created_at`) VALUES
(1, 'gYPS4Zt6Eyx4jkT3Xxanma', 'QwtMwJAZxkYYxhZMzcYpm2', 0.00, 'Completed', 'Khalti', 8, 'raimanish489@gmail.com', 'Manakamana Temple', '2025-03-08 21:17:07'),
(2, '6pnaos4Zc8cp6BGcUkLyHM', 'SPSNeUaXEbpEM8632o5Vz7', 0.01, 'Completed', 'Khalti', 16, 'sumit9@gmail.com', 'MT. EVEREEST, Solukhumbu', '2025-03-08 21:30:10'),
(3, 'fxKiJZGQ8FNyi73WPivDnL', 'BZ7nKDmZFo3UtvQV6V4sXi', 0.00, 'Completed', 'Khalti', 16, 'sumit9@gmail.com', 'Chitwan National Park, Chitwan', '2025-03-08 21:38:43'),
(4, 'QhaKhSPPxPDLBVfz9H2M7Y', 'cFZMdDtwReXzL5GRpdc4NE', 0.00, 'Completed', 'Khalti', 19, 'radhe123@gmail.com', 'Kanyam, ilam', '2025-03-08 22:06:18'),
(5, 'djc2Y4ZGrpuLZrEHtbgNZb', 'FDtTDrYd2tAur7VAKakHtT', 0.00, 'Completed', 'Khalti', 21, 'anupthapa@gmail.com', 'Langtang Valley Trek', '2025-03-09 01:19:04'),
(6, 'sCavBXeHNHTK8Cp58efMbh', 'T9N4jsp9PS2LSsZmqBcVSZ', 0.00, 'Completed', 'Khalti', 19, 'radhe123@gmail.com', 'Bungee Jump, Pokhara', '2025-03-09 02:33:19'),
(7, 'Eq8Vi6pVfgpBVyATuR8MbR', 'yqZRNRrYVCAm9oBPhDmeKZ', 0.00, 'Completed', 'Khalti', 22, 'abrakadabra12@gmail.com', 'Manakamana Temple', '2026-05-04 11:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `tourism_packages`
--

CREATE TABLE `tourism_packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `package_type` enum('top','other') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `photo_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourism_packages`
--

INSERT INTO `tourism_packages` (`id`, `package_name`, `description`, `package_type`, `price`, `photo_url`, `created_at`, `days`) VALUES
(7, 'Mustang', 'hotspot nepal', 'other', 100100.00, 'img/g1.png', '2025-01-22 06:14:39', 0),
(15, 'Mukhtinaath', 'religious place to visit', 'other', 10000.00, 'img/Rara-Lake-Trekking-in-mustang-region.jpg', '2025-02-27 04:50:18', 7),
(17, 'Mount. Kanchenjunga', 'Kanchenjunga trek, the journey to the foothills of the third-tallest mountain in the world at an altitude of 8,586 meters (28,169 feet) is a unique and immersive adventure that explores the remote virgin terrains of the Himalayas. Unlike other mainstream trekking expeditions this scenic experience follows the natural off-beaten pristine trails across rugged landscapes, soaring mountain rivers, lush forests to high-Himalayan kharkas, and glacial moraines.\r\n\r\nNot only this beautiful expedition lets you explore the Himalayan flora and fauna under the protection of the Kanchenjunga Conservation Area but also offers unprecedented views of the glorious Himalayan gems like Mera Peak, Twin Peak, Khumbhakarna Peak, Khabur, Makalu, Rathong, Kabru Dome including Kanchenjunga.\r\n\r\nIf you are looking to add more adventure of the Himalayas to your trophy list, away from the mainstream crowded route and opting for something more serene and immersive, this Kanchenjunga trekking expedition that explores the region of the second-tallest mountain in Nepal is something you don’t want to miss.', 'other', 330000.00, 'img/Kanchenjunga mount.jpg', '2025-02-28 05:32:33', 21),
(20, 'K ho k', 'kei xaina', 'other', 121212.00, 'img/earth_light.jpg', '2025-03-07 14:24:23', 2),
(23, 'Chitwan National Park, Chitwan', 'One of the most popular tourist destinations in the world is Nepal. Nepal is well-known across the world not just for its mountains and trekking, but also for its spectacular wildlife, lush vegetation, and vibrant culture and traditions. You should choose the 3-day Chitwan National Park Tour Package from among the many treks and tours available in Nepal because it combines the exploration of flora and wildlife with a rich cultural and traditional experience. You will be more in touch with nature, and there is nothing more enjoyable than discovering what it is like to live in Nepal at a specific moment.', 'other', 9000.00, 'img/chitwan np.jpg', '2025-03-08 08:51:57', 3),
(24, 'MT. EVEREEST, Solukhumbu', 'Explore an extraordinary adventure tour to the iconic Mount Everest with our carefully curated collection of the 14 best Mount Everest tour packages. Created by local travel experts who know the region intimately, these tours offer an immersive experience in the heart of the majestic Himalayas. From thrilling treks to breathtaking helicopter tours, we have options to suit every adventurer\'s desire. Join us as we unveil the wonders of Everest and create unforgettable memories in the lap of nature\'s grandeur.', 'top', 3.00, 'img/mt_everest.jpg', '2025-03-08 09:27:28', 11),
(25, 'Manakamana Temple', 'Max Altitute:1302 m\r\nPrice: 1920 Hiace, ( Cable Car Cost Price included)\r\nDifficulty:Beginner\r\nDuration:Daily', 'top', 2005.00, 'img/manakamana-darshan.jpg', '2025-03-08 09:33:21', 1),
(27, 'Kanyam, ilam', 'Kanyam is a town and a tourist destination located in Ilam District of Nepal. It comes under Suryodaya Municipality in Ilam District in Koshi Province of eastern Nepal. It is situated at coordinates 27.1536° N and 87.9336°W.', 'other', 10.00, 'img/kanyam.jpg', '2025-03-08 22:01:48', 2),
(28, 'Lumbini Temple, Rupandehi-Lumbini', 'The birthplace of Prince Siddhartha Gautama, who the world came to know as the Buddha, Lumbini is a UNESCO World Heritage Site that houses several monuments of Buddhist and historical significance. Despite being a while away from Nepal’s popular Kathmandu-Pokhara-Chitwan golden triangle, Lumbini draws people – primarily pilgrims – to walk in the footsteps of its most famous resident from over 2500 years ago.', 'top', 20.00, 'img/BRP_Lumbini_Mayadevi_temple.jpg', '2025-03-08 22:31:06', 1),
(29, 'Langtang Valley Trek', 'Langtang Valley Trek is a pleasant trip in Nepal that begins with a tour of Kathmandu’s UNESCO World Heritage Sites followed by a drive to Syabrubesi on the next day. Following our route map, we begin trekking in Nepal from the lower region of the Langtang Valley. Passing through the Langtang National Park and small villages, farmlands and verdant forests, we reach Kyangjin Gompa.', 'other', 10.00, 'img/langtang.jpeg', '2025-03-08 22:35:10', 3),
(30, 'Bungee Jump, Pokhara', 'The Road to Fall from Heaven', 'top', 40.00, 'img/bungee.jpg', '2025-03-09 02:31:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `datetime`, `phone`) VALUES
(4, 'sumit123', 'tiruwa', 'sumit123@gmail.com', '$2y$10$xwT3PLz1bliN1iilT.rHvOudJhU1atiO1GGbRV.10Vf2CCcIzEosS', '2024-12-28 15:15:13', NULL),
(7, 'Anup', 'Thapa', 'thapanaanup66@gmail.com', '$2y$10$gHwy10sDvdZdOJf0pRv2neHgTxkEON/v4a9nXGbKha0bU76b.MFhW', '2024-12-30 22:59:07', NULL),
(8, 'Manish', 'Rai', 'raimanish489@gmail.com', '$2y$10$Rnh8COsHJsekmSg2wS633OPdHuqqrVk3U705nAbYzWvQilmKIGLD6', '2024-12-31 08:03:34', NULL),
(12, 'sumit', 'tiruwa', 'sumit913@gmail.com', '$2y$10$fZrE2V1wlmIDAarTsT/rLew1vGnne/u5ZIAfknYxmat7ewSnnctR6', '2025-01-22 21:47:02', NULL),
(13, 'bhupen', 'lamo', 'gffh@gf.com', '$2y$10$qJKUXFJEYX9xOi.AjAwcqumnVHCfd8FWqsyOngmojRh5EXcybn7uq', '2025-01-24 09:20:29', NULL),
(14, 'Rahul', 'Sha', 'rahulsha16@gmail.com', '$2y$10$F39B554ipflhD3LHa/lIN.TieFRBk5mG8FlSeS0H07aIy7TgWnf7i', '2025-01-24 12:57:40', NULL),
(16, 'Sumit', 'Tiruwa', 'sumit9@gmail.com', '$2y$10$ApMs0JaUF8ZGsi9S1TEcL.q.JwGJvc5lv4CwQI.ih41aeCk4QPWzm', '2025-02-18 14:27:45', NULL),
(17, 'Raja', 'Babu', 'sumit10@gmail.com', '$2y$10$ov3IUOr5RHH.sK0hzwRR0OABiBsZtpMh3YS5rVfOfafyng1BOtyNy', '2025-02-19 10:51:05', NULL),
(18, 'Sachin', 'Shrestha', 'sachin66@gmail.com', '$2y$10$0fYmYvJ3e/80TyhDh45rDOKoggjVLARM5to6Sp2XrBuRKHdL2UHhi', '2025-02-20 19:21:21', NULL),
(19, 'Radhe', 'Shyam', 'radhe123@gmail.com', '$2y$10$Nhf.WE6QT0BJq0tiWxPLw.wbPnT2vfURq/DfHB4ztNJQ0gHqNmx0a', '2025-03-07 15:14:51', NULL),
(20, 'Raja', 'Hindusthani', 'rajahindu123@gmail.com', '$2y$10$pbNOorZdrMhbXB6PiudsjugsZgR0BL9fYz/raYUhWAfpAKKkn1Xzq', '2025-03-09 03:39:23', NULL),
(21, 'Anup', 'Thapa', 'anupthapa@gmail.com', '$2y$10$I85biNZ0j2WXGbIZR7lGtOLAUttgqLZtEAOzQcc1Bp3Jv0krTfoEO', '2025-03-09 07:02:12', NULL),
(22, 'Abra', 'Kadabra', 'abrakadabra12@gmail.com', '$2y$10$1GW4h.C39FYnC9o5l/tqE.SR1AmYW6F9y2Jd.ZwfJeOiae0ktA30m', '2026-05-04 16:49:59', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `contactmessages`
--
ALTER TABLE `contactmessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_details`
--
ALTER TABLE `package_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourism_packages`
--
ALTER TABLE `tourism_packages`
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
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contactmessages`
--
ALTER TABLE `contactmessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `package_details`
--
ALTER TABLE `package_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tourism_packages`
--
ALTER TABLE `tourism_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `tourism_packages` (`id`);

--
-- Constraints for table `package_details`
--
ALTER TABLE `package_details`
  ADD CONSTRAINT `package_details_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `tourism_packages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
