--
-- テーブルの構造 `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータ `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `password`) VALUES
('guest', 'guest user', '');
