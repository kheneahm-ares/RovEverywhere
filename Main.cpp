#include<iostream>
#include<fstream>
#include<vector>
#include<string>
#include"ReadFile.h"

using namespace std;

int main(int argc, char* argv[])
{
	ReadFile rf;
	string knownAP{argv[1]}, availableAP{argv[2]};

	rf.configureFilename(knownAP);
	rf.accessKnownNetworks();

	rf.configureFilename(availableAP);
	rf.accessAvailableNetworks();
	rf.determineConnection();
	//string file{argv[1]};

	//cout << file << endl;


	return 0;
}	
