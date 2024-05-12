#!/bin/bash

# Stop all sass processes if any running and then start a new one
ps cax | grep sass
if [ $? -eq 0 ]; then
  killall sass
fi

sass --watch --trace --no-cache ./dev/new-web/assets/scss/styles.scss:./dev/new-web/assets/css/styles.css