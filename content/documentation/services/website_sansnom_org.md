+++
title = "Site web de l'association"
description = "Documentation à propos du site de l'"
+++

# Contribuer au site de l'ASN

## Code source

Le code source de ce site web est [disponible sur
Github](https://github.com/asn42/website). Il y a un lien vers la source des
différentes pages [en bas de celles-ci](#footer).


## Prérequis

Récupérez la dernière version du générateur de site statique zola [depuis son
site
officiel](https://www.getzola.org/documentation/getting-started/installation/).

## Générer le site statique manuellement

### Mettre à jour les statuts (optionnel)

``` sh
git submodule update --init
git submodule update --remote
remote-sources/statuts-update.sh
```

### Générer les fichiers dans `/public`

``` sh
zola build
```

Note: Le système de fichier HFS+ d'Apple gère bizarrement les caractères
accentués dans les noms de fichiers.
À 42, ça devrait fonctionner dans un sous-répertoire de
`/sgoinfre/goinfre/Perso/xlogin/`.

## Essayer le site web localement

``` sh
zola serve
```

et ouvrez [127.0.0.1:1111](http://127.0.0.1:1111/) dans un navigateur.
Le site devrait être régénéré et rechargé automatiquement à chaque modification
de fichiers.

## zola et tera

La documentation de zola [à propos des fichiers
markdown](https://www.getzola.org/documentation/content/overview/), ainsi que
[celle à propos des
templates](https://www.getzola.org/documentation/templates/overview/) et [celle
de Tera](https://tera.netlify.com/docs/templates/#templates) peuvent être
utiles (beaucoup de fonctions de Tera ne sont pas explicitées dans la
documentation de zola mais elles peuvent être utilisées directement dans les
templates).

## Soumettre une contribution

Pour soumettre une contribution,

- [faites un fork](https://guides.github.com/activities/forking/) du {% source_link() %}dépôt{% end %}
- [clonez-le](https://www.git-scm.com/docs/git-clone)
- [ajoutez comme remote](https://help.github.com/en/articles/adding-a-remote) le dépôt original `git add remote upstream https://github.com/asn42/website.git`
- créez [une nouvelle brabche](https://git-scm.com/docs/git-branch) et [passez dedans](https://git-scm.com/docs/git-checkout) pour travailler. Modifiez ensuite le contenu ou le code en essayant de faire des [commits](https://git-scm.com/docs/git-commit) explicites, puis [faites une pull request](https://help.github.com/en/articles/creating-a-pull-request) (si besoin, [mettez à jour](https://git-scm.com/docs/git-pull#Documentation/git-pull.txt---rebasefalsetruemergespreserveinteractive) votre branche en récupérant les nouveaux commits du dépôt original).

{{ new_section() }}

# Mise à jour automatique du site

Le site est mis à jour lorsqu'un commit est poussé sur la branche `static` sur
Github, ce qui déclenche un [webhook](https://developer.github.com/webhooks/).
[TravisCI](https://travis-ci.com/) se charge de pousser ce commit sur la
branche `static` lorsqu'un commit valide est poussé sur la branche `master`.

Configuration de travis :

```
language: minimal

before_script:
  # Download and unzip the zola executable
  - curl -s -L https://github.com/getzola/zola/releases/download/v0.6.0/zola-v0.6.0-x86_64-unknown-linux-gnu.tar.gz | sudo tar xzf - -C /usr/local/bin

script:
  - zola build

after_success: |
  [ $TRAVIS_BRANCH = master ] &&
  [ $TRAVIS_PULL_REQUEST = false ] &&
  zola build &&
  git checkout --orphan static &&
  git rm --cached -r . &&
  git add -f public &&
  git commit -m 'Site statique'
  git push -fq https://${GH_TOKEN}@github.com/${TRAVIS_REPO_SLUG}.git static
```

Script chargé de réceptionner le webhook :

``` python
#!/usr/bin/env python3

from os import getenv as os_getenv
from subprocess import run as run_subp

from http.server import BaseHTTPRequestHandler, HTTPServer
from urllib.parse import urlparse
import json

import base64
import hmac
import string
from hashlib import sha1

def create_hex_hmac(secret, message):
    new_hmac = hmac.new(bytes(secret, 'utf-8'), digestmod=sha1)
    new_hmac.update(bytes(message, 'utf-8'))
    return new_hmac.hexdigest()

class RequestHandler(BaseHTTPRequestHandler):
    def do_POST(self):
        content_len = int(self.headers.get('content-length'))
        post_body = self.rfile.read(content_len)

        header_hash = self.headers.get('X-Hub-Signature')
        computed_hash = 'sha1=' + create_hex_hmac(os_getenv('SECRET', ''),
                                                  post_body.decode("utf-8"))

        if header_hash != computed_hash :
            print('Wrong hash')
            self.send_response(403)
            self.end_headers()
            return

        else :
            print('Wright hash')
            self.send_response(200)
            self.end_headers()
            data = json.loads(post_body.decode("utf-8"))
            if (data.get('ref', '') == 'refs/heads/static') :
                print('Updating ASN website…')
                run_subp(['git', 'fetch', 'origin', 'static'])
                run_subp(['git', 'checkout', 'origin/static'])
            return

if __name__ == '__main__':
    server = HTTPServer(('localhost', 21901), RequestHandler)
    print('Starting server at http://localhost:21901')
server.serve_forever()
```

Il est géré par le [service
systemd](https://www.freedesktop.org/software/systemd/man/systemd.service.html)
ci-dessous :

``` ini
[Unit]
Description=a server to update ASN website on Github webhook trigger
After=nginx.service

[Service]
Type=simple
Environment="SECRET=MyFavoriteColorIsOrange"
WorkingDirectory=/path/to/sites/sansnom.org
Environment="PATH=/bin:/usr/bin"
ExecStart=/usr/bin/python3 /path/to/sites/website-update.sansnom.org/server.py
User=www-data
Group=www-data
PrivateTmp=true
ProtectSystem=full
ProtectHome=true

[Install]
WantedBy=multi-user.target
```

[Nginx](https://nginx.org/) est utilisé comme reverse proxy devant le serveur
avec cette configuration :

```
# website-update.sansnom.org server configuration
#

upstream asn-website-update {
    server localhost:21901 max_fails=0;
}

server {
    include snippets/https-listen.conf;

    access_log /var/log/nginx/website-update.sansnom.org.access.log;
    error_log /var/log/nginx/website-update.sansnom.org.error.log;

    root /path/to/sites/website-update.sansnom.org/public;

    index index.html;
    autoindex on;

    server_name website-update.sansnom.org;

    ssl_certificate /path/to/certs/website-update.sansnom.org/fullchain.pem;
    ssl_certificate_key /path/to/certs/website-update.sansnom.org/privkey.pem;

    ssl_trusted_certificate /path/to/certs/website-update.sansnom.org/fullchain.pem;
    ssl_stapling_file /path/to/certs/website-update.sansnom.org/ocsp.der;

    location / {
        proxy_pass http://asn-website-update;
        proxy_redirect off;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto https;
    }

    include snippets/letsencrypt-location.conf;
}

server {
    include snippets/http-listen.conf;

    access_log /var/log/nginx/website-update.sansnom.org.access.log;
    error_log /var/log/nginx/website-update.sansnom.org.error.log;

    root /path/to/sites/website-update.sansnom.org/public;

    server_name website-update.sansnom.org;

    include snippets/letsencrypt-location.conf;

    include snippets/https-redirect.conf;
}
```

/etc/nginx/snippets/https-listen.conf

```
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
```

/etc/nginx/snippets/https-redirect.conf

```
    location / {
        return 301 https://$host$request_uri;
        access_log off;
    }
```

/etc/nginx/snippets/http-listen.conf

```
    listen 80;
    listen [::]:80;
```

/etc/nginx/snippets/letsencrypt-location.conf

```
    location ^~ /.well-known/acme-challenge {
        default_type 'text/plain';
        alias /path/to/sites/dehydrated/public;
    }
```

{{ new_section() }}

# Licences

## Site de l'Association Sans Nom

> asn-website - site web de l'Association Sans Nom
> Copyright © 2017-2019 Association Sans Nom et contributeurs
> 
> asn-website est un logiciel libre : vous pouvez le redistribuer et/ou le
> modifier conformément aux dispositions de la licence GNU Affero General
> Public License telle que publiée par la Free Software Foundation, soit la
> version 3 de la Licence, soit (selon votre choix) toute version ultérieure.
> 
> asn-website et distribué dans l'espoir qu'il soit utile, mais **sans aucune
> garantie** ; sans même la garantie implicite de **qualité marchande** ou
> d'**adaptation** à un **usage particulier**. Voir la GNU General Public
> License pour plus de détails.
> 
> Vous devriez avoir reçu un exemplaire de la GNU Affero Public License avec
> asn-website. Dans le cas contraire, voir <https://www.gnu.org/licenses/>.

## Cadman font

> Copyright © 2018, Paul Miller.
> 
> Cette fonte logicielle est licenciée sous la SIL Open Font License, version
> 1.1.
> Cette licence est disponible avec une FAQ à : <http://scripts.sil.org/OFL>

## Graduate font

> Copyright © 2012 par Eduardo Tunni (<http://www.tipo.net.ar>), avec le Reserved
> Font Name “Graduate”
> 
> Cette fonte logicielle est licenciée sous la SIL Open Font License, version 1.1.
> Cette licence est disponible avec une FAQ à : <http://scripts.sil.org/OFL>

## Inconsolata font

> Copyright © 2006 (regular style) and 2012 (bold style) par The Inconsolata
> Project Authors.
> 
> Regular style, Raphael Linus Levien.
> Bold style par Kirill Tkachev et the Cyreal foundry.
> 
> Cette fonte logicielle est licenciée sous la SIL Open Font License, version 1.1.
> Cette licence est disponible avec une FAQ à : <http://scripts.sil.org/OFL>

## Salsa font

> Copyright © 2011 par John Vargas Beltrán (john.vargasbeltran@gmail.com), avec
> le Reserved Font Name Salsa.
> 
> Cette fonte logicielle est licenciée sous la SIL Open Font License, version 1.1.
> Cette licence est disponible avec une FAQ à : <http://scripts.sil.org/OFL>

## Special Elite font

> Copyright © 2010 by Brian J. Bonislawsky and Astigmatic (astigmatic.com)
> 
> Cette fonte logicielle est licenciée sous la Apache License, version 2.0.
> Cette licence est disponible à <http://www.apache.org/licenses/LICENSE-2.0>

## Suez One font

> Copyright © 2016 par Michal Sahar.
> 
> Cette fonte logicielle est licenciée sous la SIL Open Font License, version 1.1.
> Cette licence est disponible avec une FAQ à : <http://scripts.sil.org/OFL>

## Normalize.css

> [Normalize.css](http://necolas.github.io/normalize.css/) est publié sous la
> [MIT
> license](https://github.com/necolas/normalize.css/blob/master/LICENSE.md) par
> Nicolas Gallagher et Jonathan Neal.

## Icône copyleft

> L'icône copyleft est une version modifiée d'[une icône de Font Awesome
> Free](https://fontawesome.com/icons/copyright?style=regular).
> Elle est publiée sous la [licence Creative Commons BY
> 4.0](https://creativecommons.org/licenses/by/4.0/deed.fr).
