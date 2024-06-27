import pandas as pd

from constants import (
  PATHS, 
  ARTIST_DEFAULT_VALUES
)

def clean_artist_data():
  print('Cleaning up artist dataset...\n')
  
  df = pd.read_csv(
    PATHS['RAW_ARTIST_DATA_PATH'],
    index_col=0,
  )
  
  df_copy = df.copy()
  
  df_copy = _sort(df_copy)
  df_copy = _remove_duplicates(df_copy)
  df_copy = _handle_missing(df_copy)
  
  save_file = input("\nSave processed artist dataset? (y/n): ").strip().lower()
  
  if save_file == 'y':
    path = PATHS['PROCESSED_ARTIST_DATA_PATH']
    
    df_copy.to_csv(path, index=False)
    print(f'Saved at path {path}')
  
def _sort(df):
  print('• Sorted rows by index')
  return df.sort_index()
  
def _remove_duplicates(df):
  df.drop(columns=['dates'], inplace=True)
  print('• Removed \"dates\" column')
  
  return df
  
def _handle_missing(df):
  n_rows_with_missing_values = df.isnull().any(axis=1).sum()
  print(f'• Found {n_rows_with_missing_values} rows with missing values, cleaning up...')
  
  for col in df.columns:
    default_val = ARTIST_DEFAULT_VALUES[col]
    
    if df[col].isnull().any():
      df[col] = df[col].fillna(default_val)
      print(f'\t• Replaced \"{col}\" column missing values with \"{default_val}\"')
    else:
      print(f'\t• \"{col}\" column had no missing values')
  
  n_rows_with_missing_values = df.isnull().any(axis=1).sum()
  print(f'• There are now {n_rows_with_missing_values} rows missing values')
  
  return df
