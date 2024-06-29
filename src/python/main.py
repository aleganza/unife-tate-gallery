from clean_artist_data import clean_artist_data
from clean_artwork_data import clean_artwork_data

def main():
  # important: artist before artwork
  clean_artist_data()
  clean_artwork_data()

if __name__ == '__main__':
  main()
