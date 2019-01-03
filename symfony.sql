CREATE DATABASE IF NOT EXISTS wf3_sf;

USE wf3_sf;

DROP TABLE IF EXISTS user;
CREATE TABLE IF NOT EXISTS user
(
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(30) NOT NULL,
  password varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL,
  firstname varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  role varchar(20) NOT NULL,
  avatar varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS person;
CREATE TABLE IF NOT EXISTS person
(
  id int(11) NOT NULL AUTO_INCREMENT,
  firstname varchar(255) NOT NULL,
  lastname varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  birth_date date NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS comment;
CREATE TABLE IF NOT EXISTS comment
(
  id int(11) NOT NULL AUTO_INCREMENT,
  article_id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  title varchar(255) NOT NULL,
  content longtext NOT NULL,
  date datetime,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS address;
CREATE TABLE IF NOT EXISTS address
(
  id int(11) NOT NULL AUTO_INCREMENT,
  person_id int(11) NOT NULL,
  street longtext NOT NULL,
  zip_code varchar(5) NOT NULL,
  town varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS category;
CREATE TABLE IF NOT EXISTS category
(
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS article;
CREATE TABLE IF NOT EXISTS article
(
  id int(11) NOT NULL AUTO_INCREMENT,
  author_id int(11) NOT NULL,
  category_id int(11) NOT NULL,
  title varchar(255) NOT NULL,
  content longtext NOT NULL,
  description longtext NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;