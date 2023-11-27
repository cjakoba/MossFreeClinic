DROP TABLE IF EXISTS survey_questiondb;
DROP TABLE IF EXISTS question_responsedb;
DROP TABLE IF EXISTS survey_responsedb;
DROP TABLE IF EXISTS em_tagdb;
DROP TABLE IF EXISTS em_categorydb;
DROP TABLE IF EXISTS ratingdb;
DROP TABLE IF EXISTS em_posts;
DROP TABLE IF EXISTS userdb;
DROP TABLE IF EXISTS surveydb;
DROP TABLE IF EXISTS questiondb;
DROP TABLE IF EXISTS tagdb;
DROP TABLE IF EXISTS categorydb;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 15, 2023 at 05:15 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homebasedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorydb`
--

CREATE TABLE `categorydb` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorydb`
--

INSERT INTO `categorydb` (`category_id`, `category_name`) VALUES
(1, 'Exercise'),
(2, 'Diet'),
(3, 'Disease'),
(4, 'Congenital'),
(5, 'Medicine'),
(6, 'Muscular-System'),
(7, 'Lymphatic-System'),
(8, 'Child-Birth'),
(9, 'Surgery'),
(10, 'Exercise'),
(11, 'Diet'),
(12, 'Disease'),
(13, 'Congenital'),
(14, 'Medicine'),
(15, 'Muscular-System'),
(16, 'Lymphatic-System'),
(17, 'Child-Birth'),
(18, 'Surgery');

-- --------------------------------------------------------

--
-- Table structure for table `em_categorydb`
--

CREATE TABLE `em_categorydb` (
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `em_posts`
--

CREATE TABLE `em_posts` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(50) DEFAULT NULL,
  `post_author` int(11) DEFAULT NULL,
  `post_date` datetime DEFAULT NULL,
  `post_type` varchar(20) DEFAULT NULL,
  `post_content` longtext,
  `post_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_posts`
--

INSERT INTO `em_posts` (`post_id`, `post_title`, `post_author`, `post_date`, `post_type`, `post_content`, `post_status`)
VALUES
(1, 'Diabetes', 1, '2023-11-07 10:37:52', 'blog', 
'{\"time\":1699371472615,\"blocks\":[{\"id\":\"6j0LxzNU7f\",\"type\":\"header\",\"data\":{\"text\":\"Overview\",\"level\":2}},{\"id\":\"A1snvfHA8C\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes mellitus refers to a group of diseases that affect how the body uses blood sugar (glucose). Glucose is an important source of energy for the cells that make up the muscles and tissues. It\'s also the brain\'s main source of fuel.\"}},{\"id\":\"JMUIs69Uix\",\"type\":\"paragraph\",\"data\":{\"text\":\"The main cause of diabetes varies by type. But no matter what type of diabetes you have, it can lead to excess sugar in the blood. Too much sugar in the blood can lead to serious health problems.\"}},{\"id\":\"cyodKHlA40\",\"type\":\"paragraph\",\"data\":{\"text\":\"Chronic diabetes conditions include type 1 diabetes and type 2 diabetes. Potentially reversible diabetes conditions include prediabetes and gestational diabetes. Prediabetes happens when blood sugar levels are higher than normal. But the blood sugar levels aren\'t high enough to be called diabetes. And prediabetes can lead to diabetes unless steps are taken to prevent it. Gestational diabetes happens during pregnancy. But it may go away after the baby is born.\"}},{\"id\":\"FJNy_-j-X7\",\"type\":\"paragraph\",\"data\":{\"text\":\"<b>Products and services<\\/b>\"}},{\"id\":\"vOL3xZ7uox\",\"type\":\"paragraph\",\"data\":{\"text\":\"https:\\/\\/order.store.mayoclinic.com\\/flex\\/mmv\\/esdiab1\\/?utm_source=MC-DotOrg-PS&amp;utm_medium=Link&amp;utm_campaign=Diabetes-Book&amp;utm_content=EDIAB\"}},{\"id\":\"_stS2xXp8h\",\"type\":\"header\",\"data\":{\"text\":\"Symptoms\",\"level\":2}},{\"id\":\"EK0dXBlh14\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes symptoms depend on how high your blood sugar is. Some people, especially if they have&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/prediabetes\\/symptoms-causes\\/syc-20355278\\\">prediabetes<\\/a>,&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/gestational-diabetes\\/symptoms-causes\\/syc-20355339\\\">gestational diabetes<\\/a>&nbsp;or&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes\\/symptoms-causes\\/syc-20351193\\\">type 2 diabetes<\\/a>, may not have symptoms. In&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes\\/symptoms-causes\\/syc-20353011\\\">type 1 diabetes<\\/a>, symptoms tend to come on quickly and be more severe.\"}},{\"id\":\"MyZvFrHXqh\",\"type\":\"paragraph\",\"data\":{\"text\":\"Some of the symptoms of type 1 diabetes and type 2 diabetes are:\"}},{\"id\":\"tvQVXYFaXm\",\"type\":\"list\",\"data\":{\"style\":\"unordered\",\"items\":[\"Feeling more thirsty than usual.\",\"Urinating often.\",\"Losing weight without trying.\",\"Presence of ketones in the urine. Ketones are a byproduct of the breakdown of muscle and fat that happens when there\'s not enough available insulin.\",\"Feeling tired and weak.\",\"Feeling irritable or having other mood changes.\",\"Having blurry vision.\",\"Having slow-healing sores.\",\"Getting a lot of infections, such as gum, skin and vaginal infections.\"]}},{\"id\":\"r9b5okf-yY\",\"type\":\"paragraph\",\"data\":{\"text\":\"Type 1 diabetes can start at any age. But it often starts&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes-in-children\\/symptoms-causes\\/syc-20355306\\\">during childhood<\\/a>&nbsp;or teen years. Type 2 diabetes, the more common type, can develop at any age. Type 2 diabetes is more common in people older than 40. But&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes-in-children\\/symptoms-causes\\/syc-20355318\\\">type 2 diabetes in children<\\/a>&nbsp;is increasing.\"}},{\"id\":\"Sg5kqbOH61\",\"type\":\"embed\",\"data\":{\"service\":\"youtube\",\"source\":\"https:\\/\\/www.youtube.com\\/watch?v=wZAjVQWbMlE\",\"embed\":\"https:\\/\\/www.youtube.com\\/embed\\/wZAjVQWbMlE\",\"width\":580,\"height\":320,\"caption\":\"Video from YouTube\"}}],\"version\":\"2.28.2\"}',
'published'),
(2, 'test post', 1, '2023-11-14 09:38:26', 'blog', 
'{\"time\":1699972706013,\"blocks\":[{\"id\":\"DkDN7QCLp5\",\"type\":\"paragraph\",\"data\":{\"text\":\"1234\"}}],\"version\":\"2.28.2\"}',
 'published'),
(3, 'test post', 1, '2023-11-14 10:00:37', 'blog', 
'{\"time\":1699974037479,\"blocks\":[{\"id\":\"DkDN7QCLp5\",\"type\":\"paragraph\",\"data\":{\"text\":\"1234\"}},{\"id\":\"DkDN7QCLp5\",\"type\":\"paragraph\",\"data\":{\"text\":\"1234\"}},{\"id\":\"6j0LxzNU7f\",\"type\":\"header\",\"data\":{\"text\":\"Overvieddfssfsdfsf\",\"level\":2}},{\"id\":\"A1snvfHA8C\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes mellitus refers to a group of diseases that affect how the body uses blood sugar (glucose). Glucose is an important source of energy for the cells that make up the muscles and tissues. It\'s also the brain\'s main source of fuel.\"}},{\"id\":\"JMUIs69Uix\",\"type\":\"paragraph\",\"data\":{\"text\":\"The main cause of diabetes varies by type. But no matter what type of diabetes you have, it can lead to excess sugar in the blood. Too much sugar in the blood can lead to serious health problems.\"}},{\"id\":\"cyodKHlA40\",\"type\":\"paragraph\",\"data\":{\"text\":\"Chronic diabetes conditions include type 1 diabetes and type 2 diabetes. Potentially reversible diabetes conditions include prediabetes and gestational diabetes. Prediabetes happens when blood sugar levels are higher than normal. But the blood sugar levels aren\'t high enough to be called diabetes. Andjdfhak;jsdhflkasdkjfhqlsdjhflakjdskjfhalsdkjfljasd prediabetes can lead to diabetes unless steps are taken to prevent it. Gestational diabetes happens during pregnancy. But it may go away after the baby is born.\"}},{\"id\":\"FJNy_-j-X7\",\"type\":\"paragraph\",\"data\":{\"text\":\"<b>Products and services<\\/b>\"}},{\"id\":\"vOL3xZ7uox\",\"type\":\"paragraph\",\"data\":{\"text\":\"https:\\/\\/order.store.mayoclinic.com\\/flex\\/mmv\\/esdiab1\\/?utm_source=MC-DotOrg-PS&amp;utm_medium=Link&amp;utm_campaign=Diabetes-Book&amp;utm_content=EDIAB\"}},{\"id\":\"_stS2xXp8h\",\"type\":\"header\",\"data\":{\"text\":\"Symptoms\",\"level\":2}},{\"id\":\"EK0dXBlh14\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes symptoms depend on how high your blood sugar is. Some people, especially if they have&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/prediabetes\\/symptoms-causes\\/syc-20355278\\\">prediabetes<\\/a>,&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/gestational-diabetes\\/symptoms-causes\\/syc-20355339\\\">gestational diabetes<\\/a>&nbsp;or&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes\\/symptoms-causes\\/syc-20351193\\\">type 2 diabetes<\\/a>, may not have symptoms. In&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes\\/symptoms-causes\\/syc-20353011\\\">type 1 diabetes<\\/a>, symptoms tend to come on quickly and be more severe.\"}},{\"id\":\"MyZvFrHXqh\",\"type\":\"paragraph\",\"data\":{\"text\":\"Some of the symptoms of type 1 diabetes and type 2 diabetes are:\"}},{\"id\":\"tvQVXYFaXm\",\"type\":\"list\",\"data\":{\"style\":\"unordered\",\"items\":[\"Feeling more thirsty than usual.\",\"Urinating often.\",\"Losing weight without trying.\",\"Presence of ketones in the urine. Ketones are a byproduct of the breakdown of muscle and fat that happens when there\'s not enough available insulin.\",\"Feeling tired and weak.\",\"Feeling irritable or having other mood changes.\",\"Having blurry vision.\",\"Having slow-healing sores.\",\"Getting a lot of infections, such as gum, skin and vaginal infections.\"]}},{\"id\":\"r9b5okf-yY\",\"type\":\"paragraph\",\"data\":{\"text\":\"Type 1 diabetes can start at any age. But it often starts&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes-in-children\\/symptoms-causes\\/syc-20355306\\\">during childhood<\\/a>&nbsp;or teen years. Type 2 diabetes, the more common type, can develop at any age. Type 2 diabetes is more common in people older than 40. But&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes-in-children\\/symptoms-causes\\/syc-20355318\\\">type 2 diabetes in children<\\/a>&nbsp;is increasing.\"}},{\"id\":\"Sg5kqbOH61\",\"type\":\"embed\",\"data\":{\"service\":\"youtube\",\"source\":\"https:\\/\\/www.youtube.com\\/watch?v=wZAjVQWbMlE\",\"embed\":\"https:\\/\\/www.youtube.com\\/embed\\/wZAjVQWbMlE\",\"width\":580,\"height\":320,\"caption\":\"Video from YouTube\"}},{\"id\":\"DkDN7QCLp5\",\"type\":\"paragraph\",\"data\":{\"text\":\"1234\"}},{\"id\":\"6j0LxzNU7f\",\"type\":\"header\",\"data\":{\"text\":\"Overview\",\"level\":2}},{\"id\":\"A1snvfHA8C\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes mellitus refers to a group of diseases that affect how the body uses blood sugar (glucose). Glucose is an important source of energy for the cells that make up the muscles and tissues. It\'s also the brain\'s main source of fuel.\"}},{\"id\":\"JMUIs69Uix\",\"type\":\"paragraph\",\"data\":{\"text\":\"The main cause of diabetes varies by type. But no matter what type of diabetes you have, it can lead to excess sugar in the blood. Too much sugar in the blood can lead to serious health problems.\"}},{\"id\":\"cyodKHlA40\",\"type\":\"paragraph\",\"data\":{\"text\":\"Chronic diabetes conditions include type 1 diabetes and type 2 diabetes. Potentially reversible diabetes conditions include prediabetes and gestational diabetes. Prediabetes happens when blood sugar levels are higher than normal. But the blood sugar levels aren\'t high enough to be called diabetes. And prediabetes can lead to diabetes unless steps are taken to prevent it. Gestational diabetes happens during pregnancy. But it may go away after the baby is born.\"}},{\"id\":\"FJNy_-j-X7\",\"type\":\"paragraph\",\"data\":{\"text\":\"<b>Products and services<\\/b>\"}},{\"id\":\"vOL3xZ7uox\",\"type\":\"paragraph\",\"data\":{\"text\":\"https:\\/\\/order.store.mayoclinic.com\\/flex\\/mmv\\/esdiab1\\/?utm_source=MC-DotOrg-PS&amp;utm_medium=Link&amp;utm_campaign=Diabetes-Book&amp;utm_content=EDIAB\"}},{\"id\":\"_stS2xXp8h\",\"type\":\"header\",\"data\":{\"text\":\"Symptoms\",\"level\":2}},{\"id\":\"EK0dXBlh14\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes symptoms depend on how high your blood sugar is. Some people, especially if they have&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/prediabetes\\/symptoms-causes\\/syc-20355278\\\">prediabetes<\\/a>,&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/gestational-diabetes\\/symptoms-causes\\/syc-20355339\\\">gestational diabetes<\\/a>&nbsp;or&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes\\/symptoms-causes\\/syc-20351193\\\">type 2 diabetes<\\/a>, may not have symptoms. In&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes\\/symptoms-causes\\/syc-20353011\\\">type 1 diabetes<\\/a>, symptoms tend to come on quickly and be more severe.\"}},{\"id\":\"MyZvFrHXqh\",\"type\":\"paragraph\",\"data\":{\"text\":\"Some of the symptoms of type 1 diabetes and type 2 diabetes are:\"}},{\"id\":\"tvQVXYFaXm\",\"type\":\"list\",\"data\":{\"style\":\"unordered\",\"items\":[\"Feeling more thirsty than usual.\",\"Urinating often.\",\"Losing weight without trying.\",\"Presence of ketones in the urine. Ketones are a byproduct of the breakdown of muscle and fat that happens when there\'s not enough available insulin.\",\"Feeling tired and weak.\",\"Feeling irritable or having other mood changes.\",\"Having blurry vision.\",\"Having slow-healing sores.\",\"Getting a lot of infections, such as gum, skin and vaginal infections.\"]}},{\"id\":\"r9b5okf-yY\",\"type\":\"paragraph\",\"data\":{\"text\":\"Type 1 diabetes can start at any age. But it often starts&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes-in-children\\/symptoms-causes\\/syc-20355306\\\">during childhood<\\/a>&nbsp;or teen years. Type 2 diabetes, the more common type, can develop at any age. Type 2 diabetes is more common in people older than 40. But&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes-in-children\\/symptoms-causes\\/syc-20355318\\\">type 2 diabetes in children<\\/a>&nbsp;is increasing.\"}},{\"id\":\"Sg5kqbOH61\",\"type\":\"embed\",\"data\":{\"service\":\"youtube\",\"source\":\"https:\\/\\/www.youtube.com\\/watch?v=wZAjVQWbMlE\",\"embed\":\"https:\\/\\/www.youtube.com\\/embed\\/wZAjVQWbMlE\",\"width\":580,\"height\":320,\"caption\":\"Video from YouTube\"}},{\"id\":\"DkDN7QCLp5\",\"type\":\"paragraph\",\"data\":{\"text\":\"1234\"}},{\"id\":\"6j0LxzNU7f\",\"type\":\"header\",\"data\":{\"text\":\"Overview\",\"level\":2}},{\"id\":\"A1snvfHA8C\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes mellitus refers to a group of diseases that affect how the body uses blood sugar (glucose). Glucose is an important source of energy for the cells that make up the muscles and tissues. It\'s also the brain\'s main source of fuel.\"}},{\"id\":\"JMUIs69Uix\",\"type\":\"paragraph\",\"data\":{\"text\":\"The main cause of diabetes varies by type. But no matter what type of diabetes you have, it can lead to excess sugar in the blood. Too much sugar in the blood can lead to serious health problems.\"}},{\"id\":\"cyodKHlA40\",\"type\":\"paragraph\",\"data\":{\"text\":\"Chronic diabetes conditions include type 1 diabetes and type 2 diabetes. Potentially reversible diabetes conditions include prediabetes and gestational diabetes. Prediabetes happens when blood sugar levels are higher than normal. But the blood sugar levels aren\'t high enough to be called diabetes. And prediabetes can lead to diabetes unless steps are taken to prevent it. Gestational diabetes happens during pregnancy. But it may go away after the baby is born.\"}},{\"id\":\"FJNy_-j-X7\",\"type\":\"paragraph\",\"data\":{\"text\":\"<b>Products and services<\\/b>\"}},{\"id\":\"vOL3xZ7uox\",\"type\":\"paragraph\",\"data\":{\"text\":\"https:\\/\\/order.store.mayoclinic.com\\/flex\\/mmv\\/esdiab1\\/?utm_source=MC-DotOrg-PS&amp;utm_medium=Link&amp;utm_campaign=Diabetes-Book&amp;utm_content=EDIAB\"}},{\"id\":\"_stS2xXp8h\",\"type\":\"header\",\"data\":{\"text\":\"Symptoms\",\"level\":2}},{\"id\":\"EK0dXBlh14\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes symptoms depend on how high your blood sugar is. Some people, especially if they have&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/prediabetes\\/symptoms-causes\\/syc-20355278\\\">prediabetes<\\/a>,&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/gestational-diabetes\\/symptoms-causes\\/syc-20355339\\\">gestational diabetes<\\/a>&nbsp;or&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes\\/symptoms-causes\\/syc-20351193\\\">type 2 diabetes<\\/a>, may not have symptoms. In&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes\\/symptoms-causes\\/syc-20353011\\\">type 1 diabetes<\\/a>, symptoms tend to come on quickly and be more severe.\"}},{\"id\":\"MyZvFrHXqh\",\"type\":\"paragraph\",\"data\":{\"text\":\"Some of the symptoms of type 1 diabetes and type 2 diabetes are:\"}},{\"id\":\"tvQVXYFaXm\",\"type\":\"list\",\"data\":{\"style\":\"unordered\",\"items\":[\"Feeling more thirsty than usual.\",\"Urinating often.\",\"Losing weight without trying.\",\"Presence of ketones in the urine. Ketones are a byproduct of the breakdown of muscle and fat that happens when there\'s not enough available insulin.\",\"Feeling tired and weak.\",\"Feeling irritable or having other mood changes.\",\"Having blurry vision.\",\"Having slow-healing sores.\",\"Getting a lot of infections, such as gum, skin and vaginal infections.\"]}},{\"id\":\"r9b5okf-yY\",\"type\":\"paragraph\",\"data\":{\"text\":\"Type 1 diabetes can start at any age. But it often starts&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes-in-children\\/symptoms-causes\\/syc-20355306\\\">during childhood<\\/a>&nbsp;or teen years. Type 2 diabetes, the more common type, can develop at any age. Type 2 diabetes is more common in people older than 40. But&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes-in-children\\/symptoms-causes\\/syc-20355318\\\">type 2 diabetes in children<\\/a>&nbsp;is increasing.\"}},{\"id\":\"Sg5kqbOH61\",\"type\":\"embed\",\"data\":{\"service\":\"youtube\",\"source\":\"https:\\/\\/www.youtube.com\\/watch?v=wZAjVQWbMlE\",\"embed\":\"https:\\/\\/www.youtube.com\\/embed\\/wZAjVQWbMlE\",\"width\":580,\"height\":320,\"caption\":\"Video from YouTube\"}},{\"id\":\"DkDN7QCLp5\",\"type\":\"paragraph\",\"data\":{\"text\":\"1234\"}},{\"id\":\"6j0LxzNU7f\",\"type\":\"header\",\"data\":{\"text\":\"Overview\",\"level\":2}},{\"id\":\"A1snvfHA8C\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes mellitus refers to a group of diseases that affect how the body uses blood sugar (glucose). Glucose is an important source of energy for the cells that make up the muscles and tissues. It\'s also the brain\'s main source of fuel.\"}},{\"id\":\"JMUIs69Uix\",\"type\":\"paragraph\",\"data\":{\"text\":\"The main cause of diabetes varies by type. But no matter what type of diabetes you have, it can lead to excess sugar in the blood. Too much sugar in the blood can lead to serious health problems.\"}},{\"id\":\"cyodKHlA40\",\"type\":\"paragraph\",\"data\":{\"text\":\"Chronic diabetes conditions include type 1 diabetes and type 2 diabetes. Potentially reversible diabetes conditions include prediabetes and gestational diabetes. Prediabetes happens when blood sugar levels are higher than normal. But the blood sugar levels aren\'t high enough to be called diabetes. And prediabetes can lead to diabetes unless steps are taken to prevent it. Gestational diabetes happens during pregnancy. But it may go away after the baby is born.\"}},{\"id\":\"FJNy_-j-X7\",\"type\":\"paragraph\",\"data\":{\"text\":\"<b>Products and services<\\/b>\"}},{\"id\":\"vOL3xZ7uox\",\"type\":\"paragraph\",\"data\":{\"text\":\"https:\\/\\/order.store.mayoclinic.com\\/flex\\/mmv\\/esdiab1\\/?utm_source=MC-DotOrg-PS&amp;utm_medium=Link&amp;utm_campaign=Diabetes-Book&amp;utm_content=EDIAB\"}},{\"id\":\"_stS2xXp8h\",\"type\":\"header\",\"data\":{\"text\":\"Symptoms\",\"level\":2}},{\"id\":\"EK0dXBlh14\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes symptoms depend on how high your blood sugar is. Some people, especially if they have&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/prediabetes\\/symptoms-causes\\/syc-20355278\\\">prediabetes<\\/a>,&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/gestational-diabetes\\/symptoms-causes\\/syc-20355339\\\">gestational diabetes<\\/a>&nbsp;or&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes\\/symptoms-causes\\/syc-20351193\\\">type 2 diabetes<\\/a>, may not have symptoms. In&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes\\/symptoms-causes\\/syc-20353011\\\">type 1 diabetes<\\/a>, symptoms tend to come on quickly and be more severe.\"}},{\"id\":\"MyZvFrHXqh\",\"type\":\"paragraph\",\"data\":{\"text\":\"Some of the symptoms of type 1 diabetes and type 2 diabetes are:\"}},{\"id\":\"tvQVXYFaXm\",\"type\":\"list\",\"data\":{\"style\":\"unordered\",\"items\":[\"Feeling more thirsty than usual.\",\"Urinating often.\",\"Losing weight without trying.\",\"Presence of ketones in the urine. Ketones are a byproduct of the breakdown of muscle and fat that happens when there\'s not enough available insulin.\",\"Feeling tired and weak.\",\"Feeling irritable or having other mood changes.\",\"Having blurry vision.\",\"Having slow-healing sores.\",\"Getting a lot of infections, such as gum, skin and vaginal infections.\"]}},{\"id\":\"r9b5okf-yY\",\"type\":\"paragraph\",\"data\":{\"text\":\"Type 1 diabetes can start at any age. But it often starts&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes-in-children\\/symptoms-causes\\/syc-20355306\\\">during childhood<\\/a>&nbsp;or teen years. Type 2 diabetes, the more common type, can develop at any age. Type 2 diabetes is more common in people older than 40. But&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes-in-children\\/symptoms-causes\\/syc-20355318\\\">type 2 diabetes in children<\\/a>&nbsp;is increasing.\"}},{\"id\":\"Sg5kqbOH61\",\"type\":\"embed\",\"data\":{\"service\":\"youtube\",\"source\":\"https:\\/\\/www.youtube.com\\/watch?v=wZAjVQWbMlE\",\"embed\":\"https:\\/\\/www.youtube.com\\/embed\\/wZAjVQWbMlE\",\"width\":580,\"height\":320,\"caption\":\"Video from YouTube\"}},{\"id\":\"DkDN7QCLp5\",\"type\":\"paragraph\",\"data\":{\"text\":\"1234\"}},{\"id\":\"6j0LxzNU7f\",\"type\":\"header\",\"data\":{\"text\":\"Overview\",\"level\":2}},{\"id\":\"A1snvfHA8C\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes mellitus refers to a group of diseases that affect how the body uses blood sugar (glucose). Glucose is an important source of energy for the cells that make up the muscles and tissues. It\'s also the brain\'s main source of fuel.\"}},{\"id\":\"JMUIs69Uix\",\"type\":\"paragraph\",\"data\":{\"text\":\"The main cause of diabetes varies by type. But no matter what type of diabetes you have, it can lead to excess sugar in the blood. Too much sugar in the blood can lead to serious health problems.\"}},{\"id\":\"cyodKHlA40\",\"type\":\"paragraph\",\"data\":{\"text\":\"Chronic diabetes conditions include type 1 diabetes and type 2 diabetes. Potentially reversible diabetes conditions include prediabetes and gestational diabetes. Prediabetes happens when blood sugar levels are higher than normal. But the blood sugar levels aren\'t high enough to be called diabetes. And prediabetes can lead to diabetes unless steps are taken to prevent it. Gestational diabetes happens during pregnancy. But it may go away after the baby is born.\"}},{\"id\":\"FJNy_-j-X7\",\"type\":\"paragraph\",\"data\":{\"text\":\"<b>Products and services<\\/b>\"}},{\"id\":\"vOL3xZ7uox\",\"type\":\"paragraph\",\"data\":{\"text\":\"https:\\/\\/order.store.mayoclinic.com\\/flex\\/mmv\\/esdiab1\\/?utm_source=MC-DotOrg-PS&amp;utm_medium=Link&amp;utm_campaign=Diabetes-Book&amp;utm_content=EDIAB\"}},{\"id\":\"_stS2xXp8h\",\"type\":\"header\",\"data\":{\"text\":\"Symptoms\",\"level\":2}},{\"id\":\"EK0dXBlh14\",\"type\":\"paragraph\",\"data\":{\"text\":\"Diabetes symptoms depend on how high your blood sugar is. Some people, especially if they have&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/prediabetes\\/symptoms-causes\\/syc-20355278\\\">prediabetes<\\/a>,&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/gestational-diabetes\\/symptoms-causes\\/syc-20355339\\\">gestational diabetes<\\/a>&nbsp;or&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes\\/symptoms-causes\\/syc-20351193\\\">type 2 diabetes<\\/a>, may not have symptoms. In&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes\\/symptoms-causes\\/syc-20353011\\\">type 1 diabetes<\\/a>, symptoms tend to come on quickly and be more severe.\"}},{\"id\":\"MyZvFrHXqh\",\"type\":\"paragraph\",\"data\":{\"text\":\"Some of the symptoms of type 1 diabetes and type 2 diabetes are:\"}},{\"id\":\"tvQVXYFaXm\",\"type\":\"list\",\"data\":{\"style\":\"unordered\",\"items\":[\"Feeling more thirsty than usual.\",\"Urinating often.\",\"Losing weight without trying.\",\"Presence of ketones in the urine. Ketones are a byproduct of the breakdown of muscle and fat that happens when there\'s not enough available insulin.\",\"Feeling tired and weak.\",\"Feeling irritable or having other mood changes.\",\"Having blurry vision.\",\"Having slow-healing sores.\",\"Getting a lot of infections, such as gum, skin and vaginal infections.\"]}},{\"id\":\"r9b5okf-yY\",\"type\":\"paragraph\",\"data\":{\"text\":\"Type 1 diabetes can start at any age. But it often starts&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-1-diabetes-in-children\\/symptoms-causes\\/syc-20355306\\\">during childhood<\\/a>&nbsp;or teen years. Type 2 diabetes, the more common type, can develop at any age. Type 2 diabetes is more common in people older than 40. But&nbsp;<a href=\\\"https:\\/\\/www.mayoclinic.org\\/diseases-conditions\\/type-2-diabetes-in-children\\/symptoms-causes\\/syc-20355318\\\">type 2 diabetes in children<\\/a>&nbsp;is increasing.\"}},{\"id\":\"Sg5kqbOH61\",\"type\":\"embed\",\"data\":{\"service\":\"youtube\",\"source\":\"https:\\/\\/www.youtube.com\\/watch?v=wZAjVQWbMlE\",\"embed\":\"https:\\/\\/www.youtube.com\\/embed\\/wZAjVQWbMlE\",\"width\":580,\"height\":320,\"caption\":\"Video from YouTube\"}}],\"version\":\"2.28.2\"}',
'published'),
(4, '123456', 1, '2023-11-14 21:53:01', 'blog', 
'{\"time\":1700016781799,\"blocks\":[{\"id\":\"qbIa5baeUG\",\"type\":\"paragraph\",\"data\":{\"text\":\"test\"}},{\"id\":\"p9zyW0iP8C\",\"type\":\"paragraph\",\"data\":{\"text\":\"test12\"}}],\"version\":\"2.28.2\"}', 
'published');
/*,
(5, 'Bone Diseases', 1, '2023-10-31 12:00:00', 'blog', 'Bones', 'published'),
(6, 'Heart Surgery', 1, '2023-10-31 12:00:00', 'blog', 'Everything you need to know about Open Heart Surgery', 'published'),
(7, 'Cardiovascular Exercises', 1, '2023-10-31 12:00:00', 'blog', 'Best exercises for your cardiovascular system', 'published'),
(8, 'Bone Diseases', 1, '2023-10-31 12:00:00', 'blog', 'Bones', 'published'),
(9, 'Heart Surgery', 1, '2023-10-31 12:00:00', 'blog', 'Everything you need to know about Open Heart Surgery', 'published'),
(10, 'Cardiovascular Exercises', 1, '2023-10-31 12:00:00', 'blog', 'Best exercises for your cardiovascular system', 'published');
*/
-- --------------------------------------------------------

--
-- Table structure for table `em_tagdb`
--

CREATE TABLE `em_tagdb` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questiondb`
--

CREATE TABLE `questiondb` (
  `question_id` int(11) NOT NULL,
  `question_type` varchar(50) DEFAULT NULL,
  `question` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `question_responsedb`
--

CREATE TABLE `question_responsedb` (
  `question_id` int(11) DEFAULT NULL,
  `response_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ratingdb`
--

CREATE TABLE `ratingdb` (
  `rating_id` int(11) NOT NULL,
  `rating` double DEFAULT NULL,
  `em_post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ratingdb`
--

INSERT INTO `ratingdb` (`rating_id`, `rating`, `em_post_id`) VALUES
(6, 4.5, 1),
(7, 2, 2),
(8, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `surveydb`
--

CREATE TABLE `surveydb` (
  `survey_id` int(11) NOT NULL,
  `survey_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `survey_questiondb`
--

CREATE TABLE `survey_questiondb` (
  `survey_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `survey_responsedb`
--

CREATE TABLE `survey_responsedb` (
  `response_id` int(11) NOT NULL,
  `response_date` datetime DEFAULT NULL,
  `survey_response_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tagdb`
--

CREATE TABLE `tagdb` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tagdb`
--

INSERT INTO `tagdb` (`tag_id`, `tag_name`) VALUES
(1, 'Bone'),
(2, 'Leg'),
(3, 'Arm'),
(4, 'Heart'),
(5, 'Lung'),
(6, 'Stomach'),
(7, 'Liver'),
(8, 'Skin'),
(9, 'Eyes'),
(10, 'Bone'),
(11, 'Leg'),
(12, 'Arm'),
(13, 'Heart'),
(14, 'Lung'),
(15, 'Stomach'),
(16, 'Liver'),
(17, 'Skin'),
(18, 'Eyes');

-- --------------------------------------------------------

--
-- Table structure for table `userdb`
--

CREATE TABLE `userdb` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` longtext,
  `last_login` date DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdb`
--

INSERT INTO `userdb` (`userid`, `username`, `password`, `last_login`, `user_type`) VALUES
(1, 'Admin', '$2y$10$RgviL.Wom0Cj8mZJUYm9ZuE29aFWZWmT9hwNAsEPOyOOMcqWuKc0K', '2023-11-13', 'admin'),
(2, 'User1', 'Password1', '2023-10-31', 'exec'),
(3, 'User2', 'Password2', '2023-10-31', 'exec'),
(4, 'User3', 'Password3', '2023-10-31', 'exec'),
(5, 'User4', 'Password4', '2023-10-31', 'admin'),
(6, 'User5', 'Password5', '2023-10-31', 'admin'),
(7, 'User6', 'Password6', '2023-10-31', 'admin'),
(8, 'homebasedb', 'homebasedb', '2023-10-31', 'exec'),
(9, 'User1', 'Password1', '2023-10-31', 'exec'),
(10, 'User2', 'Password2', '2023-10-31', 'exec'),
(11, 'User3', 'Password3', '2023-10-31', 'exec'),
(12, 'User4', 'Password4', '2023-10-31', 'admin'),
(13, 'User5', 'Password5', '2023-10-31', 'admin'),
(14, 'User6', 'Password6', '2023-10-31', 'admin'),
(15, 'homebasedb', 'homebasedb', '2023-10-31', 'exec');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorydb`
--
ALTER TABLE `categorydb`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `em_categorydb`
--
ALTER TABLE `em_categorydb`
  ADD KEY `em_categorydb_post_id_fk` (`post_id`),
  ADD KEY `em_category_category_id_fk` (`category_id`);

--
-- Indexes for table `em_posts`
--
ALTER TABLE `em_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_author_fk` (`post_author`);

--
-- Indexes for table `em_tagdb`
--
ALTER TABLE `em_tagdb`
  ADD KEY `em_tagdb_post_id_fk` (`post_id`),
  ADD KEY `em_tagdb_tag_id_fk` (`tag_id`);

--
-- Indexes for table `questiondb`
--
ALTER TABLE `questiondb`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `question_responsedb`
--
ALTER TABLE `question_responsedb`
  ADD KEY `questionid_fk` (`question_id`),
  ADD KEY `response_id_fk` (`response_id`);

--
-- Indexes for table `ratingdb`
--
ALTER TABLE `ratingdb`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `em_post_rating_fk` (`em_post_id`);

--
-- Indexes for table `surveydb`
--
ALTER TABLE `surveydb`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `survey_questiondb`
--
ALTER TABLE `survey_questiondb`
  ADD KEY `survey_id_fk` (`survey_id`),
  ADD KEY `question_id_fk` (`question_id`);

--
-- Indexes for table `survey_responsedb`
--
ALTER TABLE `survey_responsedb`
  ADD PRIMARY KEY (`response_id`);

--
-- Indexes for table `tagdb`
--
ALTER TABLE `tagdb`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `userdb`
--
ALTER TABLE `userdb`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorydb`
--
ALTER TABLE `categorydb`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `em_posts`
--
ALTER TABLE `em_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `questiondb`
--
ALTER TABLE `questiondb`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratingdb`
--
ALTER TABLE `ratingdb`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `surveydb`
--
ALTER TABLE `surveydb`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_responsedb`
--
ALTER TABLE `survey_responsedb`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tagdb`
--
ALTER TABLE `tagdb`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `userdb`
--
ALTER TABLE `userdb`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `em_categorydb`
--
ALTER TABLE `em_categorydb`
  ADD CONSTRAINT `em_category_category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categorydb` (`category_id`),
  ADD CONSTRAINT `em_categorydb_post_id_fk` FOREIGN KEY (`post_id`) REFERENCES `em_posts` (`post_id`);

--
-- Constraints for table `em_posts`
--
ALTER TABLE `em_posts`
  ADD CONSTRAINT `post_author_fk` FOREIGN KEY (`post_author`) REFERENCES `userdb` (`userid`);

--
-- Constraints for table `em_tagdb`
--
ALTER TABLE `em_tagdb`
  ADD CONSTRAINT `em_tagdb_post_id_fk` FOREIGN KEY (`post_id`) REFERENCES `em_posts` (`post_id`),
  ADD CONSTRAINT `em_tagdb_tag_id_fk` FOREIGN KEY (`tag_id`) REFERENCES `tagdb` (`tag_id`);

--
-- Constraints for table `question_responsedb`
--
ALTER TABLE `question_responsedb`
  ADD CONSTRAINT `questionid_fk` FOREIGN KEY (`question_id`) REFERENCES `questiondb` (`question_id`),
  ADD CONSTRAINT `response_id_fk` FOREIGN KEY (`response_id`) REFERENCES `survey_responsedb` (`response_id`);

--
-- Constraints for table `ratingdb`
--
ALTER TABLE `ratingdb`
  ADD CONSTRAINT `em_post_rating_fk` FOREIGN KEY (`em_post_id`) REFERENCES `em_posts` (`post_id`);

--
-- Constraints for table `survey_questiondb`
--
ALTER TABLE `survey_questiondb`
  ADD CONSTRAINT `question_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questiondb` (`question_id`),
  ADD CONSTRAINT `survey_id_fk` FOREIGN KEY (`survey_id`) REFERENCES `surveydb` (`survey_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
