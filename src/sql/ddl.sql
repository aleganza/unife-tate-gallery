-- create and use db

CREATE DATABASE unife_tate_gallery;
USE unife_tate_gallery;

-- create tables

CREATE TABLE artist (
  id INTEGER NOT NULL,
  name VARCHAR(300) NOT NULL,
  gender VARCHAR(10) NOT NULL,
  year_of_birth VARCHAR(10) NOT NULL,
  year_of_death VARCHAR(10) NOT NULL,
  city_of_birth VARCHAR(100) NOT NULL,
  state_of_birth VARCHAR(100) NOT NULL,
  city_of_death VARCHAR(100) NOT NULL,
  state_of_death VARCHAR(100) NOT NULL,
  url VARCHAR(300) NOT NULL,

  PRIMARY KEY (id)
);

CREATE TABLE artwork (
  id INTEGER NOT NULL,
  accession_number CHAR(7) NOT NULL,
  artist_role VARCHAR(100) NOT NULL,
  artist_id INTEGER NOT NULL,
  title VARCHAR(400) NOT NULL,
  medium VARCHAR(300) NOT NULL,
  credit_line VARCHAR(900) NOT NULL,
  year VARCHAR(10) NOT NULL,
  acquisition_year VARCHAR(10) NOT NULL,
  width VARCHAR(20) NOT NULL,
  height VARCHAR(20) NOT NULL,
  depth VARCHAR(20) NOT NULL,
  units CHAR(2) NOT NULL,
  inscription VARCHAR(300) NOT NULL,
  thumbnail_copyright VARCHAR(1000) NOT NULL,
  thumbnail_url VARCHAR(300) NOT NULL,
  url VARCHAR(300) NOT NULL,

  PRIMARY KEY (id),
  FOREIGN KEY (artist_id) REFERENCES artist(id)
);
