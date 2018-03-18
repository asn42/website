#! /usr/bin/env bash

cd "${0%/*}/statuts"

source_dir="$(pwd)"
source_file="$source_dir/statuts.md"
target_dir="$(pwd)/../../content/statuts"
target_file="$target_dir/index.md"

lastchange="$(git log -1 --format="%aI" -- "$source_file")"

mkdir -p "$target_dir"

cat << EOF > "$target_file"
+++
title = "Statuts - Association Sans Nom - Libre et sécurité à 42"
description = "Statuts de l'ASN, l'association étudiante de 42 pour tout ce qui touche au Libre et à la sécurité !"
date = $lastchange

template = "page.html"
render = true

[extra]
+++

EOF

cat "$source_file" >> "$target_file"
