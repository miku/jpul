#!/usr/bin/env bash

curl -s http://www.uni-leipzig.de/~jobp/job/idlist.json | tr "," "\n" | \
    sed -e "s/]//" | sed -e "s/\[//" | \
    xargs -I {} curl -s http://www.uni-leipzig.de/~jobp/job/{}.json

