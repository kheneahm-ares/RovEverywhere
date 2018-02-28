#!/usr/bin/python
import sys
import pigpio
import RPi.GPIO as GPIO
import time
GPIO.setwarnings(False)
GPIO.cleanup()
GPIO.setmode(GPIO.BCM)

servo = 2

pi = pigpio.pi()
pi.set_mode(servo, pigpio.OUTPUT)
print("Moving to neutral using 1500...")
pi.set_servo_pulsewidth(servo, 1500)