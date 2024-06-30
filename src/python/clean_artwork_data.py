import pandas as pd
import numpy as np
from common import (
  handle_missing,
  remove_commas,
  save_file,
  sort_by_col,
  set_to_zero_missing_numeric_attributes,
  handle_zero_values,
  update_column_names
)

from constants import (
  PATHS, 
  ARTWORK_DEFAULT_VALUES
)

def clean_artwork_data():
  print('Cleaning up artwork dataset...\n')
  
  df = pd.read_csv(PATHS['RAW_ARTWORK_DATA_PATH'])
  df_copy = df.copy()
  
  # remove useless data
  df_copy = _remove_useless_data(df)
  
  # overall cleaning
  df_copy = _remove_duplicates(df_copy)
  df_copy = set_to_zero_missing_numeric_attributes(df_copy, ['year', 'acquisitionYear'])
  df_copy = handle_missing(df_copy, ARTWORK_DEFAULT_VALUES)
  df_copy = sort_by_col(df_copy, 'id')
  df_copy = handle_zero_values(df_copy, ['year', 'acquisitionYear'])
  
  # check for foreign key integrity
  df_copy = _check_fk_integrity(df_copy)
  
  # rename columns
  df_copy = update_column_names(df_copy, {
                                  'artistRole': 'artist_role',
                                  'artistId': 'artist_id',
                                  'creditLine': 'credit_line',
                                  'acquisitionYear': 'acquisition_year',
                                  'thumbnailCopyright': 'thumbnail_copyright',
                                  'thumbnailUrl': 'thumbnail_url',
                                })
  
  # fix broken thumbnail urls
  df_copy = _fix_broken_thumbnail_urls(df_copy)
  
  save_file(df_copy, PATHS['PROCESSED_ARTWORK_DATA_PATH'])
  
def _remove_useless_data(df):
  df = df.replace("no date", 0) \
                   .replace('c.', "") \
                   .replace('(upper):', "") \
                   .replace('(left):', "") \
                   .replace('(top):', "") \
                   .replace('(each):', "") \
                   .replace('each', "")
  df = df[df['year'] != 'c.1997-9']
  
  print("• Removed some useless inconsinstent data.")
  
  return df  

def _remove_duplicates(df):
  df.drop(columns=['artist'], inplace=True)
  print('• Removed \"artist\" column')
  
  df.drop(columns=['dateText'], inplace=True)
  print('• Removed \"dateText\" column')
  
  df.drop(columns=['dimensions'], inplace=True)
  print('• Removed \"dimensions\" column')
  
  return df

def _check_fk_integrity(df):
  df_artist = pd.read_csv(PATHS['PROCESSED_ARTIST_DATA_PATH'])
  
  invalid_artists = len(df[~df['artistId'].isin(df_artist['id'])])
  print(f'• Found {invalid_artists} rows with invalid foreign key values, dropping rows...')
  
  df = df[df['artistId'].isin(df_artist['id'])]
  
  invalid_artists = len(df[~df['artistId'].isin(df_artist['id'])])
  print(f'• There are now {invalid_artists} invalid rows.')
  
  return df

def _fix_broken_thumbnail_urls(df):
  df['thumbnail_url'] = df['thumbnail_url'].str.replace("/www.", "/media.")
  
  return df

if __name__ == '__main__':
  clean_artwork_data()
