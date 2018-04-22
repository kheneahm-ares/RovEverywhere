#!/bin/bash
killall dhcpcd
systemctl stop wpa_supplicant@wlan1

sleep 5

internetSwitch.sh
