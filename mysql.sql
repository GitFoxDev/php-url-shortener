CREATE TABLE IF NOT EXISTS `shorten` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `shortid` text NOT NULL,
  `url` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;