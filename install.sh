function copyapscripts {
	cp launchap.sh /scripts/
	cp launchnointernetap.sh /scripts

	echo "Files copied"
}
function copyexecutable {
	sudo cp DetermineConnection /usr/bin
	sudo cp internetswitch.sh /usr/bin
}	
function createconfigdirectory {
	if [ -d /scripts/.config ]; then
		echo "Config directory created"
	else
		mkdir /scripts/.config
	fi
}	

echo "Compiling"
make
copyexecutable

if [ -d /scripts ]; then
	copyapscripts
else
	mkdir /scripts
	copyapscripts
fi	

createconfigdirectory

echo "Installed"
