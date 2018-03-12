function knownnetworks 
{
	sudo iw $internetinterface scan > $wifi
	cat $wifi | grep "SSID:" > $ssid
	sed -z -i 's/\tSSID: //g' $ssid
	#cat $ssid
}	
function availablenetworks
{
	cat $wpa_sup > $savednetworks
	cat $savednetworks | grep "ssid" > $knownnetworks
	sed -z -i 's/\#//g' $knownnetworks
	sed -z -i 's/"//g' $knownnetworks
	sed -z -i 's/\tssid=//g' $knownnetworks	
	#cat $knownnetworks
}	

internetinterface="wlan1"

wifi="/tmp/wifi"
ssid="/tmp/ssid"

wpa_sup="/etc/wpa_supplicant/wpa_supplicant.conf"
savednetworks="/tmp/savednetowrks"
knownnetworks="/tmp/knownnetworks"


knownnetworks
echo -e "\n"
availablenetworks

DetermineConnection $ssid $knownnetworks
