// Author: The Coworking Sociatea (Sami Peachey)
// July 12, 2014
// Converts the data found here: http://data.sa.gov.au/dataset/library-locations
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

public class LibParser {
	
	
	public void parse(FileReader file) {
		
		
		//for each line in the file
		//split on ;
		//put into appropriate field in json
		
		try {
			BufferedReader br = new BufferedReader(file);
			
			String input;
			
			input = br.readLine();
			String[] headers = input.split(";");
			
			ArrayList<JSONObject> objects = new ArrayList<JSONObject>();
			
			while((input=br.readLine())!=null){
				
				String[] info = input.split(";");
				
				if (headers.length == info.length) {
					
					JSONObject obj = new JSONObject();
					
					for (int i = 0; i < headers.length; i++) {
						obj.put(headers[i], info[i]);
					}
					
					objects.add(obj);
				}
				
			}
			
			FileWriter outputfile = new FileWriter("../data/libraries.json");
			
			//Write all objects out to a file
			for (JSONObject obj : objects) {
				outputfile.write(obj.toJSONString());
			}
			outputfile.flush();
			
			outputfile.close();
			
		} catch(IOException io) {
			io.printStackTrace();
		}
		
		
	}
	
	
	public static void main(String[] args) {
		
		try {
			
			//open file
			FileReader file = new FileReader("../data/libraries.txt");
			
			LibParser parser = new LibParser();
			parser.parse(file);
		} catch (IOException io) {
			io.printStackTrace();
		}
		
	}
	
}