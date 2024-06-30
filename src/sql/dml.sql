-- fill the db

LOAD DATA INFILE 'your/path/to/artist_data.csv'
INTO TABLE artist
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

LOAD DATA INFILE 'your/path/to/artwork_data.csv'
INTO TABLE artwork
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;

-- Acuti path: /Applications/XAMPP/xamppfiles/htdocs/unife-tate-gallery/data/processed
-- Ganzarolli path: X:/Sistema/Scuola/Informatica/GitHub/unife-tate-gallery/data/processed/