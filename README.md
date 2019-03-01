# Association Sans Nom website
A static website for Association Sans Nom, the 42 student association
for all Free- and security-related stuff !

![ASN logo](static/images/logo.svg)

## Requirement

* Get the latest version of zola static site generator [from the official
website](https://www.getzola.org/documentation/getting-started/installation/).

## Build the static site

### Get the submodules

``` sh
git submodule update --init
```

### Update the submodules (optional)

``` sh
git submodule update --remote
```

### Add the frontmatter to statuts.md

```
remote-sources/statuts-update.sh
```

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

### Roboto font

Roboto font, designed by Christian Robertson, is released under [Apache 2.0
license](http://www.apache.org/licenses/LICENSE-2.0) by Google.

### Normalize.css

[Normalize.css](http://necolas.github.io/normalize.css/) is released under the
[MIT license](https://github.com/necolas/normalize.css/blob/master/LICENSE.md)
by Nicolas Gallagher and Jonathan Neal.

### Copyleft icon

The copyleft icon is a modified version of [a Font Awesome Free
icon](https://fontawesome.com/icons/copyright?style=regular).
It is released under [Creative Commons BY 4.0
License](https://creativecommons.org/licenses/by/4.0/).
