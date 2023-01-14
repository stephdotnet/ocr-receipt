#!/bin/sh

CODESPACE_NAME=${CODESPACE_NAME:-$1}

CODESPACE_URL="https://$CODESPACE_NAME-80.preview.app.github.dev"
sed -i "s~APP_URL=.*~APP_URL=$CODESPACE_URL~g; s~APP_ENV=.*~APP_ENV=codespace~g" .env
