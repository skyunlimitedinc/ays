#!/bin/bash
set -e
ssh-keyscan -H $IP >>~/.ssh/known_hosts

# Copy files to the server
rsync -rlptOog --chown=www-data:www-data --fake-super --exclude '.git' ./ $USER_NAME@$IP:$DEPLOY_PATH
