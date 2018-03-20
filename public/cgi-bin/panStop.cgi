#!/usr/bin/python
import sys
import pigpio
import RPi.GPIO as GPIO
import time
import os
GPIO.setwarnings(False)
GPIO.cleanup()
GPIO.setmode(GPIO.BCM)

GPIO.cleanup()
os.system("killall panMovement.cgi")
