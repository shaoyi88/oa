/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.1.73-log : Database - oa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`oa` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `oa`;

/*Table structure for table `oa_address` */

DROP TABLE IF EXISTS `oa_address`;

CREATE TABLE `oa_address` (
  `address_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '地址id',
  `user_id` int(10) DEFAULT NULL COMMENT '用户id',
  `is_default` tinyint(1) DEFAULT NULL COMMENT '1默认0非默认',
  `province` int(10) DEFAULT NULL COMMENT '省',
  `city` int(10) DEFAULT NULL COMMENT '市',
  `area` int(10) DEFAULT NULL COMMENT '区',
  `address` int(10) DEFAULT NULL COMMENT '地址',
  PRIMARY KEY (`address_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_address` */

/*Table structure for table `oa_admin` */

DROP TABLE IF EXISTS `oa_admin`;

CREATE TABLE `oa_admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `admin_no` varchar(32) DEFAULT NULL COMMENT '工号',
  `admin_name` varchar(10) DEFAULT NULL COMMENT '用户名',
  `admin_phone` varchar(11) DEFAULT NULL COMMENT '手机',
  `admin_account` varchar(16) DEFAULT NULL COMMENT '帐号',
  `admin_password` varchar(32) DEFAULT NULL COMMENT '密码',
  `reg_time` varchar(16) DEFAULT NULL COMMENT '注册时间',
  `admin_department` int(10) DEFAULT NULL COMMENT '部门',
  `admin_role` int(10) DEFAULT NULL COMMENT '角色',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `account` (`admin_account`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `oa_admin` */

insert  into `oa_admin`(`admin_id`,`admin_no`,`admin_name`,`admin_phone`,`admin_account`,`admin_password`,`reg_time`,`admin_department`,`admin_role`) values (1,'1','管理员','13700000000','oa_admin','96e79218965eb72c92a549dd5a330112','1433516715',0,0);

/*Table structure for table `oa_coupon` */

DROP TABLE IF EXISTS `oa_coupon`;

CREATE TABLE `oa_coupon` (
  `coupon_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '红包id',
  `user_id` int(10) DEFAULT NULL COMMENT '用户id',
  `coupon_amount` int(10) DEFAULT NULL COMMENT '红包金额',
  `coupon_condition` int(10) DEFAULT NULL COMMENT '使用条件，0为无限制',
  `coupon_expire` varchar(16) DEFAULT NULL COMMENT '过期时间',
  `has_used` tinyint(1) DEFAULT NULL COMMENT '0未使用1已使用',
  PRIMARY KEY (`coupon_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_coupon` */

/*Table structure for table `oa_customer` */

DROP TABLE IF EXISTS `oa_customer`;

CREATE TABLE `oa_customer` (
  `customer_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '客户id',
  `customer_name` varchar(255) DEFAULT NULL COMMENT '客户姓名',
  `customer_sex` tinyint(1) DEFAULT NULL COMMENT '客户性别，1男2女',
  `customer_age` int(3) DEFAULT NULL COMMENT '客户年龄',
  `customer_card` varchar(18) DEFAULT NULL COMMENT '客户身份证',
  `customer_language` tinyint(1) DEFAULT NULL COMMENT '客户语言',
  `customer_type` tinyint(1) DEFAULT NULL COMMENT '客户类别',
  `customer_service_type` tinyint(1) DEFAULT NULL COMMENT '客户服务类别',
  `customer_address` varchar(255) DEFAULT NULL COMMENT '客户住址',
  `customer_hospital` int(10) DEFAULT NULL COMMENT '客户医院',
  `customer_hospital_department` int(10) DEFAULT NULL COMMENT '客户医院科室',
  `customer_bed_no` varchar(16) DEFAULT NULL COMMENT '客户床位',
  `customer_illness` varchar(512) DEFAULT NULL COMMENT '客户病情',
  `customer_allergy` varchar(512) DEFAULT NULL COMMENT '客户过敏食品药品',
  `customer_hobby` varchar(255) DEFAULT NULL COMMENT '客户嗜好',
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_customer` */

/*Table structure for table `oa_department` */

DROP TABLE IF EXISTS `oa_department`;

CREATE TABLE `oa_department` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` int(10) DEFAULT NULL COMMENT '父部门id，0为顶级',
  `department_name` varchar(255) DEFAULT NULL COMMENT '部门名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `oa_department` */

insert  into `oa_department`(`id`,`pid`,`department_name`) values (1,0,'测试部门1'),(7,6,'测试3'),(3,1,'二级部门'),(4,3,'三级部门'),(6,0,'测试2'),(8,0,'中文'),(9,8,'1234');

/*Table structure for table `oa_role` */

DROP TABLE IF EXISTS `oa_role`;

CREATE TABLE `oa_role` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `role_name` varchar(255) DEFAULT NULL COMMENT '权限名',
  `role_rights` text COMMENT '权限',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `oa_role` */

insert  into `oa_role`(`id`,`role_name`,`role_rights`) values (1,'测试权限','department_list,user_list,sys,record');

/*Table structure for table `oa_user` */

DROP TABLE IF EXISTS `oa_user`;

CREATE TABLE `oa_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_icon` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `user_nickname` varchar(255) DEFAULT NULL COMMENT '用户昵称',
  `user_weixin` varchar(255) DEFAULT NULL COMMENT '用户微信',
  `user_phone` varchar(11) DEFAULT NULL COMMENT '用户手机',
  `user_sex` tinyint(1) DEFAULT NULL COMMENT '性别，1男2女',
  `user_province` int(11) DEFAULT NULL COMMENT '用户省份',
  `user_city` int(11) DEFAULT NULL COMMENT '用户市区',
  `user_last_visit_time` varchar(16) DEFAULT NULL COMMENT '最近访问时间',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `oa_user` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
