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
	private String username = "hm";
	private String password = "panther";
	private String database = "netman";
	private String url = "jdbc:mysql://108.255.70.130:3306/" + database;
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
		/**
		try {
			//loaded
			Class.forName("com.mysql.jdbc.Driver");

			//connected to network
			//cn = DriverManager.getConnection(url, username, password);

			ArrayList<UnsecuredConnection> uc = new ArrayList();

			System.out.println("Hello World");
		}	
		catch (SQLException e) {
			System.err.println(e.getMessage());
		}	
		*/
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
		}
		catch (SQLException e) {
			System.err.println(e.getMessage());	
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
}
