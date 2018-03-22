package org.camunda.bpm.getstarted.service;

import org.camunda.bpm.application.ProcessApplication;
import org.camunda.bpm.application.impl.ServletProcessApplication;

@ProcessApplication("Beta_Process")

public class ImmaApplication extends ServletProcessApplication {
	//Kein Code weil keine regelmäßigen Ausführungen notwendig ist
}