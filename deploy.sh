#!/usr/bin/env bash

TARGET=/Volumes/jobp--wwwdup.uni-leipzig.de/webdir

SHA=$(cat .git/refs/heads/master)

git archive --format=zip master > $TARGET/$SHA.zip

