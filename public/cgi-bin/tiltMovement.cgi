#!/usr/bin/python
import sys
import pigpio
import RPi.GPIO as GPIO
import time
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)

servo = 20

freq=int(sys.argv[1])

try:
  pi = pigpio.pi()
  pi.set_mode(servo, pigpio.OUTPUT)
  print("Moving to neutral using 1500...")
  pi.set_servo_pulsewidth(servo, freq)

finally:
  pi.stop()
  GPIO.cleanup()
