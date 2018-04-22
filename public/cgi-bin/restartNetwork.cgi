#!/bin/bash
sudo killall dhcpcd
sudo systemctl stop wpa_supplicant@wlan1
sudo killall dnsmasq
sudo killall hostapd

sudo sleep 5

sudo internetswitch.sh
