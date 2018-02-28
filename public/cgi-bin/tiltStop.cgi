#!/usr/bin/python
import sys
import pigpio
import RPi.GPIO as GPIO
import time
import os
GPIO.setwarnings(False)
GPIO.cleanup()
GPIO.setmode(GPIO.BCM)

servo = 5

GPIO.setup(leftA,GPIO.OUT)
Pservo = GPIO.PWM(servo, 100)
try:
	Pservo.ChangeDutyCycle(0)
finally:
	GPIO.cleanup()
	os.system("killall panLeft.cgi")
	os.system("killall panNeutral.cgi")
	os.system("killall tiltLeft.cgi")
	os.system("killall tiltRight.cgi")
    os.system("killall tiltNeutral.cgi")
	os.system("killall panNeutral.cgi")