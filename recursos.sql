-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2014 a las 09:32:13
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `recursosdisponibles`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE IF NOT EXISTS `recursos` (
  `Tipo` varchar(30) NOT NULL,
  `Nivel` int(11) NOT NULL,
  `Contenido` text NOT NULL,
  PRIMARY KEY (`Tipo`,`Nivel`),
  KEY `Nivel` (`Nivel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`Tipo`, `Nivel`, `Contenido`) VALUES
('Adjective', 1, '<ul>Focus On Grammar 1\r\n<ul>Unit 4: That is/Those are; Possessive Adjectives; Plural Nouns. Page 25</ul>\r\n<ul>Unit 27: Noun and Adjective Modifiers. Page 210</ul>\r\n<ul>Unit 28: Comparative Adjectives. Page 218</ul>\r\n<ul>Unit 29: Superlative Adjectives. Page 225</ul></ul>\r\n<ul>Focus On Grammar 2\r\n<ul>Unit 5: Descriptive Adjectives. Page 48</ul>\r\n<ul>Unit 12: Possessive Nouns and Possessive Adjectives; questions with whose. Page 112</ul>\r\n<ul>Unit 34: Too much/too many/too+Adjective. Page 344</ul>\r\n<ul>Unit 42: Enough, too/very; as +Adjective, same/different. Page 428</ul></ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Adjective', 2, '<ul>Focus On Grammar 4</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Unit 2.19-2.20: Adjective (Suffixes and Classes). Page 41-42</ul>\r\n<ul>Unit 5.26: Confusion between Adjective and Adverb. Page 138</ul></ul>\r\n<ul>Basic English Grammar Workbook</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Adjective', 3, '<ul>Focus On Grammar 5</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Unit 2.19-2.20: Adjective (Sufixes and Classes). Page 41-42</ul>\r\n<ul>Unit 5.26: Confusion between Asjective and Adverb. Page 138</ul></ul>\r\n<ul>Basic English Grammar Workbook</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Adjective', 4, '<ul>Advanced Learners\r\n<ul>Chapter 15.4: Adjective/participle + Preposition. Page 166</ul>\r\n<ul>Chapter 21-23: Ajectives, Comparison, Gradable and Ungradable Adjectives. Page 216- 235</ul></ul>'),
('Adverb', 1, '<ul>Focus On Grammar 1\r\n<ul>Unit 13: Adverbs of frequency. Page 96</ul></ul>\r\n<ul>Focus On Grammar 2\r\n<ul>Unit 26: The simple present and present progressive, Adverbs and expressions of frequency. Page 256</ul>\r\n<ul>Unit 41: Adverbs of Manner. Page 422</ul></ul>\r\n<ul>Focus On Grammar 3</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Adverb', 2, '<ul>Focus On Grammar 4</ul>\r\n<ul>An Introduction to English Grammar \r\n<ul>Unit 1.9: Intransitive verbs and Adverbials. Page 16</ul>\r\n<ul>Unit 1.10: Adverbial complement. Page 17</ul>\r\n<ul>Unit 2.22: Adverb Suffixes. Page 44</ul>\r\n<ul>Unit 5.26: Confusion between Adjective and Adverb. Page 138</ul></ul>\r\n<ul>Basic English Grammar Workbook</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Adverb', 3, '<ul>Focus On Grammar 5\r\n<ul>Unit 17: Asverbs: Functions, Types, Placement, and Meaning. Page 296</ul></ul>\r\n<ul>An Introduction to English Grammar \r\n<ul>Unit 1.9: Intransitive verbs and Adverbials. Page 16</ul>\r\n<ul>Unit 1.10: Adverbial complement. Page 17</ul>\r\n<ul>Unit 2.22: Adverb Suffixes. Page 44</ul>\r\n<ul>Unit 5.26: Confusion between Adjective and Adverb. Page 138</ul></ul>\r\n<ul>Basic English Grammar Workbook</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Adverb', 4, '<ul>Advanced Learners\r\n<ul>Chapter 24: Adverbs. Pages 240-243</ul>\r\n<ul>Chapter 33.3: Adverbs of contrast. Page 308</ul></ul>'),
('Article', 1, '<ul>Focus On Grammar 1</ul>\r\n<ul>Focus On Grammar 2\r\n<ul>Unit 25: Count and non-count Nouns; Articles. Page 239</ul>\r\n<ul>Unit 28: Gerunds and Infinitive. Page 274</ul></ul>\r\n<ul>Focus On Grammar 3</ul>\r\n<ul>Fundamentals of English Grammar Workbook\r\n<ul>Chapter 11: Count/Non count Nouns and Articles. Page 218</ul>\r\n<ul>Chapter 13: Gerund and Infinitive. Page 256</ul></ul>'),
('Article', 2, '<ul>Focus On Grammar 4</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Unit 2.36: The ARTICLEs and reference. Page 53</ul></ul>\r\n<ul>Basic English Grammar Workbook</ul>\r\n<ul>Fundamentals of English Grammar Workbook\r\n<ul>Chapter 11: Count/Non-count Nouns and Articles. Page 218</ul></ul>'),
('Article', 3, '<ul>Focus On Grammar 5\r\n<ul>Unit 8: Definite and Indefinite Article. Page 128</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Unit 2.36: The Article and reference. Page 53</ul></ul>\r\n<ul>Basic English Grammar Workbook</ul>\r\n<ul>Fundamentals of English Grammar Workbook\r\n<ul>Chapter 11: Count/Non-count Nouns and Articles. Page 218</ul></ul>'),
('Article', 4, '<ul>Advanced Learners\r\n<ul>Chapter 28.1: Articles. Page 272</ul></ul>'),
('Conjunction', 1, '<ul>Focus On Grammar 1\r\n<ul>Unit 30: Prepositions of Time: In, On, At. Page 232</ul></ul>\r\n<ul>Focus On Grammar 2\r\n<ul>Unit 6: Prepositions of Place. Page 53</ul>\r\n<ul>Unit 11: When What +Noun, prepositions of time; ordinal numbers. Page 102</ul></ul>\r\n<ul>Focus On Grammar 3</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Conjunction', 2, '<ul>Focus On Grammar 4</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Units 2.39-2.24: Conjunctions (Coordinating and Subordinating)</ul></ul>\r\n<ul>Basic English Grammar Workbook</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Conjunction', 3, '<ul>Focus On Grammar 5</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Units 2.39-2.24: Conjunctions (Coordinating and Subordinating)</ul></ul>\r\n<ul>Basic English Grammar Workbook</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Conjunction', 4, '<ul>Advanced Learners\r\n<ul>Chapter 32.1: Conjunctions of contrast. Page 306</ul></ul>'),
('Noun', 1, '<ul>Focus On Grammar 1\r\n<ul>Unit 4: That is/Those are; Possessive Adjectives; Plural Nouns. Page 25</ul>\r\n<ul>Unit 17: Possessive Nouns; This/That/These/Those. Page 131</ul>\r\n<ul>Unit 18: Count and non-count Nouns; some and any. Page 139</ul>\r\n<ul>Unit 27: Noun and Adjective Modifiers. Page 210</ul></ul>\r\n<ul>Focus On Grammar 2\r\n<ul>Unit 4: Count Nouns; Proper Nouns. Page 38</ul>\r\n<ul>Unit 11: When What +Noun, prepositions of time; ordinal numbers. Page 102</ul>\r\n<ul>Unit 12: Possessive Nouns and Possessive Adjectives; questions with whose. Page 112</ul>\r\n<ul>Unit 25: Count and non-count Nouns; Articles. Page 239</ul></ul>\r\n<ul>Focus On Grammar 3\r\n<ul>Fundamentals of English Grammar Workbook</ul>\r\n<ul>Chapter 6: Nouns and Pronouns. Page 108</ul>\r\n<ul>Chapter 11: Count/Non count Nouns and Articles. Page 218</ul></ul>'),
('Noun', 2, '<ul>Focus On Grammar 4</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Unit 2.2: Nouns. Page 33</ul>\r\n<ul>Unit 2.3: Noun Suffixes. Page 33</ul>\r\n<ul>Unit 2.4: Noun Classes. Page 33</ul>\r\n<ul>Unit 5.5: Collective Nouns.  Page 128</ul>\r\n<ul>Unit 5.8: Singular Nouns ending in –s. Page 130</ul>\r\n<ul>Unit 6.8: Abstract Nouns. Page 153</ul>\r\n<ul>Unit 8.13: Genitives of Nouns. Page 219</ul></ul>\r\n<ul>Basic English Grammar Workbook\r\n<ul>Chapter 6: Nouns and Pronouns. Page 74</ul>\r\n<ul>Chapter 7: count and Non-count Nouns. Page 88</ul>\r\n<ul>Chapter 14: Nouns and Modifiers. Page 200</ul></ul>\r\n<ul>Fundamentals of English Grammar Workbook\r\n<ul>Chapter 6: Nouns and Pronouns. Page 208</ul>\r\n<ul>Chapter 11: Count/Non-count Nouns and Articles. Page 218</ul></ul>'),
('Noun', 3, '<ul>Focus On Grammar 5</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Unit 2.2: Nouns. Page 33</ul>\r\n<ul>Unit 2.3: Noun Suffixes. Page 33</ul>\r\n<ul>Unit 2.4: Noun Classes. Page 33</ul>\r\n<ul>Unit 5.5: Collective Nouns.  Page 128</ul>\r\n<ul>Unit 5.8: Singular Nouns ending in –s. Page 130</ul>\r\n<ul>Unit 6.8: Abstract Nouns. Page 153</ul>\r\n<ul>Unit 8.13: Genitives of Nouns. Page 219</ul></ul>\r\n<ul>Basic English Grammar Workbook\r\n<ul>Chapter 6: Nouns and Pronouns. Page 74</ul>\r\n<ul>Chapter 7: count and Non-count Nouns. Page 88</ul>\r\n<ul>Chapter 14: Nouns and Modifiers. Page 200</ul></ul>\r\n<ul>Fundamentals of English Grammar Workbook\r\n<ul>Chapter 6: Nouns and Pronouns. Page 208</ul>\r\n<ul>Chapter 11: Count/Non-count Nouns and Articles. Page 218</ul></ul>'),
('Noun', 4, '<ul>Advanced Learners\r\n<ul>Chapter 15.3: Noun + Preposition. Page 166</ul>\r\n<ul>Chapter 25: Nouns and Noun phrases. Page 248-251</ul>\r\n<ul>Chapter 26: Possessives and compound Nouns. Page 256-259</ul></ul>'),
('Preposition', 1, '<ul>Focus On Grammar 1\r\n<ul>Unit 30: Prepositions of Time: In, On, At. Page 232</ul></ul>\r\n<ul>Focus On Grammar 2\r\n<ul>Unit 6: Prepositions of Place. Page 53</ul>\r\n<ul>Unit 11: When What +Noun, prepositions of time; ordinal numbers. Page 102</ul></ul>\r\n<ul>Focus On Grammar 3</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Preposition', 2, '<ul>Focus On Grammar 4</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Unit 2.41-2.42: Simple and Complex Prepositions. Page 56-57</ul></ul>\r\n<ul>Basic English Grammar Workbook</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Preposition', 3, '<ul>Focus On Grammar 5\r\n<ul>Unit 12: Adjective Clauses with Prepositions; Adjective Phrases. Page 195</ul></ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Unit 2.41-2.42: Simple and Complex Prepositions. Page 56-57</ul></ul>\r\n<ul>Basic English Grammar Workbook</ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Preposition', 4, '<ul>Advanced Learners\r\n<ul>Chapter 14.4: Phrasal-Prepositional Verbs. Page 158</ul>\r\n<ul>Chapter 15: Dependent Prepositions. Page 164-167</ul>\r\n<ul>Chapter 29: Prepositions. Page 280</ul>\r\n<ul>Chapter 32.2: Prepositions of contrast. Page 307</ul></ul>'),
('Pronoun', 1, '<ul>Focus On Grammar 1\r\n<ul>Unit 2: This is/These are; subject Pronouns. Page 9</ul>\r\n<ul>Unit 24: Subject and Object Pronouns. Page 287</ul></ul>\r\n<ul>Focus On Grammar 2\r\n<ul>Unit 24: Subject and Object Pronouns; direct and indirect object</ul></ul>\r\n<ul>Focus On Grammar 3\r\n<ul>Fundamentals of English Grammar Workbook</ul>\r\n<ul>Chapter 6: Nouns and Pronouns. Page 108</ul></ul>'),
('Pronoun', 2, '<ul>Focus On Grammar 4</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Chapter 2.24-2.33: Pronoun Classes (Personal, Possessive, Demonstrative, Reciprocal, Interrogative, Relative, Indefinite) and Numeral. Pages 45-51</ul>\r\n<ul>Chapter 5.6: Indefinite Pronouns and Numeral. Page 129</ul>\r\n<ul>Chapter 6.13: Pronoun Reference. Page 157</ul>\r\n<ul>Chapter 6.14: Pronoun Agreement. Page 158</ul>\r\n<ul>Chapter 8.14: Genitives of Pronouns. Page 220</ul></ul>\r\n<ul>Basic English Grammar Workbook\r\n<ul>Chapter 6: Nouns and Pronouns. Page 208</ul></ul>\r\n<ul>Fundamentals of English Grammar Workbook\r\n<ul>Chapter 6: Nouns and Pronouns. Page 208</ul></ul>'),
('Pronoun', 3, '<ul>Focus On Grammar 5</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Chapter 2.24-2.33: Pronoun Classes (Personal, Possessive, Demonstrative, Reciprocal, Interrogative, Relative, Indefinite) and Numeral. Pages 45-51</ul>\r\n<ul>Chapter 5.6: Indefinite Pronouns and Numeral. Page 129</ul>\r\n<ul>Chapter 6.13: Pronoun Reference. Page 157</ul>\r\n<ul>Chapter 6.14: Pronoun Agreement. Page 158</ul>\r\n<ul>Chapter 8.14: Genitives of Pronouns. Page 220</ul></ul>\r\n<ul>Basic English Grammar Workbook\r\n<ul>Chapter 6: Nouns and Pronouns. Page 208</ul></ul>\r\n<ul>Fundamentals of English Grammar Workbook\r\n<ul>Chapter 6: Nouns and Pronouns. Page 208</ul></ul>\r\n'),
('Pronoun', 4, '<ul>Advanced Learners\r\n<ul>Chapter 27: Pronouns. Page 264-267</ul></ul>'),
('Verb', 1, '<ul>Focus On Grammar 1\r\n<ul>Unit 21: The Simple Past: Regular Verbs (Statements). Page 163</ul>\r\n<ul>Unit 22: The Simple Past: Regular and Irregular Verbs; Yes/No questions. Page 170</ul></ul>\r\n<ul>Focus On Grammar 2\r\n<ul>Unit 20: The Simple Past: Regular Verbs – Affirmative and Negative Statements. Page 188</ul>\r\n<ul>Unit 21: The Simple Past: Irregular Verbs – Affirmative and Negative Statements. Page 198</ul>\r\n<ul>Unit 27: Non-action Verbs. Page 266</ul></ul>\r\n<ul>Focus On Grammar 3\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Verb', 2, '<ul>Focus On Grammar 4</ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Unit 1.2: Subject Predicate and Verb. Page 10</ul>\r\n<ul>Unit 1.5: Subject and Verb. Page 12</ul>\r\n<ul>Unit 1.7: Transitive VERBs and direct object. Page 15</ul>\r\n<ul>Unit 1.8: Linking VERBs and subject complement. Page 16</ul>\r\n<ul>Unit 2.8-2.11: Main verb, verb suffixes, regular and irregular verb. Page 36-37.</ul>\r\n<ul>Unit 5. Usage Problems; Subject-VERB agreement. Page 125</ul>\r\n<ul>Unit 5.19: Auxiliaries and VERBs. Page 135</ul></ul>\r\n<ul>Basic English Grammar Workbook\r\n<ul>Appendix 1: Irregular Verbs. A-1</ul>\r\n<ul>Appendix 6: Two-Syllable VERBs: Spelling of-ed and –ing. A-6</ul></ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Verb', 3, '<ul>Focus On Grammar 5\r\n<ul>Unit 3: Simple and Progressive: action and Non-Action Verbs. Page 33</ul></ul>\r\n<ul>An Introduction to English Grammar\r\n<ul>Unit 1.2: Subject Predicate and Verb. Page 10</ul>\r\n<ul>Unit 1.5: Subject and Verb. Page 12</ul>\r\n<ul>Unit 1.7: Transitive Verbs and direct object. Page 15</ul>\r\n<ul>Unit 1.8: Linking Verbs and subject complement. Page 16</ul>\r\n<ul>Unit 2.8-2.11: Main verb, verb suffixes, regular and irregular verb. Page 36-37.</ul>\r\n<ul>Unit 5. Usage Problems; Subject-VERB agreement. Page 125</ul>\r\n<ul>Unit 5.19: Auxiliaries and Verbs. Page 135</ul></ul>\r\n<ul>Basic English Grammar Workbook\r\n<ul>Appendix 1: Irregular Verbs. A-1</ul>\r\n<ul>Appendix 6: Two-Syllable Verbs: Spelling of-ed and –ing. A-6</ul></ul>\r\n<ul>Fundamentals of English Grammar Workbook</ul>'),
('Verb', 4, '<ul>Advanced Learners\r\n<ul>Chapter 1.3: Verbs rarely used in the continuous. Page 48</ul>\r\n<ul>Chapter 5.2: Verbs rarely used in the continuous. Page 81</ul>\r\n<ul>Chapter 9.5: Reporting Verbs and their patterns. Page 115</ul>\r\n<ul>Chapter 12.3: Verbs followed by -ing forms and infinitives. Page 142</ul>\r\n<ul>Chapter 14: Multi-word Verbs. Page 156-159</ul>\r\n<ul>Chapter 15.2: Verbs + Preposition patterns. Page 165</ul>\r\n<ul>Chapter 16: Modal Verbs 1: can, could, may, might, be able to. Page 164-167</ul>\r\n<ul>Chapter 17: Modal Verbs 2: must, should,ought to, have to, need to. Pages 182-185</ul>\r\n<ul>Chapter 18: Modal Verbs 3: will, would, shall. Page 190-198</ul>\r\n<ul>Chapter 19.1: Auxiliary Verbs. Page 200</ul>\r\n<ul>Chapter 20: Confusing Verbs. Pages 208-211</ul>\r\n<ul>Chapter 30.2: VERB patterns. Page 290 </ul></ul>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
