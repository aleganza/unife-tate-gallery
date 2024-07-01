import pandas as pd
from common import (
  check,
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
  ARTIST_DEFAULT_VALUES
)

def clean_artist_data():
  print('Cleaning up artist dataset...\n')
  
  df = pd.read_csv(PATHS['RAW_ARTIST_DATA_PATH'])
  df_copy = df.copy()
  
  df_copy['gender'] = df_copy['gender'].replace({'Male': 'M', 'Female': 'F'})
  print('• "Male" and "Female" values replaced with "M" and "F"')
  
  # overall cleaning
  df_copy = _remove_duplicates(df_copy)
  df_copy = _split_places(df_copy)
  df_copy = set_to_zero_missing_numeric_attributes(df_copy, ['yearOfBirth', 'yearOfDeath'])
  df_copy = handle_missing(df_copy, ARTIST_DEFAULT_VALUES)
  df_copy = sort_by_col(df_copy, 'id')
  df_copy = handle_zero_values(df_copy, ['yearOfBirth', 'yearOfDeath'])
  
  # rename columns
  df_copy = update_column_names(df_copy, {
                                  'yearOfBirth': 'year_of_birth',
                                  'yearOfDeath': 'year_of_death',
                                  'cityOfBirth': 'city_of_birth',
                                  'stateOfBirth': 'state_of_birth',
                                  'cityOfDeath': 'city_of_death',
                                  'stateOfDeath': 'state_of_death',
                                })
  
  save_file(df_copy, PATHS['PROCESSED_ARTIST_DATA_PATH'])
  
def _remove_duplicates(df):
  df.drop(columns=['dates'], inplace=True)
  print('• Removed \"dates\" column')
  
  return df

def _split_places(df):
  print(f'• Splitting some columns...')
  
  df['cityOfBirth'] = df['placeOfBirth'].str.split(', ').str[0]
  df['stateOfBirth'] = df['placeOfBirth'].str.split(', ').str[1]

  print(f'\t• placeOfBirth splitted into cityOfBirth and stateOfBirth')

  df['cityOfDeath'] = df['placeOfDeath'].str.split(', ').str[0]
  df['stateOfDeath'] = df['placeOfDeath'].str.split(', ').str[1]

  print(f'\t• cityOfDeath splitted into placeOfDeath and stateOfDeath')

  df.drop(columns=['placeOfBirth', 'placeOfDeath'], inplace=True)

  return df

if __name__ == '__main__':
  clean_artist_data()
