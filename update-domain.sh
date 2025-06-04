#!/bin/bash

# Script to update domain in WordPress database and Apache configuration
# Usage: ./update-domain.sh old_domain new_domain

if [ "$#" -ne 2 ]; then
    echo "Usage: $0 old_domain new_domain"
    echo "Example: $0 propertydisplayed.co.uk propertydisplayed.co.uk"
    exit 1
fi

OLD_DOMAIN=$1
NEW_DOMAIN=$2

echo "Updating domain from $OLD_DOMAIN to $NEW_DOMAIN..."

# Update WordPress database URLs
echo "1. Updating WordPress database URLs..."
docker exec propdisp_mysql mysql -u root -prootpassword db740303479 -e "
UPDATE WOViPwUhoptions SET option_value = replace(option_value, 'https://${OLD_DOMAIN}', 'http://${NEW_DOMAIN}') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE WOViPwUhposts SET guid = replace(guid, 'https://${OLD_DOMAIN}', 'http://${NEW_DOMAIN}');
UPDATE WOViPwUhposts SET post_content = replace(post_content, 'https://${OLD_DOMAIN}', 'https://${NEW_DOMAIN}');
UPDATE WOViPwUhpostmeta SET meta_value = replace(meta_value, 'https://${OLD_DOMAIN}', 'https://${NEW_DOMAIN}');

UPDATE WOViPwUhoptions SET option_value = replace(option_value, 'http://${OLD_DOMAIN}', 'http://${NEW_DOMAIN}') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE WOViPwUhposts SET guid = replace(guid, 'http://${OLD_DOMAIN}', 'http://${NEW_DOMAIN}');
UPDATE WOViPwUhposts SET post_content = replace(post_content, 'http://${OLD_DOMAIN}', 'http://${NEW_DOMAIN}');
UPDATE WOViPwUhpostmeta SET meta_value = replace(meta_value, 'http://${OLD_DOMAIN}', 'http://${NEW_DOMAIN}');
"

# Update Apache ServerName in configuration files
echo "2. Updating Apache ServerName in configuration files..."
docker exec propdisp_wordpress bash -c "sed -i 's/ServerName ${OLD_DOMAIN}/ServerName ${NEW_DOMAIN}/g' /etc/apache2/sites-available/000-default.conf"

# Check if ServerName exists in SSL config, if not add it with proper spacing
docker exec propdisp_wordpress bash -c "grep -q 'ServerName' /etc/apache2/sites-available/default-ssl.conf || sed -i '/ServerAdmin/a\\\\tServerName ${NEW_DOMAIN}' /etc/apache2/sites-available/default-ssl.conf"

# Update existing ServerName if it exists
docker exec propdisp_wordpress bash -c "sed -i 's/ServerName ${OLD_DOMAIN}/ServerName ${NEW_DOMAIN}/g' /etc/apache2/sites-available/default-ssl.conf"

# Restart Apache to apply changes
echo "3. Restarting Apache to apply changes..."
docker exec propdisp_wordpress service apache2 reload

echo "Domain successfully updated to ${NEW_DOMAIN}!"
