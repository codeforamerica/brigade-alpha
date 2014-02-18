from os import environ
from csv import reader
from StringIO import StringIO
from requests import get
from app import gdoc_url

if __name__ == '__main__':

    got = get(gdoc_url)
    cols = set(reader(StringIO(got.text)).next())
    assert cols == set(['name', 'website', 'events_url', 'rss', 'projects_url'])
