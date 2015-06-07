/*
SQLyog Community Edition- MySQL GUI v6.5 Beta2
MySQL - 5.1.36-community-log : Database - oa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

create database if not exists `oa`;

USE `oa`;

/*Table structure for table `oa_admin` */

DROP TABLE IF EXISTS `oa_admin`;

CREATE TABLE `oa_admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `admin_name` varchar(10) DEFAULT NULL COMMENT '用户名',
  `admin_account` varchar(16) DEFAULT NULL COMMENT '帐号',
  `admin_password` varchar(32) DEFAULT NULL COMMENT '密码',
  `reg_time` varchar(16) DEFAULT NULL COMMENT '注册时间',
  `admin_department` int(10) DEFAULT NULL COMMENT '部门',
  `admin_rights` text COMMENT '权限',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `account` (`admin_account`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `oa_admin` */

insert  into `oa_admin`(`admin_id`,`admin_name`,`admin_account`,`admin_password`,`reg_time`,`admin_department`,`admin_rights`) values (1,'管理员','oa_admin','96e79218965eb72c92a549dd5a330112','1433516715',0,'all'),(2,'测试员','test','96e79218965eb72c92a549dd5a330112','1433516715',0,'sys,department_list,recode,customer_list,worker_list,sign,subscribe_list');

/*Table structure for table `oa_department` */

DROP TABLE IF EXISTS `oa_department`;

CREATE TABLE `oa_department` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `pid` int(10) DEFAULT NULL COMMENT '父部门id，0为顶级',
  `department_name` varchar(255) DEFAULT NULL COMMENT '部门名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `oa_department` */

insert  into `oa_department`(`id`,`pid`,`department_name`) values (1,0,'测试部门'),(2,0,'测试部门1'),(3,1,'二级部门'),(4,3,'三级部门'),(5,2,'二级部门');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
