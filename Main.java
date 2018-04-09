import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.*;

public class Main {
	public static void main(String[] args) throws SQLException, ClassNotFoundException {
		DoWork dw = new DoWork();
		if (args.length<1) {
			System.out.println("No additional arguments");
		}
		else if (args.length >= 3) {
			String connectionAction = args[0];
			String connectionType = args[1];
			String ssid = args[2];
			System.out.println(connectionAction + " " + connectionType + " " + ssid);

			if (connectionAction.equals("new")) {
				switch (connectionType) {
					case "none":
						dw.unsecuredConnectionNew(ssid);
						break;
					case "wpa-psk":
						String psk = args[3];
						dw.wpa_pskNew(ssid, psk);
						break;
					case "mschapv2":
						String eap = args[3];
						String identity = args[4];
						String password = args[5];
						String phase1 = args[6];
						String phase2 = args[7];

						dw.mschapv2New(ssid, eap, identity, password, phase1, phase2);
						break;	
					default:
						break;
				}		
			}
			else if (connectionAction.equals("edit")) {
				switch (connectionType) {
					case "none":
						String ssidNew = args[3];
						dw.unsecuredConnectionEdit(ssid, ssidNew);
						break;
					case "wpa-psk":
						ssidNew = args[3];
						String pskNew = args[4];
						dw.wpa_pskEdit(ssid, ssidNew, pskNew);
						break;
					case "mschapv2":
						String eap = args[4];
						String identity = args[6];
						String password = args[8];
						String phase1 = args[10];
						String phase2 = args[12];
						String ssidNew = args[3];
						String eapNew = args[5];
						String identityNew = args[7];
						String passwordNew = args[9];
						String phase1New = args[11];
						String phase2New = args[13];

						dw.mschapv2Edit(ssid, ssidNew, eap, eapNew, identity, identityNew, password, passwordNew, phase1, phase1New, phase2, phase2New);
						break;	
					default:
						break;
				}		
			}	
			else if (connectionAction.equals("delete")) {
				dw.deleteNetwork(ssid, connectionType);
			}	
		}
		else {
			System.out.println("Additional arguments provided");	
		}	

		FormatOutput fo = new FormatOutput();
		fo.outputiAllToFile();
	}
}	
