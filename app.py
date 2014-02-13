from time import time
from glob import glob
from mimetypes import guess_type
from os.path import exists
from json import dumps

from flask import Flask
from flask import Response
from flask.ext.sqlalchemy import SQLAlchemy
import flask.ext.restless
from flask.ext.heroku import Heroku

cors = 'Access-Control-Allow-Origin'

app = Flask(__name__)
heroku = Heroku(app)
db = SQLAlchemy(app)

# For local development
# app.config["SQLALCHEMY_DATABASE_URI"] = 'postgres://hackyourcity@localhost/brigadealpha'

class Project(db.Model):
    name = db.Column(db.Unicode(), primary_key=True)
    code_url = db.Column(db.Unicode())
    link_url = db.Column(db.Unicode())
    description = db.Column(db.Unicode())
    type = db.Column(db.Unicode())
    category = db.Column(db.Unicode())
    
    def __init__(self, name, code_url=None, link_url=None,
                 description=None, type=None, category=None):
        self.name = name
        self.code_url = code_url
        self.link_url = link_url
        self.description = description
        self.type = type
        self.category = category

@app.route('/')
def index_page():
    with open('index.html') as index:
        return index.read()

@app.route('/<path:path>')
def a_file(path):
    for name in [path] + glob(path + '.*'):
        if not exists(name):
            continue
    
        with open(name) as file:
            body = file.read()
            type, _ = guess_type(name)
            return Response(body, headers={'Content-type': type})

@app.route('/.well-known/status')
def status():
    status = {
        'status': 'ok',
        'updated': int(time()),
        'dependencies': [],
        'resources': {}
        }

    body = dumps(status)

    return Response(body, headers={'Content-type': 'application/json', cors: '*'})

manager = flask.ext.restless.APIManager(app, flask_sqlalchemy_db=db)
manager.create_api(Project, methods=['GET'], collection_name='projects', max_results_per_page=-1)

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
