from time import time
from glob import glob
from mimetypes import guess_type
from os.path import exists
from json import dumps

from flask import Flask
from flask import Response

cors = 'Access-Control-Allow-Origin'

app = Flask(__name__)

@app.route('/')
def index_page():
    with open('index.php') as index:
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

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
