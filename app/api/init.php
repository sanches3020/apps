<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/php/db.php';

querySilent("CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");

querySilent("CREATE TABLE `mems` (
  `mem_id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_title` varchar(64) NOT NULL,
  `mem_price` double NOT NULL,
  `mem_image` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");

querySilent("CREATE TABLE `mem_likes` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `mem_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");

querySilent("CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(256) NOT NULL,
  `user_balance` int(11) NOT NULL DEFAULT '0',
  `user_hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");

/*CREATE TABLE `events` (
`event_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `object_type` varchar(64) NOT NULL,
  `object_id` varchar(64) NOT NULL,
  `object_action` varchar(64) NOT NULL,
  `event_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;*/