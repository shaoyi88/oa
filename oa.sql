/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.1.73-log : Database - oa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`oa` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `oa`;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `oa_admin` */

insert  into `oa_admin`(`admin_id`,`admin_no`,`admin_name`,`admin_phone`,`admin_account`,`admin_password`,`reg_time`,`admin_department`,`admin_role`) values (1,'1','管理员','13700000000','oa_admin','96e79218965eb72c92a549dd5a330112','1433516715',0,0),(2,'123456','测试员','13769696969','test','96e79218965eb72c92a549dd5a330112','1433516715',3,1);

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `oa_role` */

insert  into `oa_role`(`id`,`role_name`,`role_rights`) values (1,'测试权限','sys,department_list');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
