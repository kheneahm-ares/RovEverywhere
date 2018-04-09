import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.PreparedStatement;
import java.util.*;

public class DoWork {

	private ArrayList<String> connectionAction = new ArrayList<String>();
	private ArrayList<String> typesOfConnections = new ArrayList<String>();
	private String connectionType;
	private String username = "mars";
	private String password = "roverrover";
	private String database = "netman";
	private String url = "jdbc:mysql://localhost/" + database;
	private Connection cn;

	public DoWork() {
		populateConnAction();
		populateTypeOfConn();
	}

	void populateConnAction() {
		connectionAction.add("new");
		connectionAction.add("edit");
		connectionAction.add("delete");
	}	
	void populateTypeOfConn() {
		typesOfConnections.add("UNSECUREDCONNECTION");
		typesOfConnections.add("WPA_PSK");
		typesOfConnections.add("MSCHAPv2");
	}	
	public void initStuff() throws SQLException, ClassNotFoundException {
	}	
	public void unsecuredConnectionNew(final String ssid) throws SQLException {
		
		UnsecuredConnection uc = new UnsecuredConnection();
		uc.ssidModifiy(ssid);

		String query = "insert into " + typesOfConnections.get(0) + "(SSID, KEY_MGMT)" + " values(\"" + uc.ssidRetrieval() + "\", \"" + uc.key_mgmtRetrieval() + "\")";
		System.out.println(query);

		try {
			cn = DriverManager.getConnection(url, username, password);
			PreparedStatement ps = cn.prepareStatement(query);
			ps.execute();
			if (!cn.isClosed()) {
				cn.close();
			}		
		}
		catch (SQLException e) {
			System.err.println(e.getMessage());	
		}		
	}
	public void wpa_pskNew(final String ssid, final String psk) {
		WPA_PSK wpa = new WPA_PSK();
		wpa.ssidModifiy(ssid);
		wpa.pskModify(psk);

		String query = "insert into " + typesOfConnections.get(1) + " values(\"" + wpa.ssidRetrieval() + "\", \"" + wpa.pskRetrieval() + "\")";
		System.out.println(query);

		try {
			cn = DriverManager.getConnection(url, username, password);
			PreparedStatement ps = cn.prepareStatement(query);
			ps.execute();
			if (!cn.isClosed()) {
				cn.close();
			}		
		}
		catch (SQLException e) {
			e.printStackTrace();
		}	
	}
	public void mschapv2New(final String ssid, final String eap, final String identity, final String password, final String phase1, final String phase2) {
		MSCHAPv2 mv2 = new MSCHAPv2();
		mv2.ssidModifiy(ssid);
		mv2.eapModify(eap);
		mv2.identityModify(identity);
		mv2.passwordModify(password);
		mv2.phase1Modify(phase1);
		mv2.phase2Modify(phase2);

		String query = "insert into " + typesOfConnections.get(2) + " values(\"" + mv2.ssidRetrieval() + "\", \"" + mv2.key_mgmtRetrieval() + "\", \"" + mv2.eapRetrieval() +
			"\", \"" + mv2.identityRetrieval() + "\", \"" + mv2.passwordRetrieval() + "\", \"" + mv2.phase1Retrieval() + "\", \"" + mv2.phase2Retrieval() + "\")";
		System.out.println(query);

		try {
			cn = DriverManager.getConnection(url, username, password);
			PreparedStatement ps = cn.prepareStatement(query);
			ps.execute();
			if (!cn.isClosed()) {
				cn.close();
			}		
		}
		catch (SQLException e) {
			e.printStackTrace();
		}
	}
	public void UnsecuredConnectionEdit(final String ssid, final String ssidNew) {
		String query = "update UNSECUREDCONNECTION set SSID=\"" + ssidNew + "\"" + " where SSID=\"" + ssid + "\"";
		try {
			cn = DriverManager.getConnection(url, username, password);
			PreparedStatement ps = cn.prepareStatement(query);
			ps.execute();
			if (!cn.isClosed()) {
				cn.close();
			}	
		}
		catch (SQLException e) {
			e.printStackTrace();
		}
	}
	public void deleteNetwork(final String ssid, String type) {
		try {
			type = standardizeType(type);
			String query = "delete from " + type + " where SSID=\"" + ssid + "\"";

			cn = DriverManager.getConnection(url, username, password);
			PreparedStatement ps = cn.prepareStatement(query);
			ps.execute();
			if (!cn.isClosed()) {
				cn.close();
			}	
		}
		catch (SQLException e) {
			e.printStackTrace();
		}	
	}
	public String usernameRetrieval() {
		return username;
	}
	public String passwordRetrieval() {
		return password;
	}
	public String urlRetrieval() {
		return url;
	}	
	public String standardizeType(String type) {
		type = type.toUpperCase();

		if (type.equals("MSCHAPV2")) {
			type = "MSCHAPv2";
			return type;
		}	
		else if (type.equals("NONE")) {
			type = "UNSECUREDCONNECTION";
			return type;
		}

		return type;
	}	
}
