sudo systemctl start wpa_supplicant@wlan1
sudo dhcpcd wlan1

sleep 3


sudo /scripts/3rd/create_ap/create_ap wlan0 wlan1 akknetwork &
