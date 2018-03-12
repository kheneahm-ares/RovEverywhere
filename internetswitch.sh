#!/bin/bash

function createconfigdirectory () {
	if [ -d $configdirectory ]; then
		echo "Config directory exists"
	else
		mkdir $configdirectory
	fi	
	
}	
function knownnetworks () {
	sudo iw $internetinterface scan > $wifi
	cat $wifi | grep "SSID:" > $ssid
	sed -z -i 's/\tSSID: //g' $ssid
	#cat $ssid
}	
function availablenetworks () {
	sudo cat $wpa_sup > $savednetworks
	cat $savednetworks | grep "ssid" > $knownnetworks
	sed -z -i 's/\#//g' $knownnetworks
	sed -z -i 's/"//g' $knownnetworks
	sed -z -i 's/\tssid=//g' $knownnetworks	
	#cat $knownnetworks
}	

internetinterface="wlan1"

configdirectory="/scripts/.config"
wifi="/scripts/.config/wifi"
ssid="/scripts/.config/ssid"

wpa_sup="/etc/wpa_supplicant/wpa_supplicant.conf"
savednetworks="/scripts/.config/savednetowrks"
knownnetworks="/scripts/.config/knownnetworks"


createconfigdirectory
knownnetworks
echo -e "\n"
availablenetworks

#echo "Here"
echo $knownnetworks
echo $ssid
DetermineConnection $knownnetworks $ssid 
