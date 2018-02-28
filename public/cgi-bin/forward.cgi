#!/usr/bin/python
import RPi.GPIO as GPIO
#import time
import pigpio
import sys


GPIO.setwarnings(False)
GPIO.cleanup()
GPIO.setmode(GPIO.BCM)

leftA=5
leftB=6
rightA=13
rightB=19

#sys.argv[0] is script itself
#print sys.argv[1]

pwm=int(sys.argv[1])

#GPIO.setup(leftA, GPIO.OUT)
#GPIO.setup(leftB, GPIO.OUT)
#GPIO.setup(rightA, GPIO.OUT)
#GPIO.setup(rightB, GPIO.OUT)

pi=pigpio.pi()

pi.set_mode(leftB, pigpio.OUTPUT)
pi.set_PWM_dutycycle(leftB, pwm)

pi.set_mode(rightA, pigpio.OUTPUT)
pi.set_PWM_dutycycle(rightA, pwm)
