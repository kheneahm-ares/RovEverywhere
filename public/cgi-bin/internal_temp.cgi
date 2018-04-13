#!/usr/bin/python
import os

temp = os.popen("/opt/vc/bin/vcgencmd measure_temp").readline()
temp = temp.replace("temp=","")
print temp.replace("'C", "")
