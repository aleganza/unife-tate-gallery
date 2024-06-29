import pandas as pd
from common import (
  handle_missing,
  save_file,
  sort_by_col,
  set_to_zero_missing_numeric_attributes,
  handle_zero_values,
  update_column_names
)

from constants import (
  PATHS, 
  ARTIST_DEFAULT_VALUES
)

def clean_artist_data():
  print('Cleaning up artist dataset...\n')
  
  df = pd.read_csv(PATHS['RAW_ARTIST_DATA_PATH'])
  df_copy = df.copy()
  
  # overall cleaning
  df_copy['gender'] = df_copy['gender'].replace({'Male': 'M', 'Female': 'F'})
  df_copy = _remove_duplicates(df_copy)
  df_copy = set_to_zero_missing_numeric_attributes(df_copy, ['yearOfBirth', 'yearOfDeath'])
  df_copy = handle_missing(df_copy, ARTIST_DEFAULT_VALUES)
  df_copy = sort_by_col(df_copy, 'id')
  df_copy = handle_zero_values(df_copy, ['yearOfBirth', 'yearOfDeath'])
  
  # rename columns
  df_copy = update_column_names(df_copy, {
                                  'yearOfBirth': 'year_of_birth',
                                  'yearOfDeath': 'year_of_death',
                                  'placeOfBirth': 'place_of_birth',
                                  'placeOfDeath': 'place_of_death',
                                })
  
  
  save_file(df_copy, PATHS['PROCESSED_ARTIST_DATA_PATH'])
  
def _remove_duplicates(df):
  df.drop(columns=['dates'], inplace=True)
  print('• Removed \"dates\" column')
  
  return df

if __name__ == '__main__':
  clean_artist_data()
