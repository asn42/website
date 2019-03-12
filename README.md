# Association Sans Nom website
A static website for Association Sans Nom, the 42 student association
for all Free- and security-related stuff !

![ASN logo](static/images/logo.svg)

## Requirement

* Get the latest version of zola static site generator [from the official
website](https://www.getzola.org/documentation/getting-started/installation/).

## Build the static site

### Update the statutes (optional)

``` sh
git submodule update --init
git submodule update --remote
remote-sources/statuts-update.sh
```

### Try the website locally

``` sh
zola serve
```

and go to [127.0.0.1:1111](http://127.0.0.1:1111/) in a browser.
It should rebuild and then reload the website in the browser automatically each
time you change files.

### Create the files in `/public`

``` sh
zola build
```

Note: Apple's HFS+ file system handles accented characters in filenames weirdly.
At 42, it should work on `/sgoinfre/goinfre/Perso/xlogin/`.

## License

    asn-website - Association Sans Nom website
    Copyright (C) 2018 Association Sans Nom and contributors
    
    This file is part of asn-website.
    
    asn-website is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.
    
    asn-website is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU Affero Public License
    along with asn-website.  If not, see <https://www.gnu.org/licenses/>.

### Cadman font

Copyright (c) 2018, Paul Miller.

This Font Software is licensed under the SIL Open Font License, Version 1.1.
This license is available with a FAQ at: http://scripts.sil.org/OFL

### Graduate font

Copyright (c) 2012 by Eduardo Tunni (http://www.tipo.net.ar), with Reserved Font
Name “Graduate”

This Font Software is licensed under the SIL Open Font License, Version 1.1.
This license is available with a FAQ at: http://scripts.sil.org/OFL

### Inconsolata font

Copyright (c) 2006 (regular style) and 2012 (bold style) by The Inconsolata
Project Authors.

Regular style, Raphael Linus Levien.
Bold style by Kirill Tkachev and the Cyreal foundry.

This Font Software is licensed under the SIL Open Font License, Version 1.1.
This license is available with a FAQ at: http://scripts.sil.org/OFL

### Salsa font

Copyright (c) 2011 by John Vargas Beltrán (john.vargasbeltran@gmail.com),
with Reserved Font Name Salsa.

This Font Software is licensed under the SIL Open Font License, Version 1.1.
This license is available with a FAQ at: http://scripts.sil.org/OFL

### Special Elite font

Copyright (c) 2010 by Brian J. Bonislawsky and Astigmatic (astigmatic.com)

This Font Software is licensed under the Apache License, Version 2.0.
This license is available at http://www.apache.org/licenses/LICENSE-2.0

### Suez One font

Copyright (c) 2016 by Michal Sahar.

This Font Software is licensed under the SIL Open Font License, Version 1.1.
This license is available with a FAQ at: http://scripts.sil.org/OFL

### Normalize.css

[Normalize.css](http://necolas.github.io/normalize.css/) is released under the
[MIT license](https://github.com/necolas/normalize.css/blob/master/LICENSE.md)
by Nicolas Gallagher and Jonathan Neal.

### Copyleft icon

The copyleft icon is a modified version of [a Font Awesome Free
icon](https://fontawesome.com/icons/copyright?style=regular).
It is released under [Creative Commons BY 4.0
License](https://creativecommons.org/licenses/by/4.0/).
