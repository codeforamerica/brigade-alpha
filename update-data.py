from sys import stderr
from os import environ
from csv import DictReader
from StringIO import StringIO

import gspread
import requests
from app import db, Project

def update_project_info(row):
    ''' Update info from Github, if it's missing.
    '''
    return row

def get_orgs():
    ''' Get a row for each organization from the Brigade Info spreadsheet.
    
        Use GDOCS_USERNAME & GDOCS_PASSWORD environment variables for GDocs.
        Return a list of dictionaries, one for each row past the header.
    '''
    gdocs = gspread.login(environ['GDOCS_USERNAME'], environ['GDOCS_PASSWORD'])
    sheet = gdocs.open_by_key('0ArHmv-6U1drqdGNCLWV5Q0d5YmllUzE5WGlUY3hhT2c')
    
    data = sheet.sheet1.get_all_values()
    cols, rows = data[0], data[1:]
    
    return [dict(zip(cols, row)) for row in rows]

if __name__ == '__main__':

    for org in get_orgs():
        print >> stderr, 'Found', org['name'], 'with projects at', org['projects_url']
        
        got = requests.get(org['projects_url'])
        data = DictReader(StringIO(got.text), dialect='excel-tab')
        
        for row in data:
            row = update_project_info(row)
            print ' ', row['name'], row['code_url']
