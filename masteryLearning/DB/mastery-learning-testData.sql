--
-- Dumping data for table `Course`
--

INSERT INTO `ML_Course` (`id`, `name`, `description`) VALUES
(1, 'Frances 1', 'Curso basico de frances'),
(2, 'Frances 2', 'Curso intermedio de frances'),
(3, 'Aleman 1', 'Curso de aleman'),
(4, 'Aleman 2', NULL),
(10, 'Lectura', NULL);

--
-- Dumping data for table `Domain`
--

INSERT INTO `ML_Domain` (`id`, `name`, `description`, `cid`) VALUES
(1, 'B2', 'Nivel de dominio B2', 2);

--
-- Dumping data for table `Evaluation`
--

INSERT INTO `ML_Evaluation` (`id`, `title`, `type`, `description`, `link`, `cid`) VALUES
(1, 'Examen de verbos', 'Examen en linea', 'Este examen tiene varios ejercicios', 'www.file.com/file.pdf', 2);

--
-- Dumping data for table `Interaction`
--

INSERT INTO `ML_Interaction` (`id`, `type`, `description`, `cid`) VALUES
(1, 'Grupal', 'Lectura por parejas', 2);

--
-- Dumping data for table `Resource`
--

INSERT INTO `ML_Resource` (`id`, `title`, `type`, `description`, `link`, `cid`) VALUES
(1, 'Verbos en presente', 'Leccion', 'Los verbos del presente en primera persona', 'www.file.com/file.pdf', 2),
(2, 'Ejercicio', 'parejas', 'Ejemplo', NULL, 2);

--
-- Dumping data for table `Student`
--

INSERT INTO `ML_Student` (`id`, `name`) VALUES
('A00810074', 'Gustavo Peniche');

--
-- Dumping data for table `Competence`
--

INSERT INTO `ML_Competence` (`id`, `name`, `parent`, `cid`) VALUES
(1, 'Fluidez', NULL, 2),
(2, 'Fluidez al platicar', 1, 2),
(3, 'Lectura', NULL, 2),
(4, 'Escritura', NULL, 2),
(5, 'Conversacion', NULL, 2),
(6, 'Aprendizaje', NULL, 2),
(7, 'Aprendizaje', NULL, 2),
(8, 'Aprendizaje', NULL, 2);

--
-- Dumping data for table `CompetenceToDomain`
--

INSERT INTO `ML_CompetenceToDomain` (`cid`, `did`) VALUES
(2, 1);

--
-- Dumping data for table `CompetenceToEvaluation`
--

INSERT INTO `ML_CompetenceToEvaluation` (`cid`, `eid`) VALUES
(2, 1);

--
-- Dumping data for table `CompetenceToInteraction`
--

INSERT INTO `ML_CompetenceToInteraction` (`cid`, `iid`) VALUES
(2, 1);

--
-- Dumping data for table `CompetenceToResource`
--

INSERT INTO `ML_CompetenceToResource` (`cid`, `rid`) VALUES
(2, 1);

--
-- Dumping data for table `CourseToStudent`
--

INSERT INTO `ML_CourseToStudent` (`cid`, `sid`) VALUES
(2, 'A00810074');