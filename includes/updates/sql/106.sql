CREATE TABLE IF NOT EXISTS `#__js_ticket_fieldsordering` (`id` int(11) NOT NULL AUTO_INCREMENT,`field` varchar(50) NOT NULL,`fieldtitle` varchar(50) DEFAULT NULL,`ordering` int(11) DEFAULT NULL, `section` varchar(20) DEFAULT NULL,`fieldfor` tinyint(2) DEFAULT NULL, `published` tinyint(1) DEFAULT NULL,`sys` tinyint(1) NOT NULL, `cannotunpublish` tinyint(1) NOT NULL,`required` tinyint(1) NOT NULL DEFAULT '0',PRIMARY KEY (`id`),KEY `fieldordering_filedfor` (`fieldfor`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15;
INSERT INTO `#__js_ticket_fieldsordering` (`id`, `field`, `fieldtitle`, `ordering`, `section`, `fieldfor`, `published`, `sys`, `cannotunpublish`, `required`) VALUES (1, 'email', 'Email Address', 2, '10', 1, 1, 0, 1, 1),(15, 'users', 'Users', 1, '10', 1, 1, 0, 0, 0),(2, 'fullname', 'Full Name', 3, '10', 1, 1, 0, 1, 1),(3, 'phone', 'Phone', 3, '10', 4, 1, 0, 0, 0),(4, 'department', 'Department', 5, '10', 1, 1, 0, 0, 0),(5, 'helptopic', 'Help Topic', 6, '10', 1, 1, 0, 0, 0),(6, 'priority', 'Priority', 7, '10', 1, 1, 0, 1, 1),(7, 'subject', 'Subject', 8, '10', 1, 1, 0, 1, 1),(8, 'premade', 'Premade', 9, '10', 1, 1, 0, 0, 0),(9, 'issuesummary', 'Issue Summary', 10, '10', 1, 1, 0, 1, 1),(10, 'attachments', 'Attachments', 11, '10', 1, 1, 0, 0, 0),(11, 'internalnotetitle', 'Internal Note Title', 12, '10', 1, 1, 0, 0, 0),(12, 'assignto', 'Assign To', 13, '10', 1, 1, 0, 0, 0),(13, 'duedate', 'Due Date', 14, '10', 1, 1, 0, 0, 0),(14, 'status', 'Status', 15, '10', 1, 1, 0, 0, 0),(15, 'users', 'Users', 15, '10', 1, 1, 0, 0, 0);
INSERT INTO `#__js_ticket_config` (`configname`, `configvalue`, `configfor`) VALUES ('versioncode','1.0.6','default') ON DUPLICATE KEY UPDATE configvalue = '1.0.6';
INSERT INTO `#__js_ticket_config` (`configname`, `configvalue`, `configfor`) VALUES (' 	productversion','106','default') ON DUPLICATE KEY UPDATE configvalue = '106';
INSERT INTO `#__js_ticket_config` (`configname`, `configvalue`, `configfor`) VALUES ('productcode','jsticket','default') ON DUPLICATE KEY UPDATE configvalue = 'jsticket';