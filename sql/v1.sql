-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 年 1 朁E05 日 14:25
-- サーバのバージョン： 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `java_cloud`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `char_num` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- テーブルのデータのダンプ `answer`
--

INSERT INTO `answer` (`id`, `content`, `char_num`, `exercise_id`) VALUES
(1, 'public class Exercise\n{\n    public static void main( String[] args )\n    {\n        System.out.println("Hello World");\n    }\n}', 16, 1),
(2, 'public class Exercise\n{\n    public static void main( String[] args )\n    {\n        int x;\n\n        x = 11;\n\n        System.out.println( "x=" + x );\n    }\n}', 24, 1),
(3, 'public class Exercise\n{\n    public static void main( String[] args )\n    {\n        int x;\n        int y;\n\n        x = 13;\n        y = 17;\n\n        System.out.println( "x=" + x + ",y=" + y );\n    }\n}', 33, 1),
(4, 'public class Exercise\n{\n    public static void main( String[] args )\n    {\n        int x;\n\n        x = 13 + 17;\n\n        System.out.println( "x=" + x );\n    }\n}', 26, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `exercise`
--

CREATE TABLE IF NOT EXISTS `exercise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `template` text,
  `lecture_week_id` int(11) NOT NULL,
  `exercise_no` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- テーブルのデータのダンプ `exercise`
--

INSERT INTO `exercise` (`id`, `content`, `template`, `lecture_week_id`, `exercise_no`) VALUES
(1, '“Hello World”と表示するプログラムを作成しなさい。', NULL, 1, 1),
(2, 'int 型の変数 x に数値 11 を代入し、x の値を“x=11”のように表示するプログラムを作成しなさい。', NULL, 1, 2),
(3, 'int 型の変数 x、y に数値 13、17 を代入し、x、y の値を“x=13,y=17”のように表示するプログラムを作成しなさい。', NULL, 1, 3),
(4, 'int 型の変数 x に数値 13 と 17 の和を代入し、x の値を表示するプログラムを作成しなさい。', NULL, 1, 4);

-- --------------------------------------------------------

--
-- テーブルの構造 `lecture`
--

CREATE TABLE IF NOT EXISTS `lecture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` year(4) NOT NULL,
  `semestor` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- テーブルのデータのダンプ `lecture`
--

INSERT INTO `lecture` (`id`, `year`, `semestor`) VALUES
(1, 2015, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `lecture_week`
--

CREATE TABLE IF NOT EXISTS `lecture_week` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `counter` int(11) NOT NULL,
  `lecture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- テーブルのデータのダンプ `lecture_week`
--

INSERT INTO `lecture_week` (`id`, `date`, `counter`, `lecture_id`) VALUES
(1, '2015-09-22', 1, 1),
(2, '2015-09-29', 2, 1),
(3, '2015-10-06', 3, 1),
(4, '2015-10-13', 4, 1),
(5, '2015-10-20', 5, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `student_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  `content` text,
  `judge` varchar(7) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `stdout` text,
  `stderror` text,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `result`
--

INSERT INTO `result` (`student_id`, `exercise_id`, `counter`, `content`, `judge`, `type`, `stdout`, `stderror`, `create_time`) VALUES
(1221037, 1, 1, 'public class HelloWorld {\n    public static void main (String[] args) {\n        System.out.println("Hello World.")\n    }\n}', 'error', NULL, '', 'HelloWorld.java:3: error: '';'' expected\n        System.out.println("Hello World.")\n                                          ^\n1 error\n', '2016-01-05 22:23:48'),
(1221037, 1, 2, 'public class HelloWorld {\n\n}', 'error', NULL, '', 'Error: Main method not found in class HelloWorld, please define the main method as:\n   public static void main(String[] args)\nor a JavaFX application class must extend javafx.application.Application\n', '2016-01-05 22:24:02'),
(1221037, 1, 3, 'public class HelloWorld {\n    public static void main (String[] args) {\n        System.out.println("Hello World.")\n    }\n}', 'save', NULL, NULL, NULL, '2016-01-05 22:24:10'),
(1221037, 1, 4, 'public class HelloWorld {\n    public static void main (String[] args) {\n        System.out.println("Hello World.")\n    }\n}', 'error', NULL, '', 'HelloWorld.java:3: error: '';'' expected\n        System.out.println("Hello World.")\n                                          ^\n1 error\n', '2016-01-05 22:24:14'),
(1221037, 1, 5, 'public class HelloWorld {\n    public static void main (String[] args) {\n        System.out.println("Hello World.");\n    }\n}', 'success', NULL, 'Hello World.\n', '', '2016-01-05 22:24:22'),
(1221037, 1, 6, 'public class HelloWorld {\n    public static void main (String[] args) {\n        System.out.println("Hello World.");\n    }\n}', 'finish', NULL, 'Hello World.\n', '', '2016-01-05 22:24:30');

-- --------------------------------------------------------

--
-- テーブルの構造 `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `student`
--

INSERT INTO `student` (`id`, `name`, `password`) VALUES
(1221037, '内藤　成彦', ''),
(1221059, '黒沢　翔太', ''),
(1221078, '宮下　将輝', ''),
(1221109, '李　書', ''),
(1221125, '飯場　俊耶', ''),
(1221148, '木村　風雅', ''),
(1321033, '築地　勇人', ''),
(1321079, '大滝　健太郎', ''),
(1321109, '高橋　将希', ''),
(1321112, '笠井　貴之', ''),
(1321126, '大澤　律史', ''),
(1321146, '松本　雅利', ''),
(1321154, '清水　克哉', ''),
(1321155, '熊田　瑞貴', ''),
(1321162, '寺田　稜平', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
