-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2021 at 10:17 AM
-- Server version: 10.3.32-MariaDB-cll-lve
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sakisite_animal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_author_details`
--

CREATE TABLE `tbl_author_details` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fb` varchar(700) NOT NULL,
  `tw` varchar(700) NOT NULL,
  `ln` varchar(700) NOT NULL,
  `yt` varchar(700) NOT NULL,
  `ig` varchar(700) NOT NULL,
  `pn` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_author_details`
--

INSERT INTO `tbl_author_details` (`id`, `image`, `description`, `fb`, `tw`, `ln`, `yt`, `ig`, `pn`) VALUES
(1, 'e3f00b4960.png', '<p style=\"text-align: center;\">I&rsquo;m AKRAM HOSSAIN, a passionate traveler, photographer, and writer. I want to take risks, meet interesting people, go hard, challenge myself and explore the world.</p>', 'https://www.facebook.com/profile.php?id=100010944272366', 'https://twitter.com/', 'https://www.linkedin.com/', 'https://youtube.com', 'https://instagram.com/', 'https://pinterest.com/');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`) VALUES
(1, 'African'),
(2, 'Carnivore'),
(3, 'Herbivore'),
(4, 'Polar'),
(5, 'Marine');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `firstname`, `lastname`, `email`, `body`, `status`, `date`) VALUES
(1, 'Akram', 'Hossain', 'darkknight22050@gmail.com', 'Hi, My name is Akram Hossain Sakib. I am a Senior web application developer.', 0, '2021-05-05 09:54:32'),
(5, 'Sumon', 'Vai', 'mdnazmulhasan2885@gmail.com', 'Some Dummy Text..!', 0, '2021-05-15 15:03:39'),
(7, 'Nasir', 'Uddin', 'nasir.uddin.inc1227@gmail.com', 'DOM Sikhci', 0, '2021-05-26 05:42:19'),
(8, 'Mohammad', 'Siam', 'sayedakramsakib@gmail.com', 'Hello I am siam', 0, '2021-07-13 14:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_footer`
--

CREATE TABLE `tbl_footer` (
  `id` int(11) NOT NULL,
  `copyright` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_footer`
--

INSERT INTO `tbl_footer` (`id`, `copyright`) VALUES
(1, '© 2020 - <?php echo date(\'Y\'); ?> Akram Hossain - All Rights Reserved.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_footer_top_column_1`
--

CREATE TABLE `tbl_footer_top_column_1` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_footer_top_column_1`
--

INSERT INTO `tbl_footer_top_column_1` (`id`, `title`, `body`) VALUES
(1, 'ANIMAL MAGAZINE', '<p>Welcome to our complete News Portal about animals, nature, and the environment in general. Take your time and immerse yourself in this amazing experience. Take your time and immerse yourself in this amazing experience!</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_footer_top_column_2`
--

CREATE TABLE `tbl_footer_top_column_2` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `Home` varchar(255) NOT NULL,
  `About` varchar(255) NOT NULL,
  `Privacy Policy` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `home_link` varchar(700) NOT NULL,
  `about_link` varchar(700) NOT NULL,
  `privacy_link` varchar(700) NOT NULL,
  `contact_link` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_footer_top_column_2`
--

INSERT INTO `tbl_footer_top_column_2` (`id`, `title`, `Home`, `About`, `Privacy Policy`, `Contact`, `home_link`, `about_link`, `privacy_link`, `contact_link`) VALUES
(1, 'QUICK ACCESS', 'Home', 'About', 'Privacy Policy  ', 'Contact  ', 'http://localhost/animal/', 'http://localhost/animal/about.php', 'http://localhost/animal/page.php?pageid=1', 'http://localhost/animal/contact.php');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_footer_top_column_3`
--

CREATE TABLE `tbl_footer_top_column_3` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `fb_link` varchar(700) NOT NULL,
  `tw_link` varchar(700) NOT NULL,
  `gp_link` varchar(700) NOT NULL,
  `ln_link` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_footer_top_column_3`
--

INSERT INTO `tbl_footer_top_column_3` (`id`, `title`, `fb_link`, `tw_link`, `gp_link`, `ln_link`) VALUES
(1, 'FOLLOW US ON', 'https://www.facebook.com/', 'https://twitter.com/', 'https://plus.google.com/', 'https://www.linkedin.com/');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logotitle`
--

CREATE TABLE `tbl_logotitle` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `title` varchar(400) NOT NULL,
  `subtitle` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_logotitle`
--

INSERT INTO `tbl_logotitle` (`id`, `logo`, `title`, `subtitle`) VALUES
(1, '9183274dbf.png', 'Animals World', 'Save animal save world');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE `tbl_page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `title`, `body`) VALUES
(1, 'Privacy Policy', '<p>Privacey Policy page.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of thawdacxwrfcae printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.</p>\r\n<p>lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.</p>\r\n<p>Privacey Policy page.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.</p>\r\n<p>lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.</p>\r\n<p>Privacey Policy page.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.</p>\r\n<p>lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.</p>'),
(3, 'Terms & Condition', '<p>Terms &amp; Condition Page.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text of the printing and typesetting Industry.lorem Ipsum is simply dummy text</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `userid` int(11) NOT NULL,
  `count` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `cat`, `title`, `body`, `image`, `author`, `tags`, `date`, `userid`, `count`) VALUES
(1, 1, 'Honey Badger Takes on a Baboon', '<p>Find people with high expectations and a low tolerance for excuses. They&rsquo;ll have higher expectations for you than you have for yourself. Don&rsquo;t flatter yourself that this has much to do with you &ndash; this is just who they are. Don&rsquo;t look for &ldquo;nice&rdquo; in these relationships. Look for trust.Beauty Dust is very pretty to look at and it tastes like nothing, which is great. Here is what it&rsquo;s supposed to do: This ancient empiric formula expands beauty through alchemizing elements legendary for their youth preserving, fortifying and tonifying qualities. Glowing supple skin, lustrous shiny hair and twinkling bright eyes are holistically bestowed from the inside out.I actually first read this as alkalizing meaning effecting pH level, and I was like, OK I guess I understand how that could positively effect your body, but alchemizing means turning elements to gold basically through magic. That lead me to research each ingredient because I know alchemy is not actually happening in my body when I eat this, since alchemy is not real.</p>', '338162278d.jpg', 'Riaz', 'Baboon, African Baboon, Child Baboon', '2021-07-13 14:01:34', 2, 3),
(2, 1, 'Iguana with Back Fangs Spotted', '<p>Find people with high expectations and a low tolerance for excuses. They&rsquo;ll have higher expectations for you than you have for yourself. Don&rsquo;t flatter yourself that this has much to do with you &ndash; this is just who they are. Don&rsquo;t look for &ldquo;nice&rdquo; in these relationships. Look for trust.Beauty Dust is very pretty to look at and it tastes like nothing, which is great. Here is what it&rsquo;s supposed to do: This ancient empiric formula expands beauty through alchemizing elements legendary for their youth preserving, fortifying and tonifying qualities. Glowing supple skin, lustrous shiny hair and twinkling bright eyes are holistically bestowed from the inside out.I actually first read this as alkalizing meaning effecting pH level, and I was like, OK I guess I understand how that could positively effect your body, but alchemizing means turning elements to gold basically through magic. That lead me to research each ingredient because I know alchemy is not actually happening in my body when I eat this, since alchemy is not real. In addition to loving beauty and taking care of myself, I also love opening people minds to other paths of self-care, and good marketing and I can honestly say that I use and personally love this product but I&rsquo;m not sure for which reason.</p>', 'c309b5501c.jpg', 'Sakib', 'Tiger, African Tiger, Hungry Tiger', '2021-07-13 14:01:43', 3, 15),
(3, 1, 'Fight Between Two Huge Oryx', '<p>Find people with high expectations and a low tolerance for excuses. They&rsquo;ll have higher expectations for you than you have for yourself. Don&rsquo;t flatter yourself that this has much to do with you &ndash; this is just who they are. Don&rsquo;t look for &ldquo;nice&rdquo; in these relationships. Look for trust.Beauty Dust is very pretty to look at and it tastes like nothing, which is great. Here is what it&rsquo;s supposed to do: This ancient empiric formula expands beauty through alchemizing elements legendary for their youth preserving, fortifying and tonifying qualities. Glowing supple skin, lustrous shiny hair and twinkling bright eyes are holistically bestowed from the inside out.I actually first read this as alkalizing meaning effecting pH level, and I was like, OK I guess I understand how that could positively effect your body, but alchemizing means turning elements to gold basically through magic. That lead me to research each ingredient because I know alchemy is not actually happening in my body when I eat this, since alchemy is not real.</p>', '058bbfdb4f.jpg', 'Riaz', 'Ox, Fighter Ox, Jungle Ox', '2021-07-13 14:01:56', 2, 30),
(4, 3, 'Surpassing Wilderbeasts', '<p>Find people with high expectations and a low tolerance for excuses. They&rsquo;ll have higher expectations for you than you have for yourself. Don&rsquo;t flatter yourself that this has much to do with you &ndash; this is just who they are. Don&rsquo;t look for &ldquo;nice&rdquo; in these relationships. Look for trust.Beauty Dust is very pretty to look at and it tastes like nothing, which is great. Here is what it&rsquo;s ssadupposed to do: This ancient empiric formula expands beauty through alchemizing elements legendary for their youth preserving, fortifying and tonifying qualities. Glowing supple skin, lustrous shiny hair and twinkling bright eyes are holistically bestowed from the inside out.I actually first read this as alkalizing meaning effecting pH level, and I was like, OK I guess I understand how that could positively effect your body, but alchemizing means turning elements to gold basically through magic. That lead me to research each ingredient because I know alchemy is not actually happening in my body when I eat this, since alchemy is not real. In addition to loving beauty and taking care of myself, I also love opening people minds to other paths of self-care, and good marketing and I can honestly say that I use and personally love this product but I&rsquo;m not sure for which reason. I actually first read this as alkalizing meaning effecting pH level, and I was like, OK I guess I understand how that could positively effect your body, but alchemizing means turning elements to gold basically through magic. That lead me to research each ingredient because I know alchemy is not actually happening in my body when I eat this, since alchemy is not real.</p>', '682fabb54b.jpg', 'Riaz', 'Calm Tiger', '2021-05-23 10:18:06', 1, 26),
(5, 2, 'Zebras Hold New Record', '<p>Find people with high expectations and a low tolerance for excuses. They&rsquo;ll have higher expectations for you than you have for yourself. Don&rsquo;t flatter yourself that this has much to do with you &ndash; this is just who they are. Don&rsquo;t look for &ldquo;nice&rdquo; in these relationships. Look for trust.Beauty Dust is very pretty to look at and it tastes like nothing, which is great. Here is what it&rsquo;s supposed to do: This ancient empiric formula expands beauty through alchemizing elements legendary for their youth preserving, fortifying and tonifying qualities. Glowing supple skin, lustrous shiny hair and twinkling bright eyes are holistically bestowed from the inside out.I actually first read this as alkalizing meaning effecting pH level, and I was like, OK I guess I understand how that could positively effect your body, but alchemizing means turning elements to gold basically through magic. That lead me to research each ingredient because I know alchemy is not actually happening in my body when I eat this, since alchemy is not real. In addition to loving beauty and taking care of myself, I also love opening people minds to other paths of self-care, and good marketing and I can honestly say that I use and personally love this product but I&rsquo;m not sure for which reason.</p>', '32f9325a26.jpg', 'Admin', 'Elephant, Elephant shower, Big Elephant', '2021-05-26 05:24:00', 1, 18),
(8, 3, 'Pumas, Panthers &; Cougars', '<p>Find people with high expectations and a low tolerance for excuses. They&rsquo;ll have higher expectations for you than you have for yourself. Don&rsquo;t flatter yourself that this has much to do with you &ndash; this is just who they are. Don&rsquo;t look for &ldquo;nice&rdquo; in these relationships. Look for trust.Beauty Dust is very pretty to look at and it tastes like nothing, which is great. Here is what it&rsquo;s supposed to do: This ancient empiric formula expands beauty through alchemizing elements legendary for their youth preserving, fortifying and tonifying qualities. Glowing supple skin, lustrous shiny hair and twinkling bright eyes are holistically bestowed from the inside out.I actually first read this as alkalizing meaning effecting pH level, and I was like, OK I guess I understand how that could positively effect your body, but alchemizing means turning elements to gold basically through magic. That lead me to research each ingredient because I know alchemy is not actually happening in my body when I eat this, since alchemy is not real. In addition to loving beauty and taking care of myself, I also love opening people minds to other paths of self-care, and good marketing and I can honestly say that I use and personally love this product but I&rsquo;m not sure for which reason. I actually first read this as alkalizing meaning effecting pH level, and I was like, OK I guess I understand how that could positively effect your body, but alchemizing means turning elements to gold basically through magic. That lead me to research each ingredient because I know alchemy is not actually happening in my body when I eat this, since alchemy is not real.</p>', '5a188910ec.jpg', 'Admin', 'Puma Tiger, Calm Tiger', '2021-07-13 14:03:21', 1, 39),
(13, 1, 'Lorem ipsum dolor set', '<p>Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet. Lorem ipsum dolor set amet.&nbsp;</p>', '944dcc527d.jpg', 'Admin', 'Lorem Post', '2021-05-26 05:22:38', 1, 2),
(14, 5, 'Militery', '<p><span style=\"color: #292b2c; font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 18px; background-color: #ffffff;\">The significant thing that\'s driven as to where we are right now is a paradigm shift by China in moving to the sea,\" he said. \"We have watched them build and expand a conventional defensive force and kind of yawned for a long time until they went to sea.</span></p>', '18e80f8e63.jpg', 'Sakib', 'marine, sakib, riyaz, abbas', '2021-10-15 17:21:19', 1, 42);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slider` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `title`, `slider`) VALUES
(1, ' Lakhs of Taka even if the elephant dies', '4771987e22.jpg'),
(9, 'Mangrove Forest', '234ff3725e.jpg'),
(10, 'The planets forests are under threat', 'aeaea5af0a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team`
--

CREATE TABLE `tbl_team` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_team`
--

INSERT INTO `tbl_team` (`id`, `image`, `name`, `subtitle`, `body`, `email`, `contact`) VALUES
(3, '18c2d1c70c.jpg', 'Rayhan Rahat', 'CEO & Founder', '<p>Some text that describes me lorem ipsum ipsum lorem.</p>', 'jane@example.com', 'https://www.facebook.com/profile.php?id=100010944272366'),
(4, '3a47b4267c.jpg', 'Nafim Hasan', 'Art Director', '<p>Some text that describes me lorem ipsum ipsum lorem.</p>', 'mike@example.com', 'https://www.facebook.com/profile.php?id=100010944272366'),
(5, 'e2758572e1.jpg', 'Riaz Ahmed', 'Designer', '<p>Some text that describes me lorem ipsum ipsum lorem.</p>', 'riaz@example.com', 'https://www.facebook.com/nisshongojiboner.pothik');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_theme`
--

CREATE TABLE `tbl_theme` (
  `id` int(11) NOT NULL,
  `theme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_theme`
--

INSERT INTO `tbl_theme` (`id`, `theme`) VALUES
(1, 'default');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `image`, `username`, `password`, `email`, `details`, `role`) VALUES
(1, 'Akram Hossain', '0255f08c7e.jpg', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'darkknight22050@gmail.com', '<p>Hi I am a Senior Web Application Developer. I just learn one thing Money will make you happy in this world.</p>', 1),
(2, 'Riaz Ahmed', '14b4cf3156.jpg', 'Riaz', '21232f297a57a5a743894a0e4a801fc3', 'riazakhanda@gmail.com', '<p>Hi, I am Riaz. I am a professional React Js developer.</p>', 2),
(3, '', '', 'Sakib', '21232f297a57a5a743894a0e4a801fc3', 'sayedakramsakib@gmail.com', '', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_author_details`
--
ALTER TABLE `tbl_author_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_footer`
--
ALTER TABLE `tbl_footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_footer_top_column_1`
--
ALTER TABLE `tbl_footer_top_column_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_footer_top_column_2`
--
ALTER TABLE `tbl_footer_top_column_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_footer_top_column_3`
--
ALTER TABLE `tbl_footer_top_column_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_logotitle`
--
ALTER TABLE `tbl_logotitle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_team`
--
ALTER TABLE `tbl_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_theme`
--
ALTER TABLE `tbl_theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_author_details`
--
ALTER TABLE `tbl_author_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_footer`
--
ALTER TABLE `tbl_footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_footer_top_column_1`
--
ALTER TABLE `tbl_footer_top_column_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_footer_top_column_2`
--
ALTER TABLE `tbl_footer_top_column_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_footer_top_column_3`
--
ALTER TABLE `tbl_footer_top_column_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_logotitle`
--
ALTER TABLE `tbl_logotitle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_page`
--
ALTER TABLE `tbl_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_team`
--
ALTER TABLE `tbl_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_theme`
--
ALTER TABLE `tbl_theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
