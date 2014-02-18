from sys import stderr
from os import environ
from csv import DictReader
from StringIO import StringIO
from urlparse import urlparse
from random import shuffle
from time import sleep

from requests import get
from app import db, Project, gdoc_url

if 'GITHUB_TOKEN' in environ:
    github_auth = (environ['GITHUB_TOKEN'], '')
else:
    github_auth = None

# headers = {'Authorization': 'token %s' % GITHUB_TOKEN, 'Accept' : "application/vnd.github.v3+json"}

def update_project_info(row):
    ''' Update info from Github, if it's missing.
    '''
    if 'code_url' not in row:
        return row
    
    _, host, path, _, _, _ = urlparse(row['code_url'])
    
    if host == 'github.com':
        repo_url = 'https://api.github.com/repos' + path
        
        got = get(repo_url, auth=github_auth)
        
        if got.status_code in range(400, 499):
            raise IOError('We done got throttled')
        
        repo = got.json()
        sleep(1) # be nice to Github
        
        if 'name' not in row or not row['name']:
            row['name'] = repo['name']
        
        if 'description' not in row or not row['description']:
            row['description'] = repo['description']
        
        if 'link_url' not in row or not row['link_url']:
            row['link_url'] = repo['homepage']
    
    return row

def get_orgs():
    ''' Get a row for each organization from the Brigade Info spreadsheet.
    
        Use GDOCS_USERNAME & GDOCS_PASSWORD environment variables for GDocs.
        Return a list of dictionaries, one for each row past the header.
    '''
    got = get(gdoc_url)
    data = list(DictReader(StringIO(got.text)))
    
    return data

if __name__ == '__main__':

    for org in get_orgs():
        print >> stderr, 'Found', org['name'], 'with projects at', org['projects_url']
        
        got = get(org['projects_url'])
        data = list(DictReader(StringIO(got.text), dialect='excel-tab'))
        
        shuffle(data)
        
        for row in data:
            row = update_project_info(row)
            print row
            
            kwargs = dict(name=row.get('name', None), code_url=row.get('code_url', None),
                          link_url=row.get('link_url', None), description=row.get('description', None),
                          type=row.get('type', None), category=row.get('category', None))

            project = Project(**kwargs)
            db.session.add(project)
            
    db.session.commit()
