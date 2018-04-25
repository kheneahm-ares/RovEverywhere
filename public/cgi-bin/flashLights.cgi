#!/usr/bin/python

import os
import RPi.GPIO as GPIO
import time
from neopixel import *
from sys import argv

# LED strip configuration:
LED_COUNT      = 13      # Number of LED pixels.
LED_PIN        = 18      # GPIO pin connected to the pixels (18 uses PWM!).
#LED_PIN        = 10      # GPIO pin connected to the pixels (10 uses SPI /dev/spidev0.0).
LED_FREQ_HZ    = 800000  # LED signal frequency in hertz (usually 800khz)
LED_DMA        = 10      # DMA channel to use for generating signal (try 10)
LED_BRIGHTNESS = 255     # Set to 0 for darkest and 255 for brightest
LED_INVERT     = False   # True to invert the signal (when using NPN transistor level shift)
LED_CHANNEL    = 0       # set to '1' for GPIOs 13, 19, 41, 45 or 53

# Create NeoPixel object with appropriate configuration.
strip = Adafruit_NeoPixel(LED_COUNT, LED_PIN, LED_FREQ_HZ, LED_DMA, LED_INVERT, LED_BRIGHTNESS, LED_CHANNEL)
# Intialize the library (must be called once before other functions).
strip.begin()

try:

    strip.setPixelColor(0, Color(255, 204, 0))
    strip.setPixelColor(1, Color(255, 204, 0))
    strip.setPixelColor(4, Color(255, 204, 0))
    strip.setPixelColor(5, Color(255, 204, 0))
    strip.setPixelColor(6, Color(255, 204, 0))
    strip.setPixelColor(7, Color(255, 204, 0))
    strip.setPixelColor(10, Color(255, 204, 0))
    strip.setPixelColor(11, Color(255, 204, 0))
    strip.show()
    time.sleep(1)
    
    strip.setPixelColor(0, Color(0, 0, 0))
    strip.setPixelColor(1, Color(0, 0, 0))
    strip.setPixelColor(4, Color(0, 0, 0))
    strip.setPixelColor(5, Color(0, 0, 0))
    strip.setPixelColor(6, Color(0, 0, 0))
    strip.setPixelColor(7, Color(0, 0, 0))
    strip.setPixelColor(10, Color(0, 0, 0))
    strip.setPixelColor(11, Color(0, 0, 0))
    strip.show()
    time.sleep(1)

    strip.setPixelColor(0, Color(255, 204, 0))
    strip.setPixelColor(1, Color(255, 204, 0))
    strip.setPixelColor(4, Color(255, 204, 0))
    strip.setPixelColor(5, Color(255, 204, 0))
    strip.setPixelColor(6, Color(255, 204, 0))
    strip.setPixelColor(7, Color(255, 204, 0))
    strip.setPixelColor(10, Color(255, 204, 0))
    strip.setPixelColor(11, Color(255, 204, 0))
    strip.show()

    time.sleep(2)
    strip.setPixelColor(0, Color(0, 0, 0))
    strip.setPixelColor(1, Color(0, 0, 0))
    strip.setPixelColor(4, Color(0, 0, 0))
    strip.setPixelColor(5, Color(0, 0, 0))
    strip.setPixelColor(6, Color(0, 0, 0))
    strip.setPixelColor(7, Color(0, 0, 0))
    strip.setPixelColor(10, Color(0, 0, 0))
    strip.setPixelColor(11, Color(0, 0, 0))
    strip.show()

finally:
    #os.system("killall whiteLight.py")
    GPIO.cleanup()
