+++
title = "Association website"
description = "Documentation about the site of "
aliases = ["en/documentation/services/website-sansnom-org"]
[extra]
translations = [
    "activities/services/website-sansnom-org/_index.md"
]
+++

# Contribute to the ASN website

## Source code 

The website source code is {% source_link() %}available on Github{% end %}.
There is a link to the source of each page [at its bottom](#footer).

## Submit a contribution

To propose a change, make a [pull request on
github](@/activities/discussions/documentation/free-software/pull-request/index.en.md).

## Prerequisites

Get the latest version of the static site generator _zola_ [from its official
website](https://www.getzola.org/documentation/getting-started/installation/).

## Generate the static site

Note: The Apple's HFS+ file system manage accentuated characters in filenames
weirdly.
At 42, it should work if you clone the site repository in a subdirectory of
`/sgoinfre/goinfre/Perso/xlogin/`.

### Try website locally

``` sh
zola serve
```

then open [127.0.0.1:1111](http://127.0.0.1:1111/) in a web browser.
The site should be regenerated and reloaded automatically on every file change.

### Manually generate the static site

#### Update the status (optional)

``` sh
git submodule update --init
git submodule update --remote
remote-sources/statuts-update.sh
```

#### Generate the files in `/public`

``` sh
zola build
```

## zola and Tera

Zola documentation [about markdown
files](https://www.getzola.org/documentation/content/overview/), as well as
[the one about
templates](https://www.getzola.org/documentation/templates/overview/) and [the
one about Tera](https://tera.netlify.com/docs/templates/#templates) can be
useful (lots of Tera functions are not explicitly described in zola
documentation but they can be used directly in templates).

{{ new_section() }}

# Automatic update of the site

The site is updated when a commit is pushed to the `static` branch on Github,
which triggers a [webhook](https://developer.github.com/webhooks/).
[TravisCI](https://travis-ci.com/) takes care of pushing this commit to the `static` branch when a valid commit is pushed to the `master` branch.

Travis configuration:

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

Script responsible for catching the webhook :

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

It is managed by the [systemd
service](https://www.freedesktop.org/software/systemd/man/systemd.service.html)
bellow:

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

[Nginx](https://nginx.org/) is used as a reverse proxy in front the server
with this configuration :

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

# Licenses

## Website of Association Sans Nom

> asn-website - website of Association Sans Nom
> Copyright © 2017-2020 Association Sans Nom and contributors
> 
> asn-website is free software: you can redistribute it and/or modify it
> under the terms of the GNU Affero General Public License as published by
> the Free Software Foundation, either version 3 of the License, or (at your
> option) any later version.
> 
> asn-website is distributed in the hope that it will be useful, but
> **without any warranty**; without even the implied warranty of
> **merchantability** or **fitness for a particular purpose**. See the GNU
> Affero General Public License for more details.
> 
> You should have received a copy of the GNU Affero General Public License
> along with asn-website. If not, see <https://www.gnu.org/licenses/>.

## Cadman font

> Copyright © 2018, Paul Miller.
> 
> This font software is licenced under the SIL Open Font License, version 1.1.
> This license is avaible with a FAQ at: <http://scripts.sil.org/OFL>

## Graduate font

> Copyright © 2012 by Eduardo Tunni (<http://www.tipo.net.ar>), with the
> Reserved Font Name “Graduate”
> 
> This font software is licenced under the SIL Open Font License, version 1.1.
> This license is avaible with a FAQ at: <http://scripts.sil.org/OFL>

## Inconsolata font

> Copyright © 2006 (regular style) and 2012 (bold style) by The Inconsolata
> Project Authors.
> 
> Regular style, Raphael Linus Levien.
> Bold style by Kirill Tkachev and the Cyreal foundry.
> 
> This font software is licenced under the SIL Open Font License, version 1.1.
> This license is avaible with a FAQ at: <http://scripts.sil.org/OFL>

## Salsa font

> Copyright © 2011 by John Vargas Beltrán (john.vargasbeltran@gmail.com), with
> the Reserved Font Name Salsa.
> 
> This font software is licenced under the SIL Open Font License, version 1.1.
> This license is avaible with a FAQ at: <http://scripts.sil.org/OFL>

## Special Elite font

> Copyright © 2010 by Brian J. Bonislawsky and Astigmatic (astigmatic.com)
> 
> This font software is Licensed under the Apache License, version 2.0.
> This license is avaible at <http://www.apache.org/licenses/LICENSE-2.0>

## Suez One font

> Copyright © 2016 by Michal Sahar.
> 
> This font software is licenced under the SIL Open Font License, version 1.1.
> This license is avaible with a FAQ at: <http://scripts.sil.org/OFL>

## Normalize.css

> [Normalize.css](http://necolas.github.io/normalize.css/) is published under
> the [MIT
> license](https://github.com/necolas/normalize.css/blob/master/LICENSE.md)
> by Nicolas Gallagher and Jonathan Neal.

## Icône copyleft

> The copyleft icon is a modified version of [a Font Awesome Free
> icon](https://fontawesome.com/icons/copyright?style=regular).
> It is published under the [Creative Commons BY 4.0
> license](https://creativecommons.org/licenses/by/4.0/deed.en).
