#!/usr/bin/env bash

# !!! This is now obsolete. Using github now. !!!
# Deployment is basically commit-push-pull

# Rules
# (1) Production code should not be altered in place
# (2) Always backup `webdir` before pulls
# (3) Enjoy git

TARGET=/Volumes/jobp--wwwdup.uni-leipzig.de/webdir

rm -rf $TARGET/*

SHA=$(cat .git/refs/heads/master)
git archive --format=zip master > $TARGET/$SHA.zip

