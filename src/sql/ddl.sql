CREATE DATABASE unife_tate_gallery;

USE unife_tate_gallery;

CREATE TABLE artist (
  id INTEGER NOT NULL,
  name VARCHAR(100) NOT NULL,
  gender VARCHAR(10) NOT NULL,
  year_of_birth VARCHAR(10) NOT NULL,
  year_of_death VARCHAR(10) NOT NULL,
  place_of_birth VARCHAR(100) NOT NULL,
  place_of_death VARCHAR(100) NOT NULL,
  url VARCHAR(300) NOT NULL,

  PRIMARY KEY (id)
);

CREATE TABLE artwork (
  id INTEGER NOT NULL,
  accession_number CHAR(7) NOT NULL,
  artist_role VARCHAR(100) NOT NULL,
  artist_id INTEGER NOT NULL,
  title VARCHAR(300) NOT NULL,
  medium VARCHAR(300) NOT NULL,
  credit_line VARCHAR(300) NOT NULL,
  year VARCHAR(10) NOT NULL,
  acquisition_year VARCHAR(10) NOT NULL,
  width VARCHAR(10) NOT NULL,
  height VARCHAR(10) NOT NULL,
  depth VARCHAR(10) NOT NULL,
  units CHAR(2) NOT NULL,
  inscription VARCHAR(300) NOT NULL,
  thumbnail_copyright VARCHAR(300) NOT NULL,
  thumbnail_url VARCHAR(300) NOT NULL,
  url VARCHAR(300) NOT NULL,

  PRIMARY KEY (id),
  FOREIGN KEY (artist_id) REFERENCES artist(id)
);

/* 
  gives 2 warnings:
    | Warning | 1265 | Data truncated for column 'name' at row 3084 |
    | Warning | 1265 | Data truncated for column 'name' at row 3504 |
*/
LOAD DATA INFILE 'X:/Sistema/Scuola/Informatica/GitHub/unife-tate-gallery/data/processed/artist_data.csv'
INTO TABLE artist
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

/* 
  gives 6 warnings:
    | Warning | 1265 | Data truncated for column 'credit_line' at row 18256         |
    | Warning | 1265 | Data truncated for column 'thumbnail_copyright' at row 65233 |
    | Warning | 1265 | Data truncated for column 'credit_line' at row 65599         |
    | Warning | 1265 | Data truncated for column 'credit_line' at row 66900         |
    | Warning | 1265 | Data truncated for column 'width' at row 67298               |
    | Warning | 1265 | Data truncated for column 'title' at row 68295               |
 */
LOAD DATA INFILE 'X:/Sistema/Scuola/Informatica/GitHub/unife-tate-gallery/data/processed/artwork_data.csv'
INTO TABLE artwork
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;
