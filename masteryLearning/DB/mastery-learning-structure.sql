--
-- Table structure for table `ML_Competence`
--

CREATE TABLE IF NOT EXISTS `ML_Competence` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` int(10) unsigned DEFAULT NULL,
  `cid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `ML_CompetencetoDomain`
--

CREATE TABLE IF NOT EXISTS `ML_CompetencetoDomain` (
  `cid` int(10) unsigned NOT NULL DEFAULT '0',
  `did` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`,`did`),
  KEY `did` (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ML_CompetencetoEvaluation`
--

CREATE TABLE IF NOT EXISTS `ML_CompetencetoEvaluation` (
  `cid` int(10) unsigned NOT NULL DEFAULT '0',
  `eid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`,`eid`),
  KEY `eid` (`eid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ML_CompetencetoInteraction`
--

CREATE TABLE IF NOT EXISTS `ML_CompetencetoInteraction` (
  `cid` int(10) unsigned NOT NULL DEFAULT '0',
  `iid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`,`iid`),
  KEY `iid` (`iid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ML_CompetencetoResource`
--

CREATE TABLE IF NOT EXISTS `ML_CompetencetoResource` (
  `cid` int(10) unsigned NOT NULL DEFAULT '0',
  `rid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`,`rid`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ML_Course`
--

CREATE TABLE IF NOT EXISTS `ML_Course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `ML_CoursetoProfessor`
--

CREATE TABLE IF NOT EXISTS `ML_CoursetoProfessor` (
  `cid` int(10) unsigned NOT NULL DEFAULT '0',
  `pid` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`,`pid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ML_CoursetoStudent`
--

CREATE TABLE IF NOT EXISTS `ML_CoursetoStudent` (
  `cid` int(10) unsigned NOT NULL DEFAULT '0',
  `sid` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cid`,`sid`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ML_Domain`
--

CREATE TABLE IF NOT EXISTS `ML_Domain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ML_Evaluation`
--

CREATE TABLE IF NOT EXISTS `ML_Evaluation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `cid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ML_Interaction`
--

CREATE TABLE IF NOT EXISTS `ML_Interaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `ML_Professor`
--

CREATE TABLE IF NOT EXISTS `ML_Professor` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ML_Resource`
--

CREATE TABLE IF NOT EXISTS `ML_Resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `cid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `ML_Student`
--

CREATE TABLE IF NOT EXISTS `ML_Student` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ML_Competence`
--
ALTER TABLE `ML_Competence`
  ADD CONSTRAINT `ML_Competence_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `ML_Competence` (`id`),
  ADD CONSTRAINT `ML_Competence_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `ML_Course` (`id`);

--
-- Constraints for table `ML_CompetencetoDomain`
--
ALTER TABLE `ML_CompetencetoDomain`
  ADD CONSTRAINT `ML_CompetencetoDomain_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `ML_Competence` (`id`),
  ADD CONSTRAINT `ML_CompetencetoDomain_ibfk_2` FOREIGN KEY (`did`) REFERENCES `ML_Domain` (`id`);

--
-- Constraints for table `ML_CompetencetoEvaluation`
--
ALTER TABLE `ML_CompetencetoEvaluation`
  ADD CONSTRAINT `ML_CompetencetoEvaluation_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `ML_Competence` (`id`),
  ADD CONSTRAINT `ML_CompetencetoEvaluation_ibfk_2` FOREIGN KEY (`eid`) REFERENCES `ML_Evaluation` (`id`);

--
-- Constraints for table `ML_CompetencetoInteraction`
--
ALTER TABLE `ML_CompetencetoInteraction`
  ADD CONSTRAINT `ML_CompetencetoInteraction_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `ML_Competence` (`id`),
  ADD CONSTRAINT `ML_CompetencetoInteraction_ibfk_2` FOREIGN KEY (`iid`) REFERENCES `ML_Interaction` (`id`);

--
-- Constraints for table `ML_CompetencetoResource`
--
ALTER TABLE `ML_CompetencetoResource`
  ADD CONSTRAINT `ML_CompetencetoResource_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `ML_Competence` (`id`),
  ADD CONSTRAINT `ML_CompetencetoResource_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `ML_Resource` (`id`);

--
-- Constraints for table `ML_CoursetoProfessor`
--
ALTER TABLE `ML_CoursetoProfessor`
  ADD CONSTRAINT `ML_CoursetoProfessor_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `ML_Course` (`id`),
  ADD CONSTRAINT `ML_CoursetoProfessor_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `ML_Professor` (`id`);

--
-- Constraints for table `ML_CoursetoStudent`
--
ALTER TABLE `ML_CoursetoStudent`
  ADD CONSTRAINT `ML_CoursetoStudent_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `ML_Course` (`id`),
  ADD CONSTRAINT `ML_CoursetoStudent_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `ML_Student` (`id`);

--
-- Constraints for table `ML_Domain`
--
ALTER TABLE `ML_Domain`
  ADD CONSTRAINT `ML_Domain_ibfk_6` FOREIGN KEY (`cid`) REFERENCES `ML_Course` (`id`);

--
-- Constraints for table `ML_Evaluation`
--
ALTER TABLE `ML_Evaluation`
  ADD CONSTRAINT `ML_Evaluation_ibfk_5` FOREIGN KEY (`cid`) REFERENCES `ML_Course` (`id`);

--
-- Constraints for table `ML_Interaction`
--
ALTER TABLE `ML_Interaction`
  ADD CONSTRAINT `ML_Interaction_ibfk_4` FOREIGN KEY (`cid`) REFERENCES `ML_Course` (`id`);

--
-- Constraints for table `ML_Resource`
--
ALTER TABLE `ML_Resource`
  ADD CONSTRAINT `ML_Resource_ibfk_3` FOREIGN KEY (`cid`) REFERENCES `ML_Course` (`id`);