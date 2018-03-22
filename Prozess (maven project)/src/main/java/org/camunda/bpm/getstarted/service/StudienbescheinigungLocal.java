package org.camunda.bpm.getstarted.service;

import java.io.BufferedReader;
import java.io.File;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.Reader;
import java.net.URL;
import java.net.URLConnection;
import java.nio.file.Paths;

import org.camunda.bpm.engine.ProcessEngine;
import org.camunda.bpm.engine.ProcessEngines;
import org.camunda.bpm.engine.RuntimeService;
import org.camunda.bpm.engine.delegate.DelegateExecution;
import org.camunda.bpm.engine.delegate.ExecutionListener;
import org.camunda.bpm.engine.delegate.JavaDelegate;
import org.camunda.bpm.engine.impl.util.json.JSONObject;
import org.camunda.bpm.engine.variable.Variables;
import org.camunda.bpm.engine.variable.value.FileValue;

public class StudienbescheinigungLocal implements JavaDelegate {

	public void execute(DelegateExecution execution)  throws Exception {
			ProcessEngine processEngine = ProcessEngines.getDefaultProcessEngine();
			RuntimeService runtimeService = processEngine.getRuntimeService();

			//Abfrage URL für die GET/POST Methode für den simulierten REST-Service mockable.io
			
			String requestURL ="http://demo8791358.mockable.io";
			//String requestURL = "http://demo6417647.mockable.io";
			
			//Auswerten des JSON Objekts und speichern des Inhalts
			String result;
			String path = null;
			
			result = getStringFromUrl(requestURL);
			JSONObject jsonObject= new JSONObject(result); 
			path = jsonObject.getString("path");		
			runtimeService.setVariable(execution.getId(), "filepath", path);
			System.out.println(path);
			}
	
	//POST/GET Methode zum Aufrufen des REST-Services 
	private String getStringFromUrl(String urlToReadFrom) throws Exception {
        
        URL url = new URL(urlToReadFrom);
        
        URLConnection con = url.openConnection();
        final Reader reader = new InputStreamReader(con.getInputStream());
        final BufferedReader br = new BufferedReader(reader);        
        String line = "";
        StringBuilder sb = new StringBuilder();
        while ((line = br.readLine()) != null) {

        	sb.append(line);
        }        
        br.close();
        return sb.toString();
	}

}
