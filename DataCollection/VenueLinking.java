// Author: The Coworking Sociatea (Sami Peachey)
// July 12, 2014
// Finds the closest venues for each wifi hotspot


import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.InputStream;
import java.io.IOException;

import java.lang.Math;

import java.nio.file.Files;
import java.nio.file.Paths;

import java.util.ArrayList;
import java.util.Iterator;

import org.codehaus.jackson.JsonNode;
import org.codehaus.jackson.map.ObjectMapper;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;

public class VenueLinking {
	
	public static Double getDistance(Double lat1, Double lon1, Double lat2, Double lon2) {
		Double R = 6371.0; // Radius of the earth in km
		Double dLat = deg2rad(lat2-lat1);  // deg2rad below
		Double dLon = deg2rad(lon2-lon1);
		Double a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.sin(dLon/2) * Math.sin(dLon/2);
		Double c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
		Double d = R * c; // Distance in km
		return d;
	}
	
	public static Double deg2rad(Double deg) {
		return deg * (Math.PI/180);
	}
	
	
	public static ArrayList<String> findClosest(Place place, String current) {
		
		//get lat long from place
		//read each line in current file
		//compare
		
		ArrayList<Double> nndis = new ArrayList<Double>();
		ArrayList<String> places = new ArrayList<String>();
		
		for (int i = 0; i < 5; i++) {
			nndis.add(Double.MAX_VALUE);
			places.add("");
		}
		
		
		JSONParser parser = new JSONParser();
		
		try {
			
			Object obj = parser.parse(new FileReader(current));
			
			JSONArray jsonObject = (JSONArray) obj;
			
			// loop array
			Iterator<JSONObject> iterator = jsonObject.iterator();
			while (iterator.hasNext()) {
				JSONObject ob = iterator.next();
				String address = (String) ob.get("address");
				if (current.equals("../data/libraries.json")) {
					System.out.println("address " + address);
				}
				String stringLat = (String) ob.get("latitude");
				String stringLon = (String) ob.get("longitude");
				Double lat = Double.parseDouble(stringLat);
				Double lon = Double.parseDouble(stringLon);
				
				
				Double distance = getDistance(place.getLat(), place.getLon(), lat, lon);
				
				for (int i = 0; i < nndis.size(); i++) {
					if (distance < nndis.get(i)) {
						for (int j = nndis.size()-1; j < i; j--) {
							nndis.set(j+1, nndis.get(j));
							places.set(j+1, places.get(j));
						}
						nndis.set(i, distance);
						places.set(i, address);
						break;
					}
				}
				
			}
			
			
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		return places;
	}
	
	public static void main(String[] args) {
		
		try {
			//open wifi points file
			FileReader wificsv = new FileReader("../data/wifi.csv");
			//open restaurants
			String restaurants = "../data/restaurant.json";
			String cafes = "../data/cafe.json";
			String pubs = "../data/pub.json";
			String libraries = "../data/libraries.json";
			
			//create output file
			FileWriter venues = new FileWriter("../data/venues.json");
			venues.write("[");
			
			//for each wifi point in file
			
			BufferedReader br = new BufferedReader(wificsv);
			
			String input = br.readLine();
			String[] headers = input.split(",");
			
			while ((input = br.readLine()) != null) {
				
				String[] info = input.split(",");
				
				if (info.length >= 3) {
					String id = info[0];
					double lat = Double.parseDouble(info[1]);
					double lon = Double.parseDouble(info[2]);
					
					Place p = new Place(id, lat, lon);
					
					ArrayList<String> restNeigh = findClosest(p, restaurants);
					ArrayList<String> cafeNeigh = findClosest(p, cafes);
					ArrayList<String> pubNeigh = findClosest(p, pubs);
					ArrayList<String> libNeigh = findClosest(p, libraries);
					
					JSONObject obj = new JSONObject();
					
					//collect nearest restaurants
					JSONObject o = new JSONObject();
					
					for (int i = 0; i < restNeigh.size(); i++) {
						o.put(i, restNeigh.get(i));
					}
					
					obj.put("restaurants", o);
					
					//collect nearest cafes
					o = new JSONObject();
					
					for (int i = 0; i < cafeNeigh.size(); i++) {
						o.put(i, cafeNeigh.get(i));
					}
					
					obj.put("cafes", o);
					
					//collect nearest pubs
					o = new JSONObject();
					
					for (int i = 0; i < pubNeigh.size(); i++) {
						o.put(i, pubNeigh.get(i));
					}
					
					obj.put("pubs", o);
					
					//collect nearest libraries
					o = new JSONObject();
					
					for (int i = 0; i < libNeigh.size(); i++) {
						o.put(i, libNeigh.get(i));
					}
					
					obj.put("libraries", o);
					
					obj.put("id", id);
					
					venues.write(obj.toJSONString());
					venues.write(",\n");
				}
			}
			
			venues.flush();
			
			venues.write("]");
			venues.close();
			
			
		} catch (IOException io) {
			io.printStackTrace();
		}
		
	}
	
	public static class Place {
		
		private String id;
		private double lat;
		private double lon;
		
		public Place(String id, double lat, double lon) {
			this.id = id;
			this.lat = lat;
			this.lon = lon;
		}
		
		public double getLat() {
			return lat;
		}
		
		public double getLon() {
			return lon;
		}
		
		public String getId() {
			return id;
		}
	}
	
}