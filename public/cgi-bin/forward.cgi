#!/usr/bin/python
import RPi.GPIO as GPIO
#import time
import pigpio

GPIO.setwarnings(False)
GPIO.cleanup()
GPIO.setmode(GPIO.BCM)

leftA=5
leftB=6
rightA=13
rightB=19

#GPIO.setup(leftA, GPIO.OUT)
#GPIO.setup(leftB, GPIO.OUT)
#GPIO.setup(rightA, GPIO.OUT)
#GPIO.setup(rightB, GPIO.OUT)

pi=pigpio.pi()

pi.set_mode(leftA, pigpio.OUTPUT)
pi.set_PWM_dutycycle(leftA, 250)

pi.set_mode(rightB, pigpio.OUTPUT)
pi.set_PWM_dutycycle(rightB, 250)


#pLeft=GPIO.PWM(leftA,1000)
#pRight=GPIO.PWM(rightB, 1000)
#while 1:
#	pLeft.start(70)
#	pRight.start(70)
#GPIO.output(leftA, 1)
#GPIO.output(leftB, 0)
#time.sleep(0.00001)
