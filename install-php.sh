#!/bin/bash

# Update package lists
sudo apt-get update

# Install software-properties-common if not installed
sudo apt-get install -y software-properties-common

# Add ondrej/php which has PHP 8.2
sudo add-apt-repository -y ppa:ondrej/php

# Update package lists
sudo apt-get update

# Install PHP 8.2
# Also install the extensions: GD, XML, and ZIP
sudo apt-get install -y php8.2 php8.2-gd php8.2-xml php8.2-zip php8.2-mysql

# Verify the installation
php -v