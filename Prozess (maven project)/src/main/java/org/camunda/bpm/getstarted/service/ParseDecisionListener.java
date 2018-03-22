package org.camunda.bpm.getstarted.service;

import java.io.File;
import java.io.InputStream;
import java.util.HashMap;

import org.camunda.bpm.application.PostDeploy;
import org.camunda.bpm.engine.ProcessEngine;
import org.camunda.bpm.engine.ProcessEngines;
import org.camunda.bpm.engine.RuntimeService;
import org.camunda.bpm.engine.delegate.DelegateExecution;
import org.camunda.bpm.engine.delegate.ExecutionListener;
import org.camunda.bpm.engine.variable.Variables;
import org.camunda.bpm.engine.variable.value.FileValue;


public class ParseDecisionListener implements ExecutionListener {

	@Override
	public void notify(DelegateExecution execution) throws Exception {
		//Ausgabe Dokumente bestimmen (Output DMN Tabelle)
		HashMap<String, String> dokumente = (HashMap<String, String>)execution.getVariable("dokumente");
		
		//Outputfelder als Variable an ExecutionListener übergeben (DMN Tabelle)
		execution.setVariable("zeugnis", dokumente.get("zeugnis"));
		execution.setVariable("personalausweis", dokumente.get("personalausweis"));
		execution.setVariable("studienberechtigung", dokumente.get("studienberechtigung"));
		execution.setVariable("passbild", dokumente.get("passbild"));
		execution.setVariable("krankenversicherung", dokumente.get("krankenversicherung"));
		execution.setVariable("leistungserkennungsantrag", dokumente.get("leistungserkennungsantrag"));
		execution.setVariable("krankenversicherung", dokumente.get("krankenversicherung"));
		execution.setVariable("sprachzeugnis", dokumente.get("sprachzeugnis"));
		execution.setVariable("nachweis_b", dokumente.get("nachweis_b"));
		execution.setVariable("formUpload", dokumente.get("formUpload"));
		execution.setVariable("formDownload", dokumente.get("formDownload"));
		
		//Process Variablen an ExecutionListener übergeben 
		//Notwendig für den Richtign cURL Befehl
		execution.setVariable("instanceID", execution.getProcessInstanceId());
		execution.setVariable("taskID", execution.getCurrentActivityId());
		
		//Mail Configuration
//		MailConfiguration configuration;
//
//		configuration = MailConfigurationFactory.getConfiguration();

	}
}
