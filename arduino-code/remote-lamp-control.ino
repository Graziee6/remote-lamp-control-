#include <ESP8266WiFi.h>
int RELAY_PIN = 4;
int SENSOR_PIN = 12;
String status="OFF";

void setup() {
  pinMode(RELAY_PIN, OUTPUT);
  Serial.begin(9600);
}

void loop() {  
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
  delay(10000);
}

void turnOn(){
  digitalWrite(RELAY_PIN, LOW);
  checkBrightness();
  delay(1000);
}

void turnOff(){
  digitalWrite(RELAY_PIN, HIGH);
  checkBrightness();
  delay(1000);
}