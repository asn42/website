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
title = "Statuts"
description = "Statuts de l'"
date = $lastchange

template = "page.html"
render = true

[extra]
+++

EOF

cat "$source_file" >> "$target_file"
