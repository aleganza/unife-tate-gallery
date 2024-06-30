<p align="center">
    <img width="160px" src="./public/logo.png"/>
    <h1 align="center">Unife Tate Gallery</h1>
</p>

## Introduction

Project for "Basi di Dati" course at the University of Ferrara by ![Alessio Ganzarolli](https://github.com/aleganza) and ![Simone Acuti](https://github.com/acuti03).
<br>
The purpose of this project is to develop a PHP website to visualize the ![Tate Collection](https://github.com/tategallery/collection) dataset. 

## Installation

- Log in to mysql
- Create the db and the tables with the queries located in ```src/sql/ddl.sql```
- Fill the db with the queries located in ```src/sql/dml.sql```
- If your mysql credentials are different, put them in ```src/php/utils/constants.php```
- Start your web server

<details>
  <summary><h2>Project Structure</h2></summary>

  ```bash
  unife-tate-gallery
  ├── data/              # database data
  │   ├── raw/
  │   │   ├── artist_data.csv
  │   │   └── artwork_data.csv
  │   └── processed/
  │       ├── artist_data.csv
  │       └── artwork_data.csv
  ├── docs/              # documentation
  ├── public/            # images
  ├── src/
  │   ├── css/           # website styles
  │   │   └── ...
  │   ├── php/           # website php code
  │   │   └── ...
  │   ├── python/        # python scripts for data cleaning
  │   │   └── ...
  │   └── sql/           # sql queries
  │       └── ...
  ├── .gitignore
  ├── .htaccess
  ├── index.php
  ├── LICENSE
  └── README.md          # project info and docs 
```
</details>

## Tech Stack

[![My Skills](https://skillicons.dev/icons?i=html,css,php,mysql,python)](https://skillicons.dev)
