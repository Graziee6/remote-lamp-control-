#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
int RELAY_PIN = 4;
int SENSOR_PIN = 12;
String status="OFF";

WiFiClient wifiClient;    
const char* host = "iot.benax.rw";

void setup() {
  pinMode(RELAY_PIN, OUTPUT);
  Serial.begin(9600);
    connectToWiFi("RCA-WiFii", "@rca@2023");  
}

void loop() { 
  String payload="";
    connectToHost(80);
    processResponse(); 
}

void processResponse(){
  HTTPClient http;
  String Link = "http://iot.benax.rw/projects/854b1fa5b3856cdadd4351ef6bb6c81a/Glowify/check_status.php";
  http.begin(wifiClient,Link);
  int httpCode = http.GET();
  String payload = http.getString();
  Serial.println("payloaddd "+payload);
  if(payload.indexOf("on")>=0){
    turnOn();
  }else{
    turnOff();
  }
  //Print request response payload
  http.end();
}


void checkBrightness(){
  int brightnessValue= analogRead(SENSOR_PIN);
  if (brightnessValue < 10) {
    Serial.println("OFF");
    status="OFF";
  } else if (brightnessValue>10) {
    Serial.println("ON");
    status="ON";
  } else {
    Serial.println("The sensor got us no value");
  }
  Serial.print("Analog reading: ");
  Serial.println(brightnessValue);
}

int turnOn(){
  digitalWrite(RELAY_PIN, LOW);
  checkBrightness();
  return 1;
}

int turnOff(){
  digitalWrite(RELAY_PIN, HIGH);
  checkBrightness();
  // delay(500);
  return 0;
}
/////////////////////////////

void connectToWiFi(const char* ssid, const char* passwd){
    WiFi.mode(WIFI_OFF); //This prevents reconnection issue
    delay(10);
    WiFi.mode(WIFI_STA); //This hides the viewing of ESP as wifi hotspot
    WiFi.begin(ssid, passwd); //Connect to your WiFi router
    while (WiFi.status() != WL_CONNECTED){
        delay(1000);
        Serial.print(".");
    }
    Serial.println();
    Serial.print("WiFi Connected.");
    Serial.println();  
}

void connectToHost(const int httpPort){
    int retry_counter=0; //To be used while retrying to get connected
    wifiClient.setTimeout(15000); // 15 Seconds
    delay(1000);
    Serial.printf("Connecting to \"%s\"\n", host);
  
    while((!wifiClient.connect(host, httpPort)) && (retry_counter <= 30)){
      delay(100);
      Serial.print(".");
      retry_counter++;
    }
  
    if(retry_counter==31){
      Serial.println("\nConnection failed.");
      return;
    }
    else{
      Serial.println("Connected.");
    }   
}

void upload(String data, const char* filepath){
    wifiClient.println("POST "+(String)filepath+" HTTP/1.1");
    wifiClient.println("Host: " + (String)host);
    wifiClient.println("User-Agent: ESP8266/1.0");
    wifiClient.println("Content-Type: application/x-www-form-urlencoded");
    wifiClient.println("Content-Length: " +(String)data.length());
    wifiClient.println();
    wifiClient.print(data); 
    Serial.println("Uploading data...");
    parseResponse("Success");
}


/*
 * GET FEEDBACK
*/
void parseResponse(String success_msg){
    String datarx;
    while (wifiClient.connected()){
        String line = wifiClient.readStringUntil('\n');
        if (line == "\r") {
        break;
        }
    }
    while (wifiClient.available()){
        datarx += wifiClient.readStringUntil('\n');
    }

    if(datarx.indexOf(success_msg) >= 0){
        Serial.println("Uploaded.\n");  
    }
    else{
        Serial.println("Failed.\n"); 
    }
    Serial.println("*******************\n");
    datarx = "";  
}
