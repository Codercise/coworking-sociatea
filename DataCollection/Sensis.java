import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

import java.io.FileWriter;
import java.io.InputStream;
import java.io.IOException;

import java.util.ArrayList;
import java.util.List;
import java.util.LinkedList;

import org.codehaus.jackson.JsonNode;
import org.codehaus.jackson.map.ObjectMapper;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;

public class Sensis {
	
	private static final String API_KEY = "cy7u22fmahsqpsj2fuupc8un";
	
	private void search(String query, String location) throws Exception {
    
		// construct url for the search endpoint
		URL searchUrl = new URL("http://api.sensis.com.au/ob-20110511/test/search?key=" + API_KEY
														+ "&query="
														+ URLEncoder.encode(query, "UTF-8")
														+ "&location="
														+ URLEncoder.encode(location, "UTF-8"));
		
		// open connection to the server
		HttpURLConnection conn = (HttpURLConnection)searchUrl.openConnection();
		conn.connect();
		
		try {
			
			// ensure HTTP 200 (OK) response
			if (conn.getResponseCode() != HttpURLConnection.HTTP_OK) {
				throw new RuntimeException(
																	 "Error calling Search API (HTTP status "
																	 + conn.getResponseCode() + ")");
			}
			
			// grab the response stream
			InputStream stream = conn.getInputStream();
			
			// parse JSON response
			ObjectMapper mapper = new ObjectMapper();
			JsonNode root = mapper.readValue(stream, JsonNode.class);
      
			// grab the reponse code and message
			int code = root.get("code").getIntValue();
			String message = root.get("message").getTextValue();
			
			// ensure successful status code
			switch (code) {
				case 200: // success
					break;
				case 206: // spell-checker was run
					System.out.println("Note: " + message);
					break;
				default:
					throw new RuntimeException(
																		 "API returned error: " + message + ", code: " + code);
			}
			
			System.out.println("Total results found: " +
												 root.get("totalResults").getIntValue());
			
			ArrayList<JSONObject> objects = new ArrayList<JSONObject>();
			
			
			
			
			// iterate over the results
			for (JsonNode result : root.get("results")) {
				
				JSONObject obj = new JSONObject();
				obj.put("name", result.path("name").getTextValue());
				obj.put("address", result.path("primaryAddress").path("addressLine").getTextValue());
				obj.put("latitude", result.path("primaryAddress").path("latitude").getTextValue());
				obj.put("longitude", result.path("primaryAddress").path("longitude").getTextValue());
				
				objects.add(obj);
			}
			
			
			FileWriter file = new FileWriter("cafe.json");
			for (JSONObject obj : objects) {
				file.write(obj.toJSONString());
			}
			file.flush();
			file.close();
			
			stream.close();
			
		} catch (IOException e) {
			e.printStackTrace();
		} finally {
			conn.disconnect(); // ensure we always close the connection
		}
    
	}
	
	public static void main(String[] args) throws Exception {
		new Sensis().search("cafe", "adelaide, sa");
		
	}
	
}