#!/usr/bin/python

import RPi.GPIO as GPIO
import os

GPIO.setwarnings(False)
GPIO.cleanup()
GPIO.setmode(GPIO.BCM)

leftA = 5
leftB = 6
rightA = 13
rightB = 19

GPIO.setup(leftA,GPIO.OUT)
GPIO.setup(leftB,GPIO.OUT)
GPIO.setup(rightA,GPIO.OUT)
GPIO.setup(rightB,GPIO.OUT)

pLeftA=GPIO.PWM(leftA, 100)
pLeftB=GPIO.PWM(leftB,100)
pRightA=GPIO.PWM(rightA, 100)
pRightB=GPIO.PWM(rightB, 100)

try:
	pLeftA.ChangeDutyCycle(0)
	pLeftB.ChangeDutyCycle(0)
	pRightA.ChangeDutyCycle(0)
	pLeftA.ChangeDutyCycle(0)
finally:
	GPIO.cleanup()
	os.system("killall forward.cgi")
	os.system("killall left.cgi")
	os.system("killall right.cgi")
	os.system("killall reverse.cgi")

