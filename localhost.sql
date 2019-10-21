-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2017 at 10:33 AM
-- Server version: 5.5.31
-- PHP Version: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `costume_admin`
--
CREATE DATABASE `costume_admin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `costume_admin`;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `name` varchar(25) NOT NULL,
  `display_name` text NOT NULL,
  `role` text NOT NULL,
  `allowed` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`name`),
  UNIQUE KEY `name` (`name`),
  KEY `name_2` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`name`, `display_name`, `role`, `allowed`) VALUES
('aharney', 'Aidan', 'Web Admin', 1),
('amber', 'Amber', 'Events Co-ordinator', 1),
('brent', 'Brent', 'President', 1),
('jessy', 'Jessy', 'Media Leader', 1),
('neil', 'Neil', 'Treasurer', 1),
('shane', 'Shane', 'Vice President', 1),
('simon', 'Simon', 'Secretary', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `type` set('general','news','event') NOT NULL DEFAULT 'news',
  `icon_img` int(2) DEFAULT NULL,
  `event_singleday` tinyint(1) NOT NULL DEFAULT '1',
  `event_startdate` date DEFAULT NULL,
  `event_enddate` date DEFAULT NULL,
  `event_miscdate` text,
  `event_starttime` text,
  `event_endtime` text,
  `event_misctime` text,
  `html` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_date` timestamp NULL DEFAULT NULL,
  `author` varchar(25) NOT NULL,
  `author_role` text NOT NULL,
  `edit_author` varchar(25) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_3` (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `author` (`author`),
  KEY `edit_author` (`edit_author`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `type`, `icon_img`, `event_singleday`, `event_startdate`, `event_enddate`, `event_miscdate`, `event_starttime`, `event_endtime`, `event_misctime`, `html`, `created_date`, `edited_date`, `author`, `author_role`, `edit_author`, `published`) VALUES
(93, 'Happy Birthday to Our Brand New Website!', 'general', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '<img src="scripts/CLEditor/images/icons/66.gif" alt="66.gif" /> Hello and welcome to our brand new website!! <img src="scripts/CLEditor/images/icons/66.gif" alt="66.gif" /><br /><br />A lot of hard work was put into the creation of this website, so on behalf of all our members we wish to thank our media team, specifically the very talented Aidan!<br /><br />If you[apostraphe]re looking to contact us, or check out our various social media accounts then you[apostraphe]ll find the links on the side.<br /><br />If you have any problems with any section of the website or corresponding functions, please don[apostraphe]t hesitate to let us know. Otherwise please enjoy!', '2016-01-30 05:58:02', '2016-01-30 09:16:36', 'brent', 'President', NULL, 1),
(95, 'Sprint to Cure Little Hearts', 'news', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'There definitely was some sprinting that was done by the Perth Allied Costumers....Right under the Bunbury Fire and Rescue Fire trucks hose!Â <div><br /></div><div>All the proceed from the fun day went to the Heart Kids WA. HeartKids WA is a support group for families with children that have heart disease. The event organiser Leanne has a special place for this cause as her own son Zach was born with a heart disease. Â <br /><div><br /></div><div>Â Some key members from Perth made the road trip down to Bunbury to support the Sprint to Cure Little Hearts Fun Day. Princess Belle, Rainbow Dash, Arrow, Batman, Captain America, Batwoman and Mr Incredible braved the heat to have a wonderful day full of dancing, pony rides, gorgeous hairless dogs (Xoloitzcuintie!), snow cones and a nice cool spray from the Firey[apostraphe]s hose.</div><div><br /></div><div>It was an honour to be a part of such an amazing event</div><div><br /></div><div>To support Sprint to Cure Little Hearts, visit their <a href="https://www.facebook.com/Sprint-To-Cure-Little-Hearts-1606040886274304/">Facebook</a></div><div><br /></div><div><br /></div><div><br /></div><div><br /></div></div>', '2016-02-15 02:13:54', NULL, 'jessy', 'Media Leader', NULL, 1),
(96, 'Chaos Pop Culture Con', 'event', NULL, 1, '2016-02-20', NULL, NULL, '12:00 PM', '5:00 PM', '', '<span style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;">Quality Comics proudly present</span><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><span style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;">CHAOS POP CULTURE CONVENTION</span><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><span style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;">THE ROSEMOUNT HOTEL/ SATURDAY FEBRUARY 20</span><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><span style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;">12pm - 5pm / Free Entry / 18+ (under 18[apostraphe]s must be accompanied by legal gaurdian)Â </span><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><span style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;">COMICS / MANGA / VIDEO GAMES / LOCAL ART &amp; PUBLICATIONS / FOOD / BEER / COSPLAY KARAOKE and more to be announced!</span><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><span style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;">Featuring</span><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><span style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;">- Quality Comics</span><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><span style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;">- Perth[apostraphe]s Allied Costumers</span><br style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;" /><span style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;">- Figures Direct</span><span class="text_exposed_show" style="color:rgb(20,24,35);font-family:helvetica, arial, sans-serif;line-height:18px;"><br />- Mysteria Maxima Media (local publishers)<br />- Explosive Professional Wrestling (EPW PERTH)<br />- Peppermint CarouselÂ <br />- CrystaltheEchidna<br />- Cthulhu comicsÂ <br />- Reggie Bear Studios<br />- Game Excape<br />- Poke Mart<br />- Pop Til You Drop!<br />- DKS Art &amp; Design<br />- Shout it out loud cartoons (artist)<br />- Arnix (artist)<br />- Austen Mengler (artist)<br />- Everything Retro &amp; Gaming<br />- Red Griffin Games<br />- Boo Kitty<br />- Dean Bowen (artist)<br />- We got Issues!<br />- Lunapocalypse<br />- Curtin Illustration<br />- Nintendo Ninja<br /></span>', '2016-02-15 04:09:42', '2016-02-16 10:50:36', 'jessy', 'Media Leader', NULL, 1),
(97, 'UPCOMING EVENT!', 'news', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '<img src="https://farm2.staticflickr.com/1512/25979779715_92c98145d6_z.jpg" alt="" />', '2016-03-22 08:28:32', '2016-03-22 08:33:47', 'jessy', 'Media Leader', 'jessy', 1),
(98, 'WE[apostraphe]RE ATTENDING OZ COMIC CON!', 'news', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, '<img src="https://c2.staticflickr.com/2/1720/25706445130_d760fb95ee_b.jpg" alt="" />', '2016-03-23 14:25:28', NULL, 'jessy', 'Media Leader', NULL, 1),
(99, 'Starlight Week!', 'news', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 'Combining with EB Games on Hay Street, we took to the city to help raise much needed funds for the Starlight Foundation! We will be at the store on the 7th and 8th of May in a variety of costumes so come down and say hi!', '2016-05-02 02:38:06', NULL, 'jessy', 'Media Leader', NULL, 1);

--
-- Triggers `posts`
--
DROP TRIGGER IF EXISTS `author_role`;
DELIMITER //
CREATE TRIGGER `author_role` BEFORE INSERT ON `posts`
 FOR EACH ROW SET NEW.author_role = (Select role from authors
where authors.name = new.author)
//
DELIMITER ;
DROP TRIGGER IF EXISTS `record_update`;
DELIMITER //
CREATE TRIGGER `record_update` BEFORE UPDATE ON `posts`
 FOR EACH ROW SET NEW.edited_date = CURRENT_TIMESTAMP
//
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author`) REFERENCES `authors` (`name`) ON DELETE NO ACTION,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`edit_author`) REFERENCES `authors` (`name`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
