# imma-prozess
Beispielprozess zur elektronischen Immatrikulation mit Hilfe der BPMN-Process-Engine Camunda

![Sample process](Abbildungen/ImmaProcessV2.png)

## Lokale Installation / Konfiguration

Damit Sie den dargestellen "Prozess 1.0" auf ihrem System ausführen können, müssen Sie die folgenden Schritte umsetzen:

1. Laden Sie sich einen [Camunda Tomcat Server](https://camunda.com/download/) (7.6+) auf ihr System und entpacken Sie diesen. Zusätzlich benötigen sie eine aktuellen Version des [Java SE Development Kit's](http://www.oracle.com/technetwork/java/javase/downloads/index.html).
	* Hinweis für Windows-Systeme: Damit der entpackte Tomcat Server starten kann, müssen Sie zwei [Umgebungsvariablen](http://techmixx.de/windows-10-umgebungsvariablen-bearbeiten/) zum installierten JDK definieren. Der Name der ersten Variable sollte "JAVA_HOME" und der Pfad sollte auf Ihren lokalen Speicherort verweisen, z.B. "C:\Programm Files\Java\jdk1.8.0_91".. Der Name der zweiten Variable sollte "JRE_Home" und der Pfad sollte auf Ihren lokalen Speicherort verweisen, z.B. "C:\Programm Files\Java\jre1.8.0_151".
2. Kopieren Sie aus dem Ordner "Mail Connector" die Datei "camunda-bpm-mail-core-1.3.0-SNAPSHOT.jar" in das untergeordnete lib-Verzeichnis des Tomcat (Verzeichnis: [Camunda Tomcat]\server\apache-tomcat-8.0.24\lib).
3. Danach kopieren Sie aus dem gleichen Ordner "Mail Connector" die Datei "mail-config.properties" in das untergeordnete conf-Verzeichnis des Tomcat (Verzeichnis: [Camunda Tomcat]\server\apache-tomcat-8.0.24\conf). Diese Datei ist für den Zugriff auf ein Mail-Konto notwendig.
	* Hinweis: Sollten Sie ihr privates E-Mail Konto benutzen, achten Sie darauf, die Datei nicht mit Dritten zu teilen.
	* Hinweis für Windows-Systeme: Damit der Tomcat die .properties Datei finden kann, müssen Sie die [Umgebungsvariable](http://techmixx.de/windows-10-umgebungsvariablen-bearbeiten/) für die Datei definieren. Der Name der Variable sollte "MAIL_CONFIG" lauten und der Pfad sollte lauten "[Camunda Tomcat]\server\apache-tomcat-8.0.24\conf\mail-config.properties".
	* Siehe auch: [E-Mail Connector](https://github.com/camunda/camunda-bpm-mail) und [E-Mail Connector Beispiel](https://github.com/camunda/camunda-bpm-mail/tree/master/examples/pizza).
4. Anschließend installieren Sie einen lokalen Webserver welcher cURL unterstützt (z.B. [XAMPP](https://www.apachefriends.org/de/download.html) ). Nachdem sie diesen installiert haben, kopieren Sie aus dem Ordner "Externe Webseiten Formulare" alle .php Formulare in den "htdocs" Ordner ihres Webservers.
	* Hinweis: Achten Sie darauf, über welche URL der Webserver angesprochen wird. Sollt diese nicht "http://127.0.0.1/" lauten, muss die URL des Webservers oder die E-Mail-Beschreibung der Sende-Aufgaben und -Ereignisse im Prozess angepasst werden.
5. Kopieren aus dem Ordner "Prozess (.war)" die Datei "imma-0.1.0-SNAPSHOT.war" in das untergeordnete Verzeichnis "webapps" (Verzeichnis: [Camudna Tomcat]\server\apache-tomcat-8.0.24\webapps).

## Prozess bearbeiten

Text in Arbeit

## Konfiguration des Prozesses

Text in Arbeit

1. E-Mail
2. Ereignisse
3. etc.

## Rest-API ansteuern

Text in Arbeit

