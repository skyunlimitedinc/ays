#!/bin/bash
set -e
ssh-keyscan -H $IP >>~/.ssh/known_hosts

# Copy files to the server
set -x
if [ $TRAVIS_BRANCH == 'master' ] ; then
    # Initialize a new git repo and push it to our server.
    # git init
        
    git remote add deploy "$USER_NAME@$IP:$DEPLOY_PATH"
    git config user.name "Travis CI"
    git config user.email "itdept@skyunlimitedinc.com"
    git checkout master
    git add skyunlimitedinc/ays/.
    git commit -m "Deploy"
    git push --force deploy master
else
    echo "Not deploying, since this branch isn't master."
fi
