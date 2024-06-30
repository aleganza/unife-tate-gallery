import numpy as np

def check(df):
  print('Checking dataset...')
  
  for col in df.columns:
    print(f'• {col} attribute is type {df[col].dtype} and has {count_missing_values_in_column(df[col])} missing values')
  
def count_missing_values_in_column(col):
  return col.isnull().sum()

def sort_by_col(df, col_name):
  print(f'• Sorted rows by {col_name}')
  return df.sort_values(col_name)

# to be usually called before handle_zero_values 
def set_to_zero_missing_numeric_attributes(df, values):
  for val in values:
    df[val] = df[val].replace('', 0)
    df[val] = df[val].replace(np.nan, 0).astype(int)
  
  return df

# to be usually called after set_to_zero_missing_numeric_attributes 
def handle_zero_values(df, values):
  for val in values:
    df[val] = df[val].replace(0, 'Unknown')
  
  return df

def update_column_names(df, new_column_names):
  print("• Renaming columns...")
  for name_couple in new_column_names:
    print(f'\t• {name_couple} => {new_column_names[name_couple]}')
  
  return df.rename(columns=new_column_names)

def remove_commas(df):
  for col in df.columns:
    df[col] = df[col].str.replace(",", "")
    
  return df
    
def handle_missing(df, defaults):
  n_rows_with_missing_values = df.isnull().any(axis=1).sum()
  print(f'• Found {n_rows_with_missing_values} rows with missing values, cleaning up...')
  
  for col in df.columns:
    default_val = defaults[col]
    
    if df[col].isnull().any():
      df[col] = df[col].fillna(default_val)
      print(f'\t• Replaced {col} attribute missing values with \"{default_val}\"')
    else:
      print(f'\t• {col} attribute had no missing values')
  
  n_rows_with_missing_values = df.isnull().any(axis=1).sum()
  print(f'• There are now {n_rows_with_missing_values} rows missing values')
  
  return df

def save_file(df, path):
  save_file = input("\nSave dataset? (y/n): ").strip().lower()
  
  if save_file == 'y':
    df.to_csv(path, index=False)
    print(f'Saved at path {path}')
    