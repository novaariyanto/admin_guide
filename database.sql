-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 28, 2020 at 03:40 AM
-- Server version: 10.3.12-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gotstar`
--

-- --------------------------------------------------------

--
-- Table structure for table `audio`
--

CREATE TABLE `audio` (
  `id` int(11) NOT NULL,
  `audio_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `audio_desc` varchar(255) CHARACTER SET utf8 NOT NULL,
  `audio_image` text NOT NULL,
  `audio_url` varchar(255) NOT NULL,
  `audio_view` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audio`
--

INSERT INTO `audio` (`id`, `audio_name`, `audio_desc`, `audio_image`, `audio_url`, `audio_view`, `status`) VALUES
(1, 'Test Audio11', 'Test Audio11', '188925_199339330100455_2758016_n.png', 'http://cdn-fms.rbs.com.br/vod/hls_sample1_manifest.m3u8', 6, 'enable'),
(3, 'Gdzie r?ce dotykaj? 2018 Lektor', 'tyuiy', '26992615_740199652838046_6046113874915159450_n.png', 'http://gotstar.divinetechs.com/assets/images/channel/sl.m3u8', 5, 'enable'),
(4, 'Gdzie r?ce dotykaj? 2018 Lektor', 'ergdfg11', '27067457_209049692992495_8221584755043866292_n.jpg', 'http://gotstar.divinetechs.com/assets/images/channel/sl.m3u8', 10, 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(1) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_image` varchar(255) NOT NULL,
  `c_date` datetime NOT NULL,
  `c_status` varchar(255) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `cat_name`, `cat_image`, `c_date`, `c_status`, `id_user`) VALUES
(1, 'Drama', 'App_icon.png', '0000-00-00 00:00:00', 'enable', NULL),
(2, 'Reality', 'news6.jpg', '0000-00-00 00:00:00', 'enable', NULL),
(3, 'Romance', 'news6.jpg', '2019-08-22 04:00:48', 'enable', NULL),
(4, 'Family', 'App_icon.png', '2019-09-01 10:52:14', 'enable', NULL),
(5, 'Action', 'App_icon.png', '2019-09-01 10:52:27', 'enable', NULL),
(6, 'Crime', 'App_icon.png', '2019-09-01 10:52:33', 'enable', NULL),
(7, 'Thriller', 'App_icon.png', '2019-09-01 10:52:52', 'enable', NULL),
(8, 'Comedy', 'App_icon.png', '2019-09-01 10:53:03', 'enable', NULL),
(9, 'Kids', 'App_icon.png', '2019-09-01 10:53:08', 'enable', NULL),
(10, 'Biopic', 'App_icon.png', '2019-09-01 10:53:19', 'enable', NULL),
(11, 'Documentary', 'App_icon.png', '2019-09-01 10:53:33', 'enable', NULL),
(12, 'Teen', 'App_icon.png', '2019-09-01 10:53:42', 'enable', NULL),
(13, 'TalkShow', 'App_icon.png', '2019-09-01 10:53:56', 'enable', NULL),
(15, 'news', '', '2019-09-01 03:36:50', 'enable', 2),
(16, 'DJ Alok', 'https://ggwp.id/media/wp-content/uploads/2020/05/dj-alok-700x394.jpg', '2020-07-24 01:35:19', 'enable', 1);

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` int(11) NOT NULL,
  `channel_name` varchar(255) NOT NULL,
  `channel_desc` text NOT NULL,
  `channel_image` text NOT NULL,
  `channel_url` text NOT NULL,
  `is_premium` int(11) NOT NULL,
  `channel_view` int(11) NOT NULL,
  `status` text NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `channel_name`, `channel_desc`, `channel_image`, `channel_url`, `is_premium`, `channel_view`, `status`, `id_user`) VALUES
(19, 'NBC News', 'NBC News', 'og-nbcnews1200x630.png', 'http://gotstar.divinetechs.com/assets/images/channel/sl.m3u8', 0, 0, 'enable', NULL),
(20, 'Sports', 'Sports news', 'sport_093234.jpeg', 'https://ndtv24x7elemarchana.akamaized.net/hls/live/2003678/ndtv24x7/ndtv24x7master.m3u8', 0, 0, 'enable', NULL),
(21, 'BBC News', 'BBC news', 'bbc_one_897908.png', 'https://ndtv24x7elemarchana.akamaized.net/hls/live/2003678/ndtv24x7/ndtv24x7master.m3u8', 0, 0, 'enable', NULL),
(22, 'News live', 'News live channel Description', 'All-the-Private-and-Govt-Schools-will-be-opened-on-21-02-2019.png', 'https://ndtv24x7elemarchana.akamaized.net/hls/live/2003678/ndtv24x7/ndtv24x7master.m3u8', 0, 0, 'enable', NULL),
(23, 'BBC One', 'BBC One is news channel ', 'https://media.suara.com/pictures/970x544/2020/06/17/88979-hana-hanifah.jpg', 'https://video.xx.fbcdn.net/v/t42.9040-2/10000000_532197060741128_4192903166351638528_n.mp4?_nc_cat=109&_nc_sid=985c63&efg=eyJ2ZW5jb2RlX3RhZyI6InN2ZV9zZCJ9&_nc_ohc=H6SmTuot000AX_zpWay&_nc_ht=video.fsrg1-1.fna&oh=e3506c9512f25a5f07f34e7855d4bcfd&oe=5F1929F4', 0, 0, 'enable', NULL),
(24, 'test', 'test', 'https://cdn2.tstatic.net/wartakota/foto/bank/images/artis-hana-hanifah7.jpg', 'https://video-bos3-1.xx.fbcdn.net/v/t39.24130-2/10000000_728581647927684_7342512477211678802_n.mp4?_nc_cat=104&_nc_sid=985c63&efg=eyJ2ZW5jb2RlX3RhZyI6Im9lcF9oZCJ9&_nc_ohc=DHatmqsJ9uoAX8t4HGZ&_nc_oc=AQlChfg5XpEUPDRs127__mvfZSFNPJxXwNXu2C0L90y188cCO-coY2D55kxgBXz7Cog&_nc_ht=video-bos3-1.xx&oh=757944a7be478566afb70af06a69824f&oe=5F3EBCA3', 0, 0, 'enable', 1),
(25, 'test 2', 'ewr3test', 't', 'tes', 0, 0, 'enable', 1);

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `d_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tv_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `download`
--

INSERT INTO `download` (`d_id`, `user_id`, `tv_id`, `a_id`) VALUES
(1, 1, 73, 0),
(2, 1, 74, 0),
(3, 1, 75, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gs_general_setting`
--

CREATE TABLE `gs_general_setting` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gs_general_setting`
--

INSERT INTO `gs_general_setting` (`id`, `key`, `value`) VALUES
(10, 'host_email', 'support@divinetechs.com'),
(11, 'app_name', 'GotStar App'),
(12, 'app_desripation', 'GotStar - Live Streaming / Live TV - Watch TV Shows, Movies, Live Cricket Matches & News Online'),
(13, 'app_logo', 'app_icon.png'),
(14, 'app_version', '1.0'),
(15, 'Author', 'DivineTechs'),
(16, 'contact', '123456789'),
(17, 'email', 'info@streambang.com'),
(18, 'website', 'www.streambang.com'),
(19, 'privacy_policy', 'privacy policy'),
(20, 'publisher_id', 'ca-app-pub-3940256099942544'),
(21, 'banner_ad', 'yes'),
(22, 'banner_adid', 'ca-app-pub-3940256099942544/6300978111'),
(23, 'interstital_ad', 'yes'),
(24, 'interstital_adid', 'ca-app-pub-3940256099942544/1033173712'),
(25, 'interstital_adclick', '5'),
(26, 'onesignal_apid', '297d8252-6262-4aad-99e5-55b43695ae6b'),
(27, 'onesignal_rest_key', 'MDA2MTI2NmYtMTgzMy00MThjLTliNDYtMzFiZWQwMTI2MDA0');

-- --------------------------------------------------------

--
-- Table structure for table `gs_user`
--

CREATE TABLE `gs_user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `c_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `level` int(11) DEFAULT NULL,
  `app_id` varchar(200) DEFAULT NULL,
  `key_app` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gs_user`
--

INSERT INTO `gs_user` (`id`, `fullname`, `email`, `password`, `mobile_number`, `c_date`, `level`, `app_id`, `key_app`) VALUES
(1, 'admin', 'admin@gmail.com', '12345', '9898352931', '2020-07-24 11:30:10', 1, '297d8252-6262-4aad-99e5-55b43695ae6b', 'MDA2MTI2NmYtMTgzMy00MThjLTliNDYtMzFiZWQwMTI2MDA0'),
(2, 'alok', 'alok@gmail.com', '12345', '01923103', '2020-07-23 01:47:01', 1, NULL, NULL),
(28, 'nova', 'nova@gmail.com', 'sekolah100%', '0896454673797', '2020-07-23 01:37:41', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie_video`
--

CREATE TABLE `movie_video` (
  `tvv_id` int(11) NOT NULL,
  `tvv_name` varchar(255) NOT NULL,
  `tvv_thumbnail` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video_url` text CHARACTER SET latin1 NOT NULL,
  `is_premium` int(11) NOT NULL,
  `tvv_description` text NOT NULL,
  `tvv_view` int(11) NOT NULL,
  `tvv_download` int(11) NOT NULL,
  `v_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_date` datetime NOT NULL,
  `fc_id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movie_video`
--

INSERT INTO `movie_video` (`tvv_id`, `tvv_name`, `tvv_thumbnail`, `tvv_video`, `tvv_video_type`, `tvv_video_url`, `is_premium`, `tvv_description`, `tvv_view`, `tvv_download`, `v_type`, `tvv_date`, `fc_id`, `id_user`) VALUES
(155, 'test alok', 'alok', '', 'Link Video', 'tes', 0, 'test alok', 0, 0, 'movie', '2020-07-23 01:51:08', 1, 2),
(156, 'text', 'https://ggwp.id/media/wp-content/uploads/2020/06/GoPay-Arena-Championship-Thumb.jpg', '', 'Facebook Video', 'https://video.xx.fbcdn.net/v/t42.9040-2/10000000_2735347513410466_6677757117675009794_n.mp4?_nc_cat=105&_nc_sid=985c63&efg=eyJ2ZW5jb2RlX3RhZyI6InN2ZV9zZCJ9&_nc_ohc=-Y8s0RsQ_wAAX9OQDM0&_nc_ht=video-lga3-1.xx&oh=6b0e4e87c22ed60aa4ced9086a3be2af&oe=5F1B386E', 0, 'test', 0, 0, 'movie', '2020-07-24 05:08:52', 1, NULL),
(158, 'test', 'https://d1x91p7vw3vuq8.cloudfront.net/20200204/328fdc83b101b5b54f9fca0581f96cc48dfe6fa438d19d78838632d907b29fbf.jpg', 'https://www.facebook.com/watch/?v=2697224067174214', 'Facebook Video', 'https://www.facebook.com/watch/?v=2697224067174214', 0, 'test', 0, 0, 'movie', '2020-07-27 02:43:59', 16, 1),
(159, 'alok ksva', 'https://esportsk.b-cdn.net/wp-content/uploads/2020/07/Kacamata-DJ-Alok-1.jpg', '', 'Facebook Video', 'adfasf', 0, 'addas', 0, 0, 'movie', '2020-07-27 03:36:03', 16, 1),
(160, 'alok sdga', 'https://ik.imagekit.io/afkmedia/media/images/48283-DJ%20Alok%20Free%20Fire.png', '', 'Link Video', 'adfasf', 0, 'adfafd', 0, 0, 'movie', '2020-07-27 03:36:34', 16, 1),
(161, 'video youtube', 'https://i.ytimg.com/vi/H7mJDFTy0MQ/hqdefault.jpg', '', 'Youtube Video', 'https://www.youtube.com/watch?v=dZHYU6FyrWU', 0, 'test', 0, 0, 'movie', '2020-07-28 03:12:54', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_video`
--

CREATE TABLE `news_video` (
  `tvv_id` int(11) NOT NULL,
  `tvv_name` varchar(255) NOT NULL,
  `tvv_thumbnail` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video_url` text CHARACTER SET latin1 NOT NULL,
  `is_premium` int(11) NOT NULL,
  `tvv_description` text NOT NULL,
  `tvv_view` int(11) NOT NULL,
  `tvv_download` int(11) NOT NULL,
  `v_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_date` datetime NOT NULL,
  `fc_id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news_video`
--

INSERT INTO `news_video` (`tvv_id`, `tvv_name`, `tvv_thumbnail`, `tvv_video`, `tvv_video_type`, `tvv_video_url`, `is_premium`, `tvv_description`, `tvv_view`, `tvv_download`, `v_type`, `tvv_date`, `fc_id`, `id_user`) VALUES
(145, 'Climate change: India pitches for financial support by developed nations', 'PRAKASH.jpeg', '', 'Youtube Video', 'https://www.youtube.com/watch?v=Gqcd0GjBciQ', 0, 'Climate change: India pitches for financial support by developed nations jhjh', 0, 0, 'news', '2020-07-23 02:12:18', 15, 0),
(151, 'berita free fire', 'https://i.ytimg.com/vi/H7mJDFTy0MQ/hqdefault.jpg', '', 'Youtube Video', 'https://i.ytimg.com/vi/H7mJDFTy0MQ/hqdefault.jpg', 0, 'test', 0, 0, 'news', '2020-07-28 03:17:06', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sport_video`
--

CREATE TABLE `sport_video` (
  `tvv_id` int(11) NOT NULL,
  `tvv_name` varchar(255) NOT NULL,
  `tvv_thumbnail` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video_url` text CHARACTER SET latin1 NOT NULL,
  `is_premium` int(11) NOT NULL,
  `tvv_description` text NOT NULL,
  `tvv_view` int(11) NOT NULL,
  `tvv_download` int(11) NOT NULL,
  `v_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_date` datetime NOT NULL,
  `fc_id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sport_video`
--

INSERT INTO `sport_video` (`tvv_id`, `tvv_name`, `tvv_thumbnail`, `tvv_video`, `tvv_video_type`, `tvv_video_url`, `is_premium`, `tvv_description`, `tvv_view`, `tvv_download`, `v_type`, `tvv_date`, `fc_id`, `id_user`) VALUES
(144, 'test 2 ', 'https://dailyspin.id/wp-content/uploads/2020/07/free-fire-alok-character-c608.jpg', '', 'Facebook Video', 'https://www.facebook.com/watch/?v=1455406401297122', 0, 'test', 0, 0, 'sport', '2020-07-27 02:31:30', 16, 1),
(145, 'test 2 ', 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEhUSEhMVFhUXFRUVFRYVFRUVFxUXFRUWFhUVFRUYHSggGBolHRUVITEhJSkrLjAuFx8zODMsNygtLisBCgoKDg0OGhAQGi0lHyUtLS0tLS0tLS0tLS0tMi0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAKgBLAMBEQACEQEDEQH/', '', 'Facebook Video', 'test', 0, 'test', 0, 0, 'sport', '2020-07-27 02:22:00', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_plan`
--

CREATE TABLE `sub_plan` (
  `sub_id` int(11) NOT NULL,
  `sub_name` text NOT NULL,
  `sub_price` int(11) NOT NULL,
  `currency_type` varchar(255) NOT NULL,
  `sub_type` enum('month','year') NOT NULL DEFAULT 'month',
  `sub_time` int(11) NOT NULL,
  `sub_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_plan`
--

INSERT INTO `sub_plan` (`sub_id`, `sub_name`, `sub_price`, `currency_type`, `sub_type`, `sub_time`, `sub_status`) VALUES
(1, 'Annual', 999, '$', 'year', 1, 1),
(2, 'Monthly', 299, '$', 'month', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tran_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tran_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tran_id`, `user_id`, `sub_id`, `status`, `tran_date`) VALUES
(14, 1, 2, 1, '2019-09-17 15:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `tv_serial`
--

CREATE TABLE `tv_serial` (
  `tvs_id` int(11) NOT NULL,
  `tvs_name` varchar(255) NOT NULL,
  `tvs_image` varchar(255) NOT NULL,
  `tvs_view` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `tvs_date` datetime NOT NULL,
  `fc_id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_serial`
--

INSERT INTO `tv_serial` (`tvs_id`, `tvs_name`, `tvs_image`, `tvs_view`, `type`, `tvs_date`, `fc_id`, `id_user`) VALUES
(62, 'Mangal Gyan', 'https://inilahonline.com/wp-content/uploads/2018/03/INDOSIAR.png', 0, 'tv', '2019-09-01 11:58:29', 13, NULL),
(63, 'Baadshaho', 'maxresdefault_badshaho.jpg', 0, 'movie', '2019-09-01 12:04:59', 1, NULL),
(82, 'Kabil', 'kabil_1234ed.jpg', 0, 'movie', '2019-09-01 01:33:39', 8, NULL),
(83, 'Badminton', 'Badminton-1428046.jpg', 0, 'sport', '2019-09-01 02:00:49', 14, NULL),
(84, 'Cricket', 'cricket_9809d.png', 0, 'sport', '2019-09-01 02:02:31', 14, NULL),
(85, 'Kabaddi', 'pro-kabaddi-league-match_ce871490.jpg', 0, 'sport', '2019-09-01 02:03:26', 14, NULL),
(86, 'NBC News', 'og-nbcnews1200x630.png', 0, 'news', '2019-09-01 03:57:43', 15, NULL),
(95, 'test', 'https://inilahonline.com/wp-content/uploads/2018/03/INDOSIAR.png', 0, 'tv', '2020-07-23 03:37:39', 5, NULL),
(96, 'test', 'https://inilahonline.com/wp-content/uploads/2018/03/INDOSIAR.png', 0, 'tv', '2020-07-24 01:49:32', 2, 1),
(97, 'DJ Alok Tips 1', 'https://ggwp.id/media/wp-content/uploads/2020/06/alok-gopay-2.jpg', 0, 'tv', '2020-07-24 01:55:31', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tv_video`
--

CREATE TABLE `tv_video` (
  `tvv_id` int(11) NOT NULL,
  `tvv_name` varchar(255) NOT NULL,
  `tvv_thumbnail` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_video_url` text CHARACTER SET latin1 NOT NULL,
  `is_premium` int(11) NOT NULL,
  `tvv_description` text NOT NULL,
  `tvv_view` int(11) NOT NULL,
  `tvv_download` int(11) NOT NULL,
  `v_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tvv_date` datetime NOT NULL,
  `ftvs_id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tv_video`
--

INSERT INTO `tv_video` (`tvv_id`, `tvv_name`, `tvv_thumbnail`, `tvv_video`, `tvv_video_type`, `tvv_video_url`, `is_premium`, `tvv_description`, `tvv_view`, `tvv_download`, `v_type`, `tvv_date`, `ftvs_id`, `id_user`) VALUES
(83, 'ek thi rani ek tha ravan - Episode 3', 'ek-thi-rani-ek-thi-ravan.jpg', 'ye rishte hain pyar ke.mp4', 'Server Video', '', 0, 'Ram and Mayura get ready for their wedding while Premlata implements her sneaky plan. Amidst the ceremony, Mayura is in for a big surprise.', 0, 0, 'tv', '2019-09-01 11:34:37', 51, NULL),
(84, 'Nack baliye - Episode 1', 'DSC100162075.jpg', 'dance_video_2019_11_01.mp4', 'Server Video', '', 0, 'Witness the high voltage drama as the Chhichhores, Shraddha Kapoor and Sushant Singh Rajput, make a smashing entry. Later, FaiSaan brings the house down, for the fifth time in a row, with their scintillating performance. WATCHLIST  SHARE', 0, 0, 'tv', '2019-09-01 11:47:58', 52, NULL),
(85, 'Nack baliye - Episode 2', '1226072404cf8ae070429a94a384ce09.jpg', 'dance_video_2019_11_01.mp4', 'Server Video', '', 0, 'Witness the high voltage drama as the Chhichhores, Shraddha Kapoor and Sushant Singh Rajput, make a smashing entry. Later, FaiSaan brings the house down, for the fifth time in a row, with their scintillating performance. WATCHLIST  SHARE', 0, 0, 'tv', '2019-09-01 11:52:37', 52, NULL),
(86, 'Nack baliye - Episode 3', 'Hip-Hop-Dance-Girl-Wallpaper.jpg', 'dance_video_2019_11_01.mp4', 'Server Video', '', 0, 'Witness the high voltage drama as the Chhichhores, Shraddha Kapoor and Sushant Singh Rajput, make a smashing entry. Later, FaiSaan brings the house down, for the fifth time in a row, with their scintillating performance. WATCHLIST  SHARE', 0, 0, 'tv', '2019-09-01 11:53:09', 52, NULL),
(87, 'Little Champ - Episode -1', '1552714940_sa-re-ga-ma-pa-lil-champs.jpg', 'voice_2019_11_01.mp4', 'Server Video', '', 0, 'It\'s time for the Blind Auditions! Talented singers from across the country are here. Whose voice will impress the Super Guru A R Rahman and the coaches - Adnan Sami, Harshdeep Kaur, Kanika Kapoor and Armaan Malik?', 0, 0, 'tv', '2019-09-01 11:59:41', 53, NULL),
(88, 'Little Champ - Episode -2', 'Sa-Re-Ga-Ma-Pa-Lil-Champs-Season-14.jpg', 'voice_2019_11_01.mp4', 'Server Video', '', 0, 'Witness the high voltage drama as the Chhichhores, Shraddha Kapoor and Sushant Singh Rajput, make a smashing entry. Later, FaiSaan brings the house down, for the fifth time in a row, with their scintillating performance. WATCHLIST  SHARE', 0, 0, 'tv', '2019-09-01 12:00:32', 53, NULL),
(89, 'Little Champ - Episode -3', 'Sa-Re-Ga-Ma-Pa-Lil-Champs-2019-Grand-Premiere.jpg', 'voice_2019_11_01.mp4', 'Server Video', '', 0, 'Ram and Mayura get ready for their wedding while Premlata implements her sneaky plan. Amidst the ceremony, Mayura is in for a big surprise.', 0, 0, 'tv', '2019-09-01 12:01:30', 53, NULL),
(90, 'kaha hum kaha tum - Episode -1', 'gossip-1561702619.jpg', 'ye rishte hain pyar ke.mp4', 'Server Video', '', 0, 'Kuhu leaves Mishti teary-eyed for interfering in her life while Varsha confronts Kuhu about her marriage. Later, Mishti cancels her date with Abir.', 0, 0, 'tv', '2019-09-01 12:13:04', 54, NULL),
(91, 'kaha hum kaha tum - Episode -2', 'Capture-ronakshi1.png', 'ye rishte hain pyar ke.mp4', 'Server Video', '', 0, 'Naksh celebrates Raksha Bandhan with Naira. Later, Kartik is furious at Naira\'s surprising move while Suhasini decides to bring Kairav home.', 0, 0, 'tv', '2019-09-01 12:16:25', 54, NULL),
(92, 'kaha hum kaha tum - Episode -3', 'Kahahum.jpg', 'ye rishte hain pyar ke.mp4', 'Server Video', '', 0, 'Kuhu leaves Mishti teary-eyed for interfering in her life while Varsha confronts Kuhu about her marriage. Later, Mishti cancels her date with Abir.', 0, 0, 'tv', '2019-09-01 12:16:52', 54, NULL),
(93, 'kulfi kumar bajewala - Episode 1', 'maxresdefault.jpg', 'dance_video_2019_11_01.mp4', 'Server Video', '', 0, 'Amidst the Janmashtami celebrations, the Goenkas are surprised by Kairav\'s cute gestures. Later, Kartik finds himself in an odd situation.', 0, 0, 'tv', '2019-09-01 12:19:51', 55, NULL),
(94, 'kulfi kumar bajewala - Episode 2', '85532902Kulfi-Kumar-Bajewala-serial-in-Star-Plus.jpg', 'ye rishte hain pyar ke.mp4', 'Server Video', '', 0, 'Naksh celebrates Raksha Bandhan with Naira. Later, Kartik is furious at Naira\'s surprising move while Suhasini decides to bring Kairav home.', 0, 0, 'tv', '2019-09-01 12:20:10', 55, NULL),
(95, 'kulfi kumar bajewala - Episode 3', 'kulfi-kumar-bajewala-27-august-2019-written-update-full-episode-amyra-gets-in-a-fight-920x518.jpg', 'voice_2019_11_01.mp4', 'Server Video', '', 0, 'Amidst the Janmashtami celebrations, the Goenkas are surprised by Kairav\'s cute gestures. Later, Kartik finds himself in an odd situation.', 0, 0, 'tv', '2019-09-01 12:21:08', 55, NULL),
(96, 'Lamha - Episode -1', 'maxresdefault.jpg', 'dance_video_2019_11_01.mp4', 'Server Video', '', 0, 'Ram and Mayura get ready for their wedding while Premlata implements her sneaky plan. Amidst the ceremony, Mayura is in for a big surprise.', 0, 0, 'tv', '2019-09-01 12:24:43', 56, NULL),
(97, 'Lamha - Episode -2', 'maxresdefault_eredf.jpg', 'dance_video_2019_11_01.mp4', 'Server Video', '', 0, 'Ram and Mayura get ready for their wedding while Premlata implements her sneaky plan. Amidst the ceremony, Mayura is in for a big surprise.', 0, 0, 'tv', '2019-09-01 12:24:59', 56, NULL),
(98, 'Lamha - Episode -3', 'hqdefault.jpg', 'dance_video_2019_11_01.mp4', 'Server Video', '', 0, 'Ram and Mayura get ready for their wedding while Premlata implements her sneaky plan. Amidst the ceremony, Mayura is in for a big surprise.', 0, 0, 'tv', '2019-09-01 12:25:13', 56, NULL),
(99, 'Savdhan India - Episode - 1', 'Savdhaan_India-serial.jpg', '', 'Youtube Video', 'https://www.youtube.com/watch?v=_WzIRAk7brQ', 0, 'Naksh celebrates Raksha Bandhan with Naira. Later, Kartik is furious at Naira\'s surprising move while Suhasini decides to bring Kairav home.', 0, 0, 'tv', '2019-09-01 12:30:06', 57, NULL),
(100, 'Savdhan India - Episode -2', 'Savdhaan_India-serial.jpg', '', 'Youtube Video', 'https://www.youtube.com/watch?v=9-T04lcUKkQ', 0, 'Naksh celebrates Raksha Bandhan with Naira. Later, Kartik is furious at Naira\'s surprising move while Suhasini decides to bring Kairav home.', 0, 0, 'tv', '2019-09-01 12:31:17', 57, NULL),
(101, 'Najar - Episode 1', 'MONALIZA-NEW.jpg', 'ye rishte hain pyar ke.mp4', 'Server Video', '', 0, 'Naksh celebrates Raksha Bandhan with Naira. Later, Kartik is furious at Naira\'s surprising move while Suhasini decides to bring Kairav home.', 0, 0, 'tv', '2019-09-01 12:52:50', 58, NULL),
(148, 'test', 'test', '', 'Link Server', 'test', 0, 'test', 0, 0, 'tv', '2020-07-24 01:42:44', 95, NULL),
(150, 'test', 'https://inilahonline.com/wp-content/uploads/2018/03/INDOSIAR.png', '', 'Link Video', 'teata', 0, 'testwe', 0, 0, 'tv', '2020-07-24 02:15:23', 95, 1),
(151, 'test', 'https://inilahonline.com/wp-content/uploads/2018/03/INDOSIAR.png', '', 'Server Video', '', 0, 'tes', 0, 0, 'tv', '2020-07-24 02:03:21', 95, 1),
(152, 'test 2', 'https://inilahonline.com/wp-content/uploads/2018/03/INDOSIAR.png', '', 'Link Server', 'https://inilahonline.com/wp-content/uploads/2018/03/INDOSIAR.png', 0, 'test', 0, 0, 'tv', '2020-07-24 02:04:00', 62, 1),
(154, 'Take a giveaway to get dj alok 2', 'https://ggwp.id/media/wp-content/uploads/2020/06/alok-gopay-2.jpg', '', 'Facebook Video', 'https://video.xx.fbcdn.net/v/t42.9040-2/90650176_1586828178147608_9034331765740666880_n.mp4?_nc_cat=105&_nc_sid=985c63&efg=eyJ2ZW5jb2RlX3RhZyI6InN2ZV9zZCJ9&_nc_ohc=KdAWWaxFHGMAX__PTX2&_nc_ht=video-iad3-1.xx&oh=690a98a302839d14a633f5c842bdb890&oe=5F1B1496', 0, 'Take a giveaway to get dj alok from facebook', 0, 0, 'tv', '2020-07-24 02:17:00', 97, 1),
(155, 'Test youtube', 'https://freefiremobile-a.akamaihd.net/ffwebsite/images/character/list_img/laura.jpg', '', 'Link Video', 'https://www.youtube.com/watch?v=Fn-3h4_jW1U', 0, 'test', 0, 0, 'tv', '2020-07-24 04:46:07', 97, NULL),
(156, 'test favecook', 'https://ggwp.id/media/wp-content/uploads/2020/06/GoPay-Arena-Championship-Thumb.jpg', '', 'Facebook Server', 'https://video.xx.fbcdn.net/v/t42.9040-2/10000000_2735347513410466_6677757117675009794_n.mp4?_nc_cat=105&_nc_sid=985c63&efg=eyJ2ZW5jb2RlX3RhZyI6InN2ZV9zZCJ9&_nc_ohc=-Y8s0RsQ_wAAX9OQDM0&_nc_ht=video-lga3-1.xx&oh=6b0e4e87c22ed60aa4ced9086a3be2af&oe=5F1B386E', 0, 'test', 0, 0, 'tv', '2020-07-24 05:03:38', 97, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `w_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tv_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `watchlist`
--

INSERT INTO `watchlist` (`w_id`, `user_id`, `tv_id`, `a_id`, `c_id`) VALUES
(71, 1, 0, 4, 0),
(72, 28, 154, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audio`
--
ALTER TABLE `audio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `gs_general_setting`
--
ALTER TABLE `gs_general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gs_user`
--
ALTER TABLE `gs_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_video`
--
ALTER TABLE `movie_video`
  ADD PRIMARY KEY (`tvv_id`);

--
-- Indexes for table `news_video`
--
ALTER TABLE `news_video`
  ADD PRIMARY KEY (`tvv_id`);

--
-- Indexes for table `sport_video`
--
ALTER TABLE `sport_video`
  ADD PRIMARY KEY (`tvv_id`);

--
-- Indexes for table `sub_plan`
--
ALTER TABLE `sub_plan`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tran_id`);

--
-- Indexes for table `tv_serial`
--
ALTER TABLE `tv_serial`
  ADD PRIMARY KEY (`tvs_id`);

--
-- Indexes for table `tv_video`
--
ALTER TABLE `tv_video`
  ADD PRIMARY KEY (`tvv_id`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`w_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audio`
--
ALTER TABLE `audio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gs_general_setting`
--
ALTER TABLE `gs_general_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gs_user`
--
ALTER TABLE `gs_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `movie_video`
--
ALTER TABLE `movie_video`
  MODIFY `tvv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `news_video`
--
ALTER TABLE `news_video`
  MODIFY `tvv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `sport_video`
--
ALTER TABLE `sport_video`
  MODIFY `tvv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `sub_plan`
--
ALTER TABLE `sub_plan`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tv_serial`
--
ALTER TABLE `tv_serial`
  MODIFY `tvs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `tv_video`
--
ALTER TABLE `tv_video`
  MODIFY `tvv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
