#!/usr/bin/python
import sys
import Adafruit_DHT

humidity, temp = Adafruit_DHT.read_retry(11, 4)
temp_fahr = (9/5.0)*temp + 32
print '{0:0.1f} {1:0.1f}'.format(temp_fahr, humidity)
