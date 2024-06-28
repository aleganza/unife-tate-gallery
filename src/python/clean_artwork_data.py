import pandas as pd
from common import (
  handle_missing,
  save_file,
  sort_by_col,
  set_to_zero_missing_numeric_attributes,
  handle_zero_values
)

from constants import (
  PATHS, 
  ARTWORK_DEFAULT_VALUES
)

def clean_artwork_data():
  print('Cleaning up artwork dataset...\n')
  
  df = pd.read_csv(PATHS['RAW_ARTWORK_DATA_PATH'])
  df_copy = df.copy()
  
  
  df_copy = _remove_duplicates(df_copy)
  
  df_copy = df_copy.replace("no date", 0) \
                   .replace('c.', "") \
                   .replace('(upper):', "") \
                   .replace('(left):', "") \
                   .replace('(top):', "") \
                   .replace('(each):', "") \
                   .replace('each', "")
  df_copy = df_copy[df_copy['year'] != 'c.1997-9']
  
  df_copy = set_to_zero_missing_numeric_attributes(df_copy, ['year'])
  
  df_copy = handle_missing(df_copy, ARTWORK_DEFAULT_VALUES)
  df_copy = sort_by_col(df_copy, 'id')
  df_copy = handle_zero_values(df_copy, ['year'])
  
  save_file(df_copy, PATHS['PROCESSED_ARTWORK_DATA_PATH'])
  
def _remove_duplicates(df):
  df.drop(columns=['artist'], inplace=True)
  print('• Removed \"artist\" column')
  
  df.drop(columns=['dateText'], inplace=True)
  print('• Removed \"dateText\" column')
  
  df.drop(columns=['dimensions'], inplace=True)
  print('• Removed \"dimensions\" column')
  
  return df

if __name__ == '__main__':
  clean_artwork_data()
