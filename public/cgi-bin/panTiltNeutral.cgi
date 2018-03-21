#!/usr/bin/python
import sys
import pigpio
import RPi.GPIO as GPIO
import time
GPIO.setwarnings(False)
GPIO.cleanup()
GPIO.setmode(GPIO.BCM)

servoPan = 21
servoTilt = 20
try:
  pi = pigpio.pi()
  pi.set_mode(servoPan, pigpio.OUTPUT)
  pi.set_mode(servoTilt, pigpio.OUTPUT)

  print("Moving to the middle  using 1500...")
  pi.set_servo_pulsewidth(servoPan, 1500)
  pi.set_servo_pulsewidth(servoTilt, 1500)
finally:
  pi.stop()
