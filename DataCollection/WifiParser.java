// Author: The Coworking Sociatea (Sami Peachey)
// July 13, 2014
// Converts the data found here: http://data.sa.gov.au/dataset/adelaidefree-wi-fi-access-point-locations
// Into a JSON file for reading into The Coworking Sociatea app

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.InputStream;
import java.io.IOException;

import java.util.ArrayList;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;

public class WifiParser {
	
	
	public void parse(FileReader file) {
		
		
		//for each line in the file
		//split on ;
		//put into appropriate field in json
		
		try {
			BufferedReader br = new BufferedReader(file);
			
			String input;
			
			input = br.readLine();
			String[] headers = input.split(",");
			
			for (int i = 0; i < headers.length; i++) {
				if (headers[i].equals("Longitude")) {
					headers[i] = "longitude";
				}
				if (headers[i].equals("Latitude")) {
					headers[i] = "latitude";
				}
			}
			
			ArrayList<JSONObject> objects = new ArrayList<JSONObject>();
			
			while((input=br.readLine())!=null){
				
				String[] info = input.split(",");
				
				if (headers.length == info.length) {
					
					JSONObject obj = new JSONObject();
					
					for (int i = 0; i < headers.length; i++) {
						obj.put(headers[i], info[i]);
					}
					
					objects.add(obj);
				}
				
			}
			
			FileWriter outputfile = new FileWriter("../data/wifi.json");
			
			outputfile.write("[");
			
			//Write all objects out to a file
			for (JSONObject obj : objects) {
				outputfile.write(obj.toJSONString());
				outputfile.write(",\n");
			}
			outputfile.flush();
			
			outputfile.write("]");
			
			outputfile.close();
			
		} catch(IOException io) {
			io.printStackTrace();
		}

	}
	
	
	public static void main(String[] args) {
		
		try {
			
			//open file
			FileReader file = new FileReader("../data/wifi.csv");
			
			WifiParser parser = new WifiParser();
			parser.parse(file);
		} catch (IOException io) {
			io.printStackTrace();
		}
		
	}
}