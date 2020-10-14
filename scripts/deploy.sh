#!/bin/bash
set -e
ssh-keyscan -H $IP >>~/.ssh/known_hosts

# Copy files to the server
rsync -aO --chown=www-data:www-data --fake-super --exclude='.git' --exclude='.env' --del ./ $USER_NAME@$IP:$DEPLOY_PATH

# Install dependencies
ssh -t $USER_NAME@$IP "cd $DEPLOY_PATH && composer install --no-progress --no-interaction --optimize-autoloader --no-dev"
ssh -t $USER_NAME@$IP "cd $DEPLOY_PATH && npm install"

# Prep for production
ssh -t $USER_NAME@$IP "cd $DEPLOY_PATH && npm run production"
ssh -t $USER_NAME@$IP "cd $DEPLOY_PATH && php artisan config:clear"
ssh -t $USER_NAME@$IP "cd $DEPLOY_PATH && php artisan key:generate"
ssh -t $USER_NAME@$IP "cd $DEPLOY_PATH && ln -s $DEPLOY_PATH/storage/app/public $DEPLOY_PATH/public/storage"
ssh -t $USER_NAME@$IP "cd $DEPLOY_PATH && php artisan config:cache"
ssh -t $USER_NAME@$IP "cd $DEPLOY_PATH && php artisan route:cache"
