#!/usr/bin/python
import sys
import pigpio
import RPi.GPIO as GPIO
import time
GPIO.setwarnings(False)
GPIO.cleanup()
GPIO.setmode(GPIO.BCM)

tilt = 20
pan = 21

try:
    pi = pigpio.pi()
    
    pi.set_mode(tilt, pigpio.OUTPUT)
    pi.set_mode(pan, pigpio.OUTPUT)

    pi.set_servo_pulsewidth(pan, 1000)
    pi.set_servo_pulsewidth(tilt, 800)
    time.sleep(1)
    pi.set_servo_pulsewidth(pan, 2100)
    pi.set_servo_pulsewidth(tilt, 2000)
    time.sleep(1)
    pi.set_servo_pulsewidth(pan, 1500)
    pi.set_servo_pulsewidth(tilt, 1400)
finally:
    pi.stop()
    GPIO.cleanup()
