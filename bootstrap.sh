#!/usr/bin/env bash

chmod -Rv 777 assets/
chmod -Rv 777 uploads/

chmod -Rv 777 protected/controllers/
chmod -Rv 777 protected/data/
chmod -Rv 777 protected/models/
chmod -Rv 777 protected/runtime/
chmod -Rv 777 protected/views/

mkdir protected/runtime/search
touch protected/runtime/application.log
touch protected/runtime/state.bin

chmod 777 protected/runtime/search
chmod 777 protected/runtime/application.log
chmod 777 protected/runtime/state.bin

ln -s index.prod.php index.php
