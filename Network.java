import java.util.*;

public class Network {

	protected String ssid;
	protected String key_mgmt;

	public void ssidModifiy(final String ssid) {
		this.ssid = ssid;
	}
	public void key_mgmtModify(final String key_mgmt) {
		this.key_mgmt = key_mgmt;
	}

	public String ssidRetrieval() {
		return ssid;
	}
	public String key_mgmtRetrieval() {
		return key_mgmt;
	}
}	
