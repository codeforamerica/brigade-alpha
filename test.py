from os import environ
import gspread

if __name__ == '__main__':

    gdocs = gspread.login(environ['GDOCS_USERNAME'], environ['GDOCS_PASSWORD'])
    sheet = gdocs.open_by_key('0ArHmv-6U1drqdGNCLWV5Q0d5YmllUzE5WGlUY3hhT2c')
    
    cols = set(sheet.sheet1.row_values(1))
    assert cols == set(['name', 'website', 'events_url', 'rss', 'projects_url'])
