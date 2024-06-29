CREATE DATABASE unife_tate_gallery;

USE unife_tate_gallery;

CREATE TABLE artist (
  id INTEGER NOT NULL,
  name VARCHAR(100) NOT NULL,
  gender VARCHAR(1) NOT NULL,
  year_of_birth VARCHAR(4),
  year_of_death VARCHAR(4),
  place_of_birth VARCHAR(100) NOT NULL,
  place_of_death VARCHAR(100) NOT NULL,
  url VARCHAR(300) NOT NULL,

  PRIMARY KEY (id)
);

CREATE TABLE artwork (
  id INTEGER NOT NULL,
  accession_number CHAR(7) NOT NULL,
  artist_role VARCHAR(20) NOT NULL,
  artist_id INTEGER NOT NULL,
  title VARCHAR(300) NOT NULL,
  medium VARCHAR(300) NOT NULL,
  credit_line VARCHAR(300) NOT NULL,
  year VARCHAR(4) NOT NULL,
  acquisition_year VARCHAR(4) NOT NULL,
  width VARCHAR(8) NOT NULL,
  height VARCHAR(8) NOT NULL,
  depth VARCHAR(8) NOT NULL,
  units CHAR(2) NOT NULL,
  inscription VARCHAR(300) NOT NULL,
  thumbnail_copyright VARCHAR(100) NOT NULL,
  thumbnail_url VARCHAR(300) NOT NULL,
  url VARCHAR(300) NOT NULL,

  PRIMARY KEY id,
  FOREIGN KEY (artist_id) REFERENCES artist(id)
);
