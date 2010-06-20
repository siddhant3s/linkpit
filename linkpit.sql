-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 20, 2010 at 09:25 AM
-- Server version: 5.0.87
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siddhant_wp`
--

-- --------------------------------------------------------

--
-- Table structure for table `linkpit_redirections`
--

CREATE TABLE IF NOT EXISTS `linkpit_redirections` (
  `tag` varchar(16) NOT NULL,
  `url` varchar(1023) NOT NULL,
  `tagger` varchar(90) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `reg_date` datetime NOT NULL,
  `hits` int(11) NOT NULL,
  PRIMARY KEY  (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `linkpit_redirections`
--

INSERT INTO `linkpit_redirections` (`tag`, `url`, `tagger`, `ip`, `reg_date`, `hits`) VALUES
('cilafu', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:26:57', 0),
('ciyevo', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:10:45', 1),
('cojaso', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:01:01', 3),
('contact-sid', 'http://siddhant3s.elementfx.com/documents/contacting_me.html', 'guest', '180.215.138.214', '2010-06-17 04:32:08', 4),
('contactingme', 'http://yatantrika.co.cc/', 'guest', '180.215.138.214', '2010-06-17 04:30:46', 2),
('contactme', 'http://siddhant3s.elementfx.com/documents/contacting_me.html', 'guest', '180.215.239.44', '2010-06-20 07:41:19', 2),
('cukevi', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:13:10', 3),
('cunaqi', 'http://chopin.x10hosting.com:2082/frontend/x3/filemanager/editit.html?file=config.php&fileop=&dir=%2Fhome%2Fsiddhant%2Fpublic_html%2Flinkpit&dirop=&charset=&__cpanel__temp__charset__=us-ascii&baseurl=&basedir=', 'https://www.google.com/accounts/o8/id?id=AItOawl23ddYUOKH2BZhpE-4QssPC69mcaw4t4g', '180.215.135.147', '2010-06-13 17:38:56', 0),
('cunewi', 'http://www.facebook.com/album.php?aid=180207&id=594763517&comments=', 'guest', '122.161.103.216', '2010-06-17 05:09:31', 6),
('cunezi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:43:59', 2),
('dani', 'http://www.daniweb.com', 'guest', '78.23.37.126', '2010-06-20 05:57:23', 2),
('dibaqi', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:13:52', 3),
('dibaqo', 'http://yatantrika.co.cc/', 'https://www.google.com/accounts/o8/id?id=AItOawl23ddYUOKH2BZhpE-4QssPC69mcaw4t4g', '180.215.135.147', '2010-06-13 17:49:31', 0),
('dimedi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:18:33', 2),
('diyasi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:29:53', 2),
('dobezu', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:26:58', 2),
('dohego', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:16:18', 2),
('doyezi', 'http://www.cs.umass.edu/admissions/career-options', 'guest', '180.215.135.147', '2010-06-13 18:44:10', 0),
('dubefu', 'www.myspace.com|picachoo', 'https://me.yahoo.com/a/MhqoKecEo4aWtly4grp5Q.rhr3PStw--', '220.227.207.12', '2010-06-16 07:15:27', 0),
('dujeci', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:03:10', 2),
('dujegu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:19:31', 2),
('dukevu', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:24:03', 2),
('dumewi', 'http://www.thesitewizard.com/domain/point-domain-name-website.shtml', 'https://www.google.com/accounts/o8/id?id=AItOawl23ddYUOKH2BZhpE-4QssPC69mcaw4t4g', '180.215.135.147', '2010-06-13 17:48:10', 0),
('dupezo', 'http://linkpit.co.cc/%27+window.location', 'guest', '122.161.103.216', '2010-06-17 06:01:28', 1),
('facebook', 'http://www.facebook.com/', 'http://siddhant3s.myopenid.com/', '180.215.135.147', '2010-06-13 17:15:23', 0),
('fibavu', 'http://en.wikipedia.org/wiki/Random_walk', 'guest', '122.161.103.216', '2010-06-17 05:05:01', 2),
('fobeqi', 'http://facebook.co.cc', 'guest', '210.4.224.236', '2010-06-13 18:12:47', 0),
('fohafi', 'http://yatantrika.co.cc/2010/06/02/means-of-contacting-me/', 'guest', '180.215.138.214', '2010-06-17 04:30:11', 1),
('fokagi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:14:27', 1),
('fokaqu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:30:53', 2),
('foyecu', 'http://en.wikipedia.org/wiki/Random_walk', 'guest', '180.215.246.254', '2010-06-19 00:14:04', 2),
('fujaqi', 'http://en.wikipedia.org/w/index.php?title=Glider_(Conway%27s_Life)&oldid=334482826', 'https://www.google.com/accounts/o8/id?id=AItOawl23ddYUOKH2BZhpE-4QssPC69mcaw4t4g', '180.215.152.238', '2010-06-14 05:29:35', 0),
('fujevo', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:30:07', 2),
('fupexu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:18:52', 0),
('gikaci', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:34:32', 2),
('gileco', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:11:16', 2),
('gipavu', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:07:49', 1),
('giyadu', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:01:02', 2),
('gobawu', 'http://linkpit.co.cc/vupazu', 'guest', '122.161.103.216', '2010-06-17 07:19:52', 3),
('gojaru', 'http://www.facebook.com/photo.php?pid=4160842&id=594763517', 'guest', '122.161.103.216', '2010-06-17 05:13:56', 1),
('gonewu', 'http://www.sparkfun.com/commerce/product_info.php?products_id=8950', 'https://www.google.com/accounts/o8/id?id=AItOawl23ddYUOKH2BZhpE-4QssPC69mcaw4t4g', '180.215.135.147', '2010-06-13 17:45:16', 0),
('google', 'http://www.google.com', 'https://www.google.com/accounts/o8/id?id=AItOawne478JnnnwoTO0gQJb6As32kuH6ydw5E0', '117.96.46.134', '2010-06-15 14:30:10', 2),
('guitar-girl', 'http://www.ultimate-guitar.com/columns/junkyard/15_reasons_why_guitars_are_better_than_girlfriends.html', 'guest', '180.215.226.140', '2010-06-18 12:17:44', 3),
('guparo', 'http://www.facebook.com/photo.php?pid=4161373&id=594763517', 'guest', '122.161.103.216', '2010-06-17 05:57:10', 3),
('guyado', 'http://www.google.co.in/search?q=random+walk&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a', 'guest', '180.215.246.254', '2010-06-19 00:14:53', 2),
('guyevu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:07:48', 2),
('lsdfwekfwofwoefj', 'http://siddhant3s.elementfx.com/blog/', 'guest', '180.215.138.214', '2010-06-17 03:31:43', 0),
('papa-bib', 'http://siddhant3s.bshellz.net/biblio.txt', 'guest', '27.248.16.240', '2010-06-15 21:18:15', 0),
('qineru', 'http://linkpit.co.cc/keyword', 'guest', '180.215.138.214', '2010-06-17 03:16:03', 0),
('qinewi', 'http://yatantrika.co.cc/2010/06/02/means-of-contacting-me/', 'guest', '180.215.138.214', '2010-06-17 04:30:22', 1),
('qobedo', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:18:08', 2),
('qolazi', 'http://chopin.x10hosting.com:2082/frontend/x3/subdomain/index.html', 'https://www.google.com/accounts/o8/id?id=AItOawl23ddYUOKH2BZhpE-4QssPC69mcaw4t4g', '180.215.135.147', '2010-06-13 17:41:08', 0),
('qujewi', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.24', '2010-06-18 11:06:34', 3),
('qunawo', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:24:03', 2),
('rihewu', 'http://facebook.co.cc', 'guest', '72.219.211.182', '2010-06-13 18:15:03', 0),
('rijeri', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:41:48', 3),
('ritish', 'http://www.google.co.in/search?q=macachito+pronunciation&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a', 'https://www.google.com/accounts/o8/id?id=AItOawl23ddYUOKH2BZhpE-4QssPC69mcaw4t4g', '180.215.221.132', '2010-06-19 05:50:14', 1),
('rokefu', 'http://www.youtube.com/results?search_query=sepultura&aq=f', 'guest', '122.161.103.216', '2010-06-17 06:52:17', 3),
('rolesi', 'http://linkpit.co.cc/gobawu', 'guest', '122.161.103.216', '2010-06-17 07:21:08', 2),
('romacu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:52:07', 2),
('ruhedu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:16:27', 3),
('rujaqo', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:17:31', 4),
('rupavi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 06:05:50', 2),
('simaqo', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:16:52', 2),
('sipacu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:33:32', 2),
('somawu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:42:42', 2),
('subacu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:49:42', 4),
('subawo', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 06:02:48', 4),
('sujawi', 'http://yatantrika.co.cc/2010/06/02/means-of-contacting-me/', 'guest', '180.215.138.214', '2010-06-17 04:30:24', 0),
('sunasi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:08:13', 2),
('supaco', 'www.myspace.com|picachoo', 'https://me.yahoo.com/a/MhqoKecEo4aWtly4grp5Q.rhr3PStw--', '220.227.207.12', '2010-06-16 07:16:01', 0),
('supaxo', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 06:07:26', 1),
('ticket28', 'https://sourceforge.net/apps/trac/pragyan/ticket/28', 'guest', '180.215.138.214', '2010-06-17 04:51:54', 9),
('ticket30', 'https://sourceforge.net/apps/trac/pragyan/ticket/30', 'guest', '180.215.138.214', '2010-06-17 04:49:59', 9),
('tushar', 'http://en.wikipedia.org/wiki/Random_walk', 'https://www.google.com/accounts/o8/id?id=AItOawl23ddYUOKH2BZhpE-4QssPC69mcaw4t4g', '180.215.246.254', '2010-06-19 00:16:20', 2),
('ubot', 'http://yatantrika.co.cc/2010/04/10/ubot-an-autonomous-small-sized-robot/', 'guest', '180.215.135.147', '2010-06-13 18:34:50', 0),
('ubot_pics', 'http://www.facebook.com/album.php?aid=12822&id=100000566828426&saved', 'guest', '180.215.135.147', '2010-06-13 18:37:07', 0),
('vibevu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:54:44', 4),
('vomaqi', 'http://boticons.co.cc/administrator/index2.php', 'guest', '27.248.121.252', '2010-06-15 02:37:20', 0),
('vomefo', 'http://www.youtube.com/results?search_query=sepultura&aq=f', 'guest', '122.161.103.216', '2010-06-17 06:53:47', 3),
('vonavu', 'http://yatantrika.co.cc/2010/06/02/means-of-contacting-me/', 'guest', '180.215.138.214', '2010-06-17 04:30:25', 1),
('vujaqo', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:54:34', 2),
('vujaxu', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:32:45', 2),
('vupazu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:19:14', 5),
('waffles', 'http://nonexistent.com/?q=mydata', 'guest', '72.219.211.182', '2010-06-13 18:18:20', 0),
('wibari', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:18:46', 3),
('wibexo', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 06:03:14', 2),
('wiheso', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:15:15', 2),
('winefu', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:09:40', 2),
('woheci', 'http://www.facebook.com/album.php?aid=180207&id=594763517&comments=', 'guest', '122.161.103.216', '2010-06-17 05:08:01', 2),
('wolago', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:11:37', 2),
('wolexu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:10:10', 2),
('wubaxo', 'http://en.wikipedia.org/w/index.php?title=Glider_(Conway%27s_Life)&oldid=334482826', 'https://www.google.com/accounts/o8/id?id=AItOawl23ddYUOKH2BZhpE-4QssPC69mcaw4t4g', '27.248.48.130', '2010-06-15 14:09:01', 0),
('wuhezu', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:39:12', 2),
('wujewo', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:11:29', 2),
('xinavu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:08:24', 2),
('xobaqi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:12:38', 2),
('xohefo', 'www.myspace.com|picachoo', 'https://me.yahoo.com/a/MhqoKecEo4aWtly4grp5Q.rhr3PStw--', '220.227.207.12', '2010-06-16 07:15:42', 0),
('xolaco', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:48:55', 2),
('xomaco', 'http://www.google.com', 'guest', '220.227.207.12', '2010-06-14 07:44:54', 0),
('xonegu', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:14:36', 2),
('xujegu', 'http://www.google.co.in/search?q=macachito+pronunciation&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a', 'guest', '180.215.221.132', '2010-06-19 05:47:37', 2),
('xumego', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:19:23', 2),
('xx', 'http://msn.com', 'guest', '117.96.46.134', '2010-06-15 14:34:02', 0),
('yati', 'http://yatantrika.co.cc/', 'https://www.google.com/accounts/o8/id?id=AItOawl23ddYUOKH2BZhpE-4QssPC69mcaw4t4g', '180.215.135.147', '2010-06-13 17:49:01', 0),
('zihewi', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 08:01:22', 3),
('zikaqu', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:44:15', 2),
('zileqi', 'http://linkpit.co.cc/about:blank', 'guest', '122.161.103.216', '2010-06-17 07:51:03', 2),
('zipawi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:43:32', 2),
('zobavi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:14:51', 2),
('zobedu', 'www.myspace.com|picachoo', 'https://me.yahoo.com/a/MhqoKecEo4aWtly4grp5Q.rhr3PStw--', '220.227.207.12', '2010-06-16 07:18:33', 0),
('zujadu', 'www.myspace.com|picachoo', 'https://me.yahoo.com/a/MhqoKecEo4aWtly4grp5Q.rhr3PStw--', '220.227.207.12', '2010-06-16 07:18:27', 0),
('zukexi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 08:13:35', 2),
('zukexo', 'http://www.facebook.com/', 'http://siddhant3s.myopenid.com/', '180.215.135.147', '2010-06-13 17:14:33', 0),
('zumevi', 'http://www.google.co.in/', 'guest', '122.161.103.216', '2010-06-17 07:41:20', 2);
