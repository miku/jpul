#!/usr/bin/env bash

# On initial deployment, these are (hopefully) all
# path, where some special perms are necessary

chmod -Rv 777 assets/
chmod -Rv 777 uploads/

chmod -Rv 777 protected/controllers/
chmod -Rv 777 protected/data/
chmod -Rv 777 protected/models/
chmod -Rv 777 protected/runtime/
chmod -Rv 777 protected/views/

mkdir protected/runtime/cache
touch protected/runtime/application.log
touch protected/runtime/state.bin
chmod 777 protected/runtime/cache
chmod 777 protected/runtime/application.log
chmod 777 protected/runtime/state.bin

# Our indices ~
# 
# search => default frontend index
# adminsearch => includes all expired and archived offers as well
# apisearch => all public, expired or not
mkdir protected/runtime/search
mkdir protected/runtime/adminsearch
mkdir protected/runtime/apisearch
chmod 777 protected/runtime/search
chmod 777 protected/runtime/adminsearch
chmod 777 protected/runtime/apisearch

# Either symlink or copy
ln -s index.prod.php index.php
