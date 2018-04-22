killall dhcpcd
systemctl stop wpa_supplicant@wlan1
killall dnsmasq
killall hostapd


sleep 5

internetswitch.sh
